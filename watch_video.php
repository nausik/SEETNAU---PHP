<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>SEETNAU - Videos</title>
		<link type="text/css" rel="stylesheet" href="css_styles/video.css">
		<?php
		include_once "config/incl_everywhere.html";
		?>
		<script type = "text/javascript" src = "js/watch_video.js"></script>
	</head>
	<body>
		<?php
		include_once 'header.php';
		$login = load_session();
		?>
		<div id="main" align = "center">
			<div id = "notification"></div>
			<?php
			$target_username = $_GET['user'];
			if ($login == True) {
				//Protecting from filthy hackers
				if (isset($_GET['user']) and $_GET['user'] != "") {
					$video_menu = '<hr><div class = "video_control"><a href = "#" class = "rem_video">Remove</a> or <a href = "#" class = "ed_video">edit</a></div>';
					$chandle = mysql_connect($dbhost, $dbusername, $dbpassword) or die(mysql_error());
					mysql_select_db($dbname, $chandle);
					$get_videos = mysql_query("SELECT * FROM video WHERE User = '$target_username'");
					$videos_count = mysql_num_rows($get_videos);
					if ($videos_count > 0) {
						//Show every video out there
						while ($videos_row = mysql_fetch_array($get_videos)) {
							echo '<div class="video">';
							echo '<div class="video_title">';
							echo '<h3>' . $videos_row['Title'] . '</h3></div>';
							echo '<div class="video_body">';
							echo '<span class = "video_id_c">' . $videos_row['ID'] . '</span>';
							echo '<span class = "video_url">http://www.youtube.com/embed/' . $videos_row['YouTube_ID'] . '</span>';
							echo '<div class = "iframe_video"><iframe class = "yt_iframe_video" title="YouTube video player" width="480" height="390" src="http://www.youtube.com/embed/' . $videos_row['YouTube_ID'] . '?wmode=opaque" frameborder="0" allowfullscreen></iframe></div>';
							echo '<span class = "video_description">' . $videos_row['Description'] . '</span>';
							echo '<div class = "video_tags">';
							//Show valid tags
							$tags_ids = explode(",", $videos_row['Tags_ID']);
							for ($tag_id = 0; $tag_id < count($tags_ids); $tag_id++) {
								$cur_tag = $tags_ids[$tag_id];
								$get_tag = mysql_query("SELECT Tag FROM video_tags WHERE ID = '$cur_tag'");
								$tags = mysql_fetch_row($get_tag);
								if ($tag_id == 0) {
									echo $tags[0];
								} else {
									echo ',' . $tags[0];
								}

							}
							echo "</div>";
							if ($target_username == $_SESSION['username']) {
								echo $video_menu;
							}
							echo '</div></div>';
						}
						//Error (user posted 0 videos)
					} else {
						echo 'No videos available<br>';
					}
				} else {
					header('Location: watch_video.php?user=' . $_SESSION['username']);
				}
				mysql_close($chandle);
			} else {
				echo '<a href = "login.php">Login</a>';
				echo '<br><a href = "main.php">Main page</a>';
			}
			?>
		</div>
		<!--Video edit dialog-->
		<div id = "edit_video_dialog" title = "Edit video">
			<div id = "ui_notification"></div>
			<span id = "video_id_d"></span>
			Title:
			<br>
			<input type = "text" id = "video_title_d">
			<br>
			Description:
			<br>
			<textarea name = "video_descr_d" id = "video_descr_d"></textarea>
			<br>
			Video url:
			<br>
			<input type = "text" id = "video_url_d">
			<br>
			Tags:
			<br>
			<input type = "text" id = "video_tags_d">
		</div>
	</body>
</html>