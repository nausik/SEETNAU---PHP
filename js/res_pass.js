$(document).ready(function() {
	$('#send_answer').click(function() {
		$.ajax({
			url : "functions/check_answer.php",
			dataType : "json",
			type : "POST",
			data : {
				answer : $('#secret_answer').val(),
				mail : $('#mail_f').val()
			},
			success : function(data) {
				if(data.ok == true) {
					$('#new_passes').dialog('open');
				} else {
					$('#notification').show('fast');
					$('#notification').text(data.answer);
				}
			}
		});
	});
});
$(function() {
	$('#new_passes').dialog({
		width : 400,
		height : 270,
		autoOpen : false,
		modal : true,
		buttons : {
			"Change" : function() {
				$.ajax({
					url: "functions/change_pass.php",
					dataType: 'json',
					type: "POST",
					data:{
						n_password: $('#new_pass').val(),
						n_password_2: $('#new_pass_2').val(),
						answer: $('#secret_answer').val()
					},
					success: function(data){
						$('#ui_notification').show('fast');
						$('#ui_notification').text(data.answer);
					},
					error: function(a,b,c){console.log(a,b,c)}
				});
			}
		}
	});
});
