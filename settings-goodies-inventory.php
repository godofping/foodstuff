<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "settings-goodies-inventory";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Reports</div>
          <div class="sub-title">Goodies Inventory</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
          
          </div>
          <div class="card-block">

          <div class="row">
            <div class="col s12">
              <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> <?php echo $_GET['who']; ?> account is succesfully <b>deleted</b>.</p>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulchangepass'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> <?php echo $_GET['who']; ?> password is succesfully <b>changed</b>.</p>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulupdateaccount'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> <?php echo $_GET['who']; ?> account is succesfully <b>updated</b>.</p>
                      <br>
              <?php endif ?>
              
              
            </div>                      
          </div>

            <h4>Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date("Y-m-d");} echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>

           
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
                  <?php if ($result['del'] == 0 and date('Y-m-d') == $date): ?>


                    <button style="float: right;" data-toggle="modal" data-target="#adddelmodal<?php echo $result['inventoryid']; ?>" class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="add del"><i class="icon-plus"></i></button>


                  <?php endif ?>
                  <?php if ($result['del'] > 0): ?>
                    <button style="float: right;" data-toggle="modal" data-target="#editdelmodal<?php echo $result['inventoryid']; ?>" class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Edit del"><i class="icon-pencil"></i></button>
                  <?php endif ?>
                  </td>
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
              
              <input type="text" name="sourcepage" value="settings-add-del" hidden="">
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
              
              <input type="text" name="sourcepage" value="settings-edit-del" hidden="">
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
          </div>
        </div>
      </div>
      <!-- /main area -->

      <!-- start modal -->
      <div class="modal bs-modal-sm" id="changedatemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Change date to view inventory history</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required="" name="date" max="<?php echo date('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="settings-goodies-inventory" hidden="">
              <button type="submit" class="btn btn-success" >Change</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

      <script type="text/javascript">
        function printData()
        {
           var divToPrint=document.getElementById("datatabletoprint");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }
      </script>

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    