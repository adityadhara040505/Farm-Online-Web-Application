<?php

session_start();

date_default_timezone_set("Asia/Calcutta");

require '_dbConnection.php';

$obj = new Farmer();





if(isset($_POST["signupBtn"])){
    $name = $_POST["customerName"];
    $mobileNo = $_POST["customerMbNumber"];
    $pass = $_POST["customerPass"];
    if($obj->add_customer_details($name, $mobileNo, $pass)){

        $_SESSION["customerName"] = $name;
        $_SESSION["customerMbNumber"] = $mobileNo;
        $_SESSION["customerPass"] = $pass;

        header("Location: customer_account.php");
        exit;
    }else{
        header("Location: loginError.html");
        exit;
    }
}

if(isset($_POST["loginBtn"])){
    $mobileNo = $_POST["loginMobileNo"];
    $pass = $_POST["loginPass"];

    if($obj->check_customer_existance($mobileNo,$pass)){
        
        $_SESSION["customerName"] = $obj->get_customer_name($mobileNo);
        $_SESSION["customerMbNumber"] = $mobileNo;
        $_SESSION["customerPass"] = $pass;

        header("Location: customer_account.php");
        exit;
    }else{
        header("Location: loginError.html");
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
      <!-- Farmer Login.css -->
      <link rel="stylesheet" href="./css/farmerLogin.css" type="text/css">
      <!-- Farmer Login.js -->
      <link rel="stylesheet" href="./js/farmerLogin.js">
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

// var vegetables = ["Carrots","Onions","Beetroot","Toamato","Suger Cane","Peas"];
// var cereals = ["Jawar","Wheat","Rice","Barley","Maize","Finger Milet"];

    function signup()
{
    document.querySelector(".login-form-container").style.cssText = "display: none;";
    document.querySelector(".signup-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
    document.querySelector(".button-1").style.cssText = "display: none";
    document.querySelector(".button-2").style.cssText = "display: block";
    document.querySelector(".container").style.height = "550px";
    document.querySelector(".container").style=  "margin-top: 70px";
};

function login()
{
    document.querySelector(".signup-form-container").style.cssText = "display: none;";
    document.querySelector(".login-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
    document.querySelector(".button-2").style.cssText = "display: none";
    document.querySelector(".button-1").style.cssText = "display: block";
    document.querySelector(".container").style = "margin-top: 70px";

}

function checkPassword(){
    var pass = document.getElementById('pass').value;
    var confirmPass = document.getElementById('confirmPass').value;
    var para = document.getElementById('errorText');

    (pass===confirmPass)?para.style = "display: none" : para.style = "display: block";
}

    </script>

   </head>
   <body>
      <!-- layout_border start -->
      <div class="container-fluid" style="display: flex; justify-content: center;">
            <div class="container" style="border-radius: 20px; margin-top: 70px;">
                <!--Data or Content-->
                <div class="box-1">
                    <div class="content-holder">
                        <h2>Hello Customer, Welcome Please enter details</h2>
                        <p>Click below to change the mode</p>
                       
                        <button class="button-1" type="button" onclick="signup()">Sign up</button>
                        <button class="button-2" type="button" onclick="login()">Login</button>
                    </div>
                </div>
          
                
                <!--Forms-->
                <div class="box-2" style="border-radius: 10px;">
                
                    <div class="login-form-container">
                    <form method="post" action="">
                        <h1>Fill data if you already have an account...</h1>
                        <input type="number" placeholder="Mobile number" class="input-field" name="loginMobileNo">
                        <br><br>
                        <input type="password" placeholder="Password" class="input-field" name="loginPass">
                        <br><br>
                        <button class="login-button" type="submit" name="loginBtn">Login</button>
                        </form>
                    </div>
                
          
               <!--Create Container for Signup form-->
               
                <div class="signup-form-container">
                <form action="#" method="post">
                    <h1>Sign Up Form</h1>
                    <input type="text" placeholder="Name" class="input-field" name="customerName">
                    <br><br>
                    <input type="number" placeholder="Mobile Number" class="input-field" name="customerMbNumber">
                    <br><br>
                    <input type="password" placeholder="Password" class="input-field" name="customerPass" id="pass">
                    <br><br>
                    <input type="password" placeholder="Confirm Password" class="input-field" id="confirmPass" onkeyup="checkPassword()">
                    <br>
                    <p style="display: none;" id="errorText">Enter correct password</p>
                    <br>
                    <button class="signup-button" type="submit" name="signupBtn" onclick="addAccount()">Sign Up</button>
                    </form>
                </div>
               
             <!-- layout_border end -->
         </div>
            </div>
      </div>
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
   </body>
</html>