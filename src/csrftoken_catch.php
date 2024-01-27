<?php
	$nocsrftoken=$_POST["nocsrftoken"];
	if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])){
		echo "<script>alert('Cross-site request forgery is detected!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	}
?>