<?php 
  include "connect.php";


  // Phần giỏ hàng
  if(isset($_POST['add_to_cart'])) {
    $products_name     = $_POST['product_name'];
    $products_price    = $_POST['product_price'];
    $products_image    = $_POST['product_image'];
    $products_quantity = 1;

    // Chọn dữ liệu giở hàng dựa trên điều kiện
    $select_cart = mysqli_query($conn, "select * from giohang where tensp='$products_name'");
    if(mysqli_num_rows($select_cart) > 0) {
      $display_message[] = "Sản phẩm này đã có trong giỏ hàng";
    }
    else {
      // chèn dữ liệu giỏ hàng trong bảng giỏ hàng
      $insert_products = mysqli_query($conn, "insert into giohang (tensp, giaban, hinhanh, soluong)
      values ('$products_name', '$products_price', '$products_image', $products_quantity)");
      $display_message[] = "Đã thêm sản phẩm vào giỏ hàng";
    }
  }

  // Phần phân trang
  $start = 0;
  $rows_per_page = 8;
  $records = $conn->query("select * from sanpham");
  $nr_of_rows = $records->num_rows;

  $pages = ceil($nr_of_rows / $rows_per_page);

  if(isset($_GET['page_nr'])) {
    $page = $_GET['page_nr'] - 1;
    $start = $page * $rows_per_page;
  }

  $result = $conn->query("select * from sanpham limit ".$start.", ".$rows_per_page."");
?>

<!DOCTYPE html>
<html>
<head>  
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="stylesheet" href="boostrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cửa Hàng</title>
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
  <!-- header -->
<section id="header">
  <a href="index.php">
    <img src="images/LOGO.webp" class="logo" alt="" >
  </a>
  <div>
  <ul id="icons">  
    <li id="menu"><a href="index.php"  class="choose" ><span>Trang Chủ</span></a></li>
    <li id="menu"><a href="brand.php" class="choose"><span>Nhãn Hàng</span></a></li>       
    <li id="menu" ><a class="act-on" href="shop.php" class="choose" ><span class="act-on">Cửa Hàng</span></a></li>    
    <div class="group" id="search">
    <!-- Tìm sản phẩm cơ bản -->
    <form action="shop.php" method="post">
      <input id="search-item" type="text" placeholder="Tìm kiếm sản phẩm" name="search" class="input" onkeyup="search()"  tabindex="1">
    </form>

    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
      <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
    </svg>
  </div> 
      <!-- Giỏ hàng -->
      <!-- php code -->
      <?php
  $select_product = mysqli_query($conn, "select * from giohang") or die('query failed');
  $row_count = mysqli_num_rows($select_product);
      ?>
      <li id="menu" >
        <a href="cart.php" id="cart-icon">
        <div class="cart-follow-icon">
          <!-- shopping cart icon -->
          <i class="fa-solid fa-cart-shopping add-cart"></i>
          <span id="count-cart-add" style="  font-size: 14px; color:white; font-weight: 500; margin: 0; letter-spacing: 1px;">
          <?php echo $row_count?></span>
        </div>
        </a>
      </li>
     
      <li id="menu" id="lg-user"><a href="register.php"><i class="fa-regular fa-circle-user fa-lg" ></i></a>
      </li>
      <a  id="close"><i class="fa-solid fa-x"></i></a>
   </ul>
  </div>
  <div id="mobile"> 
    <a id="cart-icon1">
      <div class="cart-follow-icon">
        <i class="fa-solid fa-cart-shopping add-cart"></i>
        <span id="count-cart-add1" style="  font-size: 14px; color:white; font-weight: 500; margin: 0; letter-spacing: 1px;">0</span>
      </div>
    </a>
    <a id="glass-search" onclick="showbar()" ><i class="fa-solid fa-magnifying-glass"></i> </a>
    <a href="register.php"><i class="fa-regular fa-circle-user fa-lg" ></i></a>
    <i id="bar" class="fa-solid fa-bars" style="color: #000000;"></i>
  </div>
  <div class="search-bars">
    <input type="text" placeholder="SEARCH...">
    <i class="fa-solid fa-xmark" id="xmark" onclick="closebar()"></i>
  </div>
</section>

<!-- Thông báo sản phẩm đã thêm vào giỏ hàng -->
<div style="position: absolute; top: 18%; color: green; font-weight: 600; margin-left: 50px;">
  <?php
      if(isset($display_message)) {
        foreach($display_message as $display_message) {
            echo "<div class='display_message'>
            <span>$display_message</span>
            <i class='fas fatimes' onClick='this.parentElement.style.display=`none`';></i>
            </div>";
        }
      }
    ?>
</div>


    <!-- Phân loại sản phẩm -->
<section id="product11" class="section-p11" class="shop container" >
  <div  id="filter-buttons" style="padding-top: 150px;">       
    <button class="btn" id="btnfil">Bút</button>
    <button class="btn" id="btnfil" >Tập</button>
    <button class="btn" id="btnfil" >Giấy Note</button>
    <button class="btn" id="btnfil">Thước Kẻ</button>   
    <div>
      <button id="btn-ad-search" class="btn">Tìm kiếm <i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </div>
    <div id="overlay"></div>

<!-- Hiển thị sản phẩm -->
<div class="pro-container1" id="product-list" >
      <?php 
        // truy vấn lấy sản phẩn trong bảng sanpham
        $select_products = mysqli_query($conn, "select * from sanpham");
        if(mysqli_num_rows($select_products)>0) {
          // while($fetch_product = mysqli_fetch_assoc($select_products)) {
          while($fetch_product = $result->fetch_assoc()) {
            ?>
            <div class="pro1 pepsi product-box">
              <form action="shop.php" method="post" enctype="multipart/form-data">
                <a href="product-detail.php?id=<?php echo $fetch_product['manh']?>">
                <img  src="images/<?php echo $fetch_product['hinhanh']?>" class="product-img" alt=""></a>           
                <h5 class="product-title"><?php echo $fetch_product['tensp']?></h5>
                <h2 style="display: none;"><?php echo $fetch_product['tensp']?></h2>
                <h4 class="product-price"><?php echo $fetch_product['giaban']?>vnđ</h4>

                <!-- lấy thông tin sản phẩm để làm giỏ hàng -->
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['tensp']?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['giaban']?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['hinhanh']?>">
                <button type="submit" class="add-cart" id="cart-plus" name="add_to_cart">Thêm vào giỏ hàng</button>
              </form>
            </div> 
        <?php
          }
        } else {
            echo "ko có sản phẩm";
        }
    ?>
</div> 

  </div>
</div>
</section>
<!-- Phân trang -->
    <!-- displaying the page info text -->
    <div class="page-info">
      <?php
        if(!isset($_GET['page-nr'])) {
            $page = 1;
        } else {
          $page = $_GET['page-nr'];
        }
      ?>
      <div style="text-align: center">

      Hiện <?php echo $page?> trên <?php echo $pages?> trang
      </div>
    </div>

    <!-- displaying the pagination buttons -->
    <div class="pagination" style="display: flex; justify-content: center; padding-top: 20px;">
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
        } else {
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

    <!-- footer -->
    <?php include "footer.php"?>
 
</body>
</html>

<!-- script của phân trang -->
<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>











