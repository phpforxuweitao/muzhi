@extends('admin.AdminPublic.index')
@section('title','排版管理-排版位置调整')
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
                    <li><a href="/bk_/layout">排版管理</a></li>
                    <li class="active">排版调整</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
   </div>
  @if (count($errors) > 0)
   <div class="alert alert-warning fade in">
          <button type="button" class="close close-sm" data-dismiss="alert">
              <i class="fa fa-times"></i>
          </button>
          @foreach ($errors->all() as $error)
            <strong>{{ $error }}...</strong>

          @endforeach
    </div>
  @endif
    <div class="wrapper ">
   <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Position adjustment
                        </header>
                        <div class="panel-body">
                            <form  class="form-horizontal adminex-form" method="post" action="/bk_layout/update">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group ">
                                    <label class="col-lg-2 control-label">类别名称：</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="disabledInput" type="text" placeholder="" disabled="" value="{{$data->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">位置选择：</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox col-lg-12">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="0" @if($data->position == 0) checked="" @endif >
                                                <span class="badge">未排版</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="1" @if($data->position == 1) checked="" @endif >
                                                <span class="badge badge-warning">1号位</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="2" @if($data->position == 2) checked="" @endif >
                                                <span class="badge badge-primary">2号位</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="3" @if($data->position == 3) checked="" @endif >
                                                <span class="badge badge-success">3号位</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="4" @if($data->position == 4) checked="" @endif >
                                                <span class="badge badge-info">4号位</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="5" @if($data->position == 5) checked="" @endif >
                                                <span class="badge badge-inverse">5号位</span>
                                            </label>
                                        </div>
                                        <div class="checkbox col-lg-2">
                                            <label>
                                                <input type="radio" name="position" id="position1" value="6" @if($data->position == 6) checked="" @endif >
                                                <span class="badge badge-important">6号位</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8">
                                        <input  class="btn btn-primary" type="submit" value="提交">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
    </div>
  </div>
<!--右侧显示内容区域 结束-->

@endsection
