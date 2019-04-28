<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>Bills of Customers (<?php echo $_GET['date']; ?>)</h1>
	<table align="center" border="1px;">
              <thead>
                <tr>
                  <th>Order ID</th>
             
                  <th>Order Date</th>
                  <th>Order Method</th>
                  <th>Status</th>
                  <th>Time and Date of Pick up</th>
                  <th>Customer Name</th>
                  <th>Sub Total</th>
                  <th>VAT</th>
                  <th>Discount (SC)</th>
                  <th>Total Bill</th>
                 

                  <!-- <th>Action</th> -->
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
              $qry = mysqli_query($connection,"select * from order_view where (isapproved = 1 OR isapproved = 3 OR isapproved = 4 or isapproved = 5) and isdeleted = 0 and datetimeofpickup like '%" . $_GET['date'] . "%' ORDER BY datetimeofpickup ASC;");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td>Order ID <?php echo $result['orderid']; ?></td>
                  
                  <?php
                  
                  $totalamount = 0;
                   $qryingettingcartitems = mysqli_query($connection,"select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                    $subtotal = 0;
                   while ( $resultsofcartitems = mysqli_fetch_assoc($qryingettingcartitems)) {
             
                    $totalamount += $resultsofcartitems['subtotal'];

                   
                  } ?>

                  <?php 

                  $qryifsc = mysqli_query($connection, "select * from list_of_senior_citizen_view where customerid = '" . $result['customerid'] . "'");

                  
                  if (mysqli_num_rows($qryifsc) > 0) {
                      
                      $subtotal = $totalamount / 1.12;
                      $discount = $subtotal * 0.20;
                      $displaytotalprice = $subtotal - $discount;
                      $vat = 0;
                  }
                  else
                  {
                    $subtotal = $totalamount / 1.12;
                    $discount = 0;
                    $vat = $totalamount - $subtotal;
                    $displaytotalprice = $totalamount;
                  }

                   ?>
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
                  <td><?php echo $result['datetimeofpickup']; ?></td>
                  <td><?php echo $result['customerfullname']; ?></td>
                  <td>&#8369; <?php echo number_format($subtotal, 2); ?></td>
                  <td>&#8369; <?php echo number_format($vat, 2); ?></td>
                  <td>&#8369; <?php echo number_format($discount, 2); ?></td>
                  <td>&#8369; <?php echo number_format($displaytotalprice, 2); ?></td>
               
              
                </tr>

 

              <?php  $i++; } ?>
                
              </tbody>
            </table>



</body>
</html>