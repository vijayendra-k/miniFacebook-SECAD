<?php
	require "session_auth.php";
	require "viewposts.php";
	require "database.php";
	require "csrftoken_catch.php";
	$new_comment= sanitize_input($_POST["new_comment"]);
	$post_id = sanitize_input($_POST["post_id"]);
	$owner = sanitize_input($_SESSION["username"]);
	if (!empty($new_comment)){
		if(addnewcomment($owner,$new_comment,$post_id)){
			echo "<script>alert('Comment added Successfully!');</script>";
		}
		else{
			echo "<script>alert('Unable to add comment!');</script>";
		}
	}
	else{
		echo "<script>alert('Comment can not be null!');</script>";
	}
?>
	<form id="post_return" action="post.php" method="POST" class="show post">
        <input type="hidden"  name="post_id" value= "<?php echo $post_id; ?>" /> <br>
    </form>

<script>
	document.getElementById("post_return").submit();
</script>