<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "update-profile";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Profile</div>
          <div class="sub-title">...</div>
        </div>
        <div class="card bg-white">
          <div class="card-header">
            Update User Account
          </div>
          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">

                  <div class="row">
                      <div class="col-md-12">
                      <?php  
              $qry = mysqli_query($connection, "select * from user_view where userid = '" . $_SESSION['userid']. "'");
              $result = mysqli_fetch_assoc($qry);
            ?>
         
            <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
              <div class="alert alert-success">
                  Account is succesfully updated.
                </div>
                    
                    <?php endif ?>
                      </div>
                    </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                      <input required="" name="firstname" type="text" class="form-control" value="<?php echo $result['firstname']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Middle Name</label>
                    <div class="col-sm-10">
                      <input name="middlename" required="" type="text" class="form-control" value="<?php echo $result['middlename']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input name="lastname" required="" type="text" class="form-control" value="<?php echo $result['lastname']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input name="username" required="" type="text" class="form-control" value="<?php echo $result['username']; ?>" disabled>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-md-12 text-right">
                       <input type="text" name="userid" hidden value="<?php echo $result['userid']; ?>">
                        <input type="text" name="sourcepage" hidden value="update-profile">
                      <button type="button" class="btn btn-primary align-right" data-toggle="modal" data-target="#updateprofilemodal">Submit</button>
                    </div>  
                  </div>


                  <!-- modal start -->
                        <div id="updateprofilemodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm update profile.</p>
                                
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

          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">

                  <div class="row">
                      <div class="col-md-12">
                      <?php  
              $qry = mysqli_query($connection, "select * from user_view where userid = '" . $_SESSION['userid']. "'");
              $result = mysqli_fetch_assoc($qry);
            ?>
         
                    <?php if (isset($_GET['status']) and $_GET['status']=='successfulpassword'): ?>
                   
                      <div class="alert alert-success">
                        Password is succesfully updated.
                      </div>
                    <?php endif ?>


                    <?php if (isset($_GET['status']) and $_GET['status']=='failedpassword'): ?>
                     
                      <div class="alert alert-danger">
                      Password is unsuccesfully updated. Old password doesn't match.
                      </div>
                    <?php endif ?>

                      </div>
                    </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">Old Password</label>
                    <div class="col-sm-10">
                      <input name="oldpassword" type="password" class="form-control" required="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input name="newpassword" type="password" class="form-control" required="" >
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 text-right">
                       <input type="text" name="userid" hidden value="<?php echo $result['userid']; ?>">
                        <input type="text" name="sourcepage" hidden value="change-profile-password">
                      

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
    