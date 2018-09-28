document.writeln("<div id=\'newExpertOldHtml\' class=\'new-expertOnlineOld\'>");
document.writeln("  <div class=\'new-expertOnlinebg\' id=\'newExpertOnlinebg\'></div>");
document.writeln("  <div class=\'new-expertOnline\' id=\'newExpertOnline\'>");
document.writeln("    <a href=\'javascript:vod;\' title=\'关闭侧边栏\' id=\'newExpOlClose\' class=\'new-expOlClose\' target=\'_self\'>×</a>");
document.writeln("    <div class=\'new-expertMidbox\'>");
document.writeln("      <!--<div id=\'newfix-dsp\'>");
document.writeln("        <iframe name=\'yl_resource_558\' src=\'../images/1489137555980_1_w90_h90_o.jpg\' border=\'0\' marginwidth=\'0\' marginheight=\'0\' scrolling=\'no\' width=\'85\' height=\'85\' frameborder=\'no\'></iframe>");
document.writeln("      </div>-->");
document.writeln("      <a href=\'javascript:vod;\' target=\'_self\' class=\'new-emlink new-emBotlink-1\'>");
document.writeln("        <span class=\'new-expert-icon\'></span>");
document.writeln("        <span class=\'new-expert-weixin-box\' style=\'left: -128px; display: none; opacity: 0; top:13%;\'>");
document.writeln("          <span class=\'new-expert-weixin-con\'>");
document.writeln("            <span class=\'arrow arrow-right arrow-edec\'></span>");
document.writeln("            <span class=\'arrow arrow-right arrow-white\'></span>");
document.writeln("          </span>");
document.writeln("        </span>");
document.writeln("      </a>");
document.writeln("    </div>");
document.writeln("  </div>");
document.writeln("  <div class=\'new-expertBotBox\'>");
document.writeln("    <a href=\'javascript:void(0);\' class=\'new-emlink new-emBotlink-3\' target=\'_self\' id=\'NewShareButton\'>");
document.writeln("      <span class=\'new-expert-icon\'></span>");
document.writeln("      <span class=\'new-expert-tip-box\'>");
document.writeln("        <span class=\'new-expert-tip-con\'>");
document.writeln("          <span class=\'arrow arrow-right arrow-edec\'></span>");
document.writeln("          <span class=\'arrow arrow-right arrow-white\'></span>分享");
document.writeln("        </span>");
document.writeln("      </span>");
document.writeln("    </a>");
document.writeln("    <a href=\'/user/riji_add\' class=\'new-emlink new-emBotlink-0\' target=\'_blank\' id=\'NewFbButton\'>");
document.writeln("      <span class=\'new-expert-icon\'></span>");
document.writeln("      <span class=\'new-expert-tip-box\' style=\'left: -90px; display: none; opacity: 0;\'>");
document.writeln("        <span class=\'new-expert-tip-con\'>");
document.writeln("          <span class=\'arrow arrow-right arrow-edec\'></span>");
document.writeln("          <span class=\'arrow arrow-right arrow-white\'></span>在线投稿");
document.writeln("        </span>");
document.writeln("      </span>");
document.writeln("    </a>");
document.writeln("    <a href=\'#\' class=\'new-emlink new-emBotlink-2\' target=\'_self\' id=\'toUp\'>");
document.writeln("      <span class=\'new-expert-icon\'></span>");
document.writeln("      <span class=\'new-expert-tip-box\' style=\'left: -90px; display: none; opacity: 0;\'>");
document.writeln("        <span class=\'new-expert-tip-con\'>");
document.writeln("          <span class=\'arrow arrow-right arrow-edec\'></span>");
document.writeln("          <span class=\'arrow arrow-right arrow-white\'></span>返回顶部");
document.writeln("        </span>");
document.writeln("      </span>");
document.writeln("    </a>");
document.writeln("  </div>");
document.writeln("</div>");

//// JQUERY PLUGIN - EASING
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})
function globalToTopFun(){//回到顶部功能
    var jQuerytoUp = jQuery('#toUp'),
        jQuerybodyHtml = jQuery('body,html');
    jQuerytoUp.off('click');
    jQuerytoUp.on('click',function(){
        //jQuerybodyHtml.animate({scrollTop:0},200); 
        jQuerybodyHtml.scrollTop(0);
		return false;
    });
};

function bindTipAni()
{
	jQuery(".new-emlink").hover(function(){
		tipShow(jQuery(".new-expert-tip-box",this));		
		tipShow(jQuery(".new-expert-weixin-box",this));				
	},function(){
		tipHiden(jQuery(".new-expert-tip-box",this));	
		tipHiden(jQuery(".new-expert-weixin-box",this));				
	});
	
	jQuery(".new-emMidlink-top").hover(function(){
		tipShow(jQuery(".new-expert-tip-box",this));					
	},function(){
		tipHiden(jQuery(".new-expert-tip-box",this));		
	});
	
};

