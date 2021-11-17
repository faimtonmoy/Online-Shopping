<?php session_start();
  include('conn.php');
  if(!isset($_SESSION['email']))
  {
    header('Location: sign_in.php');
  }
  $items="";
  $msg="";
  if(isset($_POST['confirm']))
  {
    $email=$_SESSION['email'];
    $name=$_SESSION['name'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $total=0;
    $order_info="SELECT * FROM shopping_cart WHERE cemail='$email'";
    $order_info_res=mysqli_query($connection, $order_info);
    if(mysqli_num_rows($order_info_res)>0)
    {
      while($row=mysqli_fetch_array($order_info_res))
      {
        $items.=$row['pname'].'('.$row['quantity'].'), ';
        $total=$total+(float)$row['price'];
      }
    }
    $del_from_sc="DELETE FROM shopping_cart where cemail='$email'";
    $insert="INSERT INTO orders(cname, cemail, address, contact, items, amount) VALUES('$name','$email','$address','$contact','$items','$total')";
    $user_update="UPDATE user SET address='$address', contact='$contact' WHERE email='$email'";
    if(mysqli_query($connection, $insert) && mysqli_query($connection, $del_from_sc) && mysqli_query($connection, $user_update))
    {
      $msg='<div class="alert success">
        <span class="closebtn">&times;</span>
        <strong>Order has been placed successfully!</strong>
      </div>';
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
  if(isset($_GET['del']))
  {
    $order_id=$_GET['del'];
    $cust_email=$_SESSION['email'];
    $del="DELETE FROM orders WHERE id='$order_id' and cemail='$cust_email'";
    if(mysqli_query($connection, $del))
    {
      echo'<div class="alert success">
        <span class="closebtn">&times;</span>
        <strong>Order has been cancelled successfully!</strong>
      </div>';
    }
  }
  ?>


<br>
  <div class="wrapper">

    <?php include('sidebar.php');
    ?>

    <div class="container">
      <div class="col-md-7">
        <div class="card">
          <div class="cardcontainer">
                <h4 style="color:#000">My Orders</h4><hr>
                <?php
                if(isset($_SESSION['email']))
                {
                  $cust_email=$_SESSION['email'];
                  $order_info="SELECT * FROM orders WHERE cemail='$cust_email'";
                  $order_info_res=mysqli_query($connection, $order_info);
                  if(mysqli_num_rows($order_info_res)>0)
                  {
                      echo'<table class="table" border="2">
                        <th>Order ID</th>
                        <th>Items</th>
                        <th>Expense</th>
                        <th>Option</th>';

                      while($row=mysqli_fetch_array($order_info_res))
                      {
                        echo'<tr>';
                        echo'<td>'.$row['id'].'</td>';
                        echo'<td>'.$row['items'].'</td>';
                        echo'<td>'.number_format($row['amount'],2).'</td>';
                        echo '<td>';?>
                        <a href="my_orders.php?del=<?php echo $row['id']; ?>">
                        <button class="btn btn-danger" onclick="return confirm('Cancel Order?')">
                        Cancel Order
                        </button>
                      </a>
                      <?php
                        echo '</td>';
                      }
                    }
                    else {
                      echo '<h5 style="color:#084364">You do not have any orders for now!</h5>';
                    }
                  }
                   ?>
                </table>
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
