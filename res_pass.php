<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Restore password</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<script type = "text/javascript" src = "JS/res_pass.js"></script>
	</head>
	<body>
		<?php
		include_once 'config/msgs_list.php';
		include_once 'header.php';
		$login = load_session();
		$found = false;
		$question = "";
		if (isset($_GET['valc'])) {
			$varc = $_GET['valc'];
			$chandle = mysql_connect($dbhost, $dbusername, $dbpassword);
			mysql_select_db($dbname, $chandle);
			$search_code = mysql_query("SELECT * FROM users WHERE Password_rec = '$varc'", $chandle);
			if (mysql_num_rows($search_code) == 1) {
				$found = true;
				$user_obj = mysql_fetch_object($search_code);
				$question = base64_decode($user_obj -> Question);
			}
			mysql_close($chandle);
		}
		?>
		<div id = "main" align = "center">
			<div id = "notification"></div>
			<?php
			if ($login == False) {
				echo '<div id = "reg_form">';
				echo '<div id = "forms">';
				echo '<form name = "reset_pass">';
				echo '<div id = "secret_question">';
				if ($found == true) {
					echo $question;
					echo '</div>';
					$_SESSION['mail'] = $user_obj -> Mail;
					echo '<input type = "text" id = "secret_answer"><br>';
					echo '<input type = "button" id = "send_answer" value = "Answer">';
					echo '</form>';
					echo '</div>';
					echo '</div>';
				} else {
					echo $errors['account_not_found'];
					echo '</div>';
				}
			} else {
				echo '<h3>' . $errors['already_signed'] . '<h3>';
			}
			?>
			</form>
		</div>
	</body>
	<div id = "new_passes" title = "Reset password">
		<div id = "ui_notification"></div>
		Your new password
		<input type = "password" id = "new_pass">
		<br>
		Repeat your password
		<input type = "password" id = "new_pass_2">
		<br>
	</div>
</html>