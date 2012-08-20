<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Post a video</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<meta http-equiv="Content-type" content="text/html"; charset="UTF-8">
		<script language="javascript" src="js/post_video.js"></script>
	</head>
	<body>
		<?php
		include_once 'header.php';
		?>
		<div id = "main">
			<div id = "notification"></div>
			<?php
			$login = load_session();
			if ($login == True) { ?>
				<div id = "post_video_form">
				Title:<br> <input type = "text" name = "title" id = "video_title"><br>
Link to video:<br> <input type = "text" id = "video_link" name = "link">
<br>
Description:<br> <textarea id = "video_descr" name = "description"></textarea>
<br>
Tags (no more than 25, split with coma):<br> <input type = "text" name = "video_tags" id = "video_tags">
<br><br><input type = "button" value = "Post video" id = "post_video">
				</div>
			<?php } ?>
		</div>
	</body>
</html>