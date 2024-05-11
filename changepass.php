
<?php
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thông tin</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


   
    <body style="background-color: #f5f5f5;">

        <div class="containerz">
            <div class="row">
                <!-- phần nav -->
                <div class="col-md-3" style="border: 1px solid #DFDFDF;padding-left: 0;padding-right: 0;">
                    <div class="osahan-account-page-left  bg-white h-100">
                        <div class="border-bottom p-4">
                         <div style="display: flex; justify-content: center;"  id="logo-history">
                             <img src="images/LOGO.webp" class="logo-user" style="cursor: pointer;" onclick="window.location.href='index-user.php' ">
                         </div>
                                         
                        </div>
                      
                   
                            <a class="list-group-item list-group-item-action" 
                            href="user.php">Thông tin</a>
                            <a class="list-group-item list-group-item-action" 
                            href="history.php">lịch sử mua hàng</a>
        
                        <a class="list-group-item list-group-item-action active" 
                            href="changepass.php">Thay đổi mật khẩu</a>
                     
                        
                       
                    </div>
                    
                </div>
                <!-- Phần xử lý mật khẩu -->
                <div class="col-md-9" style="border: 1px solid #DFDFDF;padding-left: 0px; padding-right: 0px;">
                    <div class="osahan-account-page-right bg-white p-2 h-100">
                        <div class="tab-content" id="myTabContent">
                         <div class="col-md-9" style="padding-left: 0; padding-right: 0;">
                             <div class="card-body pb-2">
                                 <div class="form-group">
                                     <label class="form-label">Mật khẩu cũ</label>
                                     <input type="password" class="form-control" id="password1">
                                 </div>
                                 <div class="form-group">
                                     <label class="form-label">Mật khẩu mới</label>
                                     <input type="password" class="form-control" id="password2">
                                 </div>
                                 <div class="form-group">
                                     <label class="form-label">Xác nhận mật khẩu mới</label>
                                     <input type="password" class="form-control">
                                 </div>

                                 
                                 <div  id="profile-button" style="display: flex; justify-content:center;margin-top: 50px;margin-bottom: 20px;">
                                    <button type="button" class="btn btn-default" id="button-go-back" onclick="window.location.href='shop-user.php'"><i class="fa-solid fa-chevron-left"></i> Quay Lại</button>
                                    <button type="button" class="btn btn-primary" id="saveButton">Lưu</button>&nbsp;
                                   
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
    document.getElementById("saveButton").addEventListener("click", function() {
    var password1 = document.getElementById("password1").value;
    var password2 = document.getElementById("password2").value;
    
    if (password1 !== password2) {
        alert("Mật khẩu không khớp!");
    }else {
        alert("Đổi mật khẩu thành công");
    }
    });
</script>