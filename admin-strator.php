<?php
    include "connect.php";

    // truy vấn thêm strator
    if(isset($_POST['add_strator'])) {
        $tendangnhap  = $_POST['tendangnhap'];
        $email        = $_POST['email'];
        $vaitro       = $_POST['vaitro'];
        $sdt          = $_POST['sdt'];
        $diachi       = $_POST['diachi'];
        $matkhau      = md5($_POST['matkhau']);
        $matkhau1     = md5($_POST['matkhau1']);
        $trangthai    = 'Bình thường';

        // truy vấn thêm quản lý
        $insert_query = mysqli_query($conn, "insert into nguoiquantri
        (tendangnhap, matkhau, vaitro, email, sdt, diachi, trangthai)
        values ('$tendangnhap', '$matkhau', '$vaitro', '$email', '$sdt', 
        '$diachi', '$trangthai')") or die('truy vấn thêm quản lý thất bại');

        if($matkhau !== $matkhau1) {
            echo "<script>
                alert('Mật khẩu không khớp');
            </script>";
        }else {
            if($insert_query) {
                $display_message = "Thêm thành công";
            }
            else {
                $display_message = "Thêm thất bại";
            }
        }

    }

    // Phân trang
  // đặt start từ giá trị
  $start = 0;

  // đặt số lượng dòng để hiện trên một trang
  $rows_per_page = 4;

  // lấy tổng số côt
  $records = $conn->query("select * from nguoiquantri");
  $nr_of_rows = $records->num_rows;

  // tính nr của pages
  $pages = ceil($nr_of_rows / $rows_per_page);

  // if the user clicks on the paginition buttons we set a new starting point
  if(isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
  }

  $result = $conn->query("select * from nguoiquantri limit ".$start.", ".$rows_per_page."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quản trị</title>
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
                  <span class="las la-address-card"  style="color: #fff;"></span>
                  <small  style="color: #fff;">Quản trị viên</small>
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
                <a href="admin-order.php">
                      <span class="las la-shopping-cart"></span>
                      <small>Thống kê</small>
                  </a>
              </li>               
            </ul>
          </div>
    </div>
  </div>
    <!-- Phần nội dung chinh -->
    <div class="main-content">
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
                        <span class="notify">14</span>
                    </div>
                    
                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">33</span>
                    </div>
                    
                    <div class="user" style="margin-right: 8px;">
                       
                        
                        <span style="font-size: 25px;cursor: pointer;" class="las la-power-off" onclick="window.location.href='admin-logout.php'"></span>
                        <span style="font-size: 20px; cursor: pointer;" onclick="window.location.href='admin-logout.php'">Đăng xuất</span>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Hiển thị người quản trị -->
        <main>             
            <div class="page-content" >  
                <!-- dislay message -->
                <?php 
                    if(isset($display_message)) {
                        echo "<div class='display_message' style='color: red;'>
                                <span>$display_message</span>
                                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                            </div>";
                    }
                ?>
                <h1 style="padding: 1.3rem 0rem;color: #74767d;" id="adminstrator">Người quản lý</h1>
                <div >
                    <button style="margin-bottom: 8px;" id="showadd" onclick="showadd()"><i class="fa-solid fa-circle-plus" style="margin-right: 4px;"></i> Thêm quản lý</button>                          
                </div>
                <!-- form thêm người quản lý -->
                <form action="admin-strator.php" method="post" enctype="multipart/form-data">
                    <div class="add_product_admin" style="display: flex; justify-content: space-around; align-items: center;">
                        <div class="ada1">
                            <label for="tendangnhap">Tên đăng nhập</label>
                            <input type="text" name="tendangnhap" id="tendangnhap" required>
                        </div>
                        <div class="ada1">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" required>
                        </div>
                        <div class="ada1">
                            <label for="vaitro">Vai trò</label>
                            <select name="vaitro" id="vaitro" required>
                                <option>Chọn</option>
                                <option>Quản lý khách hàng</option>
                                <option>Quản lý đơn hàng</option>
                                <option>Quản lý sản phẩm</option>
                            </select>
                        </div>
                    </div>
                    <div class="add_product_admin" style="display: flex; justify-content: space-around; align-items: center; padding-top: 30px;">
                        <div class="ada1">
                            <label for="sdt">Số điện thoại</label>
                            <input type="number" name='sdt' id='sdt' required>
                        </div>
                        <div class="ada1">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" name='diachi' id='diachi' required>
                        </div>
                        <div class="ada1">
                            <label for="matkhau">Mật khẩu</label>
                            <input type="password" name='matkhau' id='matkhau' required>
                        </div>
                        <div class="ada1">
                            <label for="matkhau1">Nhập lại mật khẩu</label>
                            <input type="password" name='matkhau1' id='matkhau1' required>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: left-start; margin-left: 100px; margin-top: 20px;">
                        <button type="submit" name="add_strator" style="padding: 10px 15px;">Thêm +</button>
                    </div>
                </form>
            </div>
            
            <div class="records table-responsive" style="margin-top: 30px;">             

                <div>
                <!-- php code -->
                <?php
        $display_strator = mysqli_query($conn, "select * from nguoiquantri");
        $nums = 1;
        if(mysqli_num_rows($display_strator) > 0) {
                echo " <table width='100% id='table-adminstrator'>
                <thead>
                    <tr id='select-filter'>
                        <th> EMAIL</th>
                        <th> Tên đăng nhập</th>
                        <th> Vai trò </th>
                        <th> Địa chỉ </th>
                        <th> Trạng thái </th>
                        <th> Thao tác </th>
                    </tr>
                </thead>
                <tbody>";

                // while($row=mysqli_fetch_assoc($display_strator)) {
                while($row=$result->fetch_assoc()) {
                    ?>
                    <tr>                                                           
                        <td>
                        <?php echo $row['email']?>
                        </td>
                        <td>
                        <?php echo $row['tendangnhap']?>
                        </td>
                        <td>
                        <?php echo $row['vaitro']?>
                        </td>
                        <td>
                        <?php echo $row['diachi']?>
                        </td>
                        <td>
                        <!-- block admin strator -->
                        <?php
                            if($row['trangthai'] == 1) {
                                echo "
                                    <p>
                                        <a href='block-strator.php?tdn=".$row['tendangnhap']."
                                        &trangthai=0' style='color: green;'
                                        '>
                                        Hoạt động 
                                        <i class='fa fa-unlock-alt' aria-hidden='true'></i>
                                        </a>
                                    </p>";
                            } else {
                                echo "
                                    <p>
                                        <a href='open-strator.php?tdn=".$row['tendangnhap']."
                                        &trangthai=1' style='color: red;'>
                                        Không hoạt động
                                        <i class='fa fa-lock' aria-hidden='true'></i>
                                        </a>
                                    </p>";
                            }
                        ?>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="admin-update-strator.php?edit=<?php echo $row['tendangnhap']?>">
                                    Sửa<span class="las la-edit"></span>
                                </a>
                                <!-- <span class="las la-lock"></span> -->
                            </div>
                        </td>
                    </tr>
                    <?php
                }
        }
                ?>                           
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
    </div>
</body>
</html>

<!-- của phần phân trang -->
<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>





