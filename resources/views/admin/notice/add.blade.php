@extends('admin.AdminPublic.index')
@section('title','公告添加页面')
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
                    <li><a href="/bk_cates/add"><i class="fa fa-book"></i> 公告添加页</a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">公告添加</header>
                    <div class="panel-body">
                        <div class="form">

                            <form class="cmxform form-horizontal adminex-form" method="post" action="/bk_notice/doadd">
                                
                                <div class="form-group ">
                                    <label for="name" class="control-label col-lg-2">公告标题</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="title" name="title" type="text">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="name" class="control-label col-lg-2">公告内容</label>
                                    <div class="col-lg-8">
                                        <script id="editor" type="text/plain"  name="content" style="width:700px;height:300px;"></script> 
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        {{csrf_field()}}
                                        <button class="btn btn-success col-xs-2" type="submit">添加</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //实例化编辑器
        var ue = UE.getEditor('editor');
    </script>
    <!--右侧显示内容区域 结束-->
@endsection