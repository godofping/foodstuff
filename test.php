<?php 
include_once('connection.php');


mysqli_query($connection,"truncate table cart_table");
mysqli_query($connection,"truncate table customer_table");
mysqli_query($connection,"truncate table goodies_inventory_table");
mysqli_query($connection,"truncate table menu_category_table");
mysqli_query($connection,"truncate table menu_item_table");
mysqli_query($connection,"truncate table order_table");
mysqli_query($connection,"truncate table review_table");
mysqli_query($connection,"truncate table user_table");


 ?>
 