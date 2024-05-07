
<?php
    include "connect.php";

    $id = $_GET['id'];
    $tensp = $_GET['tensp'];
    $tdn = $_GET['prod-user'];
?>

<!DOCTYPE html>

<html>
<head>   
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/nutri.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chi tiết sản phẩm</title>
</head>
<body>
  <!-- header -->
<section id="header">
    <a href="index-user.php?tdn=<?php echo $tdn?>">
      <img src="images/LOGO.webp" class="logo" alt="" >
   </a>
  <div>
   <ul id="icons">
    
  <li id="menu"><a href="index-user.php?tdn=<?php echo $tdn?>"  class="choose" ><span>Trang Chủ</span></a></li>
          <li id="menu"><a href="brand-user.php?brand=<?php echo $tdn?>" class="choose"><span>Nhãn Hàng</span></a></li>
         
          <li id="menu" ><a href="shop-user.php?s-user=<?php echo $tdn?>" class="choose"><span>Cửa Hàng</span></a></li>
    
      <div class="group" id="search">
      <input type="text" placeholder="Tìm kiếm sản phẩm" name="text" class="input" onkeyup="search()">
    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
      <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
  </svg>
  </div> 
     <li id="menu" id="lg-bag"><a href="shop-user.php?s-user=<?php echo $tdn?>"><i class="fa-solid fa-cart-shopping"></i></a>
      </li>
      <li id="menu" id="lg-bag"> <a onclick="toggleMenu()" id="userlogin"><i class="fa-solid fa-circle-user"></i></a>
      </li>
      <a id="close"><i class="fa-solid fa-x"></i></a>
   </ul>
  </div>
  <div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
      <div class="user-info"> 
        <h2><?php echo $tdn?></h2>
      </div>
      <hr>
      <a href="user.php?user=<?php echo $tdn?>" class="sub-menu-index-link">
        <p>> Tài khoản</p>  
      </a> 
      <a href="history.php?history=<?php echo $tdn?>" class="sub-menu-index-link">
        <p>> Lịch sử mua hàng</p> 
      </a>
      <a href="logout.php" class="sub-menu-index-link">
        <p onclick="return confirm('Bạn có muốn đăng xuất không ?');">> Đăng xuất</p> 
      </a> 
    </div>
  </div>
  <div id="mobile"> 
  
    <a href="shop-user.php?s-user=<?php echo $tdn?>"><i class="fa-solid fa-cart-shopping"></i></a>
   
  <a href="register.php"><i class="fa-regular fa-circle-user fa-lg" ></i></a>
  
  <i id="bar" class="fa-solid fa-bars" style="color: #000000;"></i>
  
  </div>
</section>

<section id="prodetails" class="section-p1">

    <!-- php code -->
    <?php
            $manh = $_GET['id'];
            $sql = "select * from sanpham where manh = '$manh' and tensp = '$tensp'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $fetch_data = mysqli_fetch_assoc($result);
                //echo $fetch_data['tensp'];
                ?>
                <div class="single-pro-image">
                    <img src="images/<?php echo $fetch_data['hinhanh']?>" width="100%" id="MainImg" alt="">
                </div>
    
                <div class="single-pro-details">
                    <h6 id="text1">Tên sản phẩm: <?php echo $fetch_data['tensp']?></h6>
                    <h2 id="text2">Giá bán: <?php echo $fetch_data['giaban']?>vnđ</h2>
    
                    <div id="infor-nutri">
                        <h3>Chi tiết sản phẩm</h3>
                        <i id="nutri-open" class="fa-solid fa-angle-up fa-rotate-180"></i>
                    <div class="label">
                        <?php
                            // truy vấn nhãn hàng
                            $sql2 = "select * from nhanhang where manh = '$manh'";
                            $result2 = mysqli_query($conn, $sql2);
                            if(mysqli_num_rows($result2) > 0) {
                                $fetch_data2 = mysqli_fetch_assoc($result2);
                            ?>
                                <p>Nhãn hàng: <?php echo $fetch_data2['tennh']?></p>
                                <p>slogan: <?php echo $fetch_data2['mota']?></p>
                                <img src="images/<?php echo $fetch_data2['hinhanh']?>" alt="" width="50px">
                            <?php
                            }
                        ?>
                        <p>
                            Mô tả sản phẩm: <?php echo $fetch_data['mota']?>
                        </p>
                    </div>
                </div>   
    <?php
            }
    ?>
    <!-- lấy thông tin để làm giỏ hàng -->
    <?php 
    if(isset($_GET['id']) && isset($_GET['tensp'])) {
      $manh = $_GET['id'];
      $tensp = $_GET['tensp'];
      $sql = "select * from sanpham where manh='$manh' and tensp='$tensp'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $fetch_product = mysqli_fetch_assoc($result);
        ?>
      <form action="giohang-user.php?tdn=<?php echo $tdn?>" method="post">
        <input type="hidden" name="product_id" value="<?php echo $fetch_product['masp']?>">
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['tensp']?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['giaban']?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_product['hinhanh']?>">
        <label for="soluong">Số lượng</label>
        <input type="number" min="1" name="soluong" id="soluong">
        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart">
      </form>
        <?php
      }
    }
      ?>

    <!-- Quay lại cửa hàng -->
    <div class="divider medium"></div>
    <a href="shop-user.php?s-user=<?php echo $tdn?>" class="btn-buy">Quay lại cửa hàng </a>
    </div>
    </div>
    </div>
</section>


<!-- Những sản phẩm khác -->
<section id="product12" class="section-p12">
    <h2>Những Sản phẩm khác</h2>
    <div class="pro-container2">
    <div class="pro2">
    <a href="#">
    <img src="images/note4.jpg" alt="">
    </a>
    <h5>Giấy note 5x5</h5> 
    <h4>15.000vnđ</h4>
    <div id="buttoncart">
      <button onclick="window.location.href='#'"><i class="fa-solid fa-cart-shopping"></i></button>
    </div>
    </div> 

    <div class="pro2">
      <a href="#">
      <img src="images/tap4-2.jpg" alt="">
    </a>
       
    <h5>Tập học sinh 90 trang</h5>
    <h4>8.000vnđ</h4>
 
    <div id="buttoncart">
      <button onclick="window.location.href='#'"><i class="fa-solid fa-cart-shopping"></i></button>
    </div>
    </div> 

    <div class="pro2">
      <a href="#">
      <img src="images/note2-2.jpg" alt="">
      </a>        
      <h5>Giấy note trong suốt</h5>

        <h4>24.000vnđ</h4>
   
      <div id="buttoncart">
        <button onclick="window.location.href='#'"><i class="fa-solid fa-cart-shopping"></i></button>
      </div>
      </div> 

      <div class="pro2">
        <a href="#">
        <img src="images/butchigo2.png" alt="">
      </a>
      
          <h5>Bút chì gỗ</h5>
     <h4>7.000vnđ</h4>
        <div id="buttoncart">
          <button onclick="window.location.href='#'"><i class="fa-solid fa-cart-shopping"></i></button>
        </div>
        </div> 
              
  </div>
</section>

<!-- footer -->
<?php
    include "footer.php";
?>
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
      icons.style.right = "0px";
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
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
    const search = () => {
      if (event.keyCode === 13) {
  window.location.href='shop-user.php?s-user=<?php echo $tdn?>';
      }};
</script>








