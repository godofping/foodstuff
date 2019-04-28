<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "archives-goodies-inventory";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Archives</div>
          <div class="sub-title">Goodies Inventory</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
          
          </div>
          <div class="card-block">

    
            <h4>Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d');} echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success btn-icon-icon btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>

           <a href="print/print-reports-goodies-inventory.php?a=1&date=<?php echo $date; ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
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
                <input class="form-control" type="date" value="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>" required="" name="date" max="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="arhives-goodies-inventory" hidden="">
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
    