@extends('admin.AdminPublic.index')
@section('title','会员列表')
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
                  <li><a href="/bk_users">会员管理</a></li>
                  <li><a href="/bk_users">会员列表</a></li>
                  <li class="active">会员详情</li>
            </ul>
                <!--breadcrumbs end -->
        </div>
  </div>
<!--右侧显示内容区域 结束-->
  <div class="wrapper">
   <div class="row">
    <div class="col-md-4">
     <div class="row">
      <div class="col-md-12">
       <div class="panel">
        <div class="panel-body">
         <div class="profile-pic text-center">
          <img alt="" src="@if($user->uface == '')/static/admin/images/photos/user1.png @else {{$user->uface}} @endif" />
         </div>
        </div>
       </div>
      </div>
      <div class="col-md-12">
       <div class="panel">
        <div class="panel-body">
         <ul class="p-info">
          <li>
           <div class="title">
            账号:
           </div>
           <div class="desk">
            {{$user->name}}
           </div> </li>
          <li>
           <div class="title">
            邮箱:
           </div>
           <div class="desk">
            {{$user->email}}
           </div> </li>
          <li>
           <div class="title">
            QQ：
           </div>
           <div class="desk">
            {{$user->qq}}
           </div> </li>
          <li>
           <div class="title">
            积分：
           </div>
           <div class="desk">
            {{$user->score}}
           </div> </li>
          <li>
           <div class="title">
            状态：
           </div>
           <div class="desk">
             @if($user->status == 0)
            <span class="badge badge-success">正常</span>
            @elseif($user->status == 1)
            <span class="badge badge-important">禁用</span>
            @else
            <span class="badge">删除</span>
            @endif

           </div> </li>
         </ul>
        </div>
       </div>
      </div>
      <div class="col-md-12">
       <div class="panel">
        <div class="panel-body p-states">
        <div class="panel-body">
         <ul class="p-info">
          <li>
           <div class="title">
            最近登录IP:
           </div>
           <div class="desk">
            {{$user->last_login_ip}}
           </div> </li>
          <li>
           <div class="title">
            最近登录时间:
           </div>
           <div class="desk">
            {{date('Y-m-d h:i:s',$user->last_login_time)}}
           </div> </li>
          <li>
           <div class="title">
            修改时间：
           </div>
           <div class="desk">
            {{date('Y-m-d h:i:s',$user->updated_at)}}
           </div> </li>
         </ul>
        </div>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="col-md-8">
     <div class="row">
      <div class="col-md-12">
       <div class="panel">
        <div class="panel-body">
         <div class="profile-desk">
           <ul class="p-info">
              <li>
              <div class="title">
               <h1>{{$user->nickname}}</h1>
              </div>
              <div class="desk">
                <span class="designation">人气&nbsp;&nbsp;&nbsp;&nbsp;</span>{{$user->fame}}
              </div> </li>
            </li>
             <li>
              <div class="title">
               注册时间:
              </div>
              <div class="desk">
               {{date('Y-m-d h:i:s',$user->created_at)}}

              </div> </li>
              <li>
              <div class="title">
               性别:
              </div>
              <div class="desk">
               @if($user->sex == 'w')
                女
               @elseif($user->sex == 'm')
                男
                @else
                保密
                @endif
              </div> </li>
              <li>
              <div class="title">
               生日:
              </div>
              <div class="desk">
              {{$user->birthday}}
              </div> </li>
              <li>
              <div class="title">
               个性签名:
              </div>
              <div class="desk">
              </div> </li>
          </ul>
          <p>{{$user->signatrue}}</p>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-md-12">
       <div class="panel">
        <form>
         <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
        </form>
        <footer class="panel-footer">
         <button class="btn btn-post pull-right">Post</button>
         <ul class="nav nav-pills p-option">
          <li> <a href="#"><i class="fa fa-user"></i></a> </li>
          <li> <a href="#"><i class="fa fa-camera"></i></a> </li>
          <li> <a href="#"><i class="fa  fa-location-arrow"></i></a> </li>
          <li> <a href="#"><i class="fa fa-meh-o"></i></a> </li>
         </ul>
        </footer>
       </div>
      </div>
     </div>

    </div>
   </div>
  </div>

@endsection
