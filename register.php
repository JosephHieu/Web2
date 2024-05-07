<?php
  include "connect.php";
  // hàm kiểm tra tên đăng nhâp
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

  // hàm kiểm tra mật khẩu
  function passwords_match($password1, $password2) {
    // Kiểm tra xem hai mật khẩu có giống nhau không
    if ($password1 === $password2) {
        return true; // Hai mật khẩu giống nhau
    } else {
        return false; // Hai mật khẩu không giống nhau
    }
  }
  
  // hàm kiểm tra sđt

  function isValidPhoneNumber($phoneNumber) {
      // Loại bỏ các ký tự không phải số khỏi chuỗi
      $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
      
      // Kiểm tra độ dài của số điện thoại (phải có ít nhất 10 chữ số)
      if (strlen($phoneNumber) < 10) {
          return false;
      }
      
      // Kiểm tra số điện thoại bắt đầu bằng các mã quốc gia phổ biến (ví dụ: +84, 84, 0)
      if (!preg_match('/^(84|\+84|0)[0-9]{9,10}$/', $phoneNumber)) {
          return false;
      }
      
      // Số điện thoại hợp lệ
      return true;
  }

  // hàm kiểm tra email
  function is_valid_email($email) {
    // Sử dụng hàm filter_var với FILTER_VALIDATE_EMAIL để kiểm tra tính hợp lệ của email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Email hợp lệ
    } else {
        return false; // Email không hợp lệ
    }
}

  if(isset($_POST['dangky'])) {
      $tendangnhap = $_POST['tendangnhap'];
      $hovaten     = $_POST['hovaten'];
      $sdt         = $_POST['sdt'];
      $email       = $_POST['email'];
      $matkhau     = md5($_POST['matkhau']);
      $matkhau2    = md5($_POST['matkhau2']);
      $namsinh     = $_POST['namsinh'];
      $quanhuyen   = $_POST['quanhuyen'];
      $tptinh      = $_POST['tptinh'];
      $quocgia     = $_POST['quocgia'];
      $trangthai = 1;

      if(strlen($tendangnhap < 6)) {
        $display_message = "Tên đăng nhập dài phải hơn 6 ký tự";
      }
      elseif(kiemTraChuoi($tendangnhap) == false) {
        $display_message = "Tên đăng nhập không được chứa ký tự đặc biệt";
      } 
      elseif(is_valid_email($email) == false) {
        $display_message1 = "email không hợp lệ.";
      }
      elseif(passwords_match($matkhau, $matkhau2) == false) {
        $display_message2 = "Mật khẩu không khớp";
      }
      elseif(isValidPhoneNumber($sdt) == false) {
        $display_message3 = "Số điện thoại không hợp lệ";
      }
      else {
          // $sql = "insert into khachhang (tendangnhap, hoten, sdt, email, namsinh, quanhuyen, tptinh, quocgia, trangthai)
          // values ('$tendangnhap', null, '$sdt', '$email', null, null, null, null, '$trangthai')";
          $sql = "INSERT INTO khachhang (tendangnhap, hovaten, sdt, email, matkhau,
          namsinh, quanhuyen, tptinh, quocgia, trangthai)
          VALUES ('$tendangnhap', '$hovaten', '$sdt', '$email', '$matkhau', 
          '$namsinh', '$quanhuyen', '$tptinh', '$quocgia', '$trangthai')";

          $result = mysqli_query($conn, $sql);

          if($result) {
            echo "<script>
                alert('Đăng ký thành công');
                window.location.href='login.php';
                </script>";     
          }
          else {
            echo "<script>
                 alert('Đăng ký thất bại');
                 
                </script>";  
          }
      }
      
  }
  
?>

<!DOCTYPE html>

<html>
<head>    
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <title>Đăng ký</title>
</head>
<body style="background-color: #f5f5f5;">

