<?php 
include_once('../connection.php');
if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'android-add-customer') {

	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_POST['username'] . "'");
	

	if (mysqli_num_rows($qry) > 0) {
		header("Location: create-account.php?status=failed&username=" . $_POST['username'] . "");
	}
	else
	{

		$qry = mysqli_query($connection, "select * from customer_table where emailaddress = '" . $_POST['emailaddress'] . "'");
	

		if (mysqli_num_rows($qry) > 0) {
			header("Location: create-account.php?status=failedemailaddresstaken&emailaddress=" . $_POST['emailaddress'] . "");
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

		header("Location: create-account.php?status=successful&who=" . $_POST['firstname'] . " " . $_POST['middlename'] . " " . $_POST['lastname'] . "");
		}

		
	}
} 

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'android-review') {
	mysqli_query($connection, "insert into review_table (reviewtitle, reviewdate, comment, customerid) values ('" . $_POST['reviewtitle'] . "', '" . date('Y-m-d') . "' ,'" . $_POST['comment'] . "', '" . $_SESSION['customerid'] . "')");
	header("Location: review.php?customerid=". $_POST['customerid'] . "&status=success&button=write-review");

}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == "android-check-out") {

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
        
        header("Location: thanks-page.php?customerid=". $_SESSION['customerid'] . "&orderid=".$orderid."");



	}
	
	
}



if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'android-update-customer') {

	mysqli_query($connection, "update customer_table set firstname = '" . $_POST['firstname'] . "', middlename = '" . $_POST['middlename'] . "', lastname = '" . $_POST['lastname'] . "', birthdate = '" . $_POST['birthdate'] . "', gender = '" . $_POST['gender'] . "', address = '" . $_POST['address'] . "', contactnumber = '" . $_POST['contactnumber'] . "' where customerid = '" . $_POST['customerid'] . "'  ");



		header("Location: profile.php?customerid=" . $_POST['customerid']  ."&status=successupdateprofile");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'android-update-password') {

	$qry = mysqli_query($connection, "select * from customer_table where customerid = '" . $_POST['customerid'] . "'");
	$result = mysqli_fetch_assoc($qry);





	if (md5($_POST['oldpassword']) == $result['password']) {
		mysqli_query($connection, "update customer_table set password = '" . md5($_POST['password']) . "' where customerid = '" . $_POST['customerid'] . "'  ");
		
		 header("Location: profile.php?customerid=" . $_POST['customerid']  ."&status=successchangepass");
	}
	else
	{
		 header("Location: profile.php?customerid=" . $_POST['customerid']  ."&status=failedchangepass");
	}



		

}


if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == "myorders") {
		
		mysqli_query($connection, "update order_table set isapproved = 2 where orderid = '" . $_GET['orderid'] . "'");
		
		header("Location: my-orders.php?customerid=".$_SESSION['customerid']."");
		
	
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'login-page') {

	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_POST['username'] . "' and password = '" . md5($_POST['password']) . "'");
	$result = mysqli_fetch_assoc($qry);

	if (mysqli_num_rows($qry) > 0) {
		
		if ($result['isactivated'] == 0) {
		header("Location: login-page.php?status=activateaccount");
		}
		else
		{
		$_SESSION['customerid'] = $result['customerid'];
		header("Location: check-out.php");
		}
	}
	else
	{
		header("Location: login-page.php?status=loginfailed");
	}

}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'my-conversations') {

mysqli_query($connection, "insert into review_conversation_table (reviewid, datetime, message, customerid) values ('" . $_POST['reviewid'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['message'] . "', '" . $_POST['customerid'] . "')");

	

	header("Location: my-conversations.php?reviewid=". $_POST['reviewid'] . "&customerid=". $_POST['customerid']."");

}






?>