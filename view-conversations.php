<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-review";
if (isset($_GET['a'])) {
$_SESSION['page'] = "archive-view-review";
}
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Reports</div>
          <div class="sub-title">Reviews</div>
        </div>

        <?php 
        $qry = mysqli_query($connection, "select * from review_view where reviewid = '" . $_GET['reviewid'] . "'");
        $result = mysqli_fetch_assoc($qry);

         ?>

        <div class="card bg-white">
          <div class="card-header">
            View Conversations
          </div>
          <div class="card-block">
            <p>Title: <?php echo $result['reviewtitle']; ?></p>
            <p>Comment: <?php echo $result['comment']; ?></p>
            <p>Review Date: <?php echo $result['reviewdate']; ?></p>
            <p>By: <?php echo $result['fullname']; ?></p>


            <ul class="message-list">
              
              <?php
              $qry = mysqli_query($connection, "select * from review_conversation_table where reviewid = '" . $result['reviewid'] . "'");
            while ($result = mysqli_fetch_assoc($qry)) {

              if (empty($result['userid'])) { ?>
              <li class="message-list-item">
                <a href="javascript:;">
                  <div class="message-list-item-header">
                    <div class="time"><?php echo $result['datetime']; ?></div>
                    <span><?php
                    $qry1 = mysqli_query($connection, "select * from customer_view where customerid = '" . $result['customerid'] . "'");
                    $result1 = mysqli_fetch_assoc($qry1);
                     echo $result1['fullname']; ?></span>
                  </div>
                  <p><?php echo $result['message']; ?></p>
                </a>
              </li>
              <?php } else {
              ?>
              <li class="message-list-item">
                <a href="javascript:;">
                  <div class="message-list-item-header">
                    <div class="time"><?php echo $result['datetime']; ?></div>
                    <span><?php
                    $qry1 = mysqli_query($connection, "select * from user_view where userid = '" . $result['userid'] . "'");
                    $result1 = mysqli_fetch_assoc($qry1);
                     echo $result1['fullname']; ?></span>
                  </div>
                  <p><?php echo $result['message']; ?></p>
                </a>
              </li>
              <?php }} ?>
            </ul>

            <br>
            <br>

            <form action="controller.php" method="POST">
              <div class="form-group">
              <label class="col-sm-2 control-label">Message</label>
              <div class="col-sm-10">
                <textarea name="message" required="" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <input type="text" hidden="" name="sourcepage" value="view-conversations">
            <input type="text" hidden="" name="reviewid" value="<?php echo $_GET['reviewid']; ?>">

              <div class="text-right">
              <button type="submit" style="margin-top: 30px;" <?php if (isset($_GET['a'])) {
                echo "disabled";
              } ?> class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="" data-original-title="Submit Message" onclick="javascript:return confirm('Confirm submit message')">Submit Message</button>
            </div>
            </form>

            
          </div>
        </div>
      </div>
      <!-- /main area -->



     

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    