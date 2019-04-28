<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-customer";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Reports</div>
          <div class="sub-title">List of Customer</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            Customers
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
          <a href="print/print-view-customer.php" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>Customer ID</th>
                  <th>Full Name</th>
                  <th>Address</th>
                  <th>Email Address</th>
                  <th>Contact Number</th>
                  <th>Status</th>
                  <th>Username</th>
                  <th >Action</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from customer_view where isdeleted = 0");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['customerid']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php echo $result['address']; ?></td>
                  <td><?php echo $result['emailaddress']; ?></td>
                  <td><?php echo $result['contactnumber']; ?></td>
                  <td><?php if ($result['isactivated'] == 1)
                  {
                    echo "Activated";
                  }else {
                    echo "Not Activated";
                  }?></td>
                  <td><?php echo $result['username']; ?></td>
                  <td class="text-center">

                  <a href="change-customer-password.php?customerid=<?php echo $result['customerid']; ?>"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change password">Change password</button></a>


                  <a href="update-customer.php?customerid=<?php echo $result['customerid']; ?>"><button class="btn btn-info  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Update information">Update information</button></a>

                <!--   <a href="delete-customer.php?customerid=<?php echo $result['customerid']; ?>&sourcepage=view-customer&who=<?php echo $result['fullname']; ?>&whattodo=delete" onclick="return confirm('Do you wish to delete the account of <?php echo $result['fullname']; ?>?');"><button class="btn btn-warning  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Delete account">Delete account</button></a> -->
                  
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
    