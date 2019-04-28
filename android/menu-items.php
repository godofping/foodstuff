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

<?php 
        $qry = mysqli_query($connection,"select * from menu_category_table where menucategoryid = '" . $_GET['menucategoryid'] . "'"); 
        $result = mysqli_fetch_assoc($qry);
        ?>

                  <div class="row">
                    <div class="col s12 center-align">
                      <div class="card-panel orange">
                        <a href="home.php" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> MENU CATEGORIES</a>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                     <div class="col s12">
                        <div class="card-panel pink center">
                        <!--   <img src="../<?php echo $result['imagelocation']; ?>" height="100dp"> -->
                          <h4 class="center-align" style="color:white;"><?php echo $result['menucategoryname']; ?></h4>
                        </div>   
                     </div>
                   </div> 

        <?php 
        $qry = mysqli_query($connection,"select * from menu_item_table where menucategoryid = '" . $_GET['menucategoryid'] . "'"); 

        while ($result = mysqli_fetch_assoc($qry)) { ?>    

                   <div class="row">
                     <div class="col s12">
                     
                   
                          <div class="card-panel teal left-align">

                            <div class="row">
                              <div class="col s4">
                                <img class="z-depth-2" src="../<?php echo $result['imagelocation']; ?>" height="120dp">
                                
                              </div>
                              <div class="col s8 right-align">
                                <h5 class="z-depth-2 green" style="color:white; text-align: center;"><?php echo $result['menuitemname']; ?></h5>
                                <span style="font-size: 30px;" class="task-cat blue right-align z-depth-2">&#8369;<?php echo number_format($result['price'],2); ?></span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col s12">
                              <p style="color: white; overflow-x: hidden;"><?php echo $result['menuitemdescription']; ?></p>
                                <?php if ($result['isavailable'] == 0): ?>
                                  <h5 style="color: white;">Available</h5>
                                <?php endif ?>
                                <?php if ($result['isavailable'] == 1): ?>
                                  <h5 style="color: white;">Not Available</h5>
                                <?php endif ?>

                                <?php if ($result['menucategoryid'] == 7): ?>
                                  <h5 style="color: white;">Stocks: <?php 
                                              $qry2 = mysqli_query($connection, "select * from goodies_inventory_table where menuitemid = '" . $result['menuitemid'] . "' and date = '" . date("Y-m-d") . "'");
                                              $result2 = mysqli_fetch_assoc($qry2);
                                              $qry3 = mysqli_query($connection, "SELECT * FROM goodies_quantity_sold_view WHERE orderdate LIKE '%" . date('Y-m-d') . "%' and menuitemid = '" . $result['menuitemid'] . "'");
                                              $result3 = mysqli_fetch_assoc($qry3);
                                              


                                              echo $result2['beg'] - $result3['sold'];
                                              ?></h5>
                                <?php endif ?>
                              </div>
                            </div>

                            <div class="row">
                      
                              <div class="col s12 right-align">

                              <?php if ($result['isavailable'] == 1) { ?>
                              <a href="#" class="waves-effect waves-light btn z-depth-2 grey">add <i class="mdi-action-add-shopping-cart"></i></a>
                               
                              <?php } else { ?>

                              <a href="#modal<?php echo $result['menuitemid']; ?>" class="waves-effect waves-light btn z-depth-2 modal-trigger">add <i class="mdi-action-add-shopping-cart"></i></a>
                              <?php } ?>

                              </div>


                            </div>


                              

                        </div>  
                     
                     </div>
                   </div>

                       <div id="modal<?php echo $result['menuitemid']; ?>" class="modal">
                              <div class="modal-content">
                                <p>Confirm add <?php echo $result['menuitemname']; ?> in the cart.</p>

                              </div>
                              <div class="modal-footer">
                                <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">CANCEL</a>
                                <a href="add-cart.php?menuitemid=<?php echo $result['menuitemid']; ?>&menucategoryid=<?php echo $result['menucategoryid']; ?>" class="waves-effect waves-red btn-flat modal-action modal-close">ADD</a>
                                
                              </div>
                            </div>  

        <?php } ?>  

                <div class="row">
                    <div class="col s12 center-align">
                      <div class="card-panel orange">
                        <a href="home.php" class="btn red waves-effect"><sub><i class="mdi-hardware-keyboard-backspace"></i></sub> MENU CATEGORIES</a>
                      </div>
                    </div>
                  </div>

            <div class="fixed-action-btn">

              <a href="cart.php" class="btn-floating btn-large red waves-effect waves-light btn z-depth-2">

                <i class="mdi-action-shopping-cart"><?php

                 echo "<sup>". count($_SESSION["orders"]) . "</sup>"; ?></i>

              </a>
              
            </div>       

      
        </div>

      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>