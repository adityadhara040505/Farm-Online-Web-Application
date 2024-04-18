
<?php 
   $serverName = "localhost";
   $userName = "root";
   $password = "";
   $dbName = "farm_online";

   $conn = mysqli_connect($serverName,$userName,$password,$dbName);

   if (!$conn) {
      echo "Failed";
   }


   if(isset($_POST["submit_blog"])){

      $blog_title = $_POST['blog_title'];
      $blog_body = $_POST['blog_body'];
      $query = "INSERT INTO `blogs` (`blog_title`, `blog_body`) VALUES ('$blog_title', '$blog_body');";
      $result = mysqli_query($conn,$query);

   }

?>

<?php
   
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
      <title>Blog</title>
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
         <div class="layout_border">
            <h2 align="center" style="margin: 30px;">You can post your blog and reviews for our site below</h2>
            <br><br>
            <div class="blog-input-container">
               <form action="#" method="POST" name="blog_input_form">

                  <div class="card" style=" box-shadow: #000000; margin-left: 100px;margin-right: 100px; margin-bottom: 30px;">
                     <div class="card-header">
                        <div class="input-group">
                           <span>Enter your blog title: </span>
                           <input type="text" class="form-control bg-light" width="75%" name="blog_title" style="border-radius: 8px; margin-left: 20px; background-color: #dbdbdb; border: 1px solid black;" id="">
                        </div>
                     </div>
                     <div class="card-body">
                           <p>Enter your blog content: </p>
                           <textarea class="form-control" name="blog_body" id="" cols="30" rows="10" style="width: 100%; border: 1px solid black;"></textarea>
                     </div>
                     <div class="card-footer align-items-center">
                        <center>
                           <input  class="neonBtnGreen" style="border-radius: 30px; width: 15%; border: 2px solid transparent;" type="submit" name="submit_blog" value="Submit">
                           <button type="reset" class="neonBtnRed" style="border-radius: 30px;margin-left: 10%; width: 15%; border: 2px solid transparent;">Reset</button>
                        </center>
                     </div>
                  </div>



               </form>
            </div>
         </div>
         <div class="layout_border">
            <!-- blog section start -->
            <div class="blog_section layout_padding margin_bottom90">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-12">
                        <h1 class="blog_taital">Our Blogs</h1>
                        <p class="blog_text">We have greate community some of the reviews can be seen below.</p>
                     </div>
                  </div>
                  <div class="blog_section_2 layout_padding">
                     <div class="row" name="all_blogs_container" style="justify-content: space-between;">
                        <?php

                           $sql = "SELECT blog_title, blog_body FROM blogs";
                           $result = mysqli_query($conn, $sql);

                           // Create the HTML markup for the cards
                           if (mysqli_num_rows($result) > 0) {
                              // Output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                 echo "<div class='card' style='margin-top: 20px;margin-left: 20px;margin-right: 20px; width: 300px;'>";
                                 echo "<div class='card-header'>";
                                 echo "<h2>" . $row["blog_title"] . "</h2>";
                                 echo "</div>";
                                 echo "<div class='card-body'>";
                                 echo "<p>" . $row["blog_body"] . "</p>";
                                 echo "</div>";
                                 echo "</div>";
                              }
                           } else {
                              echo "No blogs found.";
                           }
                        
                        ?>
                        
                     </div>
                  </div>
               </div>
            </div>
            <!-- blog section end -->
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