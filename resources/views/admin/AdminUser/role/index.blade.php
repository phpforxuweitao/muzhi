@extends('admin.AdminPublic.index')
@section('title','管理员管理-角色列表')
@section('container')


<!-- 右侧顶部搜索部分 开始 -->
@include('admin.AdminPublic.header')
<!-- 右侧顶部搜索部分 结束 -->
<!-- 右侧顶部链接导航区域 开始 -->
	<div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb panel">
                    <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                    <li><a href="#">管理员管理</a></li>
                    <li class="active">角色列表</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
   </div>
	<div class="wrapper">
   <div class="row">
    <div class="col-sm-12">
     <section class="panel">
     <!-- 搜索  -->
     <div class="panel-body col-sm-6">
     	<h4>角色列表</h4>
     </div>
      <div class="panel-body col-sm-6 text-right">
	   <form class="form-inline" role="form" method="get" action="/bk_role">
	    <div class="form-group">
	     <label class="sr-only" for="exampleInputEmail2">账号搜索</label>
	     <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Enter name" name="keywords" />
	    </div>

	    <button type="submit" class="btn btn-primary">搜索</button>
	   </form>
	  </div>
      <div class="panel-body" style="display: block;">
       <table class="table  table-hover ">
        <thead>
         <tr>
          <th> ID</th>
          <th class="hidden-phone">角色名</th>
          <th>管理描述</th>
          <th>状态</th>
          <th class="col-md-3">操作</th>
         </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
         <tr>
          <td>{{$row->id}}</td>
          <td class="hidden-phone">{{$row->name}}</td>
          <td>{{$row->remark}}</td>
          <td>
          @if($row->status == 0)
          	<span class="badge badge-success">正常</span>
          @else
          	<span class="badge badge-important">锁定</span>
          @endif
          </td>
          <td>
               <a class="label label-warning" id="add-without-image" href="/bk_role/{{$row->id}}/node">分配权限</a>
			         <a class="label label-info" id="add-without-image" href="/bk_role/{{$row->id}}/edit">修改</a>
              @if($row->status == 0)
          		<a class="label label-danger" id="remove-all" href="/bk_role/close/{{$row->id}}">锁定</a>
              @else
          		<a  class="label label-success" id="add-without-image" href="/bk_role/open/{{$row->id}}">启用</a>
          	   @endif
          	<a class="label label-default" id="add-max" href="/bk_role/del/{{$row->id}}" onclick="return confirm('确定删除吗?')">删除</a>
          </td>
         </tr>
         @endforeach
        </tbody>
       </table>
       <!-- 分页 -->
		 <div class="row">

		   <div class="col-lg-6" >
		    	<div class="dataTables_info" id="editable-sample_info">
		    	Mr red is Ang. 28st, 2018
		    	</div>
		   </div>
		   <div class="col-lg-6" style="text-align: right;" >
		     	 {{$data->appends($request)->render()}}
		   </div>
		</div>

      </div>
     </section>
    </div>
   </div>
  </div>
<!--右侧显示内容区域 结束-->

@endsection
