<?php 
include '../connection.php';
include 'head.php';

?>

    <div style="margin-top: 60px;"></div>

    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container">

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel blue center">
                        
                          <h2 style="color:white;">My Orders</h2>
                        </div>   
                     </div>
                   </div> 

         </div>
         <div class=" container" style="padding-left: 17px; padding-right: 17px;">         

            <div id="borderless-table">
            
              <div class="row">
                <div class="cols s12">
             
                
                  <ul class="collapsible collapsible-accordion " data-collapsible="accordion">
                  <?php 
                       $qry = mysqli_query($connection,"select * from order_view where customerid = '" . $_GET['customerid'] . "' and isdeleted = 0 order by orderid desc"); 

                       while ($result = mysqli_fetch_assoc($qry)) { ?>   

                        
                                <li class="">
                                  <div class="collapsible-header pink" style="color: white;"><span style="float: left;">ORDER ID <?php echo $result['orderid']; ?></span> <span style="float: right;"><?php if ($result['isapproved'] == 0) {
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

                                     ?></span></div>
                                  <div class="collapsible-body" style="display: none;">
                                    <div style="margin: 20px 20px;">
                                      <table>
                                  <thead>
                                    <tr>
                                   
                                      <th>Order Date</th>
                                      <th>Order Method</th>
                                      <th>Orders</th>
                                      <th>Total Amount</th>
                                      <th>Pick up date and time</th>
                               

                                    </tr>
                                  </thead>

                                  <tbody>

                                    <tr>
                                     
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
                                        $totalamount = 0;

                                       $qry3 = mysqli_query($connection, "select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                                          while ($result3 = mysqli_fetch_assoc($qry3)) {
                                             $totalamount += ($result3['quantity'] * $result3['price']);
                                         ?>
                                         <li><?php echo $result3['menuitemname']; ?> : <b><?php echo $result3['quantity']; ?></b>
                                         <br>
                                        <?php echo $result3['specialinstruction']; ?>
                                         </li>
                                         <?php } ?></td>
                                      <td>
                                      &#8369;
                                      <?php 

                                    $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $_GET['customerid'] . "'");


                                    
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
                                      <td><?php echo $result['datetimeofpickup']; ?></td>
                                    </tr>

                                  </tbody>
                                </table>

                                <div class="row">
                                  <div class="col s12">
                                    <?php 
                                    if ($result['ordertype'] == 1 and $result['isapproved'] == 0) {
                                       $expiratationdate = date("Y-m-d H:i:s", strtotime( $result['datetimeofpickup']. "-30 minutes"));

                                        $datetimeofpickup = $result['datetimeofpickup'];
                                        $datetimenow = date("Y-m-d H:i:s");
                                        $orderdate = $result['orderdate'];

                                        $now = new DateTime();
                                        $startdate = new DateTime($orderdate);
                                        $enddate = new DateTime($expiratationdate );

                                        if ($startdate <= $now && $now <= $enddate) { ?>
                                    <a href="controller.php?sourcepage=myorders&orderid=<?php echo $result['orderid']; ?>" class="btn green waves-effect"<span>Cancel</span></a></td>
                                    <?php }
                                    else
                                    {
                                      ?><p>Cancellation of order is unavailable</p><?php
                                    }
                                     } ?>

                                     <?php 
                                     if ($result['ordertype'] == 2 and $result['isapproved'] == 0) {
                                       
           
                                       $expiratationdate = date("Y-m-d H:i:s", strtotime( $result['datetimeofpickup']. "-1 hour"));

                                        $datetimeofpickup = $result['datetimeofpickup'];
                                        $datetimenow = date("Y-m-d H:i:s");
                                        $orderdate = $result['orderdate'];

                                        $now = new DateTime();
                                        $startdate = new DateTime($orderdate);
                                        $enddate = new DateTime($expiratationdate );

                                        if ($startdate <= $now && $now <= $enddate) { ?>

                                         
                                         <a href="controller.php?sourcepage=myorders&orderid=<?php echo $result['orderid']; ?>" class="btn green waves-effect"><span>Cancel</span></a>

                                         <?php
                                        }
                                        else
                                        {
                                          ?>
                                          <p>Cancellation of order is unavailable</p>
                                        
                                          <?php } }?>
                                    
                                  </div>
                                </div>

                                    </div>
                                  </div>
                                </li>
                       

                         <?php }  ?>  
                               </ul>
                       
                </div>
              </div>
          
</div>
 
       


      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>