$('.submitConfirm').on('click', function(){
	var form_id = $(this).closest('form').attr('id');
	$('#deleteButton').attr('form', form_id);
});

$('.order').on('click',function(){
	var sort_field = $(this).attr('field');
	var sort_type = $(this).attr('sort');
	if(sort_type == "" || sort_type == "desc"){
		sort_type = 'asc';
	}else{
		sort_type = 'desc';
	}
	$("#searchForm :input[name='field']").val(sort_field);
	$("#searchForm :input[name='type']").val(sort_type);
	$("#searchForm").submit();
});
$('.alert').fadeOut(3000);