<!-- Phần header -->
<section id="header">
    <a href="index.php">
      <img src="images/LOGO.webp" class="logo" alt="" >
   </a>
  <div>
   <ul id="icons">
    
  <li id="menu"><a href="index.php"  class="choose" ><span>Trang Chủ</span></a></li>
          <li id="menu"><a href="brand.php" class="choose"><span>Nhãn Hiệu</span></a></li>
         
          <li id="menu" ><a href="shop.php" class="choose"><span>Cửa Hàng</span></a></li>    
      <div class="group" id="search">
      <input type="text" placeholder="Tìm kiếm sản phẩm" name="text" class="input" onkeyup="search()">
    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
      <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
  </svg>
  </div> 
      <li id="menu" id="lg-bag"><a href="shop.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </li>
     
      <li id="menu" id="lg-user"><a href="#"><i class="fa-regular fa-circle-user fa-lg" ></i></a>
      </li>
      <a  id="close"><i class="fa-solid fa-x"></i></a>
   </ul>
  </div>
  <div id="mobile"> 
  
    <a href="shop.php"><i class="fa-solid fa-cart-shopping"></i></a>
   
  <a href="#"><i class="fa-regular fa-circle-user fa-lg" ></i></a>
  
  <i id="bar" class="fa-solid fa-bars" style="color: #000000;"></i>
  
  </div>
</section>

<!-- Phần đăng ký -->
 <section id="section-login" style="height: 790px;">
  <div class="container" id="container" style="width: 70%; margin: auto auto;">
    <div class="f-box" id="fbox">
          <h1 id="tittle">Đăng ký</h1>
          <form action="register.php" method="post" enctype="multipart/form-data" id="form">
            <div class="input-group">             
              <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="tendangnhap" placeholder="Tên đăng nhập" id="username" required>
                <div class="error">
                  <?php
                  if(isset($display_message)) {
                    echo $display_message;
                  }
                  ?>
                </div>
              </div>

              <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="hovaten" placeholder="Họ và tên" id="username" required>
                <div class="error">
                  <?php
                  // if(isset($display_message)) {
                  //   echo $display_message;
                  // }
                  ?>
                </div>
              </div>

              <div class="input-field">
                <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                <input type="number" name="sdt" placeholder="Số điện thoại" id="username" required>
                <div class="error">
                  <?php
                  if(isset($display_message3)) {
                    echo $display_message3;
                  }
                  ?>
                </div>
              </div>

              <div id="fpass">
              <div class="input-field">
                <i class="fa-solid fa-envelope" id="mail"></i>
                <input  type="text" name="email" placeholder="Email" id="email" required>
               <div class="error">
                <?php
                    if(isset($display_message1)) {
                      echo $display_message1;
                    }
                ?>
               </div>
              </div>

              <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="matkhau" placeholder="Mật khẩu" id="password" required> 
              <div class="error">
              <?php
                  if(isset($display_message2)) {
                    echo $display_message2;
                  }
                  ?>
              </div>
    
              </div>
              <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="matkhau2" placeholder="Nhập lại mật khẩu" id="password2" required> 
                <div class="error">
                <?php
                  if(isset($display_message2)) {
                    echo $display_message2;
                  }
                  ?>
                </div>
              </div>

              <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="date" name="Ngày sinh" placeholder="Ngày tháng năm sinh" id="username" required>
                <div class="error">
                  <?php
                  // if(isset($display_message)) {
                  //   echo $display_message;
                  // }
                  ?>
                </div>
              </div>

              <div style="display: flex; justify-content: space-around;">
                <input type="text" name="quanhuyen" class="bosung" style="border: 2px solid #e5e5e5;background: rgb(255, 255, 255);margin: 15px 0;border-radius: 10px;display: flex;align-items: center;margin-bottom: 18px;" placeholder="Số nhà, tên đường, quận" required>
                <input type="text" name="tptinh" class="bosung" style="border: 2px solid #e5e5e5;background: rgb(255, 255, 255);margin: 15px 0;border-radius: 10px;display: flex;align-items: center;margin-bottom: 18px;" placeholder="TP/tỉnh" required>
                <input type="text" name="quocgia" class="bosung" style="border: 2px solid #e5e5e5;background: rgb(255, 255, 255);margin: 15px 0;border-radius: 10px;display: flex;align-items: center;margin-bottom: 18px;" placeholder="Quốc gia" required>
              </div>
  
             <div class="b-field">
                <button type="button" onclick="window.location.href='login.php'" id="subtn" >Đăng nhập</button>
                <button type="submit" name="dangky" onclick="" id="sibtn">Đăng ký</button>           
            </div>
          </form>
    </div>
  </div>
</section>
<!-- phần chân trang -->
<?php 
  include "footer.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


