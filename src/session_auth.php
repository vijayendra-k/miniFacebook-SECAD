<?php
    $lifetime=15*60;
    $path="/secadProject";
    $domain="secad-team14.minifacebook.com";
    $secure=TRUE;
    $httponly=TRUE;
    session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
    session_start();
    if(!isset($_SESSION["logged"]) or $_SESSION["logged"]!=TRUE) {
        echo "<script>alert('You have not logged in. Please log in first');</script>";
        session_destroy();
   	    header("Refresh:0; url=form.php");
   	    die();
    }
    if($_SESSION["browser"]!=$_SERVER["HTTP_USER_AGENT"]) {
        echo "<script>alert('Session hijacking is detected.');</script>";
        session_destroy();
        header("Refresh:0, url:form.php");
        die();
    }    
?>