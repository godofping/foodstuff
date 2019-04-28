<?php
include_once("connection.php");

$restore_file  = "/home/asdfuser/public_html/dbbackups/stidb.sql";
$server_name   = "localhost";
$username      = "asdfuser";
$password      = "Allow@123#";
$database_name = "stidb";

$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";


exec($cmd);
header("Location: backup-restore.php?status=successrestore");
?>