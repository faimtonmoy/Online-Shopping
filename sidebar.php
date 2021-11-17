<?php
$connection=mysqli_connect("localhost", "root", "", "online_store");
$i=0;
?>

      <nav id="sidebar">
          <div class="sidebar-header" style="text-align:center;">
              <h2>Categories</h2>
          </div>
          <ul class="list-unstyled components" style="text-align:center; font-weight:bold;">
            <li>
                <a href="index.php">All products</a>
            </li>
              <?php
              $sql="SELECT * FROM category";
              $res=mysqli_query($connection, $sql);
              if(mysqli_num_rows($res)>0)
              {
                while($row=mysqli_fetch_array($res))
                {
                  $cat=$row['category'];
                  $sql2="SELECT * FROM sub_category WHERE category='$cat'";
                  $res2=mysqli_query($connection, $sql2);
                  if(mysqli_num_rows($res2)>0)
                  {
                    echo'
                    <li>
                        <a href="#Submenu'.$i.'" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">'.$cat.' <i class="fa fa-caret-down"></i></a>
                    </li>';
                    echo '<ul class="collapse list-unstyled" id="Submenu'.$i.'" style="background-color:#3D4B87">';
                    while($ans=mysqli_fetch_array($res2))
                    {
                      ?>
                          <li>
                              <a href="index.php?s_cat=<?php echo $ans['sub_category'] ?>"><?php echo $ans['sub_category'] ?></a>
                          </li>

                      <?php
                    }
                    echo '</ul>';
                  }
                  else
                  {
                    echo'
                    <li>
                        <a href="index.php?cat='.$cat.'">'.$cat.'</a>
                    </li>';
                  }
                  $i++;
                }
              }
               ?>
          </ul>
      </nav>
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                  <span class="fa fa-bars"></span>
                </button>
            </div>

        </nav>
      </div>
