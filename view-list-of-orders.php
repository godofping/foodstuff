<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-list-of-orders";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Reports</div>
          <div class="sub-title">List of Orders (Daily)</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
           <h4>Orders list - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date("Y-m-d");} echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>
          
          </div>
          <div class="card-block">

          <div class="row">
            <div class="col s12">
              <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> Order ID <?php echo $_GET['which']; ?> is succesfully <b>deleted</b>.</p>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulchangepass'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> <?php echo $_GET['who']; ?> password is succesfully <b>changed</b>.</p>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulupdateaccount'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> <?php echo $_GET['who']; ?> account is succesfully <b>updated</b>.</p>
                      <br>
              <?php endif ?>
              
              
            </div>                      
          </div>

<a href="print/print-view-list-of-orders.php?date=<?php if(!isset($_GET['date'])) { echo date('Y-m-d'); }else{ echo $_GET['date'];} ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
          <div class="table-responsive flip-scroll">
            <table id="datatabletoprint" class="table table-bordered">
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
                  <th>Actions</th>



                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
              if (isset($_GET['date'])) {
              $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . $_GET['date'] . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");
        
              }
              else
              {
              $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . date('Y-m-d') . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");
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
                  <a data-toggle="modal"  data-target="#modal1<?php echo $i; ?>"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="View Order"><i class="icon-eye"></i></button></a>
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
                <td>
                <form action="controller.php" method="POST">
                  <select class="form-control" name="isapproved" style="width: 80% !important;">
                  <option value="" disabled selected>Change status</option>
                  <?php if ($result['isapproved'] == 0): ?>
                    <option value="1">Approved</option>
                  <?php endif ?>
                  <option value="3">Claimed</option>
                  <option value="6">Unclaimed</option>
                  <option value="4">Preparing</option>
                  <option value="5">Ready to pickup</option>
                  <input type="text" name="sourcepage" value="view-list-of-orders" hidden="">
                  <input type="number" name="orderid" value="<?php echo $result['orderid']; ?>" hidden="">
                  <input type="number" name="customerid" value="<?php echo $result['customerid']; ?>" hidden="">
                  <?php if (isset($_GET['date'])): ?>
                    <input type="number" name="date" value="<?php echo $_GET['date']; ?>" hidden="">
                  <?php endif ?>
                </select> <button class="btn btn-success  btn-sm mr5" onclick="return confirm('Confirm update status');">Update</i></button>
                </form>
                </td>
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

      if (isset($_GET['date'])) {
        $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . $_GET['date'] . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");

      }
      else
      {
      $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . date('Y-m-d') . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");
      }

      while ($result = mysqli_fetch_assoc($qry)) {

       ?>
      <!-- start modal -->
      <div class="modal bs-modal-sm" id="modal1<?php echo $u; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required="" name="date" max="<?php echo date('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="view-list-of-orders-change-date" hidden="">
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
    