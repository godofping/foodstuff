<?php 
include_once('../connection.php');
mysqli_query($connection, "update customer_table set password = '" . md5("1234") . "' where emailaddress = '" . $_POST['emailaddress'] . "'");
header("Location: login.php");
 ?>