<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php
			include_once "config/incl_everywhere.html";
		?>
		<title>SEETNAU - Main page</title>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/message.css">
		<script language="javascript" src="js/main.js"></script>
		<script language="javascript" src="js/send_msg.js"></script>
	</head>
	<body>
		<?php
echo '<div id = "page">';
include_once 'header.php';

if ($login == True)
{
	try{
	
	}
	catch(Exception $e){
		echo $e;
	}
	
	if (!isset($_GET['user']))
	{
		$target_username = $username;
	}
	
	else
	{
		$target_username = mysql_real_escape_string($_GET['user']);
	}
	
	$target = get_target();
	
	if (!isset($_GET['user']))
	{
		header('Location: main.php?user=' . $username);
		exit() or die();
	}
		
	else
	{
		$target_username = $_GET['user'];
	}

	echo '<div id="main">';
	$chandle = mysql_connect($dbhost, $dbusername, $dbpassword);
	mysql_select_db($dbname, $chandle);
	//View user's profile
	if ($target_username == $username){
		$user_info_m = mysql_query("SELECT * FROM users WHERE Username = '$username'", $chandle);
		$user_info_o = mysql_fetch_object($user_info_m);
		$cur_jobs = $user_info_o->Jobs;
		echo '<div id = "user_info">';
		echo '<div id = "left_user_nav">';
		echo '<div id = "target_username">' . $username . '</div>';
		//Show avatar
		if ($avatar != "")
		{
			echo '<div id ="main_avatar">';
			echo '<img src = "'. $avatar . '" alt = "' . $username . ' avatar">';
			echo '</div>';
		}
		echo '<a href = "#" id = "sh_hd_jobs">Show jobs</a>';
		echo '<div id = "jobs_div">';
		echo '<div id = "only_jobs_div">';
		include_once 'functions/get_jobs.php';
		$ec_jobs = get_jobs($cur_jobs, true);
		echo $ec_jobs;
		echo '</div>';
		echo '<div id = "new_job">';
		echo '<input type = "text" id = "new_jb_t"><br>';
		echo '<input type = "button" id = "new_jb_b" value = "Add new job">';
		echo '</div>';
		echo '</div>';
		echo '<div id = "fans_count_div"><span id = "fans_count"></span> <a href = "idols.php#fans_tab" id = "f_text">fans</a></div>';
		echo '<div id = "idols_count_div"><span id = "idols_count"></span> <a href = "idols.php" id = "i_text">idols</a></div>';
		echo '</div>';
		echo '<div id = "right_user_navigation">';
		echo '<a href = "watch_video.php?user=' . $target_username . '">Watch videos</a>';
		echo '<br><a href = "post_video.php">Post video</a>';
		echo '<br><a href = "edit_profile.php">Edit profile</a>';
		echo '<br><a href = "friends.php">Friends</a>';
		echo '<br><a href = "search_user.php">Search users</a>';
		echo '</div>';
		echo '</div>';
	}
	//User not found
	elseif ($target == False){
		echo 'User not found';
	}
	//Show target user's profile
	else{
		include_once 'functions/check_fan.php';
		include_once "functions/check_friend.php";
		echo '<div id = "user_info">';
		echo '<div id = "left_user_nav">';
		$user_info_m = mysql_query("SELECT * FROM users WHERE Username = '$username'", $chandle);
		$user_info_o = mysql_fetch_object($user_info_m);
		$target_info_m = mysql_query("SELECT * FROM users WHERE Username = '$target_username'", $chandle);
		$target_info_o = mysql_fetch_object($target_info_m);
		$cur_jobs = $target_info_o->Jobs;
		//Check if target is user's idol
		$isfan = check_fans($user_info_o, $target_info_o);
		$target_requests = $target_info_o->Friend_requests;
		$target_avatar = get_gravatar($_SESSION['target_mail']);
		echo '<div id = "target_username">' . $target_username . '</div>';
		echo '<div id = "main_avatar"><img src="' . $target_avatar . '" alt = "' . $target_username . ' avatar"></div>';
		echo '<a href = "#" id = "sh_hd_jobs">Show jobs</a>';
		echo '<div id = "jobs_div">';
		echo '<div id = "only_jobs_div">';
		include_once 'functions/get_jobs.php';
		$ec_jobs = get_jobs($cur_jobs, false);
		echo $ec_jobs;
		echo '</div>';
		echo '</div>';
		echo '<div id = "fans_count_div"><span id = "fans_count"></span> <span id = "f_text">fans</span></div>';
		echo '<div id = "idols_count_div"><span id = "idols_count"></span> <span id = "i_text">idols</span></div>';
		echo '</div>';
		echo '<div id = "right_user_navigation">';
		//Search a friend list and show a friend request form (if not found)
		$cf_status = check_friend($target_requests, $user_info_o, $target_info_o);
		$isfriend = $cf_status['isfriend'];
		$isrequested = $cf_status['isrequested'];
		//If $isfriend is false and friend request wasn't send, then show a form
		echo '<div id = "user_nav">';
		if ($isfriend == False AND $isrequested == False)
		{
			echo '<div id = "target_rqsts">' . $target_requests . '</div>';
			echo '<a href = "#" id = "snd_frnd_reqst">Send a friend request</a>';
		}
		//Show friend profile navigation
		elseif ($isfriend == True)
		{
			echo '<a href = "watch_video.php?user=' . $target_username . '">Watch videos</a>';
			echo '<br>';
			echo '<a href = "#" class = "send_message_b">Send message</a>';
		}
		echo '<div id = "fan_cntrl">';
		if ($isfan === false){
			echo '<a href = "#" id = "bec_fan">Become a fan</a>';
		}else{
			echo '<a href = "#" id = "rem_fan">Unfan</a>';
		}
		echo '</div>';
		echo '</div>';
		//Send a friend request
		echo '</div>';
		echo '</div>';
	}
	
	mysql_close($chandle);
	echo '</div>';
}

else { ?>

<div id = "main" style = "text-align: center">
<h1>SEETNAU</h1>
<p>Have you ever wanted to be <strong>a musician, an actor or someone else, who's working in media sphere</strong>?
<br>Are you looking for people around you, who'd be <strong>interested</strong> in helping you with your media project?
<br>What are you waiting for?! <strong>SEETNAU</strong> is the <strong>perfect</strong> tool for this!</p>
</div>

<?php } ?>
</div>
		<!--Send message dialogue windows-->
<div id = "send_ms_dialog" title = "Send message">
	<div id = "ui_notification"></div>
	<div id = "to_name"></div>
	<form>
		Message:
	<br>
	<textarea name = "m_message_text" id = "m_message_text"></textarea>
	</form>
</div>
</body>
</html>