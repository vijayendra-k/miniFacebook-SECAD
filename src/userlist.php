<link href="index.css" rel="stylesheet">
<br>
<h1><b>Enable or disable users</b></h1>
<br>
<?php
   require "adminsession_auth.php";
   require "database.php";
   userlist();  
?>
<a href="index.php">Home</a> | <a href="logout.php">Logout</a>