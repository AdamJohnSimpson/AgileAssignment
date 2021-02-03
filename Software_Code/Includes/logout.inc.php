<?php

    session_start();

    if(ISSET($_SESSION['USER_role'])){
        unset($_SESSION['USER_role']);
    }

    if(ISSET($_SESSION['loggedin']){
        unset($_SESSION['loggedin']);
    }

    header("location: ../login.php");
    exit();

?>