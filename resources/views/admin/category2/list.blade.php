@extends('common.admin_base')

@section('title','管理后台商品分类')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品分类 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/category2/add">+ 商品分类</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="list">
    <p><button class="btn btn-sm btn-success" v-if="fid>0" @click="lists(0)" >返回上级</button></p>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="cat in category2">
                        <td>{cat['id']}</td>
                        <td>{cat['cate_name']}</td>
                        <td>
                            <button v-if="cat.status == 1 " class="btn btn-sm btn-success" >可用</button>
                            <button v-else class="btn btn-sm btn-black" >禁用</button>
                        </td>
                        <td>
                             <button class="btn btn-sm btn-success" v-on:click="lists(cat.id)">查看子级</button>
                             <a class="btn btn-sm btn-warning" :href="'/admin/category2/edit/'+cat.id"  >修改</a>
                             <button class="btn btn-sm btn-danger" v-on:click="del(cat.id)">删除</button>
                            
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
    <script>
    var categroy2 = new Vue({
        el:"#list",
        delimiters:['{','}'],
        data:{
            category2:[]
        },
        created:function(){
            this.lists();
        },
        methods:{
            lists:function(fid=0){
                var that = this;
                that.fid=fid;
                $.ajax({
                    url:"/admin/category2/get/data/"+fid,
                    type:"get",
                    data:{

                    },
                    dataType:"json",
                    success:function(res){
                        console.log(res);
                        that.category2 = res.data;
                    }
                })
            },
            del:function(id){
                var that = this;
                
                $.ajax({
                    url:"/admin/category2/del/"+id,
                    type:"get",
                    data:{

                    },
                    dataType:"json",
                    success:function(res){
                       that.lists();
                    }
                })
            }
           
        }
    })
    </script>
@endsection