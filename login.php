<?php
  include "connect.php";

  session_start();

  if(isset($_SESSION['mySession'])) {
    header('location: index-user.php');
  }

  $tendangnhap = $_POST['tendangnhap'];
  if(isset($_POST['dangnhap'])) {
    $matkhau     = md5($_POST['matkhau']); // mã hóa md5

    // truy vấn để lấy dữ liệu đăng nhập
    $sql = "select * from khachhang where
    tendangnhap = '$tendangnhap'
    and matkhau = '$matkhau'
    and trangthai=1";

    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result) == 1) {
      $_SESSION['mySession'] = $tendangnhap;
      header('location: index-user.php');
    }else {
      echo "<script>
        alert('Tên đăng nhập hoặc mật khẩu không chính xác');
      </script>";
    }
  }
?>

<!DOCTYPE html>

<html>
<head>
  <link rel="icon" type="image/png" href="images/LOGO.webp">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Đăng nhập</title>
</head>
<body>
<!-- header -->
<section id="header">
    <a href="index.php">
      <img src="images/LOGO.webp" class="logo" alt="Logo thương hiệu" >
   </a>
  <div>
   <ul id="icons">
    
  <li id="menu"><a href="index.php"  class="choose" ><span>Trang chủ</span></a></li>
          <li id="menu"><a href="brand.php" class="choose"><span>Nhãn Hàng</span></a></li>
         
          <li id="menu" ><a href="shop.php" class="choose"><span>Cửa Hàng</span></a></li>
          <!-- <li id="menu"><a href="contact.php" class="choose"><span>Contact</span></a></li> -->
    
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

  <!-- Phần login -->
 <section id="section-login">
    <div class="container" id="container">
     <div class="f-box">
          <h1 id="tittle">Đăng nhập</h1>
          <form  action="login.php" method="post" enctype="multipart/form-data" id="form">
            <div class="input-group">
              <div class="input-field" >
                <i class="fa-solid fa-user"></i>
                <input type="text" name="tendangnhap" placeholder="Tên đăng nhập" id="username">
                <!-- thông báo lỗi -->
                <div class="error">

                </div>
            </div>
     
            <div class="input-field">
             <i class="fa-solid fa-lock"></i>
             <input type="password" name="matkhau" placeholder="Mật khẩu" id="password"> 
               <div id="eye"> 
                 <i class="fa-solid fa-eye-slash"></i> </div>
                 <!-- thông báo lỗi -->
                <div class="error">
                  
                </div>
            </div>
      
    
           <div id="fpass">
           <a href="#" id="forget">Quên mật khẩu</a></div>
             </div>
            <div class="b-field">
                <button type="submit" name="dangnhap" id="subtn">Đăng Nhập</button>
                <button type="button" onclick="window.location.href='register.php'" id="sibtn">Đăng ký</button>  
            </div>        
        </form>
    
     
     </div>

     </div>
</section>

<!-- footer -->
<?php
  include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!-- hiện mật khẩu -->
<script>
    $(document).ready(function(){
      $('#eye').click(function(){
          $(this).toggleClass('open');
          $(this).children('i').toggleClass('fa-eye-slash fa-eye');
          if($(this).hasClass('open')){
              $(this).prev().attr('type', 'text');
          }else{
              $(this).prev().attr('type', 'password');
          }
      });
  });
</script>
