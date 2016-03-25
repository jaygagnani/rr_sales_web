<?php
session_start();
print_r($_SESSION['category_nicename']);
require_once './db_config.php';

$product_id=$_POST['product_id'];
$product_name=$_POST['product_name'];
$product_vehicle=$_POST['vehicle_name'];
$product_rate=$_POST['rate'];
$product_per=$_POST['per'];
$product_min_qty=$_POST['min_quantity'];
$product_desc=$_POST['product_description'];

$product_img = null;

$db = new DbConnection;

if(!empty($_FILES['product_img_file'])){
	$product_img = $_FILES['product_img_file'];

	print_r($db->addProduct($_SESSION['category_nicename'], $product_id, $product_name, $product_vehicle, $product_rate, $product_per, $product_min_qty, $product_desc, $product_img));
}else{
	print_r($db->addProduct($_SESSION['category_nicename'], $product_id, $product_name, $product_vehicle, $product_rate, $product_per, $product_min_qty, $product_desc, null));
}

?>
