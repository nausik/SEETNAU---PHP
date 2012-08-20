<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="css_styles/main.css">
		<meta http-equiv="Content-type" content="text/html"; charset="UTF-8">
		<title>Page 1 - DB</title>
	</head>
	<body>
		<div id="header">
			Seetnau - MySQL DB
		</div>
		<div id="main">
<?php
/*0 = everything is OK,
1 = host not set (default),
2 = Username/dbname not set
3 = Error creating/editing config file*/
$error_code = 1;

if(isset($_POST['host'])){
	if($_POST['db_name'] != "" AND $_POST['username'] != ""){
		$error_code = 0;
		//MySQL DB information
		$dbhost = $_POST["host"];
		$dbusername = $_POST["username"];
		$dbpassword = $_POST["password"];
		$dbname = $_POST["db_name"];

		$chandle = mysql_connect($dbhost, $dbusername, $dbpassword) or die(mysql_error());
		mysql_select_db($dbname, $chandle) or die(mysql_error());
//Check if we want to create tables
		if(isset($_POST["new_table"])){
			//Create users table
			$create_users_table = "CREATE TABLE users
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Username varchar(40),
Password varchar(40),
Mail text NOT NULL,
Question text NOT NULL,
Answer text NOT NULL,
Friends_IDs text,
Friend_requests text,
Activated text NOT NULL,
Password_rec text,
Fans text,
Jobs text,
Idols text
)";

			if (mysql_query($create_users_table, $chandle)){
				echo 'Created users table<br>';
			}else{
				echo 'Error creating users table<br>';
			}
			//Create videos table
			$create_videos_table = "CREATE TABLE video
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
User varchar(40),
Post_date datetime,
Title varchar(50),
YouTube_ID varchar(11),
Description text,
Tags_ID text
)";
			if (mysql_query($create_videos_table, $chandle)){
				echo 'Created videos table<br>';
			}else{
				echo 'Error creating video table<br>';
			}

			$create_messages_table = "CREATE TABLE messages
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Post_date datetime,
Sender varchar(40),
Receiver varchar(40),
Message varchar(400),
Status varchar(1),
Visible varchar(1)
)";

			if (mysql_query($create_messages_table, $chandle)){
				echo 'Created messages table<br>';
			}else{
				echo 'Error creating messages table<br>';
			}
			//Create tags table
			$create_tags_table = "CREATE TABLE video_tags
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Tag varchar(42)
)";

			if(mysql_query($create_tags_table, $chandle)){
				echo 'Created	 tags table<br>';
			}else{
				echo 'Error creating tags table<br>';
			}
			//Create groups table
			$create_groups_table = "CREATE TABLE groups
(
ID int NOT NULL AUTO_INCREMENT,
Avatar text,
PRIMARY KEY(ID),
Name varchar(40),
C_date datetime,
Jobs text,
People varchar(11),
Description text,
Tags_ID text
)";
			if (mysql_query($create_groups_table, $chandle)){
				echo 'Created groups table<br>';
			}else{
				echo 'Error creating groups table<br>';
			}
			//Create jobs table
			$create_jobs_table = "CREATE TABLE jobs
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Job varchar(42)
)";

			if(mysql_query($create_jobs_table, $chandle)){
				echo 'Created jobs tags table<br>';
			}else{
				echo 'Error creating jobs table<br>';
			}

			echo "Finished tables creating process";
		}
//Edit/create mysql config file
$file = "config/mysql_config.php";
$fs = fopen( $file, "w" ) or die("Error opening the file");
$text = '<?php
$dbhost = "' .$dbhost . '";
$dbusername = "' . $dbusername . '";
$dbpassword = "' . $dbpassword . '";
$dbname = "' . $dbname . '";
?>'; 
if (fwrite($fs, $text)){
	echo 'Created mysql config file<br>';
}else{
	$error_code = 3;
}
fclose($fs);

mysql_close($chandle);

}else{
		$error_code = 2;
	}
}
//Errors
if ($error_code != 0){
	if ($error_code == 2){
		echo 'dbname/dbusername were not filled. Please, fill all the field<br>';
	}
	if ($error_code == 3){
		echo 'Error creating mysql config file<br>';
	}?>
<!--DB info forms-->
<form name = "sql_info" method = "post" action = "mysql.php">
Host: <input type="text" name="host">
<br><br>
Username: <input type="text" name="username">
Password: <input type="password" name="password">
<br><br>
DB name: <input type="text" name="db_name">
<br><br>
<input type="checkbox" name="new_table" value="crt_new_tbl"> Create new tables?
<br>  <br><br>
<input type="submit">
</form>
<?php }
?>
		</div>
	</body>
</html>