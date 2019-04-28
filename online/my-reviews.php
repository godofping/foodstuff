<?php include('head.php'); 
$_SESSION['currentpage'] = 'review';?>
    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 style="color: white;" class="mb-0">My Reviews</h1>
                        <h4 class="text-muted mb-0">List of my reviews</h4>
                    </div>
                </div>
            </div>
        </div>

   

         <!-- Page Content -->
        <div class="page-content pt-0 pull-up-30 protrude">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-xl-8 push-xl-2">
                        <div class="menu-category-content" style="padding-top: 90px;">
                        
                        <?php 
                        $qry = mysqli_query($connection, "select * from review_table where customerid = '" . $_SESSION['customerid'] . "'");
                        while ($result = mysqli_fetch_assoc($qry)) { ?>


                                <!-- Menu Item -->
                                    <div class="menu-item menu-list-item">
                                        <div class="row align-items-center">
                                            <div class="col-sm-6 mb-2 mb-sm-0">
                                                <h6 class="mb-0"><?php echo $result['reviewtitle']; ?></h6>
                                                <span class="text-muted text-sm"><?php echo $result['comment']; ?></span>
                                            </div>
                                            <div class="col-sm-6 text-sm-right">
                                                <span class="text-md mr-4"><span class="text-muted">Date:</span> <?php echo $result['reviewdate']; ?></span>
                                                <a href="view-conversations.php?reviewid=<?php echo $result['reviewid']; ?>"><button class="btn btn-outline-secondary btn-sm"><span>View Conversations</span></button></a>
                                            </div>
                                        </div>
                                    </div>
                           


                         <?php } ?>

                          </div>
                 
                 
                       
                    </div>
                </div>
            </div>
        </div>


        <div style="padding-top: 100px;"></div>
    

 <?php include('footer.php'); ?>
