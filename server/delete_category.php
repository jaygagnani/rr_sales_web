<?php
include_once './db_config.php';

$db = new DbConnection;

$result = $db->deleteCategory($_REQUEST['category']);

print_r($result);

return $result;

?>