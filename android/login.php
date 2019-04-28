<?php 

$username = $_POST['username'];
$password = md5($_POST['password']);

include_once('../connection.php');

$qry = mysqli_query($connection, "select * from customer_table where username = '" . $username . "' and password = '" . $password . "'");




	if (mysqli_num_rows($qry) > 0) {
		$result = mysqli_fetch_assoc($qry);
		echo $result['customerid'];
	}
	else
	{
		echo "";
	}

 ?>