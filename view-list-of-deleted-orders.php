<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-list-of-deleted-orders";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Archives</div>
          <div class="sub-title">Deleted Orders</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
           <h4>List of Deleted Orders</h4>
          
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
                  
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
              

              $qry = mysqli_query($connection,"select * from order_view where isdeleted = 1");

              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['orderid']; ?></td>
                  <td class="text-center">
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
        $qry = mysqli_query($connection,"select * from order_view where isapproved != 3 and isapproved = 1");
      }
      elseif (isset($_GET['in']) and $_GET['in'] == 'cancelled') {
        $qry = mysqli_query($connection,"select * from order_view where isapproved != 3 and isapproved = 2");
      }
      elseif (isset($_GET['in']) and $_GET['in'] == 'pending') {
        $qry = mysqli_query($connection,"select * from order_view where isapproved != 3 and isapproved = 0");
      }
      else
      {
        $qry = mysqli_query($connection,"select * from order_view where isapproved != 3");
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
    