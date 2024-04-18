<?php
   session_start();  

   require "_dbConnection.php";

   $obj = new Farmer();

  if(isset($_POST["sendBtn"])){
   $customerName = $_POST["Name"];
   $customerPhoneNo = $_POST["PhoneNo"];
   $customerMail = $_POST["Email"];
   $customerMsg = $_POST["Massage"];

   // Email address to send the message
   $to = "farm.online.official@gmail.com";

   // Subject of the email
   $subject = "New Inquiry from $customerName";

   // Compose the email message
   $message = "Name: $customerName\n";
   $message .= "Phone Number: $customerPhoneNo\n";
   $message .= "Email: $customerMail\n";
   $message .= "Message: $customerMsg\n";

   // Additional headers
   $headers = "From: $customerMail\r\n";
   $headers .= "Reply-To: $customerMail\r\n";
   $headers .= "X-Mailer: PHP/" . phpversion();

   // Send the email
   $mailSent = mail($to, $subject, $message, $headers);

   if($mailSent){
      echo "<script>alert('Mail sent successfully');</script>";
   }else{
      echo "<script>alert('Failed to send the mail');</script>";
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
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
      <title>Contact</title>
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
         .neonBtn {
            /* padding: 20px 20px; */
            /* display: inline-block; */
            color: white;
            text-decoration: none;
            /* font-size: 3em; */
            overflow: hidden;
            background-color: #00a651;
        }
 
        /*creating animation effect*/
        .neonBtn:hover {
            color: #111;
            background: #39ff14;
            box-shadow: 0 0 50px #39ff14;
        }

        .sendBtn{
         width: 35%;
         text-align: center;
         font-size: 16px;
         color: #fafafa;
         background-color: #00a651;
         padding: 10px;
         text-transform: uppercase;
         display: block;
         font-weight: 600;
         border-radius: 40px;
         font-family: 'Poppins', sans-serif;
         border-color: transparent;
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
            <!-- contact section start -->
            <div class="contact_section layout_padding">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-12">
                        <h1 class="contact_taital">Get In Touch</h1>
                     </div>
                  </div>
               </div>
               <div class="container">
                  <div class="contact_section_2">
                     <div class="row">
                        <div class="col-md-6">
                           <form action="#" method="POST">
                              <div class="mail_section_1">
                                 <input type="text" class="mail_text" placeholder="Name" name="Name">
                                 <input type="text" class="mail_text" placeholder="Phone Number" name="PhoneNo"> 
                                 <input type="text" class="mail_text" placeholder="Email" name="Email">
                                 <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                                 <div><input type="submit" class="sendBtn" name="sendBtn" value="Send"></div>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-6">
                           <div class="map_main">
                              <div class="map-responsive">
                                 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7578.873379596429!2d75.67710177485347!3d18.23579220463367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1709305208008!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- contact section end -->
            <!-- layout_border end -->
         </div>
      </div>

      <div class="row">
         <div class="col-md-6">
            <!-- Farmer Account Login / Sign up page navigation start -->
            <div class="container-fluid">
               <div class="layout_border">
                  <div class="row">
                     <div class="col-md-3">
                        <center>
                           <h2 style="margin-top: 10%; font-weight: bold;">Join us as Farmer: </h2>
                        </center>
                     </div>
                     <div class="col-md-9">
                        <center>
                           <button onclick="window.location.href = 'farmerLogin.php'" class="neonBtn" style="width: 80%; margin: 20px; height: 60px;font-family: 'Poppins', sans-serif; font-size: 20px;padding: 5px; border-radius: 50px;">Hello Farmer Let's connect</button>
                        </center>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Farmer account login / sign up page navigation end -->
         </div>
         <div class="col-md-6">
            <!-- Customer account login / sign up page navigation end -->
            <div class="container-fluid">
               <div class="layout_border">
                  <div class="row">
                     <div class="col-md-3">
                        <center>
                           <h2 style="margin-top: 10%; font-weight: bold;">Join us as Customer: </h2>
                        </center>
                     </div>
                     <div class="col-md-9">
                        <center>
                           <button onclick="window.location.href = 'customerLogin.php'" class="neonBtnRed" style="width: 80%; margin: 20px; height: 60px;font-family: 'Poppins', sans-serif; font-size: 20px;padding: 5px; border-radius: 50px;">Hello Customer Let's connect</button>
                        </center>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Customer account login / sign up page navigation end -->
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