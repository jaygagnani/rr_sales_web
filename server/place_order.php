<?php

include_once './db_config.php';

$db = new DbConnection;

$order = $db->placeOrder($_REQUEST['user'], $_REQUEST['order_from'], $_REQUEST['product_nicename'], $_REQUEST['product_order_qty']);

print_r($order);

return $order;

?>