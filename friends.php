<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Friends</title>
		<?php
			include_once "config/incl_everywhere.html";
		?>
		<link type="text/css" rel="stylesheet" href="css_styles/friends.css">
		<link type = "text/css" rel = "stylesheet" href = "css_styles/message.css">
		<script language="javascript" src="js/friends.js"></script>
		<script language="javascript" src="js/send_msg.js"></script>
	</head>
	<body>
		<div id = "wrap">
			<?php
			include_once 'header.php';
			?>

			<div id="main">
				<div id = "notification"></div>
				<?php
				$login = load_session();
				if ($login == True) {

					$chandle = mysql_connect($dbhost, $dbusername, $dbpassword) or die(mysql_error());
					mysql_select_db($dbname, $chandle);
					$recieve_user_info = mysql_query("SELECT * FROM users WHERE Username = '$username'", $chandle);
					$user_info_o = mysql_fetch_object($recieve_user_info);
					//Friendlist
					$friend_friends = "";
					if ($user_info_o->Friends_IDs !== "" and $user_info_o->Friends_IDs !== null) {
						echo '<div class = "list">';
						echo '<div class = "list_title">Friendlist</div>';
						echo '<div class = "list_body">';
						$friends = explode(',', $user_info_o -> Friends_IDs);
						Foreach ($friends as $friend) {
							echo '<div class = "friend">';
							$find_username = mysql_query("SELECT * From users WHERE ID = '$friend'");
							$friend_info = mysql_fetch_object($find_username);
							$friend_avatar = get_gravatar($friend_info -> Mail);
							echo '<div class = "friend_a"><img src = "' . $friend_avatar . '" alt = "' . $friend_info -> Username . ' avatar"></div>';
							echo '<div class = "friend_n"><a href = "main.php?user=' . $friend_info -> Username . '">' . $friend_info -> Username . '</a></div>';
							echo '<div class = "friend_f">';
							echo '<form name = "friend_control" method = "POST" action = "friends.php">';
							echo '<input type = "hidden" name = "f_ID" value = "' . $friend_info -> ID . '">';
							echo '<input type = "hidden" name = "f_fds" value = "' . $friend_info -> Friends_IDs . '">';
							echo '<input type = "submit" name = "answer" value = "Delete">';
							echo '<input type = "button" name = "send_m" value = "Send message" class = "send_message_b" data-name="' . $friend_info -> Username . '">';
							echo '</form>';
							echo '</div>';
							echo '</div>';
						}
						echo '</div>';
						echo '</div>';
					}
					//Friend requests
					//If $_POST['answer'] isset => Accept or Decline request
					//Else - show forms
					if (isset($_POST['answer'])) {
						if ($_POST['answer'] == 'Accept') {
							//Add sender ID to the list
							$sender_id = $_POST['ID'];
							$friends_s = $user_info_o -> Friends_IDs;
							if ($friends_s == "") {
								$friends_s .= $sender_id;
							} else {
								$friends_s .= ',' . $sender_id;
							}
							//Delete friend request from the list
							$requests = explode(',', $user_info_o -> Friend_requests);
							$new_requests = "";
							foreach ($requests as $request) {
								if ($sender_id != $request) {
									if ($new_requests == "") {
										$new_requests .= $request;
									} else {
										$new_requests .= ',' . $request;
									}
								}
							}
							//Post new request list and new friend list
							mysql_query("UPDATE users SET Friend_requests = '$new_requests' WHERE Username = '$username'", $chandle);
							mysql_query("UPDATE users SET Friends_IDs = '$friends_s' WHERE Username = '$username'", $chandle);
							//Update friendlist of request sender
							$recieve_sender_friends = mysql_query("SELECT Friends_IDs FROM users WHERE ID = '$sender_id'", $chandle);
							$sender_friends_a = mysql_fetch_array($recieve_sender_friends);
							$sender_friends = $sender_friends_a[0];

							if ($sender_friends == "") {
								$sender_friends .= $user_id;
							} else {
								$sender_friends .= ',' . $user_id;
							}
							mysql_query("UPDATE users SET Friends_IDs = '$sender_friends' WHERE ID = '$sender_id'", $chandle);
							mysql_close($chandle);
						} elseif ($_POST['answer'] == 'Decline') {
							//Delete friend request from the list
							$requests = explode(',', $user_info_o -> Friend_requests);
							$new_requests = "";
							foreach ($requests as $request) {
								if ($_POST['ID'] != $request) {
									if ($new_requests == "") {
										$new_requests .= $request;
									} else {
										$new_requests .= ',' . $request;
									}
								}
							}
							mysql_query("UPDATE users SET Friend_requests = '$new_requests' WHERE Username = '$username'", $chandle);
							mysql_close($chandle);
						} elseif ($_POST['answer'] == 'Delete') {
							$fid = $_POST['f_ID'];
							//Delete friend from user's friendlist
							$friends_2 = explode(',', $user_info_o -> Friends_IDs);
							$new_friends = "";
							foreach ($friends_2 as $friend_2) {
								if ($fid != $friend_2) {
									if ($new_friends === "") {
										$new_friends .= $friend_2;
									} else {
										$new_friends .= ',' . $friend_2;
									}
								}
							}
							mysql_query("UPDATE users SET Friends_IDs = '$new_friends' WHERE Username = '$username'", $chandle);
							//Delete user from friend's list
							$new_f_friends = "";
							$f_friends = explode(',', $_POST['f_fds']);
							foreach ($f_friends as $f_friend) {
								if ($user_id != $f_friend) {
									if ($new_f_friends === "") {
										$new_f_friends .= $f_friend;
									} else {
										$new_f_friends .= ',' . $f_friend_2;
									}
								}
							}
							mysql_query("UPDATE users SET Friends_IDs = '$new_f_friends' WHERE ID = '$fid'", $chandle);
							mysql_close($chandle);
						}
						header('Location: friends.php');
						exit() or die();
					} else {
						if ($user_info_o->Friend_requests !== "" and $user_info_o->Friend_requests !== null) {
							$frq = explode(',', $user_info_o -> Friend_requests);
							echo '<div class = "list">';
							echo '<div class = "list_title">Friend requests (' . count($frq) . ')</div>';
							echo '<div class = "list_body">';
							foreach ($frq as $user_request) {
								echo '<div class = "friend_r">';
								$sender_info_m = mysql_query("SELECT * FROM users Where ID = '$user_request'");
								$sender_info_o = mysql_fetch_object($sender_info_m);
								echo '<div class = "friend_r_n">';
								echo '<a href = "main.php?user=' . $sender_info_o->Username . '">' . $sender_info_o->Username . '</a><br>';
								echo '</div>';
								echo '<div class = "friend_r_f">';
								echo '<form name = "friend_request_answer" method = "POST" action = "friends.php">
				<input type = "hidden" name = "ID" value = "' . $sender_info_o -> ID . '">
				<input type = "submit" name = "answer" value = "Accept">
				<input type = "submit" name = "answer" value = "Decline">
				</form>';
								echo '</div>';
								echo '</div>';
							}
							mysql_close($chandle);
						}
						echo '</div>';
						echo '</div>';
					}
				}
				?>
			</div>
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