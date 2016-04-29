<?php
include_once './db_config.php';

$db = new DbConnection;

$vehicles = $db->fetchDistinctVehicleNames();

print_r($vehicles);

return $vehicles;

?>