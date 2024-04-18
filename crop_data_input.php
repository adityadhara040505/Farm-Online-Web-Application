<?php

session_start();

require "_dbConnection.php";

$obj = new Farmer();

$farmId = null;

if(isset($_GET["farm_id"])){
   $farmId = $_GET["farm_id"];
   $farmerId = $_SESSION["farmerMbNumber"];
   if(!$obj->check_farm_existance($farmId,$farmerId)){
      echo "<script>alert('Please enter correct farm ID');</script>";
      // header("Location: farmer_account.php");
      echo "<script>window.location.href='farmer_account.php';</script>";
      exit;
   }
 }else{
   header("Location: ./errors/error_in_adding_data.html");
   exit;
 }


if(isset($_POST["addCropDetails"])){

   $crop_name = $_POST["cropName"];
   $crop_catagory = $_POST["cropCatagory"];
   $date_of_sowing = $_POST["date_of_sowing"];
   $date_of_reaping = $_POST["date_of_reaping"];

   $file_name = $_FILES["cropImage"]["name"];
   $tempname = $_FILES["cropImage"]["tmp_name"];
   $target_dir = "images/".$file_name;


   //Getting maximum value in primary key crop_id

   $crop_id = 0;

   $sql = "SELECT MAX(crop_id) AS max_value FROM processing_crop_data";
   $result = $obj->conn->query($sql);
   if ($result) {
   // Fetch the result as an associative array
      $row = $result->fetch_assoc();  
      // Store the max value in a PHP variable
      $crop_id = (int) $row['max_value'] + 1;  
      // Free result set
      $result->free();
   }
   //   got the crop ID for new crop


   if($statement = $obj->conn->prepare("INSERT INTO `processing_crop_data` (`crop_id`, `crop_name`, `crop_catagory`, `date_of_sowing`, `date_of_reaping`, `farm_id`, `crop_image`) VALUES (?, ?, ?, ?, ?, ?, ?)")){

      $statement->bind_param("issssis",$crop_id ,$crop_name, $crop_catagory, $date_of_sowing, $date_of_reaping, $farmId, $file_name);

      $statement->execute();
      
      if(move_uploaded_file($tempname, $target_dir)){
         echo "<script>alert('Crop added successfully');</script>";
         header("Location: farmer_account.php");
         exit;
      }else{
         echo "<script>alert('Crop was not able tobe added in database');</script>";
         header("Location: error_in_adding_data.html");
         exit;
      }
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
      <title>Shop</title>
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
         function selectCategory(select) {
            var selectedValue = select.value;
            var categorySelect = document.getElementById("categorySelect");
            
            switch(selectedValue) {
                  case 'onion':
                  case 'tomatoes':
                  case 'greenPeas':
                  case 'brinjal':
                  case 'capsicum':
                  case 'coliflower':
                     categorySelect.value = 'Vegetables';
                     break;
                  case 'grapes':
                  case 'bananas':
                  case 'mangoes':
                  case 'custardApple':
                  case 'oranges':
                     categorySelect.value = 'Fruits';
                     break;
                  case 'sugarcane':
                  case 'cotton':
                  case 'rice':
                  case 'wheat':
                  case 'jowar':
                     categorySelect.value = 'Crops';
                     break;
                  default:
                     categorySelect.selectedIndex = 0; // Reset to default
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

            .form-control {
               font-size: large;
               border-radius: 10px;
               background: transparent;
               border: 2px solid white;
               color: white;
               height: 7vh;
               width: 200px; /* Adjust width as needed */
               position: relative;
            }
            .form-control option {
               background: transparent;
               color: black; /* Change color as needed */
            }
            /* Styling for options dropdown */
            .form-control-dropdown {
               display: none;
               position: absolute;
               top: 100%;
               left: 0;
               width: 100%;
               background: transparent;
               border: 2px solid white;
               border-radius: 5px;
               color: white;
               padding: 5px;
               z-index: 1000;
            }
            .form-control-dropdown.active {
               display: block;
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
         
            <form action="#" method="POST" name="farm_data_input_form" style="border: 5px solid white; width: 80%; margin: 30px; border-radius: 20px; padding:30px;" enctype="multipart/form-data">

                <center><h1  style="color: white; font-weight:bold; font-size:xx-large;">Enter farm details here...</h1></center>

                <div class="row" style="color: white; margin-top: 60px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Farmer name: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;" value="<?php echo $_SESSION["farmerName"];?>">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 60px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Farm ID: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;" value="<?php echo $farmId;?>">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Crop name: </span>
                    </div>
                    <div class="col-md-8">
                    <select name="cropName" id="cropName" class="form-control w-100" style="font-size:large; border-radius: 10px; background: transparent;border: 2px solid white; border-radius: 5px; color: white; height: 7vh" required  onchange="selectCrop(this)">
                        <option disabled selected>Select Crop</option>
                        <optgroup label="Vegetables" style="color: black;">
                           <option value="onion">Onion</option>
                           <option value="tomatoes">Tomatoes</option>
                           <option value="greenPeas">Green peas</option>
                           <option value="brinjal">Brinjal</option>
                           <option value="capsicum">Capsicum</option>
                           <option value="coliflower">Coliflower</option>
                        </optgroup>
                        <optgroup label="Fruits" style="color: black;">
                           <option value="grapes">Grapes</option>
                           <option value="bananas">Bananas</option>
                           <option value="mangoes">Mangoes</option>
                           <option value="custardApple">Custard Apple</option>
                           <option value="oranges">Oranges</option>
                        </optgroup>
                        <optgroup label="Crops" style="color: black;">
                           <option value="sugarcane">Sugarcane</option>
                           <option value="cotton">Cotton</option>
                           <option value="rice">Rice</option>
                           <option value="wheat">Wheat</option>
                           <option value="jowar">Jowar</option>
                        </optgroup>
                     </select>
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Crop catagory: </span>
                    </div>
                    <div class="col-md-8">
                        <select name="cropCatagory" id="categorySelect" class="form-control w-100" style="font-size:large; border-radius: 10px; background: transparent;border: 2px solid white; border-radius: 5px; color: white; height: 7vh" required>
                           <option value="no selection">Select crop catagory</option>
                           <option value="vegetables">Vegetables</option>
                           <option value="fruits">Fruits</option>
                           <option value="crops">Crops</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Date of sowing: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="date" name="date_of_sowing" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Date of reaping: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="date" name="date_of_reaping" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 20px;">
                    <div class="col-md-4" style="text-align: right;">
                        <span style="font-size: x-large;">Crop image: </span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="cropImage" accept="image/*" style="background-color: transparent; border: 2px solid white; border-radius: 5px; width: 100%; font-size:x-large; color: white; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;">
                    </div>
                </div>
                <div class="row" style="color: white; margin-top: 60px;">
                    <div class="col-md-12" style="display: flex; justify-content:space-evenly;">
                        <button onclick="window.form.submit()" name="addCropDetails" class="neonBtnGreen" style="border-radius: 30px; width: 30%;">SUBMIT</button>
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