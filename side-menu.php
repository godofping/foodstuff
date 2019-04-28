   <!-- sidebar panel -->
    <div class="sidebar-panel offscreen-left">
      <div class="brand">
        <!-- toggle offscreen menu -->
        <div class="toggle-offscreen">
          <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <a class="brand-logo">
          <span>Foodstuff</span>
        </a>
        <a href="#" class="small-menu-visible brand-logo">F</a>
        <!-- /logo -->
      </div>
      
      <!-- main navigation -->
      <nav role="navigation">
        <ul class="nav">
          <!-- dashboard -->
          <li class="
          <?php if (isset($_SESSION['page']) and $_SESSION['page'] == 'dashboard') { echo "open"; } ?>">
            <a href="admin-dashboard.php">
              <i class="icon-home"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <!-- /dashboard -->
          <?php if ($_SESSION['userlevel'] == 1): ?>
             <!-- User Module -->
          <li class="
          <?php if (isset($_SESSION['page']) and ($_SESSION['page'] == 'add-user' or $_SESSION['page'] == 'view-user')) { echo "open"; } ?>">
            <a href="javascript:;">
              <i class="icon-users"></i>
              <span>User Module</span>
            </a>
            <ul class="sub-menu">
              <li>
                <a href="add-user.php">
                  <span>Add User</span>
                </a>
              </li>
              <li>
                <a href="view-user.php">
                  <span>View Users</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- /User Module -->
            
          <?php endif ?>
         

          <!-- Ordering&Booking -->
          <li class="<?php if (isset($_SESSION['page']) and ($_SESSION['page'] == 'ordering-and-booking')) { echo "open"; } ?>">
            <a href="view-ordering-and-booking.php?in=default">
              <i class="icon-bag"></i>
              <span>Ordering&Booking</span>
            </a>
          </li>
          <!-- /Ordering&Booking -->


          <!-- Reports -->
          <li class="<?php if (isset($_SESSION['page']) and ($_SESSION['page'] == 'view-customer' or $_SESSION['page'] == 'view-customer' or $_SESSION['page'] == 'view-review' or $_SESSION['page']=='view-list-of-orders' or $_SESSION['page']=='view-bills-of-customer' or $_SESSION['page'] == 'reports-goodies-inventory')) { echo "open"; } ?>">
            <a href="javascript:;">
              <i class="icon-book-open"></i>
              <span>Reports</span>
            </a>
            <ul class="sub-menu">
              <li>
                <a href="view-customer.php">
                  <span>List of Customer</span>
                </a>
              </li>
              <li>
                <a href="view-list-of-orders.php">
                  <span>List of Orders (Daily)</span>
                </a>
              </li>
              <li>
                <a href="view-bills-of-customer.php">
                  <span>Bills of Customers</span>
                </a>
              </li>
              <li>
                <a href="reports-goodies-inventory.php">
                  <span>Goodies Inventory</span>
                </a>
              </li>
              <li>
                <a href="view-review.php">
                  <span>Reviews</span>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- /reports -->

          <!-- Archives -->
          <li class="menu-accordion <?php if(isset($_GET['a'])){ echo "open"; } ?>">
            <a href="javascript:;">
              <i class="icon-folder"></i>
              <span>Archives</span>
            </a>
            <ul class="sub-menu">
              <li class="menu-accordion <?php 
              if(isset($_SESSION['page']) and ($_SESSION['page']=='ordering-and-booking-in-archives-approved' or $_SESSION['page']=='ordering-and-booking-in-archives-pending' or $_SESSION['page']=='ordering-and-booking-in-archives-cancelled' or $_SESSION['page']=='ordering-and-booking-in-archives-claimed' or $_SESSION['page']=='ordering-and-booking-in-archives-unclaimed' or $_SESSION['page']=='ordering-and-booking-in-archives-readytopickup' or $_SESSION['page']=='ordering-and-booking-in-archives-preparing')){ echo "open"; } ?>">
                <a href="javascript:;">
                  <i class="toggle-accordion"></i>
                  <span>Ordering&Booking</span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="view-ordering-and-booking.php?in=approved&a=1">
                      <span>Approved Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=pending&a=2">
                      <span>Pending Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=cancelled&a=3">
                      <span>Cancelled Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=claimed&a=4">
                      <span>Claimed Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=unclaimed&a=5">
                      <span>Unclaimed Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=preparing&a=7">
                      <span>Preparing Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="view-ordering-and-booking.php?in=readytopickup&a=6">
                      <span>Ready to pickup Orders</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="view-bills-of-customer.php?a=1">
                  <span>Bills of Customer</span>
                </a>
              </li>
              <li>
                <a href="archives-goodies-inventory.php?a=1">
                  <span>Goodies Inventory</span>
                </a>
              </li>
              <li>
                <a href="view-review.php?in=archives&a=1">
                  <span>Reviews</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- /archives -->





          <!-- settings -->
          <li class="<?php if (isset($_SESSION['page']) and ($_SESSION['page'] == 'view-food' or $_SESSION['page'] == 'add-food' or $_SESSION['page'] == 'settings-goodies-inventory')) { echo "open"; } ?>">
            <a href="javascript:;">
              <i class="icon-settings"></i>
              <span>Settings</span>
            </a>
            <ul class="sub-menu">
                <li>
                <a href="add-food.php">
                  <span>Add Food</span>
                </a>
              </li>
              <li>
                <a href="view-food.php">
                  <span>View Foods</span>
                </a>
              </li>
              <?php if (isset($_SESSION['userlevel']) and $_SESSION['userlevel'] == 1): ?>
                <li>
                <a href="backup-restore.php">
                  <span>Backup and Restore</span>
                </a>
              </li>
              <?php endif ?>
              <li>
                <a href="settings-goodies-inventory.php">
                  <span>Goodies Inventory</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- /settings -->
          <!-- profile -->
          <li>
            <a href="profile.php">
              <i class="icon-user"></i>
              <span>Profile</span>
            </a>
          </li>
          <!-- /profile -->
          <!-- logout -->
          <li>
            <a href="logout.php">
              <i class="icon-logout"></i>
              <span>Logout</span>
            </a>
          </li>
          <!-- /logout -->
        </ul>
      </nav>
      <!-- /main navigation -->
    </div>
    <!-- /sidebar panel -->