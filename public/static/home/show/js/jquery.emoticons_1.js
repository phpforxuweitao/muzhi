/**
 * jquery.emoticons.js 1.0
 * http://jquerywidget.com
 */
;(function (factory) {
    if (typeof define === "function" && (define.amd || define.cmd) && !jQuery) {
        // AMD或CMD
        define([ "jquery" ],factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = function( root, jQuery ) {
            if ( jQuery === undefined ) {
                if ( typeof window !== 'undefined' ) {
                    jQuery = require('jquery');
                } else {
                    jQuery = require('jquery')(root);
                }
            }
            factory(jQuery);
            return jQuery;
        };
    } else {
        //Browser globals
        factory(jQuery);
    }
}(function ($) {
    $.emoticons = function(parameter,getApi) {
        if(typeof parameter == 'function'){ //重载
            getApi = parameter;
            parameter = {};
        }else{
            parameter = parameter || {};
            getApi = getApi||function(){};
        }
        var defaults = {
            'prefix':'widget',
            'publisherCls':'publisher',
            'triggerCls':'trigger',
            'activeCls':'active',
            'path':'/image/',
            'list':[
                {'title':'微笑','url':'weixiao.gif'},
                {'title':'嘻嘻','url':'xixi.gif'},
                {'title':'哈哈','url':'haha.gif'},
                {'title':'可爱','url':'keai.gif'},
                {'title':'可怜','url':'kelian.gif'},
                {'title':'挖鼻','url':'wabi.gif'},
                {'title':'吃惊','url':'chijing.gif'},
                {'title':'害羞','url':'haixiu.gif'},
                {'title':'挤眼','url':'jiyan.gif'},
                {'title':'闭嘴','url':'bizui.gif'},
                {'title':'鄙视','url':'bishi.gif'},
                {'title':'爱你','url':'aini.gif'},
                {'title':'泪','url':'lei.gif'},
                {'title':'偷笑','url':'touxiao.gif'},
                {'title':'亲亲','url':'qinqin.gif'},
                {'title':'生病','url':'shengbing.gif'},
                {'title':'太开心','url':'taikaixin.gif'},
                {'title':'白眼','url':'baiyan.gif'},
                {'title':'右哼哼','url':'youhengheng.gif'},
                {'title':'左哼哼','url':'zuohengheng.gif'},
                {'title':'嘘','url':'xu.gif'},
                {'title':'衰','url':'shuai.gif'},
                {'title':'吐','url':'tu.gif'},
                {'title':'哈欠','url':'haqian.gif'},
                {'title':'抱抱','url':'baobao.gif'},
                {'title':'怒','url':'nu.gif'},
                {'title':'疑问','url':'yiwen.gif'},
                {'title':'馋嘴','url':'chanzui.gif'},
                {'title':'拜拜','url':'baibai.gif'},
                {'title':'思考','url':'sikao.gif'},
                {'title':'汗','url':'han.gif'},
                {'title':'困','url':'kun.gif'},
                {'title':'睡','url':'shui.gif'},
                {'title':'钱','url':'qian.gif'},
                {'title':'失望','url':'shiwang.gif'},
                {'title':'酷','url':'ku.gif'},
                {'title':'色','url':'se.gif'},
                {'title':'哼','url':'heng.gif'},
                {'title':'鼓掌','url':'guzhang.gif'},
                {'title':'晕','url':'yun.gif'},
                {'title':'悲伤','url':'beishang.gif'},
                {'title':'抓狂','url':'zhuakuang.gif'},
                {'title':'黑线','url':'heixian.gif'},
                {'title':'阴险','url':'yinxian.gif'},
                {'title':'怒骂','url':'numa.gif'},
                {'title':'互粉','url':'hufen.gif'},
                {'title':'书呆子','url':'shudaizi.gif'},
                {'title':'愤怒','url':'fennu.gif'},
                {'title':'感冒','url':'ganmao.gif'},
                {'title':'心','url':'xin.gif'},
                {'title':'伤心','url':'shangxin.gif'},
                {'title':'猪','url':'zhu.gif'},
                {'title':'熊猫','url':'xiongmao.gif'},
                {'title':'兔子','url':'tuzi.gif'},
                {'title':'OK','url':'ok.gif'},
                {'title':'耶','url':'ye.gif'},
                {'title':'GOOD','url':'good.gif'},
                {'title':'NO','url':'no.gif'},
                {'title':'赞','url':'zan.gif'},
                {'title':'来','url':'lai.gif'},
                {'title':'弱','url':'ruo.gif'},
                {'title':'草泥马','url':'caonima.gif'},
                {'title':'神马','url':'shenma.gif'},
                {'title':'囧','url':'jiong.gif'},
                {'title':'浮云','url':'fuyun.gif'},
                {'title':'给力','url':'geili.gif'},
                {'title':'围观','url':'weiguan.gif'},
                {'title':'威武','url':'weiwu.gif'},
                {'title':'话筒','url':'huatong.gif'},
                {'title':'蜡烛','url':'lazhu.gif'},
                {'title':'蛋糕','url':'dangao.gif'},
                {'title':'发红包','url':'fahongbao.gif'}
            ],
            'top':0,
            'left':0,
            'onShow':function(){},
            'onHide':function(){},
            'onSelect':function(){}
        };
        var options = $.extend({}, defaults, parameter);

        var _api = {};
        var $document = $(document);
        var $body = $('body');
        var $layer = $('<div class="'+options.prefix+'-layer">').appendTo($body);
        var $tool = $('<div class="'+options.prefix+'-tool"></div>').appendTo($layer);
        var $close = $('<a class="'+options.prefix+'-close" href="javascript:;" title="关闭">X</a>').appendTo($tool);
        var $panel = $('<div class="'+options.prefix+'-panel"></div>').appendTo($layer);
        var $list = $('<ul></ul>').appendTo($panel);
        var $trigger = null;
        var $textarea = null;
        var _hash = {};
        //结构处理
        $layer.css({
            'position':'absolute',
            'display':'none'
        });
        $.each(options.list,function(index,item){
            _hash[item.title] = options.path+item.url;
            $list.append('<li title="'+item.title+'"><img data-src="'+_hash[item.title]+'"/></li>');
        });
        //接口处理
        _api.getTextarea = function(){
            return $textarea;
        },
        _api.format = function(str){
            var list = str.match(/\[[\u4e00-\u9fa5]*\w*\]/g);
            var filter = /[\[\]]/g;
            var title;
            if(list){
                for(var i=0;i<list.length;i++){
                    title = list[i].replace(filter,'');
                    if(_hash[title]){
                        str = str.replace(list[i],' <img src="'+_hash[title]+'"/> ');
                    }
                }                
            }
            return str;
        };
        //关闭弹框
        var closeLayer = function(){
            if($trigger){
                $trigger.removeClass(options.activeCls);
            }
            $layer.hide();
            $trigger = null;
            $textarea = null;
            options.onHide();
        };
        //事件绑定
        $document.on('click','.'+options.triggerCls,function(){
            $trigger = $(this);
            var $publisher = $trigger.parents('.'+options.publisherCls);
            $textarea = $publisher.find('textarea');
            var offset = $trigger.offset();
            var height = $trigger.outerHeight();
            $trigger.addClass(options.activeCls);
            $layer.find('img').each(function(){
                var $this = $(this);
                $this.attr('src',$this.data('src'));
            });
            $layer.css({
                left: offset.left+options.left,
                top: offset.top+height+options.top
            }).show();
            options.onShow();
        });
        $document.on('click',function(e){
            var $target = $(e.target);
            if(!$target.is('.'+options.triggerCls)&&!$target.closest('.'+options.prefix+'-layer').length){
                closeLayer();
            }
        });
        $layer.on('click','.'+options.prefix+'-close',closeLayer);
        $layer.on('click','li',function(){
            var $this = $(this);
            var title = $this.attr('title');
            if($textarea){
                insertText($textarea[0],'['+title+']');
            }
            options.onSelect(_api);
        });
        //为了兼容insertText
        $document.on('select click keyup','.'+options.publisherCls+' textarea',function(){
            if (this.createTextRange){
                this.caretPos = document.selection.createRange().duplicate();
            }
        });
        //初始化
        getApi(_api);
        return this;
    };

    //插入文字
    function insertText(obj,str) {
        if(document.all && obj.createTextRange && obj.caretPos){ 
            var caretPos=obj.caretPos; 
            caretPos.text = caretPos.text.charAt(caretPos.text.length-1) == '' ? 
            str+'' : str; 
        }else if (typeof obj.selectionStart === 'number' && typeof obj.selectionEnd === 'number') {
            var startPos = obj.selectionStart,
                endPos = obj.selectionEnd,
                cursorPos = startPos,
                tmpStr = obj.value;
            obj.value = tmpStr.substring(0, startPos) + str + tmpStr.substring(endPos, tmpStr.length);
            cursorPos += str.length;
            obj.selectionStart = obj.selectionEnd = cursorPos;
        } else {
            obj.value += str;
        }
    }
}));

$(function() {
	
	//代替表情内容
	$.fn.extend({
		replaceContent : function(result){
		result = result.replace("[微笑]","<img src='images/faces/smilea.gif' addFacesPic='[微笑]' alt='微笑' title='微笑'/>").replace("[嘻嘻]","<img src='images/faces/tootha.gif' addFacesPic='[嘻嘻]' alt='嘻嘻' title='嘻嘻'/>").replace("[哈哈]","<img src='images/faces/laugh.gif' addFacesPic='[哈哈]' alt='哈哈' title='哈哈'/>").replace("[可爱]","<img src='images/faces/tza.gif' addFacesPic='[可爱]' alt='可爱' title='可爱'/>").replace("[可怜]","<img src='images/faces/kl.gif' addFacesPic='[可怜]' alt='可怜' title='可怜'/>").replace("[挖鼻屎]","<img src='images/faces/kbsa.gif' addFacesPic='[挖鼻屎]' alt='挖鼻屎' title='挖鼻屎'/>").replace("[吃惊]","<img src='images/faces/cj.gif' addFacesPic='[吃惊]' alt='吃惊' title='吃惊'/>").replace("[害羞]","<img src='images/faces/shamea.gif' addFacesPic='[害羞]' alt='害羞' title='害羞'/>").replace("[挤眼]","<img src='images/faces/zy.gif' addFacesPic='[挤眼]' alt='挤眼' title='挤眼'/>").replace("[闭嘴]","<img src='images/faces/bz.gif' addFacesPic='[闭嘴]' alt='闭嘴' title='闭嘴'/>").replace("[鄙视]","<img src='images/faces/bs2.gif' addFacesPic='[鄙视]' alt='鄙视' title='鄙视'/>").replace("[爱你]","<img src='images/faces/lovea.gif' addFacesPic='[爱你]' alt='爱你' title='爱你'/>").replace("[泪]","<img src='images/faces/sada.gif' addFacesPic='[泪]' alt='泪' title='泪'/>").replace("[偷笑]","<img src='images/faces/heia.gif' addFacesPic='[偷笑]' alt='偷笑' title='偷笑'/>").replace("[亲亲]","<img src='images/faces/qq.gif' addFacesPic='[亲亲]' alt='亲亲' title='亲亲'/>").replace("[生病]","<img src='images/faces/sb.gif' addFacesPic='[生病]' alt='生病' title='生病'/>").replace("[太开心]","<img src='images/faces/mb.gif' addFacesPic='[太开心]' alt='太开心' title='太开心'/>").replace("[懒得理你]","<img src='images/faces/ldln.gif' addFacesPic='[懒得理你]' alt='懒得理你' title='懒得理你'/>").replace("[右哼哼]","<img src='images/faces/yhh.gif' addFacesPic='[右哼哼]' alt='右哼哼' title='右哼哼'/>").replace("[左哼哼]","<img src='images/faces/zhh.gif' addFacesPic='[左哼哼]' alt='左哼哼' title='左哼哼'/>").replace("[嘘]","<img src='images/faces/x.gif' addFacesPic='[嘘]' alt='嘘' title='嘘'/>").replace("[衰]","<img src='images/faces/cry.gif' addFacesPic='[衰]' alt='衰' title='衰'/>").replace("[委屈]","<img src='images/faces/wq.gif' addFacesPic='[委屈]' alt='委屈' title='委屈'/>").replace("[吐]","<img src='images/faces/t.gif' addFacesPic='[吐]' alt='吐' title='吐'/>").replace("[打哈气]","<img src='images/faces/k.gif' addFacesPic='[打哈气]' alt='打哈气' title='打哈气'/>").replace("[抱抱]","<img src='images/faces/bba.gif' addFacesPic='[抱抱]' alt='抱抱' title='抱抱'/>").replace("[怒]","<img src='images/faces/angrya.gif' addFacesPic='[怒]' alt='怒' title='怒'/>").replace("[疑问]","<img src='images/faces/yw.gif' addFacesPic='[疑问]' alt='疑问' title='疑问'/>").replace("[馋嘴]","<img src='images/faces/cza.gif' addFacesPic='[馋嘴]' alt='馋嘴' title='馋嘴'/>").replace("[拜拜]","<img src='images/faces/88.gif' addFacesPic='[拜拜]' alt='拜拜' title='拜拜'/>").replace("[思考]","<img src='images/faces/sk.gif' addFacesPic='[思考]' alt='思考' title='思考'/>").replace("[汗]","<img src='images/faces/sweata.gif' addFacesPic='[汗]' alt='汗' title='汗'/>").replace("[困]","<img src='images/faces/sleepya.gif' addFacesPic='[困]' alt='困' title='困'/>").replace("[睡觉]","<img src='images/faces/sleepa.gif' addFacesPic='[睡觉]' alt='睡觉' title='睡觉'/>").replace("[钱]","<img src='images/faces/money.gif' addFacesPic='[钱]' alt='钱' title='钱'/>").replace("[失望]","<img src='images/faces/sw.gif' addFacesPic='[失望]' alt='失望' title='失望'/>").replace("[酷]","<img src='images/faces/cool.gif' addFacesPic='[酷]' alt='酷' title='酷'/>").replace("[花心]","<img src='images/faces/hsa.gif' addFacesPic='[花心]' alt='花心' title='花心'/>").replace("[哼]","<img src='images/faces/hatea.gif' addFacesPic='[哼]' alt='哼' title='哼'/>").replace("[鼓掌]","<img src='images/faces/gza.gif' addFacesPic='[鼓掌]' alt='鼓掌' title='鼓掌'/>").replace("[晕]","<img src='images/faces/dizzya.gif' addFacesPic='[晕]' alt='晕' title='晕'/>").replace("[悲伤]","<img src='images/faces/bs.gif' addFacesPic='[悲伤]' alt='悲伤' title='悲伤'/>").replace("[抓狂]","<img src='images/faces/crazya.gif' addFacesPic='[抓狂]' alt='抓狂' title='抓狂'/>").replace("[黑线]","<img src='images/faces/h.gif' addFacesPic='[黑线]' alt='黑线' title='黑线'/>").replace("[阴险]","<img src='images/faces/yx.gif' addFacesPic='[阴险]' alt='阴险' title='阴险'/>").replace("[怒骂]","<img src='images/faces/nm.gif' addFacesPic='[怒骂]' alt='怒骂' title='怒骂'/>").replace("[心]","<img src='images/faces/hearta.gif' addFacesPic='[心]' alt='心' title='心'/>").replace("[伤心]","<img src='images/faces/unheart.gif' addFacesPic='[伤心]' alt='伤心' title='伤心'/>");
		$(this).html(content);
		}		
	})	
	//插入光标处的插件
	$.fn.extend({  
		insertContent : function(myValue, t) {  
			var $t = $(this)[0];  
			if (document.selection) {  
				this.focus();  
				var sel = document.selection.createRange();  
				sel.text = myValue;  
				this.focus();  
				sel.moveStart('character', -l);  
				var wee = sel.text.length;  
				if (arguments.length == 2) {  
				var l = $t.value.length;  
				sel.moveEnd("character", wee + t);  
				t <= 0 ? sel.moveStart("character", wee - 2 * t	- myValue.length) : sel.moveStart("character", wee - t - myValue.length);  
				sel.select();  
				}  
			} else if ($t.selectionStart || $t.selectionStart == '0') {  
				var startPos = $t.selectionStart;  
				var endPos = $t.selectionEnd;  
				var scrollTop = $t.scrollTop;  
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos,$t.value.length);  
				this.focus();  
				$t.selectionStart = startPos + myValue.length;  
				$t.selectionEnd = startPos + myValue.length;  
				$t.scrollTop = scrollTop;  
				if (arguments.length == 2) { 
					$t.setSelectionRange(startPos - t,$t.selectionEnd + t);  
					this.focus(); 
				}  
			} else {                              
				this.value += myValue;                              
				this.focus();  
			}  
		}  
	})  
});
