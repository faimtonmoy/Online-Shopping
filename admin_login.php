<?php include('conn.php')?>
<!DOCTYPE html>

<html lang="en">
<head>
     <title>Admin Login</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/fontawesome.min.css">
     <link rel="stylesheet" href="css/admin.css">
     <link rel="stylesheet" href="css/custom.css">
     <link rel="stylesheet" href="css/particle.css">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
     </head>
     <body data-stellar-background-ratio="0.5">
     <div id="login">
       <br><br>
            <div class="text-center"><a href="index.php">
              <img src="uploads\brand.png" alt="brand logo-----Home Link" height="70px">
            </a></div>
            <div class="container">
                    <div class="box">
                            <form id="login-form" class="form" action="" method="POST">
                                <h3 class="text-center text-info"><strong>Admin Log in</strong></h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="text" name="email" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="btn_login" class="btn btn-info btn-md" value="Login">
                                </div>
                                </form>
                                <?php
                                   if(isset($_POST['btn_login'])) {
                                      $email = mysqli_real_escape_string($connection,$_POST['email']);
                                      $pw = mysqli_real_escape_string($connection,$_POST['password']);
     																 $password=md5($pw);
                                      $query = "SELECT * FROM admin WHERE email = '$email' and password = '$password'";
                                      $result = mysqli_query($connection,$query);
                                      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                      $count = mysqli_num_rows($result);
                                      // If result matched $email and $password, table row must be 1 row
                                      if($count == 1)
                                      {
     																	 session_start();
                                       $_SESSION['id'] = $row["id"];
                                        $_SESSION['name'] = $row["name"];
                                        $_SESSION['admin_email']=$row["email"];
     																	 $_SESSION['msg']="null";
                                        header('Location: admin_homepage.php');
     																	 exit();
                                      }
                                      else {
                                        ?>
                                        <div class="alert danger">
                                          <span class="closebtn">&times;</span>
                                          <strong>Wrong credentials. Try Again!</strong>
                                        </div>
                                        <?php
                                      }
                                   }
                                   if(isset($_SESSION['login_msg']))
                                   {
                                     echo $_SESSION['login_msg'];
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

</body>

</html>
<?php $_SESSION['login_msg']=''; ?>
