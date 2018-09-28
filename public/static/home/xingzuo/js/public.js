var data_domain = "https://data.meiguoshenpo.com/";

if (/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))) {
    try {
        if (/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry|iPad/i.test(navigator.userAgent)) {
            window.location.href = window.location.href.replace("www.meiguoshenpo.com", "m.meiguoshenpo.com").toLowerCase();
        }
    } catch (e) { }
}
if (self != top) { top.location.href = self.location.href; }

var isIE = false;
if ($.browser.msie && $.browser.version < 10.0) { isIE = true; }

var _hmt = _hmt || [];
if (window.location.search.indexOf('sm_article_id') > 0) {
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?0262ef3deba82dd82c5bd4830b76ad98";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
} else {
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?e8541e53aba7521628343c972ecafeca";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
}

$(document).ready(function () {
    Nav_More_Select();
    Hide_Selector();
    Show_Page_Select();
    Search_Click();
    Scroll_Btn();
    Get_Home_List();
    Get_Index_List();
    Get_Index_List_MXZ();
    Get_Dashi_Article_List();
    Get_Up_Pic();
    Get_Up_Img();
    Get_Hot_Pic();
    Article_Hits();
    EWM_Btn();
});
$(window).load(function () {
    Info_Float();
    Uppic_Float();
});

//加入收藏
function AddFavorite(sURL, sTitle) {
    sURL = encodeURI(sURL);
    try {
        window.external.addFavorite(sURL, sTitle);
    } catch (e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e) {
            alert("请按 Ctrl+D 收藏");
        }
    }
}

//选中更多导航
function Nav_More_Select() {
    var obj = $("#NAV_MORE .cur");
    if (obj[0] == undefined) { return; }

    var name = obj.attr("val");
    $("#NAV_MORE span").html(name + "<i></i>")
    $("#NAV_MORE").addClass("cur")
}

//关闭所有选择器
function Hide_Selector() {
    $(document).click(function () {
        Hide_All_Selector();
    });
}
function Hide_All_Selector() {
    $(".select_sign").hide();
}

//文章内容分页跳转
function Show_Page_Select() {
    var obj = $('#SHOW_PAGE_SELECT');
    if (obj[0] == undefined) { return; }

    obj.change(function () {
        window.location.href = obj.val();
    });
}

//搜索框
function Search_Click() {
    var obj = $('#SEARCH_KEY');
    if (obj[0] == undefined) { return; }

    var oldVal = obj.val();
    obj.focus(function () {
        if (obj.val() == oldVal) {
            obj.val("");
        }
    });
    obj.blur(function () {
        if (obj.val() == "") {
            obj.val(oldVal);
        }
    });
}

//二维码
function EWM_Btn() {
    var ck = $.cookie("ewm_btn");
    if (ck) { return; }

    var scr_wid = window.screen.width;
    if (scr_wid < 1360) { return; }

    var mr = "610px";
    if(scr_wid <= 1440) {
        mr = "590px";
    }
    if(scr_wid <= 1366) {
        mr = "570px";
    }

    var obj = $("#SCROLL_EWM");
    if (obj.length == 0) {
        var html = '<div id="SCROLL_EWM" class="scroll_ewm" style="margin-right: ' + mr + ';"><i class="ewm_close"></i></div>';
        $("body").append(html);
        obj = $("#SCROLL_EWM");
    }

    obj.find("i").on("click", function () {
        obj.fadeOut();
        $.cookie("ewm_btn", "1", { expires: 1, path: '/' });
    });
}

//返回顶部
function Scroll_Btn() {
    var obj = $('#SCROLL_BTN');
    if (obj.length == 0) {
        var html = '<div id="SCROLL_BTN" class="scroll_btn">' +
                       '<a class="hm_btn" href="https://www.meiguoshenpo.com/" title="美国神婆星座网"></a>' +
                       '<a class="top_btn" href="javascript:;"></a>' +
                   '</div>';
        $("body").append(html);

        obj = $('#SCROLL_BTN');
    }

    $("#SCROLL_BTN .top_btn").click(function () {
        $("html,body").animate({ scrollTop: 0 });
    });

    Scroll_Btn_Action(obj);
    $(window).scroll(function () {
        Scroll_Btn_Action(obj);
    });
}
function Scroll_Btn_Action(obj) {
    var top = $(window).scrollTop();
    if (top > 588) {
        obj.fadeIn();
    } else {
        obj.fadeOut();
    }
}

