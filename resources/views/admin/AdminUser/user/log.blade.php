@extends('admin.AdminPublic.index')
@section('title','后台登录日志')
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
                <li><a href="/bk_adminuser">管理员管理</a></li>
                <li class="active">登录日志</li>
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
            <h4>登录日志</h4>
        </div>
        <div class="panel-body col-sm-6 text-right">
            <form class="form-inline" role="form" method="get" action="/bk_adminuser/log">
                <div class="form-group">
                     <label class="sr-only" for="exampleInputEmail2">用户名搜索</label>
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
          <th class="hidden-phone">用户名</th>
          <th>内容</th>
          <th>操作时间</th>
          <th>操作IP</th>
          <th class="col-md-1">操作</th>
         </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
         <tr>
          <td>{{$row->id}}</td>
          <td class="hidden-phone">{{$row->name}}</td>
          <td>{{$row->desc}}</td>
          <td>{{date('Y-m-d h:i:s',$row->login_time)}}</td>
          <td>{{$row->ip}}</td>
          <td>
            <a class="label label-warning" id="add-without-image" href="/bk_adminuser/logdel/{{$row->id}}">删除</a>
          </td>
         </tr>
         @endforeach
        </tbody>
       </table>
        <!-- 分页 -->
         <div class="row">
           <div class="col-lg-6" >
                <div class="panel-body col-sm-3">
                  <form action="/bk_adminuser/getLogFile" method="post">
                      {{csrf_field()}}
                      <button type="submit" class="btn btn-info" id="exportExcel">导出到Excel</button>
                  </form>
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

