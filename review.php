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
                        <h1 style="color: white;" class="mb-0">Review</h1>
                        <h4 class="text-muted mb-0">Write a review to us</h4>
                    </div>
                </div>
            </div>
        </div>

   

         <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-8">

                    <?php if (isset($_GET['status']) and $_GET['status'] == 'success') { ?>
                    <h2>Feedback is submitted.</h2>
                       
                    <?php } else { ?>
                    <form action="controller.php" method="POST">
     
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" required="" class="form-control" name="reviewtitle">
                      </div>

                      <div class="form-group">
                        <label>Review</label>
                        <textarea rows="5" required="" class="form-control" name="comment"></textarea> 
                      </div>
                      <br>
                      <input type="text" name="sourcepage" hidden value="review">
                        <button type="submit" class="btn btn-outline-secondary"  onclick="return confirm('Confirm send review or feedback');"><span>Submit Review</span></button>
                      
                    </form>
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>


        <div style="padding-top: 100px;"></div>
    

 <?php include('footer.php'); ?>
