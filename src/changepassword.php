<?php
   require "session_auth.php";
   require "database.php";
   require "csrftoken_catch.php";
   $username= sanitize_input($_SESSION["username"]);
   $newpassword= sanitize_input($_POST["newpassword"]);

   passwordCheck($newpassword);

   if(!empty($newpassword))
    {
      // echo "DEBUG:changepassword.php->Got: username=$username;newpassword=$newpassword\n";
      if (changepassword($username,$newpassword)) {
         echo "<script>alert('The new password has been set.');</script>";
      }
      else {
         echo "<script>alert('Error: Cannot change the password!');</script>";
      }
   } else {
      echo "<script>alert('No provided username/password to change.');</script>";
   }
   header("Refresh:0; url=changepasswordform.php");

   function passwordCheck($password_check){
      $pattern ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$/";
      if(!preg_match($pattern, $password_check)){
         echo "<script>alert('Error: The Password does not meet requirements!');</script>";
         header("Refresh:0; url=changepasswordform.php");
         die();
      }
   }
?>
