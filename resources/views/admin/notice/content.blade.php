@extends('admin.AdminPublic.index')
@section('title','公告内容页面')
@section('container')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<!--右侧显示内容区域 开始-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                <li><a href=""><i class="fa fa-book"></i> 公告内容页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">                     
                    <div class="row-fluid">
                        <div class="col-xs-8">
                            公告内容页
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="text-align: center">
                    <div class="row-fluid">
                        <div class="col-xs-12">
                            {{$data->title}}
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-xs-12">
                            时间:{{date("Y-m-d H:i:s",$data->created_at)}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="col-xs-12">
                            {{strip_tags($data->content)}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="col-xs-12">
                           <a class="btn btn-success" href="/bk_notice">返回</a>
                        </div>
                    </div>
                </div>   
            </section>
        </div>
    </div>
</div>

<!--右侧显示内容区域 结束-->
@endsection