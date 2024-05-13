<?php
    session_start();
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];

    include "connect.php";

    if(isset($_POST['add_to_cart'])) {
        $masp    = $_POST['product_id'];
        $tensp   = $_POST['product_name'];
        $hinhanh = $_POST['product_image'];
        $giaban  = $_POST['product_price'];
        if(isset($_POST['soluong'])) {
            $soluong = $_POST['soluong'];
        } else {
            $soluong = 1;
        }
        $fg=0;
        // Kiểm tra sản phẩm có tồn tại trong giỏ hàng hay không 
        // nếu có chỉ cập nhập số lượng
        $i = 0;
        foreach($_SESSION['giohang'] as $item) {
            if($item[1]===$tensp) {
                $slnew = $soluong + $item[4];
                $_SESSION['giohang'][$i][4] += $slnew;
                $fg=1;
                break;
            }
            $i++;
        }

        // Khởi tạo mảng con trước khi đưa vào giỏ hàng
        if($fg==0) {
            $item = array($masp, $tensp, $hinhanh, $giaban, $soluong);
            $_SESSION['giohang'][]=$item;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="stylesheet" href="boostrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Giỏ hàng</title>
</head>
<body>
    <section class="ab-info-main py-5">
        <div class="container" py-3>
            <h3 class="title text-center" style="padding-top: 30px;  font-size: 24px; font-weight: 600;">Giỏ hàng của tôi</h3>
            <div class="row contact-main-info mt-5">
                <div class="col-md-6 contact-right-content">
                <!-- left -->
                <?php
                    // echo var_dump($_SESSION['giohang']);
                    if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang'])>0)) {
                        echo '<table style="width: 70vw;">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>';
                            $i = 0;
                            $tong = 0;
                        foreach($_SESSION['giohang'] as $item) {
                            $tt = (double)$item[3] * (double)$item[4];
                            $tong += $tt;
                            echo '<tr>
                                <td>'.($i+1).'</td>
                                <td>'.$item[1].'</td>
                                <td>
                                <img src="images/'.$item[2].'" alt="ảnh sản phẩm" style="width: 70px; height: 70px;">     
                                </td>
                                <td>'.$item[3].'vnđ</td>
                                <td>
                                    '.$item[4].'
                                </td>
                                <td>'.$tt.'</td>
                                <td>
                                    <a href="giohangxoa-user.php?i='.$i.'">Xóa</a>
                                </td>
                            </tr>';
                            $i++;
                        }
                        echo '<tr>
                            <td colspan="5">Tổng cộng</td><td>'.$tong.'vnđ</td><td></td>
                        </tr>';
                        echo '</table>';
                    } else {
                        echo "<h2>Giỏ hàng hiện trống</h2>";
                    }
                ?>
                <br>
                    <div class="thea" style="display: flex; gap: 50px;">
                        <a href="shop-user.php" style="font-size: 18px;">Tiếp tục mua sắm</a>
                        <a href="thanhtoan.php" style="font-size: 18px;">
                            Thanh toán
                        </a> 
                        <a href="giohangxoa-user.php" style="font-size: 18px;">Xóa giỏ hàng</a>
                    </div>
                </div>

                <!-- right -->
                <!-- <div class="col-md-6 contact-right-content">
                
                </div> -->
            </div>
        </div>
    </section>
    
</body>
</html>