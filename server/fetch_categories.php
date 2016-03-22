<?php
include_once './db_config.php';

$db = new DbConnection;

$categories = $db->fetchCategories();

return $categories;

?>