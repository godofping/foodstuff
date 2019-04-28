<?php
session_start();
session_destroy();
session_start();
$_SESSION["orders"] = array();

if (!isset($_SESSION['customerid'])) {
  $_SESSION['customerid'] = $_GET['customerid'];
}






header("Location: home.php");
?>

