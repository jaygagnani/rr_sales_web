<?php
require_once './db_config.php';

$db = new DbConnection;

$product = $db->deleteProduct($_GET['product']);

print_r($product);

return $product;

?>