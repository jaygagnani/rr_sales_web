<?php
include_once './db_config.php';

$db = new DbConnection;

$products = $db->uploadImage($_FILES['category_img_file'], "categories");

print_r($products);

?>