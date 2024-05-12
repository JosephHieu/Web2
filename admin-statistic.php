<?php
    include "connect.php";  
    session_start();    
    $tendangnhap = $_SESSION['mySession'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Thống kê</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<input type="checkbox" id="menu-toggle">
   <div class="sidebar">
    <!-- side header -->
    <div class="side-header" style="background: #35858b;">
        <img src="images/Tình AE.jpg" alt="" width="165px" height="60px;">
    </div>       
      <div class="side-content" style="background: #aefeff;">
        <div class="profile">
          <div class="profile">
            <img src="images/LOGO.webp" alt="" width="50px" height="50px">
            <h4>Đồ dùng học tập</h4>                   
          </div>
        </div>
        <!-- phần side menu -->
          <div class="side-menu">
            <ul>
              <li>
                <a href="admin-strator.php">
                  <span class="las la-address-card"></span>
                  <small>Quản trị viên</small>
                </a>
              </li>
              <li>
                <a href="admin-user.php">
                  <span class="las la-user-alt"></span>
                  <small>Khách hàng</small>
                </a>
              </li>             
              <li>
                <a href="admin-product.php">
                  <span class="las la-clipboard-list"></span>
                  <small>Sản phẩm</small>
                </a>
              </li>
              <li>
                <a href="admin-order.php">
                      <span class="las la-shopping-cart"></span>
                      <small>Đơn hàng</small>
                  </a>
              </li>
              <li>
                <a href="admin-statistic.php">
                      <span class="las la-shopping-cart" style="color: #fff;"></span>
                      <small style="color: #fff;">Thống kê</small>
                  </a>
              </li>               
            </ul>
          </div>
    </div>
  </div>
    
    <div class="main-content" >
        <!-- header -->
        <header style="background: #35858b;">
            <div class="header-content">
                <label for="menu-toggle" id="bar-admin">
                    <span class="las la-bars" style="font-size: 28px; margin-top: 8px;"></span>
                </label>
                
                <div class="header-menu">
                    <label for="">
                    
                    </label>
                    <div class="notify-icon">
                      <span class="las la-envelope"></span>
                      <span class="notify">44</span>
                  </div>
                  
                  <div class="notify-icon">
                      <span class="las la-bell"></span>
                      <span class="notify">35</span>
                  </div>
                    <div class="user" style="margin-right: 8px;">
         
                        <span style="font-size: 25px;cursor: pointer;" class="las la-power-off" onclick="window.location.href='admin-logout.php'"></span>
                        <span style="font-size: 20px; cursor: pointer;" onclick="window.location.href='admin-logout.php'">Đăng xuất</span>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-content" style="margin-top: 50px;">
            <h1 style="padding: 1.3rem 0rem;color: #74767d;" id="order">Thống kê</h1>
            <div >
                <a href="">
                  <button style="margin-bottom: 8px;" id="showadd" onclick="showadd()"><i class="fa-solid fa-circle-plus" style="margin-right: 4px;"></i>
                    Thống kê
                  </button> 
                </a>                         
            </div>
            <!-- form lọc đơn hàng -->
            <form action="admin-statistic.php" method="post">
                <label for="">Từ ngày</label>
                <input type="date" name="tungay">
                <label for="">Đến ngày</label>
                <input type="date" name="denngay">
                <button type="submit" name="thongkehd" style="margin-left: 50px; margin-top: 20px; padding: 10px 15px;">Thống kê hóa đơn</button>
            </form>
        </div>
        
        <div class="records table-responsive" >         
            <div>
                <!-- Thống kê hóa đơn của khách hàng -->
              <?php 
            if(isset($_POST['thongkehd'])) {
                $tungay  = $_POST['tungay'];
                $denngay = $_POST['denngay'];
        
                $display_statistic = mysqli_query($conn, "SELECT chitiethoadon.tendangnhap, SUM(soluongmua) as tongsoluongmua, SUM(tongtien) as tongmua from chitiethoadon
                    join  hoadon on hoadon.mahd=chitiethoadon.mahd
                    where hoadon.ngaydathang between '".$_POST['tungay']."' and '".$_POST['denngay']."'
                    group by tendangnhap
                    order by tongmua desc
                    limit 5
                    ") or die(mysqli_error($conn));
                    if(mysqli_num_rows($display_statistic)>0) {
                      echo '
                      <table width="100%" id="table-order">
                          <thead>
                              <tr id="select-filter">    
                                  <th>Tên đăng nhâp</th>                                         
                                  <th>Họ và tên</th>    
                                  <th> Số lượng mua </th>
                                  <th> Tổng mua</th>
                                  <th> Chi tiết đơn hàng</th>
                              </tr>
                          </thead>
                          <tbody>
                          ';
                          while($row=mysqli_fetch_assoc($display_statistic)) {
                              ?>
                              <tr>
                                  <td><?php echo $row['tendangnhap']?></td>
                                  <td>
                                    <!-- truy vấn lấy họ và tên -->
                                    
                                    <?php 
                                      $tdn = $row['tendangnhap'];
                                      $getFullName=mysqli_query($conn, "select * from khachhang where tendangnhap='$tdn'");
                                      $hovaten=mysqli_fetch_assoc($getFullName);
                                      echo $hovaten['hovaten'];
                                    ?>
                                  </td>
                                  <td><?php echo $row['tongsoluongmua']?></td>
                                  <td><?php echo $row['tongmua']?>vnđ</td>
                                  <td>
                                    <a href="admin-statistic-order.php?tdn=<?php echo $row['tendangnhap']?>">
                                        Chi tiết hóa đơn
                                    </a>
                                  </td>
                              </tr>
                          
                          <?php
                          }
                      }
                    ?>
                        <!-- Hiện thông tin đơn hàng -->
                      </tbody>     
                  </table>
                  <?php
            }
            ?>
        

  </div>
        </div>
        </div> 
</main>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>

<!-- của phần phân trang -->
<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>



 

