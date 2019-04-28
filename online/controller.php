<?php  
include_once('../connection.php');

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "registration") {
	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_POST['username'] . "'");
	

	if (mysqli_num_rows($qry) > 0) {
		header("Location: registration.php?status=failed&username=" . $_POST['username'] . "");
	}
	else
	{
		
		$qry = mysqli_query($connection, "select * from customer_table where emailaddress = '" . $_POST['emailaddress'] . "'");
		if (mysqli_num_rows($qry) > 0) {
			header("Location: registration.php?status=emailaddresstaken&emailaddress=" . $_POST['emailaddress'] . "");
		}
		else
		{
			mysqli_query($connection, "insert into customer_table (firstname, middlename, lastname, address, emailaddress, contactnumber, username, password,gender, birthdate, isactivated) values ('" . $_POST['firstname'] . "', '" . $_POST['middlename'] . "', '" . $_POST['lastname'] . "', '" . $_POST['address'] . "', '" . $_POST['emailaddress'] . "', '" . $_POST['contactnumber'] . "', '" . $_POST['username'] . "', '" . md5($_POST['password']) . "', '" . $_POST['gender'] . "', '" . $_POST['birthdate'] . "', '0')");

				$qry = mysqli_query($connection, "SELECT * FROM customer_table ORDER BY customerid DESC LIMIT 1");
				$result = mysqli_fetch_assoc($qry);

				// the message
				$msg = "Please open the link below to activate your account.\nwww.tacurong-foodstuff.info/online/activate.php?customerid=" . $result['customerid'] . "";

				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);

				// send email
				mail($_POST['emailaddress'],"Account Activation - FOODSTUFF",$msg);

				header("Location: registration.php?status=successful&who=" . $_POST['firstname'] . " " . $_POST['middlename'] . " " . $_POST['lastname'] . "");
		}
	}
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "login") {
	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_POST['username'] . "' and password = '" . md5($_POST['password']) . "' and isactivated = '1'");
	$result = mysqli_fetch_assoc($qry);


	if (mysqli_num_rows($qry) > 0) {
		$_SESSION['customerid'] = $result['customerid'];

		if (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'checkout') {
			$_SESSION['currentpage'] = "";
			header("Location: checkout.php");	
		}
		else
		{
			header("Location: index.php");	
		}
		

	}
	else
	{
		header("Location: login.php?error=1");
	}
}



