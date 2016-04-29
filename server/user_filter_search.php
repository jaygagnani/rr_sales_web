<?php
include_once './db_config.php';

$db = new DbConnection;

$result = $db->fetchUserFilterResults($_GET['vehicle'], $_GET['wheel_2'], $_GET['wheel_3'], $_GET['search_keyword']);

print_r($result);

return $result;

?>