//左侧：广告浮动
function Uppic_Float() {
    //浮动元素
    var float_obj = $('#UPPIC_FLOAT');
    if (float_obj[0] == undefined) { return; }

    float_obj.removeAttr("style");

    //距顶部距离
    var off_top = 44;

    //开始浮动位置
    var info_start = float_obj.offset().top - off_top;

    //停止浮动位置
    var parent_top = $('#UPPIC_BOX').offset().top;
    var parent_height = $('#UPPIC_BOX').height();
    var info_end = parent_top + parent_height - 620 - off_top;

    //滚动事件
    var scroH = $(window).scrollTop();
    Info_Float_Action(float_obj, scroH, info_start, info_end, off_top);

    $(window).scroll(function () {
        scroH = $(window).scrollTop();
        Info_Float_Action(float_obj, scroH, info_start, info_end, off_top);
    });
}
//右侧：广告浮动
function Info_Float() {
    //浮动元素
    var float_obj = $('#INFO_FLOAT');
    if (float_obj[0] == undefined) { return; }

    float_obj.removeAttr("style");

    //使左右两侧等高
    var h_left = $("#PAGE_LEFT").height();
    var h_right = $("#PAGE_RIGHT").height();
    if (h_left && h_right && h_left < h_right) {
        $("#PAGE_LEFT").height(h_right);
    }
    if (h_left && h_right && h_left > h_right) {
        $("#PAGE_RIGHT").height(h_left);
    }

    //是否有浮动导航
    var is_float_nav = float_obj.attr("fnav") ? 0 : 1;

    //距顶部距离（根据有无浮动导航决定）
    var off_top = is_float_nav == 1 ? 44 : 0;

    //开始浮动位置
    var info_start = float_obj.offset().top - off_top;

    //停止浮动位置
    var parent_top = $('#MAIN_DIV').offset().top;
    var parent_height = $('#MAIN_DIV').height();
    var info_end = parent_top + parent_height - 540 - off_top;

    //滚动事件
    var scroH = $(window).scrollTop();
    Info_Float_Action(float_obj, scroH, info_start, info_end, off_top);

    $(window).scroll(function () {
        scroH = $(window).scrollTop();
        Info_Float_Action(float_obj, scroH, info_start, info_end, off_top);
    });
}
function Info_Float_Action(float_obj, scroH, info_start, info_end, off_top) {
    if (info_start < scroH && scroH < info_end) {
        float_obj.removeAttr("style");
        float_obj.css({
            'position': 'fixed',
            'top': off_top + 'px'
        });
    } else if (scroH > info_end) {
        float_obj.removeAttr("style");
        float_obj.css({ 'position': 'absolute', 'bottom': '0px' });
    } else {
        float_obj.removeAttr("style");
    }
}

//上拉加载，区域btn, 数据源url, 自动加载页数max_page(0表示不限制)
function go_dropload(btn, url, max_page) {
    var pid = parseInt(btn.attr("pid")) + 1;
    if (pid > max_page && max_page > 0) {
        btn.off("click");
        btn.on("click", function () {
            get_drop_data(btn, url);
        });
        btn.show();
        return;
    }

    $(window).scroll(function () {
        if (Test_Height()) {
            get_drop_data(btn, url);
        }
    });
}

