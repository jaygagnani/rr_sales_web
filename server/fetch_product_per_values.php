<?php
include_once './db_config.php';

$db = new DbConnection;

$product_per = $db->fetchDistinctPerValues();

print_r($product_per);

return $product_per;

?>