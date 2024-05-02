<?php 
    include "connect.php";

    // Cập nhật sản phẩm
    if(isset($_POST['update_strator'])) {
        $tendangnhap  = $_POST['tendangnhap'];
        $email        = $_POST['email'];
        $vaitro       = $_POST['vaitro'];
        $matkhau      = $_POST['matkhau'];
        $sdt          = $_POST['sdt'];
        $diachi       = $_POST['diachi'];
        $trangthai    = $_POST['trangthai'];

        // update strator query
        $update_strator = mysqli_query($conn, "update nguoiquantri set 
        tendangnhap='$tendangnhap', email='$email', vaitro='$vaitro',
        matkhau='$matkhau', sdt = '$sdt', diachi='$diachi', trangthai='$trangthai'
        where tendangnhap='$tendangnhap'") or die('truy vấn update admin strator thất bại');

        if($update_strator) {
            header('location: admin-strator.php');
        }
        else {
            $display_message = "Cập nhật không thành công";
            echo "<div class='display_message'>
                <span>'$display_message'</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
            </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sửa thông tin admin</title>
    <!-- link css -->
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
</head>
<body>
    <!-- thẻ h1 -->
    <h1 style="text-align: center; margin-top: 20px;">Thông tin admin</h1>

    <!-- bảng sửa sản phẩm -->
    <section class="edit_container">
        <!-- php code -->
        <?php 
            if(isset($_GET['edit'])) {
                $tendangnhap = $_GET['edit'];
                $edit_query = mysqli_query($conn, "select * from nguoiquantri
                where tendangnhap='$tendangnhap'");
                if(mysqli_num_rows($edit_query) > 0) {
                    $fetch_data = mysqli_fetch_assoc($edit_query);
                }
                ?>
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data" class="update_product product_container_box" style="margin-top: -10px;">
                <!-- input sửa thông tin admin -->
                <input type="hidden" value="<?php echo $fetch_data['tendangnhap']?>" name="tendangnhap">
                <h2 style="text-align: left;">Tên đăng nhập</h2>
                <input type="text"   value="<?php echo $fetch_data['tendangnhap']?>"   name="tendangnhap" id="manh" class="input_fields fields" required>
                <h2 style="text-align: left;">Email</h2>
                <input type="text"   value="<?php echo $fetch_data['email']?>" name="email" class="input_fields fields" required>
                <h2 style="text-align: left;">Vai trò</h2>
                <input type="text"   value="<?php echo $fetch_data['vaitro']?>"   name="vaitro" class="input_fields fields" required>
                <h2 style="text-align: left;">Mật khẩu</h2>
                <input type="password" value="<?php echo $fetch_data['matkhau']?>" name="matkhau" min='1' class="input_fields fields" required>
                <h2 style="text-align: left;">Số điện thoại</h2>
                <input type="number" value="<?php echo $fetch_data['sdt']?>" name="sdt" min='2' class="input_fields fields" required>
                <h2 style="text-align: left;">Địa chỉ</h2>
                <input type="text"   value="<?php echo $fetch_data['diachi']?>" name="diachi" class="input_fields fields" required>
                <h2 style="text-align: left;">Trạng thái</h2>
                <input type="text" value="<?php echo $fetch_data['trangthai']?>"   name="trangthai" class="input_fields fields" required>
                <div class="btns">
                    <input type="submit" name="update_strator" class="edit_btn" value="Cập nhật">
                    <input type="reset" name="huy" id="close-edit" class="cancel_btn" value="Hủy">
                </div>
            </form>
        <?php
            }
        ?>

    </section>
</body>
</html>