//加载数据
function get_drop_data(btn, url) {
    var loading = $('.load_more_style');
    if (loading.length == 0) {
        btn.after('<div class="load_more_style"><i></i>加载中...</div>');
        loading = $('.load_more_style');
    }

    loading.show();
    btn.hide();

    var query = "";
    var pid = parseInt(btn.attr("pid")) + 1;
    var data = {
        pid: pid
    };
    query = "?pid=" + pid;

    var btn_id = btn.attr("id");
    switch (btn_id) {
        case 'INDEXLIST_BTN':
        case 'INDEXLIST_MXZ_BTN':
            data = {
                pid: pid,
                cid: btn.attr("cid")
            };
            query = "?pid=" + pid + "&cid=" + btn.attr("cid");
            break;
        case 'DASHI_ARTICLE_LIST_BTN':
            data = {
                pid: pid,
                mid: btn.attr("mid")
            };
            query = "?pid=" + pid + "&mid=" + btn.attr("mid");
            break;
    }

    if (isIE) {
        $.getJSON(url + query + "&callback=?", function (result) {
            if (result.list) {
                btn.attr("pid", pid);
                btn.before(result.list);
                ReBind_Scroll();

                loading.hide();

            } else {
                loading.html("全部加载完毕").show();
            }
        });
        return;
    }

    $.ajax({
        type: "get",
        async: false,
        cache: true,
        url: url,
        data: data,
        dataType: 'jsonp',
        jsonp: "callback",
        jsonpCallback: "callbackdata",
        success: function (result) {
            if (result.list) {
                btn.attr("pid", pid);
                btn.before(result.list);
                ReBind_Scroll();

                loading.hide();

            } else {
                loading.html("全部加载完毕").show();
            }
        },
        error: function (xhr, type) {
            loading.html("发生错误，请刷新页面").show();
        }
    });
}

//首页：加载更多
function Get_Home_List() {
    var btn = $('#HOMELIST_BTN');
    if (btn.length == 0) { return; }

    var url = data_domain + "index_zonghe_list.aspx"
    go_dropload(btn, url, 5);
}

//频道：加载更多
function Get_Index_List() {
    var btn = $('#INDEXLIST_BTN');
    if (btn.length == 0) { return; }

    var url = data_domain + "index_list.aspx"
    go_dropload(btn, url, 5);
}

//某星座：加载更多
function Get_Index_List_MXZ() {
    var btn = $('#INDEXLIST_MXZ_BTN');
    if (btn.length == 0) { return; }

    var url = data_domain + "index_list_mxz.aspx"
    go_dropload(btn, url, 5);
}

//大师文章：加载更多
function Get_Dashi_Article_List() {
    var btn = $("#DASHI_ARTICLE_LIST_BTN");
    if (btn.length == 0) { return; }

    var url = data_domain + "dashi_article_list.aspx";
    go_dropload(btn, url, 5);
}

//左侧：为您推荐
function Get_Up_Pic() {
    var btn = $('#UPPIC_BTN');
    if (btn.length == 0) { return; }

    var pid = 2;
    var aid = $('#SHOW_TITLE').attr('aid');

    var btn_i = btn.find('i');
    var btn_span = btn.find('span');

    btn.click(function () {
        btn_i.addClass("load");
        btn_span.text("加载中，请稍后...");

        if (isIE) {
            $.getJSON(data_domain + "up_pic.aspx?pid=" + pid + "&aid=" + aid + "&callback=?", function (data) {
                btn.before(data.list);
                pid++;

                ReBind_Scroll();
                btn_i.removeClass("load");
                btn_span.text("加载更多推荐内容");
            });
            return;
        }

        $.ajax({
            type: "get",
            async: false,
            cache: true,
            url: data_domain + "up_pic.aspx",
            data: {
                aid: aid,
                pid: pid
            },
            dataType: 'jsonp',
            jsonp: "callback",
            jsonpCallback: "callbackdata",
            success: function (result) {
                btn.before(result.list);
                pid++;

                ReBind_Scroll();
                btn_i.removeClass("load");
                btn_span.text("加载更多推荐内容");
            },
            error: function () {
                btn_i.removeClass("load");
                btn_span.text("加载失败，请点击重试");
            }
        });
    });
}

//重新绑定Scroll
function ReBind_Scroll() {
    $(window).unbind("scroll");
    Scroll_Btn();
    Info_Float();
    Uppic_Float();
    Get_Home_List();
    Get_Index_List();
    Get_Index_List_MXZ();
    Get_Dashi_Article_List();
}

