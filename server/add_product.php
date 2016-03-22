<?php

require_once './db_config.php';

$product_id=$_POST['id'];
$product_name=$_POST['name'];
$product_vehicle=$_POST['vehicle'];
$product_rate=$_POST['rate'];
$product_per=$_POST['per'];
$product_min_qty=$_POST['minqty'];
$product_desc=$_POST['desc'];

$product_img= null;

$db = new DbConnection;

if(!empty($_FILES['product_img_file'])){
	$img = $_FILES['product_img_file'];

	print_r($db->addProduct($product_id, $product_name, $product_vehicle, $product_rate, $product_per, $product_min_qty, $product_desc, $product_img));
}else{
	print_r($db->addProduct($product_id, $product_name, $product_vehicle, $product_rate, $product_per, $product_min_qty, $product_desc, null));
}

?>
