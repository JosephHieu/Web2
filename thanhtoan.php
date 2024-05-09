<?php
    include "connect.php";
    session_start();
    // echo $_SESSION['giohang'][0][0];
    // echo $_SESSION['giohang'][1][1];
    // echo $_SESSION['giohang'][0][2];
    // echo $_SESSION['giohang'][0][3];
    // echo $_SESSION['giohang'][0][4];

    $tendangnhap = $_SESSION['mySession'];

    if(isset($_POST['add_order'])) {

        // đẩy dữ liệu lên hóa đơn
        $mahd        = "DH" . rand(0, 999999);
        $_SESSION['mahd'] = $mahd;

        // truy vấn lấy tên đăng nhập
        $sql         = mysqli_query($conn, "select * from khachhang where tendangnhap='$tendangnhap'");
        $row         = mysqli_fetch_assoc($sql);
        $tendangnhap = $row['tendangnhap'];

        $diachi = $_POST['diachi'];
        $ngaydathang = date("Y-m-d");

        $trangthai   = 1;

        $insert_order=mysqli_query($conn, "insert into hoadon(mahd, tendangnhap, diachi, ngaydathang, trangthai)
        values ('$mahd', '$tendangnhap', '$diachi', '$ngaydathang', '$trangthai')") or die('Truy vấn thất bại');

        // đẩy dữ liệu lên chi tiết hóa đơn

        // Lấy thông tin sản phẩm trong giỏ hàng
        // $tt = 0;
        // $tong = 0;
        // $i = 0;
        // $masp = 0;
        // foreach($_SESSION['giohang'] as $item) {
        //     $tt = $item[3] * $item[4];  
        //     $tong += $tt;
        //     $masp = $_SESSION['giohang'][$i][0];
        //     echo $masp;
            
        //     $i++;
        // }
        $masp        = $_SESSION['giohang'][0][0];
        $ptthanhtoan = $_POST['ptthanhtoan'];
        $luuy        = $_POST['luuy'];
        $i           = 0;
        $tenallsp    = "";
        $soluongmua  = "";
        $tt          = 0;
        $tongtien    = 0;
        foreach($_SESSION['giohang'] as $item) {
            $tensp      = $_SESSION['giohang'][$i][1];
            $tenallsp   .= $tensp . ", ";
            $soluongmua .= (string)$_SESSION['giohang'][$i][4] . ", ";
            $tt         = $item[3] * $item[4];
            $tongtien   += $tt;

            $i++;
        }
        
        // mahd, masp, tendangnhap, ptthanhtoan, luuy, tensp, soluongmua, tongtien
        $insert_order_detail=mysqli_query($conn, "insert into chitiethoadon (mahd, masp, tendangnhap, ptthanhtoan, luuy, tensp, soluongmua, tongtien)
        values ('$mahd', '$masp', '$tendangnhap', '$ptthanhtoan', '$luuy', '$tenallsp', '$soluongmua', '$tongtien')")
        or mysqli_error($insert_order);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/pay.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <title>Trang thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="display: flex; position: relative;">
<h1 style="position: absolute; top: 5%; left: 40%; font-weight: 600;">Thanh toán</h1>

<!-- hiển thị giỏ hàng -->
        <div class="col-xl-4" style="margin-top: 100px;">
            <div class="card checkout-order-summary">
                <div class="card-body">    
                    <div class="p-3 bg-light mb-3">    
                        <h5 class="font-size-30 mb-0" style="font-weight: 600;">Đơn hàng</h5> 
                    </div>
                    <div class="table-responsive">
                        <!-- Hiển thị đơn hàng từ giỏ hàng -->
                        <?php
                        if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang'])>0)) {
                            echo '<table class="table table-centered mb-0 table-nowrap"">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Chi tiết</th>
                                <th>Giá tiền</th>
                            </tr>';
                            $tt = 0;
                            $tong = 0;
                            foreach($_SESSION['giohang'] as $item) {
                                $tt = $item[3] * $item[4];
                                $tong += $tt;
                                echo '<tr>
                                <td>
                                <img src="images/'.$item[2].'" alt="ảnh sản phẩm" style="width: 70px; height: 70px;">     
                                </td>
                                <td>
                                    <h5 class="font-size-16 text-truncate"><a href="#" class="text-dark">'.$item[1].'</a></h5>
                                    <p class="text-muted mb-0 mt-1">'.$item[3].' x '.$item[4].'</p>
                                </td>
                                <td>'.$tt.'vnđ</td>                               
                            </tr>';
                            }
                            echo '<tr>
                            <td colspan="2">Tổng cộng: </td><td>'.$tong.'vnđ</td><td></td>
                        </tr>';
                            ?>
                        <form action="pay.php" method="post">
                            <input type="hidden" name="tongdonhang" value="<?=$tong?>">
                        </form>
                            <?php
                            echo "</table>";
                        } else {
                            echo "Đơn hàng trống";
                        }
                        ?>
                    </div>
                </div>
            </div>        
        </div> 
        <div class="col-xl-8" style="margin-top: 100px; ">
            <div class="card checkout-order-summary">
                <div class="card-body">    
                    <div class="p-3 bg-light mb-3">    
                        <h5 class="font-size-30 mb-0" style="font-weight: 600;">Thông tin khách hàng</h5> 
                    </div>
                    <div class="table-responsive">
                        <form action="thanhtoan.php" method="post" style="display: flex; flex-direction: column; gap: 20px;">

                            <!-- lấy địa chỉ hiện tại -->
                            <!-- php code -->
                            <?php
                        $sql = mysqli_query($conn, "select * from khachhang where tendangnhap='$tendangnhap'");
                        $row=mysqli_fetch_assoc($sql);
                        ?>
                            <div>
                                <label for="diachi1">Địa chỉ hiện tại</label>
                            </div>
                            <textarea name="diachi" id="diachi" style="height: 29px;">
                                <?php
                                    echo $row['quanhuyen'] . ", " . $row['tptinh'] . ", " . $row['quocgia'];
                                ?>
                            </textarea>

                            <div>
                                <label for="diachi2" id="themdiachi">Thêm địa chỉ khác (Không bắt buộc)</label>
                            </div>
                            <div id="hiddenDiv1" class="hidden" style="display: flex; justify-content: space-around;">
                                <input type="text" name="quanhuyen" placeholder="Số nhà, tên đường, quận">
                                <input type="text" name="tptinh" placeholder="Thành phố/tỉnh">
                                <input type="text" name="quocgia" placeholder="Quốc gia">
                            </div>


                            <h5 style="font-weight: 600;">Phương thức thanh toán</h5>
                            <div>
                                <label for="cod">Thanh toán khi nhận hàng</label>
                                <input type="radio" name="ptthanhtoan" id="option1" value="COD" required>

                                <label for="tructuyen">Thanh toán Trực tuyến</label>
                                <input type="radio" name="ptthanhtoan" id="option2" value="Thanh toán trực tuyến" required>
                            </div>
                            
                            <div id="hiddenDiv" class="hidden">
                                <label for="">Số thẻ</label>
                                <input type="number" name="sothe" placeholder="Nhập số thẻ">

                                <label for="" style="margin-left: 20px;">Ngày hết hạn</label>
                                <input type="date">

                                <label for="" style="margin-left: 20px;">CVV</label>
                                <input type="text" placeholder="Nhập CVV">
                            </div>

                            <div>
                                <label for="luuy">Lưu ý:</label>
                                <input type="text" name="luuy" placeholder="Ghi chú về đơn hàng" id="luuy">
                            </div>

                            <div>
                                <a href="shop-user.php"><- Tiếp tục mua sắm</a>
                                <button type="submit" name="add_order" class="done" style="margin-top: 20px; margin-left: 20px; padding: 10px 15px; background: green; font-weight: 600; border-radius: 5px;"
                                onclick="return confirm('Bạn có muốn đặt hàng không ?');
                                alert('Đặt hàng thành công.');">Hoàn tất</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </div> 
</body>
</html>

<style>
    .hidden {
        display: none;
    }

    .done:hover {
        border-radius: 999px;
        opacity: 0.8;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var option1 = document.getElementById("option1");
    var option2 = document.getElementById("option2");
    var hiddenDiv = document.getElementById("hiddenDiv");

    option1.addEventListener("click", function() {
        hiddenDiv.style.display = "none";
        option2.checked = false;
    });

    option2.addEventListener("click", function() {
        hiddenDiv.style.display = "block";
        option1.checked = false;
    });
    });
</script>
