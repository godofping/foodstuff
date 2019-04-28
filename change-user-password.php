<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "add-user";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">User Module</div>
          <div class="sub-title">...</div>
        </div>
        <div class="card bg-white">
          <div class="card-header">
            Create User Account
          </div>
          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">

                	<div class="row">
                      <div class="col-md-12">
                      <?php  
          		$qry = mysqli_query($connection, "select * from user_view where userid = '" . $_GET['userid']. "'");
          		$result = mysqli_fetch_assoc($qry);
          	?>
            <p class="caption">Update the password of <b><?php echo $result['fullname']; ?></b> account.  </p>
                      </div>
                    </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input name="newpassword" type="password" class="form-control" required="">
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-md-12 text-right">
                  		<input type="text" name="userid" hidden value="<?php echo $_GET['userid']; ?>">
                  		<input type="text" name="sourcepage" value="change-user-password" hidden="">
                  		<button type="button" class="btn btn-primary align-right" data-toggle="modal" data-target="#updatepasswordmodal">Submit</button>
                  	</div>	
                  </div>

                  <!-- modal start -->
                        <div id="updatepasswordmodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm update password.</p>
                                
                              </div>
                              <div class="modal-footer no-border">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- end modal -->

                </form>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <!-- /main area -->

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    