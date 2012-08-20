<?php
function get_gravatar($email, $s = 80, $d = 'mm') {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s=$s&d=$d";
	return $url;
}

session_start();
include_once 'config/mysql_config.php';
include_once 'functions/load_session.php';
include_once 'functions/get_new_messages_c.php';

$login = load_session(); ?>
<link rel="stylesheet" href="css_styles/header.css" type="text/css">
<div id = "header">
<span id = "header_navigation">
<span id = "header_seetnau_title">seetnau</a>
<span id = "header_page_navigation">
<?php if ($login == True) {
	$avatar = get_gravatar($_SESSION['mail']);
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	echo '<span class = "hdr_nav_button"><a href = "main.php">' . $username . '</a></span>' . ' - <span class = "hdr_nav_button"><a href = "messages.php">Messages (' . get_messages_count() . ')</a></span> - <span class = "hdr_nav_button"><a href = "signout.php">Sign out</a></span>';
} else {
	echo '<span class = "hdr_nav_button"><a href = "signin.php">Sign in</a></span> - <span class = "hdr_nav_button"><a href = "signup.php">Sign up</a></span>';
}
?>
</span>
</span>
</div>