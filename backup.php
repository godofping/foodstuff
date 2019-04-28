<?php
include_once("connection.php");
define("BACKUP_PATH", "/home/asdfuser/public_html/dbbackups/");

$server_name   = "localhost";
$username      = "asdfuser";
$password      = "Allow@123#";
$database_name = "stidb";


$cmd = "mysqldump -h {$server_name} -u {$username} -p{$password} {$database_name} cart_item_table cart_table customer_table goodies_inventory_table menu_category_table menu_item_table order_table review_table user_table > " . BACKUP_PATH . "{$database_name}.sql";


exec($cmd);
header("Location: backup-restore.php?status=successbackup");
?>

