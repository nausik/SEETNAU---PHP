<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Signup</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<script language="javascript" src="js/signup.js"></script>
		<script language="javascript" src="js/rec_and_resend.js"></script>
	</head>
	<body>
		<?php
		include_once 'config/msgs_list.php';
		include_once 'header.php';
		$login = load_session();
		?>
		<div id = "main" align = "center">
			<div id = "notification"></div>
			<?php 
			if ($login == False) { ?> 
				<div id = "reg_form">
				<div id = "forms">
				<form name = "register">
Username<br>
<input id = "username_field" type = "text" name = "username">
<br>Mail<br>
<input id = "mail_field" type = "text" name = "mail">
<br>Password<br>
<input id = "password_field" type = "password" name = "password">
<br>Repeat password<br>
<input id = "rep_password_field" type = "password" name = "password_2">
<br>Secret Question<br>
<input id = "question" type = "text" name = "question">
<br>Answer<br>
<input id = "answer" type = "text" name = "answer">
<br>
<input type="button" value = "Register" id = "send_reg">
				</form>
				</div>
				</div>
				<?php include_once 'forms/recpw_resend.html';
			} else {
				echo '<h3>' . $errors['already_signed'] . '<h3>';
			}
			?>
			</form>
		</div>
	</body>
</html>