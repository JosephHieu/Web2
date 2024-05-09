<?php
  include "connect.php";
  session_start();

  if(isset($_GET['mahd'])) {
    $mahd = $_GET['mahd'];
  }

  // echo $mahd;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=0.9,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/admin-order.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
  <div class="container-order-detail">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="invoice-title">                        
              <h4 class="float-end font-size-15" style="margin-bottom: 10px;text-align: center;">Đơn hàng <span style="font-weight: 400;margin-left: 4px;"> #<?php echo $mahd?> </span> 
                <span class="badge bg-success font-size-11 ms-2" style="color: white;font-size: 16px; padding: 6px 10px;margin-left: 4px;">
                  <?php
                    $sql_detail=mysqli_query($conn, "select * from hoadon where mahd='$mahd'");
                    $row=mysqli_fetch_assoc($sql_detail);
                    if($row['trangthai']==1) {
                      echo "Đã giao thành công";
                    } elseif($row['trangthai'] == 2) {
                      echo "Đã xác nhận";
                    } else {
                      echo "Hủy đơn";
                    }
                  ?>
                </span>
              </h4>
              <hr>
              <!-- Phần thông tin khách hàng -->
              <div>
                <!-- truy vấn lấy ra thông tin người đăng nhập đặt hóa đơn -->
                <!-- php code -->
                <?php

                  $tendangnhap = $row['tendangnhap'];

                  // truy vấn thông tin khách hàng
                  $sql1=mysqli_query($conn, "select * from khachhang where tendangnhap='$tendangnhap'");
                  $row1=mysqli_fetch_assoc($sql1);

                ?>
                <h5 class="font-size-16 mb-2">Thông tin khách hàng:</h5>
                <h3 class="h6">Người đặt: <span style="font-weight: 400;"><?php echo $row1['hovaten']?></span></h3>
                <h3 class="h6">Email: <span style="font-weight: 400;"><?php echo $row1['email']?></span></h3>
                <h3 class="h6">Số điện thoại: <span style="font-weight: 400;">+84<?php echo $row1['sdt']?></span></h3>
                <h3 class="h6">Địa chỉ: <span style="font-weight: 400;"><?php echo $row['diachi']?></span></h3>
              </div>
            </div>
            <hr class="my-4">
                    
            <!-- Truy vấn lấy thông tin trong bảng chitiethoadon -->
            <?php
            $sql2=mysqli_query($conn, "select * from chitiethoadon where mahd='$mahd'");
            $row2=mysqli_fetch_assoc($sql2);

            ?>

            <div class="row">
              <div class="col-sm-6">
                <div>
                  <h5 class="font-size-16 mb-2">Thông tin đơn hàng:</h5>
                  <h3 class="h6">Phương thức thanh toán:<span style="font-weight: 400;"> <?php echo $row2['ptthanhtoan']?></span></h5>
                  <h3 class="h6">Ngày đặt hàng:<span style="font-weight: 400;"> <?php echo $row['ngaydathang']?></span></h5>
                </div>
              </div>
                       
              <div class="col-sm-6">
                <div class="text-sm-end"> 
                  <div class="mt-4">
                    <h3 class="mb-1" style="font-size: 16px;">Lưu ý: <span style="font-weight: 400;"><?php echo $row2['luuy']?></span></h3>                   
                  </div>  
                </div>
              </div>
            </div>
              <!-- end row -->
            <hr class="my-3">

            <!-- php code -->


            <div class="py-2">
              <h5 class="font-size-15">Sản phẩm đã đặt:</h5>
                <div class="table-responsive">
                  <table class="table table-borderless" id="order-detail-table">
                    <thead>
                      <tr style="border-bottom: 1px solid black;">
                        <th>No.</th>
                        <th >Mặt hàng</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th >Tổng cộng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        // Cắt chuỗi để lấy thông tin sản phẩm
                        $chuoi = $row2['tensp'];
                        $chuoi_rieng_le = explode(", ", rtrim($chuoi, ", "));
                        $i = 1;
                        $a = 0;

                        // cắt chuỗi để lấy số lượng sản phẩm
                        $chuoi2 = $row2['soluongmua'];
                        $mang = explode(", ", $chuoi2);
                        array_pop($mang);
                        foreach ($chuoi_rieng_le as $phan) {
                          ?>
                          <tr>
                            <th scope="row">0<?php echo $i?></th>
                            <td>
                              <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                  <img src="assets/images/sp/cocaori.png" alt="" width="55" class="img-fluid">
                                </div>
                                <div class="flex-lg-grow-1 ms-3" >
                                  <h6 class="small mb-0"><aclass="text-reset"><?php echo $phan?></aclass=></h6>
                                  <!-- truy vấn lấy thông tin sản phẩm -->

                                  <?php
                                $sql3=mysqli_query($conn, "select * from sanpham where tensp='$phan'");
                                $row3=mysqli_fetch_assoc($sql3);
                                  ?>

                                  <span class="small">Giá: <?php echo $row3['giaban']?>vnđ</span>
                                </div>
                              </div>
                            </td>
                            <td>
                              <img src="images/<?php echo $row3['hinhanh']?>" alt="chưa có" width="50px">
                            </td>
                            <td>x<?php echo $mang[$a]?></td>
                            <td class="text-end"><?php echo ($row3['giaban'] * $mang[$a])?>vnđ</td>
                            <?php
                          $i++;
                          $a++;
                        }
                      ?>
                            
                      <!-- cắt chuổi để lấy số lượng sản phẩm -->
                     
                      <div>

                      </div>

                          
                      </tr>
                    </tbody>
                  </table>

                  <table id="table-price" style="margin-bottom: 10px; margin-left: 10px;">
                    <tbody>     
                      <tr class="fw-bold" style="border-top: 1px solid black;">
                        <td colspan="2" style="font-size: 20px; font-weight: 600;">Tổng tiền:</td>
                        <td class="text-end" style="font-size: 20px; font-weight: 600;"><?php echo $row2['tongtien']?>vnđ</td>
                      </tr>
                         
                    </tbody>
                  </table>
            </div>
                <!-- end table responsive -->
                <div class="d-print-none mt-4">
                    <div class="float-end">
                        <a href="javascript:window.print()" id="print-order"><i class="fa fa-print"></i></a>          
                        <a id="back-to-admin-order" onclick="window.location.href='admin-order.php'">Quay lại</a> 
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div><!-- end col -->
    </div>
  </div>
</body>
</html>

