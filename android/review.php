<?php 
include '../connection.php';
include 'head.php';

if (!isset($_SESSION['customerid'])) {
  $_SESSION['customerid'] = $_GET['customerid'];
}
?>
  

    <!-- START WRAPPER -->
    <div class="wrapper">
      <div style="margin-top: 60px;"></div>

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->

      <div class="container">

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel blue center">
                        
                          <h2 style="color:white;">Review</h2>
                          <?php if (isset($_GET['button']) and $_GET['button'] == 'write-review'): ?>
                            <h5 style="color:white;">Write Review</h5>
                            <div class="row">
                                <div class="col s12 right-align">
                                   <a href="review.php?customerid=<?php echo $_GET['customerid']; ?>" class="btn green">BACK</a>
                                </div>
                            </div>
                          <?php endif ?>
                          <?php if (isset($_GET['button']) and $_GET['button'] == 'my-reviews'): ?>
                              <h5 style="color:white;">List of my reviews</h5>
                            <div class="row">
                                <div class="col s12 right-align">
                                   <a href="review.php?customerid=<?php echo $_GET['customerid']; ?>" class="btn green">BACK</a>
                                </div>
                            </div>
                          <?php endif ?>
                        </div>   
                     </div>
                   </div> 

         </div>


                  <?php if (!isset($_GET['button'])): ?>
                    <div style="padding-left: 40px; padding-right: 40px;">
                    <div class="row">
                     <div class="col s12">
                     
                        <a href="review.php?customerid=<?php echo $_GET['customerid']; ?>&button=write-review">
                          <div class="card-panel green center">
                         
                          <h5 style="color:white;">Write Review</h5>
                          
                        </div>  
                        </a> 
                     </div>
                   </div>

                   <div class="row">
                     <div class="col s12">
                     
                        <a href="review.php?customerid=<?php echo $_GET['customerid']; ?>&button=my-reviews">
                          <div class="card-panel green center">
                        
                          <h5 style="color:white;">My Reviews</h5>
                          
                        </div>  
                        </a> 
                     </div>
                   </div>
                  </div>
                  <?php endif ?>

                  <?php if (isset($_GET['button']) and $_GET['button'] == "my-reviews"): ?>

                    <div class="row" style="padding-left: 12px;padding-right: 12px;">
                      <div class="col s12">
                        <ul class="collection">
                    <?php 
                        $qry = mysqli_query($connection, "select * from review_table where customerid = '" . $_SESSION['customerid'] . "'");
                        while ($result = mysqli_fetch_assoc($qry)) { ?>
                          <li class="collection-item"><span style="font-weight: bold;" class="title"><?php echo $result['reviewtitle']; ?></span>
                    <p><?php echo $result['comment']; ?>
                      
                      <br>Date: <?php echo $result['reviewdate']; ?>
                      <br>
                      <br>
                      <a href="my-conversations.php?reviewid=<?php echo $result['reviewid']; ?>&customerid=<?php echo $_GET['customerid']; ?>"><button class="btn btn-outline-secondary btn-sm"><span>View Conversations</span></button></a>
                      

                    </p>
                  </li>
                                    
                           


                         <?php } ?>
                      </ul>
                      </div>
                    </div>
                  <?php endif ?>


                  <?php if (isset($_GET['button']) and $_GET['button'] == "write-review"): ?>
                    <section id="content" style="height: 100vh;">
      <div style="margin-top: 100px;"></div>
        <!--start container-->
        <div class="container" style="padding-left: 20px;padding-right: 20px;">
        <div class="row">
                    <div class="col s12">

                      <?php if (isset($_GET['status']) and $_GET['status']=='success'): ?>
                        <p>The review is submitted succesfully.</p>
                      <?php endif ?>

                      

                    </div>

                      
                    </div>
            <div class="row">
                      <form action="controller.php" method="POST" class="col s12">
                        <div class="row">
                          <div class="input-field col s12">
                            <input required="" name="reviewtitle" id="reviewtitle" type="text">
                            <label for="reviewtitle">Title</label>
                          </div>
                        </div>

                       <div class="row">
                          <div class="input-field col s12">
                            <textarea required="" name="comment" id="comment" class="materialize-textarea"></textarea>
                            <label for="comment">Review</label>
                          </div>
                        </div>
                       
                        <div class="center-align">
                          <a href="#submitreviewmodal" class="btn cyan waves-effect waves-light right modal-trigger" >SUBMIT REVIEW</a>
                          
                        </div>

                        <div id="submitreviewmodal" class="modal">
                                <div class="modal-content">
                                  <p style="text-align: left;">Confirm submit review.</p>

                                </div>
                                <input type="text" name="sourcepage" hidden value="android-review">
                                <input type="text" name="customerid" hidden value="<?php echo $_GET['customerid']; ?>">
                              <div class="modal-footer">
                                  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                  <button class="waves-effect waves-green btn-flat modal-action modal-close" type="submit" name="action">SUBMIT</button>
                              </div> 

                              </div>
                           
       
                        
                      </form>
                  
                    </div>


      
        <!--end container-->
      </section>
                  <?php endif ?>


     

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>