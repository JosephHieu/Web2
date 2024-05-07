t<?php 
    include "connect.php";
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width,  initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/pay.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <title>Trang thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <!-- Phần thanh toán -->
<div class="containerx" style="margin-top: 30px;">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">                  
                    <ol class="activity-checkout mb-0 px-4 mt-3">                       
                        <li class="checkout-item">                           
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">                               
                                    <i class="fa-regular fa-id-card text-white font-size-20"></i>
                                </div>                                 
                            </div>
                            <div class="feed-item-list">
                                <!-- Thông tin giao hàng -->
                                <div>                                   
                                    <h5 class="font-size-16 mb-1">Thông tin giao hàng</h5>
                                    <div class="feed-item-list">
                                        <div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6" >
                                                            <div data-bs-toggle="collapse" id="address-pay" >
                                                                <label class="card-radio-label mb-0">
                                                                    <input type="radio" name="address" id="info-address1" class="card-radio-input">
                                                                    <!-- php code lấy ra thông tin địa chỉ của khách hàng -->
                                                                    <?php
                                                    if(isset($_GET['tdn'])) {
                                                        $tendangnhap = $_GET['tdn'];
                                                        $sql = "select * from khachhang where tendangnhap='$tendangnhap'";
                                                        $result = mysqli_query($conn, $sql);
                                                        if(mysqli_num_rows($result) > 0) {
                                                            $fetch_khachhang=mysqli_fetch_assoc($result);
                                                            ?>

                                                            <div class="card-radio text-truncate p-3">
                                                                <span class="fs-14 mb-4 d-block">Địa chỉ của bạn</span>
                                                                <span class="fs-14 mb-2 d-block"><?php echo $fetch_khachhang['quanhuyen'] . " " . $fetch_khachhang['tptinh']?></span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block"><?php echo $fetch_khachhang['quocgia']?></span>                                                                  
                                                                <span class="text-muted fw-normal d-block">+84<?php echo $fetch_khachhang['sdt']?></span>
                                                            </div>
                                                            <?php
                                                        } 
                                                    }
                                                            ?>
                                                                </label>                                              
                                                            </div>
                                                    </div>
        
                                                    <div class="col-lg-4 col-sm-6" >
                                                        <div id="address-add">
                                                            <label class="card-radio-label mb-0">
                                                                <input type="radio" name="address" id="info-address2" class="card-radio-input" checked="">
                                                                <div class="card-radio text-truncate p-3" >
                                                                    <span class="fs-14 mb-4 d-block">Thêm địa chỉ</span>                                                                  
                                                                    <span style=" display: flex; align-items: center; justify-content: center;margin: 48px 0px ; font-size: 35px;"><i class="fa-sharp fa-regular fa-plus"></i></span>                                                         
                                                                </div>
                                                            </label>                                                      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>                                     
                                   </div>
                                </div>
                        </li>

                        <li class="checkout-item">                          
                            <div class="mb-3" id="disappear-add-address">
                                <form id="address-info">
                                    <div> 
                                        <div class="mb-3">
                                            <label class="form-label" for="billing-address">Địa chỉ</label>
                                            <textarea maxlength="100" class="form-control" id="billing-address" rows="3" placeholder="Số nhà, tên đường, quận/huyện, TP/tỉnh"></textarea>
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">Quốc gia</label>
                                                    <select class="form-control form-select" title="Country">
                                                        <option value="0">Chọn</option>
                                                        <option value="AL">Việt Nam</option>
                                                        <option value="AF">Thái Lan</option>
                                                        <option value="DZ">Lào</option>
                                                        <option value="AS">Campuchia</option>
                                                                                       
                                                    </select>
                                                </div>
                                            </div>
  
                                            <div class="col-lg-4">
                                                <div class="mb-0">
                                                    <label class="form-label" for="zip-code">Số điện thoại</label>
                                                    <input min="0" type="number" class="form-control" id="zip-code" inputmode="numeric" placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="checkout-item">
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">
                                    <i class="fa-regular fa-credit-card text-white font-size-20"></i>                          
                                </div>
                            </div>
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Thông tin thanh toán</h5>                                   
                                </div>
                                <div>
                                    <h5 class="font-size-14 mb-3">Phương thức thanh toán:</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6" style="margin-bottom: 8px;">
                                            <div>
                                                <label class="card-radio-label">
                                                    <input type="radio" name="pay-method" id="pay-methodoption3" class="card-radio-input" checked="">  
                                                    <span class="card-radio py-3 text-center text-truncate">                                                        
                                                    <i class="fa-regular fa-money-bill-1 d-block h2 mb-3"></i>
                                                    <span>Thanh toán khi giao hàng</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-6" style="margin-bottom: 8px;">
                                            <div>
                                                <label class="card-radio-label">
                                                    <input type="radio" name="pay-method" id="pay-methodoption2" class="card-radio-input" >
                                                    <span class="card-radio py-3 text-center text-truncate">
                                                        <i class="fa-solid fa-building-columns d-block h2 mb-3"></i>
                                                        Thanh toán ngân hàng
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" style="margin-top: 10px; display: none;" id="pay-card-number" >
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="card-number">Card Number</label>
                                            <input type="number" inputmode="numeric" class="form-control" style="display: none;" id="card-number" placeholder="Enter Card Number">
                                        </div>                                       
                                    </div>

                                    <div class="row" style="margin-top: 10px; display: none;" id="pay-date-cvv">                                 
                                        <div class="col-lg-4">
                                            <div class="mb-4 mb-lg-0">
                                                <label class="form-label" for="billing-city">Expiry Date</label>
                                                <input type="date" style="display: none;" class="form-control" id="expiry-date" placeholder="Enter Expiry Date" >
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-0">
                                                <label class="form-label" for="zip-code">CVV</label>
                                                <input type="number"  style="display: none;" class="form-control" id="cvv" placeholder="Enter CVV" >
                                            </div>
                                        </div>                                 
                                    </div>
                                    <div class="mb-3" style="margin-top: 10px;">
                                        <label class="form-label" for="billing-address">Order Notes</label>
                                        <textarea class="form-control" maxlength="200" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>       
                            </div>
                        </li>
                    </ol>

                    <div class="row my-4">
                        <div class="float-start">                   
                            <a href="shop-user.php?s-user=<?php echo $_GET['tdn']?>" class="btn btn-link text-muted" id="continue-shopping-btn" style="margin-right: 10px;"><i class="mdi mdi-arrow-left me-1"></i> Tiếp tục mua sắm </a>                             
                            <a  class="btn btn-success" id="success-pay-btn"><i class="mdi mdi-cart-outline me-1"></i> Hoàn tất </a>                                              
                        </div>
                    </div>
                </div>
            </div>     
        </div>

        <div class="col-xl-4">
            <div class="card checkout-order-summary">
                <div class="card-body">    
                    <div class="p-3 bg-light mb-3">    
                        <h5 class="font-size-30 mb-0" style="font-weight: 600;">Đơn hàng</h5> 
                    </div>
                    <div class="table-responsive">
                        <?php
                        if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang'])>0)) {
                            echo '<table class="table table-centered mb-0 table-nowrap"">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Chi tiết</th>
                                <th>Giá tiền</th>
                            </tr>';
                            $tong = 0;
                            foreach($_SESSION['giohang'] as $item) {
                                $tt = $item[3] * $item[4];
                                $tong += $tt;
                                echo '<tr>
                                <td>
                                <img src="images/'.$item[2].'" alt="ảnh sản phẩm" style="width: 70px; height: 70px;">     
                                </td>
                                <td>
                                    <h5 class="font-size-16 text-truncate"><a href="#" class="text-dark">'.$item[1].'</a></h5>
                                    <p class="text-muted mb-0 mt-1">'.$item[3].' x '.$item[4].'</p>
                                </td>
                                <td>'.$tt.'vnđ</td>                               
                            </tr>';
                            }
                            echo '<tr>
                            <td colspan="2">Tổng cộng: </td><td>'.$tong.'vnđ</td><td></td>
                        </tr>';
                            echo "</table>";
                        } else {
                            echo "Đơn hàng trống";
                        }
                        ?>
                    </div>
                </div>
            </div>        
        </div>         
    </div>
    <!-- end row -->
    <hr>
