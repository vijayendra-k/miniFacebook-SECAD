<?php
	require "session_auth.php";
	require "viewposts.php";
	require "database.php";
	require "csrftoken_catch.php";
	$post_id = sanitize_input($_POST["post_id"]);
	$owner = sanitize_input($_SESSION["username"]);
	$new_title = sanitize_input($_POST["edit_title"]);
	$new_content = sanitize_input($_POST["edit_content"]);
	if (!empty($new_title) && !empty($new_content)){
		if(updatepost($owner,$new_title,$new_content,$post_id)){
		        echo "<script>alert('Post editted Successfully');</script>";
		    }
	    else{
	        echo "<script>alert('Unable to edit the specified post');</script>";
	    }
	}
	else{
		echo "<script>alert('Title and Content can not be empty!!');</script>";
	}
?>
<form id="edit_post_return" action="editpost.php" method="POST" class="show post">
        <input type="hidden"  name="post_id" value= "<?php echo $post_id; ?>" /> <br>
    </form>

<script>
	document.getElementById("edit_post_return").submit();
</script>