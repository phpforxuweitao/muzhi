// JavaScript Document
function postDigg(ftype,aid)
{
	var taget_obj = document.getElementById('newdigg');
	var saveid = GetCookie('diggid');
	if(saveid != null)
	{
		var saveids = saveid.split(',');
		var hasid = false;
		saveid = '';
		j = 1;
		for(i=saveids.length-1;i>=0;i--)
		{
			if(saveids[i]==aid && hasid) continue;
			else {
				if(saveids[i]==aid && !hasid) hasid = true;
				saveid += (saveid=='' ? saveids[i] : ','+saveids[i]);
				j++;
				if(j==20 && hasid) break;
				if(j==19 && !hasid) break;
			}
		}
		if(hasid) { layer.msg('您刚才已表决过了喔！', function(){
//关闭后的操作
}); return; }
		else saveid += ','+aid;
		SetCookie('diggid',saveid,1);
	}
	else
	{
		SetCookie('diggid',aid,1);
	}
	myajax = new DedeAjax(taget_obj,false,false,'','','');
	var url = "/user/zan?action="+ftype+"&id="+aid;
	myajax.SendGet2(url);
}
function getDigg(aid)
{
	var taget_obj = document.getElementById('newdigg');
	myajax = new DedeAjax(taget_obj,false,false,'','','');
	myajax.SendGet2("/user/zan?id="+aid);
	DedeXHTTP = null;
}