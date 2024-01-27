<?php
    require "databaseConnect.php";

    function changepassword($username, $newpassword){
        global $mysqli;
        $prepared_sql = "update users set password=md5(?) where username = ? ;";
        // echo "DEBUG>prepared_sql=$prepared_sql\n";
        if(!$stmt = $mysqli ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("ss",$newpassword,$username);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }

    function addnewuser($newusername,$newpassword,$newfirstname,$newlastname,$newemailid,$newphonenumber){
        global $mysqli;
        $prepared_sql = "INSERT INTO users VALUES (?,md5(?),?,?,?,?,'regular','enabled');";
        // echo "DEBUG>prepared_sql=$prepared_sql\n";
        if(!$stmt = $mysqli ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("ssssss",$newusername,$newpassword,$newfirstname,$newlastname,$newemailid,$newphonenumber);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }
    
    function sanitize_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }


    function update_user_status($owner,$updated_status){
        global $mysqli;
        $prepared_sql = "update users set status=? where username = ? ;";
        // echo "DEBUG>prepared_sql=$prepared_sql\n";
        if(!$stmt = $mysqli ->prepare($prepared_sql)) return FALSE;
        $stmt -> bind_param("ss",$updated_status,$owner);
        if(!$stmt->execute()) return FALSE;
        return TRUE;
    }

    function userlist(){
        $rand= bin2hex(openssl_random_pseudo_bytes(16));
        $_SESSION["nocsrftoken"] = $rand;
        global $mysqli;
        $prepared_sql = "SELECT username, status FROM users where role != 'superuser' ;";
        if(!$stmt = $mysqli ->prepare($prepared_sql)) return FALSE;
        // $stmt->bind_param("s",$post_id);
        $stmt->execute();
        if(!$stmt->bind_result($username, $status)) echo "Binding failed ";
        while($stmt->fetch()){
            echo htmlentities($username) . "  :  " . htmlentities($status) . "<br><br>";
        
?>
        <form action="user_roleupdate.php" method="POST" class="text">
            <input type="hidden"  name="user_to_update" value= "<?php echo htmlentities($username); ?>" />
            
<?php
            if(htmlentities($status)=="enabled"){
    ?>
                <input type="hidden"  name="user_status_updated" value= "disabled" />
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                <button class="button" type="submit">
                Disable user
                </button>
    <?php
            }else{
    ?>          
                <input type="hidden"  name="user_status_updated" value= "enabled" />
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                <button class="button" type="submit">
                Enable User
                </button>
    <?php
            }
        
?>
        </form>
<?php
        }
    }   
?>
