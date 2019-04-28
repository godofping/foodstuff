<?php include('head.php'); 

$_SESSION['currentpage'] = 'profile';

?>
        <!-- Content -->
    <div id="content">

        <!-- Page Title -->
        <div class="page-title bg-dark dark">
            <!-- BG Image -->
            <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 class="mb-0">My Profile</h1>
                        <h4 class="text-muted mb-0">Update profile infromation and change password</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section -->
        <section class="section bg-light">

            <div class="container">
                <div class="row">
                <?php 
                $qry = mysqli_query($connection, "select * from customer_table where customerid = '" . $_SESSION['customerid'] . "'");
                $result = mysqli_fetch_assoc($qry);
                 ?>

                  <form action="controller.php" method="POST">
                    <div class="col-xl-12 ">
                        <div class="bg-white p-4 p-md-5 mb-4">

                        <?php if (isset($_GET['status']) and $_GET['status'] == 'successchangepass'): ?>
                            <h2>Password Changed Succesfully!</h2>
                        <?php endif ?>
                        <?php if (isset($_GET['status']) and $_GET['status'] == 'failedchangepass'): ?>
                            <h2>Old password doesn't match!</h2>
                        <?php endif ?>
                        <?php if (isset($_GET['status']) and $_GET['status'] == 'successupdateprofile'): ?>
                            <h2>Profile Updated Succesfully!</h2>
                        <?php endif ?>
                        
                        
                            <h4 class="border-bottom pb-4"><i class="ti ti-user mr-3 text-primary"></i>Profile information</h4>
                            <div class="row mb-5">
                                <div class="form-group col-sm-4">
                                    <label>First Name:</label>
                                    <input type="text" name="firstname" value="<?php echo $result['firstname']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Middle Name:</label>
                                    <input type="text" name="middlename" value="<?php echo $result['middlename']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Last Name:</label>
                                    <input type="text" name="lastname" value="<?php echo $result['lastname']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Birth Date:</label>
                                    <input type="date" name="birthdate" value="<?php echo $result['birthdate']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Gender:</label>
                                    <div class="select-container">
                                        <select name="gender" required="" class="form-control">
                                            <option selected=""  value="<?php echo $result['gender']; ?>"><?php echo $result['gender']; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $result['address']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>E-mail address:</label>
                                    <input type="email" name="emailaddress" value="<?php echo $result['emailaddress']; ?>" required="" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Contact Number:</label>
                                    <input type="text" name="contactnumber" value="<?php echo $result['contactnumber']; ?>" required="" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Username:</label>
                                    <input type="text" name="username" value="<?php echo $result['username']; ?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                            <input type="text" name="sourcepage" hidden value="update-customer">
                            <button class="btn btn-warning btn-lg"><span>Update Account</span></button>
                        </div>
                        </form>

                        <form action="controller.php" method="POST">
                         <h4 class="border-bottom pb-4"><i class="ti ti-key mr-3 text-primary"></i>Change Password</h4>
                            <div class="row mb-5">
                                <div class="form-group col-sm-6">
                                    <label>Old Password:</label>
                                    <input type="password" name="oldpassword" required="" class="form-control">
                                </div>
                            </div>
                            
                            <div class="row mb-5">
                                <div class="form-group col-sm-6">
                                    <label>New Password:</label>
                                    <input type="password" name="password" required="" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                            <input type="text" name="sourcepage" hidden value="update-password">
                            <button type="submit" class="btn btn-warning btn-lg"><span>Update Password</span></button>
                        </div>
                        </form>

                    
                        </div>
                        
                    </div>
                </div>
            </div>

        </section>



    </div>
    <!-- Content / End -->


            
      


    

 <?php include('footer.php'); ?>
