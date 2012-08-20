<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html"; charset="UTF-8">
		<title>SEETNAU - Activate user</title>
		<link type="text/css" rel="stylesheet" href="css_styles/main.css">
		<link type = "text/css" rel = "stylesheet" href = "css_styles/notifes.css">
	</head>
	<body>
		<?php
		echo '<div id = "page">';
		include_once 'header.php';
		include_once 'config/msgs_list.php';
		echo '<div id = "main">';
		if ($login === false) {
			if (isset($_GET['valc']) === true) {
				$code = $_GET['valc'];
				$chandle = mysql_connect($dbhost, $dbusername, $dbpassword) or die(mysql_error());
				mysql_select_db($dbname, $chandle) or die(mysql_error());
				$find_code = mysql_query("SELECT * FROM users WHERE Activated = '$code'");
				$count = mysql_num_rows($find_code);
				if ($count == 1) {
					$a_user_info = mysql_fetch_object($find_code);
					$username = $a_user_info -> Username;
					$activate_acc = mysql_query("Update users SET Activated = 't' Where Username = '$username'");
					include_once "functions/signin.php";
					$cookiepost = base64_encode($username . '&' . $password);
					signin_user($username, $a_user_info -> Password, $a_user_info -> ID, $a_user_info -> Mail);
					mysql_close($chandle);
					echo $service_messages['account_activated'];
					header('Location: main.php?username=' . $username);
					exit() or die();
				} else {
					echo $errors['account_not_found'];
					mysql_close($chandle);
				}
			} else {
				echo $errors['account_not_found'];
			}
		} else {
			echo $errors['already_signed'];
		}
		echo '</div>';
		echo '</div>';
		?>
	</body>
</html>