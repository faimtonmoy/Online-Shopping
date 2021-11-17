<?php
$cemail=$_SESSION['email'];
$sql="SELECT * FROM shopping_cart WHERE cemail='$cemail'";
$res=mysqli_query($connection,$sql);
 ?>
<div class="dropdown">
 <button
 type="button"
 class="btn btn-success dropdown-toggle"
 data-toggle="dropdown"
 style="font-weight:bold; font-size: 15px; margin-top:7px;">
   <i class="fa fa-shopping-cart"></i>
   <?php
   $item_count=mysqli_num_rows($res);
   echo '<font color="black">'.$item_count.'</font>';
   ?>
   <i class="fa fa-caret-down"></i>
 </button>
 <ul class="dropdown-menu" style="color:#000;background:#C3D7C3 ; width:auto; padding:10px;">
   <?php

     if(mysqli_num_rows($res)>0)
     {
       echo '<table class="table" border="1" style="width:240px;">
         <th>Product</th>
         <th>Quantity</th>
         <th>Total</th>
         <th> <i class="fa fa-trash"></i> </th>';
       $total=0;
       while($ans=mysqli_fetch_array($res))
       {

           echo'<tr>';
           echo'<td>'.$ans['pname'].'</td>';
           echo'<td>'.$ans['quantity'].'</td>';
           echo'<td>'.number_format($ans['price']).'</td>';
           $total=$total+(float)$ans['price'];
           echo'<td><form action="" method="post">
             <input type="hidden" name="item" value="'.$ans['pid'].'">
             <input type="hidden" name="customer" value="'.$ans['cemail'].'">
             <button type="submit" class="btn btn-danger" name="del_item"> <i class="fa fa-trash"></i> </button>
           </form></td>';

          }
          echo'</tr>';
          echo '<tr>
          <td></td>
          <td></td>
          <td> <b>Grand Total</b>: BDT '.number_format($total,1).'</td>
          <td></td> </tr>';
      echo '</table>
      <a href="confirm_order.php?email='.$_SESSION['email'].'" class="btn btn-primary">Confirm Order</a>';
    }
    else {
      echo'<h5 style="color:#084364">You have not added anything yet!</h5>';
    }
      ?>
 </ul>
</div>
