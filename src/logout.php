<?php
	session_start();
	session_destroy();
	echo "<script>alert('You have been successfully been logged out!');</script>";
  header("Refresh:0; url=form.php");
?>
