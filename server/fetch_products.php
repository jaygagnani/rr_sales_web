<?php
include_once './db_config.php';

$db = new DbConnection;

$products = '';

if(isset($_GET['limit'])){
	$products = $db->fetchProducts($_GET['category'], $_GET['page'], $_GET['limit']);
}else{
	$products = $db->fetchProducts($_GET['category'], $_GET['page']);
}

if($products == false){
	echo "false";
}

print_r($products);

return $products;

?>