<section id="home">
</section>
  <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
       <div class="container">
              <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
              </button>
              <a href="admin_homepage.php" class="navbar-brand"> <img src="uploads\brand.png" alt="Online Store" height="45px"> </a>
            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                 <ul class="nav navbar-nav navbar-nav-first">
                      <?php
                      if($home==1)
                      {
                      echo '<li class="nav-item">
                        <a class="smoothScroll" href="#products">Products</a>
                      </li>
                      <li class="nav-item">
                        <a class="smoothScroll" href="#category">Categories</a>
                      </li>
                      <li class="nav-item">
                        <a class="smoothScroll" href="#subcategory">Sub Category</a>
                      </li>';
                    }
                    else {
                      echo'
                      <li class="nav-item">
                        <a class="smoothScroll" href="admin_homepage.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="smoothScroll" href="#home">Top</a>
                      </li>

                      ';

                     }
                     ?>
                     <li class="nav-item">
                       <a class="smoothScroll" href="order_management.php">Order Management</a>
                     </li>

                      <li class="nav-item">
                          <div class="dropdown">
                           <button
                           type="button"
                           class="btn btn-primary dropdown-toggle"
                           data-toggle="dropdown"
                           style="padding-left: 20px; padding-right: 20px; font-weight:bold; font-size: 15px; margin-top:7px;">
                             <i class="fa fa-user"></i> <?php echo $_SESSION['name']; ?> <i class="fa fa-caret-down"></i>
                           </button>
                           <ul class="dropdown-menu" style="background:#10BEFF;">
                             <li class="dropdown-item" style="padding-top:10px;"><a href="logout.php" class="ddbtn">
                               <div class="row">
                                 <div class="col-md-1">
                                   <i class="fa fa-sign-out"></i>
                                 </div>
                                  <div class="col-md-1">
                                   Log Out
                                 </div>
                               </div>
                               </a></li>
                      </li>
                 </ul>
            </div>
       </div>
  </section>
