      
<div id="displaynotification"></div>
       <!-- Footer -->
        <footer id="footer" class="bg-dark dark">
            
            <div class="container">
                <!-- Footer 2nd Row -->
                <div class="footer-second-row row align-items-center">
                    <div class="col-lg-4 text-center text-md-left">
                        <span class="text-sm text-muted">Copyright FoodStuff <?php echo date("Y"); ?> ©.<br>"Good food goes by the name..."</span>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="index.html"><img src="../images/foodstufflogo-transparent background.png" alt="" width="88" class="mt-5 mb-5"></a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center text-md-right">
                       <p>TELEPHONE #: 0642005698 <br> EMAIL ADDRESS: marycristuvilla@yahoo.com</p>
                   
                    </div>
                </div>
            </div>

            <!-- Back To Top -->
            <a href="#" id="back-to-top"><i class="ti ti-angle-up"></i></a>

        </footer>
        <!-- Footer / End -->

    </div>
    <!-- Content / End -->

    <!-- Panel Cart -->
    <div id="panel-cart">
   
            <div class="panel-cart-container">
            <div class="panel-cart-title">
                <h5 class="title">Your Cart <?php if (count($_SESSION['orders']) > 0) { ?>
                    <br><a style="font-size: 17px; padding-left: 3px; color: red;" href="controller.php?sourcepage=emptycart"><small>empty cart</small></a>
                <?php } ?></h5>
                <button class="close" data-toggle="panel-cart"><i class="ti ti-close"></i></button>
            </div>
            <div class="panel-cart-content">
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
        $result = mysqli_fetch_assoc($qry); ?>  
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
                        <div class="col-7 text-right text-muted">Sub Total</div>
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
                        <div class="col-7 text-right text-muted">Total:</div>
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

        <?php if (count($_SESSION['orders']) == 0) { ?>
        <a href="menu.php"  class="panel-cart-action btn btn-secondary btn-block btn-lg"><span>Add item to checkout</span></a>
       <?php } else { ?>
       <a href="checkout.php"  class="panel-cart-action btn btn-secondary btn-block btn-lg"><span>Go to checkout</span></a>
       <?php } ?>



    </div>

    <!-- Panel Mobile -->
    <nav id="panel-mobile">
        <div class="module module-logo bg-dark dark">
            <a href="#">
                <img src="../images/foodstufflogo-transparent background.png" alt="" width="150">
            </a>
            <button class="close" data-toggle="panel-mobile"><i class="ti ti-close"></i></button>
        </div>
        <nav class="module module-navigation"></nav>

    </nav>

    <!-- Body Overlay -->
    <div id="body-overlay"></div>

