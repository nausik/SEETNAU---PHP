$(document).ready(function() {
	$('#send_reg').click(function() {
		$('#send_reg').hide('fast');
		$('#notification').hide('fast');
		$.ajax({
			url : "functions/register.php",
			type : "POST",
			dataType: 'json',
			data : {
				mail : $('#mail_field').val(),
				username : $('#username_field').val(),
				password : $('#password_field').val(),
				password_2 : $('#rep_password_field').val(),
				question: $('#question').val(),
				answer: $('#answer').val()
			},
			success : function(data) {
				console.log(data);
				$('#notification').show('fast');
				$('#notification').text(data.answer);
				if(data.ok == true) {
					$('#reg_form').hide('fast');
				} else {
					$('#send_reg').show('fast');
				}
			}
		});
	});
});
