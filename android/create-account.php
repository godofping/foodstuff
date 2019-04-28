<?php 
include '../connection.php';
include 'head.php';
?>


    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container" style="padding-left: 20px;padding-right: 20px;">
        <div class="row">
                     <div class="col s12">
                        <div class="card-panel blue center">
                        
                          <h2 style="color:white;">Create Account</h2>
                        </div>   
                     </div>
                   </div> 
          <div class="row">
                    <div class="col s12">

                      <?php if (isset($_GET['status']) and $_GET['status']=='failed'): ?>
                        <p style="color: red;"> <i class="mdi-alert-warning tiny"></i> The username "<?php echo $_GET['username']; ?>" is already <b>taken</b>.</p>
                      <?php endif ?>

                      <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                        <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> Your account is successfully created. Please check your email address to activate your account.</p>
                      <?php endif ?>

                      <?php if (isset($_GET['status']) and $_GET['status']=='failedemailaddresstaken'): ?>
                        <p style="color: red;"> <i class="mdi-alert-warning tiny"></i> The email address "<?php echo $_GET['emailaddress']; ?>" is already <b>taken</b>.</p>
                      <?php endif ?>
                      
                    </div>

                      
            </div>
   <br>
        <div class="card-panel" style="padding-bottom: 150px;">
                      <form action="controller.php" method="POST" class="col s12">
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="firstname" id="firstname" type="text">
                            <label for="firstname">First Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="middlename" id="middlename" type="text">
                            <label for="middlename">Middle Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="lastname" id="lastname" type="text">
                            <label for="lastname">Last Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="birthdate" id="birthdate" type="date" max="<?php echo date("Y-m-d"); ?>">
                            <label class="active" for="birthdate">Birth Date</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <label class="active" for="gender">Gender</label>
                            <select  required name="gender">
                              <option value="" disabled selected>Choose Gender</option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="address" id="address" type="text">
                            <label for="address">Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="emailaddress" id="emailaddress" type="email">
                            <label for="emailaddress">Email Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="contactnumber" id="contactnumber" type="text">
                            <label for="contactnumber">Contact Number</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="username" id="username" type="text">
                            <label for="username">Username</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input required name="password" id="password" type="password">
                            <label for="password">Password</label>
                          </div>
                        </div>
                        
                            
                        <div class="center-align">
                          <br><br>
                          <button class="btn orange waves-effect waves-light right" type="submit" name="action">Create Account</button>
                        </div>
                           
       
                        <input type="text" name="sourcepage" hidden value="android-add-customer">
                      </form>
                    </div>
                    </div>
        </div>
                    <div style="padding-bottom: 20px;"></div>


      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>