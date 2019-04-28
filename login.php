<?php 
session_start(); 
if(isset($_SESSION["userlevel"]) and $_SESSION["userlevel"] == 1)
{
  header("Location: admin-dashboard.php");
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>D' Little Baker's FOODSTUFF</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="styles/webfont.css">
  <link rel="stylesheet" href="styles/climacons-font.css">
  <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/font-awesome.css">
  <link rel="stylesheet" href="styles/card.css">
  <link rel="stylesheet" href="styles/sli.css">
  <link rel="stylesheet" href="styles/animate.css">
  <link rel="stylesheet" href="styles/app.css">
  <link rel="stylesheet" href="styles/app.skins.css">
  <!-- endbuild -->
</head>

<body class="page-loading">
  <!-- page loading spinner -->
  <div class="pageload">
    <div class="pageload-inner">
      <div class="sk-rotating-plane"></div>
    </div>
  </div>
  <!-- /page loading spinner -->
  <div class="app signin usersession">
    <div class="session-wrapper">
      <div class="page-height-o row-equal align-middle">
        <div class="column">
          <div class="card bg-white no-border">
            <div class="card-block">
              <div class="text-center">
                <img src="images/foodstufflogo.jpg" style="height: 100px;">
              </div>
              <form method="POST" action="authentication.php" role="form" class="form-layout" action="/">
                <div class="text-center m-b">
                  <h4 class="text-uppercase">Welcome</h4>
                  <?php 
        if (isset($_GET['error']) and $_GET['error'] == 1)
        {

          ?>
          <p style="text-align: center; padding-top: 5px;">Incorrect username or password</p>
          <?php
        }

         ?>
                  <p>Please sign in to your account</p>
                </div>
                <div class="form-inputs">
                  <label class="text-uppercase">username</label>
                  <input name="username" type="text" class="form-control input-lg" placeholder="Username" required>
                  <label class="text-uppercase">Password</label>
                  <input name="password" type="password" class="form-control input-lg" placeholder="Password" required>
                </div>
         
                <button class="btn btn-primary btn-block btn-lg m-b" type="submit">Login</button>
               
                
          
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- bottom footer -->
    <footer class="session-footer">
      <nav class="footer-right">
        <ul class="nav">
          <li>
            <a href="javascript:;">Copyright © 2017 D' Little Baker's FOODSTUFF All rights reserved.</a>
          </li>
        </ul>
      </nav>
      <nav class="footer-left hidden-xs">
   
      </nav>
    </footer>
    <!-- /bottom footer -->
  </div>
  <!-- build:js({.tmp,app}) scripts/app.min.js -->
  <script src="scripts/helpers/modernizr.js"></script>
  <script src="vendor/jquery/dist/jquery.js"></script>
  <script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
  <script src="vendor/fastclick/lib/fastclick.js"></script>
  <script src="vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="scripts/helpers/smartresize.js"></script>
  <script src="scripts/constants.js"></script>
  <script src="scripts/main.js"></script>
  <!-- endbuild -->
</body>

</html>