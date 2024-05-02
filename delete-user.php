<?php
    include "connect.php";

    $sql = "select * from khachhang";
    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result)) {
        echo $row['tendangnhap'];
    }
?>