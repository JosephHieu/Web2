<?php
  include "connect.php";

  function kiemTraChuoi($chuoi) {
    // Biểu thức chính quy để kiểm tra chuỗi
    $regex = '/[!@#$%^&*()\-_=+*\/?><,.|\\\\]/';

    // Sử dụng hàm preg_match để kiểm tra xem chuỗi có chứa các ký tự không mong muốn không
    if (preg_match($regex, $chuoi)) {
        return false; 
    } else {
        return true; 
    }
}

  function is_valid_email($email) {
    // Sử dụng hàm filter_var với FILTER_VALIDATE_EMAIL để kiểm tra tính hợp lệ của email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Email hợp lệ
    } else {
        return false; // Email không hợp lệ
    }
}

function passwords_match($password1, $password2) {
  // Kiểm tra xem hai mật khẩu có giống nhau không
  if ($password1 === $password2) {
      return true; // Hai mật khẩu giống nhau
  } else {
      return false; // Hai mật khẩu không giống nhau
  }
}

  if(isset($_POST['add_user'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $hovaten     = $_POST['hovaten'];
    $sdt         = $_POST['sdt'];
    $email        = $_POST['email'];
    $matkhau     = md5($_POST['matkhau']);
    $matkhau1    = md5($_POST['matkhau1']);
    $namsinh     = $_POST['namsinh'];
    $quanhuyen   = $_POST['quanhuyen'];
    $tptinh      = $_POST['tptinh'];
    $quocgia     = $_POST['quocgia'];
    $trangthai   = 1;

    $insert_query = mysqli_query($conn, "insert into khachhang
    (tendangnhap, hovaten, sdt, email, matkhau, namsinh, quanhuyen,
    tptinh, quocgia, trangthai)
    values ('$tendangnhap', '$hovaten', '$sdt', '$email', '$matkhau',
    '$namsinh', '$quanhuyen', '$tptinh', '$quocgia', '$trangthai')")
    or die('truy vấn thêm khách hàng thất bại');

    if(strlen($tendangnhap) < 6) {
      echo '<script>alert("Tên đăng nhập phải dài hơn 6 ký tự");</script>';
    }
    elseif(kiemTraChuoi($tendangnhap) == false) {
      echo '<script>alert("Tên đăng nhập không được chứa ký tự đặc biệt");</script>';
    }
    elseif(passwords_match($matkhau, $matkhau1) == false) {
      echo '<script>alert("Mật khẩu không khớp");</script>';
    }
    elseif(is_valid_email($email) == false) {
      echo '<script>alert("email không hợp lệ");</script>';
    } else {
      if($insert_query) {
        $display_message = "Thêm thành công";
      }
      else {
        $display_message = "Thêm thất bại";
      }
    }

  }

  // phân trang
  $start = 0;

  // đặt số lượng dòng để hiện trên một trang
  $rows_per_page = 4;

  // lấy tổng số côt
  $records = $conn->query("select * from khachhang");
  $nr_of_rows = $records->num_rows;

  // tính nr của pages
  $pages = ceil($nr_of_rows / $rows_per_page);

  // if the user clicks on the paginition buttons we set a new starting point
  if(isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
  }

  $result = $conn->query("select * from khachhang limit ".$start.", ".$rows_per_page."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin User</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
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

<body idd="<?php echo $id?>">
   <input type="checkbox" id="menu-toggle">
   <div class="sidebar">
    <!-- side header -->
    <div class="side-header" style="background: #35858b;"></div>       
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
                  <span class="las la-user-alt" style="color: #fff;"></span>
                  <small style="color: #fff;">Khách hàng</small>
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
  <!-- phần nội dung chính -->
  <div class="main-content">
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
                        <span class="notify">43</span>
                    </div>
                    
                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">13</span>
                    </div>
                    
                    <div class="user" style="margin-right: 8px;">
                        <span style="font-size: 25px;cursor: pointer;" class="las la-power-off" onclick="window.location.href='login-admin.html'"></span>
                        <span style="font-size: 20px; cursor: pointer;" onclick="window.location.href='admin-logout.php'">Đăng xuất</span>
                    </div>
                </div>
            </div>
        </header>


<main>
  <div class="page-content" style="margin-top: 50px; padding-left: 0; padding-right: 0;">
    <!-- display message -->
    <?php
  if(isset($display_message)) {
    echo "<div class='display_message' style='color: red;'>
    <span>$display_message</span>
    <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
</div>"; 
  }
    ?>
    <h1 style="padding: 1.3rem 1rem;color: #74767d;" id="customer">Khách hàng</h1>
    <div >
      <button style="margin-bottom: 8px; margin-left: 20px;" id="showadd" onclick="showadd()"><i class="fa-solid fa-circle-plus" style="margin-right: 4px;"></i>Thêm khách hàng</button>              
    </div>
      <!-- form thêm khách hàng -->
      <form action="admin-user.php" method="post" enctype="multipart/form-data">
        <div class="add_user_admin" style="display: flex; justify-content: space-around; align-items: center;">
          <div class="ada1">
            <label for="tendangnhap">Tên đăng nhập</label>
            <input type="text" name="tendangnhap" id="tendangnhap" required>
          </div>
          <div class="ada1">
            <label for="hovaten">Họ và tên</label>
            <input type="text" name="hovaten" id="hovaten" required>
          </div>
          <div class="ada1">
            <label for="sdt">SĐT</label>
            <input type="number" name="sdt" id="sdt" required>
          </div>
          <div class="ada1">
            <label for="namsinh">Ngày sinh</label>
            <input type="date" name="namsinh" id="namsinh" required>
          </div>
        </div>
        <div class="add_user_admin" style="display: flex; justify-content: space-around; align-items: center; padding-top: 30px;">
          <div class="ada1">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
          </div>
          <div class="ada1">
            <label for="quanhuyen">Quận/huyện</label>
            <input type="text" name="quanhuyen" id="quanhuyen" required>
          </div>
          <div class="ada1">
            <label for="tptinh">TP/tỉnh</label>
            <input type="text" name="tptinh" id="tptinh" required>
          </div>
          <div class="ada1">
            <label for="quocgia">Quốc gia</label>
            <input type="text" name="quocgia" id="quocgia">
          </div>
        </div>
        <div class="add_user_admin" style="display: flex; justify-content: space-around; align-items: center; padding-top: 30px;">
          <div class="ada1">
            <label for="matkhau">Mật khẩu</label>
            <input type="password" name="matkhau" id="matkhau">
          </div>
          <div class="ada1">
            <label for="matkhau1">Nhập lại mật khẩu</label>
            <input type="password" name="matkhau1" id="matkhau1">
          </div>
          <div>
            <button type="submit" name="add_user" style="padding: 10px 15px;">Thêm +</button>
          </div>
        </div>
      </form>
  </div>

            <div class="records table-responsive" style="margin-top: 30px;">
                <div>
                  <!-- php code -->
                  <?php
      $display_user = mysqli_query($conn, "select * from khachhang");
      if(mysqli_num_rows($display_user)>0) {
        echo '
        <table width="100%" id="table-user">
          <thead>
              <tr id="select-filter">
                  <th>Tên đăng nhập</th>
                  <th>Họ tên</th>
                  <th>EMAIL</th>                          
                  <th>Ngày sinh</th>
                  <th>Địa chỉ</th>                              
                  <th>Trạng thái</th>
                  <th> Thao tác</th>
              </tr>
          </thead>
          <tbody>';
          // while($row=mysqli_fetch_assoc($display_user)) {
          while($row=$result->fetch_assoc()) {

            ?>
            <tr>
              <td><?php echo $row['tendangnhap']?></td>
              <td><?php echo $row['hovaten']?></td>
              <td><?php echo $row['email']?></td>
              <td><?php echo $row['namsinh']?></td>
              <td>
                <?php echo $row['quanhuyen'] . ', ' .
                           $row['tptinh'] . ', ' .
                           $row['quocgia']
                ?>
              </td>
              <td>
                <?php
                  if($row['trangthai'] == 1) {
                    echo "
                    <p>
                        <a href='block-user.php?tdn=".$row['tendangnhap']."
                        &trangthai=0' style='color: green;'
                        '>
                        Hoạt động 
                        <i class='fa fa-unlock-alt' aria-hidden='true'></i>
                        </a>
                    </p>";
                  } else {
                    echo "
                    <p>
                        <a href='open-user.php?tdn=".$row['tendangnhap']."
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
                  <a href="admin-update-user.php?edit=<?php echo $row['tendangnhap']?>">
                    Sửa<span class="las la-edit"></span>
                  </a>
                </div>
              </td>
            </tr>  
            <?php
          }
      }
    ?>   
        </tbody>
      </table>

      <!-- phần phân trang -->
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
        
    

</main>

</html>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- script của phần phân trang -->
<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>