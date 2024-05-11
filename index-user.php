<?php 
  include "connect.php";
  session_start();
  
  // pagelayout tdn = tendangnhap
  // tendangnhap là khóa chính của khách hàng
  if(isset($_SESSION['mySession'])) {
    $tendangnhap = $_SESSION['mySession'];
    echo "<script>
      alert('Xin chào ".$tendangnhap."')
    </script>";
  }

  // $sql = "select * from khachhang where tendangnhap = '$tdn'";
  // $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="images/LOGO.webp">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Trang chủ</title>
</head>
<body style="background-color: #fff;">

  <!-- header-user  -->
<section id="header"  style="background:#fff;">
  <a><img src="images/LOGO.webp" class="logo" alt="Logo thương hiệu"></a>
  <div>
    <ul id="icons">
  
      <li id="menu"><a  class="act-on" class="choose" ><span class="act-on">Trang chủ</span></a></li>
        <li id="menu" ><a href="brand-user.php" class="choose"><span>Nhãn Hàng</span></a></li> 
        <li id="menu" ><a href="shop-user.php" class="choose"><span>Cửa hàng</span></a></li>
        <div class="group" id="search">
          <!-- tìm kiếm cơ bản -->
          <input type="text" placeholder="Tìm kiếm sản phẩm" name="text" class="input" onkeyup="search()">
          <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
          <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
          </svg>
        </div> 
        <li id="menu" id="lg-bag"><a href="shop-user.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
        <li id="menu" id="lg-user"><a id="userlogin" onclick="toggleMenu()"><i class="fa-solid fa-circle-user"></i></a></li>
        <a id="close"><i class="fa-solid fa-x"></i></a>
    </ul>
  </div>

  <!-- Thông tin người dùng -->
  <div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
      <div class="user-info">
        <!-- php code -->
          <?php
            $sql = "select * from khachhang";
            $result = mysqli_query($conn, $sql);
          ?>

        <h2><?php echo $tendangnhap?></h2>
      </div>
      <hr>
      <a href="user.php" class="sub-menu-index-link">
        <p>> Tài khoản</p>
      </a>

      <a href="history.php" class="sub-menu-index-link">
        <p>> Lịch sử mua hàng</p>
      </a>
      <a href="logout.php" class="sub-menu-index-link">
        <p onclick="return confirm('Bạn có muốn đăng xuất không ?');">> Đăng xuất</p>
      </a>
    </div>
  </div>

  <div id="mobile"> 
    <a href="shop-user.php" ><i class="fa-solid fa-cart-shopping"></i></a>
    <a  id="userlogin" onclick="toggleMenu()"><i class="fa-solid fa-circle-user"></i></a>
    <i id="bar" class="fa-solid fa-bars" style="color: #000000;"></i>
  </div>
</section>


<section class="commercial-index" >
  <img src="images/Bừng khí chất.jpg" alt="Bứng khí chất tỏa tri thức" style="width: 100%;">
</section>

<div id="bet"><h5>Sản Phẩm Bán Chạy</h5></div>

<!-- phần mô tả -->
<section id="all">
  <div class="wrapper">
    <i id="left" class="fa-solid fa-arrow-left"></i>
    <div class="carousel">
      <img src="images/mota1.jpg" alt="intro1" draggable="false" >
      <img src="images/mota2.jpg" alt="intro2" draggable="false" >  
      <img src="images/mota3.jpg" alt="intro3" draggable="false" >
      <img src="images/mota4.jpg" alt="intro3" draggable="false" >    
      <img src="images/mota5.jpg" alt="intro3" draggable="false" >    
      <img src="images/mota6.jpg" alt="intro3" draggable="false" > 
  
    </div>
    <i id="right" class="fa-solid fa-arrow-right"></i>
  </div>
</section>

<!-- Phần giới thiệu -->
<div id="bet"><h5>Thông Tin Giới Thiệu</h5></div>
 
