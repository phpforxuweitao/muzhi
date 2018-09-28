//获得选中文件的文件名
function GetCheckfolderItem()
{
	var allSel='';
	if(document.form1.deleteid.value) return document.form1.deleteid.value;
	for(i=0;i<document.form1.deleteid.length;i++)
	{
		if(document.form1.deleteid[i].checked)
		{
			if(allSel=='')
			allSel=document.form1.deleteid[i].value;
			else
			allSel=allSel+","+document.form1.deleteid[i].value;
		}
	}
	return allSel;
}
	
	function DoSubmit(myfolder)
	{
		var selid = GetCheckfolderItem();
		if(selid=='') {
			alert("你没选中任何信息！");
			return false;
		}
		if(window.confirm("你确定要删除这些消息么？"))
		{
			location = "/user/message?dopost=del&ids="+selid+"&folder="+myfolder;
		}
	}