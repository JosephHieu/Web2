<?php 
    include "connect.php";

    // Cập nhật sản phẩm
    if(isset($_POST['update_product'])) {
        $masp              = $_POST['masp'];
        $manh              = $_POST['manh'];
        $tensp             = $_POST['tensp'];
        $loaisp             = $_POST['loaisp'];
        $giaban            = $_POST['giaban'];
        $soluongton        = $_POST['soluongton'];
        $trangthaiban      = $_POST['trangthaiban'];
        $hinhanh           = $_FILES['hinhanh']['name'];
        $hinhanh_tmp_name  = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_folder    = 'images/' . $hinhanh;
        $mota              = $_POST['mota'];
        $ngaythem          = $_POST['ngaythem'];

        // update query
        $update_products = mysqli_query($conn, "update sanpham set 
        manh='$manh', tensp='$tensp', loaisp='$loaisp', giaban='$giaban',
        soluongton='$soluongton', trangthaiban='$trangthaiban',
        hinhanh='$hinhanh', mota='$mota', ngaythem='$ngaythem'
        where masp='$masp'");

        if($update_products) {
            move_uploaded_file($hinhanh_tmp_name, $hinhanh_folder);
            header('location: admin-product.php');
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
    <a href="admin-product.php" style="padding: 30px; margin-left: 20px;" >
        <h2>
         <i class="fa fa-backward"></i>Quay lại
        </h2>
    </a>
    
    <!-- thẻ h1 -->
    <h1 style="text-align: center; margin-top: 20px;">Cập nhật sản phẩm</h1>

    <!-- bảng sửa sản phẩm -->
    <section class="edit_container">
        <!-- php code -->
        <?php 
            if(isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "select * from sanpham
                where masp='$edit_id'");
                if(mysqli_num_rows($edit_query) > 0) {
                    $fetch_data = mysqli_fetch_assoc($edit_query);
                }
                ?>
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data" class="update_product product_container_box">
                <div>
                    <img src="images/<?php echo $fetch_data['hinhanh']?>" alt="">
                </div>
                <input type="hidden" value="<?php echo $fetch_data['masp']?>" name="masp">
                <h2 style="text-align: left;">Mã nhãn hàng</h2>
                <input type="text"   value="<?php echo $fetch_data['manh']?>"   name="manh" id="manh" class="input_fields fields" required>
                <h2 style="text-align: left;">Tên sản phẩm</h2>
                <input type="text"   value="<?php echo $fetch_data['tensp']?>"   name="tensp" class="input_fields fields" required>
                <h2 style="text-align: left;">Loại sản phẩm</h2>
                <input type="text"   value="<?php echo $fetch_data['loaisp']?>"   name="loaisp" class="input_fields fields" required>
                <h2 style="text-align: left;">Giá bán</h2>
                <input type="text"   value="<?php echo $fetch_data['giaban']?>vnđ"   name="giaban" class="input_fields fields" required>
                <h2 style="text-align: left;">Số lượng tồn</h2>
                <input type="number" value="<?php echo $fetch_data['soluongton']?>"   name="soluongton" min='1' class="input_fields fields" required>
                <h2 style="text-align: left;">Trạng thái bán</h2>
                <input type="number" value="<?php echo $fetch_data['trangthaiban']?>"   name="trangthaiban" min='0' max='2' class="input_fields fields" required>
                <h2 style="text-align: left;">Hình ảnh</h2>
                <input type="file"   name="hinhanh" class="input_fields fields" required>
                <h2 style="text-align: left;">Ngày thêm</h2>
                <input type="date"   value="<?php echo $fetch_data['ngaythem']?>"   name="ngaythem" class="input_fields fields" required>
                <h2 style="text-align: left;">Mô tả</h2>
                <input type="text"   value="<?php echo $fetch_data['mota']?>"   name="mota" class="input_fields fields" required>
                <div class="btns">
                    <input type="submit" name="update_product" class="edit_btn" value="Cập nhật">
                    <input type="reset" name="huy" id="close-edit" class="cancel_btn" value="Hủy">
                </div>
            </form>
        <?php
            }
        ?>

    </section>
</body>
</html>