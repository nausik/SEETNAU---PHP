$(document).ready(function() {
	$(".video_title").click(function() {
		$(this).next(".video_body").slideToggle("fast");
		return false;
	});
});

$(function() {
	$("#edit_video_dialog").dialog({
		position : 'absolute',
		height : 'auto',
		width : 450,
		modal : true,
		autoOpen : false,
		buttons : {
			"Save" : function() {
				$.ajax({
					url : 'functions/update_video.php',
					type : 'POST',
					dataType: 'json',
					data : {
						video_id : $('#video_id_d').text(),
						title : $('#video_title_d').val(),
						description : $('#video_descr_d').val(),
						url : $('#video_url_d').val(),
						tags : $('#video_tags_d').val()
					},
					success : function(data) {
						if(data.ok == true) {
							var text = $('#video_id_d').text();
							var $video_parent = $('.video_id_c').filter(function() {
								return $(this).text() === text;
							}).parent();
							$video_parent.parent().children('.video_title').html('<h3>' + $('#video_title_d').val() + '</h3>');
							$video_parent.children('.video_description').text($('#video_descr_d').val());
							$video_parent.children('.video_tags').text(data.tags);
							$video_parent.children('.video_url').text(data.url);
							console.log(data.url);
							$video_parent.children('.iframe_video').children('.yt_iframe_video').attr("src", data.url);
							$video_parent.children('.iframe_video').children('.yt_iframe_video').hide().show();
							$('#edit_video_dialog').dialog('close');
							$('#notification').show('fast');
							$('#notification').text(data.answer);
						} else {
							$('#ui_notification').show('fast');
							$('#ui_notification').text(data.answer);
						}
					}
				});
			}
		}

	});

	$('.ed_video').click(function() {
		var $t_parent = $(this).parent().parent();
		var d_val = $t_parent.children('.video_description').text();
		var tags_val = $t_parent.children('.video_tags').text();
		var video_url = $t_parent.children('.video_url').text();
		var video_id = $t_parent.children('.video_id_c').text();
		var t_val = $t_parent.parent().children('.video_title').text();
		$('#video_id_d').text(video_id);
		$('#video_title_d').val(t_val);
		$('#video_tags_d').val(tags_val);
		$('#video_descr_d').val(d_val);
		$('#video_url_d').val(video_url);
		$('#edit_video_dialog').dialog('open');
		return false;
	});

	$('.rem_video').click(function() {
		var $t_parent = $(this).parent().parent();
		$.ajax({
			dataType: 'json',
			type: 'POST',
			data: {
				id: $t_parent.children('.video_id_c').text()
			},
			url: 'functions/remove_video.php',
			success: function(data){
				if (data.ok == true){
					$t_parent.parent().remove();
				}
			}
		});
	});
});
