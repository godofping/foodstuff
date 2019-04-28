<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-food";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Settings</div>
          <div class="sub-title">View Foods</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            Foods List
          </div>
          <div class="card-block">

          <div class="row">
            <div class="col s12">

              <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
             
                <div class="alert alert-success">
                <?php echo $_GET['which']; ?> is succesfully deleted from the menu item list.
                </div>


                <br>
              <?php endif ?>

               <?php if (isset($_GET['status']) and $_GET['status']=='successfulupdated'): ?>
            

              <div class="alert alert-success">
              <?php echo $_GET['what']; ?>" is succesfully updated.
              </div>
                <br>
              <?php endif ?>

            </div>                      
          </div>
            <a href="print/print-view-food.php" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>Menu Item ID</th>
                  <th>Menu Item Name</th>
                  <th>Price</th>
                  <th>Menu Item Category</th>
                  <th style="width: 20px;">Description</th>
                  <th>Image</th>
                  <th>Availability</th>
                  <th>Action</th>
                  
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
                    <td class="text-center"><img height="100px" src="<?php echo $result['imagelocation']; ?>"></td>
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
                  <td class="text-center">


                  <a href="update-food.php?menuitemid=<?php echo $result['menuitemid']; ?>"><button class="btn btn-info  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Update information">Update information</button></a>

                  <!-- <a href="controller.php?menuitemid=<?php echo $result['menuitemid']; ?>&sourcepage=view-food&which=<?php echo $result['menuitemname']; ?>&whattodo=delete" onclick="return confirm('Do you wish to delete the item <?php echo $result['menuitemname']; ?>?');"><button class="btn btn-warning  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Delete item">Delete item</button></a> -->

                  <?php if ($result['isavailable'] == 1): ?>
                    <a href="controller.php?menuitemid=<?php echo $result['menuitemid']; ?>&sourcepage=view-food&which=<?php echo $result['menuitemname']; ?>&whattodo=makeavailable" onclick="return confirm('Do you wish to make item <?php echo $result['menuitemname']; ?> to be available?');"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Make available">Make available</button></a>
                  <?php endif ?>

                  <?php if ($result['isavailable'] == 0): ?>
                    <a href="controller.php?menuitemid=<?php echo $result['menuitemid']; ?>&sourcepage=view-food&which=<?php echo $result['menuitemname']; ?>&whattodo=makenotavailable" onclick="return confirm('Do you wish to make item <?php echo $result['menuitemname']; ?> to be not available?');"><button class="btn btn-error  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Make not available">Make not available</button></a>
                  <?php endif ?>

                
                  </td>
                </tr>

              <?php } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /main area -->

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
    