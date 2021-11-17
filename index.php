<?php session_start();
  include('conn.php');
  if(isset($_SESSION['email']))
  {
    $customer_email=$_SESSION['email'];
  }

  if(isset($_POST['del_item']))
  {
    $item=$_POST['item'];
    $cust=$_POST['customer'];
    $del="DELETE FROM shopping_cart WHERE pid=$item AND cemail='$cust'";
    if(mysqli_query($connection,$del))
    {
      $msg='<div class="alert danger">
        <span class="closebtn">&times;</span>
        <strong>Item removed from shopping_cart</strong>
      </div> ';
    }
  }

  if(isset($_POST['add_to_cart']))
{
  $pid=$_POST['pid'];
  $cname=$_SESSION['name'];
  $cemail=$_SESSION['email'];
  $p_info="SELECT * FROM products WHERE id='$pid'";
  $info=mysqli_query($connection, $p_info);
  $inf=mysqli_fetch_array($info);
  $pname=$inf['name'];
  $pdes=$inf['description'];
  $pcat=$inf['category'];
  $pscat=$inf['subcategory'];
  (float)$price=$inf['price'];
  (int)$qty=$_POST['quantity'];
  if($qty<1)
  {
    $msg='<div class="alert danger">
      <span class="closebtn">&times;</span>
      <strong>Quantity cannot be zero or negative</strong>
    </div> ';
  }
  else
  {
    $valid="SELECT * FROM shopping_cart WHERE pid='$pid' AND cemail='$customer_email'";
    $val=mysqli_query($connection, $valid);
    if(mysqli_num_rows($val)>0)
    {
      $old=mysqli_fetch_array($val);
      (int)$old_qty=$old['quantity'];
      (int)$new_qty= $old_qty+$qty;
      (float)$new_total_price=$new_qty*$price;
      $update="UPDATE shopping_cart SET quantity='$new_qty', price='$new_total_price' WHERE pid='$pid' AND cemail='$customer_email'";
      if(mysqli_query($connection,$update))
      {
        $msg='<div class="alert success">
          <span class="closebtn">&times;</span>
          <strong>Cart Updated!</strong>
        </div> ';
      }
    }
    else
    {
      (float)$total_price=$price*$qty;
      $add="INSERT INTO shopping_cart(cname, cemail, pid, pname, quantity, price) VALUES('$cname','$cemail','$pid','$pname','$qty','$total_price')";
      if(mysqli_query($connection,$add))
      {
        $msg='<div class="alert success">
          <span class="closebtn">&times;</span>
          <strong>Product added to cart successfully</strong>
        </div> ';
      }
    }
  }
}
?>
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
  else
  {
    include('navbar.php');
  }
  if(isset($msg))
  {
    echo $msg;
  }
  else {

  }
  ?>

<br>
  <div class="wrapper">

    <?php include('sidebar.php');
    ?>
    <div class="container">
      <div class="row">
        <?php
        if(isset($_GET['cat']))
        {
          $cat=$_GET['cat'];
          $query="SELECT * FROM products WHERE category='$cat'";
        }
        else if(isset($_GET['s_cat']))
        {
          $scat=$_GET['s_cat'];
          $query="SELECT * FROM products WHERE subcategory='$scat'";
        }
        else {
          $query="SELECT * FROM products";
        }
        $result=mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0)
        {
          while($ans=mysqli_fetch_array($result))
          {
            ?>
              <div class="col-md-3 col-sm-12" style="margin-top:10px;">
                <div class="pcard"><a href="view_product.php?pid=<?php echo $ans['id'];?>">
                  <img src="uploads\<?php echo $ans['image'];?>"  style="width:235px; height:200px; overflow:hidden;">
                  <div class="pcontainer">
                    <h5 style="overflow:hidden; white-space: nowrap;"><b><?php echo $ans['name']; ?></b></h5></a>
                    <p>BDT <?php echo number_format($ans['price'],2); ?></p>
                    <?php
                    if(isset($_SESSION['id']) && isset($_SESSION['name'])){
                      ?>
                      <form class="form-group" action="" method="post">
                        <input class="form-control" type="number" name="quantity" value="0"><br>
                        <input type="hidden" name="pid" value="<?php echo $ans['id']; ?>">
                        <button type="submit" class="btn btn-warning" name="add_to_cart"> <i class="fa fa-shopping-cart"></i> Add to cart</button>
                      </form>
                      <?php
                    }
                    else
                    {
                      ?><a href="sign_in.php">
                        <button class="btn btn-warning">
                          <i class="fa fa-shopping-cart"></i>
                          Add to cart
                        </button>
                        </a>
                      <?php
                    }
                     ?>
                  </div>
                </div>
              </div>

            <?php
          }
        }
        else {
          echo "<h4>No product available for this catagory!</h4>";
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
