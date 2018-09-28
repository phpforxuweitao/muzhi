<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//前端
Route::get('/','Home\IndexController@index');
Route::group(['middleware' => 'homemaintain','namespace'=>'Home'],function() {
    Route::get('/', 'IndexController@index');
    Route::post('/addlinks','IndexController@addlinks'); //前台友情链接申请处理
    Route::get('/login', 'LoginController@login');//登录页面
    Route::post('/login_check', 'LoginController@login_check');//验证登录
    Route::get('/logout', 'LoginController@logout');//退出登录
    Route::get('/reg', 'LoginController@register');//进入注册页面
    Route::get('/registerActive/{id}/{token}','LoginController@registerActive');//激活用户
    Route::get('/forget','LoginController@forget');//进入忘记密码页面
    Route::post('/doforget','LoginController@doforget');//发送激活邮件，进入修改密码页面
    Route::get('/changepwd/{id}/{token}','LoginController@changePwd');//邮箱中的进入修改密码页面链接路由
    Route::post('/dochangepwd','LoginController@doChangePwd');//处理修改密码数据
    Route::post('/register_check', 'LoginController@registerCheck');//验证注册
    Route::post('/regCheckName','LoginController@checkName');//检测注册用户名
    Route::post('/regCheckNickname','LoginController@checkNickname');//检测注册笔名/妮称
    Route::post('/regCheckEmail','LoginController@checkEmail');//检测注册邮箱
    Route::post('/checkVcode','LoginController@checkVcode');//检测注册邮箱
    Route::post('/regSendMail','LoginController@regSendMail');//将验证码发送至 邮箱

    Route::get('/list/{id}','IndexController@list');
    Route::get('/index/show','IndexController@show');//前台公告 详情的AJAX

    Route::get('/list/{id}','ListController@index');//列表页面
    Route::get('/list/{id}/show','ListController@show');//详情页面
    Route::post('/digg','ListController@digg');// 传送参数digg为good时 为顶 | digg为bad时为 踩
    Route::get('/comment','CommentContorller@index');//评论AJAX
    Route::get('/recomment','CommentContorller@recomment'); //回复AJAX
    Route::get('/show_del','CommentContorller@del'); //ajax评论删除
    Route::get('/show_dels','CommentContorller@dels'); //ajax回复删除

    Route::get('/jokeList','ListController@jokeList');//进入笑话大全列表页面
    Route::post('/getJokeData','ListController@getJokeData');//获取笑话大全数据，默认获取第一页
    Route::get('/getXingzuo/{name}','ListController@xingzuo');//进入星座页面
    Route::get('/user/guanzhu','ListController@guanzhu');//关注用户

    //个人中心模块
    Route::group(['middleware' => 'HomeLogin','namespace' => 'Person'], function () {
        Route::get('ps_index', 'IndexController@index');//我的个人中心
        Route::get('ps_index/qiandao','IndexController@qiandao'); //个人中心是否签到
        Route::get('ps_riji', 'RijiController@index'); //日记投稿
        Route::post('ps_riji/doadd', 'RijiController@doadd'); //日记添加处理
        Route::get('ps_article', 'ArticleController@index'); //我的文章
        Route::get('ps_article/del/{id}', 'ArticleController@delete'); //删除日记
        Route::get('ps_qianming', 'QianmingController@index'); //个性签名
        Route::post('ps_qianming/doadd', 'QianmingController@doadd'); //个性签名添加处理
        Route::get('ps_guanzhu', 'GuanzhuController@index'); //粉丝关注
        Route::get('ps_guanzhu/fensi', 'GuanzhuController@fensi'); //粉丝关注
        Route::get('ps_guanzhu/quxiao/{id}','GuanzhuController@quxiao'); //取消关注
        Route::get('ps_qiandao','QiandaoController@index'); //签到记录
        Route::get('ps_msg','MsgController@index'); //修改资料页面
        Route::post('ps_msg/doedit','MsgController@doedit'); //处理修改
        Route::get('ps_pass','PassController@index'); //处理修改
        Route::post('ps_pass/doedit','PassController@doedit'); //处理修改
        Route::get('ps_space/{id}','SpaceController@index'); //个人空间主页
        Route::get('ps_space/gz/{id}','SpaceController@gz'); //个人空间内关注处理
        Route::get('ps_letter/in','LetterController@in'); //收件箱
        Route::get('ps_letter/out','LetterController@out'); //发件箱
        Route::get('ps_letter/send/{id}','LetterController@send'); //发送信件页
        Route::post('ps_letter/dosend','LetterController@dosend'); //信件处理
        Route::get('ps_letter/del/{id}','LetterController@delete'); //删除信件处理
    });
});

