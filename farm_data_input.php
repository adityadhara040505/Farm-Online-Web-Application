<?php
session_start();

require "_dbConnection.php";

$obj = new Farmer();


if(isset($_POST["addFarmDetails"])){
   $farmarMbNumber = $_SESSION["farmerMbNumber"];
   $farmArea = $_POST["farmArea"];
   $farmpH = $_POST["farmpH"];
   $farmAddress = $_POST["farmAddress"];
   if($obj->add_farm_details($farmArea, $farmpH, $farmAddress)){
      $_SESSION["farmArea"] = $farmArea;
      $_SESSION["farmpH"] = $farmpH;
      $_SESSION["farmAddress"] = $farmAddress;

      // Sending message to user

      $number = "91".$_SESSION["farmerMbNumber"];
      $farm_id = $_SESSION["farm_id"];
      $message = "Your allocated farm ID is : $farm_id";

      // Account details
      $apiKey = urlencode('NzQ3NzQzNzM1NTQ4NzU3MzUxNjI1OTc1NDg0YjQ0MzY=');
      
      // Message details
      $numbers = array($number);
      $sender = urlencode('Owner of Farm Online');
      $message = rawurlencode($message);
   
      $numbers = implode(',', $numbers);
   
      // Prepare data for POST request
      $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
   
      // Send the POST request with cURL
      $ch = curl_init('https://api.textlocal.in/send/');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);
      
      // Process your response here
      echo $response;

      //Sent the SMS

      header("Location: farmer_account.php");
      exit;
   }else{
      header("Location: ./errors/error_in_adding_data.html");
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
         <div class="layout_border" style="background: linear-gradient(to bottom, rgb(0, 0, 0),  rgb(85, 255, 43)); display: flex; justify-content: center; align-items: center;">
         
            <form action="#" method="POST" name="farm_data_input_form" style="border: 5px solid white; width: 80%; margin: 30px; border-radius: 20px; padding:30px;">

                <center><h1  style="color: white; font-weight:bold; font-size:xx-large;">Enter farm details here...</h1></center>

                <div class="row" style="color: white; margin-top: 60px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Farmer name: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;" value="<?php echo $_SESSION["farmerName"];?>">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Total farm area in acres: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="farmArea" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Farm land pH: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="farmpH" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Farm address: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="farmAddress" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 60px;">
                    <div class="col-md-12" style="display: flex; justify-content:space-evenly;">
                        <button onclick="window.form.submit()" name="addFarmDetails" class="neonBtnGreen" style="border-radius: 30px; width: 30%;">SUBMIT</button>
                        <button onclick="window.form.reset()" class="neonBtnRed"  style="border-radius: 30px; width: 30%; margin-left: 100px;">RESET</button>
                    </div>
                </div>
                


            </form>

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