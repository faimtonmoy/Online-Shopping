<?php session_start();
include('conn.php');
if(!isset($_SESSION['email']))
{
  header('Location: sign_in.php');
} ?>
<!DOCTYPE html>

<html lang="en">

<head>
     <title>Store Name</title>
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
     <link rel="stylesheet" href="css/sidebar.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/card.css">
     <link rel="stylesheet" href="css/templatemo-style.css">
</head>

<body>
  <?php
  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    include('user_navbar.php');
  }
  else {
    include('navbar.php');
  }

  include('conn.php');
  ?>
  <div class="wrapper">
    <?php include('sidebar.php'); ?>
    <br>
    <div class="container">
      <div class="row">
        <?php
        if(isset($_GET['pid'])){
          $pid = $_GET['pid']; //some_value
        }
        $query="SELECT * FROM products WHERE id='$pid'";
        $result=mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0)
        {
          $ans=mysqli_fetch_array($result)
            ?>
            <div class="col-md-7 col-sm-12">
              <div class="pvcard">
                <img src="uploads\<?php echo $ans['image'];?>" alt="Avatar" style="width:100%">
                <div class="pcontainer">
                  <h3 style="color:#FFF"><b><?php echo $ans['name']; ?></b></h3>
                  <p>BDT <?php echo number_format($ans['price'],2); ?></p>
                  <p style="font-size:15px"><?php echo $ans['description']; ?></p>
                  <form class="form-group" action="index.php" method="post">
                    <input class="form-control" type="number" name="quantity" value="0"><br>
                    <input type="hidden" name="pid" value="<?php echo $ans['id']; ?>">
                    <button type="submit" class="btn btn-warning" name="add_to_cart"> <i class="fa fa-shopping-cart"></i> Add to cart</button>
                  </form>
                </div>
              </div>
            </div>
            <?php
        }
         ?>

      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
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
