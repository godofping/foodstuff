<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "add-user";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">User Module</div>
          <div class="sub-title">Add User</div>
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
                      <?php if (isset($_GET['status']) and $_GET['status']=='failed'): ?>
                        <div class="alert alert-danger">
                        The username "<?php echo $_GET['username']; ?>" is already taken.
                        </div>
                        

                      <?php endif ?>

                      <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                

                        <div class="alert alert-success">
                           The account of "<?php echo $_GET['who']; ?>" is succesfully created.
                        </div>

                      <?php endif ?>
                      </div>
                    </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                      <input required="" name="firstname" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Middle Name</label>
                    <div class="col-sm-10">
                      <input required="" name="middlename" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input required="" name="lastname" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-2 control-label">User Level</label>
                  <div class="col-sm-10">
                      <select class="form-control" style="width: 100%;" required="" name="userlevel">                
                        <option value="1">Admin/Owner</option>
                        <option value="2">Secretary</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input required="" name="username" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input required="" name="password" type="password" class="form-control">
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-md-12 text-right">
                  		<input type="text" name="sourcepage" value="add-user" hidden="">
                  		<button type="button" class="btn btn-primary align-right" data-toggle="modal" data-target="#addusermodal">Submit</button>
                  	</div>	
                  </div>

                  <!-- modal start -->
                        <div id="addusermodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm add user.</p>
                                
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
    