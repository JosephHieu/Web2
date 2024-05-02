<?php
    include "connect.php";

    session_start();

    if(isset($_SESSION['mySession'])) {
        header('location: admin-strator.php');
    }

    if(isset($_POST['dangnhap'])) {
        $tendangnhap = $_POST['tendangnhap'];
        $matkhau     = md5($_POST['matkhau']);

        // 
        $sql = "select * from nguoiquantri where
        tendangnhap='$tendangnhap' and matkhau ='$matkhau'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $_SESSION['mySession'] = $tendangnhap;
            header('location: admin-strator.php');
        } else {
            echo "<script>
                alert('Tên đăng nhập hoặc mật khẩu không chính xác');
            </script>";
        }
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="assets/css/lg-admin.css">
         
    <title>Đăng nhập Admin</title> 
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Đăng nhập Admin</span>
                <!-- form đăng nhập admin -->
                <form action="admin-login.php" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <input id="username" type="text" name="tendangnhap" placeholder="Tên đăng nhập" required>
                        <i class="uil uil-user icon"></i>
                    </div>

                    <div class="input-field">
                        <input id="password" type="password" name="matkhau" class="password" placeholder="Mật khẩu" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Đăng nhập" name="dangnhap">
                    </div>
                </form>       
            </div>       
        </div>
    </div> 
</body>
</html>

<script>
  const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });
</script>

