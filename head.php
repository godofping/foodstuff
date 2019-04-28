<!doctype html>
<html class="no-js" lang="">
<?php if (!isset($_SESSION['userlevel']) and !isset($_SESSION['userid'])) {
    header("Location: login.php?error=2");
  } ?>
<head>
  <meta charset="utf-8">
  <title>D' Little Baker's FOODSTUFF</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="datatables.css">
  <link rel="stylesheet" href="styles/webfont.css">
  <link rel="stylesheet" href="styles/climacons-font.css">
  <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/font-awesome.css">
  <link rel="stylesheet" href="styles/card.css">
  <link rel="stylesheet" href="styles/sli.css">
  <link rel="stylesheet" href="styles/animate.css">
  <link rel="stylesheet" href="styles/app.css">
  <link rel="stylesheet" href="styles/app.skins.css">
  <link rel="stylesheet" href="datatables.css">

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
  <div class="app layout-fixed-header">
  <?php include('side-menu.php');?>
    <!-- content panel -->
    <div class="main-panel">
      <!-- top header -->
      <div class="header navbar">
        <div class="brand visible-xs">
          <!-- toggle offscreen menu -->
          <div class="toggle-offscreen">
            <a href="javascript:;" class="hamburger-icon visible-xs" data-toggle="offscreen" data-move="ltr">
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
          <!-- /toggle offscreen menu -->
          <!-- logo -->
          <a class="brand-logo">
            <span>FOODSTUFF</span>
          </a>
          <!-- /logo -->
        </div>
        <ul class="nav navbar-nav hidden-xs">
          <li>
            <a href="javascript:;" class="small-sidebar-toggle ripple" data-toggle="layout-small-menu">
              <i class="icon-toggle-sidebar"></i>
            </a>
          </li>

          <li class="">
              <a href="javascript:;" class="ripple" aria-expanded="false">
                <span><img src="images/foodstufflogo.png" style="height: 50px; margin-top: -15px;"></span>
              </a> 
          </li>
         
        </ul>
        <ul class="nav navbar-nav navbar-right hidden-xs">
          <li class="">
              <a href="javascript:;" class="ripple" aria-expanded="false">
                <span>Logged in as <?php if ($_SESSION['userlevel'] == 1) { echo "OWNER"; } else { echo "SECRETARY" ;} {
                  # code...
                } ?></span>
              </a> 
          </li>
          <li>
            <a href="javascript:;" class="ripple" data-toggle="dropdown">
              <img src="images/avatar.jpg" class="header-avatar img-circle" alt="user" title="user">
              <span><?php 
              $qry = mysqli_query($connection, "select * from user_view where userid = '" . $_SESSION["userid"] . "'");
              $result = mysqli_fetch_assoc($qry);
              echo $result['fullname'];
               ?></span>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
             
              <li>
                <a href="profile.php">Profile</a>
              </li>
              <li>
                <a href="logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /top header -->