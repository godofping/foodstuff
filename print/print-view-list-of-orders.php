<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>List of Orders (<?php echo $_GET['date']; ?>)</h1>
	<table align="center" border="1px;">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Orders</th>
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
              if (isset($_GET['date'])) {
              $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . $_GET['date'] . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");
        
              }
              else
              {
              $qry = mysqli_query($connection,"select * from order_view where (isapproved != 0 OR isapproved != 2 OR isapproved != 3) and datetimeofpickup like '%" . date('Y-m-d') . "%' and isdeleted = 0 ORDER BY datetimeofpickup ASC;");
              }

              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['orderid']; ?></td>
                  <td><?php echo $result['customerfullname']; ?></td>
                  <td><?php $qry1 = mysqli_query($connection, "select * from cart_items_view where orderid = '" . $result['orderid'] . "'");
                    
                    while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                    <li><?php echo $result1['menuitemname'] . ", QTY:" . $result1['quantity']; ?></li>
                    <?php } ?>
                    <br></td>
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



</body>
</html>