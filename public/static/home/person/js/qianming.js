//获得选中文件的文件名
function GetCheckfolderItem()
{
	var allSel='';
	if(document.form1.selid.value) return document.form1.selid.value;
	for(i=0;i<document.form1.selid.length;i++)
	{
		if(document.form1.selid[i].checked)
		{
			if(allSel=='')
			allSel=document.form1.selid[i].value;
			else
			allSel=allSel+","+document.form1.selid[i].value;
		}
	}
	return allSel;
}

function DelSel(ftype)
{
	var selid = GetCheckfolderItem();
	if(selid=='') {
		alert("你没选中任何好友！");
		return false;
	}
	if(window.confirm("你确定要删除这些好友么？"))
	{
		location = "myfriend.php?dopost=del&ids="+selid+"&ftype="+ftype;
	}
}

function ConvSta(sta,ftype)
{
	var selid = GetCheckfolderItem();
	var stamsg = '';
	if(selid=='') {
		alert("你没选中任何好友！");
		return false;
	}

	if(sta=='good') stamsg = '加入关注的好友';
	else if(sta=='bad') stamsg = '加入黑名单';
	else stamsg = '改为普通好友';

	if(window.confirm("你确定要把这些好友"+stamsg+"么？"))
	{
		location = "myfriend.php?dopost=upsta&sta="+sta+"&ids="+selid+"&ftype="+ftype;
	}
}

function EditMemberGroup(mid)
{
   var taget_obj = document.getElementById('mgp'+mid);
   var myajax = new DedeAjax(taget_obj,false,false,"","","");
   myajax.SendGet2("ajax_membergroup.php?action=show&mid="+mid);
   DedeXHTTP = null;
}

function postMemberGroup(mid){
   obj = document.getElementById('mgp'+mid);
   v = document.getElementById('m_'+mid).value;
   var myajax = new DedeAjax(obj,false,false,"","","");
      myajax.AddKeyUtf8('action','post');
   myajax.AddKeyUtf8('mid',mid);
   myajax.AddKeyUtf8('membergroup',v);
   myajax.SendPost2('ajax_membergroup.php');
      DedeXHTTP = null;
}

function EditDescription(mid)
{
   var taget_obj = document.getElementById('des'+mid);
   var myajax = new DedeAjax(taget_obj,false,false,"","","");
   myajax.SendGet2("ajax_membergroup.php?action=desshow&mid="+mid);
   DedeXHTTP = null;
}

function postDescription(mid){
   obj = document.getElementById('des'+mid);
   v = document.getElementById('m_'+mid).value;
   var myajax = new DedeAjax(obj,false,false,"","","");
      myajax.AddKeyUtf8('action','post');
   myajax.AddKeyUtf8('mid',mid);
   myajax.AddKeyUtf8('mdescription',v);
   myajax.SendPost2('ajax_membergroup.php');
      DedeXHTTP = null;
}