$(function() {
	$("#send_ms_dialog").dialog({
		width : 450,
		height : 350,
		autoOpen : false,
		modal : true,
		buttons : {
			"Send" : function() {
				if($('#m_message_text').val() != "") {
					$.ajax({
						url : 'functions/send_message.php',
						dataType : 'json',
						type : 'POST',
						data : {
							receiver : $('#to_name').text(),
							text : $('#m_message_text').val()
						},
						success : function(data) {
							
							if (data.ok == true){
								$("#send_ms_dialog").dialog("close");
								$('#notification').show('fast');
								$('#notification').text(data.answer);
							}
							else{
								$('#ui_notification').show('fast');
								$('#ui_notification').text(data.answer);
							}

						}
					});
				}
			}
		}

	});

	$(".send_message_b").click(function() {
		$("#send_ms_dialog").dialog("open");
	});
});