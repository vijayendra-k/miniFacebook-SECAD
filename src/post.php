<!DOCTYPE html>
<html lang="en">
<head>
  <link href="index.css" rel="stylesheet">
  <meta charset="utf-8">
</head>
</html>
<?php
	require "session_auth.php";
	require "database.php";
	require "viewposts.php";
	$rand= bin2hex(openssl_random_pseudo_bytes(16));
  	$_SESSION["nocsrftoken"] = $rand;
	$post_id= sanitize_input($_POST["post_id"]);
?>
	<span class="titleclass">     
    <?php echo "Title: "; ?>
    </span>
<?php
	displaypost($post_id);
?>
	<span class="commentsclass">
	<h2><b>Comments</b></h2>
</span>
<br>
<?php
	showcomments($post_id);
?>

<form action="addnewcomment.php" method="POST" class="text">
	<br><input type="text" class="text_field" name="new_comment" required /> <br>
	<input type="hidden"  name="post_id" value= "<?php echo $post_id; ?>" />
	<input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
	<br><button class="button" type="submit">
  	Add comment
	</button>
</form>
<br>
<a href="index.php">Home page</a>