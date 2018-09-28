$(document).ready(function () {
    select_sign();
    Yunshi_Hits();
});

//文章点击量统计
function Yunshi_Hits() {
    var obj = $('#YUNSHI_TITLE');
    if (obj[0] == undefined) { return; }

    var aid = parseInt(obj.attr('aid'));
    $("body").append('<script src="' + data_domain + 'yunshi_hits.aspx?aid=' + aid + '"  type="text/javascript"></script>');
}

//选择星座
function select_sign() {
    var sign_btn = $("#SELECT_SIGN_BTN");
    var sign_nav = $("#SIGN_NAV");

    sign_btn.click(function (e) {
        var is_show = sign_nav.css('display') != "none";
        if (is_show) {
            sign_nav.hide();
            sign_btn.removeClass("open");
        } else {
            sign_nav.show();
            sign_btn.addClass("open");
        }
    });
}