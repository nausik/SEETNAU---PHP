$(document).ready(function() {
	$('#submit_but').click(function() {
		$('#submit_but').hide();
		$.ajax({
			url : 'functions/login.php',
			dataType : 'json',
			type : 'POST',
			data : {
				username : $('#username_f').val(),
				password : $('#password_f').val()
			},
			success : function(data) {
				$('#notification').show('fast');
				$('#notification').text(data.answer);
				if(data.ok == true) {
					SetCookie("SEETNAU", data.post, 20);
					history.back();
				} else {
					$('#submit_but').show('fast');
				}
			}
		});
	});
});