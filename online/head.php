    <?php include_once('../connection.php'); 

if (!isset($_SESSION["orders"])) {
    $_SESSION["orders"] = array();
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="FoodStuff Tacurong. Best food house in tacurong. Food goes by the name. Tacurong Foodstuff.">

<!-- Title -->
<title>D' Little Baker's FOODSTUFF</title>

<!-- Favicons -->
<link rel="shortcut icon" href="assets/img/favicon.png">
<link rel="apple-touch-icon" href="assets/img/favicon_60x60.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon_76x76.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon_120x120.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon_152x152.png">

<!-- CSS Plugins -->
<link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/plugins/slick-carousel/slick/slick.css" />
<link rel="stylesheet" href="assets/plugins/animate.css/animate.min.css" />
<link rel="stylesheet" href="assets/plugins/animsition/dist/css/animsition.min.css" />

<!-- CSS Icons -->
<link rel="stylesheet" href="assets/css/themify-icons.css" />
<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css" />

<!-- CSS Theme -->
<link id="theme" rel="stylesheet" href="assets/css/themes/theme-beige.min.css" />


</head>

<body>

<!-- Body Wrapper -->
<div id="body-wrapper" class="animsition">

    <!-- Header -->
    <header id="header" class="light">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Logo -->
                    <div class="module module-logo dark">
                        <a href="index.php">
                            <img src="../images/foodstufflogo-transparent background.png" alt=""  style="height:120px; width: 120px; margin-top: -25px;">
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <!-- Navigation -->
                    <nav class="module module-navigation left mr-4">
                        <ul id="nav-main" class="nav nav-main">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="menu.php">Menu</a></li>

                            <?php if (!isset($_SESSION['customerid'])) { ?>
                                <li><a href="login.php">Login</a></li>
                            <li><a href="registration.php">Register</a></li>

                            <?php } ?>

                            <?php if (isset($_SESSION['customerid'])) { ?>
                                <li class="has-dropdown">
                                <a href="#">Review</a>
                                <div class="dropdown-container">
                                    <ul>
                                        <li><a href=review.php>Write review</a></li>
                                        <li><a href="my-reviews.php">My Reviews</a></li>
                                    </ul>
                                </div>
                            </li>
                                <li><a href="orders.php">My Orders</a></li>
                                <li><a href="profile.php">My Profile</a></li>
                                <li><a href="logout.php">logout</a></li>

                            <?php } ?>
                            <li><a href="https://drive.google.com/file/d/0BzaU0cA7V9YQSWxpeVlWRkw5NWc/view?usp=sharing">GET THE APP</a></li>
                            
                        </ul>
                    </nav>
                    <div class="module rigt">
                        
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notification"><?php echo count($_SESSION["orders"]); ?></span>
                        </span>
                        <span class="cart-value" id="carttotalamount"></span>
                    </a>

                </div>
            </div>
        </div>

    </header>
    <!-- Header / End -->

    <!-- Header -->
    <header id="header-mobile" class="light">

        <div class="module module-nav-toggle">
            <a href="#" id="nav-toggle" data-toggle="panel-mobile"><span></span><span></span><span></span><span></span></a>
        </div>    

        <div class="module module-logo">
            <a href="index.php">
                 <img src="../images/foodstufflogo-transparent background.png" alt="">
            </a>
        </div>

        <a href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notification"><?php echo count($_SESSION["orders"]); ?></span>
                        </span>
                        <span class="cart-value" id="carttotalamount"></span>
                    </a>

    </header>
    <!-- Header / End -->

<!--     <script type="text/javascript">
    <?php if (isset($_GET['opencart']) and $_GET['opencart'] == "show") { ?>
        ('#myModal').modal('toggle');
    <?php } ?>
    </script> -->
