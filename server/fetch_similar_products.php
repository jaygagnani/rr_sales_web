<?php
include_once './db_config.php';

$db = new DbConnection;

$products = $db->fetchSimilarProducts($_GET['product']);

if($products == false){
	echo "false";
	return null;
}

print_r($products);

return $products;

?>