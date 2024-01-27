<?php
   require "adminsession_auth.php";
   require "database.php";
   require "csrftoken_catch.php";
   $owner = sanitize_input($_POST["user_to_update"]);
   $updated_status = sanitize_input($_POST["user_status_updated"]);
   if($updated_status=="enabled" OR $updated_status=="disabled"){
       if(update_user_status($owner,$updated_status)){
            echo "<script>alert('Status updated Successfully!');</script>";
           }
        else{
            echo "<script>alert('Unable to update the specified Status!');</script>";
        }
    }
    else{
        echo "<script>alert('Internal Error! status value error');</script>";
    }
    header("Refresh:0; url=userlist.php");
?>