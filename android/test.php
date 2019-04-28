<?php 
include_once('../connection.php');

if ($_POST['ordertypeselected'] == 1) {
	echo $_POST['date1'];
	echo "<br>";
	echo $_POST['time1'];
	echo "<br>";

}
elseif ($_POST['ordertypeselected'] == 2) {
	echo $_POST['date2'];
	echo "<br>";
	echo $_POST['time2'];
	echo "<br>";
}
 ?>
