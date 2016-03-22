<?php
include_once './db_config.php';

$db = new DbConnection;

$products = $db->fetchProductDetails($_GET['category'], $_GET['product']);

print_r($products);

return $products;

?>