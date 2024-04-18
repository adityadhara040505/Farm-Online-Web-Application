<?php
session_start();

require "_dbConnection.php";

$obj = new Farmer();

if(isset($_POST["addFarmDetails"])) {
   // Redirect to farm_data_input.php
   header("Location: farm_data_input.php");
   exit;
}

// if(isset($_POST["addCropDetails"])) {
//    // Echo JavaScript to prompt the user for Farm ID and redirect with it
//    echo "<script>";
//    echo "var farmID = prompt('Enter Farm ID for which you want to add crop \n \(*NOTE: Enter farm ID for which you haven\'t entered for any other crop\)');";
//    echo "if(farmID !== null && farmID !== '') {"; // Check if the user entered something
//    echo "   window.location.href = 'crop_data_input.php?farm_id=' + encodeURIComponent(farmID);"; // Redirect with Farm ID
//    echo "}";
//    echo "else{";
//    echo "alert('Please enter farm ID');";
//    echo "window.history.back();";
//    echo "}";
//    echo "</script>";
//    exit;
// }

if(isset($_POST["makeItOffline"])){
   if($obj->delete_crop_from_online_crop_data($_POST["crop_id"])){
      echo "<script>alert('Crop is removed successfully');</script>";
   }
   else{
      echo "<script>alert('Crop was not able to remove from database');</script>";
   }
}

