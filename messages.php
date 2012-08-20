<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Messages</title>
		<?php
		/*Visible:
b = both;
s = sender;
r = reciever;
n = none (if message is deleted);

Status:
n = not read;
r = read;

If message is deleted while status is n => it's Visible will be set to n. 
Also, n will be set if both users will delete this message on their sides
*/
		include_once "config/incl_everywhere.html";
		?>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/messages.css">
		<link type = "text/css" rel = "stylesheet" href = "css_styles/message.css">
		<script language="javascript" src="js/messages.js"></script>
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
				//Jquery UI tabs
				echo '<div id = "message_categories">';
				echo '<ul>
		<li><a href="#received_m_tab">Received</a></li>
		<li><a href="#sent_m_tab">Sent</a></li>
			</ul>';
				$chandle = mysql_connect($dbhost, $dbusername, $dbpassword);
				mysql_select_db($dbname, $chandle);
				//Recieved messages tab
				echo '<div id = "received_m_tab">';
				$messages = mysql_query("SELECT * FROM messages WHERE Receiver = '$username' ORDER BY ID DESC", $chandle);
				if (mysql_num_rows($messages) > 0) {
					while ($message = mysql_fetch_array($messages)) {
						//Check if message wasn't deleted
						if ($message['Visible'] === "r" or $message['Visible'] === "b") {
							$short_message = $message['Message'];
							if (strlen($message['Message']) > 30) {
								$short_message = substr($message['Message'], 0, 30) . "...";
							}
							$classes = "message";
							if ($message['Status'] === "n") {
								$classes .= ' not_read';
							}
							echo '<div class = "' . $classes . '">';
							echo '<a  class = "delete_message" href = "#">X</a>';
							echo '<div class = "message_div">';
							echo '<div class = "msid">' . $message['ID'] . '</div>';
							echo '<div class = "full_message_text">' . $message['Message'] . '</div>';
							echo '<span class = "message_sender"><a href = "main.php?user=' . $message['Sender'] .'">' . $message['Sender'] . '</a></span> <span class = "post_date">' . $message['Post_date']. '</span>';
							echo '<div class = "message_body"><a href = "#">' . $short_message . '</a></div>';
							echo '</div>';
							echo '</div>';
						}
					}
				}
			}
			echo '</div>';
			//Sent messages tab
			echo '<div id = "sent_m_tab">';
			$sent_messages = mysql_query("SELECT * FROM messages WHERE Sender = '$username' ORDER BY ID DESC", $chandle);
			if (mysql_num_rows($sent_messages) > 0) {
				while ($message = mysql_fetch_array($sent_messages)) {
					//Check if message wasn't deleted
					if ($message['Visible'] === "s" or $message['Visible'] === "b") {
						$short_message = $message['Message'];
						if (strlen($message['Message']) > 30) {
							$short_message = substr($message['Message'], 0, 30) . "...";
						}
						$classes = "s_message";
						if ($message['Status'] === "n") {
							$classes .= ' s_not_read';
						}
						echo '<div class = "' . $classes . '">';
						echo '<a  class = "delete_s_message" href = "#">X</a>';
						echo '<div class = "s_message_div">';
						echo '<div class = "s_msid">' . $message['ID'] . '</div>';
						echo '<div class = "full_s_message_text">' . $message['Message'] . '</div>';
						echo '<span class = "s_message_receiver"><a href = "main.php?user=' . $message['Receiver'] .'">' . $message['Receiver'] . '</a></span> <span class = "post_date">' . $message['Post_date']. '</span>';
						echo '<div class = "s_message_body"><a href = "#">' . $short_message . '</a></div>';
						echo '</div>';
					}
				}
			}
			echo '</div>';
			echo '</div>';
			mysql_close($chandle);
			?>
		</div>
		</div>
		<div id = "read_dialog" title = "Message">
			<div id = "ui_notification"></div>
			<div id = "from_name"></div>	<span id = "post_date"></span>
			<div id = "full_rec_m"></div>
			<form>
				<textarea name = "m_message_text" id = "m_message_text"></textarea>
			</form>
		</div>
		<div id = "read_sent_dialog" title = "Message">
			<div id = "ui_notification_2"></div>
			<span id = "to_name"></span>	<span id = "s_post_date"></span>
			<div id = "full_sent_m"></div>
		</div>
	</body>
</html>