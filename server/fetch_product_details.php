<?php
include_once './db_config.php';

$db = new DbConnection;

if(isset($_GET['category']))
	$products = $db->fetchProductDetails($_GET['category'], $_GET['product']);
else
	$products = $db->fetchProductDetails(null, $_GET['product']);

print_r($products);

return $products;

?>