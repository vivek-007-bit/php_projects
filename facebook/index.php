<?php

    //check whether the user is loggedin or not
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: auth/login.php");
        exit();
    }

    //redirect to the app 
    else{
        header("location: app/home.php");
        exit();
    }
?>
