<!DOCTYPE html>
<html lang="en">
<head>
  <link href="registrationform.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Registration page - miniFacebook</title>
</head>
<body>
 		 <h1>Sign Up for a New Account</h1>
<div class="time-container">
<?php
  //some code here
  echo "<p class='current-time'>Current time: " . date("Y-m-d h:i:sa") . "</p>";
?>
  </div>
      	<form action="addnewuser.php" method="POST" class="form login">
          <div class="username-box">
            <br><input type="text" class="text_field" name="new_username" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email as username" placeholder="Please enter your username" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"/>
            </div>
              <input type="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); document.getElementById('re_new_password').pattern = this.value;" class="text_field" name="new_password" placeholder="Enter your password" title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase, and 1 UPPERCASE"/> <br>
              <input type="password" required id="re_new_password" class="text_field" name="re_new_password" placeholder="Re-enter your new password" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
              <br> <input type="text" class="text_field" name="first_name" placeholder="Enter your First name" required pattern="^[A-Za-z]+$" title="Please enter a valid First Name" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');" />              
              <br> <input type="text" class="text_field" name="last_name" placeholder="Enter your Last name" required pattern="^[A-Za-z]+$" title="Please enter a valid Last Name" placeholder="Please enter your Last Name" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');" />              
              <br> <input type="text" class="text_field" name="email_id" placeholder="Enter your email address" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email" placeholder="Your email address" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');" />              
              <br> <input type="text" class="text_field" name="phone_no" placeholder="Enter your Phone number" required pattern="[0-9]{10}" />
            	<button class="button" type="submit">
              	Sign up
            	</button>
      	</form>
</body>
</html>
<a href="form.php">Already have an account? Log In</a>