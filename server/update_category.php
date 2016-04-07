<?php
require_once './db_config.php';

$category_nicename = null;
$category_new_name = null;
$category_img = null;

$db = new DbConnection;

if(isset($_GET['category_new_name'])){
	$category_nicename = $_GET['category'];
	$category_new_name = $_GET['category_new_name'];

	if(isset($_FILES['category_img_file'])){
		if(!empty($_FILES['category_img_file'])){
			$category_img = $_FILES['category_img_file'];

			//print_r($db->addCategory($category_name, $category_img));
		}
	}else{
		$category_nicename = $db->updateCategory($category_nicename, $category_new_name, null);
		if($category_nicename){
			$_SESSION['category_nicename'] = $category_nicename;
			print_r($_SESSION['category_nicename']);
		}else{
			print_r("Sorry! An error occured. Category Name was not updated.");
		}
	}
}
?>