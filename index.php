
<?php
session_start();

require "_dbConnection.php";

$obj = new Farmer();

if(isset($_POST["buy_crop"])){
   if(isset($_SESSION["customerName"])){
      // echo "<script>alert('Customer exists');</script>";
      if($obj->buy_crop($_SESSION["customerMbNumber"],$_POST["crop_id"], $_POST["ordered_quantity"])!=false){
         echo "<script>alert('You have successfully ordered your crop');</script>";
         header("Location: " . $_SERVER['HTTP_REFERER']);
         exit;
      }
   }else{
      echo "<script>alert('Ordere decilned');</script>";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
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
      <title>Farm Online</title>
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
   </head>
   <body>
      <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="navbar-brand"href="index.php"><img src="./images/Logo (2).png" width="300px"></a>
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
            <!-- banner section start --> 
            <div class="banner_section layout_padding">
               <div class="container-fluid">
                  <div id="main_slider" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        <!-- Carousel Item 1-->
                        <div class="carousel-item active">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="banner_taital_main">
                                    <h2 class="banner_taital">Open wolrd of Fresh Farm Products</h2>
                                    <p class="banner_text">Here is the open for all farmers website</p>
                                    <div class="btn_main">
                                       <div class="started_text"><a href="about.html">About us</a></div>
                                       <div class="started_text active"><a href="contact.html">Contact Us</a></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="banner_img"><img src="./images/banner-img.png"></div>
                              </div>
                           </div>
                        </div>
                        <!-- Carousel Item 2-->
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="banner_taital_main">
                                    <h5 class="banner_taital">You can also be part of us by clicking on "CONTACT US"</h5>
                                    <div class="btn_main">
                                       <div class="started_text"><a href="about.html">ABOUT US</a></div>
                                       <div class="started_text active"><a href="contact.html">Contact Us</a></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="banner_img"><img src="images/banner-img.png"></div>
                              </div>
                           </div>
                        </div>
                        <!-- Carousel Item 3-->
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="banner_taital_main">
                                    <h1 class="banner_taital">Know more about us by clicking on "ABOUT US"</h1>
                                    <div class="btn_main">
                                       <div class="started_text"><a href="about.html">ABOUT US</a></div>
                                       <div class="started_text active"><a href="contact.html">Contact Us</a></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="banner_img"><img src="images/banner-img.png"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                     <img src="images/arrow-left.png">
                     </a>
                     <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                     <img src="images/arrow-right.png">
                     </a>
                  </div>
               </div>
            </div>
            <!-- banner section end -->
            <!-- about section start -->
            <div class="about_section layout_padding">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <center>
                           <h1 class="about_taital">Welcome to Farmer's Online!</h1>
                        </center>
                     </div>
                  </div>

                  <hr>

                  
                  <div class="row m-5">
                  
                     <center>
                        <div class="col-md-12">
                           <p class="ipsum_text">At Farmer's Market Online, we believe in bridging the gap between farmers and consumers by providing an open platform for farmers to showcase and sell their high-quality produce directly to customers. Our mission is to empower farmers, promote sustainability, and foster community connections through accessible online commerce.</p>
                        </div>


                        <div class="col-md-6">
                           <p class="ipsum_text" style="font-weight: bold; font-size: 30px; margin-top: 40px;">
                              How It Works
                           </p>
                        </div>

                        <div class="col-md-12">
                           <p class="ipsum_text">Farmers can easily create their profiles on Farmer Online and upload details about their farm, the products they offer, and their farming practices. Our intuitive platform allows them to showcase their unique offerings through photos, descriptions, and pricing information. 
                           </p><p class="ipsum_text">Can explore a wide selection of farm-fresh products, ranging from organic fruits and vegetables to pasture-raised meats and artisanal cheeses. With just a few clicks, customers can place orders directly from their favorite farmers and have their purchases delivered straight to their doorstep.</p>
                        </div>
                     </center>
                  </div>
               </div>
            </div>
            <!-- about section end -->
            <!-- vagetables section start -->
            <div class="vagetables_section layout_padding">
               <div class="container">
                  <div class="row" style="padding-top: 1%; padding-bottom: 1%;">
                     <div class="col-sm-12">
                        <div style="font-size: xx-large; font-style: bold;">Vegetables</div>
                        <div style="font-size: medium;">Here are some fresh vegetables available for delivery</div>
                     </div>
                     <div class="col-md-12 mt-4 mb-4">
                        <?php
                           // $sql = "SELECT * FROM online_crop_data";
                           $sql = "SELECT `crop_id`, `crop_name`, `crop_catagory`, `farm_id`, `crop_image`, `price`, `current_quantity` FROM `online_crop_data` WHERE crop_catagory = 'vegetables';";
                           $result = mysqli_query($obj->conn, $sql);
            
                           // Create the HTML markup for the cards
                           if (mysqli_num_rows($result) > 0) {
                              $i = 0;
                              // Output data of each row
                              while($i < 6) {
                                 $row = mysqli_fetch_assoc($result);
                                 echo "<form action='#' method='POST'>";
                                 echo "<input type='hidden' name='crop_id' value = '".$row["crop_id"]."'>";
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
                                 echo "<p>Current available quantity: "."<span id='current_crop_quantity'>".$row["current_quantity"]."</span>"." KG</p>";
                                 echo "<p> Price: <b>".$row["price"]."</b></p>";
                                 echo "<input type='number' placeholder='How much you want' id='customer_needs' class='form-control mb-4' onkeyup='checkForquantity()'>";
                                 echo "<div  style='display: flex; justify-content: space-evenly;'>";
                                 echo "<button class='btn btn-success' name='buy_crop' style='width: 90%;'>Buy</button>";
                                 echo "</div>";
                                 echo "</div>";
                                 echo "</div>";
                                 echo "</form>";
                                 $i++;
                              }
                        } else {
                              echo "<h1 align='center'>No Crops are online</h1>";
                        }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- vagetables section end -->
            <!-- Fruits Section start -->
            <div class="vegetables_section layout_padding">
               <div class="container">
                  <div class="row" style="padding-top: 1%; padding-bottom: 1%;">
                     <div class="col-sm-12">
                        <div style="font-size: xx-large; font-style: bold;">Fruits</div>
                        <div style="font-size: medium;">Have taste of our fresh juicy fresh fruits atleast once</div>
                     </div>
                     <div class="col-md-12 mt-4 mb-4">
                        <?php
                           // $sql = "SELECT * FROM online_crop_data";
                           $sql = "SELECT `crop_id`, `crop_name`, `crop_catagory`, `farm_id`, `crop_image`, `price`, `current_quantity` FROM `online_crop_data` WHERE crop_catagory = 'fruits';";
                           $result = mysqli_query($obj->conn, $sql);
            
                           // Create the HTML markup for the cards
                           if (mysqli_num_rows($result) > 0) {
                              // Output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                 echo "<form action='#' method='POST'>";
                                 echo "<input type='hidden' name='crop_id' value = '".$row["crop_id"]."'>";
                                 echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 350px;'>";
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
                                 echo "<p>Current available quantity: "."<span id='current_crop_quantity'>".$row["current_quantity"]."</span>"." KG</p>";
                                 echo "<p> Price: <b>".$row["price"]."</b></p>";
                                 echo "<input type='number' placeholder='How much you want' id='customer_needs' class='form-control mb-4'>";
                                 echo "<div  style='display: flex; justify-content: space-evenly;'>";
                                 echo "<button class='btn btn-success' name='buy_crop' style='width: 90%;'>Buy</button>";
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
            </div>
            <!-- Fruits section end -->
            <!-- Cereals section start-->
            <div class="vegetables_section layout_padding">
               <div class="container">
                  <div class="row" style="padding-top: 1%; padding-bottom: 1%;">
                     <div class="col-sm-12">
                        <div style="font-size: xx-large; font-style: bold;">Cereals</div>
                        <div style="font-size: medium;">We deliver these cereals at your door step</div>
                     </div>
                     <div class="col-md-12 mt-4 mb-4">
                        <?php
                           // $sql = "SELECT * FROM online_crop_data";
                           $sql = "SELECT `crop_id`, `crop_name`, `crop_catagory`, `farm_id`, `crop_image`, `price`, `current_quantity` FROM `online_crop_data` WHERE crop_catagory = 'crops';";
                           $result = mysqli_query($obj->conn, $sql);
            
                           // Create the HTML markup for the cards
                           if (mysqli_num_rows($result) > 0) {
                              // Output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                 echo "<form action='#' method='POST'>";
                                 echo "<input type='hidden' name='crop_id' value = '".$row["crop_id"]."'>";
                                 echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 350px;'>";
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
                                 // echo "<p>Current available quantity: "."<span id='current_crop_quantity'>".$row["current_quantity"]."</span>"." KG</p>";
                                 echo "<p>Current available quantity: <span id='current_crop_quantity_".$row["crop_id"]."'>".$row["current_quantity"]."</span> KG</p>";
                                 // echo "<p>Current available quantity: <input type='text' id='current_crop_quantity' value='".$row["current_quantity"]."' readonly> KG</p>";
                                 echo "<p> Price: <b>".$row["price"]."</b></p>";
                                 echo "<input type='number' placeholder='How much you want' id='customer_needs_".$row["crop_id"]."' name='ordered_quantity' class='form-control mb-4' onkeyup='checkForQuantity(".$row["crop_id"].")'>";
                                 echo "<div  style='display: flex; justify-content: space-evenly;'>";
                                 echo "<button class='btn btn-success' id='buy_btn' name='buy_crop' style='width: 90%;'>Buy</button>";
                                 echo "</div>";
                                 echo "</div>";
                                 echo "</div>";
                                 echo "</form>";
                              }
                           } else {
                              echo "<h1 align='center' style='margin-top: 5%;'>No Crops are online for catagory Cereals</h1>";
                           }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Cereals section end -->
            <!-- testimonial section start -->
            <div class="testimonial_section layout_padding" name="testimonial" style="margin-top: 60px;">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h1 class="testimonial_taital">Testimonial</h1>
                     </div>
                  </div>
                  <div class="testimonial_section_2">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="testimonial_box">
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                 </ol>
                                 <div class="carousel-inner">
                                    <div class="carousel-item active">
                                       <p class="testimonial_text">I stumbled upon Farmer Online while searching for a convenient way to support local farmers and access fresh, organic produce. The platform exceeded my expectations! Not only did I find a wide variety of fruits and vegetables, but I also loved reading about the farmers and their sustainable farming practices. Farmer Online has become my go-to source for delicious, farm-fresh goodies!</p>
                                    </div>
                                    <div class="carousel-item">
                                       <p class="testimonial_text">As a small-scale farmer, reaching customers directly has always been a challenge. Farmer Online changed the game for me. Their user-friendly platform allowed me to showcase my farm and connect with consumers who appreciate the hard work that goes into every product. Thanks to Farmer Online, I've been able to expand my customer base and grow my business in ways I never thought possible.</p>
                                    </div>
                                    <div class="carousel-item">
                                       <p class="testimonial_text">With a hectic schedule and a desire to feed my family wholesome, locally sourced food, Farmer Online has been a lifesaver. I love being able to browse through a wide selection of farm-fresh products from the comfort of my home and have them delivered right to my doorstep. Not only does it save me time, but it also gives me peace of mind knowing exactly where my food comes from.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="client_main">
                              <div class="client_left">
                                 <div class="client_img"><img src="https://ssvminstitutions.ac.in/wp-content/uploads/2021/10/SSVM-Parent-Testimonial.jpeg" style="border: 1px solid transparent; border-radius: 1000px; height: 100px; width: 100px; margin-top: 10%;"></div>
                              </div>
                              <div class="client_right">
                                 <h4 class="client_name">Yogesh Vadhava</h4>
                                 <p class="customer_text">Customer</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- testimonial section end -->
            <!-- layout_border end -->
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