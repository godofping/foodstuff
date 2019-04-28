<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-bills-of-customer";
if (isset($_GET['a'])) {
  $_SESSION['page'] = "archives-view-bills-of-customer";
}
include('head.php'); 
?>



      <div class="main-content">
        <div class="page-title">
          <div class="title"><?php if (isset($_GET['a'])): ?>
            Archives
          <?php endif ?>
            <?php if (!isset($_GET['a'])): ?>
            Reports
          <?php endif ?></div>
          <div class="sub-title">Bills of Customers</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            Bill list
          </div>
          <div class="card-block">

 

          <?php if (isset($_GET['a'])): ?>
            <h4>Bills List - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d');} echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>
          <?php endif ?>

          <?php if (!isset($_GET['a'])): ?>
            <h4>Bills List - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date("Y-m-d");} echo $date; ?></h4>
          <?php endif ?>



          <a href="print/print-view-bills-of-customer.php?date=<?php echo $date; ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
          <div class="table-responsive flip-scroll">
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Orders</th>
                  <th>Order Date</th>
                  <th>Order Method</th>
                  <th>Status</th>
                  <th>Time and Date of Pick up</th>
                  <th>Customer Name</th>
                  <th>Sub Total</th>
                  <th>VAT</th>
                  <th>Discount (SC)</th>
                  <th>Total Bill</th>
                  <?php if (!isset($_GET['a'])): ?>
                    <th>Action</th>
                  <?php endif ?>

                  <!-- <th>Action</th> -->
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
              $qry = mysqli_query($connection,"select * from order_view where (isapproved = 1 OR isapproved = 3 OR isapproved = 4 or isapproved = 5) and isdeleted = 0 and datetimeofpickup like '%" . $date . "%' ORDER BY datetimeofpickup ASC;");

              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td>Order ID <?php echo $result['orderid']; ?></td>
                  <td class="text-center">
                    <?php $qry1 = mysqli_query($connection, "select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                    
                    while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                    <li><?php echo $result1['menuitemname'] . ", QTY:" . $result1['quantity']; ?></li>
                    <?php } ?>
                    <br>
                  <a data-toggle="modal"  data-target="#modal3<?php echo $i; ?>"><button class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="View Order"><i class="icon-eye"></i></button></a>
                  </td>
                  <?php
                  
                  $totalamount = 0;
                   $qryingettingcartitems = mysqli_query($connection,"select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                    $subtotal = 0;
                   while ( $resultsofcartitems = mysqli_fetch_assoc($qryingettingcartitems)) {
             
                    $totalamount += $resultsofcartitems['subtotal'];

                   
                  } ?>

                  <?php 

                  $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $result['customerid'] . "'");

                  
                  if (mysqli_num_rows($qryifsc) > 0) {
                      
                      $subtotal = $totalamount / 1.12;
                      $discount = $subtotal * 0.20;
                      $displaytotalprice = $subtotal - $discount;
                      $vat = 0;
                  }
                  else
                  {
                    $subtotal = $totalamount / 1.12;
                    $discount = 0;
                    $vat = $totalamount - $subtotal;
                    $displaytotalprice = $totalamount;
                  }

                   ?>
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
                  <td><?php echo $result['datetimeofpickup']; ?></td>
                  <td><?php echo $result['customerfullname']; ?></td>
                  <td>&#8369; <?php echo number_format($subtotal, 2); ?></td>
                  <td>&#8369; <?php echo number_format($vat, 2); ?></td>
                  <td>&#8369; <?php echo number_format($discount, 2); ?></td>
                  <td>&#8369; <?php echo number_format($displaytotalprice, 2); ?></td>
                  <?php if (!isset($_GET['a'])): ?>
                  <td><a href="print/print-print-receipt.php?orderid=<?php echo $result['orderid'] ?>&customerid=<?php echo $result['customerid']; ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print Receipt</button></a></td>
                    
                  <?php endif ?>
                  <!-- <td class="text-center">


                  <a href="controller.php?orderid=<?php echo $result['orderid']; ?>&sourcepage=view-ordering-and-booking&whattodo=finish" onclick="return confirm('Do you wish to finish this order id <?php echo $result['orderid']; ?>?');"><button class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Finish Order"><i class="icon-check"></i></button></a>

                  <a href="controller.php?orderid=<?php echo $result['orderid']; ?>&sourcepage=view-ordering-and-booking&whattodo=cancel"><button class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Cancel Order"><i class="icon-close"></i></button></a>

                  <a href="controller.php?orderid=<?php echo $result['orderid']; ?>&sourcepage=view-ordering-and-booking&whattodo=delete" onclick="return confirm('Do you wish to delete the order id <?php echo $result['orderid']; ?>?');"><button class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Delete Order"><i class="icon-trash"></i></button></a>
                  
                  </td> -->
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
      $qry = mysqli_query($connection,"select * from order_view where (isapproved = 1 OR isapproved = 3 OR isapproved = 4 or isapproved = 5) and isdeleted = 0 and datetimeofpickup like '%" . $date . "%' ORDER BY datetimeofpickup ASC;");
      while ($result = mysqli_fetch_assoc($qry)) {

       ?>
      <!-- start modal -->
      <div class="modal bs-modal-sm" id="modal3<?php echo $u; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id="printreceipt<?php echo $u; ?>">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Order ID <?php echo $result['orderid']; ?></h4>
            </div>
            <div class="modal-body" >
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
                <input class="form-control" type="date" value="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>" required="" name="date" max="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="arhives-view-bills-of-customer" hidden="">
              <button type="submit" class="btn btn-success" >Change</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

      

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    