<?php session_start();
include('conn.php');
$home=1;
if(!isset($_SESSION['admin_email']))
{
  header('location: admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Store|Admin</title>
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
    <section>
      <div class="container">
        <h5>Notifications</h5><hr>
        <?php

        if (isset($_POST['add_product']))
        {
          $target_dir = "uploads/";
          $fileName=basename($_FILES["fileToUpload"]["name"]);
          $target_file = $target_dir.$fileName;
          $targetFilePath = $target_dir . $fileName;
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $name=$_POST['p_name'];
            $price=$_POST['p_price'];
            $description=$_POST['p_des'];
            $category=$_POST['p_cat'];
            $subcategory=$_POST['p_s_cat'];
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType, $allowTypes))
            {
                // Upload file to server
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath))
                {
                    // Insert image file name into database
                    $insert = "INSERT INTO products (name, category, subcategory, price, description, image) VALUES ('$name','$category','$subcategory', '$price', '$description','$fileName')";
                    if(mysqli_query($connection,$insert))
                    {

                      echo '<div class="alert success">
                        <span class="closebtn">&times;</span>
                        <strong>Product:'.$name.' has been added successfully.</strong>
                      </div>';
                    }
                    else
                    {

                      echo '<div class="alert danger">
                        <span class="closebtn">&times;</span>
                        <strong>File upload failed, please try again.</strong>
                      </div>';
                    }
                }
                else
                {

                  echo '<div class="alert danger">
                    <span class="closebtn">&times;</span>
                    <strong>Sorry, there was an error uploading your file.</strong>
                  </div>';
                }
            }
            else
            {
              echo '<div class="alert danger">
                <span class="closebtn">&times;</span>
                <strong>Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.</strong>
              </div>';
            }
        }

        if(isset($_POST['add_cat']))
        {
          $cat=$_POST['c_name'];
          $search="SELECT * FROM category WHERE category='$cat'";
          $search_res=mysqli_query($connection,$search);
          if(mysqli_num_rows($search_res)>0)
          {
            echo '<div class="alert danger">
              <span class="closebtn">&times;</span>
              <strong>Category already exists!</strong>
            </div>';

          }
          else {
            $insert="INSERT INTO category(category) VALUES('$cat')";
            if(mysqli_query($connection,$insert))
            {
              echo '<div class="alert success">
                <span class="closebtn">&times;</span>
                <strong>Category added to the system successfully</strong>
              </div>';

            }
          }

        }

        if(isset($_POST['add_s_cat']))
        {
          $cat=$_POST['s_c_for'];
          $scat=$_POST['s_c_name'];
          $search="SELECT * FROM sub_category WHERE sub_category='$scat'";
          $search_res=mysqli_query($connection,$search);
          if(mysqli_num_rows($search_res)>0)
          {
            echo '<div class="alert danger">
              <span class="closebtn">&times;</span>
              <strong>Sub-category already exists!</strong>
            </div>';
          }
          else {
            $insert="INSERT INTO sub_category(category, sub_category) VALUES('$cat', '$scat')";
            if(mysqli_query($connection,$insert))
            {
              echo '<div class="alert success">
                <span class="closebtn">&times;</span>
                <strong>Sub-Category added to the system successfully</strong>
              </div>';
            }
          }
        }

        if(isset($_POST['del_c']))
        {
          $del=$_POST['del_cat'];
          $cat=$_POST['cat'];
          $sql="DELETE FROM category WHERE id='$del'";
          $sql2="DELETE FROM sub_category WHERE category='$cat'";
          if(mysqli_query($connection,$sql) && mysqli_query($connection,$sql2))
          {
            echo '<div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Category removal successful</strong>
            </div>';

          }
          else {
            echo '<div class="alert danger">
              <span class="closebtn">&times;</span>
              <strong>Category removal unsuccess</strong>
            </div>';

          }
        }

        if(isset($_POST['del_scat']))
        {
          $del=$_POST['del_s_cat'];
          $sql="DELETE FROM sub_category WHERE id='$del'";
          if(mysqli_query($connection,$sql))
          {
            echo '<div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Sub-Category removal successful</strong>
            </div>';

          }
          else {
            echo '<div class="alert danger">
              <span class="closebtn">&times;</span>
              <strong>Sub-Category removal unsuccess</strong>
            </div>';

          }
        }
         ?>
      </div>
    </section>
    <div id="products">
      <div class="container">
        <div class="card">
          <div class="cardcontainer">
            <div class="row">
              <div class="col-md-12">
                <h2 style="color:#000;">Add or edit products</h2><hr>
              </div>
              <div class="col-md-6">
                <form class="form-group" action="" method="post" enctype="multipart/form-data">
                  <label for="p_name">Product Name<font color="red">*</font> </label>
                  <input type="text" class="form-control" name="p_name" placeholder="Type a real nice name of your product" required><br>
                  <label for="p_cat">Product Category<font color="red">*</font> </label>
                  <select class="form-control" name="p_cat" required>
                    <?php
                    $sql3="SELECT * FROM category";
                    $res3=mysqli_query($connection,$sql3);
                    if(mysqli_num_rows($res3)>0)
                    {
                      while ($ans3=mysqli_fetch_array($res3))
                      {
                        echo'<option value="'.$ans3['category'].'">'.$ans3['category'].'</option>';
                      }
                    }
                     ?>
                  </select><br>
                  <label for="p_s_cat">Sub Category</label>
                  <select class="form-control" name="p_s_cat">
                    <option value="">select</option>
                    <?php
                    $sql4="SELECT * FROM sub_category";
                    $res4=mysqli_query($connection,$sql4);
                    if(mysqli_num_rows($res4)>0)
                    {
                      while ($ans4=mysqli_fetch_array($res4))
                      {
                        echo'<option value="'.$ans4['sub_category'].'">'.$ans4['sub_category'].'</option>';
                      }
                    }
                     ?>
                  </select><br><br>
                  <label for="p_price">Price<font color="red">*</font> </label>
                  <input type="text" class="form-control" name="p_price" placeholder="Price of the product" required><br>
                  <label for="p_des">Description<font color="red">*</font> </label>
                  <textarea class="form-control" rows="8"  name="p_des" placeholder="Type a nice product detail here" required></textarea><br>
                  <label for="fileToUpload">Product Image<font color="red">*</font> </label>
                  <input  type="file" name="fileToUpload" id="fileToUpload" required><br>
                  <input type="Submit" class="btn btn-success" name="add_product">
                </form>
              </div>
              <div class="col-md-6" style="text-align:center;">
                <br><br><br><br>
                <a href="product_management.php" class="btn btn-primary"><h2>Go to product Management</h2></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="category">
      <div class="container">
        <div class="card">
          <div class="cardcontainer">
            <div class="row">
              <div class="col-md-6">
                <h2 style="color:#000;">Add Category</h2><hr>
                <form class="form-group" action="" method="post">
                  <label for="p_name">Category Name<font color="red">*</font> </label>
                  <input type="text" class="form-control" name="c_name" placeholder="Type a category" required><br>
                  <input type="Submit" class="btn btn-success" name="add_cat">
                </form>
              </div>
              <div class="col-md-6">
                <h2 style="color:#000;">All Categories</h2><hr>
                <table class="table" border="1">
                  <th>Name</th>
                  <th>Option</th>
                  <?php
                  $cat_sq="SELECT * FROM category";
                  $cat_res=mysqli_query($connection,$cat_sq);
                  if(mysqli_num_rows($cat_res)>0){
                    while($row=mysqli_fetch_array($cat_res))
                    {
                      echo '<tr>
                      <td><b>'.$row['category'].'</b></td>
                      <td><form action="" method="post">
                      <input type="hidden" name="del_cat" value="'.$row['id'].'">
                      <input type="hidden" name="cat" value="'.$row['category'].'">
                      <input type="submit" name="del_c" class="btn btn-danger" value="Delete">
                      </form></td>
                      </tr>';
                    }
                  } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="subcategory">
      <div class="container">
        <div class="card">
          <div class="cardcontainer">
            <div class="row">
              <div class="col-md-5">
                <h2 style="color:#000;">Add Sub-category</h2><hr>
                <form class="form-group" action="" method="post">
                  <label for="s_c_for">Sub Category for<font color="red">*</font> </label>
                  <select class="form-control" name="s_c_for" required>
                    <?php
                    $cat_sq2="SELECT * FROM category";
                    $cat_res2=mysqli_query($connection,$cat_sq2);
                    if(mysqli_num_rows($cat_res2)>0){
                      while($row=mysqli_fetch_array($cat_res2))
                      {
                        echo '<option value="'.$row['category'].'"> '.$row['category'].' </option>';
                      }
                    } ?>
                  </select>
                  <label for="p_name">Sub-category Name<font color="red">*</font> </label>
                  <input type="text" class="form-control" name="s_c_name" placeholder="Type a real nice name of your product" required>
                  <input type="Submit" class="btn btn-success" name="add_s_cat">
                </form>
              </div>
              <div class="col-md-6">
                <h2><font color="#00">All Sub Categories</font></h2><hr>
                <table class="table" border="1">
                  <th>Sub-category</th>
                  <th>Category</th>
                  <th>Option</th>
                  <?php
                  $scat_sq="SELECT * FROM sub_category";
                  $scat_res=mysqli_query($connection,$scat_sq);
                  if(mysqli_num_rows($scat_res)>0)
                  {
                    while($row=mysqli_fetch_array($scat_res))
                    {
                      echo '<tr>
                      <td><b>'.$row['sub_category'].'</b></td>
                      <td><b>'.$row['category'].'</b></td>
                      <td><form action="" method="post">
                      <input type="hidden" name="del_s_cat" value="'.$row['id'].'">'; ?>
                      <input type="submit" name="del_scat" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure about this?')">
                      </form></td>
                      </tr>';
                      <?php
                    }
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
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
