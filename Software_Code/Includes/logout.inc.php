<?php

    session_start();

    if(ISSET($_SESSION['USER_role'])){
        unset($_SESSION['USER_role']);
    }

    if(ISSET($_SESSION['loggedin'])){
        unset($_SESSION['loggedin']);
    }

    if(ISSET($_SESSION['id'])){
        unset($_SESSION['id']);
    }

    if(ISSET($_SESSION['username'])){
        unset($_SESSION['username']);
    }

    header("location: ../login.php");
    exit();

?>