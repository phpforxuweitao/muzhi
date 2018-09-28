<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    {{--<link rel="shortcut icon" href="" type="image/png">--}}

    <title>@yield('title','木知网后台')</title>

    <!--icheck-->
    <link href="/static/admin/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="/static/admin/js/iCheck/skins/square/square.css" rel="stylesheet">
    <link href="/static/admin/js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="/static/admin/js/iCheck/skins/square/blue.css" rel="stylesheet">
    <link href="/static/admin/js/iCheck/skins/minimal/purple.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/js/ios-switch/switchery.css">

    <!--百度编辑器配置文件-->
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
    <!--编辑器源码文件-->
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.js"> </script>
    <!--uparse-->
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.parse.min.js"></script>
    <!--设置语言类型-->
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>

    <!--dashboard calendar-->
    <link href="/static/admin/css/clndr.css" rel="stylesheet">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="/static/admin/js/morris-chart/morris.css">

    <!--dynamic table-->
    <link href="/static/admin/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="/static/admin/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/js/data-tables/DT_bootstrap.css" />

    <!--pickers css-->
    <link rel="stylesheet" type="text/css" href="/static/admin/js/bootstrap-datepicker/css/datepicker-custom.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />

    <!--common-->
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <link href="/static/admin/css/style-responsive.css" rel="stylesheet">
    <script src="/static/admin/js/jquery-1.10.2.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/static/admin/js/html5shiv.js"></script>
    <script src="/static/admin/js/respond.min.js"></script>
    <![endif]-->
    <script src="/static/admin/js/jquery-1.10.2.min.js"></script>
</head>

<body class="sticky-header">

<section>
<!-- 左侧菜单栏 开始 -->
@include('admin.AdminPublic.menu')
<!-- 左侧菜单栏 结束-->
<div class="main-content" >

<!-- 右侧顶部搜索部分 开始 -->
@include('admin.AdminPublic.header')
<!-- 右侧顶部搜索部分 结束 -->

@if(session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" id="success" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{session('success')}}</strong>
</div>
<script>
setInterval(function(){
    $('#success').trigger('click');
},2500)
</script>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" id="error" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{session('error')}}</strong>
</div>
<script>
setInterval(function(){
    $('#error').trigger('click');
},2500)
</script>
@endif

<!-- 右侧内容区域 开始-->
@section('container')

@show
<!-- 右侧内容区域 结束-->

</div>

</section>


<!-- Placed js at the end of the document so the pages load faster -->

<script src="/static/admin/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/static/admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<script src="/static/admin/js/modernizr.min.js"></script>
<script src="/static/admin/js/jquery.nicescroll.js"></script>

<script src="/static/admin/js/del.js"></script>

<!--ios7-->
<script src="/static/admin/js/ios-switch/switchery.js" ></script>
<script src="/static/admin/js/ios-switch/ios-init.js" ></script>

<!-- 图片预览 -->
<script src="/static/admin/js/ads.js"></script>

<!--easy pie chart-->
<script src="/static/admin/js/easypiechart/jquery.easypiechart.js"></script>
<script src="/static/admin/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="/static/admin/js/sparkline/jquery.sparkline.js"></script>
<script src="/static/admin/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="/static/admin/js/iCheck/jquery.icheck.js"></script>
<script src="/static/admin/js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="/static/admin/js/flot-chart/jquery.flot.js"></script>
<script src="/static/admin/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/static/admin/js/flot-chart/jquery.flot.resize.js"></script>

<!--multi-select-->
<script type="text/javascript" src="/static/admin/js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script src="/static/admin/js/multi-select-init.js"></script>

<!--Morris Chart-->
<script src="/static/admin/js/morris-chart/morris.js"></script>
<script src="/static/admin/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="/static/admin/js/calendar/clndr.js"></script>
<script src="/static/admin/js/calendar/evnt.calendar.init.js"></script>
<script src="/static/admin/js/calendar/moment-2.2.1.js"></script>
<script src="/static/admin/js/underscore1.5.2.min.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="/static/admin/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<!--pickers initialization-->
<script src="/static/admin/js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="/static/admin/js/scripts.js"></script>
</body>
</html>
