<?php 
session_start();

unset($_SESSION['orders'][$_GET['menuitemid']]);
header("Location: cart.php");

 ?>