<?php
    include "connect.php";

    session_start();

    // xóa session đăng nhập
    if(isset($_SESSION['mySession'])) {
        unset($_SESSION['mySession']);
    }

    // Xóa session giỏ hàng
    if(isset($_SESSION['giohang'])) {
        unset($_SESSION['giohang']);
    }
    header('location: login.php');
?>