if(isset($_POST["move_crop_online"])){
   if(isset($_POST["crop_id"]) && isset($_POST["price"])) {
      $crop_id = $_POST["crop_id"];
      $price = $_POST["price"];
      $quantity = $_POST["quantity"];
      // Process $crop_id and $price as needed
      $obj->move_crops_online($crop_id, $price,$quantity);
   } else {
      echo "Error: Crop ID or price is missing.";
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

      <script>
         function redirectToCropInput() {
            var farmID = prompt('Enter Farm ID for which you want to add crop \n \(*NOTE: Enter farm ID for which you haven\'t entered for any other crop\)');
            if (farmID !== null && farmID !== '') {
               window.location.href = 'crop_data_input.php?farm_id=' + encodeURIComponent(farmID);
            } else {
               alert('Please enter farm ID');
            }
         }
      </script>

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
                  </ul>
               </div>
            </nav>
         </div>
      </div>
      <!-- header section end -->
      <!-- layout_border start -->
      <div class="container-fluid">
         <div class="layout_border">
            <!-- about section start -->
            <div class="about_section layout_padding margin_bottom90">
               <div class="container">
                  <div class="row">
                     <div class="col-md-5">
                        <h1 class="about_taital">Hey <?php echo $_SESSION['farmerName']; ?></h1>
                        <p class="about_text">Welcome to your account. Here you can see your farm products</p>
                     </div>
                     <div class="col-md-7" style="margin-top: 3rem;">
                        <form id="addCropForm" action="#" method="POST">
                           <input type="hidden" id="farm_id" name="farm_id">
                           <div class="row">
                              <div class="col-md-6">
                                 <center>
                                    <button name="addFarmDetails" type=" button" class="neonBtnGreen" style="border-radius: 30px; width: 100%;">Add FARM Details</button>
                                 </center>
                              </div>
                              <div class="col-md-6">
                                 <center>
                                 <button type="button" onclick="redirectToCropInput()" class="neonBtnRed" style="border-radius: 30px; width: 100%; margin-left: 100px;">Add CROP Details</button>
                                 </center>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- about section end -->
            <!-- layout_border end -->
         </div>
      </div>
      <div class="container-fluid">
         <div class="layout_border">
            <center>
               <h1 style="font-size: 40px; font-weight: bolder; margin-top: 2%;"> Here are your online crops</h1>
            </center>
            <div class="layout_border" style="margin-top: 100px; padding: 2.5%; margin-bottom: 50px; width: 95%; margin-left: 2.5%; margin-right:2.5%; display: flex; flex-wrap: wrap; justify-content: space-between;" >
                <?php 

               //  $sql = "SELECT * FROM online_crop_data WHERE `farm_id` = (SELECT `farm_id` FROM farm_data WHERE `farmerId` = ".$_SESSION["farmerMbNumber"].")";
               $sql = "SELECT oc.* FROM online_crop_data oc INNER JOIN farm_data fd ON oc.farm_id = fd.farm_id WHERE fd.farmerId = ".$_SESSION["farmerMbNumber"];
                $result = mysqli_query($obj->conn, $sql);

                // Create the HTML markup for the cards
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='#' method='POST'>";
                        echo "<input type='hidden' type='number' name='crop_id' value= '".$row["crop_id"]."'>";
                        echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 350px;'>";
                        echo "<div class='card-header'>";
                        echo "<h2>".$row["crop_name"]."</h2>";
                        echo "<p>".$row["crop_catagory"]."</p>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        // header("Content-Type: image/jpeg");
                        // echo "<img style='margin: 2.5%; width: 95%;' src=".'\''.$row["crop_image"].'\''.">";
                        // echo "<img style='margin: 2.5%; width: 95%;' src='" . $row["crop_image"] . "'>";
                        // echo $row["crop_image"];
                        echo "</div>";
                        echo "<div class='card-footer'>";
                        echo "<p>Current available quantity: ".$row["current_quantity"]." KG</p>";
                        echo "<p> Price: <b>".$row["price"]."</b></p>";
                        echo "<div  style='display: flex; justify-content: space-evenly;'>";
                        echo "<button class='btn btn-success' type='submit' name='showOrders' style='width: 45%;'>Show Orders</button>";
                        echo "<button class='btn btn-danger' type='submit' name='makeItOffline' style='width: 45%;'>Make is offline</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                } else {
                    echo "<h1 align='center'>No Crops are online</h1>";
                }

                ?>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="layout_border">
            <center>
               <h1 style="font-size: 40px; font-weight: bolder; margin-top: 2%;"> Here are your processing crops</h1>   
            </center>
            <div class="layout_border" style="margin-top: 100px; padding: 2.5%; margin-bottom: 50px; width: 95%; margin-left: 2.5%; margin-right:2.5%; display: flex; flex-wrap: wrap; justify-content: space-between;" >
                <?php 

                $today = date("Y-m-d");

                $sql = "SELECT oc.* FROM processing_crop_data oc INNER JOIN farm_data fd ON oc.farm_id = fd.farm_id WHERE fd.farmerId = ".$_SESSION["farmerMbNumber"]."";
                $result = mysqli_query($obj->conn, $sql);

                // Create the HTML markup for the cards
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='#' method='POST'>";
                        echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 350px;'>";
                        echo "<div class='card-header'>";
                        echo "<input type='hidden' name='crop_id' value='". $row["crop_id"] ."'>";
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
                        // echo "<div  style='display: flex; justify-content: space-evenly;'>";
                        if ($today >= $row["date_of_reaping"]) {
                           echo "<input type='number' name='price' placeholder='Enter Price' class='form-control mb-4'>";
                           echo "<input type='number' name ='quantity' placeholder='Quantity of of crops in KG' class='form-control mb-4'>";
                           echo "<div  style='display: flex; justify-content: space-evenly;'>";
                           echo "<button class='btn btn-success' name='move_crop_online' style='width: 90%;'>Move to Online</button>";
                           // echo "<button class='btn btn-danger' style='width: 45%;' name='read more' type='readMore'>Read More</button>";
                           echo "</div>";
                       } else {
                           // If not, show a disabled button or any other message
                           echo "<div  style='display: flex; justify-content: space-evenly;'>";
                           echo "<button class='btn btn-success' style='width: 90%;' disabled>Move to Online</button>";
                           // echo "<button class='btn btn-danger' style='width: 45%;' name='read more' type='readMore'>Read More</button>";
                           echo "</div>";
                       }               
                        // echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                } else {
                    echo "<h1 align='center'>No Crops are online</h1>";
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
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
   </body>
</html>
