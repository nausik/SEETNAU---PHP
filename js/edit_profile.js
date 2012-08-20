$(document).ready(function() {
	$('#submit_but').click(function() {
		$('#submit_but').hide();
		$.ajax({
			url : 'functions/edit_profile.php',
			type : 'POST',
			dataType : 'json',
			data : {
				password : $('#password_f').val(),
				password_new : $('#new_pwd').val(),
				password_new_rep : $('#new_pwd_2').val(),
				mail_new : $('#mail_f').val()
			},
			success : function(data) {
				$('#submit_but').show();
				$('#notification').show('fast');
				var text = "";
				if(data.mail_ok == true) {
					text += data.mail + '<br>';
				}
				if(data.passwords_ok == true) {
					text += data.passwords;
				}
				$('#notification').html(text);
			}
		});
	});
});
