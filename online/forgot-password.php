<?php include('head.php'); 

if (isset($_GET['from']) and $_GET['from'] == 'checkout') {
    $_SESSION['currentpage'] == "checkout";
}

$_SESSION['thispage'] = "login";

?>
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
                                    <h4 class="mb-0">Recover Account</h4>
                                    <?php if (isset($_GET['status']) and $_GET['status'] != 'successfulemailsent'): ?>
                                        <p class="lead text-muted mb-0">Please enter your email address. We'll email the link to reset your password.</p>
                                    <?php endif ?>
                                    
                                </div>
                            </div>
                            <form action="controller.php" method="POST" id="registration-form" data-validate>
                            <div style="text-align: center; margin-top: 50px; margin-bottom: -30px; font-size: 80px;">
                                <?php 
                        if (isset($_GET['status']) and $_GET['status'] == 'emailaddressnotexist')
                        {

                          ?>
                          <p style="text-align: center; padding-top: 5px;">The entered email address does not exist in the system.</p>
                          <?php
                        }

                         ?>
                         <?php 
                        if (isset($_GET['status']) and $_GET['status'] == 'successfulemailsent')
                        {

                          ?>
                          <h3 style="text-align: center; padding-top: 5px; padding-bottom: 40px;">Account password reset link is sent to <?php echo $_GET['emailaddress'] ?></h3>
                          <?php
                        }

                         ?>
                 
                            </div>
                                <?php if (isset($_GET['status']) and $_GET['status'] != 'successfulemailsent'): ?>
                                    <div class="utility-box-content">
                                  

                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="emailaddress" class="form-control" required>
                                    </div>
                         

                                    <input type="text" name="sourcepage" hidden value="forgot-password">
                                 

                                <a href="login.php"><h6 style="padding-top: 10px; margin-bottom: -5px;">Login here.</h6></a>
                                        
                                </div>
                                <?php endif ?>
                                <?php if (isset($_GET['status']) and $_GET['status'] != 'successfulemailsent'): ?>
                                <button class="utility-box-btn btn btn-secondary btn-block btn-lg btn-submit" type="submit">
                                    <span class="description">Submit!</span>
                                    <span class="success">
                                        <svg x="0px" y="0px" viewBox="0 0 32 32"><path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"/></svg>
                                    </span>
                                    <span class="error">Try again...</span>
                                </button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
        </section>
            
      


    

 <?php include('footer.php'); ?>
