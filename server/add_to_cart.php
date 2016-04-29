<?php
include_once './db_config.php';

$db = new DbConnection;

$cart = $db->addToCart($_REQUEST['user'], $_REQUEST['product'], $_REQUEST['quantity']);

print_r($cart);

return $cart;

?>