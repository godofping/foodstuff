<?php 
include_once('connection.php');


// Push The notification with parameters
require_once('PushBots.class.php');
$pb = new PushBots();
// Application ID
$appID = '59906e0d4a9efa66608b4567';
// Application Secret
$appSecret = '4448d90cf0a9b014ac99efa196cad46e';
$pb->App($appID, $appSecret);
$pb->Alias(2);
$pb->Platform(array(0,1,2,3,4,5));
// Notification Settings
$pb->Alert("hello");
$pb->Push();

//sir himuah lng nga php sir.. amo ni ang mag send.
// kag ari pa sir oh.. PushBots.class.php 
//paste lng ni sa folder opod sang 
//mag send sang notif..


 ?>