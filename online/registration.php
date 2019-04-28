<?php include('head.php'); ?>
    <!-- Content -->
    <div id="content">
                <!-- Section -->
        <section class="section section-lg bg-dark">

            <!-- Video BG -->
           <!--  <div class="bg-video" data-property="{videoURL:'https://youtu.be/t4gN-iqeY0E', showControls: false, containment:'self',startAt:1,stopAt:39,mute:true,autoPlay:true,loop:true,opacity:0.8,quality:'hd1080'}"></div> -->
            <div class="bg-image bg-video-placeholder zooming"><img src="assets/img/photos/bg-restaurant.jpg" alt=""></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 push-lg-3">
                        <!-- Book a Table -->
                        <div class="utility-box">
                            <div class="utility-box-title bg-dark dark">
                                <div class="bg-image"><img src="assets/img/photos/modal-review.jpg" alt=""></div>
                                <div>
                                    <span class="icon icon-primary"><i class="ti ti-bookmark-alt"></i></span>
                                    <h4 class="mb-0">Registration</h4>
                                    <p class="lead text-muted mb-0">Create account for free.</p>
                                </div>
                            </div>
                            <form action="controller.php" method="POST" id="registration-form" data-validate>
                            <div style="text-align: center; margin-top: 50px; margin-bottom: -30px; font-size: 80px;">

                      <?php if (isset($_GET['status']) and $_GET['status']=='failed'): ?>
                        <p style="color: red;"> <i class="mdi-alert-warning tiny"></i> The username "<?php echo $_GET['username']; ?>" is already <b>taken</b>.</p>
                      <?php endif ?>

                      <?php if (isset($_GET['status']) and $_GET['status']=='emailaddresstaken'): ?>
                        <p style="color: red;"> <i class="mdi-alert-warning tiny"></i> The email address "<?php echo $_GET['emailaddress']; ?>" is already <b>taken</b>.</p>
                      <?php endif ?>


                      <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                        <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> Your account is successfully created. Please check your email for account activation.</p>
                      <?php endif ?>
                            </div>
                                <div class="utility-box-content">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="middlename" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" name="birthdate" class="form-control" required max="<?php echo date("Y-m-d"); ?>">
                                    </div>

                                   
                                   

                                <div class="form-group ">
                                    <label>Gender</label>
                                    <div class="select-container">
                                        <select class="form-control" name="gender" required="">
                                            <option value="" disabled selected>Choose Gender</option>
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                             

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="emailaddress" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="contactnumber" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <input type="text" name="sourcepage" hidden value="registration">
                                 
                                    
                                 
                                </div>
                                <button class="utility-box-btn btn btn-secondary btn-block btn-lg btn-submit" type="submit">
                                    <span class="description">Create Account!</span>
                                    <span class="success">
                                        <svg x="0px" y="0px" viewBox="0 0 32 32"><path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"/></svg>
                                    </span>
                                    <span class="error">Try again...</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
        </section>
            
      


    

 <?php include('footer.php'); ?>
