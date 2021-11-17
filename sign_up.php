<?php include('conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Store Name | User Sign In</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
  </head>
  <body>
    <body data-stellar-background-ratio="0.5">
    <div id="login">
      <br><br>
           <div class="text-center"><a href="index.php">
             <img src="uploads\brand.png" alt="brand logo-----Home Link" height="100px">
           </a></div>
           <div class="container">
                   <div class="box">
                           <form id="login-form" class="form" action="" method="POST">
                               <h3 class="text-center text-info"><strong>User Sign Up</strong></h3>
                               <div class="form-group">
                                   <label for="name" class="text-info">Name:</label><br>
                                   <input type="text" name="name" required class="form-control" placeholder="Type in your full name">
                               </div>
                               <div class="form-group">
                                   <label for="email" class="text-info">Email:</label><br>
                                   <input type="text" name="email" required class="form-control" placeholder="Type your email">
                               </div>
                               <div class="form-group">
                                   <label for="dob" class="text-info">Date of Birth:</label><br>
                                   <input type="date" name="dob" required class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="password" class="text-info">Password:</label><br>
                                   <input type="password" name="password" required class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="cpassword" class="text-info">Confirm Password:</label><br>
                                   <input type="password" name="cpassword" required class="form-control">
                               </div>
                               <div class="form-group">
                                   <input type="submit" name="btn_login" class="btn btn-info btn-md" value="Login">
                               </div>
                               </form>
                               <?php
                                  if(isset($_POST['btn_login'])) {
                                     $email = mysqli_real_escape_string($connection,$_POST['email']);
                                     $pw = mysqli_real_escape_string($connection,$_POST['password']);
                                     $name = mysqli_real_escape_string($connection,$_POST['name']);
                                     $cpw = mysqli_real_escape_string($connection,$_POST['cpassword']);
                                     $dob = mysqli_real_escape_string($connection,$_POST['dob']);

                                    $password=md5($pw);
                                     $query = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
                                     $result = mysqli_query($connection,$query);
                                     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                     $count = mysqli_num_rows($result);
                                     // If result matched $email and $password, table row must be 1 row
                                     if($count > 1)
                                     {
                                      echo'<div class="alert danger">
                                        <span class="closebtn">&times;</span>
                                        <strong>Email already exists for an account!</strong>
                                      </div> ';
                                     }
                                     else {
                                       if($pw!=$cpw)
                                       {
                                         echo'<div class="alert danger">
                                           <span class="closebtn">&times;</span>
                                           <strong>Password & Confirmed Password do not match!</strong>
                                         </div> ';
                                       }
                                       else {

                                         $insert="INSERT INTO user(name, email, password, dob) VALUES ('$name','$email','$password','$dob')";
                                         if(mysqli_query($connection, $insert))
                                         {
                                           $_SESSION['email']=$email;
                                           $_SESSION['name']=$name;
                                           $_SESSION['id']="true";
                                           header('location: index.php');
                                         }
                                       }
                                     }
                                  }
                               ?>
                   </div>
           </div>
       </div>
    <script>
         var close = document.getElementsByClassName("closebtn");
         var i;
         for (i = 0; i < close.length; i++) {
           close[i].onclick = function(){
             var div = this.parentElement;
             div.style.opacity = "0";
             setTimeout(function(){ div.style.display = "none"; }, 600);
           }
         }
     </script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/sidebar.js"></script>
  </body>
</html>
