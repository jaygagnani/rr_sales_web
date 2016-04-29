<?php
require_once './db_config.php';

$db = new DbConnection;

$cart = $db->updateCart($_REQUEST['user'], $_REQUEST['row_length'], $_REQUEST['nicename'], $_REQUEST['qty'], $_REQUEST['subtotal']);

//$cart = json_encode(array("status"=>"failed", "message"=>$_REQUEST['subtotal']));

print_r($cart);

return $cart;

?>