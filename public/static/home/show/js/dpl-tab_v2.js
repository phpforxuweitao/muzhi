(function($) {
    $.fn.extend({
        Scroll: function(opt, callback) {
            if (!opt) {
                var opt = {}
            }
            var timerID;
            var _this = this.eq(0).find("ul:first");
            var lineH = _this.find("li:first").height(),
            line = opt.line ? parseInt(opt.line, 10) : parseInt(this.height() / lineH, 10),
            speed = opt.speed ? parseInt(opt.speed, 10) : 450;
            timer = opt.timer;
            if (line == 0) {
                line = 1
            }
            var upHeight = 0 - line * lineH;
            var scrollUp = function() {
                _this.animate({
                    marginTop: upHeight
                },
                speed,
                function() {
                    for (i = 1; i <= line; i++) {
                        _this.find("li:first").appendTo(_this)
                    }
                    _this.css({
                        marginTop: 0
                    })
                })
            };
            var scrollDown = function() {
                for (i = 1; i <= line; i++) {
                    _this.find("li:last").show().prependTo(_this)
                }
                _this.css({
                    marginTop: upHeight
                });
                _this.animate({
                    marginTop: 0
                },
                speed,
                function() {})
            };
            var autoPlay = function() {
                if (timer) {
                    timerID = window.setInterval(scrollUp, timer)
                }
            };
            var autoStop = function() {
                if (timer) {
                    window.clearInterval(timerID)
                }
            };
            _this.hover(autoStop, autoPlay).mouseout()
        }
    })
})(jQuery);
$(document).ready(function() {
    $("#scrollDiv").Scroll({
        line: 1,
        speed: 500,
        timer: 2000
    })
});
var subMore = $(".nav2 .subNav-more2");
subMore.bind("mouseenter mouseleave",
function() {
    $(this).toggleClass("current")
});
String.prototype.Trim = function() {
    return this.replace(/(^\s*)|(\s*$)/g, "")
};
function nTabs(thisObj, Num) {
    if (thisObj.className == "active") {
        return
    }
    var tabObj = thisObj.parentNode.id;
    var tabList = document.getElementById(tabObj).getElementsByTagName("li");
    for (i = 0; i < tabList.length; i++) {
        if (i == Num) {
            thisObj.className = "active";
            document.getElementById(tabObj + "_Content" + i).style.display = "block"
        } else {
            tabList[i].className = "normal";
            document.getElementById(tabObj + "_Content" + i).style.display = "none"
        }
    }
}
$(document).ready(function() {
    $(window).scroll(function() {
        var top = $(document).scrollTop();
        var menu = $("#JfixNav");
        var items = $("#Jbody").find(".main");
        var curId = "";
        items.each(function() {
            var m = $(this);
            var itemsTop = m.offset().top;
            if (top > itemsTop - 100) {
                curId = "#" + m.attr("id")
            } else {
                return false
            }
        });
        var curLink = menu.find(".cur");
        if (curId && curLink.attr("href") != curId) {
            curLink.removeClass("cur");
            menu.find("[href=" + curId + "]").addClass("cur")
        }
    })
});

function CheckLogin() {
    var taget_obj = document.getElementById("_userlogin");
    myajax = new DedeAjax(taget_obj, false, false, "", "", "");
    myajax.SendGet2("/user/ajax");
    DedeXHTTP = null
}
function QQLogin() {
    var childWindow;
    childWindow = window.open("/qqapi/")
};
function tougao() {
    var childWindow;
    childWindow = window.open("/user/riji_add")
};

