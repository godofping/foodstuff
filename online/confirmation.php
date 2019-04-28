<?php include('head.php'); 
$_SESSION['currentpage'] = "checkout";
$qry = mysqli_query($connection, "select * from order_view where orderid = '" . $_GET['orderid'] . "'");
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
                        <h1 style="color: white;" class="mb-0">Checkout</h1>
                        <h4 class="text-muted mb-0">Select date and time of pickup</h4>
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
                        <h1 class="mb-2">Thank you for your order!</h1>
                        <h4 class="text-muted mb-5">You 

                        <?php if ($result['ordertype'] == 1): ?>
                           have 1 hour starting from now to cancel your order # <?php echo $_GET['orderid']; ?>.</h4>
                        <?php endif ?> 

                        <?php if ($result['ordertype'] == 2): ?>
                           can cancel your order # <?php echo $_GET['orderid']; ?> within this day only.</h4>
                        <?php endif ?> 

                         
                        <a href="index.php" class="btn btn-outline-secondary"><span>Go back to menu</span></a>
                    </div>
                </div>
            </div>
        </section>


       </div>



    

 <?php include('footer.php'); ?>
