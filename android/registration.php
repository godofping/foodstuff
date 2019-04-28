<?php 

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$address = $_POST['address'];
$emailaddress = $_POST['emailaddress'];
$contactnumber = $_POST['contactnumber'];
$username = $_POST['username'];
$password = md5($_POST['password']);


$connection = mysqli_connect("localhost", "root", "vertrigo","stidb");

	mysqli_query($connection, "insert into customer_table (firstname, middlename, lastname, birthdate, address, emailaddress, contactnumber, username, password, isactivated) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $birthdate . "', '" . $address . "', '" . $emailaddress . "', '" . $contactnumber . "', '" . $username . "', '" . $password . "', '0')");

	echo "Account is succesful created";


	// if (mysqli_num_rows($qry) > 0) {
	// 	$result = mysqli_fetch_assoc($qry);
	// 	echo $result['customerid'] . " " . $result['username'] ;
	// }
	// else
	// {
	// 	echo "";
	// }

 ?>