</div>

                                <!-- start cart modal -->
                            <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { 

                                $stringbuttonvalue = "ADD TO CART";
                                $arraylength =  count($_SESSION["orders"]);
                                $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid');
                                $existing = "false";
                                $qtyvalue = 1;
                                $instructionvalue = "";
                      

                                for ($i=0; $i < $arraylength; $i++) { 
                                     if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                        $existing = "true";
                                     }
                                }if ($existing == "true") { 
                                    $qtyvalue = $_SESSION['orders'][$result1['menuitemid']]['quantity'];
                                    $instructionvalue = $_SESSION['orders'][$result1['menuitemid']]['instruction'];
                                    $stringbuttonvalue = "UPDATE CART";

                                }?>




                                 <form method="POST" action ="controller.php">
                                <!-- Modal / Product -->
                                <div class="modal fade" id="productModal<?php echo $result1['menuitemid']; ?>" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-lg dark bg-dark">
                                                <div class="bg-image"><img src="assets/img/photos/modal-add.jpg" alt=""></div>
                                                <h4 class="modal-title">Specify your dish</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
                                            </div>
                                            <div class="modal-product-details">
                                                <div class="row align-items-center">
                                                    <div class="col-9">
                                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                                        <span class="text-muted">Specify your order here.</span>
                                                    </div>
                                                    <div class="col-3 text-lg text-right">&#8369;<?php echo number_format($result1['price'],2); ?></div>
                                                </div>
                                            </div>
                                            <div class="modal-body panel-details-container">
                                                <!-- Panel Details / Size -->
                                                <div class="panel-details">
                                                    <h5 class="panel-details-title">
                                                    Quantity
                                                    </h5>
                                                    <div id="panelDetailsOther" class="collapse show">
                                                        <input class="form-control" required="" name="quantity" type="number" min=1 value="<?php echo $qtyvalue; ?>" max="<?php 
                                              if ($result1['menucategoryid'] == 7) {
                                                  $qry2 = mysqli_query($connection, "select * from goodies_inventory_table where menuitemid = '" . $result1['menuitemid'] . "' and date = '" . date("Y-m-d") . "'");
                                              $result2 = mysqli_fetch_assoc($qry2);
                                              $qry3 = mysqli_query($connection, "SELECT * FROM goodies_quantity_sold_view WHERE orderdate LIKE '%" . date('Y-m-d') . "%' and menuitemid = '" . $result1['menuitemid'] . "'");
                                              $result3 = mysqli_fetch_assoc($qry3);
                                              
                                              echo $result2['beg'] - $result3['sold'];
                                              }
                                              
                                              ?>">
                                                    </div>
                                                  
                                                </div>

                                                <!-- Panel Special Instruction -->
                                                <div class="panel-details">
                                                    <h5 class="panel-details-title">
                                                    Special Instruction
                                                    </h5>
                                                    <div id="panelDetailsOther" class="collapse show">
                                                        <textarea name="specialinstruction" id="specialinstruction" cols="30" rows="4" class="form-control" placeholder="Write here your special instructions..."><?php echo $instructionvalue; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" name="menuitemid" hidden="" value="<?php echo $result1['menuitemid']; ?>">
                                            <input type="text" name="sourcepage" hidden="" value="cart">
                                            <button type="submit" class="modal-btn btn btn-secondary btn-block btn-lg" ><span><?php echo $stringbuttonvalue; ?></span></button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            <?php } ?>

                                <!-- end cart modal -->


<!-- JS Plugins -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/plugins/tether/dist/js/tether.min.js"></script>
<script src="assets/plugins/jquery/src/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/plugins/slick-carousel/slick/slick.min.js"></script>
<script src="assets/plugins/jquery.appear/jquery.appear.js"></script>
<script src="assets/plugins/jquery.scrollto/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/jquery.localscroll/jquery.localScroll.min.js"></script>
<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js"></script>
<script src="assets/plugins/twitter-fetcher/js/twitterFetcher_min.js"></script>
<script src="assets/plugins/skrollr/dist/skrollr.min.js"></script>
<script src="assets/plugins/animsition/dist/js/animsition.min.js"></script>

<!-- JS Core -->
<script src="assets/js/core.js"></script>



<?php if (isset($_SESSION['customerid'])): ?>

<?php
include_once("../connection.php");


$qry = mysqli_query($connection, "SELECT * FROM order_table WHERE isseenbycusomter = 0 and customerid = '" . $_SESSION['customerid'] . "' and isapproved != 0");


while($result = mysqli_fetch_assoc($qry))
{


?>


<script type="text/javascript">
            if ("Notification" in window) {
              let ask = Notification.requestPermission();
              ask.then (permission => 
              {
                if (permission === "granted") {
                  let msg = new Notification("New Notification!", {
                    body: "Order id <?php echo $result['orderid']; ?> is <?php   if ($result['isapproved'] == 0) {
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
                  } ?>",
                    icon: "../images/foodstufflogo.jpg"
                  });
                  msg.addEventListener("click", event =>
                  {
                    window.open("orders.php");
                  });
                }
              });
            }
</script>

<?php
   mysqli_query($connection, "update order_table set isseenbycusomter = 1 where orderid = '" . $result['orderid'] . "'");

 } ?>



<?php endif ?>
    




</body>

</html>