//左侧：精华推荐
function Get_Up_Img() {
    var obj = $('#UPIMG_BTN');
    if (obj[0] == undefined) { return; }

    var pid = 2;
    var aid = $('#SHOW_TITLE').attr('aid');

    obj.click(function () {
        $("#UPIMG_BOX ul").append('<div id="LOADING_IMG_1" style="position:absolute;top:0px;left:0px;background:#fff;filter:alpha(opacity=80);opacity:0.8;width:100%;height:100%;" onclick="$(this).remove();"><img style="margin:110px auto;" src="https://static.meiguoshenpo.com/style/img/loading.gif"></div>'); // 一个loading的正在加载gif图

        if (isIE) {
            $.getJSON(data_domain + "up_img.aspx?pid=" + pid + "&aid=" + aid + "&callback=?", function (data) {
                $("#UPIMG_BOX ul").html(data.list);
                pid++;
            });
            return;
        }

        $.ajax({
            type: "get",
            async: false,
            cache: true,
            url: data_domain + "up_img.aspx",
            data: {
                aid: aid,
                pid: pid
            },
            dataType: 'jsonp',
            jsonp: "callback",
            jsonpCallback: "callbackdata",
            success: function (result) {
                $("#UPIMG_BOX ul").html(result.list);
                pid++;
            },
            error: function () {
                $("#LOADING_IMG_1").remove();
            }
        });
    });
}

//右侧：精华阅读
function Get_Hot_Pic() {
    var obj = $('#HOTPIC_BTN');
    if (obj[0] == undefined) { return; }

    var pid = 2;
    obj.click(function () {
        $("#HOTPIC_BOX ul").append('<div id="LOADING_IMG_2" style="position:absolute;top:0px;left:0px;background:#fff;filter:alpha(opacity=80);opacity:0.8;width:100%;height:100%;" onclick="$(this).remove();"><img style="margin:110px auto;" src="https://static.meiguoshenpo.com/style/img/loading.gif"></div>'); // 一个loading的正在加载gif图

        if (isIE) {
            $.getJSON(data_domain + "hot_pic.aspx?pid=" + pid + "&callback=?", function (data) {
                $("#HOTPIC_BOX ul").html(data.list);
                pid++;
            });
            return;
        }

        $.ajax({
            type: "get",
            async: false,
            cache: true,
            url: data_domain + "hot_pic.aspx",
            data: {
                pid: pid
            },
            dataType: 'jsonp',
            jsonp: "callback",
            jsonpCallback: "callbackdata",
            success: function (result) {
                $("#HOTPIC_BOX ul").html(result.list);
                pid++;
            },
            error: function () {
                $("#LOADING_IMG_2").remove();
            }
        });
    });
}

//文章点击量统计
function Article_Hits() {
    var obj = $('#SHOW_TITLE');
    if (obj[0] == undefined) { return; }

    var aid = parseInt(obj.attr('aid'));
    var eid = parseInt(obj.attr('eid'));
    $("body").append('<script src="' + data_domain + 'hits.aspx?aid=' + aid + '&eid=' + eid + '" type="text/javascript"></script>');
}

//根据日期返回星座
function Get_Sign_By_Date(month, day) {
    month = parseInt(month);
    day = parseInt(day);

    var signID = 1;

    switch (month) {
        case 1:
            signID = day <= 20 ? 10 : 11;
            break;
        case 2:
            signID = day <= 19 ? 11 : 12;
            break;
        case 3:
            signID = day <= 20 ? 12 : 1;
            break;
        case 4:
            signID = day <= 20 ? 1 : 2;
            break;
        case 5:
            signID = day <= 21 ? 2 : 3;
            break;
        case 6:
            signID = day <= 21 ? 3 : 4;
            break;
        case 7:
            signID = day <= 23 ? 4 : 5;
            break;
        case 8:
            signID = day <= 23 ? 5 : 6;
            break;
        case 9:
            signID = day <= 23 ? 6 : 7;
            break;
        case 10:
            signID = day <= 23 ? 7 : 8;
            break;
        case 11:
            signID = day <= 22 ? 8 : 9;
            break;
        case 12:
            signID = day <= 21 ? 9 : 10;
            break;
    }

    return Get_Sign_By_ID(signID);
}

