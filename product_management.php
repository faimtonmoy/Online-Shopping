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
              $delete2="DELETE FROM shopping_cart where pid='$id'";
              $delete3="DELETE FROM orders where id='$id'";
              $confirm=mysqli_query($connection, $delete);
              mysqli_query($connection, $delete2);
              mysqli_query($connection, $delete3);
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
            <h5>Use your browser's finder to find a specific product!</h5>
            <h5>Press <font color="#71CA6E"> CTRL+F</font> to initiate finder</h5>
          </div>
          </div>
        </div>
    </section>
      <div class="container">
        <div class="card">
          <div class="cardcontainer">
              <h2 style="color:#000">Manage Products</h2>
            <table class="table" border="1">
              <th>ID</th>
              <th>Name</th>
              <th>Price</th>
              <th>Description</th>
              <th>Category</th>
              <th>Sub-category</th>
              <th>Update</th>
              <th>Remove</th>
            <?php
            $sql="SELECT * FROM products";
            $res=mysqli_query($connection, $sql);
            if(mysqli_num_rows($res)>0)
            {
              while($row=mysqli_fetch_array($res))
              {
                echo'<tr>';
                echo'<td>'.$row['id'].'</td>';
                echo'<td>'.$row['name'].'</td>';
                echo'<td>'.$row['price'].'</td>';
                echo'<td>'.$row['description'].'</td>';
                echo'<td>'.$row['category'].'</td>';
                $present_cat=$row['category'];
                echo'<td>'.$row['subcategory'].'</td>';
                $present_scat=$row['subcategory'];
                ?>
                <td>
                  <div class="dropdown">
                   <button
                   type="button"
                   class="btn btn-primary dropdown-toggle"
                   data-toggle="dropdown"
                   style="padding-left: 20px; padding-right: 20px; font-weight:bold; font-size: 15px; margin-top:7px;">
                     <i class="fa fa-edit"></i> <i class="fa fa-caret-down"></i>
                   </button>
                   <ul class="dropdown-menu" style="background:#30353B; width: 240px; padding-left:30px;">
                     <h3 style="color:#fff">Update Product</h3><hr>
                     <form class="form-group" action="" method="post">
                       <label style="color:#FFF">Name</label>
                       <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
                       <label style="color:#FFF">Price</label>
                       <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
                       <label style="color:#FFF">Category</label><br>
                       <select name="cat">
                         <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                         <?php
                         $fetch="SELECT * FROM category";
                         $fetch_res=mysqli_query($connection, $fetch);
                         if(mysqli_num_rows($fetch_res)>0){
                           while($ans=mysqli_fetch_array($fetch_res))
                           {
                             if($ans['category']!=$present_cat)
                             {
                               echo '<option value="'.$ans['category'].'">'.$ans['category'].'</option>';
                             }
                           }
                         }
                          ?>
                       </select><br>
                       <label style="color:#FFF">Sub-category</label><br>
                       <select name="s_cat">
                         <option value="<?php echo $row['subcategory']; ?>"><?php echo $row['subcategory']; ?></option>
                         <?php
                         $fetch2="SELECT * FROM sub_category";
                         $fetch_res2=mysqli_query($connection, $fetch2);
                         if(mysqli_num_rows($fetch_res2)>0){
                           while($ans=mysqli_fetch_array($fetch_res2))
                           {
                             if($ans['sub_category']!=$present_scat)
                             {
                               echo '<option value="'.$ans['sub_category'].'">'.$ans['sub_category'].'</option>';
                             }
                           }
                         }
                          ?>
                       </select><br>
                       <label style="color:#FFF">Description</label>
                       <textarea name="des" rows="4"><?php echo $row['description']; ?></textarea>
                       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                       <input type="submit" name="update_product" class="btn btn-success" value="Update">
                     </form>
                   </ul>
                 </div>
                </td>
                <td>
                  <form  action="" method="post">
                    <input type="hidden" name="del_pr" value="<?php echo $row['id']; ?>">
                    <button style="margin-top:6px;" class="btn btn-danger" type="submit" name="delete_product" onclick="return confirm('Are you sure about removing the product?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                <?php
                echo'</tr>';
              }
            }
             ?>

             </table>
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
  </body>
</html>
