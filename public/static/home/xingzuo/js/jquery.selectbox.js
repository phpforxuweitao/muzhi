/**
 *  eg:
 *  1、//class: selected 表示默认选中,如有多个selected默认选中第一个
 *  <selecte name="city">
 *		<option val="050101">苏州</option>
 *		<option val="050101" class="selected">无锡</option>
 *		<option val="050101" class="selected">常州</option>
 *	</selecte>
 *  $('[name="city"]').inputbox();
 * 
 * 2、若是添加id 或是 class，则直接在select添加，作为最外层的选择器.默认选择器为最外层：mgsp 默认子选择器：opts；
 * 
 */
document.writeln('<link href="https://static.meiguoshenpo.com/style/selectbox.css" rel="stylesheet" type="text/css" charset="utf-8" />');
(function($){
	var opts = {};
	var selectbox = {
		//初始化自定义selectbox
		init: function(o) {
			var $o = $(o),
				_name = $o.attr('name'),
				_selectValue = $o.find('.opts > span.selected').attr('val')? $o.find('.opts > span.selected').attr('val'):$o.find('.opts > span:first').attr('val'),
				_selectHtml = $o.find('.opts > span.selected').html()? $o.find('.opts > span.selected').html():$o.find('.opts > span:first').html();
				
			$o.addClass('mgsp');
			$o.append($('<input type="hidden" name="' + _name + '" value="' + _selectValue + '">'));
			$('<div class="selected">' + _selectHtml + '</div><i></i>').insertBefore($o.children(':first'));
			
			$o.children('.opts').show();
			var optsWidth = $o.width();
			var optsHeight = $o.height();
			
			$o.children('.opts').hide();
			$o.children('.opts').css('width', optsWidth + 10);
	
			$o.css({'line-height': optsHeight +'px'}).find('div.selected').css({'height': opts.height + 'px'});
			
			$o.click(selectbox.toggle);
			$o.find('.opts > span').css({"display":"block"})
			$o.find('.opts > span').click(selectbox.select).hover(selectbox.hover);
			$(document).click(selectbox.hide);

		},
		toggle: function(e) {
			e.stopPropagation();
			var $o = $(this);
			var $opts = $o.children('.opts');
			
			$o.css({"z-index":10,});
			$o.find('span.selected').removeClass('none');
			selectbox.hide(null, $('.mgsp').not($o));
			$o.toggleClass('mgsp_active');
			$opts.css({
				'width': Math.max($opts.width(), $o.width()),
			}).toggle($o.hasClass('mgsp_active'));

		},
		hide: function(e, objs) {
			var $o = objs ? objs : $('.mgsp');
			$o.css({"z-index":0})
			$o.removeClass('mgsp_active').children('.opts').hide().find('span.selected').removeClass('none');	
		},
		select: function(e) {
			e.stopPropagation();
			var $o = $(this).parents('.mgsp:first');
			$o.trigger('click');
			$o.find('span.selected').removeClass('selected');
			$(this).addClass('selected');
			$o.find('div.selected').html($(this).html());
			$o.find('input').val($(this).attr('val'));
		},
		hover: function(e){
			e.stopPropagation();
			var $o = $(this).parents('.mgsp:first');
			$o.find('span.selected').addClass('none');
		}
	};
	
	_transform = function(x){
		var span ="";
		var selbox;
		var tid;
		$(x+" option").each(function(){
			var nspan ='<span val="'+$(this).val()+'">'+$(this).html()+'</span>';
			span = span + nspan;
			$(this).remove();
			return span;
		});
		var ndiv ='<div class="opts">'+span+'</div>';
		var name = $(x).attr("name");
		if($(x).attr("class") != undefined ||$(x).attr("id") != undefined){
			if($(x).attr("id") != undefined){ tid = "id="+$(x).attr("id"); }
			else{ tid = ""; }
			if($(x).attr("class") != undefined){ tcls = "class="+$(x).attr("class"); }
			else{ tcls = ""; }
			selbox = $(x).replaceWith('<div '+tid+" "+tcls+' name="'+name+'" type="selectbox">');
		}
		else{
			selbox = $(x).replaceWith('<div name="'+name+'" type="selectbox">');
		}

		$(x).html(ndiv)
	};
	_init = function(o){
		var type = $(o).attr('type');
		if(type == 'selectbox'){
			selectbox.init(o);
		}
	};
	
	$.fn.inputbox = function(options){
		var selectName = this.selector;
		_transform(selectName);
        opts = $.extend({}, $.fn.inputbox.defaults, options);
        return this.each(function(){
            _init($(selectName));
        });
    };
})(jQuery);
