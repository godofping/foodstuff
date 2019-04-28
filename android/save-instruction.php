<?php 
session_start();



$_SESSION['orders'][$_POST['menuitemid']]['instruction'] =  $_POST['specialinstruction'];
$_SESSION['orders'][$_POST['menuitemid']]['quantity'] =  $_POST['quantity'];

header("Location: cart.php");

?>