$(function() {
	$('#forgot_password').dialog({
		width : 400,
		height : 270,
		autoOpen : false,
		modal : true,
		buttons : {
			"Recover" : function() {
				if($('#rec_mail').val() != "") {
					$.ajax({
						url : 'functions/restore_pass.php',
						type : 'POST',
						dataType : 'json',
						data : {
							mail : $('#rec_mail').val()
						},
						success : function(data) {
							$('#ui_notification').show('fast');
							$('#ui_notification').text(data.answer);
						}
					});
				}

			}
		}
	});

	$('#resend_mail').dialog({
		width : 400,
		height : 270,
		autoOpen : false,
		modal : true,
		buttons : {
			"Send" : function() {
				$.ajax({
					type: "POST",
					dataType: "JSON",
					data:{
						mail: $('#resend_pass').val()
					},
					url: "functions/resend_confirmation.php",
					success: function(data){
						$('#ui_notification_2').show('fast');
						$('#ui_notification_2').text(data.answer);
					}
				});
			}
		}
	});

	$('#forgot_password_but').click(function() {
		$('#forgot_password').dialog('open');
	});

	$('#resend_but').click(function() {
		$('#resend_mail').dialog('open');
	});
});
