  <?php include('head.php'); 
$_SESSION['currentpage'] = "checkout";
$hasbilao = "false";
?>

<style>
.inv {
    display: none;
}
</style>


    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
         <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 style="color: white;" class="mb-0">Checkout</h1>
                        <h4 class="text-muted mb-0">Select date and time of pickup</h4>
                    </div>
                </div>
            </div>
        </div>

              <!-- Section -->
        <section class="section bg-light">

            <div class="container">
                <div class="row">
                    <div class="col-xl-4 push-xl-8 col-lg-5 push-lg-7">
                        <div class="shadow bg-white stick-to-content mb-4">
                            <div class="bg-dark dark p-4"><h5 class="mb-0">You order</h5></div>
                             <table class="table-cart">

                         <?php
                          if (isset($_SESSION['orders'])) {
                            $arraylength =  count($_SESSION["orders"]);
                          $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid');
                          $quantityvalues = array_column($_SESSION["orders"], 'quantity');
                          
                          $displaytotalprice = 0;
                          for ($y = 0; $y < $arraylength; $y ++) { 
                            $qrygetprice = mysqli_query($connection, "select * from menu_item_table where menuitemid = '" . $menuitemidvalues[$y] . "'");
                            $rowsofprices = mysqli_fetch_assoc($qrygetprice);

                            $displaytotalprice += ($rowsofprices['price'] * $quantityvalues[$y]);
                          }

                            $displaytotalprice = $displaytotalprice;
                          }
                          
                      
                      if (isset($_SESSION['orders'])) {
                      
                      
                      for($i = 0; $i < $arraylength; $i++) {
                      $qry = mysqli_query($connection,"select * from menu_item_list_view where menuitemid = '" . $menuitemidvalues[$i] . "'");
                      $result = mysqli_fetch_assoc($qry); 
                      if ($result['menucategoryid'] == 6) {
                        $hasbilao = "true";
                      }
                      ?>  
                      <tr>
                        <td class="title">
                            <span class="name"><a href="#productModal" data-toggle="modal"><?php echo $result['menuitemname']; ?></a></span>
                           
                        </td>
                        <td><?php echo $_SESSION['orders'][$menuitemidvalues[$i]]['quantity']; ?></td>

                        <td class="price">&#8369;<?php echo number_format($result['price']*$_SESSION['orders'][$menuitemidvalues[$i]]['quantity'],2); ?></td>
                        <td class="actions">
                            <a href="#productModal<?php echo $result['menuitemid']; ?>" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                    
                            <a href="controller.php?menuitemid=<?php echo $result['menuitemid']; ?>&sourcepage=edit-cart" class="action-icon"><i class="ti ti-close"></i></a>
                        </td>
                
                        </tr>
                    </tr>

                <?php }} ?>

                <?php if (count($_SESSION['orders']) == 0): ?>
                    <div class="row">
                        <div class="col-12">
                        <br>
                            <h2 style="text-align: center;">Cart is empty!</h2>
                        </div>
                    </div>
                <?php endif ?>


                </table>
                               

                           
                   <div class="cart-summary">
                    <div class="row">
                        <div class="col-7 text-right text-muted">Sub Total:</div>
                        <div class="col-5"><strong>&#8369;<?php $subtotal = number_format($displaytotalprice / 1.12,2); echo $subtotal ?></strong></div>
                    </div> 

                    <?php 

                    $ifsc = 0;
                    if (isset($_SESSION['customerid'])) {
                        $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $_SESSION['customerid'] . "'");
                        $ifsc = mysqli_num_rows($qryifsc);
                    }
                    else
                    {
                        $ifsc = 0;
                    }
                    
                    $sc = false;
                    if ($ifsc > 0) {
                        $vat = number_format(0,2);
                        $discount = $subtotal * 0.20;
                        $discount = number_format($discount, 2);
                        $displaytotalprice = $subtotal - $discount;
                        $sc = true;
                    }
                    else 
                    {
                          $sc = false;
                        $vat = number_format($displaytotalprice- ($displaytotalprice / 1.12),2);
                        

                    }   


                    ?>



                    <div class="row">
                        <div class="col-7 text-right text-muted">VAT</div>
                        <div class="col-5"><strong>&#8369;<?php echo $vat; ?></strong></div>
                    </div>

                    <?php if ($sc == true): ?>
                        <div class="row">
                        <div class="col-7 text-right text-muted">Discount (SC)</div>
                        <div class="col-5"><strong>&#8369;<?php echo $discount; ?></strong></div>
                    </div>

                    <?php endif ?>
                   

                    <hr class="hr-sm">
                    <div class="row text-lg">
                        <div class="col-7 text-right text-muted">Total</div>
                        <div class="col-5"><strong>&#8369;<?php
                          if (isset($_SESSION['orders'])) {

                            echo number_format($displaytotalprice,2);
                        
                          } ?></strong>
                          <script type="text/javascript">
                            var displaytotalprice = <?php echo $displaytotalprice; ?>;                              
                            document.getElementById("carttotalamount").textContent =  "\u20B1" + displaytotalprice.toFixed(2);
                          </script>


                          </div>
                    </div>
                </div>
                        </div>
                    </div>
                    <div class="col-xl-8 pull-xl-4 col-lg-7 pull-lg-5">
                        <div class="bg-white p-4 p-md-5 mb-4">	
                          
                        <?php if (isset($_SESSION['customerid'])): ?>
                        	
                        
                            <h4 class="border-bottom pb-4"><i class="ti ti-package mr-3 text-primary"></i>Schedule for pickup</h4>

                            <?php if (date('H:i:s') >= "18:00:00"): ?>
                            <h6>Sorry pre order is not available at this time. Store is already closed.</h6>
                          <?php endif ?>
                            <form action="controller.php" method="POST">

                        <div class="row mb-5">

                          <div class="form-group col-sm-6">
                              <label>Order Type</label>
                              <div class="select-container">
                                <select id="target" class="form-control" name="ordertype" required="">
                                <option value="" disabled selected>Choose order type.</option>
                                 <option  value="1" <?php if (date('H:i:s') >= "18:00:00") {
                                  echo "disabled";
                                }  ?>>Pre Order</option>
                                 <option value="2">Advance Booking</option>
                                  </select>
                              </div>
                          </div>
                        </div>


                     <input type="text" name="ordertypeselected" id="ordertypeselected" name="" hidden>


                        <div id="1" class="inv">
                        <?php if (date('H:i:s') >= "18:00:00") { ?>
                          <h5>Sorry you cannot order anymore. Store is already closed.</h5>
                        <?php } else { ?>
                          
                          <div class="row mb-5">
          
                              <div class="form-group col-sm-6">
                                <label>Date:</label>
                                <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="date1" readonly="readonly">
                              </div>

                          </div>

                          <?php if ($hasbilao == "true") {
                                         $additionalminutes = "+30 minutes";
                                       }
                                       else
                                       {
                                        $additionalminutes = "+10 minutes";
                                       }
                         
                                       ?>



                             <div class="row mb-5">
                                <div class="form-group col-sm-6">
                                    <label>Time</label>
                                    <div class="select-container">
                                       <select class="form-control" name="time1" required="" >

                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("8:00:00"))): ?>
                                         <option value="8:00:00" >8:00 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("8:30:00"))): ?>
                                         <option value="8:30:00" >8:30 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("9:00:00"))): ?>
                                         <option value="9:00:00" >9:00 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("9:30:00"))): ?>
                                         <option value="9:30:00" >9:30 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <=date("H:i:s", strtotime("10:00:00"))): ?>
                                         <option value="10:00:00" >10:00 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("10:30:00"))): ?>
                                         <option value="10:30:00" >10:30 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("11:00:00"))): ?>
                                         <option value="11:00:00" >11:00 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("11:30:00"))): ?>
                                         <option value="11:30:00" >11:30 AM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("12:00:00"))): ?>
                                         <option value="12:00:00" >12:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("12:30:00"))): ?>
                                         <option value="12:30:00" >12:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("13:00:00"))): ?>
                                         <option value="13:00:00" >1:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("13:30:00"))): ?>
                                         <option value="13:30:00" >1:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("14:00:00"))): ?>
                                         <option value="14:00:00" >2:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("14:30:00"))): ?>
                                         <option value="14:30:00" >2:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("15:00:00"))): ?>
                                         <option value="15:00:00" >3:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("15:30:00"))): ?>
                                         <option value="15:30:00" >3:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("16:00:00"))): ?>
                                         <option value="16:00:00" >4:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("16:30:00"))): ?>
                                         <option value="16:30:00" >4:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("17:00:00"))): ?>
                                         <option value="17:00:00" >5:00 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("17:30:00"))): ?>
                                         <option value="17:30:00" >5:30 PM</option>
                                       <?php endif ?>
                                       <?php if (date("H:i:s", strtotime($additionalminutes)) <= date("H:i:s", strtotime("18:00:00"))): ?>
                                         <option value="18:00:00" >6:00 PM</option>
                                       <?php endif ?>

           

                                        </select>
                                    </div>
                                </div>
                              </div>
                        <?php } ?>
                        </div>
                        <div id="2" class="inv">

                        <div class="row mb-5">
          
                            <div class="form-group col-sm-6">
                            <label>Date:</label>
                            <input required="" class="form-control" type="date" name="date2" value="<?php
                            $date = date('Y-m-d');
                            $date = new DateTime($date);
                            $date->modify('+1 day');
                             echo $date->format('Y-m-d'); ?>" min="<?php
                            $date = date('Y-m-d');
                            $date = new DateTime($date);
                            $date->modify('+1 day');
                             echo $date->format('Y-m-d'); ?>">
                              </div>
                            </div>


                             <div class="row mb-5">

                                <div class="form-group col-sm-6">
                                    <label>Time</label>
                                    <div class="select-container">
                                       <select required="" class="form-control" name="time2">
                                       <option value="8:00:00" selected>8:00 AM</option>
                                       <option value="8:30:00">8:30 AM</option>
                                       <option value="9:00:00">9:00 AM</option>
                                       <option value="9:30:00">9:30 AM</option>
                                       <option value="10:00:00">10:00 AM</option>
                                       <option value="10:30:00">10:30 AM</option>
                                       <option value="11:00:00">11:00 AM</option>
                                       <option value="11:30:00">11:30 AM</option>
                                       <option value="12:00:00">12:00 PM</option>
                                       <option value="13:00:00">1:00 PM</option>
                                       <option value="13:30:00">1:30 PM</option>
                                       <option value="14:00:00">2:00 PM</option>
                                       <option value="14:30:00">2:30 PM</option>
                                       <option value="15:00:00">3:00 PM</option>
                                       <option value="15:30:00">3:30 PM</option>
                                       <option value="16:00:00">4:00 PM</option>
                                       <option value="16:30:00">4:30 PM</option>
                                       <option value="17:00:00">5:00 PM</option>
                                       <option value="17:30:00">5:30 PM</option>
                                       <option value="18:00:00">6:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                              

                        </div>

                            


                              <?php endif ?>

                              <?php if (!isset($_SESSION['customerid'])): ?>

                              	<h4 class="border-bottom pb-4"><i class="ti ti-package mr-3 text-primary"></i>Login first to checkout</h4>
                              	<br>
                              	<h4>Please login to proceed</h4>
                              	<a href="login.php?from=checkout"><button class="btn btn-info btn-lg"><span>Login here!</span></button></a>
                              	<br><br><h4>No account?</h4>
                              	<a href="registration.php"><button class="btn btn-success btn-lg"><span>Register here!</span></button></a>
                              <?php endif ?>
                          
                        </div>

                       	<?php if (isset($_SESSION['customerid'])): ?>
                       		 <div class="text-center">
                       		 <input type="text" hidden="" name="sourcepage" value="checkout">
                            <button  onclick="return confirm('Order confirmation');" type="submit" class="btn btn-outline-secondary"><span>Order now!</span></button> 

              
                        </div>
                       		
                       	<?php endif ?>
                 </form>
                    </div>
                </div>
            </div>

        </section>


       </div>

<script>
            document
                .getElementById('target')
                .addEventListener('change', function () {
                    'use strict';
                    var vis = document.querySelector('.vis'),   
                        target = document.getElementById(this.value);
                         document.getElementById("ordertypeselected").value = this.value;
                    if (vis !== null) {
                        vis.className = 'inv';
                    }
                    if (target !== null ) {
                        target.className = 'vis';
                    }
            });
        </script>

    

 <?php include('footer.php'); ?>
