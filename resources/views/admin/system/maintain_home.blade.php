@extends('admin.AdminPublic.index')
@section('title','系统设置_前台维护设置')
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
                    <li><a href="#">系统设置</a></li>
                    <li class="active">前台维护设置</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">前台维护

                </header>
                <div class="panel-body col-xs-6">
                        <br><br>
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                维护时间(小时):
                            </div>
                            <div class="col-xs-8 left">
                                <input type="text" id="homemaintain_time" placeholder="维护时间(默认永久)">
                            </div>
                        </div>
                        <br><br><br>
                        <div class="col-xs-12">
                            @php
                                if ( !cache()->has('homemaintain') ) {
                                cache()->forever('homemaintain','close');
                                }
                            @endphp
                            <div class="col-xs-2">
                                开关:
                            </div>

                            <div class="col-xs-10 left">
                                <label style="cursor: pointer;" for="open">
                                    <input type="radio" name="homemaintain" @if(cache('homemaintain')=='open') checked @endif id="open">   开启
                                </label>
                                <label style="cursor: pointer;" for="close">
                                    <input type="radio" @if(cache('homemaintain')=='close') checked @endif name="homemaintain" id="close">   关闭
                                </label>
                            </div>
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-info" id="save">保存</button>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        @if(cache('homemaintain')=='close')
                            <br>
                             <img src="/static/admin/images/xiaoya.png" width="420px;">
                        @else
                            <br><br>
                             <img src="/static/admin/images/zhengchangya.png" width="450px;">
                        @endif
                    </div>
            </section>
        </div>
    </div>

<div id="homemaintainModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">前台维护提示</h4>
            </div>
            <div class="modal-body">
                <h2 class="text-center" id="homeMaintainTip">确认信息</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">确认</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



    <script>
        $(function(){
            $("#save").click(function(){
                let that = $(this);
                let time = $('#homemaintain_time').val();
                let $type = false;
                if ( $("#open").attr('checked') ) {
                    $type = true;
                }
                if ( !time.length ) {
                    time = 0;
                }

                $.ajax({
                    url: '/bk_system/homemaintainDownUp',
                    method: 'post',
                    data: {time:time,type:$type},
                    dataType:'json',
                    success:function(res){
                        $("#homeMaintainTip").text(res.msg);
                        $("#homemaintainModal").modal({
                            backdrop:'static',
                            keyboard:false
                        });
                    },error:function(err) {
                        console.log('网络错误');
                    },beforeSend:function(xhr){
                        xhr.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}')
                    }
                });

            });
        });
    </script>
    <!--右侧显示内容区域 结束-->
@endsection
