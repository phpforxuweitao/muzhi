<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="/bk_index" title="后台首页">
            <img src="/static/admin/images/logo3.png" alt="" height ="34px">
        </a>
    </div>

    <div class="logo-icon text-center">
        <a href="/bk_index">
            <img src="/static/admin/images/logo_icon.png" alt="">
        </a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">
        <!-- 手机端显示时右侧的小导航栏 开始 -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="/static/admin/images/photos/user-avatar.png" class="media-object">
                <div class="media-body">
                    <h4><a href="#">John Doe222</a></h4>
                    <span>"Hello There..."</span>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li>
                    <a href="#"><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out2222</span></a>
                </li>
            </ul>
        </div>
        <!-- 手机端显示时右侧的小导航栏 结束 -->

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="{{$menu_index or ''}}">
                <a href="/bk_index"><i class="fa fa-home"></i> <span>首页</span></a>
            </li>
            <li class="menu-list {{$menu_users or ''}}">
                <a href=""><i class="fa fa-user"></i> <span>会员管理</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_users_index or ''}}"><a href="/bk_users">会员列表</a></li>
                    <li class="{{$menu_users_create or ''}}"><a href="/bk_users/create"> 添加会员</a></li>
                </ul>
            </li>
            <li class="menu-list {{$menu_cates or ''}}">
                <a href=""><i class="fa fa-book"></i> <span>分类管理</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_cates_index or ''}}"><a href="/bk_cates">分类列表</a></li>
                    <li class="{{$menu_cates_add or ''}}"><a href="/bk_cates/add"> 添加分类</a></li>
                </ul>
            </li>

            <li class="menu-list {{$menu_admin or ''}}"><a href=""><i class="fa fa-cogs"></i> <span>管理员管理</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_adminuser_index or ''}}"><a href="/bk_adminuser">管理团队</a></li>
                    <li class="{{$menu_adminuser_create or ''}}"><a href="/bk_adminuser/create">添加管理</a></li>
                    <li class="{{$menu_adminuser_log or ''}}"><a href="/bk_adminuser/log">登录日志</a></li>
                    <li class="{{$menu_role_index or ''}}"><a href="/bk_role">角色列表</a></li>
                    <li class="{{$menu_role_create or ''}}"><a href="/bk_role/create">角色添加</a></li>
                    <li class="{{$menu_node_index or ''}}"><a href="/bk_node">权限列表</a></li>
                    <li class="{{$menu_node_create or ''}}"><a href="/bk_node/create">权限添加</a></li>

                </ul>
            </li>

            <li class="menu-list {{$menu_content or ''}}"><a href=""><i class="fa fa-list"></i> <span>内容管理</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_content_riji_add or ''}}"><a href="/bk_content/riji/add"> 添加内容</a></li>
                    <li class="{{$menu_content_riji or ''}}"><a href="/bk_content/riji"> 内容列表</a></li>
                    <li class="{{$menu_content_riji_vali or ''}}"><a href="/bk_content/riji/vali"> 待审核列表</a></li>
                    <li class="{{$menu_content_riji_unpasslist or ''}}"><a href="/bk_content/riji/unpasslist"> 审核驳回列表</a></li>
                </ul>
            </li>
            <li class="menu-list {{$menu_layout or ''}}" ><a href=""><i class="fa fa-tasks"></i> <span>排版管理</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_layout_index or ''}}"><a href="/bk_layout">内容排版</a></li>
                   <!--  <li class="{{$menu_layout_image or ''}}"><a href="/bk_image">图片排版</a></li> -->
                </ul>
            </li>
            <li class="menu-list {{$menu_lunbo or ''}}">
                <a href=""><i class="fa fa-bar-chart-o"></i> <span>轮播图</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_lunbo_index or ''}}"><a href="/bk_lunbo"> 轮播图列表</a></li>
                    <li class="{{$menu_lunbo_add or ''}}"><a href="/bk_lunbo/add"> 添加轮播图</a></li>
                </ul>
            </li>
            <li class="menu-list {{$menu_ads or ''}}">
                <a href=""><i class="fa fa-th-list"></i> <span>广告</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_ads_index or ''}}"><a href="/bk_ads"> 广告列表</a></li>
                    <li class="{{$menu_ads_add or ''}}"><a href="/bk_ads/add"> 添加广告</a></li>
                </ul>
            </li>

            <li class="menu-list {{$menu_links or ''}}">
                <a href=""><i class="fa fa-link"></i> <span>友情链接</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_links_index or ''}}"><a href="/bk_links"> 友情链接列表</a></li>
                    <li class="{{$menu_links_add or ''}}"><a href="/bk_links/add"> 添加友情链接</a></li>
                    <li class="{{$menu_links_checkList or ''}}"><a href="/bk_links/checkList"> 友情链接审核列表</a></li>
                </ul>
            </li>
            <li class="menu-list {{$menu_notice or ''}}">
                <a href=""><i class="fa fa-link"></i> <span>公告</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_notice_index or ''}}"><a href="/bk_notice"> 公告列表</a></li>
                    <li class="{{$menu_notice_add or ''}}"><a href="/bk_notice/add"> 添加公告</a></li>
                </ul>
            </li>
            <li class="menu-list {{$menu_system or ''}}">
                <a href=""><i class="fa fa-cogs"></i> <span>系统设置</span></a>
                <ul class="sub-menu-list">
                    <li class="{{$menu_system_maintain_home or 'disabled'}}"><a href="/bk_system/homemaintain"> 前台维护设置</a></li>
                    <li><a href="#"> 其他</a></li>
                </ul>
            </li>
            <li><a href="/bk_logout"><i class="fa fa-sign-in"></i> <span>退出</span></a></li>

        </ul>
        <!--sidebar nav end-->
    </div>
</div>
