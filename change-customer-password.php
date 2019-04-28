<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "add-user";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">User Module</div>
          <div class="sub-title">...</div>
        </div>
        <div class="card bg-white">
          <div class="card-header">
            Create User Account
          </div>
          <div class="card-block">
            <div class="row m-a-0">
              <div class="col-md-12">
                <form method="POST" action="controller.php" class="form-horizontal" role="form">

                	<div class="row">
                      <div class="col-md-12">
                      <?php  
          		$qry = mysqli_query($connection, "select * from customer_view where customerid = '" . $_GET['customerid']. "'");
          		$result = mysqli_fetch_assoc($qry);
          	?>
            <p class="caption">Update the password of <b><?php echo $result['fullname']; ?></b> account.  </p>
                      </div>
                    </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input required="" name="newpassword" type="password" class="form-control">
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-md-12 text-right">
                  		<input type="text" name="customerid" hidden value="<?php echo $_GET['customerid']; ?>">
                  		<input type="text" name="sourcepage" value="change-customer-password" hidden="">
                  		<button onclick="javascript:return confirm('Confirm update password')" type="submit" class="btn btn-primary align-right">Submit</button>
                      </form>

                  	</div>	
                  </div>

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
    