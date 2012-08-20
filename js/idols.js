$(document).ready(function(){
	$('.delete_idol').click(function(){
	$parent_div = $(this).parent().parent();
	$idol_username = $parent_div.children('.left_side').children('.user_username').text();
	$.ajax({
		url: 'functions/remove_idol.php',
		type: 'POST',
		data: {
			idol: $idol_username
		},
		success: function(data){
			$parent_div.remove();
		}
	});
	});
});

$(function(){
	$('#i_f_categories').tabs()
});