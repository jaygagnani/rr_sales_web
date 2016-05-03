<?php
include_once './db_config.php';

$db = new DbConnection;

$count = $db->countCart($_REQUEST['user']);

print_r($count);

return $count;

?>