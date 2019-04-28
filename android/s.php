<?php 
	include_once '../connection.php';

	echo implode($_SESSION["orders"], " ");

	echo "<br>-----------<br>";

	$orderslength = count($_SESSION["orders"]);
	unset($_SESSION["orders"]["6"]);

	for($i = 0; $i < $orderslength; $i++)
	{
		$qry = mysqli_query($connection,"select * from menu_item_table where menuitemid = '" . $_SESSION["orders"][$i] . "'");
		$result = mysqli_fetch_assoc($qry);
		echo $result['menuitemname'] . "<br>";
		
	}
	echo "-------------------<br>";

	$result = array_merge_recursive($_SESSION["orders"]);
	print_r($result);

 ?>

