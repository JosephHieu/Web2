<?php
  include "connect.php";

  session_start();

  $tendangnhap = $_SESSION['mySession'];


  // Phân trang
  // đặt start từ giá trị
  $start = 0;

  // đặt số lượng dòng để hiện trên một trang
  $rows_per_page = 4;

  // lấy tổng số côt
  $records = $conn->query("select * from hoadon");
  $nr_of_rows = $records->num_rows;

  // tính nr của pages
  $pages = ceil($nr_of_rows / $rows_per_page);

  // if the user clicks on the paginition buttons we set a new starting point
  if(isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
  }

  if(isset($_POST['lochoadon'])) {
    // Lấy thông tin từ form để lấy thông tin lọc đơn hàng
    $trangthai = $_POST['tinhtrang'];
    $tungay    = $_POST['tungay'];
    $denngay   = $_POST['denngay'];
    $diachi    = $_POST['diachi'];

    // echo $tinhtrang;
    // echo $tungay . ", " . $denngay;
    // echo $diachi;

    
    if(!empty($trangthai) && !empty($tungay) && !empty($denngay) && !empty($diachi)) {
      $result = $conn->query("SELECT * from hoadon
      where ngaydathang between '$tungay' and '$denngay'
      and trangthai='$trangthai'
      and diachi like '%$diachi%'
      limit ".$start.", ".$rows_per_page."")
      or die(mysqli_error($conn));
    } 
    elseif(!empty($trangthai) && empty($tungay) && empty($denngay) && empty($diachi)) {
      $result = $conn->query("SELECT * from hoadon
      where trangthai='$trangthai'
      limit ".$start.", ".$rows_per_page."")
      or die(mysqli_error($conn));
    }
    elseif(empty($trangthai) && empty($tungay) && empty($denngay) && !empty($diachi)) {
      $result = $conn->query("SELECT * from hoadon
      where diachi like '%$diachi%'
      limit ".$start.", ".$rows_per_page."")
      or die(mysqli_error($conn));
    }
    else {
      $result = $conn->query("select * from hoadon limit ".$start.", ".$rows_per_page."");
    }
  }
  else {
    $result = $conn->query("select * from hoadon limit ".$start.", ".$rows_per_page."");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin đơn hàng</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<!-- của phần phân trang -->
<?php 
      if(isset($_GET['page-nr'])) {
        $id = $_GET['page-nr'];
      } else {
        $id = 1;
      }
    ?>
<body id="<?php echo $id?>">
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
                      <span class="las la-shopping-cart" style="color: #fff;"></span>
                      <small style="color: #fff;">Đơn hàng</small>
                  </a>
              </li>
              <li>
                <a href="admin-statistic.php">
                      <span class="las la-shopping-cart"></span>
                      <small>Thống kê</small>
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
            <h1 style="padding: 1.3rem 0rem;color: #74767d;" id="order">Đơn hàng</h1>
            <div >
                <a href="admin-order.php">
                  <button style="margin-bottom: 8px;" id="showadd" onclick="showadd()"><i class="fa-solid fa-circle-plus" style="margin-right: 4px;"></i>
                   Tất cả đơn hàng
                  </button> 
                </a>                         
            </div>
            <!-- form lọc đơn hàng -->
            <form action="admin-order.php" method="post">
              <div class="lochd" style="margin: 20px 0 0 50px;">
                <div class="ada" style="margin-top: 20px;">
                  <label for="">Tình trạng đơn hàng</label>
                  <select name="tinhtrang" id="tinhtrang">
                    <option>Chọn</option>
                    <option value="1">Đã giao thành công</option>
                    <option value="2">Đã xác nhận</option>
                    <option value="0">Hủy đơn</option>
                  </select>
                </div>
                <div class="ada" style="margin-top: 20px;">
                  <!-- <label for="">Thời gian đặt hàng</label> -->
                  Từ ngày: <input type="date" name="tungay">
                  Đến ngày: <input type="date" name="denngay">
                </div>
                <div class="ada" style="margin-top: 20px;">
                  <label for="">Địa điểm giao hàng</label>
                  <input type="text" name="diachi">
                </div>
              </div>
              <button type="submit" name="lochoadon" style="margin-left: 50px; margin-top: 20px; padding: 10px 15px;">Lọc đơn hàng</button>
              
        </div>
        
        <div class="records table-responsive" >         
            <div class="record-header">
              <div class="browse">
                <input type="search" placeholder="Tìm kiếm (#ID)" class="record-search">
             </div>
                <div class="add">
                    <span>Entries</span>
                    <select name="" id="">
                        <option value="">10</option>
                        <option value="">16</option>
                        <option value="">20</option>
                    </select> 
                </div>
            </div>
        
            <div>
              <?php 
          $display_order = mysqli_query($conn, "select * from hoadon");
          if(mysqli_num_rows($display_order)>0) {
            echo '
            <table width="100%" id="table-order">
                <thead>
                    <tr id="select-filter">
                        <th>MaDH</th>                                             
                        <th>Họ và tên</th>
                        <th> Địa chỉ </th>      
                        <th> Ngày đặt hàng </th>
                        <th> Trạng thái </th>
                        <th> Chi tiết đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                ';
                // while($row=mysqli_fetch_assoc($display_order)) {
                while($row=$result->fetch_assoc()) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $row['mahd']?>
                    </td>
                    <td>
                      <!-- Lấy họ và tên người mua hàng -->
                      <?php
                    $ten = $row['tendangnhap'];
                    $layten = mysqli_query($conn, "select * from khachhang where tendangnhap='$ten'");
                    $row1=mysqli_fetch_assoc($layten);
                      ?>
                      <?php echo $row1['hovaten']?>
                    </td>
                    <td>
                      <?php echo $row['diachi']?>
                    </td>
                    <td>
                      <?php echo $row['ngaydathang']?>                        
                    </td>
                    <td>
                      <?php 
                        if($row['trangthai'] == 1) {
                          echo "
                            <p>
                                <a href='admin-update-order.php?mahd=".$row['mahd']."' style='color: green;'
                                '>
                                Đã giao thành công 
                                <i class='fas fa-edit'></i>
                                </a>
                            </p>";
                        } else if($row['trangthai'] == 2) {
                          echo "
                            <p>
                                <a href='admin-update-order.php?mahd=".$row['mahd']."' style='color: #f89c0e;'
                                '>
                                Đã xác nhận
                                <i class='fas fa-edit'></i> 
                                </a>
                            </p>";
                        } else {
                          echo "
                            <p>
                                <a href='admin-update-order.php?mahd=".$row['mahd']."' style='color: red;'
                                '>
                                Hủy đơn 
                                <i class='fas fa-edit'></i>
                                </a>
                            </p>";
                        }
                      ?>
                    </td>
                    <td>
                      <a href="admin-order-detail.php?mahd=<?php echo $row['mahd']?>">Chi tiết</a>
                    </td>
                  </tr> 
              
              <?php
            }
          }
          ?>
              <!-- Hiện thông tin đơn hàng -->
            </tbody>     
        </table>
        <!-- Phần phân trang -->
  <!-- displaying the page info text -->
  <div class="page-info">
    <?php 
      if(!isset($_GET['page-nr'])) {
          $page = 1;
      } else {
          $page = $_GET['page-nr'];
      }
    ?>
    <p style="text-align: center; padding-top: 15px;">Hiện <?php echo $page?> trên <?php echo $pages?> trang</p>
  </div>

  <!-- displaying the pagination buttons -->
  <div class="pagination">
    <!-- Tới trang đầu tiên -->
    <a href="?page-nr=1" style="padding: 0 15px;">Trang đầu</a>

    <!-- Tới trang trước -->
    <?php 
      if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
          ?>
          <a href="?page-nr=<?php echo $_GET['page-nr'] - 1?>" style="padding: 0 15px;">Trang trước</a>            
          <?php
      } else {
          ?>
          <a href="" style="padding: 0 15px;">Trang trước</a>
          <?php
      }
    ?>

        <!-- Output the page numbers -->
        <div class="page-numbers">
            <?php 
                for($counter=1; $counter <= $pages; $counter++) {
                    ?>
                    <a href="?page-nr=<?php echo $counter?>" style="padding: 0 15px;"><?php echo $counter?></a>
                    <?php
                }
            ?>
        </div>

        <!-- Go to the next page -->
        <?php 
            if(!isset($_GET['page-nr'])) {
                ?>
                <a href="?page-nr=2" style="padding: 0 15px;">Trang sau</a>
                <?php
            }else {
                if($_GET['page-nr'] >= $pages) {
                    ?>
                    <a href="" style="padding: 0 15px;">Trang cuối</a>
                    <?php
                } else {
                    ?>
                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1?>" style="padding: 0 15px;">Trang sau</a>
                    <?php
                }
            }
        ?>


        <!-- Go to the last page -->
        <a href="?page-nr=<?php echo $pages?>" style="padding: 0 15px;">Trang cuối</a>


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



 