//根据ID返回星座
function Get_Sign_By_ID(signID) {
    signID = parseInt(signID);
    switch (signID) {
        case 1:
            chineseName = "白羊座";
            pinYinShort = "by";
            pinYinName = "baiyang";
            englishName = "aries";
            dateSub = "3月21日-4月20日";
            break;
        case 2:
            chineseName = "金牛座";
            pinYinShort = "jn";
            pinYinName = "jinniu";
            englishName = "taurus";
            dateSub = "4月21日-5月21日";
            break;
        case 3:
            chineseName = "双子座";
            pinYinShort = "sz";
            pinYinName = "shuangzi";
            englishName = "gemini";
            dateSub = "5月22日-6月21日";
            break;
        case 4:
            chineseName = "巨蟹座";
            pinYinShort = "jx";
            pinYinName = "juxie";
            englishName = "cancer";
            dateSub = "6月22日-7月23日";
            break;
        case 5:
            chineseName = "狮子座";
            pinYinShort = "shz";
            pinYinName = "shizi";
            englishName = "leo";
            dateSub = "7月24日-8月23日";
            break;
        case 6:
            chineseName = "处女座";
            pinYinShort = "cn";
            pinYinName = "chunv";
            englishName = "virgo";
            dateSub = "8月24日-9月23日";
            break;
        case 7:
            chineseName = "天秤座";
            pinYinShort = "tc";
            pinYinName = "tiancheng";
            englishName = "libra";
            dateSub = "9月24日-10月23日";
            break;
        case 8:
            chineseName = "天蝎座";
            pinYinShort = "tx";
            pinYinName = "tianxie";
            englishName = "scorpio";
            dateSub = "10月24日-11月22日";
            break;
        case 9:
            chineseName = "射手座";
            pinYinShort = "ss";
            pinYinName = "sheshou";
            englishName = "sagittarius";
            dateSub = "11月23日-12月21日";
            break;
        case 10:
            chineseName = "摩羯座";
            pinYinShort = "mj";
            pinYinName = "mojie";
            englishName = "capricorn";
            dateSub = "12月22日-1月20日";
            break;
        case 11:
            chineseName = "水瓶座";
            pinYinShort = "sp";
            pinYinName = "shuiping";
            englishName = "aquarius";
            dateSub = "1月21日-2月19日";
            break;
        case 12:
            chineseName = "双鱼座";
            pinYinShort = "sy";
            pinYinName = "shuangyu";
            englishName = "pisces";
            dateSub = "2月20日-3月20日";
            break;
    }

    var sign = {
        SignID: signID,
        ChineseName: chineseName,
        PinYinShort: pinYinShort,
        PinYinName: pinYinName,
        EnglishName: englishName,
        DateSub: dateSub
    };

    return sign;
}

//高度检测
function Test_Height() {
    var srollH = $(window).scrollTop(); //滚动条距顶部距离(页面超出窗口的高度)
    var winH = $(window).height();      //窗口的高度
    var domH = $(document).height();    //页面的高度

    if (domH - winH - srollH < 1) {
        return true
    } else {
        return false;
    }
}

//百度分享，详情页
function baidu_share(title, description, url) {
    document.writeln('<span style="float: left; display: inline-block; margin-right: 10px;">分享到</span>');
    document.writeln('<div class="bdsharebuttonbox">');
    document.writeln('<a class="bds_qzone" data-cmd="qzone"></a>');
    document.writeln('<a class="bds_weixin" data-cmd="weixin"></a>');
    document.writeln('<a class="bds_tsina" data-cmd="tsina"></a>');
    document.writeln('<a class="bds_baidu" data-cmd="baidu"></a>');
    document.writeln('<a class="bds_renren" data-cmd="renren"></a>');
    document.writeln('<a class="bds_douban" data-cmd="douban"></a>');
    document.writeln('<a class="bds_more" data-cmd="more"></a>');
    document.writeln('</div>');
    document.writeln('<script type="text/javascript">');
    document.writeln('window._bd_share_config = {');
    document.writeln('common: {');
    document.writeln('"bdText": "' + title + '",');
    document.writeln('"bdDesc": "' + description + '",');
    document.writeln('"bdUrl": "' + url + '"');
    document.writeln('},');
    document.writeln('share: [{');
    document.writeln('"bdSize": 24');
    document.writeln('}]');
    document.writeln('}');
    document.writeln('with (document) 0[(getElementsByTagName(\'head\')[0] || body).appendChild(createElement(\'script\')).src = \'https://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=\' + ~(-new Date() / 36e5)];');
    document.writeln('</script>');
}

//ajax
function callbackdata(arr) {
    console.log(arr);
}