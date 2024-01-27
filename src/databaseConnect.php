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