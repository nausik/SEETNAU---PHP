			function remove_message(text, id){
			$.ajax({
						url: "functions/remove_message.php",
						type: "POST",
						data : {
							ms_body: text,
							ms_id: id
						}
				});
			}


			$(document).ready(function() {
				$(".message_body").click(function() {
					var $e_parent = $(this).parent();
			        var r_name = $e_parent.children('.message_sender').text();
					var full_text = $e_parent.children(".full_message_text").text();
					var send_time = $e_parent.children(".post_date").text();
					$('#post_date').text(send_time);
					$("#full_rec_m").text(full_text);
			        $("#from_name").html("<b>Sender</b>: ");
					$("#from_name").text(r_name);
					$("#post_date").html($("#post_date").html() + "<hr>");
					$.ajax({
						url : 'functions/read_message.php',
						type : 'POST',
						data : {
							message_text: full_text
						}
					});
				});
				
				$(".delete_message").click(function(){
					var $e_parent = $(this).parent();
					var message_text = $e_parent.children('.message_div').children('.full_message_text').text();
					var ms_id = $e_parent.children('.message_div').children('.msid').text();
					remove_message(message_text, ms_id);
					$e_parent.remove();
				});
				
				$(".delete_s_message").click(function(){
					var $e_parent = $(this).parent();
					var message_text = $e_parent.children('.s_message_div').children('.full_s_message_text').text();
					var ms_id = $e_parent.children('.s_message_div').children('.s_msid').text();
					remove_message(message_text, ms_id);
					$e_parent.remove();
				});
				
				$(".s_message_body").click(function() {
					var $e_parent = $(this).parent();
			        var r_name = $e_parent.children('.s_message_receiver').text();
					var full_text = $e_parent.children(".full_s_message_text").text();
					var send_time = $e_parent.children(".post_date").text();
					$('#s_post_date').text(send_time);
					$("#full_sent_m").html('<p>' + full_text + '</p>');
			        $("#to_name").html("<b>Receiver</b>: ");
					$("#to_name").text(r_name);
					$("#s_post_date").html($("#s_post_date").html() + "<hr>");
				});
			});
			$(function() {
				$('#message_categories').tabs()
				
				$("#read_dialog").dialog({
					width : 450,
					height : 'auto',
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
										receiver : $('#from_name').text(),
										text : $('#m_message_text').val()
									},
									success : function(data) {
										if (data.ok == true){
											$("#read_dialog").dialog("close");
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
				
				$("#read_sent_dialog").dialog({
					autoOpen : false,
					modal : true
				});

				$(".message_body").click(function() {
					$("#read_dialog").dialog("open");
				});
				
				$(".s_message_body").click(function() {
					$("#read_sent_dialog").dialog("open");
				});
			});