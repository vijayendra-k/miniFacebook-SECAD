<?php
   require "database.php";
   $newusername= sanitize_input($_POST["new_username"]);
   $newpassword= sanitize_input($_POST["new_password"]);
   $newfirstname= sanitize_input($_POST["first_name"]);
   $newlastname= sanitize_input($_POST["last_name"]);
   $newemailid= sanitize_input($_POST["email_id"]);
   $newphonenumber= sanitize_input($_POST["phone_no"]);
   if (empty($newusername) OR empty($newpassword) OR empty($newfirstname) OR empty($newlastname) OR empty($newemailid) OR empty($newphonenumber)) {
      echo "<script>alert('All required details not provided!');</script>";
      header("Refresh:0; url=registrationform.php");
      die();
   }
   else{
      emailCheck($newusername);
      passwordCheck($newpassword);
      nameCheck($newfirstname);
      nameCheck($newlastname);
      emailCheck($newemailid);
      phoneCheck($newphonenumber);
      if (addnewuser($newusername,$newpassword,$newfirstname,$newlastname,$newemailid,$newphonenumber)) {
         echo "<script>alert('The user has been registered!');</script>";
         header("Refresh:0; url=form.php");
      }
      else {
         echo "<script>alert('Error: The user can not be registered!');</script>";
         header("Refresh:0; url=registrationform.php");
      }
   }
   
   function emailCheck($email_check){
      $pattern ="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
      if(!preg_match($pattern, $email_check)){
         echo "<script>alert('Error: The Username or Emailid does not meet requirements!');</script>";
         header("Refresh:0; url=registrationform.php");
         die();
      }
   }
   function passwordCheck($password_check){
      $pattern ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$/";
      if(!preg_match($pattern, $password_check)){
         echo "<script>alert('Error: The Password does not meet requirements!');</script>";
         header("Refresh:0; url=registrationform.php");
         die();
      }
   }
   function nameCheck($name_check){
      $pattern ="/^[A-Za-z]+$/";
      if(!preg_match($pattern, $name_check)){
         echo "<script>alert('Error: The First or Last name does not meet requirements!');</script>";
         header("Refresh:0; url=registrationform.php");
         die();
      }
   }
   function phoneCheck($phone_check){
      $pattern ="/[0-9]{10}/";
      if(!preg_match($pattern, $phone_check)){
         echo "<script>alert('Error: The Phone number does not meet requirements!');</script>";
         header("Refresh:0; url=registrationform.php");
         die();
      }
   }

?>