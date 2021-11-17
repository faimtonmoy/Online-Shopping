<?php session_start();
include('conn.php');
$home=0;
if(!isset($_SESSION['admin_email']))
{
  header('location: admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Store|Product Management</title>
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
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
  </head>
  <body>
      <?php include('admin_navbar.php'); ?>
    <section id="notifications">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <h5>Notifications</h5><hr>
            <?php
            if(isset($_GET['del']))
            {
              $order_id=$_GET['del'];
              $del="DELETE FROM orders WHERE id='$order_id'";
              if(mysqli_query($connection, $del))
              {
                echo'<div class="alert success">
                  <span class="closebtn">&times;</span>
                  <strong>Order has been removed successfully!</strong>
                </div>';
              }
            }
            if(isset($_POST['update_product']))
            {
              $name=$_POST['name'];
              $price=$_POST['price'];
              $cat=$_POST['cat'];
              $scat=$_POST['s_cat'];
              $des=$_POST['des'];
              $id=$_POST['id'];
              $update="UPDATE products SET name='$name', price='$price', category='$cat', subcategory='$scat', description='$des' WHERE id='$id'";
              $done=mysqli_query($connection, $update);
              if($done)
              {
                echo '<div class="alert success">
                  <span class="closebtn">&times;</span>
                  <strong>Product: '.$name.' has been UPDATED successfully.</strong>
                </div>';
              }
              else
              {
                echo '<div class="alert danger">
                  <span class="closebtn">&times;</span>
                  <strong>Product UPDATE unsuccessful.</strong>
                </div>';
              }
            }

            if(isset($_POST['delete_product']))
            {
              $id= $_POST['del_pr'];
              $delete="DELETE FROM products where id='$id'";
              $confirm=mysqli_query($connection, $delete);
              if($confirm)
              {
                echo '<div class="alert success">
                  <span class="closebtn">&times;</span>
                  <strong>Selected Product has been removed successfully.</strong>
                </div>';
              }
              else
              {
                echo '<div class="alert success">
                  <span class="closebtn">&times;</span>
                  <strong>Product Removal unsuccess.</strong>
                </div>';
              }
            }
             ?>
          </div>
          <div class="col-md-7">
            <h4>Note:</h4> <hr>
            <h5>Use your browser's finder and type in an order id to find a specific order!</h5>
            <h5>Press <font color="#71CA6E"> CTRL+F</font> to initiate finder</h5>
          </div>
          </div>
        </div>
    </section>
      <div class="container">
        <div class="card">
          <div class="cardcontainer">
              <h2 style="color:#000">Manage Orders</h2>
            <table class="table" border="1">
              <th>Order ID</th>
              <th>Customer Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Items</th>
              <th>Price</th>
              <th>Cancel</th>
            <?php
            $sql="SELECT * FROM orders";
            $res=mysqli_query($connection, $sql);
            if(mysqli_num_rows($res)>0)
            {
              while($row=mysqli_fetch_array($res))
              {
                echo'<tr>';
                echo'<td>'.$row['id'].'</td>';
                echo'<td>'.$row['cname'].'</td>';
                echo'<td><a href="mailto:'.$row['cemail'].'" class="btn btn-info">'.$row['cemail'].'</a></td>';
                echo'<td>'.$row['address'].'</td>';
                echo'<td>'.$row['contact'].'</td>';
                echo'<td>'.$row['items'].'</td>';
                echo'<td>'.$row['amount'].'</td>';
                echo'<td>';?>
                <a href="order_management.php?del=<?php echo $row['id']; ?>">
                <button class="btn btn-danger" onclick="return confirm('Cancel Order?')">
                Cancel Order
                </button>
                </a>
                </td>
              </tr>
            <?php }
          } ?>
             </table>
          </div>
        </div>
      </div>
<?php include('footer.php'); ?>

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
  </body>
</html>
