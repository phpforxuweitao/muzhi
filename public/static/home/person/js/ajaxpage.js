var curPage = 1;
var total, pageSize, totalPage;
function getData(page) {
	$.ajax({
		type: 'POST',
		url: '/ajax.php',
		data: {
			'pageNum': page - 1
		},
		dataType: 'json',
		beforeSend: function() {
			$("#product").append("<div id='loading'> \u52aa\u529b\u52a0\u8f7d\u4e2d...</div>");
		},
		success: function(json) {
			$("#product").empty();
			total = json.total;
			pageSize = json.pageSize;
			curPage = page;
			totalPage = json.totalPage;
			var li = "";
			var list = json.list;
			$.each(list, function(index, array) {

				li += "<li><span class='shop_img'><a href='/user/lipin/"+array.id+"/' target='_blank'><img src='"+array.pic+"' class='goods_pic'></a></span><span class='goods_title' title='"+array.product+"'>"+array.product+"</span><span class='my_fund goods_price'><i></i>"+array.scores+"</span><a href='/user/lipin/"+array.id+"/' target='_blank' class='exchange_goods'>兑换</a></li>";
			});
			$("#product").append(li);
		},
		complete: function() {
			getPageBar();
		},
		error: function() {
			$("#product").append("\u6570\u636e\u52a0\u8f7d\u5931\u8d25...")
		}
	});
}


function getPageBar() {

	if (curPage > totalPage) curPage = totalPage;

	if (curPage < 1) curPage = 1;
	pageStr = "<a>" + curPage + "/" + totalPage + "</a>";


	if (curPage == 1) {
		pageStr += "<a>首页</a><a>上一页</a>";
	} else {
		pageStr += "<span class='s_index'><a href='javascript:void(0)' rel='1'>首页</a></span><span class='s_s'><a href='javascript:void(0)' rel='" + (curPage - 1) + "'>\u4e0a\u4e00\u9875</a></span>";
	}

	if (curPage >= totalPage) {
		pageStr += "<a>下一页</a><a>尾页</a> <a>共" + total + "条</a>";
	} else {
		pageStr += "<span class='n_n'><a href='javascript:void(0)' rel='" + (parseInt(curPage) + 1) + "'>\u4e0b\u4e00\u9875</a></span><span class='m_m'><a href='javascript:void(0)' rel='" + totalPage + "'>\u5c3e\u9875</a></span> <!--span>共" + total + "\u6761</span-->";
	}

	$("#page").html(pageStr);
}

$(function() {
	getData(1);
	$("#page a").live('click', function() {
		var rel = $(this).attr("rel");
		if (rel) {
			getData(rel);
		}
	});
});



function downloads(obj)
 {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/login.php',
        data: {aid:obj.id},
        success: function(data) {
            if (data.login == 1)
            {

if(data.product==2)
{
	

		        $('#city_3').citySelect({prov:'江苏', city:'宿迁',dist:'沭阳县'});
				$("#_login").html("您好："+data.uname+",您的积分有"+data.scores+",可以兑换！");
				$(".forminfo").css("display", "block");
				$("#sp").html(obj.name);
}else
{
$("#_login").html("兑换<font color=red>"+obj.name+"</font>需要"+obj.rel+",您目前只有积分："+data.scores+"");
$(".forminfo").css("display", "none");
$(".box").css("height","130px");
$(".box").css("top","70%");

$("#sp").html(obj.name);
	}
  
            } else
            {
               $("#_login").html("<font color=red>您还没有登录,请登录后在来兑换！</font>");

  
  
  
  
            }
  
        }
  
    });
  
  
  
  
}
jQuery(document).ready(function($) {
$('#post').click(function(){
	
product=$.trim($("#product").val());
product_id=$.trim($("#product_id").val());
name=$.trim($("#name").val());
prov=$.trim($("#prov").val());
city=$.trim($("#city").val());
dist=$.trim($("#dist").val());
address=$.trim($("#address").val());
zip=$.trim($("#zip").val());
phone=$.trim($("#phone").val());

if(name =='')
{
	$("#n").html('<font color=red>* 姓名不能为空</font>');
	setTimeout(function () {$("#n").html("");}, 3000);	
	$("#name").focus();
	return false;
}
if(address =='')
{
	$("#add").html('<font color=red>* 详细地址不能为空</font>');
	setTimeout(function () {$("#add").html("");}, 3000);	
	$("#address").focus();
	return false;
}

if(phone =='')
{
	$("#p").html('<font color=red>* 手机号码不能为空</font>');
	setTimeout(function () {$("#p").html("");}, 3000);	
	$("#phone").focus();
	return false;
}


$.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/integral.php?dopost=dh',
        data: {product:product,name:name,prov:prov,city:city,dist:dist,address:address,zip:zip,phone:phone,product_id:product_id},
        success: function(data) {
			
			$("#_login").html(data.msg);
			setTimeout(function () {$("#_login").html("");}, 10000);

			
			
			        }
  
});
})
})
jQuery(document).ready(function($) {
	$('.btn_exchange').click(function(){
		$('.box2').fadeIn(100);
		$('.box').slideDown(200);
	})
	$('.top .close').click(function(){
		
		$('.box2').fadeOut(100);
		$('.box').slideUp(200);
		
	})

})
