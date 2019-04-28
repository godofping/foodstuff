<?php 
include '../connection.php';
include 'head.php';

?>

    
    <!-- START WRAPPER -->
    <div class="wrapper">


      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content" style="background: url(images/backloader.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;height: 100vh; z-index: -1;" >
  <div style="padding-top: 60px;"></div>

        <!--start container-->
        <div class="container">

        <div style=" margin-left: 10px; margin-right: 10px; background-color: rgba(255, 255, 255, 0.50); height: 550px;" >

          <div class="row">
            <div class="col s12">
              <img src="images/fslogo.png" height="150" style="display: block;
    margin: 0 auto; padding-top: 20px;">
            </div>
          </div>

          <form action="controller.php" method="POST">

            <div class="row">
            <div class="col s12">
              <?php if (isset($_GET['status']) and $_GET['status'] == "loginfailed"): ?>
                <p style="padding: 10px;">Incorrect username and/or password.</p>
              <?php endif ?>
              <?php if (isset($_GET['status']) and $_GET['status'] == "activateaccount"): ?>
                <p style="padding: 10px;">Please activate your account in the email sent in your email address.</p>
              <?php endif ?>
            
            </div>
          </div>


          <div class="row">
            <div class="col s12">
              <div class="input-field col s12">
                <input name="username" id="username" type="text" class="validate" required="">
                <label for="username" class="">Username</label>
              </div>
            
            </div>
          </div>

          <div class="row">
            <div class="col s12">
              <div class="input-field col s12">
                <input name="password" id="password" type="password" class="validate" required="">
                <label for="password" class="">Password</label>
              </div>
            
            </div>
          </div>

          <input type="text" name="sourcepage" value="login-page" hidden>

          <div class="row" style="padding-top: 20px;">
            <div class="col s12" style="text-align: center;">
              <button type="submit" class="waves-effect waves-light orange btn">LOGIN</button>
            </div>
          </div>

          <div class="row" style="padding-top: 20px;">
            <div class="col s12" style="text-align: center;">
              <h5 style="color: orange;">or</h5>
              <h5 style="color: orange;">Create an Account</h5>
            </div>
          </div>


          

        </div>

        </form>

      
        </div>

      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


    </div>
    <!-- END WRAPPER -->


<?php include 'foot.php' ?>