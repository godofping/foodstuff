<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>Goodies Inventory (<?php echo $_GET['date']; ?>)</h1>
	<table align="center" border="1px;">
              <thead>
                <tr>
                  <th>Menu Item Name</th>
                  <th>BEG</th>
                  <th>DEL</th>
                  <th>REM</th>
                  <th>SOLD</th>
                  <th>END</th>

                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from goodies_inventory_view where date = '" . $_GET['date'] . "'");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['menuitemname']; ?></td>
                  <td><?php echo $result['beg']; ?></td>
                  <td><span style="float: left;"><?php echo $result['del']; ?></span> 
                  <?php if ($result['del'] == 0 and date('Y-m-d') == $_GET['date']): ?>

                  <?php endif ?>
                  <?php if ($result['del'] > 0): ?>
                
                  <?php endif ?>
                  <?php 
                  $qry1 = mysqli_query($connection, "select * from goodies_quantity_sold_view where orderdate like '%" . $_GET['date'] . "%' and menuitemid = '" . $result['menuitemid'] . "'");
                 
                  $result1 = mysqli_fetch_assoc($qry1);
                   ?>

                  <td><?php echo ($result['beg'] + $result['del']) - $result1['sold']; ?></td></td>
                  <td><?php if (is_null($result1['sold'])) {
                   echo "0";
                  } else { echo $result1['sold']; } ?></td>
                  <td><?php echo $result['end']; ?></td>

                </tr>

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>