if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "cart") {

$arraylength =  count($_SESSION["orders"]);

$menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid');



for ($u=0; $u < $arraylength; $u++) { 
	echo "menuitemid : ";
	print_r($_SESSION['orders'][$menuitemidvalues[$u]]['menuitemid']);
	echo " | quantity : ";
	print_r($_SESSION['orders'][$menuitemidvalues[$u]]['quantity']);
	echo "<br>";
}

$existing = "false";

for ($i=0; $i < $arraylength; $i++) { 
	 if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $_POST['menuitemid']) {
	 	$existing = "true";
	 }
}
if ($existing == "true") {
	//update-cart
	$_SESSION['orders'][$_POST['menuitemid']]['instruction'] =  $_POST['specialinstruction'];
	$_SESSION['orders'][$_POST['menuitemid']]['quantity'] =  $_POST['quantity'];
}
else
{
	//add cart
	$_SESSION['orders'][$_POST['menuitemid']] = array('menuitemid' => $_POST['menuitemid'], 'instruction' => "",'quantity' => 1);

	$_SESSION['orders'][$_POST['menuitemid']]['instruction'] =  $_POST['specialinstruction'];
	$_SESSION['orders'][$_POST['menuitemid']]['quantity'] =  $_POST['quantity'];

}

	if (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'checkout') {
		header("Location: checkout.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'menu') {
	header("Location: menu.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'index') {
	header("Location: index.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'about') {
	header("Location: about.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'review') {
	header("Location: review.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'orders') {
	header("Location: orders.php?menuitemid=".$_POST['menuitemid']."");
	}
	elseif (isset($_SESSION['currentpage']) and $_SESSION['currentpage'] == 'profile') {
	header("Location: profile.php?menuitemid=".$_POST['menuitemid']."");
	}
	else
	{
		header("Location: menu.php?menuitemid=".$_POST['menuitemid']."");
	}


}


if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == "edit-cart") {
		
		unset($_SESSION['orders'][$_GET['menuitemid']]);

		if($_SESSION['currentpage'] == "checkout")
		{
			$_SESSION['currentpage'] = "";
			header("Location: checkout.php?opencart=true");
		}
		else
		{
			header("Location: menu.php?opencart=true");
		}
		
	
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == "myorders") {
		
		mysqli_query($connection, "update order_table set isapproved = 2 where orderid = '" . $_GET['orderid'] . "'");
		
		header("Location: orders.php?");
		
	
}




if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "review") {
	mysqli_query($connection, "insert into review_table (reviewtitle, reviewdate, comment, customerid) values ('" . $_POST['reviewtitle'] . "', '" . date("Y-m-d") . "', '" . $_POST['comment'] . "', '" . $_SESSION['customerid'] . "')");
	header("Location: review.php?status=success");
	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "checkout") {
	if ($_POST['ordertypeselected'] == 1) {
	$_POST['date'] = $_POST['date1'];
	$_POST['time'] = $_POST['time1'];


}
	elseif ($_POST['ordertypeselected'] == 2) {
		$_POST['date'] = $_POST['date2'];
		$_POST['time'] = $_POST['time2'];

}

	$timeanddateofpickup  = $_POST['date'] . " " . $_POST['time'];
	// echo $timeanddateofpickup;

	 mysqli_query($connection, "insert into order_table (customerid, orderdate, datetimeofpickup, isapproved, ordertype) values ('" . $_SESSION['customerid'] . "', '" . date('Y-m-d H:i:s') . "' ,  '" . $timeanddateofpickup . "','0', '" . $_POST['ordertype'] . "')");

	 $qry = mysqli_query($connection, "SELECT * FROM order_table ORDER BY orderid DESC LIMIT 1");
	$result = mysqli_fetch_assoc($qry);
	$orderid = $result['orderid'];
	// echo $orderid;


	if (isset($_SESSION['orders'])) {
	$arraylength =  count($_SESSION["orders"]);
	 $menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid');
     $quantityvalues = array_column($_SESSION["orders"], 'quantity');
     $instructionvalues = array_column($_SESSION["orders"], 'instruction');



	 for($i = 0; $i < $arraylength; $i++) {
        $qry = mysqli_query($connection,"select * from menu_item_list_view where menuitemid = '" . $menuitemidvalues[$i] . "'");
        $result = mysqli_fetch_assoc($qry);


        $menuitemid = $result['menuitemid'];
        $price =  $result['price'];
        $quantity =  $_SESSION['orders'][$menuitemidvalues[$i]]['quantity'];

        $specialinstruction =  $_SESSION['orders'][$menuitemidvalues[$i]]['instruction'];
        $totalitemprice = $result['price'] * $quantity;


        mysqli_query($connection, "insert into cart_item_table (orderid,menuitemid, quantity, price, specialinstruction) values ('" . $orderid . "','" . $menuitemid . "', '" . $quantity . "', '" . $price . "', '" . $specialinstruction . "')");


    }
        unset($_SESSION['orders']);
        $_SESSION["orders"] = array();
        
         header("Location: confirmation.php?orderid=".$orderid."");



	}
	
	
}



if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'emptycart') {
	unset($_SESSION['orders']);
    $_SESSION["orders"] = array();
    header("Location: index.php");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-customer') {

	mysqli_query($connection, "update customer_table set firstname = '" . $_POST['firstname'] . "', middlename = '" . $_POST['middlename'] . "', lastname = '" . $_POST['lastname'] . "', birthdate = '" . $_POST['birthdate'] . "', gender = '" . $_POST['gender'] . "', address = '" . $_POST['address'] . "', emailaddress =  '" . $_POST['emailaddress'] . "', contactnumber = '" . $_POST['contactnumber'] . "' where customerid = '" . $_SESSION['customerid'] . "'  ");



		header("Location: profile.php?status=successupdateprofile");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-password') {

	$qry = mysqli_query($connection, "select * from customer_table where customerid = '" . $_SESSION['customerid'] . "'");
	$result = mysqli_fetch_assoc($qry);

	if (md5($_POST['oldpassword']) == $result['password']) {
		mysqli_query($connection, "update customer_table set password = '" . md5($_POST['password']) . "' where customerid = '" . $_SESSION['customerid'] . "'  ");
		header("Location: profile.php?status=successchangepass");
	}
	else
	{
		header("Location: profile.php?status=failedchangepass");
	}


		
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-conversations') {
	mysqli_query($connection, "insert into review_conversation_table (reviewid, datetime, message,customerid) values ('" . $_POST['reviewid'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['message'] . "','" . $_SESSION['customerid'] . "')");

	
	header("Location: view-conversations.php?reviewid=" . $_POST['reviewid'] ."");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'forgot-password') {
	$qry = mysqli_query($connection, "select * from customer_table where emailaddress = '" . $_POST['emailaddress'] . "'");
	

	if (mysqli_num_rows($qry) == 0) {
		header("Location: forgot-password.php?status=emailaddressnotexist&emailaddress=" . $_POST['emailaddress'] . "");

	}
	else
	{
			

				// the message
				$msg = "Please open the link below to reset the password of your account to 1234.\nwww.tacurong-foodstuff.info/online/reset.php?emailaddress=" . $_POST['emailaddress'] . "";

				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);

				// send email
				mail($_POST['emailaddress'],"Account Reset - FOODSTUFF",$msg);

				header("Location: forgot-password.php?status=successfulemailsent&emailaddress=" . $_POST['emailaddress'] . " ");
		
	}
}




?>