function tipShow(jdom)
	{		
		if(jdom.length<1 ||jdom.is(":visible") ) return;
		jdom[0].showing=1;
		
		var pleft= jdom[0].pleft =  jdom[0].pleft || parseInt(jdom.css('left'),10) ;
		if(isNaN(pleft)) return;
		jdom.css({
			left: pleft - 85,

			display:"block",
			opacity:0
		});
		jdom.animate({
			left: pleft+"px",
			opacity:[1,"easeInQuad"]
		},200,'easeOutQuad',function(){
			jQuery(this).css({
				left: pleft,
				display:"block",
				opacity:1
			});
		});
	}
	function tipHiden(jdom)
	{
		if(jdom.length<1 )
		{
			return;
		}
		var pleft= jdom[0].pleft =  jdom[0].pleft || parseInt(jdom.css('left'),10) ;
		if(isNaN(pleft)) return;
		jdom.animate({
			left:  pleft - 85,
			opacity:[0,"easeOutQuad"]
		},100,'easeInQuad',function(){
			jQuery(this).css({
				display:"none",
				opacity:0,
				left:pleft
			})
		});
	}
	

//百度分享
function bdshareInit()
{
  var innercssA='padding:0;float: left;  width: 32px;  line-height: 32px;  height: 32px;  background-image: url(/static/api/img/share/icons_0_32.png?v=acc572ea.png);  background-repeat: no-repeat;  cursor: pointer;  margin: 6px 6px 6px 0;  text-indent: -100em;  overflow: hidden;  color: #3a8ceb;';
	var s = ['<div class="bdsharebuttonbox" data-tag="share_1" style="width: auto !important;">',
	             '<a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>',
				'<a class="bds_weixin" style="'+innercssA+'background-position: 0 -1612px;background-position: 0 -1612px !important;" data-cmd="weixin"></a>',
				'<a class="bds_qzone" style="'+innercssA+'background-position: 0 -52px;background-position: 0 -52px !important;"  data-cmd="qzone" href="#"></a>',
				'<a class="bds_tsina" style="'+innercssA+'background-position: 0 -104px;background-position: 0 -104px !important;" data-cmd="tsina"></a>',
				
				//'<a class="bds_tqq" style="'+innercssA+'background-position: 0 -260px;background-position: 0 -260px !important;" data-cmd="tqq"></a>',
				'<a class="bds_more" style="'+innercssA+'background: url(/static/api/img/share/icons_0_32.png?v=acc572ea.png)!important;  background-position: 0 0px!important;" data-cmd="more">更多</a>',
			'</div>'].join("");
	var bdshare= document.createElement("div");
	bdshare.id="bdshare_riji";	
	//bdshare.style.display="none";
	
	bdshare.innerHTML = s;
	jQuery("#NewShareButton").parent().append(bdshare);
	//document.body.appendChild(bdshare);
	jQuery(bdshare).css({
		display:"none",
		position:"absolute",
		"top":0,
		"left":"-200px",
		"width":"200px"
	});
	
	
	window._bd_share_config = {
		/**
		common : {
			bdText : '自定义分享内容',	
			bdDesc : '自定义分享摘要',	
			bdUrl : '自定义分享url地址', 	
			bdPic : '自定义分享图片'
		},
		image : [{
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '32',
			viewList : ['qzone','tsina','huaban','tqq','renren']
		}],
		selectShare : [{
			"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
		}]
		**/
		share : [{
			"bdSize" : 32
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	
	//jQuery("#NewShareButton").hover(function(){});
	jQuery("#NewShareButton").unbind("mouseenter").unbind("mouseleave"); 
	

	
	
	var handle = null;
	function hoverShow()
	{
		//jQuery("#bdshare_riji").show();
		jQuery(bdshare).css('top',jQuery("#NewShareButton").position().top);
		 tipShow(jQuery("#bdshare_riji"));
		if(handle)
		{
			clearTimeout(handle);
		}
	}
	function hoverHide()
	{
		handle = setTimeout(function(){			
						jQuery("#bdshare_riji").hide();	
						//tipHiden(jQuery("#bdshare_riji"));
		},200);	
	}
	
	jQuery("#NewShareButton").hover(hoverShow,hoverHide);
	jQuery("#bdshare_riji").hover(hoverShow,hoverHide);
	
}


jQuery(function(){	
	try{		   
        jQuery('#newExpOlClose').off('click');
        jQuery('#newExpOlClose').on('click',function(){   
            jQuery('#newExpertOnlinebg').hide();
            jQuery('#newExpertOnline').hide();
        });
		globalToTopFun();//执行回到顶部方法
		 bindTipAni();//tips动画初始化
		 bdshareInit();		
	}catch(e){
		jQuery("#newExpertOldHtml").hide();
	}	
});
