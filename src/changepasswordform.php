<!DOCTYPE html>
<?php
  require "session_auth.php";
  $rand= bin2hex(openssl_random_pseudo_bytes(16));
  $_SESSION["nocsrftoken"] = $rand;
?>
<html lang="en">
<head>
  <link href="changepasswordform.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Change Password page - miniFacebook</title>
</head>
<body>
  <h1>Change Password, miniFacebook</h1>
  <div style="text-align: center;">
<?php
  //some code here
  echo "<p1 class='current-time'>Current Time: " . date("Y-m-d h:i:sa") ."</p1>";
?>
</div>
  <form action="changepassword.php" method="POST" class="form login">
    <span class="usernamesession">     
    <?php echo "Username: " . htmlentities($_SESSION['username']); ?>
    </span>
    <br>
    <span class="pwordsession">     
    <?php echo "New Password: "; ?>
    </span>
    <input type="password" class="text_field" name="newpassword" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"/>
    <br>
    <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
    <br>
    <button class="button" type="submit">
        Change Password
    </button>
  </form>
<a href="index.php" class="homelink">Home</a>
</body>
</html>
