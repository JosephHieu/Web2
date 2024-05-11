<?php
    include "connect.php";

    if(isset($_GET['mahd'])) {
        $mahd = $_GET['mahd'];

        if(isset($_POST['update_order'])) {
            $trangthai = $_POST['trangthai'];
    
            // update status order
            $update_order = mysqli_query($conn, "update hoadon set
            trangthai='$trangthai' where mahd='$mahd'")
            or die(mysqli_error($conn));

            if($update_order) {
                header('location: admin-order.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cập nhật đơn hàng</title>
    <!-- link css -->
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head>
<body>
    <h1 style="text-align: center; margin-top: 20px;">Cập nhật tình trạng đơn hàng</h1>

    <section class="edit_container">
        <!-- php code -->
        <?php     
            $update_status_order=mysqli_query($conn, "select * from hoadon where mahd='$mahd'");
            if(mysqli_num_rows($update_status_order)>0) {
                $row=mysqli_fetch_assoc($update_status_order);
            }
        ?>
        <form action="" method="post" class="update_product product_container_box">
            <h2 style="text-align: left;">Trạng thái đơn hàng hiện tại</h2>
            <input type="text"   value="<?php 
            if($row['trangthai']==1) {
                echo "Đã giao thành công";
            } elseif($row['trangthai']==2) {
                echo "Đã xác nhận";
            } else {
                echo "Hủy đơn";
            }
            
            ?>" name="manh" id="manh" class="input_fields fields" required>

            <h2 style="text-align: left;">Cập nhật trạng thái mới</h2>           
            <select name="trangthai" class="input_fields fields" id="capnhat">
                <option>Chọn</option>
                <option value="1">Đã giao thành công</option>
                <option value="2">Đã xác nhận</option>
                <option value="0">Hủy đơn</option>
            </select>
            
            <div class="btns">
            <input type="submit" name="update_order" class="edit_btn" value="Cập nhật">
                    <input type="reset" name="huy" id="close-edit" class="cancel_btn" value="Hủy">
            </div>
        </form>
    </section>

</body>
</html>