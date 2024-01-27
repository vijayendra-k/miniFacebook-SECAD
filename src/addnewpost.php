<?php
    require "session_auth.php";
    require "viewposts.php";
    require "database.php";
    require "csrftoken_catch.php";
    $owner = sanitize_input($_SESSION["username"]);
    $title = sanitize_input($_POST["new_title"]);
    $content= sanitize_input($_POST["new_post"]);
    if (!empty($title) && !empty($content)){
        if(addnewpost($owner,$title,$content)){
           echo "<script>alert('New Post Created Successfully!');</script>";
        }        
    }
    else {
        echo "<script>alert('Can not create empty Post!');</script>";
    }
    header("Refresh:0; url=index.php");
?>