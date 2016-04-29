<?php
include_once './db_config.php';

$db = new DbConnection;

$cart = $db->fetchCart($_REQUEST['user']);

print_r($cart);

return $cart;

?>