<?php
include_once './db_config.php';

$db = new DbConnection;

$products = $db->fetchProducts($_GET['category']);

if($products == false){
	echo "false";
}

print_r($products);

return $products;

?>