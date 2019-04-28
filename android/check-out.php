<?php 
include '../connection.php';
include 'head.php';
$hasbilao = "false";

if ($_SESSION['customerid'] == "") {
  $_SESSION['fromcart'] = "true";
  header("Location: check-out-no-login.php");

}

?>

    <?php if ($_SESSION['customerid'] != ""): ?>
      <div style="margin-top: 60px;"></div>
    <?php endif ?>



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

                            $displaytotalprice = number_format($displaytotalprice,2);
                          }
                          
                          ?>
                          <h4 style="color:white;">CHECK OUT</h4>
                     
                        </div>   
                     </div>
                   </div> 





                   <!--start container-->
     


          <div class="row">
                     <div class="col s12">
                        <div class="card-panel white center">
                          <div id="invoice">
            <div class="invoice-table">
              <div class="row">
                <div class="col s12 m12 l12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th data-field="no">No</th>
                        <th data-field="item">Food</th>
                        <th data-field="uprice">Price</th>
                        <th data-field="price">Quantity</th>
                        <th data-field="price">Total</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
        if (isset($_SESSION['orders'])) {
        $totalprice = 0;
        for($i = 0; $i < $arraylength; $i++) {
        $qry = mysqli_query($connection,"select * from menu_item_list_view where menuitemid = '" . $menuitemidvalues[$i] . "'");
        $result = mysqli_fetch_assoc($qry);
        if ($result['menucategoryid'] == 6) {
                        $hasbilao = "true";
                      } ?>  
                    
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $result['menuitemname']; ?></td>
                        <td>&#8369; <?php echo number_format($result['price'],2); ?></td>
                        <td><?php echo $_SESSION['orders'][$menuitemidvalues[$i]]['quantity']; ?></td>
                        <td>&#8369; <?php echo number_format($result['price'] * $_SESSION['orders'][$menuitemidvalues[$i]]['quantity'], 2); $totalprice += $result['price'] * $_SESSION['orders'][$menuitemidvalues[$i]]['quantity']; ?></td>
                      </tr>
                     
       <?php }} ?>      



                      <?php 
                        $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $_SESSION['customerid'] . "'");
                      
                        if (mysqli_num_rows($qryifsc) > 0) 
                        {
                          
                        ?>
                          <!-- for sc -->
                          <tr>
                            <td colspan="3" class="white"></td>
                            <td>Sub Total:</td>
                            <td>&#8369; <?php $subtotal = $totalprice / 1.12; echo number_format($subtotal, 2); ?></td>
                          </tr>
                          <tr>
                            <td colspan="3" class="white"></td>
                            <td>VAT:</td>
                            <td>&#8369; <?php echo number_format(0, 2); ?></td>
                          </tr>

                          <tr>
                            <td colspan="3" class="white"></td>
                            <td>Discount (SC)</td>
                            <td>&#8369; <?php $discount = ($subtotal * 0.20); echo number_format( $discount, 2); ?></td>
                          </tr>

                          <?php $totalprice = $subtotal - $discount; ?>

                        <?php
                      } else { ?>
                        <!-- for non sc -->
                          <tr>
                            <td colspan="3" class="white"></td>
                            <td>Sub Total:</td>
                            <td>&#8369; <?php $subtotal = $totalprice / 1.12; echo number_format($subtotal, 2); ?></td>
                          </tr>
                          <tr>
                            <td colspan="3" class="white"></td>
                            <td>VAT:</td>
                            <td>&#8369; <?php echo number_format(($totalprice - $subtotal), 2); ?></td>
                          </tr>

                       

                       <?php } ?>     
                      <tr>
                        <td colspan="3" class="white"></td>
                        <td class="cyan white-text">Total Amount</td>
                        <td class="cyan strong white-text">&#8369; <?php echo number_format($totalprice, 2); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>

          </div>
          <br> <br> <br>
                        <h5>Schedule for pickup.</h5>
                        <?php if ($hasbilao == "true") {
                           $additionalminutes = "+30 minutes";
                         }
                         else
                         {
                          $additionalminutes = "+10 minutes";
                         }
           
                         ?>

                        <div class="row">
                          <?php if (date('H:i:s') >= "18:00:00"): ?>
                            <h6>Sorry pre order is not available at this time. Store is already closed.</h6>
                          <?php endif ?>
                          <form action="controller.php" method="POST" enctype="multipart/form-data" class="col s12">

                        <div class="row">
                          <div class="input-field col s12">
                            <label class="active" for="ordertype">Order Type</label>
                            <select id="ordertype" class="form-control" name="ordertype" required="">
                                <option value="" disabled selected>Choose order type.</option>
                                <option value="1" <?php if (date('H:i:s') >= "18:00:00") {
                                  echo "disabled";
                                }  ?> >Pre Order</option>
                                <option value="2">Advance Booking</option>
                            </select>
                          </div>
                        </div>


                    <div id="1" class="selectedordertype" style="display:none">
                      
                      <?php if (date('H:i:s') >= "18:00:00") { ?>
                            
                        <?php } else { ?>
                      <div class="row">
                          <div class="input-field col s12">
                          <label class="active" for="date1">Date</label>
                            <input  name="date1" id="date1" type="date" value="<?php echo date("Y-m-d"); ?>" readonly>
                            <label class="active" for="date">Date</label>
                          </div>
                        </div>

                          <div class="row">
                            <div class="input-field col s12">
                            <label class="active" for="time1">Time</label>
                              <select name="time1">
                        
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
                        <?php } ?>
                    </div>


                    <div id="2" class="selectedordertype" style="display:none"> <div class="row">
                          <div class="input-field col s12">
                          <label class="active" for="date2">Date</label>
                            <input  name="date2" id="date2" type="date" value="<?php
                            $date = date('Y-m-d');
                            $date = new DateTime($date);
                            $date->modify('+1 day');
                             echo $date->format('Y-m-d'); ?>" min="<?php
                            $date = date('Y-m-d');
                            $date = new DateTime($date);
                            $date->modify('+1 day');
                             echo $date->format('Y-m-d'); ?>">
                            <label class="active" for="date2">Date</label>
                          </div>
                        </div>

                          <div class="row">
                            <div class="input-field col s12">
                            <label class="active" for="time2">Time</label>
                              <select  name="time2">
                       
                                       <option value="8:00:00">8:00 AM</option>
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
                          </div> </div>

                        

                          <input type="text" hidden="" name="sourcepage" value="android-check-out">
                           <input type="text" id="ordertypeselected"  name="ordertypeselected" hidden="" value="">
                          <br>
                          <br>
                       
                        </div>

                          
                      
                            <div class="row">
                              <div class="col s6 left-align">
                                <a href="#cancelmodal" class="btn red modal-trigger">CANCEL</a>
                              </div>

                              <div id="cancelmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm cancel checkout. Cart will become empty after you confirm.</p>

                                </div>
                                <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <a href="empty-cart.php" class="waves-effect waves-red btn-flat modal-action modal-close">CONFIRM</a>
                                  
                                </div>
                              </div> 


                              <div class="col s6 right-align">
                               
                                <a href="#confirmmodal" class="btn cyan waves-effect waves-light right modal-trigger" >CONFIRM</a>
                              </div>

                              <div id="confirmmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm order. Your order will be placed after you click the confirm. Make sure to set the order type and date time of pick up.</p>

                                </div>
                              <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <button class="waves-effect waves-green btn-flat modal-action modal-close" type="submit" name="action">CONFIRM</button>
                              </div> 

                              </div>


                            </div>
                        </div>   
                     </div>
                   </div> 
                    </form>
              
                  <div class="row">
                    <div class="col s12 center-align">
                      <div class="card-panel orange">
                        <a href="cart.php" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> BACK TO CART</a>
                      </div>
                    </div>
                  </div>  

      
        </div>



      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->

  <div>


<Script> 
  $(function() { 

    $('#ordertype').change(function(){
        $('.selectedordertype').hide();
        $('#' + $(this).val()).show();
        $('#ordertypeselected').val($(this).val());

    });

});
</Script>


<?php include 'foot.php' ?>