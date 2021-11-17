
<style>

}
</style>
   <section id="home">
   </section>
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">
                 <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="icon icon-bar"></span>
                      <span class="icon icon-bar"></span>
                      <span class="icon icon-bar"></span>
                 </button>
                 <a href="index.php" class="navbar-brand hidden-xs"> <img src="uploads\brand.png" alt="Online Store" height="45px"> </a>
               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li class="nav-item">
                           <a class="smoothScroll" href="index.php">Home</a>
                         </li>
                         <li class="nav-item">
                           <a class="smoothScroll" href="my_orders.php">My Orders</a>
                         </li>
                         <li class="nav-item">
                           <?php
                                  if(isset($_SESSION['id']) && isset($_SESSION['name']))
                                  {
                                    include('shopping_cart.php');
                                  }
                           ?>
                         </li>
                         <li class="nav-item">
                             <div class="dropdown">
                              <button
                              type="button"
                              class="btn btn-primary dropdown-toggle"
                              data-toggle="dropdown"
                              style="padding-left: 20px; padding-right: 20px; font-weight:bold; font-size: 15px; margin-top:7px;">
                                <i class="fa fa-user"></i> <?php echo $_SESSION['name'].' '; ?><i class="fa fa-caret-down"></i>
                              </button>
                              <ul class="dropdown-menu" style="background:#47BDFF;">
                                <li class="dropdown-item">
                                  <a href="logout.php">Logout</a>
                                </li>
                              </ul>
                            </div>
                         </li>
                    </ul>
               </div>
          </div>
     </section>
