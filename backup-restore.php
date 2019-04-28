<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "update-profile";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Settings</div>
          <div class="sub-title">Backup and Restore</div>
        </div>
        <div class="card bg-white">
          <div class="card-header">
            Backup and Restore Module
          </div>
    

          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">
                  <?php if (isset($_GET['status']) and $_GET['status'] == "successbackup"): ?>
                    
                  <?php endif ?>
                  <div class="row">
                      <div class="col-md-12">
                      <?php  
              $qry = mysqli_query($connection, "select * from user_view where userid = '" . $_SESSION['userid']. "'");
              $result = mysqli_fetch_assoc($qry);
            ?>
         
                    <?php if (isset($_GET['status']) and $_GET['status']=='successbackup'): ?>
                   
                      <div class="alert alert-success">
                        Backup created succesfully.
                      </div>
                    <?php endif ?>

                    <?php if (isset($_GET['status']) and $_GET['status']=='successrestore'): ?>
                   
                      <div class="alert alert-success">
                        Backup restored succesfully.
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
                    <label class="col-sm-2 control-label">Backup</label>
                    <div class="col-sm-10">
                      <a href="backup.php"><button type="button" class="btn btn-success">Backup</button></a>

                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Restore</label>
                    <div class="col-sm-10">
                      <a href="restore.php"><button type="button" class="btn btn-info">Restore</button></a>

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
        </div>
       
      </div>
      <!-- /main area -->

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
        