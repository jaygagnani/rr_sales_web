<?php
require_once './db_config.php';

$db = new DbConnection;

if($_FILES['new_image_file'])
	$new_img = $_FILES['new_image_file'];
else
	$new_img = null;

$product = $db->updateProductDetails($_REQUEST['nicename'], $_REQUEST['product_id'], $_REQUEST['product_name'], $_REQUEST['product_rate'], $_REQUEST['product_per'], $_REQUEST['product_min_qty'], $_REQUEST['product_vehicle'], $_REQUEST['product_wheels'], $_REQUEST['product_desc'], $new_img);

print_r($product);

return $product;

?>