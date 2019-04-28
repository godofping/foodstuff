<?php include('head.php'); 
mysqli_query($connection,"update customer_table set isactivated = 1 where customerid = '" . $_GET['customerid'] . "'");
$qry = mysqli_query($connection, "select * from customer_view where customerid = '" . $_GET['customerid'] . "'");
$result = mysqli_fetch_assoc($qry);
?>
    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
         <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 style="color: white;" class="mb-0">Account Activation</h1>
                        <h4 class="text-muted mb-0"></h4>
                    </div>
                </div>
            </div>
        </div>

              <!-- Section -->
        <!-- Section -->
        <section class="section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <span class="icon icon-xl icon-success"><i class="ti ti-check-box"></i></span>
                        <h1 class="mb-2"><b><?php echo $result['fullname']; ?></b>, your account is now activated!</h1>
                        <h4 class="text-muted mb-5">You can now login using your account.</h4>
                        <a href="login.php"><button class="btn btn-info btn-lg"><span>Login here!</span></button></a>
                    </div>
                </div>
            </div>
        </section>


       </div>



    

 <?php include('footer.php'); ?>
