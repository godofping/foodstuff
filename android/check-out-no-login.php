<?php 
include '../connection.php';
include 'head.php';
$hasbilao = "false";
$_SESSION['uncontinuecheckout'] = "true";


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
                        <h5>Login first to checkout</h5>
                		<p>Please login to proceed</p>

        				<div class="row">
				            <div class="col s12" style="text-align: center;">
				              <a href="login-page.php" class="waves-effect waves-light blue btn">LOGIN</a>
				            </div>
			         	</div>

			         	<p>No account?</p>
                		
        				<div class="row">
				            <div class="col s12" style="text-align: center; padding-bottom: 20px;">
				              <a href="create-account.php" class="waves-effect waves-light green btn">REGISTER HERE!</a>
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