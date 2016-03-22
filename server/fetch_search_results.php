<?php
include_once './db_config.php';

$db = new DbConnection;

$category = '';

if(isset($_GET['category'])){
	$category = $_GET['category'];
}

$products = $db->fetchSearchResults($category, $_GET['searchParameter']);

print_r($products);

return $products;

?>