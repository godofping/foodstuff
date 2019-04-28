<?php include('head.php'); 
$_SESSION['currentpage'] = "orders";
?>
    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
         <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 style="color: white;" class="mb-0">My Orders</h1>
                        <h4 class="text-muted mb-0">List of my orders</h4>
                    </div>
                </div>
            </div>
        </div>

              <!-- Section -->
        <section class="section bg-light">

            <div class="container">
                <div class="row">
                 

                    <div class="col-lg-12">
                        <div class="bg-white p-4 p-md-5 mb-4">  
                          <h4 class="border-bottom pb-4"><i class="ti ti-list mr-3 text-primary"></i>Orders List</h4>
                            <div class="row mb-8">
                              
                              <table class="table">
                                <thead>
                                  <th>Order ID</th>
                                  <th>Date Ordered</th>
                                  <th>Order Method</th>
                                  <th>Orders</th>
                                  <th>Date and time of pickup</th>
                                  <th>Total Amount</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </thead>
                                <tbody>
                                  <?php $qry2 = mysqli_query($connection, "select * from order_view where customerid = '" . $_SESSION['customerid'] . "' and isdeleted = 0 order by orderid desc");
                                    while ($result2 = mysqli_fetch_assoc($qry2)) {
                                   ?>
                                  <tr>
                                    <td><?php echo $result2['orderid']; ?></td>
                                    <td><?php echo $result2['orderdate']; ?></td>
                                    <td>
                                    <?php 
                                    if ($result2['ordertype'] == 1) {
                                    echo "Pre Order"; 
                                    } 
                                    elseif ($result2['ordertype'] == 2) 
                                    { 
                                    echo "Advance Booking";
                                    } 
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                        $totalamount = 0;

                                         $qry3 = mysqli_query($connection, "select * from cart_items_view where orderid = '" . $result2['orderid'] . "'");

                                          while ($result3 = mysqli_fetch_assoc($qry3)) {
                                          $totalamount += ($result3['quantity'] * $result3['price']);

                                         ?>
                                         <li><?php echo $result3['menuitemname']; ?> : <b><?php echo $result3['quantity']; ?></b>
                                         <br>
                                         <p><?php echo $result3['specialinstruction']; ?></p>
                                         </li>
                                         <?php } ?>
                                      


                                    </td>
                                    <td><?php echo $result2['datetimeofpickup']; ?></td>
                                    <td>&#8369;<?php 

                                    $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $_SESSION['customerid'] . "'");

                                    
                                    if (mysqli_num_rows($qryifsc) > 0) {
                                        
                                        $subtotal = $totalamount / 1.12;
                                        $discount = $subtotal * 0.20;
                                        $displaytotalprice = $subtotal - $discount;
                                        echo number_format($displaytotalprice, 2);
                                    }
                                    else
                                    {
                                      echo number_format($totalamount,2);
                                    }

                                     ?>
                                    </td>
                                    <td><?php if ($result2['isapproved'] == 0) {
                                        echo "Pending";
                                      }
                                      elseif ($result2['isapproved'] == 1) {
                                        echo "Approved";
                                      }
                                      elseif ($result2['isapproved'] == 2) {
                                        echo "Cancelled";
                                      }
                                      elseif ($result2['isapproved'] == 3) {
                                        echo "Claimed";
                                      }
                                      elseif ($result2['isapproved'] == 4) {
                                        echo "Preparing";
                                      }
                                      elseif ($result2['isapproved'] == 5) {
                                        echo "Ready to pickup";
                                      }
                                      elseif ($result2['isapproved'] == 6) {
                                        echo "Unclaimed";
                                      }

                                     ?></td>
                                    
                                    <td>
                                    <?php 

                                    if ($result2['ordertype'] == 1 and $result2['isapproved'] == 0) {


                                       $expiratationdate = date("Y-m-d H:i:s", strtotime( $result2['datetimeofpickup']. "-30 minutes"));

                                        $datetimeofpickup = $result2['datetimeofpickup'];
                                        $datetimenow = date("Y-m-d H:i:s");
                                        $orderdate = $result2['orderdate'];

                                        $now = new DateTime();
                                        $startdate = new DateTime($orderdate);
                                        $enddate = new DateTime($expiratationdate );

                                        if ($startdate <= $now && $now <= $enddate) { ?>
                                    <a href="controller.php?sourcepage=myorders&orderid=<?php echo $result2['orderid']; ?>" class="btn btn-outline-secondary" onclick="if (confirm('Cancel selected order id <?php echo $result2['orderid']; ?>?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><span>Cancel</span></a></td>
                                    <?php }
                                    else
                                    {
                                      ?><p>Cancellation of order is unavailable</p><?php
                                    }
                                     } ?>

                                     <?php 
                                     if ($result2['ordertype'] == 2 and $result2['isapproved'] == 0) {
                                      
                                        $expiratationdate = date("Y-m-d H:i:s", strtotime( $result2['datetimeofpickup']. "-1 hour"));

                                        $datetimeofpickup = $result2['datetimeofpickup'];
                                        $datetimenow = date("Y-m-d H:i:s");
                                        $orderdate = $result2['orderdate'];

                                        $now = new DateTime();
                                        $startdate = new DateTime($orderdate);
                                        $enddate = new DateTime($expiratationdate );

                                        if ($startdate <= $now && $now <= $enddate) { ?>
                                         <a href="controller.php?sourcepage=myorders&orderid=<?php echo $result2['orderid']; ?>" class="btn btn-outline-secondary" onclick="if (confirm('Cancel selected order id <?php echo $result2['orderid']; ?>?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><span>Cancel</span></a></td>
                                        <?php
                                        }
                                        else
                                        {

                                          ?>
                                           <p>Cancellation of order is unavailable</p>
                                          <?php
                                        }

                                         
                                     }

                            
                                      ?>



                                  </tr>
                                  <?php } ?>
                                </tbody>
                                
                              </table>
                            </div>

                           
                            
                          
                        </div>
                              </div>
                </div>
            </div>
            </div>

        </section>


       </div>



    

 <?php include('footer.php'); ?>
