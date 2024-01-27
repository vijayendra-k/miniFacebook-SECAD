<?php
	require "session_auth.php";
	require "viewposts.php";
	require "database.php";
	require "csrftoken_catch.php";
	$post_id = sanitize_input($_POST["post_id"]);
	$owner = sanitize_input($_SESSION["username"]);
	if(deletepost($owner,$post_id)){
	    echo "<script>alert('Post deleted Successfully');</script>";
	}
    else{
        echo "<script>alert('Unable to delete the specified post');</script>";
    }
    header("Refresh:0; url=index.php");
?>