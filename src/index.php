<link href="index.css" rel="stylesheet">
<?php
    $lifetime=15*60;
    $path="/secadProject";
    $domain="secad-team14.minifacebook.com";
    $secure=TRUE;
    $httponly=TRUE;
    session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
    session_start();
    $mysqli = new mysqli('localhost','secadpass','admin','secad_s23_team14');    
    if($mysql->connect_errno) {
   		printf("Database connection failed: %s\n",$mysqli->connect_error);
   	 	exit();
    }
    if (isset($_POST["username"]) and isset($_POST["password"])){
   		if (securechecklogin($_POST["username"],$_POST["password"])) {
	   		$_SESSION["logged"]=TRUE;
	   		$_SESSION["username"]=$_POST["username"];
	        $_SESSION["browser"]=$_SERVER["HTTP_USER_AGENT"];
	   	} else {
	   		echo "<script>alert('Invalid username/password');</script>";
	   		session_destroy();
	   		header("Refresh:0; url=form.php");
	   		die();
   		}
    }
	if(!isset($_SESSION["logged"])or $_SESSION["logged"]!=True){
		echo "<script>alert('You have not logged in. Please login first');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
	if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
		echo "<script>alert('Session hijacking is detected!');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
	require "viewposts.php";
?>
	<h1><b> Welcome <?php echo htmlentities($_SESSION["username"]); ?> !</b></h1>
	<a href="logout.php">Logout</a>
	<a href="changepasswordform.php">Change Password</a>
<?php
	
	if($_SESSION["user_role"] == "superuser"){
?>
		<a href="userlist.php">User List</a>
<?php
	}
?>
	<br><br>
	<form id="new_post" action="addnewpost.php" method="POST" class="text">
		<?php
		$rand= bin2hex(openssl_random_pseudo_bytes(16));
  		$_SESSION["nocsrftoken"] = $rand;
  		?>
		Title:<br><input type="text" class="text_field" name="new_title" placeholder="Enter the title of your new post " required /><br>
		Content:<br><input type="text" class="text_field" name="new_post" placeholder="What's on your mind?" required /> <br>
		<input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
		<br><button class="button" type="submit">
	  	New post
		</button>
	</form>

<br>
<h1><b> Posts </b></h1>
<?php
	displayposts();
?>
<?php
    function securechecklogin($username, $password) {
		global $mysqli;
		$prepared_sql = "SELECT role,status FROM users WHERE username=? "." AND password=md5(?);";
		if(!$stmt=$mysqli->prepare($prepared_sql))
			echo "Prepared Statement Error";
		$stmt->bind_param("ss",$username,$password);
		if(!$stmt->execute()) echo "Execute error";
		if(!$stmt->store_result()) echo "Store result error";
		$result=$stmt;
		if($result -> num_rows == 1){
			if(!$stmt->bind_result($role, $status)) echo "Binding failed ";
			while($stmt->fetch()){
				$_SESSION["user_role"]=htmlentities($role);
				$user_status = htmlentities($status);
			}
			if($user_status == "enabled"){
				return TRUE;
			}else {
				echo "<script>alert('User has been disabled!');</script>";
			}		
		}
		return FALSE;
   	 
	}
?>
