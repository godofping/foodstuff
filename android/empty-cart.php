<?php 
session_start();
unset($_SESSION['orders']);
header("Location: home.php");
 ?>