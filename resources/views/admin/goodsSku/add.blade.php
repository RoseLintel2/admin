@extends('common.admin_base')

@section('title','管理后台-商品SKU属性添加')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品SKU属性添加 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('msg') }}
        </div>
    @endif
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
    <!--标签切换-->
    <div id="goods_add">
    <p>
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" @click="switchTab">SKU手动属性</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" @click="switchTab">SKU列表属性</button>&nbsp;
        
    </p>
    <!--标签切换-->
    <div class="panel panel-default">
        
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">商品SKU属性表单</h4>
        </div>
        <form class="form-horizontal form-bordered" action="/admin/goods/store" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <!--通用信息-->
        <div class="panel-body panel-body-nopadding" v-show="tab==1">
               
           
                <div class="form-group">
                 
                    <label class="col-sm-3 control-label">商品名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="商品名称" class="form-control" name="goods_name" value="" />
                    </div>
                </div>
                
             
        </div>
        <!--通用信息-->
    
        <!--商品相册-->
        <div class="panel-body panel-body-nopadding" v-show="tab==2">
                    {{csrf_field()}}
                    <!-- 相册添加表单-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片描述</label>
                            <div class="col-sm-4">
                                <input type="text"  value="" class="form-control" name="img[][image_name]">
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-2 control-label">商品图片</label>
                            <div class="col-sm-3">
                                <input type="file" placeholder="输入用户名" value="" class="form-control" name="img[][image_url]">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-sm btn-primary" @click="add_upload"><i class="glyphicon glyphicon-plus"></i> </a>
                            </div>
                        </div>
                        <div class="form-group" v-for="(value,index) in gallery_data" :id="'data_'+index">
                            <label class="col-sm-2 control-label">图片描述</label>
                            <input type="hidden" value="">
                            <div class="col-sm-4">
                                <input type="text"  value="" class="form-control" name="img[][image_name]">
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-2 control-label">商品图片</label>
                            <div class="col-sm-3">
                                <input type="file" placeholder="输入用户名" value="" class="form-control" name="img[][image_url]">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-1">
                                <a @click="del_upload(index)" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-minus"></i></a>
                            </div>
                        </div>
            </div><!-- panel-body -->
        <!--商品相册-->

        <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-4">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存商品</button>&nbsp;
                        </div>
                    </div>
        </div><!-- panel-footer -->
        </form>
    </div>
</div>
        <!-- panel-body -->
        <script type="text/javascript" src="/js/vue.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="/js/ueditor2/ueditor.config.js"></script>
        <script type="text/javascript" src="/js/ueditor2/ueditor.all.js"></script>
        
        <script type="text/javascript">
            //ueditor
            var ue = UE.getEditor('content');
            ue.ready(function(){
                ue.setHeight(280);
            })
            //vue的代码
            var goodsAdd = new Vue({
                el: "#goods_add",
                delmiters: ['{','}'],
                data: {
                    tab: 1,
                    gallery_data:[],
                    gallery_num:0,
                },
                methods: {
                    //标签切换
                    switchTab: function(e){
                        console.log(e.target.dataset.tab);//获取当前对象属性
                        this.tab = e.target.dataset.tab;
                    },
                    //添加相册的表单元素
                    add_upload: function(){
                        this.gallery_num++;
                        this.gallery_data.push({'data-value':this.gallery_num});
                    },
                    //删除执行的表单元素
                    del_upload: function(index){
                        // this.gallery_data.splice(index,1);
                        $("#data_"+index).hide();
                    }
                }
            })

            $(".alert-danger").hide();

            $("#btn-save").click(function(){
                var goods_num = $("input[name=goods_name]").val();
                var goods_sn = $("input[name=goods_sn]").val();
                var shop_price = $("input[name=shop_price]").val();
                var market_price = $("input[name=market_price]").val();
                var goods_num = $("input[name=goods_num]").val();
                var warn_num = $("input[name=warn_num]").val();

                if(goods_num == ''){
                    $("#error_msg").text('商品名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(goods_sn == ''){
                    $("#error_msg").text('商品货号不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(market_price == '' || market_price == ''){
                     $("#error_msg").text('价格不能为空');
                     $(".alert-danger").show();
                     return false;
                }

                if(goods_num == '' || warn_num == ''){
                     $("#error_msg").text('库存不能为空');
                     $(".alert-danger").show();
                     return false;
                }

            });



            //开始日期
            $("#shop_time").datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                minView: 0,
                language:  'zh-CN',
                minuteStep:1
            });
        </script>
@endsection