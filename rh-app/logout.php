<?php

session_start();

if(isset($_SESSION["userData"])){
    unset($_SESSION["userData"]);
    session_destroy();
    header("Location: /rh-app/home.php");
    exit;
}else{
    session_destroy();
    header("Location: /rh-app/home.php");
        exit;
}

?>