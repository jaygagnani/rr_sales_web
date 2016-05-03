<?php
include_once './db_config.php';

$db = new DbConnection;

$param = '';
$type = '';

if(isset($_REQUEST['user'])){
	$param = $_REQUEST['user'];
	$type = "user";
}
else{
	$param = null;
	$type = "user_role";
}

$order_history = $db->fetchOrderHistory($type, $param);

print_r($order_history);

return $order_history;

?>