# miniFacebook secad project #
## CPS-592 : Secure Application Development ##
## Instructor: Phu Phung ##


## Kevin Richard ##
* (richardk5@udayton.edu)
## Vijayendra Kosigi ##
* (kosigiv1@udayton.edu)


# 1. Introduction #

An application to make, read, edit and delete posts has been developed using PHP and HTML using MYSQL as the database. We have applied all the secure programming principles and lab practices to build a very simple and secure miniFacebook web application. Our focus was mainly on Security and its implementation.

Repository: 
https://bitbucket.org/secad-s23-team14/secad-s23-team14-project/src/master/

# Video Demo: #
## https://drive.google.com/file/d/1Q1IFJ23LEMbIrpQhdKvlx3vrB_1jroaV/view?usp=share_link ##
## https://drive.google.com/file/d/1YE-DrAZ04WNNjdv0HB579Sn-8U8KdWNP/view?usp=share_link ##

# 2. Design #

## 2.1 Summary of set up ##
* Configuration
	- copy '~/secad-s23-team14-project/ssl' files to '/etc/ssl'
		- edit '/etc/apache2/sites-available/default-ssl.conf'
			- Line 32: SSLCertificateFile	/etc/ssl/secad.crt
			- Line 33: SSLCertificateKeyFile /etc/ssl/secad.key

* Dependencies
	- all files in :
		- ~/secad-s23-team14-project/src
		- ~/secad-s23-team14-project/database

* Database configuration
	- cd ~/secad-s23-team14-project/database
	- run 'source userCreate.sql' with root user to create database, users, and tables

* How to run tests

* Deployment instructions
	- copy '~/secad-s23-team14-project/src' files to '/var/www/html/secadProject'

## 2.2 User interface ##
* The UI's design is taken from simple forms available on the internet and the Facebook.com application that served a great purpose in creating and editing the post. We have done most of the implementation in SQL, PHP, HTML and CSS. While PHP is involved in most of our code logics, we have used HTML and CSS to create the web page layouts and its design. Security principles are followed and implemented in the programming languages used. 
## 2.3 Functionalities ## 
* Any user can make posts but can only edit and delete their own posts.
* can register new users and has authorization for the registered users when they login.
* Registered users can perform the below mentioned operations:
- ([x]) Login
- [x] Add a New Post
- [x] Add comments to any Post
- [x] Edit only their Posts but not others posts
- [x] Change their Password
* Whereas, a Super User has additional access to the following operations:
- [x] Enable a Registered User
- [x] Disable a Registered User
* All users can comment on any post after logging in.


# 3. Implementation & security analysis #

## 3.1 Security programming principles ##
* Used defense-in-depth and defense-in-breath principles. ( Work in progress )

## 3.2 Database security principles ##
* Database users with only access to specific tables are used for specific tasks.
* Passwords are hashed in the database for security reasons.

## 3.3 Is the code robust and defensive? How?
* Input is sanitized at all levels. Checked for null, empty " ", and regex patterns.
* In case of wrong input format, the code can handle it and return necessary comments.

## 3.4 Defending the code against known attacks such as including XSS, SQL Injection, CSRF, Session Hijacking
*   For the prevention of Cross-site Scripting attacks, we have used htmlentities function which aims to convert the characters into HTML entities. It encodes problematic characters in the output.
*   SQL injections occur mainly due to improper data validation. It can be prevented by validating the SQL statements using parameterized queries which are also called as Prepared Statements. 
*   We have used CSRF tokens to prevent CSRF attacks because without a token, an attacker cannot create valid requests to the backend server. The tokens are stored in the session and are sent to the client to avoid these attacks.
*   We have used HTTPS to prevent session hijacking. It is also set with a lifetime span which will again be accessed over a secure https connection. The browser is also entailed as a user agent to make it more secure.

## 3.5 How the roles of super users and regular users are separated?
* A new column called 'role' has been introduced in the 'users' table.
* The role value is retrieved at login and stored in session. 
* If the role values ='superuser', then more hidden functionalities become visible.


# 4. Demo (screenshots) #

