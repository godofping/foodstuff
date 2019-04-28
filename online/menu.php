<?php include('head.php'); 
$_SESSION['currentpage'] = 'menu';
?>
    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 style="color: white;" class="mb-0">Menu</h1>
                        <h4 class="text-muted mb-0">List of delicious menu</h4>
                    </div>
                </div>
            </div>
        </div>

         <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-10 push-md-1" role="tablist">
                        <!-- Short Orders -->
                        <div id="ShortOrders" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuShortOrdersContent" data-toggle="collapse" aria-expanded="true">
                                <div class="bg-image"><img src="assets/img/photos/shortorders.jpg" alt=""></div>
                                <h2 class="title">Short Orders</h2>
                            </div>
                            <div id="menuShortOrdersContent" class="menu-category-content padded collapse show">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 1");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>


                                <?php } ?>


                                </div>
                            </div>
                        </div>

                            <!-- Burgers and Sandwiches -->
                        <div id="Burgers" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuBurgersContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/burgers.jpg" alt=""></div>
                                <h2 class="title">Burgers and Sandwiches</h2>
                            </div>
                            <div id="menuBurgersContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 2");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>


                                </div>
                            </div>
                        </div>   

                            <!-- Cakes, Pastries and Desserts -->
                        <div id="CakesPastriesDesserts" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuCakesPastriesDessertsContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/cakes.jpg" alt=""></div>
                                <h2 class="title">Cakes, Pastries and Desserts</h2>
                            </div>
                            <div id="menuCakesPastriesDessertsContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 3");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>


                                </div>
                            </div>
                        </div> 

                         <!-- Refreshments -->
                        <div id="Refreshments" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuRefreshmentsContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/refreshments.jpg" alt=""></div>
                                <h2 class="title">Refreshments</h2>
                            </div>
                            <div id="menuRefreshmentsContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 4");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>


                                </div>
                            </div>
                        </div> 

                         <!-- Beverages -->
                        <div id="Beverages" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuBeveragesContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/beverages.jpg" alt=""></div>
                                <h2 class="title">Beverages</h2>
                            </div>
                            <div id="menuBeveragesContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 5");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>


                                </div>
                            </div>
                        </div>

                        <!-- Bilao -->
                        <div id="Bilao" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuBilaoContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/bilao.jpg" alt=""></div>
                                <h2 class="title">Bilao</h2>
                            </div>
                            <div id="menuBilaoContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 6");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>

                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span></div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) { echo "disabled";} ?>
                                            data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>


                                </div>
                            </div>
                        </div>

                        <!-- Goodies -->
                        <div id="Goodies" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menuGoodiesContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/photos/goodies.jpg" alt=""></div>
                                <h2 class="title">Goodies</h2>
                            </div>
                            <div id="menuGoodiesContent" class="menu-category-content padded collapse">
                                <div class="row gutters-sm">
                                <?php

                                 $qry1 = mysqli_query($connection, "select * from menu_item_list_view where menucategoryid = 7");
                                 while ($result1 = mysqli_fetch_assoc($qry1)) { ?>
                                                                  
                                <div class="col-lg-4 col-6">
                                    <!-- Menu Item -->
                                    <div class="menu-item menu-grid-item">
                                        <img class="mb-4" src="../<?php echo $result1['imagelocation']; ?>" alt="">
                                        <h6 class="mb-0"><?php echo $result1['menuitemname']; ?></h6>
                                        <span class="text-muted text-sm"><?php echo $result1['menuitemdescription']; ?></span>
                                        <?php if ($result1['isavailable'] == 1): ?>
                                            <br><br>
                                            <span style="color:red;" class="text-md">Not Available</span>
                                        <?php endif ?>
                                        <?php if ($result1['isavailable'] == 0): ?>
                                            <br><br>
                                            <span style="color:green;" class="text-md">Available</span>
                                        <?php endif ?>
                                        <div class="row align-items-center mt-4">
                                            <div class="col-sm-6">
                                             <span class="text-md mr-4">

                                             <span class="text-muted">stocks: 

                                             <?php 
                                              $qry2 = mysqli_query($connection, "select * from goodies_inventory_table where menuitemid = '" . $result1['menuitemid'] . "' and date = '" . date("Y-m-d") . "'");
                                              $result2 = mysqli_fetch_assoc($qry2);
                                              $qry3 = mysqli_query($connection, "SELECT * FROM goodies_quantity_sold_view WHERE orderdate LIKE '%" . date('Y-m-d') . "%' and menuitemid = '" . $result1['menuitemid'] . "'");
                                              $result3 = mysqli_fetch_assoc($qry3);
                                              


                                              echo $result2['beg'] - $result3['sold'];
                                              ?></span>
                                              <br>



                                            <span class="text-md mr-4"><span class="text-muted">from</span> &#8369;<?php echo number_format($result1['price'],2); ?></span>

                                            </div>
                                            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button <?php $buttonvalue = "Add to cart"; $arraylength =  count($_SESSION["orders"]);
                                            $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid'); $existing = "false";
                                            for ($i=0; $i < $arraylength; $i++) { 
                                                 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $result1['menuitemid']) {
                                                    $existing = "true";
                                                 }
                                            }if ($existing == "true") { echo "disabled"; $buttonvalue = "Item in Cart"; }?> class="btn btn-outline-secondary btn-sm" data-target="#productModal<?php echo $result1['menuitemid']; ?>" <?php if ($result1['isavailable'] == 1) {
                                                echo "disabled";
                                            } ?> data-toggle="modal"><span><?php echo $buttonvalue; ?></span></button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>


                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>



    

 <?php include('footer.php'); ?>
