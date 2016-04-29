<?php
include_once './db_config.php';

$db = new DbConnection;

$user = $db->registerNewUser($_REQUEST['full_name'], $_REQUEST['company_name'], $_REQUEST['contact_number'], $_REQUEST['email']);

print_r($user);

return $user;

?>