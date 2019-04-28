<?php 
session_start();


$arraylength =  count($_SESSION["orders"]);

$menuitemidvalues = array_column($_SESSION["orders"], 'menuitemid');



for ($u=0; $u < $arraylength; $u++) { 
	echo "menuitemid : ";
	print_r($_SESSION['orders'][$menuitemidvalues[$u]]['menuitemid']);
	echo " | quantity : ";
	print_r($_SESSION['orders'][$menuitemidvalues[$u]]['quantity']);
	echo "<br>";
}


for ($i=0; $i < $arraylength; $i++) { 
	if ($_SESSION['orders'][$menuitemidvalues[$i]]['menuitemid'] == $_GET['menuitemid']) {
		
		//quantity increment by one 
		$_SESSION['orders'][$_GET['menuitemid']]['quantity']++;
	}
	else
	{
		//add cart
		$_SESSION['orders'][$_GET['menuitemid']] = array('menuitemid' => $_GET['menuitemid'], 'instruction' => "",'quantity' => 1);
	}
}



 ?>