<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>Menu Item List</h1>
	<table align="center" border="1px;">
            <thead>
                <tr>
                  <th>Menu Item ID</th>
                  <th>Menu Item Name</th>
                  <th>Price</th>
                  <th>Menu Item Category</th>
                  <th style="width: 20px;">Description</th>
       
                  <th>Availability</th>
            
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from menu_item_list_view order by menuitemid");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                    <td><?php echo $result['menuitemid']; ?></td>
                    <td><?php echo $result['menuitemname']; ?></td>
                    <td>&#8369; <?php echo number_format($result['price'],2); ?></td>
                    <td><?php echo $result['menucategoryname']; ?></td>
                    <td style="width: 200px !important;"><?php echo $result['menuitemdescription']; ?></td>
                  
                    <td>
                      <?php 
                      if ($result['isavailable'] == 0) {
                         echo "Available";
                       }
                       else 
                       {
                        echo "Not Available";
                       }
                        ?>
                    </td>
                  
                </tr>

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>