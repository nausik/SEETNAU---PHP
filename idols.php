<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Idols</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/messages.css">
		<link type = "text/css" rel = "stylesheet" href = "css_styles/idols.css">
		<script language="javascript" src="js/idols.js"></script>
		<script></script>
	</head>
	<body>
		<?php
		include_once 'header.php';
		include_once 'config/msgs_list.php';
		$login = load_session();
		?>
		<div id="main">
			<div id = "notification"></div>
			<?php
			//check if user is already signed in
			if ($login === true) {
				$username = $_SESSION['username'];
				$chandle = mysql_connect($dbhost, $dbusername, $dbpassword);
				mysql_select_db($dbname, $chandle);
				echo '<div id = "i_f_categories">';
				echo '<ul>
		<li><a href="#idols_tab">Idols</a></li>
		<li><a href="#fans_tab">Fans</a></li>
			</ul>';
			echo '<div id = "idols_tab">';
			//Echo idols
				$idols_q = mysql_query("SELECT Idols FROM users WHERE Username = '$username'", $chandle);
				$idols_q_a = mysql_fetch_array($idols_q);
				$idols_ar = explode(";", $idols_q_a[0]);
				$list = "'". implode("', '", $idols_ar) ."'";
				$idols_q = mysql_query("SELECT * FROM users WHERE ID IN ($list)", $chandle);
				$idols_count = mysql_num_rows($idols_q);
				if ($idols_count > 0){
					while ($idol_obj = mysql_fetch_object($idols_q)) {
						$user_avatar = get_gravatar($idol_obj->Mail);
						$user_username = $idol_obj->Username;
						echo '<div class = "user_info_div">';
						echo '<div class = "left_side">';
						echo '<span class = "user_avatar"><img src = "' . $user_avatar . '" alt = "user avatar"></span>';
						echo '<span class = "user_username"><a href = "main.php?user=' . $user_username .'">' . $user_username . '</a></span>';
						echo '</div><div class = "right_side"><a class = "delete_idol" href = "#">x</a></div>';
						echo '</div>';
					}
				}
				//Echo fans
			echo '</div><div id = "fans_tab">';
				$fans_q = mysql_query("SELECT Fans FROM users WHERE Username = '$username'", $chandle);
				$fans_q_a = mysql_fetch_array($fans_q);
				$fans_ar = explode(";", $fans_q_a[0]);
				$fans_list = "'". implode("', '", $fans_ar) ."'";
				$fans_q = mysql_query("SELECT * FROM users WHERE ID IN ($fans_list)", $chandle);
				$fans_count = mysql_num_rows($fans_q);
				if ($fans_count > 0){
					while ($fan_obj = mysql_fetch_object($fans_q)) {
						$user_avatar = get_gravatar($fan_obj->Mail);
						$user_username = $fan_obj->Username;
						echo '<div class = "user_info_div">';
						echo '<div class = "left_side">';
						echo '<span class = "user_avatar"><img src = "' . $user_avatar . '" alt = "user avatar"></span>';
						echo '<span class = "user_username"><a href = "main.php?user=' . $user_username .'">' . $user_username . '</a></span>';
						echo '</div>';
						echo '</div>';
					}
				}
			echo '</div>';
				mysql_close($chandle);
			}
			?>
		</div>
	</body>
</html>