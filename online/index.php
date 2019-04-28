<?php include('head.php'); 
$_SESSION['currentpage'] = 'index';
?>
    <!-- Content -->
    <div id="content">

        <!-- Section - Main -->
        <section class="section section-main section-main-2 bg-dark dark">

            <div id="section-main-2-slider" class="section-slider inner-controls">
                <!-- Slide -->
                <div class="slide">
                    <div class="bg-image zooming"><img src="assets/img/photos/slider-burger_dark.jpg" alt=""></div>
                    <div class="container v-center">
                        <h1 class="display-2 mb-2">Delicious Burgers</h1>
                        <h4 class="text-muted mb-5">order one now!</h4>
                        <a href="menu.php" class="btn btn-outline-primary btn-lg"><span>Order now!</span></a>
                    </div>
                </div>
                <!-- Slide -->
                <div class="slide">
                    <div class="bg-image zooming"><img src="assets/img/photos/slider-dessert_dark.jpg" alt=""></div>
                    <div class="container v-center">
                        <h1 class="display-2 mb-2">Delicious Desserts</h1>
                        <h4 class="text-muted mb-5">Order it online even now!</h4>
                        <a href="menu.php" class="btn btn-outline-primary btn-lg"><span>Order now!</span></a>
                    </div>
                </div>
                <!-- Slide -->
                <div class="slide">
                    <div class="bg-image zooming"><img src="assets/img/photos/slider-pasta_dark.jpg" alt=""></div>
                    <div class="container v-center">
                        <h1 class="display-2 mb-2">Delicious Pastas</h1>
                        <h4 class="text-muted mb-5">Order it online even now!</h4>
                        <a href="menu.php" class="btn btn-outline-primary btn-lg"><span>Order now!</span></a>
                    </div>
                </div>
            </div>

        </section>

        <!-- Section - About -->
        <section class="section section-bg-edge">

            <div class="image left col-md-6">
                <div class="bg-image"><img src="assets/img/photos/bg-chef.jpg" alt=""></div>
            </div>
        
            <div class="container">
                <div class="col-lg-5 col-lg-push-7 col-md-9 push-md-6">
                    <div class="rate mb-5 rate-lg"><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i></div>
                    <h1>The best food house in Tacurong!</h1>
                    <p class="lead text-muted mb-5">Good food goes by the name!</p>
                
                </div>
            </div>

        </section>



        <section class="section pb-0">

            <div class="container">
                <h1 class="mb-6">Our menu</h1>
            </div>

            <div class="menu-sample-carousel carousel inner-controls" data-slick='{
                "dots": true,
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": true,
                "responsive": [
                    {
                        "breakpoint": 991,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 1
                        }
                    },
                    {
                        "breakpoint": 690,
                        "settings": {
                            "slidesToShow": 1,
                            "slidesToScroll": 1
                        }
                    }
                ]
            }'>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/shortorders1.jpg" alt="" class="image">
                        <h3 class="title">Short Orders</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/burgers.jpg" alt="" class="image">
                        <h3 class="title">Burgers and Sandwiches</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                   <a href="menu.php">
                        <img src="assets/img/photos/cakes1.jpg" alt="" class="image">
                        <h3 class="title">cakes, Pastries, and Desserts</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/refreshments1.jpg" alt="" class="image">
                        <h3 class="title">Refreshments</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/beverages1.jpg" alt="" class="image">
                        <h3 class="title">Beverages</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/bilao1.jpg" alt="" class="image">
                        <h3 class="title">Bilao</h3>
                    </a>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    <a href="menu.php">
                        <img src="assets/img/photos/goodies1.jpg" alt="" class="image">
                        <h3 class="title">Goodies</h3>
                    </a>
                </div>
            </div>

        </section>
        <div style="margin-top: 150px;"></div>

 <?php include('footer.php'); ?>
