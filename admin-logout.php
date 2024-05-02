<?php

    include "connect.php";

    session_start();

    if(isset($_SESSION['mySession'])) {
        unset($_SESSION['mySession']);
    }
    header('location: admin-login.php');
?>