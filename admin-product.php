<?php 
  include "connect.php";

  // thêm sản phẩm
  if(isset($_POST['add_product'])) {
    $tensp            = $_POST['tensp'];
    $hinhanh          = $_FILES['hinhanh']['name'];
    $hinhanh_tmp_name = $_FILES['hinhanh']['tmp_name'];
    $hinhanh_folder   = 'images/' . $hinhanh;
    $loaisp           = $_POST['loaisp'];
    $manh             = $_POST['hang']; // int
    $giaban           = $_POST['giaban'];// double
    $soluongton       = $_POST['soluong'];// int
    $ngaythem         = $_POST['ngaythem'];
    $mota             = $_POST['mota'];
    $trangthaiban     = 1;

    // truy vấn thêm sản phẩm
    $insert_query = mysqli_query($conn, "insert into sanpham
    (manh, tensp, loaisp, giaban, soluongton, trangthaiban, hinhanh, mota, ngaythem)
    values ('$manh', '$tensp', '$loaisp', '$giaban', '$soluongton', '$trangthaiban', '$hinhanh', '$mota', '$ngaythem')")
    or die('truy vấn thất bại');

    if($insert_query) {
      move_uploaded_file($hinhanh_tmp_name, $hinhanh_folder);
      $display_message = "Thêm sản phẩm thành công.";
    }
    else {
      $display = "Thêm sản phẩm không thành công !!!";
    }
  }

  // Phân trang
  // đặt start từ giá trị
  $start = 0;

  // đặt số lượng dòng để hiện trên một trang
  $rows_per_page = 4;

  // lấy tổng số côt
  $records = $conn->query("select * from sanpham");
  $nr_of_rows = $records->num_rows;

  // tính nr của pages
  $pages = ceil($nr_of_rows / $rows_per_page);

  // if the user clicks on the paginition buttons we set a new starting point
  if(isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
  }

  $result = $conn->query("select * from sanpham limit ".$start.", ".$rows_per_page."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Product</title>
    <link rel="stylesheet" href="assets/css/popup.css">
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
   <!-- phần sidebar -->
  <div class="sidebar">
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
                  <span class="las la-clipboard-list" style="color: #fff;"></span>
                  <small style="color: #fff;">Sản phẩm</small>
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
      <!-- Phần nội dung chính -->
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
                      <span class="notify">14</span>
                  </div>
                  
                  <div class="notify-icon">
                      <span class="las la-bell"></span>
                      <span class="notify">33</span>
                  </div>
                  
                    
                    <div class="user" style="margin-right: 8px;">
                      
                        
                        <span style="font-size: 25px;cursor: pointer;" class="las la-power-off" onclick="window.location.href='login-admin.php'"></span>
                        <span style="font-size: 20px; cursor: pointer;" onclick="window.location.href='admin-login.php'">Đăng xuất</span>
                    </div>
                </div>
            </div>
    </header>
        
        
  <main>

  <!-- Phần điền thông tin để thêm sản phẩm -->
<div class="page-content">
    <!-- message display -->
    <?php 
      if(isset($display_message)) {
        echo "<div class='display_message' style='color: red;'>
                <span>$display_message</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
            </div>";
      }
    ?>
    <h1 style="padding: 1.3rem 0rem;color: #74767d;" id="product">Sản phẩm</h1>
    <div>
      <button style="margin-bottom: 8px;" id="showadd" onclick="showadd()"><i class="fa-solid fa-circle-plus" style="margin-right: 4px;"></i>  Thêm sản phẩm</button>
    </div>
    <form action="admin-product.php" method="post" enctype="multipart/form-data">
      <div class="add_product_admin" style="display: flex; justify-content: space-around; align-items: center;">
        <div class="ada1">
          <label for="tensp">Tên sản phẩm</label>
          <input type="text" name="tensp" id="tensp" required>
        </div>
        <div class="ada1">
          <img src="" alt="xem trước" id="image-preview">
          <div>
          <label for="hinhanh">Hình ảnh</label>
          <input type="file" name="hinhanh" id="image-input" accept="image/*" required>
          </div>
        </div>
        <div class="ada1">
          <label for="loai">Loại sản phẩm</label>
          <select name="loaisp" id="loai" required>
            <option value="0">Chọn</option>
            <option value="bút">Bút</option>
            <option value="tập">Tập</option>
            <option value="giấy note">Giấy note</option>
            <option value="thước kẻ">Thước kẻ</option>
          </select>
        </div>
        
        
      </div>
      <div class="add_product_admin" style="display: flex; justify-content: space-around; align-items: center; padding-top: 20px;">
      <div class="ada1">
          <label for="hang">Nhãn hàng</label>
          <select name="hang" id="hang" required>
            <option value="0">Chọn</option>
            <option value="111">Điểm 10</option>
            <option value="222">Colorkit</option>
            <option value="333">bizner</option>
            <option value="444">Thiên long</option>
            <option value="555">flexoffice</option>
          </select>
        </div>
        <div class="ada1">
          <label for="giaban">Giá bán</label>
          <input type="number" name="giaban" id="giaban" required>
        </div>
        <div class="ada1">
          <label for="soluong">Số lượng</label>
          <input type="number" min="1" name="soluong" id="soluong" required>
        </div>
        
      </div>
      <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px; align-items: center;">
        <div class="ada1">
            <label for="ngaythem">Ngày thêm</label>
            <input type="date" name="ngaythem" id="ngaythem" required>
          </div>
        <div>
        <label for="mota">Mô tả: </label>
        <input type="text" style="padding: 15px 20px;" name="mota" id="mota" required>
        </div>       
        <button type="submit" name="add_product" style="padding: 15px 20px;">Thêm +</button>
      </div>
      
    </form>
</div>

      <!-- Phần show sản phẩm -->
    <!-- php code -->
    <?php 
$display_product=mysqli_query($conn, "select * from sanpham");
$nums = 1;
if(mysqli_num_rows($display_product)>0) {
  echo "<table width='100%' id='table-product'>
  <thead>
  <tr id='select-filter'>
      <th>Sl NO</th>
      <th> Hình ảnh </th>
      <th> Tên sản phẩm</th>
      <th> Loại </th>
      <th> Giá bán </th>
      <th> Số lượng tồn</th>
      <th> Ngày thêm </th>
      <th> Trạng thái</th>
      <th> Thao tác</th>
     
  </tr>
  </thead>
  <tbody>";
  // logic to fetch data
  
  // while($row=mysqli_fetch_assoc($display_product)) {
  while($row=$result->fetch_assoc()) {
    ?>
    <!-- display product -->
    <tr>
        <td><?php echo $row['masp']?></td>
        <td>
          <div class="image-product-admin"><div>
          <img src="images/<?php echo $row['hinhanh']?>" id="productImage">
          </div>      
          </div>
        </td>
        <td>
          <?php echo $row['tensp']?>
        </td>
        <td>
          <?php echo $row['loaisp']?>
        </td>
        <td>
          <?php echo $row['giaban']?>vnđ
        </td>
        <td>
          <?php echo $row['soluongton']?>
        </td>
        <td>
          <?php echo $row['ngaythem']?>
        </td>
        <td>
          <?php echo $row['trangthaiban']?>
        </td>
        <td>
          <div class="actions">
            <!-- icon sửa sản phẩm -->
            <a href="update.php?edit=<?php echo $row['masp']?>">
              <i class="fas fa-edit"></i>
            </a>
            <!-- icon xóa sản phẩm -->
            <a href="delete.php?delete=<?php echo $row['masp']; ?>"
            class="delete_product_btn" onclick="return confirm('Sản phẩm này chưa được bán ra. Bạn có muốn xóa sản phẩm này')"> 
            
              <i class="fas fa-trash"></i>
            </a>
          </div>
        </td>
    </tr>
    <?php
    $nums++;
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
</html>

<!-- của phần phân trang -->
<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const imageInput = document.getElementById('image-input');
  const imagePreview = document.getElementById('image-preview');

  imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function() {
        imagePreview.src = reader.result;
      }
      reader.readAsDataURL(file);
    }
  });
</script>

<style>
  #image-preview {
    max-width: 100px;
    max-height: 80px;
  }
</style>