*   Everyone can register a new account.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/registeruser1.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/registeruser2.PNG)
*   Registered users can login.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/loggedin_as_registered_user.PNG)
*   A regular logged-in user cannot access the links for superusers
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/adminlogin.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/login_with_regular_user_can_not_see_userlist.PNG)
*   CSRF attack to enable a user is detected and prevented
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/try_access_as_csrf_to_userlist.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/unauthorized_access.PNG)
*   Logged-in users can:
*   Change Password.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/password_change.PNG)
*   Add a new post.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/new_post.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/new_post_top.PNG)
*   Edit only their own post (other user post edit option hidden).
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/cannot_edit_others_posts.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/editpost1.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/editpost2.png)
*   Delete their own post (deleted posts are removed from database and dont appear)
*   Add comments on any post.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/addcomment1.PNG)
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/addcomment2.PNG)
*   Superuser can:-
*   View the list of registered users.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/see_all_non_admin_users.PNG)
*   Enable/Disable a user.
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/user_disabled.PNG)
*   The disabled account cannot log in 
	![alt text](https://bitbucket.org/secad-s23-team14/secad_demo/raw/cc8d7f13194874a1292340878a18a93a1f85d917/demo_pics/login_with_disabled_user.PNG)


# Appendix

## database/userCreate.sql
```sql
-- drop database
Drop database secad_s23_team14;
-- create database
CREATE database secad_s23_team14;
-- drop users
DROP USER 'secadpass'@'localhost';
DROP USER 'postAccess'@'localhost';
DROP USER 'commentAccess'@'localhost';
-- create user
CREATE USER 'secadpass'@'localhost' identified by 'admin';
CREATE USER 'postAccess'@'localhost' identified by 'admin';
CREATE USER 'commentAccess'@'localhost' identified by 'admin';
-- grant all access
GRANT ALL ON secad_s23_team14.users to 'secadpass'@'localhost';
GRANT ALL ON secad_s23_team14.posts to 'postAccess'@'localhost';
GRANT ALL ON secad_s23_team14.users to 'postAccess'@'localhost';
GRANT ALL ON secad_s23_team14.comments to 'commentAccess'@'localhost';


-- use database
use secad_s23_team14;

-- add tables and data
source database.sql;
```
## database/database.sql
```sql
-- if the table exists drop it
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;

-- create a new table
CREATE TABLE users(
    username varchar(50) PRIMARY KEY,
    password varchar(100) NOT NULL,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    email varchar(100) NOT NULL,
    phone_no varchar(10) NOT NULL,
    role varchar(10) NOT NULL,
    status varchar(10) NOT NULL,
    CONSTRAINT username_format CHECK (username REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    CONSTRAINT email_format CHECK (email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    CONSTRAINT phone_number CHECK (phone_no REGEXP '[0-9]{10}'),
    CONSTRAINT first_name_check CHECK (first_name REGEXP '^[A-Za-z]+$'),
    CONSTRAINT last_name_check CHECK (last_name REGEXP '^[A-Za-z]+$'),
    CONSTRAINT role_check CHECK (role IN ('superuser', 'regular')),
    CONSTRAINT status_check CHECK (status IN ('enabled', 'disabled'))
    );
    

-- insert data to users table
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES ('admin@secad.com',md5('password'),'administrator','kun','adkun@secad.com','1111111111','superuser','enabled');
INSERT INTO `users` VALUES ('user1@secad.com',md5('password'),'user','one','user1@secad.com','1111111111','regular','enabled');
INSERT INTO `users` VALUES ('user2@secad.com',md5('password'),'user','two','user2@secad.com','1111111111','regular','enabled');
INSERT INTO `users` VALUES ('user3@secad.com',md5('password'),'user','three','user3@secad.com','1111111111','regular','enabled');

UNLOCK TABLES;



CREATE TABLE posts(
    post_id int AUTO_INCREMENT PRIMARY KEY,
    date_time datetime NOT NULL,
    owner varchar(50),
    title varchar(100) NOT NULL,
    content varchar(250) NOT NULL,
    FOREIGN KEY(`owner`) REFERENCES `users`(`username`) ON DELETE CASCADE
    );

LOCK TABLES `posts` WRITE;
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'admin@secad.com','This is the sample post 1','sometime I wonder whats happening');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user1@secad.com','This is the sample post 2','admin is cracked');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user1@secad.com','you can delete this','what happening?');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user2@secad.com','Edit post works','edit me');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user3@secad.com','wow!!','life :)');
UNLOCK TABLES;



CREATE TABLE comments(
    comment_id int AUTO_INCREMENT PRIMARY KEY,
    post_id int NOT NULL,
    date_time datetime NOT NULL,
    owner varchar(50),
    comment varchar(250) NOT NULL,
    FOREIGN KEY(`owner`) REFERENCES `users`(`username`) ON DELETE CASCADE,
    FOREIGN KEY(`post_id`) REFERENCES `posts`(`post_id`) ON DELETE CASCADE
    );

LOCK TABLES `comments` WRITE;
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (1,NOW(),'user1@secad.com','Ignorance is bliss');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (1,NOW(),'admin@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (2,NOW(),'user2@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (3,NOW(),'user2@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (4,NOW(),'user1@secad.com','I wonder');
UNLOCK TABLES;
```
## src/editpost.php
```php
<link href="index.css" rel="stylesheet">
<?php
    require "session_auth.php";
    require "viewposts.php";
    require "database.php";
    $post_id = sanitize_input($_POST["post_id"]);
    $owner = sanitize_input($_SESSION["username"]);
    editingpost($post_id);
?>
<br>
<a href="index.php">Home page</a>
```
## src/changepasswordform.php
```php
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

```
## src/viewposts.php
```php
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
```
## src/deletepost.php
```php
<?php
    require "session_auth.php";
    require "viewposts.php";
    require "database.php";
    require "csrftoken_catch.php";
    $post_id = sanitize_input($_POST["post_id"]);
    $owner = sanitize_input($_SESSION["username"]);
    if(deletepost($owner,$post_id)){
        echo "<script>alert('Post deleted Successfully');</script>";
    }
    else{
        echo "<script>alert('Unable to delete the specified post');</script>";
    }
    header("Refresh:0; url=index.php");
?>
```
## src/changepassword.php
```php
<?php
   require "session_auth.php";
   require "database.php";
   require "csrftoken_catch.php";
   $username= sanitize_input($_SESSION["username"]);
   $newpassword= sanitize_input($_POST["newpassword"]);

   passwordCheck($newpassword);

   if(!empty($newpassword))
    {
      // echo "DEBUG:changepassword.php->Got: username=$username;newpassword=$newpassword\n";
      if (changepassword($username,$newpassword)) {
         echo "<script>alert('The new password has been set.');</script>";
      }
      else {
         echo "<script>alert('Error: Cannot change the password!');</script>";
      }
   } else {
      echo "<script>alert('No provided username/password to change.');</script>";
   }
   header("Refresh:0; url=changepasswordform.php");

   function passwordCheck($password_check){
      $pattern ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$/";
      if(!preg_match($pattern, $password_check)){
         echo "<script>alert('Error: The Password does not meet requirements!');</script>";
         header("Refresh:0; url=changepasswordform.php");
         die();
      }
   }
?>

```
## src/csrftoken_catch.php
```php
<?php
    $nocsrftoken=$_POST["nocsrftoken"];
    if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])){
        echo "<script>alert('Cross-site request forgery is detected!');</script>";
        header("Refresh:0; url=logout.php");
        die();
    }
?>
```
## src/addnewpost.php
```php
<?php
    require "session_auth.php";
    require "viewposts.php";
    require "database.php";
    require "csrftoken_catch.php";
    $owner = sanitize_input($_SESSION["username"]);
    $title = sanitize_input($_POST["new_title"]);
    $content= sanitize_input($_POST["new_post"]);
    if (!empty($title) && !empty($content)){
        if(addnewpost($owner,$title,$content)){
           echo "<script>alert('New Post Created Successfully!');</script>";
        }        
    }
    else {
        echo "<script>alert('Can not create empty Post!');</script>";
    }
    header("Refresh:0; url=index.php");
?>
```
## src/editingpost.php
```php
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
```
## src/userlist.php
```php
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
```
## src/index.php
```php
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

```
## src/addnewuser.php
```php
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
```
## src/user_roleupdate.php
```php
<?php
   require "adminsession_auth.php";
   require "database.php";
   require "csrftoken_catch.php";
   $owner = sanitize_input($_POST["user_to_update"]);
   $updated_status = sanitize_input($_POST["user_status_updated"]);
   if($updated_status=="enabled" OR $updated_status=="disabled"){
       if(update_user_status($owner,$updated_status)){
            echo "<script>alert('Status updated Successfully!');</script>";
           }
        else{
            echo "<script>alert('Unable to update the specified Status!');</script>";
        }
    }
    else{
        echo "<script>alert('Internal Error! status value error');</script>";
    }
    header("Refresh:0; url=userlist.php");
?>
```
## src/form.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="loginform.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Login page - miniFacebook</title>
</head>
<body>
         <h1>A Simple login page - miniFacebook</h1>
<div class="time-container">

<?php
  //some code here
    
?>
</div>
        <form action="index.php" method="POST" class="form login">
                <br>
              <input type="text" class="text_field" name="username" placeholder="Enter your username" required /> <br>
                <input type="password" class="text_field" name="password" placeholder="Enter your password" required /> <br>
                <button class="button" type="submit">
                Login
                </button>
        </form>
        <a href="registrationform.php">Sign up</a>

</body>
</html>

```
## src/logout.php
```php
<?php
    session_start();
    session_destroy();
    echo "<script>alert('You have been successfully been logged out!');</script>";
  header("Refresh:0; url=form.php");
?>

```
## src/addnewcomment.php
```php
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
```
## src/database.php
```php
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

```
## src/session_auth.php
```php
<?php
    $lifetime=15*60;
    $path="/secadProject";
    $domain="secad-team14.minifacebook.com";
    $secure=TRUE;
    $httponly=TRUE;
    session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
    session_start();
    if(!isset($_SESSION["logged"]) or $_SESSION["logged"]!=TRUE) {
        echo "<script>alert('You have not logged in. Please log in first');</script>";
        session_destroy();
        header("Refresh:0; url=form.php");
        die();
    }
    if($_SESSION["browser"]!=$_SERVER["HTTP_USER_AGENT"]) {
        echo "<script>alert('Session hijacking is detected.');</script>";
        session_destroy();
        header("Refresh:0, url:form.php");
        die();
    }    
?>
```
## src/post.php
```php
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
```
## src/registrationform.php
```php
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
```
## src/adminsession_auth.php
```php
<?php
    require "session_auth.php";
    if($_SESSION["user_role"] != "superuser"){
        echo "<script>alert('Unauthorized access detected.');</script>";
        session_destroy();
        header("Refresh:0, url:form.php");
        die();
    }
?>
```
## src/databaseConnect.php
```php
<?php
    $mysqli = new mysqli('localhost','secadpass','admin','secad_s23_team14');    
    if($mysqli -> connect_errno){
        printf("Database connection failed: %s\n",$mysqli->connect_error);
        exit();
    }
    $mysqlpost = new mysqli('localhost','postAccess','admin','secad_s23_team14');    
    if($mysqlpost -> connect_errno){
        printf("Database connection failed: %s\n",$mysqlpost->connect_error);
        exit();
    }
    $mysqlcomment = new mysqli('localhost','commentAccess','admin','secad_s23_team14');    
    if($mysqlcomment -> connect_errno){
        printf("Database connection failed: %s\n",$mysqlcomment->connect_error);
        exit();
    }
?>
```
# Source code to Markdown
This file is automatically created by a script. Please delete this line and replace with the course and your team information accordingly.
## src/changepasswordform.css
```css
body {
    background-color: lightyellow;
    font-family: "Times New Roman", Times, serif;
}

h1 {
    color: black;
    text-transform: uppercase;
    
    text-align: center;
}

.p1 {
    color: yellow;
    font-size: 24px;
    padding-bottom: 25px;   
}
.current-time {
    font-family: "Times New Roman", Times, serif;
    color: #3b5598;
    text-align: center;
    font-size: 25px;
}
input [type="password"]
{
    padding: 200px;
}

button {
    cursor: pointer;
    border-radius: 5px;
    margin-top: -10px;
    margin-left: 140px;
    background-color: #1F75fe;
    color: white;
    padding: 4px 6px;
    border: pointer;
    font-size: 20px;
    text-align: center;
    display: inline-block;
    align-content: center;
}

form {
    width: 450px;
    height: 70px;
    border-color: #3b5998;
    background-color: white;
    color: black;
    margin-left: 530px;
    margin-top: 50px;
    margin-bottom: 100px;
    padding-top: 5px;
    padding-bottom: 40px;
}

username-box {
    display:flex;
    justify-content: center;
    align-content: center;
    font-size: 24px;
}

a {
    color: #3b5998;
    font-size: 25px;
    margin-top: -100px;
    padding-left: 740px;
    text-align: center;
}
.container{
    height: 100px;
    position: relative;
    padding: 100px;
    padding-left: 25%;
    padding-right: 25%;
    border: 2px solid green;
}

span {
    margin-left: 20px;
    color: black;
    font-size: 24px;
    font-weight: bold;
}

a-homelink {
    margin-top: -100px;
}
```
## src/loginform.css
```css
form {
    width: 380px;
    height: 230px;
    border-color: #3b5998;
    border-style: solid;
    background-color: white;
    margin-left: 546px;
    color: black;
}
button {
    background-color: #1F75fe;
    color: white;
    padding: 12px 30px;
    text-align: center;
    display: inline-block;
    font-size: 15px;
    cursor: pointer;
    border-radius: 2px;
}
input[type=text], input[type=password]{
    width: 90%;
    padding: 12px 10px;
    box-sizing: border-box;
    margin: 8px 0;
    font-size: 20px;
}
body {
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    font-family: "Times New Roman", Times, serif;
    color: white;
    font-size: 24px;
    text-align: center;
}

a {
    color: #000000;
    font-size: 20px;
    text-align: center;
    margin-left: 1px;
}

time-container {
    text-align: center;
}

p {
        font-size: 25px;

}

```
## src/registrationform.css
```css
body {
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    font-family: "Times New Roman", Times, serif;
    color: white;
    font-size: 24px;
    text-align: center;
}

form {
    width: 380px;
    height: 570px;
    border-color: #3b5998;
    border-style: solid;
    background-color: white;
    margin-left: 546px;
    color: black;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 24px;
    text-align: center;
    display: inline-block;
    font-size: 24px;
    cursor: pointer;
    border-radius: 5px;
}

time-container {
    text-align: center;
}

p {
        font-size: 25px;

}


a {
    color: white;
    font-size: 25px;
    text-align: center;
    margin-left: 25px;
}

input[type=text], input[type=password]{
    width: 90%;
    padding: 12px 10px;
    box-sizing: border-box;
    margin: 8px 0;
    font-size: 20px;
}

.username-box label[for="usernameinput"] {
    text-align: left;
    color: red;
}
```
## src/index.css
```css
#new_post {
    width: 600px;
    height: 230px;
    border-color: #3b5998;
    border-style: solid;
    background-color: white;
    margin-left: 30%;
    color: black;
}
button {
    background-color: #1F75fe;
    color: white;
    padding: 12px 30px;
    text-align: center;
    display: inline-block;
    font-size: 15px;
    cursor: pointer;
    border-radius: 2px;
}
input[type=text], input[type=password]{
    width: 50%;
    padding: 12px 10px;
    box-sizing: border-box;
    margin: 8px 0;
    font-size: 20px;
}
body {
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    font-family: "Times New Roman", Times, serif;
    color: white;
    font-size: 24px;
    text-align: center;
}

a {
    color: #000000;
    font-size: 20px;
    text-align: center;
    margin-left: 1px;
}
time-container {
    text-align: center;
}

b{
    color: #000000;
}

p {
        font-size: 25px;

}


table {
  border-collapse: collapse;
  width: 70%;
  margin: 0 auto;
}

th, td {
  padding: 8px;
  text-align: center;
}

th {
  background-color: #f2f2f2;
}
```
