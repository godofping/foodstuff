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
      <?php 
      $qry = mysqli_query($connection, "select * from review_view where reviewid = '" . $_GET['reviewid'] . "'");
 
      $result = mysqli_fetch_assoc($qry);

       ?>
      <div class="container">

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel pink center">

                          <h2 style="color:white;"><?php echo $result['reviewtitle']; ?></h2>
                          <h5 style="color:white;"><?php echo $result['comment']; ?></h5>
                         <div class="row">
                                <div class="col s12 right-align">
                                
                                   <a href="review.php?customerid=<?php echo $_GET['customerid']; ?>&button=my-reviews" class="btn green">BACK</a>
                                </div>
                            </div>
                        </div>   
                     </div>
                   </div> 

         </div>


        <?php 
        $qry = mysqli_query($connection, "select * from review_conversation_table where reviewid = '" . $_GET['reviewid'] . "'");
            while ($result = mysqli_fetch_assoc($qry)) {
        ?>

        <div class="container">

                <?php if (empty($result['userid'])) { ?>
                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel black center">
                          <h5 style="color: white; text-align: left;"><?php echo $result['message']; ?></h5>
                          <h6 style="color: white;text-align: left;"><?php
                    $qry1 = mysqli_query($connection, "select * from customer_view where customerid = '" . $result['customerid'] . "'");
                    $result1 = mysqli_fetch_assoc($qry1);
                     echo "You" ?>, <?php echo $result['datetime']; ?></h6>
                        </div>   
                     </div>
                   </div> 
                  <?php } else { ?>
                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel brown center">
                          <h5 style="color: white; text-align: left;"><?php echo $result['message']; ?></h5>
                          <h6 style="color: white;text-align: left;"><?php
                    $qry1 = mysqli_query($connection, "select * from user_view where userid = '" . $result['userid'] . "'");
                    $result1 = mysqli_fetch_assoc($qry1);
                     echo $result1['fullname']; ?>, <?php echo $result['datetime']; ?></h6>
                        </div>   
                     </div>
                   </div> 
                  <?php } ?>

         </div>

        <?php } ?>
                 
       </div>
       <div class="container" style="padding-bottom: 250px;">
       <form method="POST" action="controller.php">
         <div class="input-field col s12">
            <textarea id="message" name="message" required="" class="materialize-textarea" style="height: 23px;"></textarea>
            <label for="message" class="">Message</label>
        </div>
        <input type="text" hidden="" name="reviewid" value="<?php echo $_GET['reviewid'] ?>">
        <input type="text" hidden="" name="customerid" value="<?php echo $_GET['customerid'] ?>">
        <input type="text" hidden="" name="sourcepage" value="my-conversations">

        <button type="submit" class="waves-effect waves-light  btn" href="">Submit Message</button>
        
       </form>
      </div>
      
        <!--end container-->
      </section>
                 


     

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>