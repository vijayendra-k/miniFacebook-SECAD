<link href="index.css" rel="stylesheet">
<?php
	require "session_auth.php";
	require "viewposts.php";
	require "database.php";
	$post_id = sanitize_input($_POST["post_id"]);
	$owner = sanitize_input($_SESSION["username"]);
	editingpost($post_id);
?>
<br>
<a href="index.php">Home page</a>