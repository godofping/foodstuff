<?php include('head.php'); 
$_SESSION['currentpage'] = 'review';?>
    <!-- Content -->
    <div id="content">
              <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="bg-image bg-parallax"><img src="assets/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">

                        <?php 
                        $qry = mysqli_query($connection, "select * from review_table where reviewid= '" . $_GET['reviewid'] . "'");
                        $result = mysqli_fetch_assoc($qry); 

                        ?>

                        <h1 style="color: white;" class="mb-0"><?php echo $result['reviewtitle']; ?></h1>
                        <h4 class="text-muted mb-0"><?php echo $result['comment']; ?></h4>
                    </div>
                </div>
            </div>
        </div>

   

         <!-- Page Content -->
        <div class="page-content pt-0 pull-up-30 protrude">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-xl-8 push-xl-2">
                        
                        <?php 
                        $qry = mysqli_query($connection, "select * from review_conversation_table where reviewid = '" . $_GET['reviewid'] . "'");

                        while ($result = mysqli_fetch_assoc($qry)) { 
                        if (empty($result['userid'])) { ?>
                        <!-- Blockquote -->
                        <blockquote class="blockquote blockquote-lg" data-center-top="filter: blur(0); transform: scale(1);" data-bottom-top="transform: scale(0.9);">
                            <div class="blockquote-content dark">
                             
                                <p style="font-size: 30px;"><?php echo $result['message']; ?></p>
                             
                            </div>
                            <footer>
                
                                <span class="name">You<span class="text-muted">, <?php echo $result['datetime']; ?></span></span>
                            </footer>
                        </blockquote>
                            
                           <?php } else { ?>
                         <!-- Blockquote -->
                        <blockquote class="blockquote blockquote-lg" data-center-top="filter: blur(0); transform: scale(1);" data-bottom-top="transform: scale(0.9);">
                            <div class="blockquote-content">
                             
                                <p style="font-size: 30px;"><?php echo $result['message']; ?></p>
                             
                            </div>
                            <footer>
                
                                <span class="name"><?php
                    $qry1 = mysqli_query($connection, "select * from user_view where userid = '" . $result['userid'] . "'");
                    $result1 = mysqli_fetch_assoc($qry1);
                     echo $result1['fullname']; ?><span class="text-muted">, <?php echo $result['datetime']; ?></span></span>
                            </footer>
                        </blockquote>


                         <?php } } ?>

                        <form action="controller.php" method="POST">
                        <div class="form-group" style="padding-top: 100px;">
                        <label>Message</label>
                        <textarea rows="5" required="" class="form-control" name="message"></textarea> 
                        </div>

                        <input type="text" name="reviewid" hidden="" value="<?php echo $_GET['reviewid']; ?>">
                        <input type="text" name="sourcepage" hidden="" value="view-conversations">

                        <button type="submit" class="btn btn-outline-secondary" onclick="return confirm('Confirm send message');"><span>Submit Message</span></button>
                        </form>
                 
                     
                       
                    </div>
                </div>
            </div>
        </div>


        <div style="padding-top: 100px;"></div>
    

 <?php include('footer.php'); ?>
