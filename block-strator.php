<?php
    include "connect.php";

    $tendangnhap = $_GET['tdn'];
    $trangthai   = $_GET['trangthai'];

    $sql = "update nguoiquantri set
    trangthai='$trangthai' where tendangnhap='$tendangnhap'";

    mysqli_query($conn, $sql);

    header('location: admin-strator.php');
?>