//后端
Route::group(['middleware'=>'login','namespace' => 'Admin'], function () {
    Route::get('bk_index', 'IndexController@index');//后台首页
    Route::get('bk_index/edit', 'IndexController@edit');//后台个人修改密码页
    Route::post('bk_index/update', 'IndexController@update');//后台个人修改密码操作

    //分类模块
    Route::get('bk_cates', 'CatesController@index');//分类模块列表页
    Route::get('bk_cates/add/{id?}', 'CatesController@add');//进入分类添加页面
    Route::post('bk_cates/doadd', 'CatesController@doadd');//执行分类添加数据操作
    Route::get('bk_cates/del-{id}', 'CatesController@delete');//处理分类删除
    Route::get('bk_cates/edit-{id}', 'CatesController@edit');//进入分类修改页面
    Route::post('bk_cates/doedit', 'CatesController@doedit');//处理分类修改数据
    Route::get('bk_cates/{id}/signhot', 'CatesController@signHot');//标记分类为热门分类
    Route::get('bk_cates/{id}/cancelhost', 'CatesController@cancelHot');//取消标记为热门分类

    //内容管理模块
    Route::get('bk_content/riji', 'ContentController@riji');//日记列表页面
    Route::get('bk_content/riji/add', 'ContentController@riji_add');//进入添加日记页面
    Route::post('bk_content/riji/saveriji', 'ContentController@save_riji');//保存日记
    Route::get('bk_content/riji/show/{id}', 'ContentController@riji_show')->where(['id' => '\d+']);//日记详情页面
    Route::get('bk_content/riji/del/{id}', 'ContentController@riji_del')->where(['id' => '\d+']);//日记删除
    Route::get('bk_content/riji/edit/{id}', 'ContentController@riji_edit')->where(['id' => '\d+']);//日记修改页面
    Route::post('bk_content/riji/rijieditsave', 'ContentController@riji_editsave');//保存日记修改
    Route::get('bk_content/riji/unpass/{id}', 'ContentController@riji_unpass')->where(['id' => '\d+']);//日记不通过审核
    Route::get('bk_content/riji/pass/{id}', 'ContentController@riji_pass')->where(['id' => '\d+']);//日记通过审核
    Route::get('bk_content/riji/vali', 'ContentController@riji_vali');//进入日记审核页面
    Route::get('bk_content/riji/unpasslist', 'ContentController@unpass_list');//进入未通过审核日记列表页面
    Route::get('bk_content/riji/{id}/recommand', 'ContentController@recommand');//根据id将内容标记为推荐内容
    Route::get('bk_content/riji/{id}/unrecommand', 'ContentController@unrecommand');//根据id取消内容标记为推荐内容


    // 前台会员模块
    Route::get('bk_users', 'UsersController@index');//会员列表
    Route::get('bk_users/create', 'UsersController@create');//会员添加页
    Route::post('bk_users/add', 'UsersController@add');//会员添加方法
    Route::get('bk_users/del/{id}', 'UsersController@del')->where(['id' => '\d+']);//会员删除
    Route::get('bk_users/open/{id}', 'UsersController@open')->where(['id' => '\d+']);//会员启用
    Route::get('bk_users/close/{id}', 'UsersController@close')->where(['id' => '\d+']);//会员禁用
    Route::get('bk_users/{id}/edit', 'UsersController@edit')->where(['id' => '\d+']);//会员修改页
    Route::post('bk_users/update', 'UsersController@update');//会员修改操作
    Route::get('bk_users/{id}/show', 'UsersController@show')->where(['id' => '\d+']);//会员详情页

    //轮播图模块
    Route::get('bk_lunbo', 'LunboController@index'); //轮播图列表页
    Route::get('bk_lunbo/add', 'LunboController@add'); //轮播图添加
    Route::post('bk_lunbo/doadd', 'LunboController@doadd'); //轮播图添加处理
    Route::get('bk_lunbo/del/{id}', 'LunboController@delete')->where(['id' => '\d+']); //处理删除
    Route::get('bk_lunbo/edit/{id}', 'LunboController@edit')->where(['id' => '\d+']); //轮播图修改页
    Route::post('bk_lunbo/doedit', 'LunboController@doedit'); //处理修改
    Route::get('bk_lunbo/change/{id}', 'LunboController@change')->where(['id' => '\d+']); //启用和禁用轮播图

    //广告模块
    Route::get('bk_ads', 'AdsController@index'); //广告列表页
    Route::get('bk_ads/add', 'AdsController@add'); //广告添加页
    Route::post('bk_ads/doadd', 'AdsController@doadd'); //广告添加处理
    Route::get('bk_ads/del/{id}', 'AdsController@delete')->where(['id' => '\d+']); //删除处理
    Route::get('bk_ads/edit/{id}', 'AdsController@edit')->where(['id' => '\d+']); //修改页面
    Route::post('bk_ads/doedit', 'AdsController@doedit'); //处理修改

    //友情链接模块
    Route::get('bk_links', 'LinksController@index'); //友情链接列表页
    Route::get('bk_links/add', 'LinksController@add'); //友情链接添加页
    Route::post('bk_links/doadd', 'LinksController@doadd'); //处理添加页
    Route::get('bk_links/del/{id}', 'LinksController@delete')->where(['id' => '\d+']); //删除处理
    Route::get('bk_links/edit/{id}', 'LinksController@edit')->where(['id' => '\d+']); //修改页面
    Route::post('bk_links/doedit', 'LinksController@doedit'); //处理修改
    Route::get('bk_link/change/{id}', 'LinksController@change'); // 启用/禁用链接
    Route::get('bk_links/dels', 'LinksController@del'); //ajax删除
    Route::get('bk_links/checkList', 'LinksController@checkList'); //友情链接审核

    //公告模块
    Route::get('bk_notice', 'NoticeController@index'); //公告列表页
    Route::get('bk_notice/add', 'NoticeController@add'); //公告添加页
    Route::post('bk_notice/doadd', 'NoticeController@doadd'); //添加处理
    Route::get('bk_notice/edit/{id}', 'NoticeController@edit'); //修改页面
    Route::post('bk_notice/doedit', 'NoticeController@doedit'); //处理修改
    Route::get('bk_notice/del/{id}', 'NoticeController@delete'); //处理删除
    Route::get('bk_notice/content/{id}', 'NoticeController@content'); //公告内容页
    Route::get('bk_notice/page', 'NoticeController@page'); //ajax分页

    //后台角色管理
    Route::get('bk_role', 'RoleController@index');//角色列表
    Route::get('bk_role/create', 'RoleController@create');//角色添加页
    Route::post('bk_role/add', 'RoleController@add');//角色添加方法
    Route::get('bk_role/del/{id}', 'RoleController@del')->where(['id' => '\d+']);//角色删除
    Route::get('bk_role/open/{id}', 'RoleController@open')->where(['id' => '\d+']);//角色启用
    Route::get('bk_role/close/{id}', 'RoleController@close')->where(['id' => '\d+']);//角色锁定
    Route::get('bk_role/{id}/edit', 'RoleController@edit')->where(['id' => '\d+']);//角色修改页
    Route::post('bk_role/update', 'RoleController@update');//角色修改操作
    Route::get('bk_role/{id}/node', 'RoleController@node')->where(['id' => '\d+']);//角色权限分配页
    Route::post('bk_role/donode', 'RoleController@donode');//角色权限分配操作

    // 后台权限管理
    Route::get('bk_node', 'NodeController@index');//权限列表
    Route::get('bk_node/create', 'NodeController@create');//权限添加页
    Route::post('bk_node/add', 'NodeController@add');//权限添加方法
    Route::get('bk_node/del/{id}', 'NodeController@del')->where(['id' => '\d+']);//权限删除
    Route::get('bk_node/open/{id}', 'NodeController@open')->where(['id' => '\d+']);//权限启用
    Route::get('bk_node/close/{id}', 'NodeController@close')->where(['id' => '\d+']);//权限锁定
    Route::get('bk_node/{id}/edit', 'NodeController@edit')->where(['id' => '\d+']);//权限修改页
    Route::post('bk_node/update', 'NodeController@update');//权限修改操作

    //后台管理员模块
    Route::get('bk_adminuser', 'AdminUserController@index');//管理员列表
    Route::get('bk_adminuser/create', 'AdminUserController@create');//管理员添加页
    Route::post('bk_adminuser/add', 'AdminUserController@add');//管理员添加方法
    Route::get('bk_adminuser/del/{id}', 'AdminUserController@del')->where(['id' => '\d+']);//管理员删除
    Route::get('bk_adminuser/open/{id}', 'AdminUserController@open')->where(['id' => '\d+']);//管理员启用
    Route::get('bk_adminuser/close/{id}', 'AdminUserController@close')->where(['id' => '\d+']);//管理员锁定
    Route::get('bk_adminuser/{id}/edit', 'AdminUserController@edit')->where(['id' => '\d+']);//管理员修改页
    Route::post('bk_adminuser/update', 'AdminUserController@update');//管理员修改操作
    Route::get('bk_adminuser/{id}/role', 'AdminUserController@role')->where(['id' => '\d+']);//管理员角色分配页
    Route::post('bk_adminuser/dorole', 'AdminUserController@dorole');//管理员角色分配操作
    Route::get('bk_adminuser/log', 'AdminUserController@log');//登录日志页面
    Route::get('bk_adminuser/logdel/{id}', 'AdminUserController@logdel')->where(['id' => '\d+']);//登录日志删除
    Route::post('bk_adminuser/getLogFile','AdminUserController@getLogFile');//日记记录以Excel文件导出

    //系统设置模块
    Route::get('/bk_system/homemaintain', 'SystemController@maintain_home');//前台维护页面
    Route::post('/bk_system/homemaintainDownUp', 'SystemController@homemaintainDownUp');//关闭/开启前台访问

    // 排版模块
    Route::get('/bk_layout','LayoutController@index');//排版列表
    Route::get('/bk_layout/{id}/edit','LayoutController@edit');//排版调整页
    Route::post('/bk_layout/update','LayoutController@update');//排版调整操作方法
    Route::get('/bk_layout/{id}/show','LayoutController@show');//排版详情
    Route::get('/bk_layout/{id}/img','LayoutController@img');//图片位设定页面
    Route::post('/bk_layout/doimg','LayoutController@doimg');//图片位设定方法

});

//后台登录模块
Route::get('bk_login', 'Admin\LoginController@index'); //后台登录页面

//后台登录处理
Route::post('bk_dologin', 'Admin\LoginController@dologin'); //后台登录处理
Route::get('bk_logout', 'Admin\LoginController@logout'); //后台退出登录



