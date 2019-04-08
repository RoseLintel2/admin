@extends('common.admin_base')

@section('title','管理后台商品类型')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品属性 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/goods/type/add">+ 商品属性</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>属性名称</th>
                        <th>状态</th>
                        <th class="col-md-3">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list))
                            @foreach($list as $key=>$v)
                                <tr>
                                    <td>{{$v['id']}}</td>
                                    <td>{{$v['type_name']}}</td>
                                    <td >{{$v['status'] == 1 ? '可用' : '禁用' }}</td>
                                    <td class="col-md-3">
                                       <a class="btn btn-sm btn-warning" href="/admin/goods/attr/list/{{$v['id']}}">查看属性</a>&nbsp;
                                        <a class="btn btn-sm btn-warning" href="/admin/goods/type/edit/{{$v['id']}}">编辑</a>&nbsp;
                                        <a class="btn btn-sm btn-danger" href="/admin/goods/type/del/{{$v['id']}}">删除</a>&nbsp;
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div><!-- table
            -responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection