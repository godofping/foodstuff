<?php 
include_once('connection.php');

// add
if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'add-user') {

	$qry = mysqli_query($connection, "select * from user_table where username = '" . $_POST['username'] . "'");

	if (mysqli_num_rows($qry) > 0) {
		header("Location: add-user.php?status=failed&username=" . $_POST['username'] . "");
	}
	else
	{
		mysqli_query($connection, "insert into user_table (firstname, middlename, lastname, username, password, userlevel) values ('" . $_POST['firstname'] . "', '" . $_POST['middlename'] . "', '" . $_POST['lastname'] . "', '" . $_POST['username'] . "', '" . md5($_POST['password']) . "', '" . $_POST['userlevel'] . "') ");


		

		header("Location: add-user.php?status=successful&who=" . $_POST['firstname'] . " " . $_POST['middlename'] . " " . $_POST['lastname'] . "");
	}
}


if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'add-customer') {

	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_GET['username'] . "'");
	

	if (mysqli_num_rows($qry) > 0) {
		header("Location: add-customer.php?status=failed&username=" . $_GET['username'] . "");
	}
	else
	{
		mysqli_query($connection, "insert into customer_table (firstname, middlename, lastname, address, emailaddress, contactnumber, username, password) values ('" . $_GET['firstname'] . "', '" . $_GET['middlename'] . "', '" . $_GET['lastname'] . "', '" . $_GET['address'] . "', '" . $_GET['emailaddress'] . "', '" . $_GET['contactnumber'] . "', '" . $_GET['username'] . "', '" . md5($_GET['password']) . "')");

		header("Location: add-customer.php?status=successful&who=" . $_GET['firstname'] . " " . $_GET['middlename'] . " " . $_GET['lastname'] . "");
	}
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'android-add-customer') {

	$qry = mysqli_query($connection, "select * from customer_table where username = '" . $_GET['username'] . "'");
	

	if (mysqli_num_rows($qry) > 0) {
		header("Location: android/create-account.php?status=failed&username=" . $_GET['username'] . "");
	}
	else
	{
		mysqli_query($connection, "insert into customer_table (firstname, middlename, lastname, address, emailaddress, contactnumber, username, password,gender, birthdate, isactivated) values ('" . $_GET['firstname'] . "', '" . $_GET['middlename'] . "', '" . $_GET['lastname'] . "', '" . $_GET['address'] . "', '" . $_GET['emailaddress'] . "', '" . $_GET['contactnumber'] . "', '" . $_GET['username'] . "', '" . md5($_GET['password']) . "', '" . $_GET['gender'] . "', '" . $_GET['birthdate'] . "', '0')");

		header("Location: android/create-account.php?status=successful&who=" . $_GET['firstname'] . " " . $_GET['middlename'] . " " . $_GET['lastname'] . "");
	}
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'add-food') {


		$uploaddir = 'images/menu_images/';
		$uploadfile = $uploaddir . basename($_FILES['imagetoupload']['name']);

		echo "<p>";

		if (move_uploaded_file($_FILES['imagetoupload']['tmp_name'], $uploadfile)) {
		  echo "File is valid, and was successfully uploaded.\n";
		} else {
		   echo "Upload failed";
		}

		if ($uploadfile == 'images/menu_images/') {
			$uploadfile = 'images/menu_images/image_not_available.jpg';
		}

		



			mysqli_query($connection, "insert into menu_item_table (menucategoryid, menuitemname, price, imagelocation, menuitemdescription) values ('" . $_POST['menucategoryid'] . "', '" . $_POST['menuitemname'] . "', '" . $_POST['price'] . "', '" . $uploadfile .  "', '" . $_POST['menuitemdescription'] . "')");

			$qry = mysqli_query($connection, "select * from menu_category_table where menucategoryid = '" . $_POST['menucategoryid'] . "'");
			$result = mysqli_fetch_assoc($qry);

		header("Location: add-food.php?status=successful&what=" . $_POST['menuitemname'] . "&menucategory=". $result['menucategoryname'] ."");
	
}

// update

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'change-user-password') {

		mysqli_query($connection, "update user_table set password = '" . md5($_POST['newpassword']) . "' where userid = '" . $_POST['userid'] . "'");

		$qry = mysqli_query($connection, "select * from user_view where userid = '" . $_POST['userid'] . "'");
		$result = mysqli_fetch_assoc($qry);

		header("Location: view-user.php?who=" . $result['fullname'] . "&status=successfulchangepass");
}



if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-user') {

		mysqli_query($connection, "update user_table set firstname = '" . $_POST['firstname'] . "', middlename = '" . $_POST['middlename'] . "', lastname = '" . $_POST['lastname'] . "', uselevel = '" . $_POST['uselevel'] . "' where userid = '" . $_POST['userid'] . "'");

		$qry = mysqli_query($connection, "select * from user_view where userid = '" . $_POST['userid'] . "'");
		$result = mysqli_fetch_assoc($qry);

		header("Location: view-user.php?who=" . $result['fullname'] . "&status=successfulupdateaccount");
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'change-customer-password') {

		mysqli_query($connection, "update customer_table set password = '" . md5($_POST['newpassword']) . "' where customerid = '" . $_POST['customerid'] . "'");

		$qry = mysqli_query($connection, "select * from customer_view where customerid = '" . $_POST['customerid'] . "'");

		$result = mysqli_fetch_assoc($qry);

		header("Location: view-customer.php?who=" . $result['fullname'] . "&status=successfulchangepass");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'change-profile-password') {
		$qry = mysqli_query($connection, "select * from user_table where userid = '" . $_SESSION['userid'] . "'");
		$result = mysqli_fetch_assoc($qry);

		if (md5($_POST['oldpassword']) == $result['password']) {
			mysqli_query($connection, "update user_table set password = '" . md5($_POST['newpassword']) . "' where userid = '" . $_SESSION['userid'] . "'");
			header("Location: profile.php?customerid=" . $_SESSION['userid'] . "&status=successfulpassword");
		}
		else
		{
			header("Location: profile.php?customerid=" . $_SESSION['userid'] . "&status=failedpassword");
		}

		

	
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-customer') {

		mysqli_query($connection, "update customer_table set firstname = '" . $_POST['firstname'] . "', middlename = '" . $_POST['middlename'] . "', lastname = '" . $_POST['lastname'] . "', address = '" . $_POST['address'] . "', emailaddress = '" . $_POST['emailaddress'] . "', contactnumber = '" . $_POST['contactnumber'] . "' where customerid = '" . $_POST['customerid'] . "'");

		$qry = mysqli_query($connection, "select * from customer_view where customerid = '" . $_POST['customerid'] . "'");
		$result = mysqli_fetch_assoc($qry);

		header("Location: view-customer.php?who=" . $result['fullname'] . "&status=successfulupdateaccount");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-food') {

		$uploaddir = 'images/menu_images/';
		$uploadfile = $uploaddir . basename($_FILES['imagetoupload']['name']);

		echo "<p>";

		if (move_uploaded_file($_FILES['imagetoupload']['tmp_name'], $uploadfile)) {
		  echo "File is valid, and was successfully uploaded.\n";
		} else {
		   echo "Upload failed";
		}



		if ($uploadfile == 'images/menu_images/') {
			mysqli_query($connection, "update menu_item_table set menucategoryid = '" . $_POST['menucategoryid'] . "', menuitemname = '" . $_POST['menuitemname'] . "', menuitemdescription = '" . $_POST['menuitemdescription'] . "', price = '" . $_POST['price'] . "' where menuitemid = '" . $_POST['menuitemid'] . "'");
		}
		else
		{
			mysqli_query($connection, "update menu_item_table set menucategoryid = '" . $_POST['menucategoryid'] . "', menuitemname = '" . $_POST['menuitemname'] . "', menuitemdescription = '" . $_POST['menuitemdescription'] . "', price = '" . $_POST['price'] . "', imagelocation = '" . $uploadfile .  "' where menuitemid = '" . $_POST['menuitemid'] . "'");	
		}


		

	header("Location: view-food.php?menuitemid=" . $_POST['menuitemid'] . "&status=successfulupdated&what=" . $_POST['menuitemname'] . "");
}	

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'update-profile') {

		mysqli_query($connection, "update user_table set firstname = '" . $_POST['firstname'] . "', middlename = '" . $_POST['middlename'] . "', lastname = '" . $_POST['lastname'] . "' where userid = '" . $_SESSION["userid"] . "'");

		header("Location: profile.php?userid=" . $_POST['userid'] . "&status=successful");
}


if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-ordering-and-booking' and $_GET['whattodo'] == 'approve') {

		mysqli_query($connection, "update order_table set isapproved = '1', userid = '" . $_SESSION['userid'] . "'  where orderid = '" . $_GET["orderid"] . "'");
	
					$msg = "Your order with the order id " . $_GET['orderid'] . " is approved";

					// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_GET['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();


		  header("Location: view-ordering-and-booking.php?in=". $_GET['in'] ."");
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-ordering-and-booking' and $_GET['whattodo'] == 'cancel') {

		mysqli_query($connection, "update order_table set isapproved = '2', userid = '" . $_SESSION['userid'] . "'  where orderid = '" . $_GET["orderid"] . "'");

					$msg = "Your order with the order id " . $_GET['orderid'] . " is cancelled";

					// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_GET['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();
	

		 header("Location: view-ordering-and-booking.php");
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-ordering-and-booking' and $_GET['whattodo'] == 'finish') {

		mysqli_query($connection, "update order_table set isapproved = '3', userid = '" . $_SESSION['userid'] . "'  where orderid = '" . $_GET["orderid"] . "'");
	

		 header("Location: view-list-of-orders.php");
}


// delete

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-user' and $_GET['whattodo'] == 'delete') {

		mysqli_query($connection, "update user_table set isdeleted = 1 where userid = '" . $_GET['userid'] . "'");

		header("Location: view-user.php?who=" . $_GET['who'] . "&status=successful");
}

// if (isset($_POST['sourcepage']) and $_GET['sourcepage'] == 'view-customer' and $_GET['whattodo'] == 'delete') {

// 		mysqli_query($connection, "delete from customer_table where customerid = '" . $_GET['customerid'] . "'");

// 		header("Location: view-customer.php?who=" . $_GET['who'] . "&status=successful");
// }



if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-food' and $_GET['whattodo'] == 'makeavailable') {

		mysqli_query($connection, "update menu_item_table set isavailable = '0' where menuitemid = '" . $_GET['menuitemid'] . "'");

		header("Location: view-food.php?which=" . $_GET['which'] . "&status=successfulmakeavailable");
		
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-food' and $_GET['whattodo'] == 'makenotavailable') {

		mysqli_query($connection, "update menu_item_table set isavailable = '1' where menuitemid = '" . $_GET['menuitemid'] . "'");

		header("Location: view-food.php?which=" . $_GET['which'] . "&status=successfulmakenotavailable");
		
}



if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-food' and $_GET['whattodo'] == 'delete') {

		mysqli_query($connection, "delete from menu_item_table where menuitemid = '" . $_GET['menuitemid'] . "'");

		header("Location: view-food.php?which=" . $_GET['which'] . "&status=successful");
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-review' and $_GET['whattodo'] == 'delete') {

		mysqli_query($connection, "delete from review_table where reviewid = '" . $_GET['reviewid'] . "'");

		header("Location: view-review.php?who=" . $_GET['who'] . "&status=successful");
}

if (isset($_GET['sourcepage']) and $_GET['sourcepage'] == 'view-ordering-and-booking' and $_GET['whattodo'] == 'delete') {

		mysqli_query($connection, "update order_table set isdeleted = 1  where orderid = '" . $_GET["orderid"] . "'");
			$msg = "Your order with the order id " . $_GET['orderid'] . " is deleted";

					// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_GET['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();

		 header("Location: view-list-of-deleted-orders.php");
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-list-of-orders') {
		mysqli_query($connection, "update order_table set isapproved = '" . $_POST['isapproved'] . "',userid = '" . $_SESSION['userid'] . "',isseenbycusomter = 0 where orderid = '" . $_POST['orderid'] . "'");



					$msg = "Your order with the order id " . $_POST['orderid'] . " is ";

					if ($_POST['isapproved'] == 1) {
						$msg = $msg + "approved";

						// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_POST['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();
					}
					elseif ($_POST['isapproved'] == 4) {
						$msg = $msg + "is being prepared";

						// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_POST['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();
					}
					elseif ($_POST['isapproved'] == 5) {
						$msg = $msg + "is ready to pickup";

						// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_POST['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();	
					}
					elseif ($_POST['isapproved'] == 6) {
						$msg = $msg + "is unclaimed";

						// Push The notification with parameters
					require_once('PushBots.class.php');
					$pb = new PushBots();
					// Application ID
					$appID = '59906e0d4a9efa66608b4567';
					// Application Secret
					$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
					$pb->App($appID, $appSecret);
					$pb->Alias($_POST['customerid']);
					$pb->Platform(array(0,1,2,3,4,5));
					// Notification Settings
					$pb->Alert($msg);
					$pb->Push();	
					}

					

		header("Location: view-list-of-orders.php");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'settings-goodies-inventory') {
		
		 header("Location: settings-goodies-inventory.php?date=". $_POST['date'] ."");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'reports-goodies-inventory') {
		
		 header("Location: reports-goodies-inventory.php?date=". $_POST['date'] ."");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'reports-add-del') {
		mysqli_query($connection, "update goodies_inventory_table set del = '" . $_POST['del'] . "' where inventoryid = '" . $_POST['inventoryid'] . "'");
		header("Location: reports-goodies-inventory.php?date=". $_POST['date'] ."");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'settings-add-del') {
		mysqli_query($connection, "update goodies_inventory_table set del = '" . $_POST['del'] . "' where inventoryid = '" . $_POST['inventoryid'] . "'");
		header("Location: settings-goodies-inventory.php?date=". $_POST['date'] ."");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'reports-edit-del') {
		mysqli_query($connection, "update goodies_inventory_table set del = '" . $_POST['del'] . "' where inventoryid = '" . $_POST['inventoryid'] . "'");
		header("Location: reports-goodies-inventory.php?date=". $_POST['date'] ."");	
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'settings-edit-del') {
		mysqli_query($connection, "update goodies_inventory_table set del = '" . $_POST['del'] . "' where inventoryid = '" . $_POST['inventoryid'] . "'");
		header("Location: settings-goodies-inventory.php?date=". $_POST['date'] ."");	
}


if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-list-of-orders-change-date') {


		header("Location: view-list-of-orders.php?date=". $_POST['date'] . "");
}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-conversations') {

	mysqli_query($connection, "insert into review_conversation_table (reviewid, datetime, message, userid) values ('" . $_POST['reviewid'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['message'] . "', '" . $_SESSION['userid'] . "')");

	echo "insert into review_conversation_table (reviewid, datetime, message, userid) values ('" . $_POST['reviewid'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['message'] . "', '" . $_SESSION['userid'] . "')";

	header("Location: view-conversations.php?reviewid=". $_POST['reviewid'] . "");

}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-list-of-orders-change-date-approved') {

	header("Location: view-ordering-and-booking.php?in=" . $_POST['in'] . "&a=1&date=". $_POST['date'] ."");

}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'arhives-goodies-inventory') {

	header("Location: archives-goodies-inventory.php?a=1&date=". $_POST['date'] ."");

}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'arhives-view-bills-of-customer') {

	header("Location: view-bills-of-customer.php?a=1&date=". $_POST['date'] ."");

}

if (isset($_POST['sourcepage']) and $_POST['sourcepage'] == 'view-review-archive') {

	header("Location: view-review.php?in=archives&a=1&date=". $_POST['date'] ."");

}




 ?>