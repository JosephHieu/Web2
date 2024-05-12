<?php 
    include "connect.php";
    session_start();

    if(isset($_GET['tdn'])) {
        $tendangnhap = $_GET['tdn'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Liệt kê đơn hàng</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" type="image/png" href="images/LOGO.webp">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
    $sql=mysqli_query($conn, "select * from chitiethoadon 
    where tendangnhap='$tendangnhap'")
    or die(mysqli_error($conn));
    
    if(mysqli_num_rows($sql) > 0) {
        echo '
                  <table width="100%" id="table-order">
                      <thead>
                          <tr id="select-filter">                                             
                              <th>Mã hóa đơn</th>    
                              <th>Chi tiết đơn hàng</th>
                          </tr>
                      </thead>
                      <tbody>
                      ';
        while($row = mysqli_fetch_assoc($sql)) {
        ?>
            <tr>
                <td><?php echo $row['mahd']?></td>
                <td>
                    <a href="admin-statistic-order-detail.php?mahd=<?php echo $row['mahd']?>">
                        Chi tiết
                    </a>
                </td>
            </tr>
        <?php
        }
    }
    ?>
</body>
</html>