<section class="postcard">
  <div class="box">
    <img src="images/kiến trúc cho tương lai.jpg">
    <h2 style="letter-spacing: 0.5px;">Kiến trúc cho tương lai </h2>
    <p style="padding-bottom: 5px; letter-spacing: 0.8px;">Sản phẩm được làm thủ công và nhiên liệu được lấy từ tự nhiên không hóa chất độc hại, không gây kích ứng cho da, phù hợp cho mọi đối tượng sử dụng.</p>
    <button id="btn-blog" onclick="window.location.href='shop-user.php'">Xem sản phẩm</button>
  </div>
  <div class="box">
    <img src="images/sẵn sàng cho một ngày mới.jpg">
    <h2 style="letter-spacing: 0.5px;">Sẵn sàng cho một ngày mới</h2>  
    <p style="padding-bottom: 5px; letter-spacing: 0.8px;">Sản phẩm được làm thủ công và nhiên liệu được lấy từ tự nhiên không hóa chất độc hại, không gây kích ứng cho da, phù hợp cho mọi đối tượng sử dụng.</p>
    <button id="btn-blog" onclick="window.location.href='shop-user.php'">Xem sản phẩm</button>
    </div>
  <div class="box">
    <img src="images/Đồng  hành cùng công nghệ.png">
    <h2 style="letter-spacing: 0.5px;">Đồng hành cùng công nghệ</h2>  
    <p style="padding-bottom: 5px; letter-spacing: 0.8px;">Sản phẩm được làm thủ công và nhiên liệu được lấy từ tự nhiên không hóa chất độc hại, không gây kích ứng cho da, phù hợp cho mọi đối tượng sử dụng.</p>
    <button id="btn-blog" onclick="window.location.href='shop-user.php'">Xem sản phẩm</button>
  </div>
 </section>

<!-- footer -->
<?php include "footer.php"?>

<script>
  const bar = document.getElementById('bar');
  const icon = document.getElementById('icons');
   
  if(bar){
    bar.addEventListener('click',() =>{
  icon.classList.add('active');
    })}
   
  const icons = document.getElementById("icons");
  const dong = document.getElementById("close");
  const barmenu = document.getElementById('bar');
  dong.addEventListener("click", function() {
  
    icons.style.right = "-300px";
  });
  barmenu.addEventListener("click", function() {
    icons.style.right = "0";

  });


  window.addEventListener("resize", function() {

      if (window.innerWidth >= 1138) {
        icons.classList.remove('active');
      }
     else{
      icons.style.right="-300px";
     }
      }
  );
</script>

<script>
  const carousel = document.querySelector(".carousel"),
  firstImg = carousel.querySelectorAll("img")[0],
  arrowIcons = document.querySelectorAll(".wrapper i");

  let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

  const showHideIcons = () => {
      // showing and hiding prev/next icon according to carousel scroll left value
      let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // getting max scrollable width
      arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
      arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
  }

  arrowIcons.forEach(icon => {
      icon.addEventListener("click", () => {
          let firstImgWidth = firstImg.clientWidth + 14; // getting first img width & adding 14 margin value
          // if clicked icon is left, reduce width value from the carousel scroll left else add to it
          carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
          setTimeout(() => showHideIcons(), 60); // calling showHideIcons after 60ms
      });
  });

  const autoSlide = () => {
      // if there is no image left to scroll then return from here
      if(carousel.scrollLeft - (carousel.scrollWidth - carousel.clientWidth) > -1 || carousel.scrollLeft <= 0) return;

      positionDiff = Math.abs(positionDiff); // making positionDiff value to positive
      let firstImgWidth = firstImg.clientWidth + 14;
      // getting difference value that needs to add or reduce from carousel left to take middle img center
      let valDifference = firstImgWidth - positionDiff;

      if(carousel.scrollLeft > prevScrollLeft) { // if user is scrolling to the right
          return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
      }
      // if user is scrolling to the left
      carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
  }

  const dragStart = (e) => {
      // updatating global variables value on mouse down event
      isDragStart = true;
      prevPageX = e.pageX || e.touches[0].pageX;
      prevScrollLeft = carousel.scrollLeft;
  }

  const dragging = (e) => {
      // scrolling images/carousel to left according to mouse pointer
      if(!isDragStart) return;
      e.preventDefault();
      isDragging = true;
      carousel.classList.add("dragging");
      positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
      carousel.scrollLeft = prevScrollLeft - positionDiff;
      showHideIcons();
  }

  const dragStop = () => {
      isDragStart = false;
      carousel.classList.remove("dragging");

      if(!isDragging) return;
      isDragging = false;
      autoSlide();
  }

  carousel.addEventListener("mousedown", dragStart);
  carousel.addEventListener("touchstart", dragStart);

  document.addEventListener("mousemove", dragging);
  carousel.addEventListener("touchmove", dragging);

  document.addEventListener("mouseup", dragStop);
  carousel.addEventListener("touchend", dragStop);

</script>


<script>
  let subMenu = document.getElementById("subMenu");
  function toggleMenu(){
    subMenu.classList.toggle("open-menu");
  }
  const search = () => {
      if (event.keyCode === 13) {
  window.location.href='shop-user.php';
      }};
</script>