<?php include 'connection.php'; 

$date = mysqli_real_escape_string($connection,htmlentities(trim($_POST['date'])));
?>

<h4>Goodies Inventory - Date: <?php echo $date; ?></h4>

            <a href="print/print-reports-goodies-inventory.php?date=<?php if(!isset($_GET['date'])) { echo date('Y-m-d'); }else{ echo $_GET['date'];} ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
            <table id="datatabletoprint" class="table table-bordered datatable">
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
              $qry = mysqli_query($connection,"select * from goodies_inventory_view where date = '" . $date . "'");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['menuitemname']; ?></td>
                  <td><?php echo $result['beg']; ?></td>
                  <td><span style="float: left;"><?php echo $result['del']; ?></span> 
                  <?php 
                  $qry1 = mysqli_query($connection, "select * from goodies_quantity_sold_view where orderdate like '%" . $date . "%' and menuitemid = '" . $result['menuitemid'] . "'");
                 
                  $result1 = mysqli_fetch_assoc($qry1);
                   ?>

                  <td><?php echo ($result['beg'] + $result['del']) - $result1['sold']; ?></td>
                  <td><?php if (is_null($result1['sold'])) {
                   echo "0";
                  } else { echo $result1['sold']; } ?></td>
                 
                  <td><?php echo $result['end']; ?></td>

                </tr>

              <?php } ?>
                
              </tbody>
            </table>

   <script type="text/javascript">
    $('.datatable').dataTable({
      
    });
  </script>