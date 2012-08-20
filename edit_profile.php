<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Edit profle</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/notifes.css">
		<script language="javascript" src="js/edit_profile.js"></script>
	</head>
	<body>
		<?php
		include_once 'header.php';
		$login = load_session();
		?>
		<div id="main">
			<div id = "notification"></div>
			<?php
			if ($login == True) {
				echo '<div id = "forms">';
				echo '<form name = "edit_user" method = "POST" action = "edit_profile.php">
Current password<br><input type = "password" name = "old_pwd" id = "password_f">
<hr>
<br>
New password<br><input type = "password" name = "new_pwd" id = "new_pwd">
<br>
Repeat new password<br><input type = "password" name = "new_pwd_2" id = "new_pwd_2">
<br>
New mail<br><input type = "text" name = "mail" id = "mail_f">
<br>
<input type="button" value = "Save" id = "submit_but">
</form>';
				echo '</div>';
			}
			?>
		</div>
	</body>
</html>