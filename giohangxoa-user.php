<?php 
    session_start();
    include "connect.php";

    if(isset($_GET['i'])&&($_GET['i'] > 0)) {
        if(isset($_SESSION['giohang'])) {        
            array_splice($_SESSION['giohang'], $_GET['i'], 1);
        }
    } else {
        if(isset($_SESSION['giohang'])) {
            unset($_SESSION['giohang']);
            header('location: giohang-user.php');
        }
    }
    
    if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang'])>0)) {
        header('location: giohang-user.php');
    } else {
        header('location: shop-user.php');
    }
?>