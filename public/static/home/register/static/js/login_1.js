
 $(document).ready(function(){
	//checkSubmit
	$('#regUser').submit(function () {
		if($('#txtUsername').val()=="")
		{
			$('#txtUsername').focus();
			alert("用户名不能为空！");
			return false;
		}
		
		if($('#userpwd').val()=="")
		{
			$('#userpwd').focus();
			alert("密码不能为空！");
			return false;
		}
		

		if($('#userpwdok').val()!=$('#userpwd').val())
		{
			$('#userpwdok').focus();
			alert("两次密码不一致！");
			return false;
		}
		
		if($('#uname').val()=="")
		{
			$('#uname').focus();
			alert("笔名不能为空！");
			return false;
		}
		if($('input:radio[name="sex"]:checked').val()==""){
			alert("请选择您的性别！");
			return false;
		}
		
		if($('#email').val()=="")
		{
			$('#email').focus();
			alert("QQ号不能为空！");
			return false;
		}else{
			var sEmail = /^([0-9]\d{4,9})$/; 
			if(!sEmail.exec($("#email").val()))
			{
				$('#_email').html("<font class='no'>QQ号输入有误</font>");
				$('#email').focus();
				return false;
			}
		}
		if($('#rsafeanswer').val()=="")
		{
			$('#rsafeanswer').focus();
			alert("请回答验证问题！");
			return false;
		}
//if($('#vdcode').val()=="")
//		{
//			$('#vdcode').focus();
//			alert("请填写验证码！");
//			return false;
//		}
if($('#yznum').val()=="")  
{  
$('#yznum').focus();  
alert("验证码未填写！");  
return false;  
}  

		if(!$('#agree').get(0).checked) {
			ZENG.msgbox.show("您必须同意注册协议", 5, 1500);
			return false;
		}
	})
	//AJAX 
	$("#txtUsername").change( function() {
		if($('#txtUsername').val().length < 4 || $('#txtUsername').val().length > 16 )
		{$('#_userid').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×要求4-16位</span>");
	    return false;}
		$.ajax({
			type: reMethod,
			url: "jiance.php",
			data: "dopost=checkuser&fmdo=user&cktype=1&uid="+$("#txtUsername").val(),
			dataType: 'html',
		success: function(result){$("#_userid").html(result);}}); 
	});
	$('#userpwd').change( function(){
	if($('#userpwd').val().length < 6 || $('#userpwd').val().length > 16 )
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×要求6-16位</span>");return false;
	}else if($('#userpwdok').val()!=$('userpwd').val())
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×密码不一致</span>");return false;
	}else if($('#userpwdok').val().length < 6 || $('#userpwdok').val().length > 16)
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×要求6-16位</span>");return false;
	}else{$('#_userpwdok,#_password').html("<span style='font-size:14px; color:#666; line-height:34px; background:#EDF7ED; padding:8px; border:#D6EAD3 1px solid'>√填写正确</span>");return false;}
	});
	$('#userpwdok').change( function(){
	if($('#userpwd').val().length < 6 || $('#userpwd').val().length > 16 )
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×要求6-16位</span>");return false;
	}else if($('#userpwdok').val()=='')
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×请输入确认密码</span>");return false;
	}else if($('#userpwdok').val()!=$('#userpwd').val())
	{$('#_userpwdok').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×密码不一致</span>");return false;
	}else{$('#_userpwdok,#_password').html("<span style='font-size:14px; color:#666; line-height:34px; background:#EDF7ED; padding:8px; border:#D6EAD3 1px solid'>√填写正确</span>");return false;}
	});
	
	
	$("#uname").change( function(){
	if($('#uname').val().length < 1 )
	{$('#_uname').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×名字太短</span>");return false;
	}else if($('#uname').val().length > 12 )
	{$('#_uname').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×不能大于12位</span>");return false;
	}else{$('#_uname').html("<span style='font-size:14px; color:#666; line-height:34px; background:#EDF7ED; padding:8px; border:#D6EAD3 1px solid'>√填写正确</span>");return false;}
	});
	$("#email").change( function() {
	var sEmail = /^([0-9]\d{4,9})$/;
	if(!sEmail.exec($("#email").val())){
	$('#_email').html("<span style='font-size:14px; color:#ff6600; line-height:34px; background:#FFF1DD; padding:8px; border:#FEE2BA 1px solid'>×QQ号输入有误</span>");
	$('#email').focus();
	}else{$('#_email').html("<span style='font-size:14px; color:#666; line-height:34px; background:#EDF7ED; padding:8px; border:#D6EAD3 1px solid'>√填写正确</span>");return false;}
	});

});
var reMethod = "POST",pwdmin = 6;
function changeAuthCode() {
	var num = 	new Date().getTime();
	var rand = Math.round(Math.random() * 10000);
	num = num + rand;
	$('#ver_code').css('visibility','visible');
	if ($("#vdimgck")[0]) {
		$("#vdimgck")[0].src = "../include/vdimgck.php?tag=" + num;
	}
	return false;	
}
function QQLogin(){var childWindow;childWindow=window.open("/qqapi/")};