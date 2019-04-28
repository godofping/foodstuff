<?php 
include '../connection.php';
include 'head.php';
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
                 <!--  <div class="row">
                    <div class="col s12 center-align">
                      <div class="card-panel orange" style="padding-bottom: 10px; padding-top: 10px; margin-bottom:1vh;">
                        <a href="home.php" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> ADD MORE</a>
                      </div>
                    </div>
                  </div> -->
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
                          <h4 style="color:white;">CART</h4>
                          

                          <?php if ($arraylength > 0): ?>
                            <p style="color:white;">Click save icon to update the cart.</p>
                          <?php endif ?>

                          <?php if ($arraylength == 0): ?>
                            <p style="color:white;">Please add more items to proceed in check out.</p>
                          <?php endif ?>


                          <h5 style="color: white; font-size: 20px; text-align: left;"> Total Amount: &#8369; <span id="totalprice"><?php
                          if (isset($_SESSION['orders'])) {
                            echo $displaytotalprice;
                          }
                            ?></span></h5>
                          <br>
                          <br>
                            <?php if ($arraylength > 0): ?>
                              <div class="row">
                              <div class="col s6 left-align">
                                <a href="#emptycartmodal" class="btn red modal-trigger">MTY CART</a>
                              </div>

                              <div id="emptycartmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm empty the cart.</p>

                                </div>
                                <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <a href="empty-cart.php" class="waves-effect waves-red btn-flat modal-action modal-close">EMPTY</a>
                                  
                                </div>
                              </div>  


                              <div class="col s6 right-align">
                                <a href="#checkoutmodal" class="btn green modal-trigger">CHECK OUT</a>
                              </div>

                              <div id="checkoutmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm check out.</p>

                                </div>
                                <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <a href="check-out.php" class="waves-effect waves-red btn-flat modal-action modal-close">CHECK OUT</a>
                                  
                                </div>
                              </div> 





                            </div>
                            <?php endif ?>
                        </div>   
                     </div>
                   </div> 

        <?php
        if (isset($_SESSION['orders'])) {
        
        
        for($i = 0; $i < $arraylength; $i++) {
        $qry = mysqli_query($connection,"select * from menu_item_list_view where menuitemid = '" . $menuitemidvalues[$i] . "'");
        $result = mysqli_fetch_assoc($qry); ?>    
              
                   <div class="row">
                     <div class="col s12">
                       
                        <div class="card-panel white center">
                        <form method = "POST" action = "save-instruction.php">
                          <div class="row">
                         
                            <div class="col s10">
                            <div class="row">
                            
                              <div class="col s2">
                                <input min="1" <?php 
                                if ($result['menucategoryid'] == 7) {?>
                                  max="<?php 
                                              $qry2 = mysqli_query($connection, "select * from goodies_inventory_table where menuitemid = '" . $result['menuitemid'] . "' and date = '" . date("Y-m-d") . "'");
                                              $result2 = mysqli_fetch_assoc($qry2);
                                              $qry3 = mysqli_query($connection, "SELECT * FROM goodies_quantity_sold_view WHERE orderdate LIKE '%" . date('Y-m-d') . "%' and menuitemid = '" . $result['menuitemid'] . "'");
                                              $result3 = mysqli_fetch_assoc($qry3);
                                              


                                              echo $result2['beg'] - $result3['sold'];
                                              ?>"
                                <?php }
                                 ?> onkeydown="calculate<?php echo $i; ?>()" onkeyup="calculate<?php echo $i; ?>()" onchange="calculate<?php echo $i; ?>()" id="quantity<?php echo $i; ?>" name="quantity" type="number" class="validate" value="<?php echo $_SESSION['orders'][$menuitemidvalues[$i]]['quantity']; ?>">
                              </div>
                             
                              <div class="col s10">
                                <h6 style="color:black; text-align: left;">x <?php echo $result['menuitemname']; ?><br> Type: <?php echo $result['menucategoryname']; ?> <br> <b>&#8369; <span id="result<?php echo $i; ?>"><?php echo number_format($result['price']*$_SESSION['orders'][$menuitemidvalues[$i]]['quantity'],2); ?></span></b></h6>
                              </div>
                              
                            </div>
                               
                        <div class="row">
                          <div class="input-field col s12">
                            <textarea name="specialinstruction" id="specialinstruction" class="materialize-textarea" placeholder="Special instruction"><?php echo $_SESSION['orders'][$result['menuitemid']]['instruction']; ?></textarea>
                            <input type="number" name="menuitemid" value="<?php echo $result['menuitemid']; ?>" hidden>
                          </div>
                        </div>
                            </div>
                            <div class="col s2">
                              <h6>
                                <button type="submit" name="action" class="btn-floating waves-effect waves-light  red darken-2"><i class="mdi-content-save"></i></button>


                                <a href="#modal<?php echo $result['menuitemid']; ?>" class="btn-floating waves-effect waves-light  red darken-2 modal-trigger"><i class="mdi-action-delete"></i></a>

                              </h6>
                               </form>
                            </div>

                          </div>
                          
                        </div>  

                     </div>
                   </div>


                        <div id="modal<?php echo $result['menuitemid']; ?>" class="modal">
                              <div class="modal-content">
                                <p>Confirm remove <?php echo $result['menuitemname']; ?> in the cart.</p>

                              </div>
                              <div class="modal-footer">
                                <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                <a href="delete-cart.php?menuitemid=<?php echo $result['menuitemid']; ?>" class="waves-effect waves-red btn-flat modal-action modal-close">REMOVE</a>
                                
                              </div>
                            </div>  


            
                             <script type="text/javascript">
                                    function calculate<?php echo $i; ?>()
                                    {

                                      
                                      var quantity = document.getElementById("quantity<?php echo $i; ?>").value;
                                      price = quantity * <?php echo $result['price']; ?>;
                                     
                                    
                                      document.getElementById("result<?php echo $i; ?>").textContent = price.toFixed(2);

                                      var totalpriceofitem = 0;
                                 

                                        <?php 
                                        for($a = 0; $a < $arraylength; $a++){
                                          
                                          $qry1 = mysqli_query($connection, "select * from menu_item_table where menuitemid = '" . $menuitemidvalues[$a] . "'");

                                          $result1 = mysqli_fetch_assoc($qry1);


                                        ?>
                                          quantity = document.getElementById("quantity<?php echo $a; ?>").value;

                                          totalpriceofitem += (quantity * <?php echo $result1['price']; ?>);

                                          
                                        <?php
                                        }
                                        ?>
                                     
                                     document.getElementById("totalprice").textContent = totalpriceofitem.toFixed(2);


                                    }
                                  </script>
                          


        <?php } }?>  
              
                  <div class="row">
                    <div class="col s12 center-align">
                      <div class="card-panel orange">
                        <a href="home.php" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> ADD MORE</a>
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

  


<?php include 'foot.php' ?>