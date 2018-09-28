$('.del').click(function(){
	id = $(this).parents('tr').find('td:first').html();
	// alert(id);
	s = $(this).parents('tr');
	$.get('/bk_links/dels',{id:id},function(data){
		if(data==1){
			alert('删除成功');
			s.remove();
		}else{
			alert('删除失败');
		}
	});
});