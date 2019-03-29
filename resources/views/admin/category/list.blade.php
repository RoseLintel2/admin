@extends('common.admin_base')

@section('title','管理后台-作者列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 作者列表 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
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
                        <th>类型名称</th>
                       
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($categorys))
                        @foreach($categorys as $category)
                          <tr>
                          <td>{{$category['id']}}</td>
                          <td>{{$category['c_name']}}</td>
                          
                          <td>
                            <a  class="btn btn-sm btn-danger" href="{{ route('admin.category.del',[ 'id'=>$category['id'] ]) }}">删除</a>
                          </td>
                         </tr>
                        @endforeach

                      @endif
                      
                    </tbody>
                </table>
                {{$categorys->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection