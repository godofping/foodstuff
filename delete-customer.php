<?php

include_once('connection.php');


mysqli_query($connection, "update customer_table set isdeleted = 1 where customerid = '" . $_GET['customerid'] . "'");


		header("Location: view-customer.php?who=" . $_GET['who'] . "&status=successful");

 ?>