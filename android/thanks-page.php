<?php 
include '../connection.php';
include 'head.php';

if (!isset($_SESSION['customerid'])) {
  $_SESSION['customerid'] = $_GET['customerid'];
}
?>
  

    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content" style="height: 100vh;">
      <div style="margin-top: 60px;"></div>
        <!--start container-->
        <div class="container" style="padding-left: 20px;padding-right: 20px;">
        <div class="row">
          <div class="col s12 center-align">
            <div class="card-panel orange">
              <a href="index.php?customerid=<?php echo $_GET['customerid']; ?>" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> MENU CATEGORIES</a>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col m12 center">
            <div class="card-panel blue">
              <h2 style="color: white">Thank you for ordering!</h2>
              <h5 style="color: white">Your Order ID is: <?php echo $_GET['orderid']; ?></h5>
            </div>
          </div>


          
        </div>
        <div class="row">
        <div class="col s12 center-align">
          <div class="card-panel orange">
            <a href="index.php?customerid=<?php echo $_GET['customerid']; ?>" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> MENU CATEGORIES</a>
          </div>
        </div>
      </div>



      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>