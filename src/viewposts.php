<?php
    require "databaseConnect.php";

    function displayposts(){
        $username = $_SESSION["username"];
        global $mysqlpost;
        $prepared_sql = "SELECT post_id, title, content, owner, date_time FROM posts where owner in ( select username from users where status='enabled' ) ORDER BY date_time DESC ; ";
        if(!$stmt = $mysqlpost ->prepare($prepared_sql)) return FALSE;
        $stmt->execute();
        $title = NULL; $content = NULL; $date=NULL;
        if(!$stmt->bind_result($post_id, $title, $content, $owner, $date_time)) echo "Binding failed ";
        while($stmt->fetch()){
            ?>
            <table>
                <?php
            echo "<br><tr><td><h2>" . htmlentities($title) . "</h2></td></tr><tr><td><h2>" .  htmlentities($content) . "</h2></td></tr><tr><td>" . htmlentities($owner) . "</td></tr><tr><td>" .htmlentities($date_time) . "</td></tr>";
            ?>
       

<style>
    <tr><td>
    button {
        display: inline-block;
    }
    </td></tr>
</style>
    <tr><td>
            <form action="post.php" method="POST" class="show post">
                <input type="hidden"  name="post_id" value= "<?php echo $post_id; ?>" /> <br>
                <div>    
                    <button class="button" type="submit">
                    comments
                    </button>
                </div>
            </form>
        </td></tr>
     </table>
            
<?php
            if ($username == htmlentities($owner) ){
                editpost(htmlentities($post_id));
            }
        }
        return;
    }

    function showcomments($post_id){
        global $mysqlcomment;
        $prepared_sql = "SELECT comment, owner, date_time FROM comments where post_id= ? ORDER BY date_time ASC;;";
        if(!$stmt = $mysqlcomment ->prepare($prepared_sql)) return FALSE;
        $stmt->bind_param("s",$post_id);
        $stmt->execute();
        $comment = NULL; $owner = NULL; $date_time=NULL;
        if(!$stmt->bind_result($comment, $owner, $date_time)) echo "Binding failed ";
        while($stmt->fetch()){
            echo htmlentities($owner) . " : " . htmlentities($comment) . "<br>" .htmlentities($date_time) . "<br><br>";
        }
        return;
    }

    function displaypost($post_id){
        $username = $_SESSION["username"];
        global $mysqlpost;
        $prepared_sql = "SELECT post_id, title, content, owner, date_time FROM posts where post_id= ? ;";
        if(!$stmt = $mysqlpost ->prepare($prepared_sql)) return FALSE;
        $stmt->bind_param("s",$post_id);
        $stmt->execute();
        $title = NULL; $content = NULL; $date_time=NULL;
        if(!$stmt->bind_result($post_id, $title, $content, $owner, $date_time)) echo "Binding failed ";
        while($stmt->fetch()){
            echo htmlentities($title) . "<br><br>" . htmlentities($owner) . ":<br>" .  htmlentities($content) . "<br>" .htmlentities($date_time) . "<br><br>";
        if ($username == htmlentities($owner) ){
            editpost(htmlentities($post_id));
        }
        }
        
    }

    function addnewpost($owner,$title,$content) {
        global $mysqlpost;
        $prepared_sql="INSERT into posts (date_time,owner,title,content) VALUES (NOW(),?,?,?);";
        if(!$stmt = $mysqlpost ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("sss",$owner,$title,$content);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }


    function deletepost($owner, $post_id){
        global $mysqlpost;      
        $delstmt="DELETE from posts where post_id=? and owner=?;";
        if(!$stmt = $mysqlpost ->prepare($delstmt)) return FALSE;
        $stmt -> bind_param("ss",$post_id,$owner);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }

    function editpost($post_id){
        ?>
        <form action="editpost.php" method="POST" class="text">
            <input type="hidden"  name="post_id" value= "<?php echo $post_id; ?>" />
            <div>
                <button class="button" type="submit">
                edit post
                </button>
            </div>
        </form>
<?php
    }

    function editingpost($post_id){
        $username = $_SESSION["username"];
        global $mysqlpost;
        $prepared_sql = "SELECT post_id, title, content, owner, date_time FROM posts where post_id= ? ;";
        if(!$stmt = $mysqlpost ->prepare($prepared_sql)) return FALSE;
        $stmt->bind_param("s",$post_id);
        $stmt->execute();
        $title = NULL; $content = NULL; $date_time=NULL;
        if(!$stmt->bind_result($post_id, $title, $content, $owner, $date_time)) echo "Binding failed ";
        while($stmt->fetch()){
            echo htmlentities($title) . "<br>" . htmlentities($owner) . ":<br>" .  htmlentities($content) . "<br>" .htmlentities($date_time) . "<br><br>";
        }
        $rand= bin2hex(openssl_random_pseudo_bytes(16));
        $_SESSION["nocsrftoken"] = $rand;
?>
<form action="editingpost.php" method="POST" class="text" style="font-family: Arial, sans-serif; font-size: 16px;">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
    Edit Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="text_field" style="padding: 5px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo htmlentities($title); ?>" name="edit_title" required /> <br>
    Edit Content:&nbsp;<input type="text" class="text_field" style="padding: 5px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo htmlentities($content); ?>" name="edit_content" required /> <br>
    <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
    <div>
        <button class="button" type="submit" style="background-color: #007bff; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;">
            edit post
        </button>
    </div>
</form>

<form action="deletepost.php" method="POST" class="text">
  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
  <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
  <button class="button" type="submit" style="background-color: red; color: white; font-weight: bold; padding: 10px;">
    delete post
  </button>
</form>


<?php
    
    }


    function addnewcomment($owner, $comment, $post_id){
        global $mysqlcomment;
        $prepared_sql = "INSERT INTO comments (post_id, date_time, owner, comment) VALUES (?,NOW(),?,?);";
        if(!$stmt = $mysqlcomment ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("sss",$post_id,$owner,$comment);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }

    function goBack(){
        header('Location: ', $_SERVER['HTTP_REFERER']);
        exit();
    }


    function updatepost($owner,$title,$content,$post_id){
        global $mysqlpost;
        $prepared_sql="update posts set date_time=NOW(),owner=?,title=?,content=? where post_id = ?;";
        if(!$stmt = $mysqlpost ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("ssss",$owner,$title,$content,$post_id);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }
?>