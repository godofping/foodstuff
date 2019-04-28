<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()"> 
<h1>FoodStuff Tacurong</h1>
<h5>Address: Lapu-lapu St. Tacurong City <br>
Telephone Number: 0642005698 <br>
Email: marycristuvilla@yahoo.com <br>
Website: www.tacurong-foodstuff.info</h5>
<h1>Receipt</h1>
<div style="text-align: left;">
<?php $qry = mysqli_query($connection, "select * from order_view where orderid = '" . $_GET['orderid'] . "'");
$result = mysqli_fetch_assoc($qry); ?>
<h3>Order ID: <?php echo $result['orderid']; ?></h3>
<h3>Customer Name: <?php echo $result['customerfullname']; ?></h3>
<h3>Ordered Date: <?php echo $result['orderdate']; ?></h3>
<h3>Pickup Date: <?php echo $result['datetimeofpickup']; ?></h3></div>
	<table align="center" border="1px;">
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

                   $qryingettingcartitems = mysqli_query($connection,"select * from cart_items_view where orderid = '" . $_GET['orderid'] . "'");

                  
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

                    $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $_GET['customerid'] . "'");



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



</body>
</html>