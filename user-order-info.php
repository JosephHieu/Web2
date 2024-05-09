<?php
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/images/pic/logoicon.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user-order.css">
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,  initial-scale=0.9,maximum-scale=1">
    <title>Order Detail</title>
</head>
<body>
  <div class="container">
    <article class="card">
        <header class="card-header" style="display: flex; justify-content: start; align-items: center;"> 
        <h3 style="font-size: 17px; font-weight: 600; margin-right: 15px;">My Orders</h3>
        <h3 style="font-size: 17px;">ID: OD45345345435</h3>
        </header>
        <div class="card-body">
           
            <article class="card">
                <div class="card-body col">
                  <div class="row" style="display: flex; justify-content: flex-start;"> 
                
                    <span style="margin-right: 25px; margin-left: 10px;"><strong>Date Order:</strong> 21-4-2021    </span> 
                  
                   
                
                      <span> <strong>Delivery Date:</strong> 23-4-2021</span> 
                 
                </div>
             
                  
                   
                   
                </div>
            
            </article>
            <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
            </div>
            <hr>
            <div class="osahan-account-page-right  bg-white p-2 h-100">
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                  

                      <div class="bg-white card mb-4 order-list shadow-sm">
                          <div class="gold-members p-4">
                              <a href="#">
                              </a>
                              <div class="media">
                                  <a href="#">
                                      <img class="mr-4" src="assets/images/sp/cocaori.png" alt="Generic placeholder image">
                                  </a>
                                  
                                  <div class="media-body">
                                     
                                      <h6 class="mb-2" style="font-size: 18px;">
                                       
                                          Coca Original
                                      </h6>
                                      <div class="flex-container">
                                          <p class="mb-3"> $13.00</p>
                                          <p class="text-gray mb-1">x2</p>
                                          
                                        </div>
                                      
                                      <p  style="color: #26aa99;"><i class="fa-solid fa-truck"></i> Delivery successful</p>
                                  
                                      <hr>
                                    
                                  </div>
                              </div>
                              <div class="media">
                                  <a href="#">
                                      <img class="mr-4" src="assets/images/sp/lemon.png" alt="Generic placeholder image">
                                  </a>
                                  
                                  <div class="media-body">
                                     
                                      <h6 class="mb-2" style="font-size: 18px;">
                                       
                                         Lemon Tea
                                      </h6>
                                      <div class="flex-container">
                                          <p class="mb-3">$16.00</p>
                                          <p class="text-gray mb-1">x2</p>
                                         
                                        </div>
                              
                                      
                                      <p  style="color: #26aa99;"><i class="fa-solid fa-truck"></i> Delivery successful </p>

                                      <p class="mb-0 text-black pt-2" id="total-money" style="font-size: 16px;"><span class="text-black font-weight-bold"> Subtotal:</span> $58.00</p>
                                      <p class="mb-0 text-black pt-2" id="total-money" style="font-size: 16px;"><span class="text-black font-weight-bold"> Shipping:</span> $2.00</p>
                                      <p class="mb-0 text-black text-primary pt-2" id="total-money"><span class="text-black font-weight-bold"> Total:</span> $60.00</p>
                                     
                              
                                  </div>
                              </div>
                            
                          
                          </div>
                      </div>
                   
                 

                  </div>
              </div>
          </div>
          <h6>Delivery Address</h6>
          <article class="card">
            <div class="card-body row"  style="padding-bottom: 0;">
              <div class="col"> <strong>Lam Dieu Quang </strong><br> (+17) 637745710 <br>xyz@emxaple.com</div>
           
              <div class="col"> <strong>Address:</strong> 45 Beaver St KLOIW wewrw rwrwr</div>
             
         
  
            </div>
         
            <div class="card-body row">
              <div class="col"> <strong>Your note:</strong> I love your web!!</div>
        
         
               
               
            </div>
        
        </article>
            <hr>
            <a href="history.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
</div>
</body>
</html>


