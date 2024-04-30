<?php
    include 'connect.php';

    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "delete from sanpham where masp='$delete_id'")
        or die("truy vấn xóa sản phẩm thất bại");
    }

    if($delete_query) {
        header('location: admin-product.php');
    }
    else {
        echo "Sản phẩm chưa được xóa";
    }
?>