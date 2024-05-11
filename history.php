<?php
    include "connect.php";
    session_start();

    $tendangnhap = $_SESSION['mySession'];
    // $sql=mysqli_query($conn, "select * from chitiethoadon where tendangnhap='$tendangnhap'");
    // if(mysqli_num_rows($sql)>0) {
    //     while($row=mysqli_fetch_assoc($sql)) {
    //         echo $row['mahd'];
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lịch sử mua hàng</title>
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/history.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5;">

  
<div class="containerz">
    <div class="row">
        <!-- Phần nav -->
        <div class="col-md-3" style="border: 1px solid #DFDFDF;padding-left: 0;padding-right: 0;" >
            <div class="osahan-account-page-left bg-white h-100">
                <div class="border-bottom p-4">
                    <div style="display: flex; justify-content: center;"  id="logo-history">
                        <img src="images/LOGO.webp" class="logo-user" style="cursor: pointer;" onclick="window.location.href='index-user.php' ">
                    </div>
                                   
                </div>
              
           
                    <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="user.php">Thông Tin</a>
                    <a class="list-group-item list-group-item-action active" data-toggle="list"
                    href="history.php">Lịch Sử Mua Hàng</a>

                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="changepass.php">Thay đổi mật khẩu</a>
             

                   
               
            </div>
        </div>

        <!-- Phần lịch sử mua hàng -->
        <div class="col-md-9" style="border: 1px solid #DFDFDF;padding-left: 6px; padding-right: 6px ;" class="right-containers">
            <div class="osahan-account-page-right  bg-white p-2 h-100">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Lịch sử mua hàng</h4>

                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                
                                <!-- truy vấn lấy thông tin sản phẩm trong chitiethoadon -->
                                <!-- php code -->
                                <?php
                            $sql=mysqli_query($conn, "select * from chitiethoadon where tendangnhap='$tendangnhap'");
                            if(mysqli_num_rows($sql)>0) {
                                while($row=mysqli_fetch_assoc($sql)) {
                                    ?>
                                    
                                    <!-- Cắt chuỗi để lấy thông tin sản phẩm -->
                                    <?php
                                        $chuoi = $row['tensp'];
                                        $chuoi_rieng_le=explode(", ", rtrim($chuoi, ", "));
                                        
                                        // Cắt chuỗi để lấy số lượng sản phẩm
                                        $chuoi2=$row['soluongmua'];
                                        $mang=explode(", ", $chuoi2);
                                        array_pop($mang);
                                        $a = 0;
                                        foreach($chuoi_rieng_le as $phan) {
                                            ?>
                                            <div class="media">
                                            <div class="media-body">   
                                                        <?php
                                                    $sql2=mysqli_query($conn, "select * from sanpham where tensp='$phan'");
                                                    $row3=mysqli_fetch_assoc($sql2);
                                                        ?>
                                                <a href="#">
                                                    <img class="mr-4" src="images/<?php echo $row3['hinhanh']?>" alt="Generic placeholder image">
                                                </a>
                                                <h6 class="mb-2" style="font-size: 18px;">                                         
                                                    <?php echo $phan?>
                                                </h6>

                                                <div class="flex-container">
                                                    <!-- truy vấn lấy ra giá của sp -->
                                                        <p class="mb-3"><?php echo $row3['giaban']?>vnđ</p>
                                                        <p class="text-gray mb-1">x<?php echo $mang[$a]?></p>                                         
                                                </div>                                  
                                                <?php
                                                $a++;
                                        }
                                        ?>   
                                            <div style="display: flex; justify-content: space-between;">
                                                <p class="mb-0 text-black text-primary pt-2" id="total-money"><span class="text-black font-weight-bold"> Tổng thanh toán:</span> <?php echo $row['tongtien']?>vnđ</p>
                                                <a class="btn btn-sm btn-outline-primary" href="user-order-info.php?mahd=<?php echo $row['mahd']?>">
                                                    <i class="icofont-headphone-alt"></i>
                                                    Chi tiết đơn hàng
                                                </a>                                          
                                            </div>
                                        <hr>
                                    </div>
                                </div>

                                    <?php
                                }
                            }
                            else {
                                echo "Chưa có đơn hàng nào. Hãy đặt đơn hàng đầu tiên !!!";
                            }
                                ?>
                            </div>
                        </div>
                     
                        
                        <div  id="profile-button" style="display: flex; justify-content:center;margin-top: 50px; margin-bottom: 20px;">
                            <button type="button" class="btn btn-default" id="button-go-back" onclick="window.location.href='shop-user.php'"><i class="fa-solid fa-chevron-left"></i> Quay Lại</button>
                            <button type="button" class="btn btn-primary">Lưu</button>&nbsp;
                           
                        </div>

                    </div>
                </div>
           
            </div>
            
        </div>
    </div>
</div>
</body>
</html>