$(document).ready(function(){
	$('#start_search').click(function(){
		var search_info = $('#search_input').val();
		var search_type = $('#').val();
		var tags_checked = $('#tags_radio').is(":checked");
		$.ajax({
			url: 'functions\search_user_fn.php',
			data:{
			
			}
		});
	});
});