<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
include('head.php'); 

?>
      <div class="main-content">
        <div class="m-x-n-g m-t-n-g overflow-hidden">
          <div class="card m-b-0 bg-primary-dark text-white p-a-md no-border">
            <h4 class="m-t-0">
              <!-- <span class="pull-right">$ 82,560.00 This week</span> -->
              <span>Dashboard</span>
              </h4>  
          </div>
          <div class="card bg-white no-border">
            <div class="row text-center">
              <div class="col-sm-3 col-xs-6 p-t p-b">
                <h4 class="m-t-0 m-b-0"><?php
                $qry1 = mysqli_query($connection, "SELECT COUNT(*) AS numberofregisteredaccount FROM customer_table WHERE isdeleted = 0");
                $result1 = mysqli_fetch_assoc($qry1);
                echo $result1['numberofregisteredaccount'];

                 ?></h4>
                <small class="text-muted bold">Number of Customer</small>
              </div>
              <div class="col-sm-3 col-xs-6 p-t p-b">
                <h4 class="m-t-0 m-b-0"><?php 
                $qry = mysqli_query($connection, "select count(*) as num from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . date('Y-m-d') . "%' ORDER BY datetimeofpickup ASC;");
                $result = mysqli_fetch_assoc($qry);
                echo $result['num'];

                 ?></h4>
                <small class="text-muted bold">Number of orders today</small>
              </div>
              <div class="col-sm-3 col-xs-6 p-t p-b">
                <h4 class="m-t-0 m-b-0"> <?php 
                $qry = mysqli_query($connection, "select count(*) as num from order_view where (isapproved = 0)");
                $result = mysqli_fetch_assoc($qry);
                echo $result['num'];

                 ?></h4>
                <small class="text-muted bold">Total numbers of pending orders</small>
              </div>
              <div class="col-sm-3 col-xs-6 p-t p-b">
                <h4 class="m-t-0 m-b-0">&#8369; <?php 
                $qry = mysqli_query($connection, "SELECT SUM(subtotal) AS totalincome FROM cart_items_view WHERE isapproved = 3");
                $result = mysqli_fetch_assoc($qry);
                echo $result['totalincome'];

                 ?></h4>
                <small class="text-muted bold">Total Sales</small>
              </div>
            </div>
          </div>
        </div>
        <div class="row same-height-cards">
       
          <div class="col-md-12">
            <div class="card no-border bg-white" style="height: 314px;">
              <div class="card-block">
                <div class="text-center p-a">
                  <h4 class="card-title p-a-lg m-b-0">Today is <?php echo date('l'); ?></h4>
                </div>
                <div class="">
               
                  
                </div>
              </div>
            </div>
          </div>
        </div>

   

      </div>

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    