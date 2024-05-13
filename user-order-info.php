<?php
    include "connect.php";

    if(isset($_GET['mahd'])) {
        $mahd = $_GET['mahd'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/images/pic/logoicon.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user-order.css">
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,  initial-scale=0.9,maximum-scale=1">
    <title>Order Detail</title>
</head>
<body>
  <div class="container">
    <article class="card">
        <?php
            $sql = mysqli_query($conn, "select * from hoadon where mahd='$mahd'");
            $row = mysqli_fetch_assoc($sql);
        ?>
        <header class="card-header" style="display: flex; justify-content: start; align-items: center;"> 
        <h3 style="font-size: 17px; font-weight: 600; margin-right: 15px;">Đơn hàng của <?php echo $row['tendangnhap']?></h3>
        <h3 style="font-size: 17px;">ID: <?php echo $mahd?></h3>
        </header>
        <!-- php code -->

        <div class="card-body">         
            <article class="card">
                <div class="card-body col">
                  <div class="row" style="display: flex; justify-content: flex-start;">                 
                    <span style="margin-right: 25px; margin-left: 10px;"><strong>Ngày đặt hàng:</strong> <?php echo $row['ngaydathang']?></span>              
                    </div>                    
                </div>
            </article>
            
            <hr>
            <div class="osahan-account-page-right  bg-white p-2 h-100">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                <div class="media">

                                <!-- php code -->
                                <?php 
                            $sql1=mysqli_query($conn, "select * from chitiethoadon where mahd='$mahd'");
                            $row1=mysqli_fetch_assoc($sql1);
                            // echo $row1['tensp'];

                            // Cắt chuỗi để lấy tên sản phẩm
                            $chuoi = $row1['tensp'];
                            $chuoi_rieng_le = explode(", ", rtrim($chuoi, ", "));

                            // Cắt chuỗi để lấy số lượng sản phẩm
                            $chuoi2 = $row1['soluongmua'];
                            $mang = explode(", ", $chuoi2);
                            array_pop($mang);
                            $a = 0;

                            foreach($chuoi_rieng_le as $phan) {
                                ?>
                                <!-- truy vấn lấy ra thông tin sản phẩm -->
                                <?php
                            $sql4=mysqli_query($conn, "select * from sanpham where tensp='$phan'");
                            $row4=mysqli_fetch_assoc($sql4);
                                ?>
                        
                        <div class="media-body">                                    
                                <a href="#">
                                    <img class="mr-4" src="images/<?php echo $row4['hinhanh']?>" alt="Generic placeholder image">
                                </a>
                                <h6 class="mb-2" style="font-size: 18px;">
                                    <?php echo $phan?>
                                </h6>
                                <div class="flex-container">
                                    <p class="mb-3"><?php echo $row4['giaban']?>vnđ</p>
                                    <p class="text-gray mb-1">x<?php echo $mang[$a]?></p>                                        
                                </div>
                                            
                                <p  style="color: #26aa99;"><i class="fa-solid fa-truck"></i> Đang giao hàng</p>

                                <?php
                                $a++;
                            }
                                ?>

                                        <p class="mb-0 text-black text-primary pt-2" id="total-money"><span class="text-black font-weight-bold"> Tổng tiền:</span> <?php echo $row1['tongtien']?>vnđ</p>                           
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h6>Thông tin giao hàng</h6>

          <!-- truy vấn lấy thông tin khách hàng -->

          <?php
            $tdn = $row['tendangnhap'];
            $sql2=mysqli_query($conn, "select * from khachhang where tendangnhap='$tdn'");
            $row3=mysqli_fetch_assoc($sql2);
          ?>

          <article class="card">
            <div class="card-body row"  style="padding-bottom: 0;">
              <div class="col"> <strong><?php echo $row3['hovaten']?> </strong><br> (+84) <?php echo $row3['sdt']?> <br><?php echo $row3['email']?></div>
           
              <div class="col"> <strong>Địa chỉ:</strong> <?php echo $row3['quanhuyen'] . ", " . $row3['tptinh'] . ", " . $row3['quocgia']?></div>
             
         
  
            </div>
         
            <div class="card-body row">
              <div class="col"> <strong>Ghi chú:</strong> <?php echo $row1['luuy']?> </div>
        
         
               
               
            </div>
        
        </article>
            <hr>
            <a href="history.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Quay lại</a>
        </div>
    </article>
</div>
</body>
</html>


