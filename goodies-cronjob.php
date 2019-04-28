<?php 
include_once("connection.php");

$qry = mysqli_query($connection, "select * from menu_item_table where menucategoryid = 7");
while ($result = mysqli_fetch_assoc($qry)) {
	

	$qry1 = mysqli_query($connection, "select * from goodies_quantity_sold_view where orderdate like '%" . date("Y-m-d", strtotime( '-1 days' ) ) . "%' and menuitemid = '" . $result['menuitemid'] . "'");
	$result1 = mysqli_fetch_assoc($qry1);

	$qry2 = mysqli_query($connection, "select * from goodies_inventory_table where date = '" . date("Y-m-d", strtotime( '-1 days' ) ) . "' and menuitemid = '" . $result['menuitemid'] . "'");
	$result2 = mysqli_fetch_assoc($qry2);

	$menuitemid = $result['menuitemid'];
	$beg = $result2['beg'];
	$del = $result2['del'];
	$total = $beg + $del;
	$sold = $result1['sold'];
	$end = $total - $sold;
	// echo  "menuitemname: " . $result['menuitemname']  ." beg: " . $beg ." del: " . $del . " total: " . $total . " sold: " . $sold . " end: " . $end ."<br>";

	mysqli_query($connection, "update goodies_inventory_table set end = '" . $end . "' where date = '" . date("Y-m-d", strtotime( '-1 days' ) ) . "' and menuitemid = '" . $result['menuitemid'] . "'");


	mysqli_query($connection, "insert into goodies_inventory_table (menuitemid, beg, del, end, date) values ('" . $result['menuitemid'] . "', '" . $end . "', '0', 0, '" . date('Y-m-d') . "')");

}

 ?>