<?php

    $sname = "localhost";
    $uname = "root";
    $pass  = "";
    $db_name  = "online_book_store_db";

    try{
        $conn = new PDO("mysql:host=$sname; dbname=$db_name",$uname, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed : ". $e->getMessage();
    }


?>