<?php 
include '../connection.php';
include 'head.php';

?>

    <div style="margin-top: 60px;"></div>

    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container">

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel blue center">
                        
                          <h2 style="color:white;">My Profile</h2>
                        </div>   
                     </div>
                   </div> 

                   <div class="card-panel">

            
              <?php 
              $qry = mysqli_query($connection, "select * from customer_table where customerid = '" . $_GET['customerid'] . "'");
             
              $result = mysqli_fetch_assoc($qry);

               ?>
                <div class="row">
                <h5>Profile information</h5>
                     <form action="controller.php" method="POST" class="col s12">
                     <?php if (isset($_GET['status']) and $_GET['status'] == 'successchangepass'): ?>
                            <p>Password Changed Succesfully!</p>
                        <?php endif ?>
                        <?php if (isset($_GET['status']) and $_GET['status'] == 'failedchangepass'): ?>
                            <p>Old password doesn't match! Password update failed.</p>
                        <?php endif ?>
                        <?php if (isset($_GET['status']) and $_GET['status'] == 'successupdateprofile'): ?>
                            <p>Profile Updated Succesfully!</p>
                        <?php endif ?>
                        
                        
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="firstname" id="firstname" type="text" value="<?php echo $result['firstname']; ?>">
                            <label for="firstname">First Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="middlename" id="middlename" type="text" value="<?php echo $result['middlename']; ?>">
                            <label for="middlename">Middle Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="lastname" id="lastname" type="text" value="<?php echo $result['lastname']; ?>">
                            <label for="lastname">Last Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="birthdate" id="birthdate" type="date" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $result['birthdate']; ?>">
                            <label class="active" for="birthdate">Birth Date</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <label class="active" for="gender">Gender</label>
                            <select  required name="gender">
                              <option value="<?php echo $result['gender']; ?>" selected><?php echo $result['gender']; ?></option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="address" id="address" type="text" value="<?php echo $result['address']; ?>">
                            <label for="address">Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input  name="emailaddress" id="emailaddress" type="email" value="<?php echo $result['emailaddress']; ?>" disabled>
                            <label for="emailaddress">Email Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="contactnumber" id="contactnumber" type="text" value="<?php echo $result['contactnumber']; ?>">
                            <label for="contactnumber">Contact Number</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input disabled="" required name="username" id="username" type="text" value="<?php echo $result['username']; ?>">
                            <label for="username">Username</label>
                          </div>
                        </div>

                        
                            
                        <div class="center-align">
                          <a href="#updateaccountmodal" class="btn orange waves-effect waves-light right modal-trigger" >Update Account</a>
                        </div>


                        <div id="updateaccountmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm update profile.</p>

                                </div>
                                 <input type="text" name="customerid" hidden value="<?php echo $_GET['customerid']; ?>">
                                <input type="text" name="sourcepage" hidden value="android-update-customer">
                              <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <button class="waves-effect waves-green btn-flat modal-action modal-close" type="submit" name="action">UPDATE</button>
                              </div> 

                        </div>


                           
                       
                      </form>
                  </div>
                  </div>

    <div class="card-panel" style="margin-bottom: 200px; margin-top: 50px;">
                  <div class="row">
                  <h5>Change Password</h5>
                     <form action="controller.php" method="POST" class="col s12">
                     <div class="row">
                          <div class="input-field col s12">
                            <input required name="oldpassword" id="oldpassword" type="password">
                            <label for="oldpassword">Old Password</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="password" id="password" type="password">
                            <label for="password">New Password</label>
                          </div>
                        </div>

                        <div class="center-align">
                          
                          
                          <a href="#updatepasswordmodal" class="btn orange waves-effect waves-light right modal-trigger" >Update Password</a>
                        </div>


                        <div id="updatepasswordmodal" class="modal">
                            <div class="modal-content">
                              <p style="text-align: left;">Confirm update password.</p>

                            </div>
                             <input type="text" name="customerid" hidden value="<?php echo $_GET['customerid']; ?>">
                            <input type="text" name="sourcepage" hidden value="android-update-password">
                            <div class="modal-footer">
                            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                             
                            <button class="waves-effect waves-green btn-flat modal-action modal-close" type="submit" name="action">Update Password</button>
                              </div> 

                        </div>
                           
                        
                      </form>
                  </div>
     </div>

          
     
              
              
              

       

      
        </div>
             </div>

      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>