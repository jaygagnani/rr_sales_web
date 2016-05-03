<?php
include_once './db_config.php';

$db = new DbConnection;

$user = $db->fetchUserDetails($_REQUEST['user']);

print_r($user);

return $user;

?>