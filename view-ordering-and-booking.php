
application/x-httpd-php view-ordering-and-booking.php ( PHP script text )

<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "ordering-and-booking";
if (isset($_GET['a']) and $_GET['a'] == 1) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-approved";
}
if (isset($_GET['a']) and $_GET['a'] == 2) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-pending";
}
if (isset($_GET['a']) and $_GET['a'] == 3) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-cancelled";
}
if (isset($_GET['a']) and $_GET['a'] == 4) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-claimed";
}
if (isset($_GET['a']) and $_GET['a'] == 5) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-unclaimed";
}
if (isset($_GET['a']) and $_GET['a'] == 6) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-readytopickup";
}
if (isset($_GET['a']) and $_GET['a'] == 7) {
 $_SESSION['page'] = "ordering-and-booking-in-archives-preparing";
}
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title"><?php if (isset($_GET['a'])): ?>
            Archives
          <?php endif ?>Ordering and Booking</div>
          <div class="sub-title"><?php 
          if (isset($_GET['in'])) {
            if ($_GET['in'] == 'approved') {
              echo "Approved Orders";
            }
            elseif ($_GET['in'] == 'cancelled') {
              echo "Cancelled Orders";
            }
            elseif ($_GET['in'] == 'pending') {
              echo "Pending Orders";
            }
          }
           ?></div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            Orders list
          </div>
          <div class="card-block">



          <?php if (isset($_GET['a'])): ?>
            <h4>Orders list - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date_create(date('Y-m-d'))->modify('-0 days')->format('Y-m-d'); } echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>
          <?php endif ?>

          <?php if (!isset($_GET['a'])): ?>
            <h4>Orders list<?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date("Y-m-d");} ?></h4>
          <?php endif ?>

        

          <a href="print/print-view-ordering-and-booking.php?in=<?php echo $_GET['in']; if(isset($_GET['date'])){ echo "&date=" . $date;  } else { echo "&date=" . $date; } if(isset($_GET['a'])){ echo "&a=" . $_GET['a'];  }  ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>


          <div class="table-responsive flip-scroll">
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Orders</th>
                  <th>Customer Name</th>
                  <th>Order Date</th>
                  <th>Order Method</th>
                  <th>Time and Date of Pick up</th>
                  <th>Status</th>
                  <th>Status by</th>
                  <?php if (!isset($_GET['a'])): ?>
                    <th>Action</th>
                  <?php endif ?>
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
              
              if (isset($_GET['in']) and $_GET['in'] == 'approved') {
              
                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 1 and isdeleted = 0 and orderdate like '%" . $date . "%'");
                
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'cancelled') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 2 and isdeleted = 0 and orderdate like '%" . $date . "%'");

                
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'pending') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 0 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'claimed') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 3 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'unclaimed') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 6 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'readytopickup') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 5 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'preparing') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 4 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'default')
              {
                $qry = mysqli_query($connection,"select * from order_view where isapproved != 3 and datetimeofpickup > '" . date('Y-m-d') . "'");
              }

              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['orderid']; ?></td>
                  <td class="text-center">
                    <?php $qry1 = mysqli_query($connection, "select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                    
                    while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                    <li><?php echo $result1['menuitemname'] . ", QTY:" . $result1['quantity']; ?></li>
                    <?php } ?>
                    <br>
                  <a data-toggle="modal"  data-target="#modal2<?php echo $i; ?>"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="View Order"><i class="icon-eye"></i></button></a>
                  </td>

                  <td><?php echo $result['customerfullname']; ?></td>
                  <td><?php echo $result['orderdate']; ?></td>
                  <td>
                    <?php 
                    if ($result['ordertype'] == 1) {
                    echo "Pre Order"; 
                    } 
                    elseif ($result['ordertype'] == 2) 
                    { 
                    echo "Advance Booking";
                    } 
                    ?>
                    </td>
                  <td><?php echo $result['datetimeofpickup']; ?></td>
                  <td><?php 
               
                  if ($result['isapproved'] == 0) {
                    echo "Pending";
                  }
                  elseif ($result['isapproved'] == 1) {
                    echo "Approved";
                  }
                  elseif ($result['isapproved'] == 2) {
                    echo "Cancelled";
                  }
                  elseif ($result['isapproved'] == 3) {
                    echo "Claimed";
                  }
                  elseif ($result['isapproved'] == 4) {
                    echo "Preparing";
                  }
                  elseif ($result['isapproved'] == 5) {
                    echo "Ready to pickup";
                  }
                  elseif ($result['isapproved'] == 6) {
                    echo "Unclaimed";
                  }


                  
                  ?></td>
                  <td><?php $qrygetuser = mysqli_query($connection, "select * from user_view where userid = '" . $result['userid'] . "'");
                  $resultqrygetuser = mysqli_fetch_assoc($qrygetuser); echo $resultqrygetuser['firstname'] . " " . $resultqrygetuser['middlename'] . " " . $resultqrygetuser['lastname'] ?></td>
                  <?php if (!isset($_GET['a'])): ?>
                  <td class="text-center">


                  <?php if ($result['isapproved'] != 2 and $result['isapproved'] != 1): ?>
                    <a href="controller.php?orderid=<?php echo $result['orderid']; ?>&sourcepage=view-ordering-and-booking&whattodo=approve&customerid=<?php echo $result['customerid']; ?>&in=<?php echo $_GET['in'] ?>" onclick="return confirm('Do you wish to approve the order id <?php echo $result['orderid']; ?>?');"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Approve Order">Approve Order</button></a>
                  <?php endif ?>

                  <?php if ($result['isapproved'] == 2 or $result['isapproved'] == 1): ?>
                    <button disabled="" class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Approve Order">Approve Order</button>
                  <?php endif ?>


                  <!-- <a href="controller.php?orderid=<?php echo $result['orderid']; ?>&sourcepage=view-ordering-and-booking&whattodo=delete&customerid=<?php echo $result['customerid']; ?>" onclick="return confirm('Do you wish to delete the order id <?php echo $result['orderid']; ?>?');"><button class="btn btn-warning  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Delete Order">Delete Order</i></button></a> -->
                  
                  </td>

                    
                  <?php endif ?>
                </tr>

 

              <?php  $i++; } ?>
                
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /main area -->

      <?php
      $u = 1;
      if (isset($_GET['in']) and $_GET['in'] == 'approved') {
              
                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 1 and isdeleted = 0 and orderdate like '%" . $date . "%'");
                
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'cancelled') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 2 and isdeleted = 0 and orderdate like '%" . $date . "%'");

                
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'pending') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 0 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'claimed') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 3 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'unclaimed') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 6 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'readytopickup') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 5 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'preparing') {

                  $qry = mysqli_query($connection,"select * from order_view where isapproved = 4 and isdeleted = 0 and orderdate like '%" . $date . "%'");
               
              }
              elseif (isset($_GET['in']) and $_GET['in'] == 'default')
              {
                $qry = mysqli_query($connection,"select * from order_view where isapproved != 3 and datetimeofpickup > '" . date('Y-m-d') . "'");
              }
      while ($result = mysqli_fetch_assoc($qry)) {

       ?>
      <!-- start modal -->
      <div class="modal bs-modal-sm" id="modal2<?php echo $u; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Order ID <?php echo $result['orderid']; ?></h4>
            </div>
            <div class="modal-body">
              <p>List of foods ordered.</p>
                                  <div class="table-responsive flip-scroll">
                    <table id="as" class="table table-bordered table-striped m-b-0">
                    <thead>
                      <tr>
                        <th>FOOD</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Special Instruction</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                   $qryingettingcartitems = mysqli_query($connection,"select * from cart_items_view where orderid = '" . $result['orderid'] . "'");

                  
                   $totalamount = 0;

                    while ( $resultsofcartitems = mysqli_fetch_assoc($qryingettingcartitems)) {
                      ?>
                      <tr>
                        <td><?php echo $resultsofcartitems['menuitemname']; ?></td>
                        <td>&#8369; <?php echo number_format($resultsofcartitems['price'], 2); ?></td>
                        <td><?php echo $resultsofcartitems['quantity']; ?></td>
                        <td><?php echo $resultsofcartitems['specialinstruction']; ?></td>
                        <td>&#8369; <?php $totalamount += $resultsofcartitems['subtotal']; echo number_format($resultsofcartitems['subtotal'], 2); ?></td>
                        
                        
                      </tr>
                    <?php } ?>
                    </tbody>
                    
                    </table>


                    <br>

                    <?php 

                    $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $result['customerid'] . "'");



                    $sc = false;
                    if (mysqli_num_rows($qryifsc) > 0) {
                        
                        $subtotal = $totalamount / 1.12;
                        $vat = 0;
                        $discount = $subtotal * 0.20;
                        $displaytotalprice = $subtotal - $discount;
                        
                        $sc = true;
                    }
                    else
                    {
                      $sc = false;

                      $subtotal = $totalamount / 1.12;
                      $vat = number_format($totalamount- $subtotal,2);
                      
                      $displaytotalprice = $totalamount;
                    }

                     ?>



                    <div class="invoice-totals">
                      <div class="invoice-totals-row">
                        <strong class="invoice-totals-title">Sub Total</strong>
                        <span class="invoice-totals-value">&#8369; <?php echo number_format($subtotal, 2); ?></span>
                      </div>
                      <div class="invoice-totals-row">
                        <strong class="invoice-totals-title">VAT</strong>
                        <span class="invoice-totals-value">&#8369; <?php echo number_format($vat, 2); ?></span>
                      </div>
                      <?php if ($sc == true): ?>
                        <div class="invoice-totals-row">
                        <strong class="invoice-totals-title">Discount (SC)</strong>
                        <span class="invoice-totals-value">&#8369; <?php echo number_format($discount, 2); ?></span>
                      </div>
                      <?php endif ?>
                      <div class="invoice-totals-row">
                        <strong class="invoice-totals-title">Total</strong>
                        <span class="invoice-totals-value">&#8369; <?php echo number_format($displaytotalprice, 2); ?></span>
                      </div>
                    </div>
                    
                    </div>
            
            </div>
            <div class="modal-footer no-border">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->
      <?php $u++; } ?>

      <!-- start modal -->
      <div class="modal bs-modal-sm" id="changedatemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Change date to view inventory history</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="date" value="<?php echo date_create(date('Y-m-d'))->modify('-0 days')->format('Y-m-d'); ?>" required="" name="date" max="<?php echo date_create(date('Y-m-d'))->modify('-0 days')->format('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="view-list-of-orders-change-date-approved" hidden="">
              <input type = "text" name = "in" value="<?php echo $_GET['in']; ?>" hidden="">
              <button type="submit" class="btn btn-success" >Change</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->


      <script type="text/javascript">
        function printData()
        {
           var divToPrint=document.getElementById("datatabletoprint");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }
      </script>

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
