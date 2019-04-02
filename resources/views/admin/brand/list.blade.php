@extends('common.admin_base')

@section('title','管理后台商品品牌')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品品牌 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/brand/add">+ 商品品牌</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="Brand_lists">
        <div class="col-md-12">

             {{ csrf_field() }}

            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>品牌名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="lists in Brand_list">
                        <td>{ lists.id }</td>
                        <td>{ lists.brand_name}</td>
                        <td>
                            <button v-if="lists.status == 1 " class="btn btn-sm btn-success" >可用</button>
                            <button v-else class="btn btn-sm btn-black" >禁用</button>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" :href="'/admin/brand/edit/'+lists.id" >修改</a>
                            <a class="btn btn-sm btn-danger" v-on:click="del(lists.id)">删除</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
    <script src="/js/app.js"></script>
    <script>
        var brand = new Vue({

            el:"#Brand_lists",
            delimiters:['{','}'],
            data:{
                Brand_list:[]
            },
            created:function(){
                this.doList();
            },
            methods:{
                doList:function(){
                    var that = this;
                    var token=$("input[name=_token]").val();
                    //alert(token);
                    $.ajax({
                        url:"http://www.php7yue2.com/admin/brand/doList",
                        type:"post",
                        data:{

                            _token:token
                        },
                        dataType:"json",
                        success:function(res){
                            if(res.code == 2000){
                                console.log(res);
                                that.Brand_list = res.data;
                                
                            }
                        }
                    })
                },
                del:function(id){
                    var that = this;
                    
                    $.ajax({
                        url:"http://www.php7yue2.com/admin/brand/del/"+id,
                        type:"get",
                        data:{

                            id:id
                            
                        },
                        dataType:"json",
                        success:function(res){
                            if(res.code == 2000){
                                
                                that.doList();
                                
                            }
                        }
                    })
                }
                
               

            }

        })
    </script>
@endsection