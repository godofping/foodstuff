<?php
include_once('connection.php');
$username = $_POST['username'];
$password = md5($_POST['password']);

$qry = mysqli_query($connection, "select * from user_table where username = '" . $username . "' and password = '" . $password . "' and userlevel = 1");

if (mysqli_num_rows($qry) > 0) {

	$qry = mysqli_query($connection, "select * from user_table where username = '" . $username . "' and password = '" . $password . "' and userlevel = 1");

	$result = mysqli_fetch_assoc($qry);

	$_SESSION["userid"] =  $result['userid'];
	$_SESSION["userlevel"] =  $result['userlevel'];

	header("Location: admin-dashboard.php");
	

}
else
{
	$qry = mysqli_query($connection, "select * from user_table where username = '" . $username . "' and password = '" . $password . "' and userlevel = 2");

	if (mysqli_num_rows($qry) > 0) {

		$qry = mysqli_query($connection, "select * from user_table where username = '" . $username . "' and password = '" . $password . "' and userlevel = 2");

		$result = mysqli_fetch_assoc($qry);

		$_SESSION["userid"] =  $result['userid'];
		$_SESSION["userlevel"] =  $result['userlevel'];

		header("Location: admin-dashboard.php");
		}
		else
		{
			header("Location: login.php?error=1");
		}
}

 ?>