</div>

</body>
</html>

<script>
    const cod=document.getElementById("pay-methodoption3");
    const visa=document.getElementById("pay-methodoption2");
    const mastercard=document.getElementById("pay-methodoption1");
    const expiry=document.getElementById("pay-card-number");
    const cvv=document.getElementById("pay-date-cvv");
    const cardnumber=document.getElementById("card-number");
    const expirydate=document.getElementById("expiry-date");
    const cvvs=document.getElementById("cvv");
    cod.addEventListener('click',()=>{
    expiry.style.display='none';
        cvv.style.display='none';
        cardnumber.style.display='none';
        cvvs.style.display='none';
        expirydate.style.display='none';
    });
    visa.addEventListener('click',()=>{
        expiry.style.display='flex';
        cvv.style.display='flex';
        cardnumber.style.display='flex';
        cvvs.style.display='flex';
        expirydate.style.display='flex';
    });
</script>

<script>
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
        overlay.style.display = 'none';
    htmlElement.style.overflowY = 'scroll';
    searchbars.classList.remove("active25");
    searchbars.style.opacity="0";
        searchbars.style.pointerEvents = 'none';
        }
</script>

<script>
    const accountaddress=document.querySelector('#address-pay');
    const addressadd=document.querySelector('#address-add');
    const addressinfo=document.querySelector('#address-info');
    const disappearaddress=document.querySelector('#disappear-add-address');
    accountaddress.onclick = function(){
    addressinfo.style.display="none";
    disappearaddress.style.display="none";

    }
    addressadd.onclick=function(){
        addressinfo.style.display="block";
        disappearaddress.style.display="block";
    
    }
    const btnbuy = document.querySelector('#success-pay-btn');
    btnbuy.onclick=function(){
        alert('Successful payment');
            window.location.href='shop-user.php?s-user=<?php echo $_GET['tdn']?>';
    }
