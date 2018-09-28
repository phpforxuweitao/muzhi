function checkSubmit()
    {
	if(document.form1.title.value==""){
		clickautohide(2);
		document.form1.title.focus();
		return false;
	}
	if(document.form1.title.value=="无题")
	{
		clickautohide(5);
		document.form1.title.focus();
		return false;
	}
	if(document.form1.title.value=="请输入日记标题")
	{
		clickautohide(2);
		document.form1.title.focus();
		return false;
	}
	if(document.form1.typeid.value==0)
	{
		clickautohide(3)
		return false;
	}
	if(document.form1.typeid.options && document.form1.typeid.options[document.form1.typeid.selectedIndex].className!='option3')
	{
		var tip = "";switch(5){case 5:tip = "不能选择带颜色的栏目进行投稿！";break;}ZENG.msgbox.show(tip, 5, 3000);
		return false;
	}
	if(document.form1.body.value==""){
		document.form1.body.focus();
		var tip = "";switch(5){case 5:tip = "请输入内容，且字数为50字以上!";break;}ZENG.msgbox.show(tip, 5, 3000);
		return false;
	}else{
	str = document.form1.body.value;
	str = str.replace(/\n/g,"<br/>");
	document.form1.body.value = str;
	}
	if(document.form1.vdcode.value==""){
		document.form1.vdcode.focus();
		var tip = "";switch(5){case 5:tip = "请输入验证码！";break;}ZENG.msgbox.show(tip, 5, 3000);
		return false;
	}
	if(document.form1.safeanswer.value==""){
		document.form1.safeanswer.focus();
		alert("请输入验证问题！");
		return false;
	}	
}
$(function(){
         $("#btnSubmit").click(function(){
            var val=$('input:radio[name="source"]:checked').val();
  
			if($("#body").val() == '' || $("#body").val().length < 50 ){
			bwError("请输入内容，且字数为50字以上");
			$("#body").trigger('focus');
			return false;
		}
			if($("#body").val().length > 9999 ){
			bwError("内容字数过多，请控制在9999字以内");
			$("#body").trigger('focus');
			return false;
		}
		    var pic=litpic.value.substr(litpic.value.lastIndexOf(".")).toLowerCase();
			if(pic!='.jpg' && pic!='.png' && pic!='.gif' && pic!=''){
			var tip = "";switch(5){case 5:tip = "图片格式有误，请上传 jpg,png,gif 格式的图片";break;}ZENG.msgbox.show(tip, 5, 3000);
			return false;
			}
         });
	$("#body").keyup(function(){
		var obj = $(this);
		var bodyLength = obj.val().length;
		
		if(bodyLength < 9999){
			$("#counter").text(parseInt(bodyLength));	
		}else{
			bwError("内容字数过多，请控制在9999字以内");
		}
	});
});
function countChar(textareaName,spanName){
 document.getElementById(spanName).innerHTML=document.getElementById(textareaName).value.length;
}
function clickautohide(i) {
    var tip = "";
    switch (i) {
        case 2:
            tip = "标题不能为空";
            break;
        case 5:
            tip = "标题不能为无题";
            break;
        case 3:
            tip = "请选择投稿栏目";
            break;
    }
    ZENG.msgbox.show(tip, i, 2500);
};
function meiwentag() 
{ 
    document.form1.tags.value = document.form1.tags.value.replace(new RegExp('，',"gm"),','); 
    document.form1.tags.value = document.form1.tags.value.replace(new RegExp('。',"gm"),','); 
    document.form1.tags.value = document.form1.tags.value.replace(new RegExp('、',"gm"),','); 
    document.form1.tags.value = document.form1.tags.value.replace(new RegExp(' ',"gm"),','); 
        var curLength=$("#tags").val().length;   
        if(curLength>=20){  
            var num=$("#tags").val().substr(0,20);  
            $("#tags").val(num);  
			var tip = "";switch(5){case 5:tip = "标签超过字数限制，多出的字将被截断";break;}ZENG.msgbox.show(tip, 5, 3000);
        }  
        else{  
            $("#text").text(20-$("#tags").val().length)  
        }
}
function format(body){
        var message = "\n"+document.getElementById(body).value;
        message = message.replace(/　/ig,"");
		message = message.replace(/       /ig,"");
		message = message.replace(/      /ig,"");
		message = message.replace(/     /ig,"");
		message = message.replace(/    /ig," ");
		message = message.replace(/   /ig," ");
		message = message.replace(/  /ig," ");
		message = message.replace(/\r\n/ig,"\n");
        message = message.replace(/\n\n/ig,"\n");
        message = message.replace(/\n\n/ig,"\n");
        message = message.replace(/\n\n/ig,"\n");
        message = message.replace(/\n\n/ig,"\n");
        message = message.replace(/\n/,"　　");
        message = message.replace(/\n$/,"");
        message = message.replace(/\n/ig,"\n\n　　");
		message = message.replace(/　 /ig,"　");
		message = message.replace(",","，");
		message = message.replace("?","？");
		message = message.replace(".","。");
		message = message.replace(";","；");
		message = message.replace(":","：");
		message = message.replace("!","！");
        message = message.replace(/。。。。。。。。/g,"……");
        message = message.replace(/。。。。。。。/g,"……");
        message = message.replace(/。。。。。。/g,"……");
        message = message.replace(/。。。。。/g,"……");
        message = message.replace(/。。。。/g,"……");
        message = message.replace(/。。。/g,"……");
        message = message.replace(/。。/g,"。");
        message = message.replace(/～～～～～～～～/g,"……");
        message = message.replace(/～～～～～～～/g,"……");
        message = message.replace(/～～～～～～/g,"……");
        message = message.replace(/～～～～～/g,"……");
        message = message.replace(/～～～～/g,"……");
        message = message.replace(/～～～/g,"……");
        message = message.replace(/～～/g,"……");
        message = message.replace(/,,,,,,,,/g,"……");
        message = message.replace(/,,,,,,,/g,"……");
        message = message.replace(/,,,,,,/g,"……");
        message = message.replace(/,,,,,/g,"……");
        message = message.replace(/,,,,/g,"……");
        message = message.replace(/,,,/g,"……");
        message = message.replace(/,,/g,",");
        message = message.replace(/，，，，，，，，/g,"……");
        message = message.replace(/，，，，，，，/g,"……");
        message = message.replace(/，，，，，，/g,"……");
        message = message.replace(/，，，，，/g,"……");
        message = message.replace(/，，，，/g,"……");
        message = message.replace(/，，，/g,"……");
        message = message.replace(/，，/g,"，");
        message = message.replace(/\.\.\.\.\.\.\.\./g,"……");
        message = message.replace(/\.\.\.\.\.\.\./g,"……");
        message = message.replace(/\.\.\.\.\.\./g,"……");
        message = message.replace(/\.\.\.\.\./g,"……");
        message = message.replace(/\.\.\.\./g,"……");
        message = message.replace(/\.\.\./g,"……");
        message = message.replace(/\.\./g,".");
        message = message.replace(/~~~~~~~/g,"……");
        message = message.replace(/~~~~~~/g,"……");
        message = message.replace(/~~~~~/g,"……");
        message = message.replace(/~~~~/g,"……");
        message = message.replace(/~~~/g,"……");
        message = message.replace(/！！！！！/g,"！");
        message = message.replace(/！！！！/g,"！");
        message = message.replace(/！！！/g,"！");
        message = message.replace(/！！/g,"！");
        message = message.replace(/!!!!!!/g,"!");
        message = message.replace(/!!!!!/g,"!");
        message = message.replace(/!!!!/g,"!");
        message = message.replace(/!!!/g,"!");
        message = message.replace(/!!/g,"!");
        message = message.replace(/？？？？？？/g,"？");
        message = message.replace(/？？？？？/g,"？");
        message = message.replace(/？？？？/g,"？");
        message = message.replace(/？？？/g,"？");
        message = message.replace(/？？/g,"？");
        message = message.replace(/\?\?\?\?\?\?/g,"?");
        message = message.replace(/\?\?\?\?\?/g,"?");
        message = message.replace(/\?\?\?\?/g,"?");
        message = message.replace(/\?\?\?/g,"?");
        message = message.replace(/\?\?/g,"?");
        message = message.replace(/<</g,"《");
        message = message.replace(/>>/g,"》");
        message = message.replace(/``````/g,"……");
        message = message.replace(/````/g,"……");
        message = message.replace(/```/g,"……");
        message = message.replace(/``/g,"……");
        message = message.replace(/．．．．．．．．/g,"……");
        message = message.replace(/．．．．．．/g,"……");
        message = message.replace(/．．．．．．/g,"……");
        message = message.replace(/．．．．．/g,"……");
        message = message.replace(/．．．．/g,"……");
        message = message.replace(/．．．/g,"……");
        message = message.replace(/．．/g,"．");
        message = message.replace(/---------/g,"——");
        message = message.replace(/--------/g,"——");
        message = message.replace(/-------/g,"——");
        message = message.replace(/------/g,"——");
        message = message.replace(/-----/g,"——");
        message = message.replace(/----/g,"——");
        message = message.replace(/、、、、、、、、/g,"……");
        message = message.replace(/、、、、、、、/g,"……");
        message = message.replace(/、、、、、、/g,"……");
        message = message.replace(/、、、、、/g,"……");
        message = message.replace(/、、、、/g,"……");
        message = message.replace(/、、、/g,"……");
        message = message.replace(/、、/g," 、");
        message = message.replace(/········/g,"……");
        message = message.replace(/·······/g,"……");
        message = message.replace(/······/g,"……");
        message = message.replace(/·····/g,"……");
        message = message.replace(/····/g,"……");
        message = message.replace(/···/g,"……");
        message = message.replace(/··/g,"……");
        message = message.replace(/~！/g,"！");
        message = message.replace(/~!/g,"!");
//		message = message.replace(/\n/g,"<br/>");
        document.getElementById(body).value=message;
}
