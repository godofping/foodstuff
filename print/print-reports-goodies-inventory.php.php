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
                  <?php if ($result['del'] == 0 and date('Y-m-d') == $date): ?>


              


                  <?php endif ?>
                  <?php if ($result['del'] > 0): ?>
                    <button style="float: right;" data-toggle="modal" data-target="#editdelmodal<?php echo $result['inventoryid']; ?>" class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Edit del"><i class="icon-pencil"></i></button>
                  <?php endif ?>
                  </td>
                  <td><?php echo $result['end']; ?></td>

                </tr>

                <!-- start modal -->
      <div class="modal bs-modal-sm" id="adddelmodal<?php echo $result['inventoryid']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Number of stocks delivered</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="number" required="" value="<?php echo $result['del']; ?>" name="del" min="0" max="1000">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="reports-add-del" hidden="">
              <input type="text" name="date" value="<?php echo $date; ?>" hidden="">
              <input type="text" name="inventoryid" value="<?php echo $result['inventoryid']; ?>" hidden="">
              <button type="submit" class="btn btn-success" >Ok</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

      <!-- start modal -->
      <div class="modal bs-modal-sm" id="editdelmodal<?php echo $result['inventoryid']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Edit stocks</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="number" required="" value="<?php echo $result['del']; ?>" name="del" min="0" max="1000">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="reports-edit-del" hidden="">
              <input type="text" name="date" value="<?php echo $date; ?>" hidden="">
              <input type="text" name="inventoryid" value="<?php echo $result['inventoryid']; ?>" hidden="">
              <button type="submit" class="btn btn-success" >Ok</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>