</script>

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
  htmlElement.style.overflowY = 'scroll';
  searchbars.classList.remove("active25");
        searchbars.style.opacity="0";
        searchbars.style.pointerEvents = 'none';
        overlay.style.display = 'none';
        subMenu.classList.remove("open-menu");
  });
  
  
  window.addEventListener("resize", function() {
  
    if (window.innerWidth >= 1136) {
        searchbars.classList.remove("active25");
        searchbars.style.opacity="0";
        icons.style.right = "-300px";
        searchbars.style.pointerEvents = 'none';
      icons.classList.remove('active');
      htmlElement.style.overflowY = "scroll";
      overlay.style.display='none';
    }
   else{
    icons.style.right="-300px";
   }
    }
  );
</script>
  
<script>
        var htmlElement = document.querySelector('html');
    const searchbars=document.querySelector(".search-bars");
        const glasssearch=document.getElementById("glass-search");
        var overlay = document.getElementById('overlay');
    function showbar(){
        searchbars.classList.add('active25');
        searchbars.style.pointerEvents = 'all';
        htmlElement.style.overflow = 'hidden';
        searchbars.style.opacity="1";
        overlay.style.display='block';
        overlay.style.zIndex = '98';
        subMenu.classList.remove("open-menu");
        }
        function closebar(){

        searchbars.classList.remove('active25');
        htmlElement.style.overflowY = 'scroll';
        searchbars.style.opacity="0";
        searchbars.style.pointerEvents = 'none';
        overlay.style.display='none';
        }
        document.getElementById('overlay').addEventListener('click', function() {
    closebar();

    });
</script>

<style>
     a{
        margin: 0;
        
    }
    a:hover{
        color: #878a99;
    }
    ul{
        padding-left: 0;
    }
    img{
        vertical-align:0;
    }
    hr{
        opacity: 1;
    border: 1;
    color: white;
        margin: 0;
    }
    h1,h2,p,ul{
        margin-bottom: 0;
        line-height: normal;
    }

    input{
        font-size: 16px;
        line-height: normal;
    }
</style>


