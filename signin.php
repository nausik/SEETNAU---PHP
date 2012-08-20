<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Login</title>
		<?php include_once "config/incl_everywhere.html"; ?>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/notifes.css">
		<script src = "js/cookies.js" type = "text/javascript"></script>
		<script language="javascript" src="js/signin.js"></script>
		<script language="javascript" src="js/rec_and_resend.js"></script>
	</head>
	<body>
		<?php 
		include_once 'header.php';
		include_once 'config/msgs_list.php';
		$login = load_session(); ?>
		<div id="main" align = "center">
			<div id = "notification"></div>
			<?php
			//check if user is already signed in
			if ($login == False) { ?>
				<div id = "forms">
				<form name = "login" method = "post" action = "signin.php">
Username: <input type = "text" name = "username" id = "username_f">
Password: <input type = "password" name = "password" id = "password_f">
<input id = "submit_but" type = "button" value = "Login">
</form>
</div>
			<?php include_once 'forms/recpw_resend.html';
			} else {
				echo $errors['already_signed'];
			} ?>
		</div>
		</div>
	</body>
</html>