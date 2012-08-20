function get_fans(){
	$.ajax({
		type: "POST",
		url: "functions/fans_count.php",
		data: {
			type: 'Fans',
			username: $('#target_username').text()
		},
		success: function(data){
			$('#fans_count').text(data);
			if(data == "1"){
				$('#f_text').text("fan");
			}else{
				$('#f_text').text("fans");
			}
		}
	});
}

function get_idols(){
	$.ajax({
		type: "POST",
		url: "functions/fans_count.php",
		data: {
			type: 'Idols',
			username: $('#target_username').text()
		},
		success: function(data){
			$('#idols_count').text(data);
			if(data == "1"){
				$('#i_text').text("idol");
			}else{
				$('#i_text').text("idols");
			}
		}
	});
}

$(document).ready(function() {
	var append_start = '<div class = "job"><span class = "job_text">';
	var append_end = '</span><a  class = "delete_job" href = "#">x</a></div>';
	var bec_fan = '<a href = "#" id = "bec_fan">Become a fan</a>';
	var rem_fan = '<a href = "#" id = "rem_fan">Unfan</a>';
	get_fans();
	get_idols();
	
	$('.delete_job').live('click', function(){
		$parent_t = $(this).parent();
		$.ajax({
			url: 'functions/remove_job.php',
			type: 'POST',
			data:{
				job: $parent_t.children('.job_text').text()
			},
			success: function(data){
				$parent_t.remove();
			}
		});
	});
	
	$('#new_jb_b').click(function(){
		$.ajax({
			url: 'functions/add_job.php',
			type: 'POST',
			data:{
				new_job: $('#new_jb_t').val()
			},
			dataType: 'json',
			success: function(data){
			if (data.ok === true){
				$('#only_jobs_div').append(append_start + $('#new_jb_t').val() + append_end);
			}
				$('#new_jb_t').val('');
			}
		});
	});
	
	$('#sh_hd_jobs').click(function(){
		$('#jobs_div').toggle('fast');
		var hide_t = "Hide jobs";
		var show_t = "Show jobs";
		var $jobs_b = $('#sh_hd_jobs');
		if ($jobs_b.text() == show_t){
			$jobs_b.text(hide_t);
		}else{
			$jobs_b.text(show_t);
		}
	});
	
	$('#snd_frnd_reqst').click(function(){
		$.ajax({
			url: "functions/send_friend_req.php",
			dataType: "JSON",
			type: "POST",
			data:{
				requests: $('#target_rqsts').text()
			},
			success: function(data){
					$('#snd_frnd_reqst').hide('fast');
			}
		});
	});
	
	$('.send_message_b').click(function() {
		var p = $('#target_username').text();
			$("#to_name").text(p);
		});

	$('#bec_fan').live('click', function(){
		$.ajax({
			url: "functions/add_fan.php",
			success: function(data){
				$('#fan_cntrl').html(rem_fan);
				get_fans();
			}
		});
	});
	
		$('#rem_fan').live('click', function(){
		$.ajax({
			url: "functions/unfan.php",
			success: function(data){
				$('#fan_cntrl').html(bec_fan);
				get_fans();
			}
		});
	});
});