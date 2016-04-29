<?php
include_once './db_config.php';

$db = new DbConnection;

$address = $db->fetchUserAddress($_REQUEST['user']);

print_r($address);

return $address;

?>