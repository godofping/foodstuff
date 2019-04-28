<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "add-user";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">User Module</div>
          <div class="sub-title">View Users</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            User list
          </div>
          <div class="card-block">

          <div class="row">
            <div class="col s12">
              <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>

                          <div class="alert alert-danger">
                          <?php echo $_GET['who']; ?> account is succesfully deleted.
                          </div>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulchangepass'): ?>
                      
                      <div class="alert alert-success">
                        <?php echo $_GET['who']; ?> password is succesfully changed.
                      </div>
                      <br>
              <?php endif ?>

              <?php if (isset($_GET['status']) and $_GET['status']=='successfulupdateaccount'): ?>
                    

                      <div class="alert alert-success">
                       <?php echo $_GET['who']; ?> account is succesfully updated.
                      </div>



                      <br>
              <?php endif ?>
              
              
            </div>                      
          </div>

          <a href="print/print-view-users.php" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Full Name</th>
                  <th>User Level</th>
                  <th>Username</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from user_view where isdeleted = 0");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['userid']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php if ($result['userlevel'] == 1) {
                   echo "Owner/Admin";
                  }else {
                    echo "Secretary";
                  } ?></td>
                  <td><?php echo $result['username']; ?></td>
                  <td class="text-center">

                  <a  href="change-user-password.php?userid=<?php echo $result['userid']; ?>"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change password">Change password</button></a>


                  <a href="update-user.php?userid=<?php echo $result['userid']; ?>"><button class="btn btn-info  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Update information">Update information</button></a>

                  <!-- <a href="controller.php?userid=<?php echo $result['userid']; ?>&sourcepage=view-user&who=<?php echo $result['fullname']; ?>&whattodo=delete" onclick="return confirm('Do you wish to delete the account of <?php echo $result['fullname']; ?>?');"><button class="btn btn-warning  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Delete account">Delete account</button></a> -->
                  
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
    