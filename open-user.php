<?php
    include "connect.php";

    $tendangnhap = $_GET['tdn'];
    $trangthai   = $_GET['trangthai'];

    $sql = "update khachhang set
    trangthai='$trangthai' where tendangnhap='$tendangnhap'";

    $result = mysqli_query($conn, $sql);

    if($result) {
        echo '<script>
        confirm("Bạn có muốn mở khóa người này");
        window.location.href=("admin-user.php");
    </script>';
    }
?>