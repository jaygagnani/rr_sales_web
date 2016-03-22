<?php
require_once './db_config.php';

$category_name= null;
$category_img= null;

$db = new DbConnection;

if(isset($_POST['category_name'])){
	$category_name = $_POST['category_name'];

	if(!empty($_FILES['category_img_file'])){
		$category_img = $_FILES['category_img_file'];

		print_r($db->addCategory($category_name, $category_img));
	}else{
		print_r($db->addCategory($category_name, null));
	}
}
?>