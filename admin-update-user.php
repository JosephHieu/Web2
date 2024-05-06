<?php 
    include "connect.php";

    $tdn = $_GET['edit'];

    // Cập nhật sản phẩm
    if(isset($_POST['update_user'])) {
        $tendangnhap  = $_POST['tendangnhap'];
        $hovaten      = $_POST['hovaten'];
        $sdt          = $_POST['sdt'];
        $email        = $_POST['email'];
        $matkhau      = $_POST['matkhau'];
        $namsinh      = $_POST['namsinh'];
        $quanhuyen    = $_POST['quanhuyen'];
        $tptinh       = $_POST['tptinh'];
        $quocgia      = $_POST['quocgia'];
        $trangthai    = $_POST['trangthai'];

        // update query
        $update_products = mysqli_query($conn, "update khachhang set 
        tendangnhap='$tendangnhap', hovaten='$hovaten', sdt='$sdt',
        email='$email', matkhau='$matkhau', namsinh='$namsinh',
        quanhuyen='$quanhuyen', tptinh='$tptinh', quocgia='$quocgia',
        trangthai='$trangthai' 
        where tendangnhap='$tendangnhap'") or die('truy vấn update admin user thất bại');

        if($update_products) {
            header('location: admin-user.php');
        }
        else {
            $display_message = "Cập nhật không thành công";
            echo "<div class='display_message'>
                <span>'.$display_message.'</span>
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
    <title>Sửa sản phẩm</title>
    <!-- link css -->
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
</head>
<body>
    <a href="admin-user.php" style="padding: 30px; margin-left: 20px;" >
        <h2>
         <i class="fa fa-backward"></i>Quay lại
        </h2>
    </a>
    
    <!-- thẻ h1 -->
    <h1 style="text-align: center; margin-top: 20px;">Thông tin khách hàng</h1>

    <!-- bảng sửa sản phẩm -->
    <section class="edit_container">
        <!-- php code -->
        <?php 
            if(isset($_GET['edit'])) {
                $tendangnhap = $_GET['edit'];
                $edit_query = mysqli_query($conn, "select * from khachhang
                where tendangnhap='$tendangnhap'");
                if(mysqli_num_rows($edit_query) > 0) {
                    $fetch_data = mysqli_fetch_assoc($edit_query);
                }
                ?>
            <!-- form -->
            <form action="admin-update-user.php" method="post" enctype="multipart/form-data" class="update_product product_container_box">
                <h2 style="text-align: left;">Tên đăng nhập</h2>
                <input type="text" value="<?php echo $fetch_data['tendangnhap']?>" name="tendangnhap" class="input_fields fields" required>
                <h2 style="text-align: left;">Họ và tên</h2>
                <input type="text"   value="<?php echo $fetch_data['hovaten']?>"   name="hovaten" class="input_fields fields" required>
                <h2 style="text-align: left;">Số điện thoại</h2>
                <input type="text"   value="<?php echo $fetch_data['sdt']?>"   name="sdt" class="input_fields fields" required>
                <h2 style="text-align: left;">Email</h2>
                <input type="text"   value="<?php echo $fetch_data['email']?>"   name="email" class="input_fields fields" required>
                <h2 style="text-align: left;">Mật khẩu</h2>
                <input type="password"   value="<?php echo $fetch_data['matkhau']?>"   name="matkhau" class="input_fields fields" required>
                <h2 style="text-align: left;">Ngày/tháng/năm sinh</h2>
                <input type="date" value="<?php echo $fetch_data['namsinh']?>"   name="namsinh" class="input_fields fields" required>
                <h2 style="text-align: left;">Quận/Huyện</h2>
                <input type="text" value="<?php echo $fetch_data['quanhuyen']?>"   name="quanhuyen" class="input_fields fields" required>
                <h2 style="text-align: left;">Tp/Tỉnh</h2>
                <input type="text" value="<?php echo $fetch_data['tptinh']?>"  name="tptinh" class="input_fields fields" required>
                <h2 style="text-align: left;">Quốc gia</h2>
                <input type="text"  value="<?php echo $fetch_data['quocgia']?>" name="quocgia" class="input_fields fields" required>
                <h2 style="text-align: left;">Trạng thái</h2>
                <input type="number"   value="<?php echo $fetch_data['trangthai']?>"   name="trangthai" class="input_fields fields" required>
                <div class="btns">
                    <input type="submit" name="update_user" class="edit_btn" value="Cập nhật">
                    <input type="reset" name="huy" id="close-edit" class="cancel_btn" value="Hủy">
                </div>
            </form>
        <?php
            }
        ?>

    </section>
</body>
</html>