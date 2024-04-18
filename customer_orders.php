<?php
session_start();

require "_dbConnection.php";

$obj = new Farmer();

if(isset($_POST["orderPlaced"])){
   if($obj->place_order($_POST["order_id"])){
      echo "<script>alert('Order placed');</script>";
   }else{
      echo "<script>alert('Order was not able to be placed');</script>";
   }
}



?>
<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Farmer Account</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,800;1,400&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">


      <!-- <script>
         // Add event listener to all buttons with class 'orderBtn'
         var orderButtons = document.querySelectorAll('.orderBtn');
         orderButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                  var orderId = this.getAttribute('data-order-id');
                  document.getElementById('orderIdInput').value = orderId;
                  document.getElementById('orderForm').submit(); // Submit the form
            });
         });
      </script> -->


      <style>

         .neonBtnGreen {
            padding: 10px;
            font-family: 'Poppins', sans-serif;
            /* display: inline-block; */
            text-decoration: none;
            /* font-size: 3em; */
            overflow: hidden;
            background-color: #00a651;
            color: white;
         }
 
        /*creating animation effect*/
         .neonBtnGreen:hover {
            color: #111;
            background: #39ff14;
            box-shadow: 0 0 50px #39ff14;
         }

         .neonBtnRed {
            padding: 10px;
            font-family: 'Poppins', sans-serif;
            /* display: inline-block; */
            text-decoration: none;
            /* font-size: 3em; */
            overflow: hidden;
            background-color: red;
            color: white;
         }

         .neonBtnRed:hover {
            color: #111;
            background: red;
            box-shadow: 0 0 50px red;
         }


      </style>


   </head>
   <body>
   <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="navbar-brand"href="index.html"><img src="./images/Logo (2).png" width="300px"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="vagetables.php">Vagetables</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="fruits.php">Fruits</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="cereals.php">Cereals</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="font-family: 'Sen', sans-serif;">My Account <span class="fa fa-user" style="margin-left: 0.0.%;"></span></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="customer_account.php">My Account</a>
                            <a class="dropdown-item" href="customer_profile.php">Profile</a>
                            <a class="dropdown-item" href="customer_orders.php">My Orders</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
      <!-- header section end -->
      <div class="container-fluid">
         <div class="layout_border" style="padding: 3%;">
            <h1 align="center">Your Orders which will be delivered soon...</h1>
            <div class="layout_border" style="margin-top: 100px; padding: 2.5%; margin-bottom: 50px; width: 95%; margin-left: 2.5%; margin-right:2.5%; display: flex; flex-wrap: wrap; justify-content: space-evenly;" >
            <form id="orderForm" action="#" method="POST">
               <input type="hidden" id="orderIdInput" name="order_id" value="">
            </form>

            <?php 
                  $sql = $obj->conn->prepare("SELECT * FROM customer_orders_in_process WHERE customer_id = ?");
                  $sql->bind_param("i", $_SESSION["customerMbNumber"]);
                  $sql->execute();
                  $result = $sql->get_result();

                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 300px;'>";
                        echo "<div class='card-header'>";
                        echo "<h2>".$row["crop_name"]."</h2>";
                        echo "<p>".$row["crop_catagory"]."</p>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<img style='margin: 2.5%; width: 95%;' src='" . $row["crop_image"] . "'>";
                        echo "</div>";
                        echo "<div class='card-footer'>";
                        echo "<p> Owner name: ".$row["provider_name"]."</p>";
                        echo "<div style='display: flex; justify-content: space-evenly;'>";
                        echo "<button type='button' class='btn btn-success neonBtnGreen orderBtn' data-order-id='" . $row["order_id"] . "' style='width: 90%;'>Order is placed</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                     }
                  } else {
                     echo "<h1 align='center'>No Crops are for delivery</h1>";
                  }
               ?>
            </div>
            <h1 align="center">Your delivered orderes...</h1>
            <div class="layout_border" style="margin-top: 100px; padding: 2.5%; margin-bottom: 50px; width: 95%; margin-left: 2.5%; margin-right:2.5%; display: flex; flex-wrap: wrap; justify-content: space-between;" >
                <?php 

                    $sql = "SELECT * FROM  customer_orders_placed";
                    $result = mysqli_query($obj->conn, $sql);

                    // Create the HTML markup for the cards
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 300px;'>";
                            echo "<div class='card-header'>";
                            echo "<h2>".$row["crop_name"]."</h2>";
                            echo "<p>".$row["crop_catagory"]."</p>";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            // header("Content-Type: image/jpeg");
                            // echo "<img style='margin: 2.5%; width: 95%;' src=".'\''.$row["crop_image"].'\''.">";
                            echo "<img style='margin: 2.5%; width: 95%;' src='" . $row["crop_image"] . "'>";
                            // echo $row["crop_image"];
                            echo "</div>";
                            echo "<div class='card-footer'>";
                            echo "<p> Owner name: ".$obj->get_farmer_name_by_farm_id($row["farm_id"])."</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<h1 align='center'>No Crops were delivered</h1>";
                    }

                ?>
            </div>
         </div>
      </div>
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-6">
                  <h3 class="footer_text">Useful links</h3>
                  <div class="footer_menu">
                     <ul>
                        <li class="active"><a href="index.php"><span class="angle_icon active"><i class="fa fa-arrow-right" aria-hidden="true"></i></span> Home</a></li>
                        <li><a href="about.html"><span class="angle_icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>  About</a></li>
                        <li><a href="shop.php"><span class="angle_icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span> Shop</a></li>
                        <li><a href="blog.php"><span class="angle_icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span> Blog</a></li>
                        <li><a href="contact.php"><span class="angle_icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>  Contact Us</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <h3 class="footer_text">Address</h3>
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="https://www.google.com/maps/place/GP+Solapur+Computer%2FIT+Department/@17.6719561,75.9209733,17z/data=!4m10!1m2!2m1!1sGP+solapur!3m6!1s0x3bc5db106c539231:0xc7eb360100ececff!8m2!3d17.6720544!4d75.924183!15sCgpHUCBzb2xhcHVykgEScG9seXRlY2huaWNfc2Nob29s4AEA!16s%2Fg%2F11clsypsmp?entry=ttu">
                           <span class="padding_left_10"><i class="fa fa-map-marker" aria-hidden="true"></i></span>Location: Government Polytechnic Solapur</a>
                        
                        <li>
                           <a href="tel:+919404210220">
                           <span class="padding_left_10"><i class="fa fa-phone" aria-hidden="true"></i></span>(+91) 9404210220
                           </a>
                        </li>
                        <li>
                           <a href="mailto:adharashivkar17@gmail.com">
                           <span class="padding_left_10"><i class="fa fa-envelope" aria-hidden="true"></i></span>adharashivkar17@gmail.com
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="footer_main">
                     <h3 class="footer_text">Find Us</h3>
                     <p class="dummy_text">Below are our social media links </p>
                     <div class="social_icon">
                        <ul> 
                           <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                           <li><a href="https://twitter.com/AdityaDhara2345"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                           <li><a href="https://www.instagram.com/dharashivkar.aditya/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://github.com/adityadhara040505">Dharashivkar Aditya Mahesh</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
      <!-- Bootstrap JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- jQuery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="js/plugin.js"></script>
      <script>
         // Add event listener to all buttons with class 'orderBtn'
         button.addEventListener('click', function() {
            console.log('Button clicked');
            var orderId = this.getAttribute('data-order-id');
            document.getElementById('orderIdInput').value = orderId;
            document.getElementById('orderForm').submit(); // Submit the form
         });
      </script>
   </body>
</html>