<?php

function DB_conn(){

    //database variables
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $conn  = new PDO("mysql:host=$servername;dbname=dbagrh", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connection is successfull.";
        return $conn;
    }catch(PDOException $e){
        echo "connection failed!" . $e->getMessage();
        return NONE;
    }
}
?>
