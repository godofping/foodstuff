<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "add-food";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Foods</div>
          <div class="sub-title">...</div>
        </div>
        <div class="card bg-white">
          <div class="card-header">
            Add food
          </div>
          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" enctype="multipart/form-data" class="form-horizontal" role="form">

                	

                  <?php 

                        $qry = mysqli_query($connection, "select * from menu_item_list_view where menuitemid = '" . $_GET['menuitemid'] . "'");
                        $result = mysqli_fetch_assoc($qry);
                  ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Menu Category</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%;" required name="menucategoryid">
                      <option value="<?php echo $result['menucategoryid']; ?>" selected><?php echo $result['menucategoryname']; ?></option>
                        <?php
                               $qry = mysqli_query($connection, "select * from menu_category_table"); 
                               while ($result1 = mysqli_fetch_assoc($qry)) { ?>
                               <option value="<?php echo $result1['menucategoryid']; ?>"><?php echo $result1['menucategoryname']; ?></option>
                              <?php } ?>

                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Menu Item Name</label>
                    <div class="col-sm-10">
                      <input required name="menuitemname" type="text" class="form-control" value="<?php echo $result['menuitemname']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Menu Item Price</label>
                    <div class="col-sm-10">
                      <input required name="price" min="0" type="number" class="form-control" value="<?php echo $result['price']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                      <textarea required name="menuitemdescription" class="form-control" rows="3" placeholder="This is optional."><?php echo $result['menuitemdescription']; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" name="imagetoupload">
                      <p class="help-block">Please select image for the menu item</p>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-md-12 text-right">
                      <input type="text" name="menuitemid" hidden value="<?php echo $_GET['menuitemid']; ?>">
                  		<input type="text" name="sourcepage" value="update-food" hidden="">
                  		<button type="button" class="btn btn-primary align-right" data-toggle="modal" data-target="#updatefoodmodal">Submit</button>
                  	</div>	
                  </div>

                  <!-- modal start -->
                        <div id="updatefoodmodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm update food.</p>
                                
                              </div>
                              <div class="modal-footer no-border">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- end modal -->

                </form>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <!-- /main area -->

<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    