<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "view-review";
if (isset($_GET['a'])) {
  $_SESSION['page'] = "archives-view-review";
}
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title"><?php if (isset($_GET['a'])): ?>
            Archives
          <?php endif ?>
            <?php if (!isset($_GET['a'])): ?>
            Reports
          <?php endif ?>
          </div>
          <div class="sub-title">Reviews</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
            Customer reviews
          </div>
          <div class="card-block">

          <div class="row">
            <div class="col s12">
              <?php if (isset($_GET['status']) and $_GET['status']=='successful'): ?>
                      <p style="color: green;"> <i class="mdi-navigation-check tiny"></i> The review of <?php echo $_GET['who']; ?> is succesfully <b>deleted</b>.</p>
                      <br>
              <?php endif ?> 
              
            </div>                      
          </div>

          <?php if (isset($_GET['a'])): ?>
            <h4>Customer Reviews - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d');} echo $date; ?> <button data-toggle="modal" data-target="#changedatemodal" class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="Change date"><i class="icon-settings"></i></button></h4>
          <?php endif ?>

          <?php if (!isset($_GET['a'])): ?>
            <h4>Customer Reviews - Date: <?php if (isset($_GET['date'])) {
              $date = $_GET['date'];
            } else {$date = date("Y-m-d");} echo $date; ?></h4>
          <?php endif ?>

            <a href="print/print-view-reviews.php?date=<?php echo $date; ?>" target="blank"><button class="btn btn-info btn-sm mr5"  style="margin-bottom: 20px;">Print</button></a>
            <table id="datatabletoprint" class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>Review ID</th>
                  <th>Title</th>
                  <th>Review Date</th>
                  <th>Full Name</th>
                  <th>Comment</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php

              $qry = mysqli_query($connection,"select * from review_view where reviewdate like '%" . $date . "%'");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['reviewid']; ?></td>
                  <td><?php echo $result['reviewtitle']; ?></td>
                  <td><?php echo $result['reviewdate']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php echo $result['comment']; ?></td>
                  <td class="text-center">

                  <a href="view-conversations.php?reviewid=<?php echo $result['reviewid'];?><?php if(isset($_GET['a'])){echo "&a=1";} ?>"><button class="btn btn-success  btn-sm mr5" data-toggle="tooltip" data-placement="top" title="View Conversations">View Conversations</button></a>
                  
                  </td>
                </tr>

              <?php } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /main area -->

      <!-- start modal -->
      <div class="modal bs-modal-sm" id="changedatemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Change date to view inventory history</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="date" value="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>" required="" name="date" max="<?php echo date_create(date('Y-m-d'))->modify('-1 days')->format('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="view-review-archive" hidden="">
              <button type="submit" class="btn btn-success" >Change</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->


      

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    