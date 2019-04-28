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
            Update User Account
          </div>
          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">

                	<div class="row">
                      <div class="col-md-12">
                      <?php  
              $qry = mysqli_query($connection, "select * from customer_view where customerid = '" . $_GET['customerid']. "'");
              $result = mysqli_fetch_assoc($qry);
            ?>
            <p class="caption">Update the account information of <b><?php echo $result['fullname']; ?></b>.  </p>
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
                      <input required="" name="middlename" type="text" class="form-control" value="<?php echo $result['middlename']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input required="" name="lastname" type="text" class="form-control" value="<?php echo $result['lastname']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <input required="" name="address" type="text" class="form-control" value="<?php echo $result['address']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-10">
                      <input required="" name="emailaddress" type="email" class="form-control" value="<?php echo $result['emailaddress']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Number</label>
                    <div class="col-sm-10">
                      <input required="" name="contactnumber" type="text" class="form-control" value="<?php echo $result['contactnumber']; ?>">
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input required="" name="username" type="text" class="form-control" value="<?php echo $result['username']; ?>" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input required="" name="password" type="password" class="form-control" value="<?php echo $result['password']; ?>" disabled>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-md-12 text-right">
                  		 <input type="text" name="customerid" hidden value="<?php echo $result['customerid']; ?>">
                        <input type="text" name="sourcepage" hidden value="update-customer">
                  		<button type="button" class="btn btn-primary align-right" data-toggle="modal" data-target="#updatecustomermodal">Submit</button>
                  	</div>	
                  </div>

                  <!-- modal start -->
                        <div id="updatecustomermodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm update customer.</p>
                                
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
    