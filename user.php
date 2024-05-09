<?php
    include "connect.php";
    session_start();

    $tendangnhap = $_SESSION['mySession'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thông tin khách hàng</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #f5f5f5;">
 
    <div class="containerz">
        <div class="row">
            <!-- phần nav -->
            <div class="col-md-3" style="border: 1px solid #DFDFDF;padding-left: 0;padding-right: 0;">
                <div class="osahan-account-page-left bg-white h-100" >
                    <div class="border-bottom p-4">
                        <div style="display: flex; justify-content: center;" id="logo-history">
                                <img src="images/LOGO.webp" class="logo-user" style="cursor: pointer;" onclick="window.location.href='index-user.php' " alt="Logo Thương hiệu">
                        </div>
                    </div>
                                
                    <a class="list-group-item list-group-item-action active" 
                    href="user.php">Thông tin</a>
                    <a class="list-group-item list-group-item-action" 
                    href="history.php">Lịch sử mua hàng</a>
    
                    <a class="list-group-item list-group-item-action" 
                        href="changepass.php">Thay đổi mật khẩu</a>

                </div>
            </div>
            <!-- phần thông tin -->
            <div class="col-md-9" style="border: 1px solid #DFDFDF;padding-left: 0px; padding-right: 0px;">
                <div class="osahan-account-page-right bg-white p-2 h-100">
                    <div class="tab-content" id="myTabContent">
                     <div class="col-md-9" style="padding-left: 0; padding-right: 0;">
                         <div class="tab-content">
                             <div class="tab-pane fade active show" id="account-general">
                                 <div class="card-body media align-items-center">
                                     <img src="assets/images/pic/usernew.png" alt="ảnh đại diện"
                                     
                                         class="d-block ui-w-80" id="preview">
                                     <div class="media-body ml-4">
                                         <label class="btn btn-outline-primary">
                                            Thông tin tài khoản
                                         </label> &nbsp;
                                        
                                     </div>
                                 </div>
                                 <hr class="border-light m-0">

                                 <!-- php code -->
                                 <?php
                            $sql=mysqli_query($conn, "select * from khachhang where tendangnhap='$tendangnhap'");
                            $row=mysqli_fetch_assoc($sql);
                                 ?>


                                 <div class="card-body">
                                     <div class="form-group">
                                         <label class="form-label">Tên tài khoản</label>
                                         <input type="text" class="form-control mb-1" value="<?php echo $row['tendangnhap']?>" disabled>
                                     </div>
                           
                                     <div class="form-group">
                                         <label class="form-label">Họ và tên</label>
                                         <input type="text" class="form-control" value="<?php echo $row['hovaten']?>">
                                     </div>
                                     <div class="form-group">
                                         <label class="form-label">Email</label>
                                         <input type="text" class="form-control mb-1" value="<?php echo $row['email']?>">
                                     
                                     </div>
                            
                                     <div class="form-group">
                                         <label class="form-label">Giới tính</label>
                                         <input id="male" style="margin-left: 10px;" type="radio" name="gender" value="male" checked> Nam 
                                         <input id="female" style="margin-left: 10px;" type="radio" name="gender" value="female"> Nữ
                                     </div>
                                     
                                     <div class="row" style="margin-bottom: 10px;">
                                         <div class="col-lg-4">
                                             <div class="mb-4 mb-lg-0">
                                                 <label class="form-label">Ngày sinh</label>
                                                 <input type="date" class="form-control" value="<?php echo $row['namsinh']?>" >
                                             </div>
                                         </div>
             
                                         <div class="col-lg-4">
                                             <div class="mb-4 mb-lg-0">
                                                 <label class="form-label">Số điện thoại</label>
                                                 <input type="text" class="form-control" value="+84<?php echo $row['sdt']?>"> 
                                             </div>
                                         </div>
             
                                         
                                     </div>
                                   
                                     <div class="form-group">
                                         <label class="form-label">Địa chỉ</label>
                                         <input type="text" class="form-control" value="<?php echo $row['quanhuyen'] . ", " . $row['tptinh'] . ", " . $row['quocgia']?>">
                                     </div>

                                     <div  id="profile-button" style="display: flex; justify-content: center;margin-top: 50px;margin-bottom: 20px;">
                                        <button type="button" class="btn btn-default" id="button-go-back" onclick="window.location.href='shop-user.php'"><i class="fa-solid fa-chevron-left"></i> Quay Lại</button>
                                        <button type="button" class="btn btn-primary"
                                        onclick="return confirm('Bạn có muốn lưu lại thông tin vừa thay đổi');">Lưu</button>&nbsp;
                                       
                                    </div>
                                    
                                 </div>
        
                               
                         </div>
                     </div>
               
                    </div>
                    
                </div>
           
            </div>
    
        </div>
        
    </div>
</body> 

</html>

<script>
    function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var dataURL = reader.result;
        var preview = document.getElementById('preview');
        preview.src = dataURL;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
    }
</script>   
   





