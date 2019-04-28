<?php 
include '../connection.php';
include 'head.php';

?>

    <?php if ($_SESSION['customerid'] != ""): ?>
      <div style="margin-top: 60px;"></div>
    <?php endif ?>


    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container">

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel blue center">
                          <h2 style="color:white;">Menu</h2>
                        </div>   
                     </div>
                   </div> 

        <?php 
        $qry = mysqli_query($connection,"select * from menu_category_table"); 
        while ($result = mysqli_fetch_assoc($qry)) { ?>    
              
                   <div class="row">
                     <div class="col s12">
                     
                        <a href="menu-items.php?menucategoryid=<?php echo $result['menucategoryid']; ?>">
                          <div class="card-panel orange center">
                          <img src="<?php echo $result['imagelocation']; ?>" height="70dp">
                          <h5 style="color:white;"><?php echo $result['menucategoryname']; ?></h5>
                          
                        </div>  
                        </a> 
                     </div>
                   </div>

        <?php } ?>         

      
        </div>

      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>