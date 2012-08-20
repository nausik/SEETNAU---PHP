$(document).ready(function() {
	$('#post_video').click(function() {
		$('#post_video').hide('fast');
		$('#notification').hide('fast');
		$.ajax({
			url : "functions/post_video.php",
			type : "POST",
			dataType : 'json',
			data : {
				link : $('#video_link').val(),
				title : $('#video_title').val(),
				description : $('#video_descr').val(),
				tags : $('#video_tags').val(),
			},
			success : function(data) {
				console.log(data);
				$('#notification').show('fast');
				$('#notification').text(data.answer);
				$('#post_video').show('fast');
			}
		});
	});
});
