<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Search user</title>
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<link type = "text/css" rel = "stylesheet" href = "css_styles/search.css">
		<script src = "js/search_user.js" type = "text/javascript"></script>
	</head>
	<body>
		<?php
		include_once 'header.php';
		include_once 'config/msgs_list.php';
		$login = load_session();
		?>
		<div id="main" align = "center">
			<div id = "notification"></div>
			<?php
			//check if user is already signed in
			if ($login == True) { ?>
				<div id = "search_navigation"><input id = "search_input" type = "text"><input id = "start_search" type = "button" value = "Search">
				<br><input type = "radio" name = "s_type" id = "tags_radio" checked>Tags<input type = "radio" name = "s_type" id = "name_radio">Name</div>
				<div id = "search_result"></div>
			<?php } ?>
		</div>
		</div>
	</body>
</html>