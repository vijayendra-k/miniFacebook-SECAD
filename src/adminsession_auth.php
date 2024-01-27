<?php
    require "session_auth.php";
    if($_SESSION["user_role"] != "superuser"){
        echo "<script>alert('Unauthorized access detected.');</script>";
        session_destroy();
        header("Refresh:0, url:form.php");
        die();
    }
?>