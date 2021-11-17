<?php session_start();
  include('conn.php');
  if(!isset($_SESSION['email']))
  {
    header('Location: sign_in.php');
  }
  $cust_email=$_SESSION['email'];

  if(isset($_POST['del_item']))
  {
    $item=$_POST['item'];
    $cust_email=$_POST['customer'];
    $del="DELETE FROM shopping_cart WHERE pid=$item AND cemail='$cust_email'";
    if(mysqli_query($connection,$del))
    {
      $msg='<div class="alert danger">
        <span class="closebtn">&times;</span>
        <strong>Item removed from shopping_cart</strong>
      </div> ';
    }
  }
?>
<!DOCTYPE html>

<html lang="en">

<head>
     <title>Confrim Order</title>
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
      <div class="col-md-8">
        <div class="card">
          <div class="cardcontainer">
                <h4 style="color:#000">Order Confirmation</h4><hr>
                <table class="table" border="2">
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Expense</th>
                  <th>Remove</th>
                  <?php
                  if(isset($_GET['email']))
                  {
                    $email=$_GET['email'];
                    $order_info="SELECT * FROM shopping_cart WHERE cemail='$email'";
                    $order_info_res=mysqli_query($connection, $order_info);
                    if(mysqli_num_rows($order_info_res)>0)
                    {
                      while($row=mysqli_fetch_array($order_info_res))
                      {
                        echo'<tr>';
                        echo'<td>'.$row['pname'].'</td>';
                        echo'<td>'.$row['quantity'].'</td>';
                        echo'<td>'.number_format($row['price'],2).'</td>';
                        echo'<td>
                        <form action="" method="post">
                          <input type="hidden" name="item" value="'.$row['pid'].'">
                          <input type="hidden" name="customer" value="'.$row['cemail'].'">
                          <button type="submit" class="btn btn-danger" name="del_item"> <i class="fa fa-trash"></i> </button>
                        </form></td>';
                        $total=$total+(float)$row['price'];
                      }
                      echo'</tr>';
                      echo '<tr>
                      <td></td>
                      <td></td>
                      <td> <b>Grand Total</b>: BDT '.number_format($total,2).'</td>
                      </tr>';
                    }
                    else {
                      echo "<script>window.location='index.php'</script>";
                    }
                  }
                   ?>
                </table>
                <?php
                $usr_sql="SELECT * FROM user WHERE email='$cust_email'";
                $run=mysqli_query($connection, $usr_sql);
                $data=mysqli_fetch_array($run);
                 ?>
                <form class="form-group" action="my_orders.php" method="post">
                  <label for="address">Enter your address</label>
                  <input class="form-control" type="text" name="address" value="<?php echo $data['address']; ?>" required><br>
                  <label for="contact">Contact number</label>
                  <input class="form-control" type="text" name="contact" value="<?php echo $data['contact']; ?>" required><br>
                  <button type="submit" class="btn btn-success" name="confirm">Place Order</button>
                </form>
          </div>
        </div>
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
