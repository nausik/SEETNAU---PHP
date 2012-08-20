<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Seeitnau - Log out</title>
<link type="text/css" rel="stylesheet" href="css_styles/main.css">
<meta http-equiv="Content-type" content="text/html"; charset="UTF-8">
</head>
<body>
<div id="main" align = "center">
<?php
include_once 'config/mysql_config.php';
include_once 'functions/load_session.php';
$login = load_session();
if ($login == True)
{
	$_SESSION = array();
	session_destroy();
	setcookie('SEETNAU', "", time() - 3600);
	header("Location: main.php");
	exit() or die();
} else {
	echo 'You are already signed out';
	echo '<br><a href = "main.php">Main page</a>';
}
?>
</div>
</body>
</html>