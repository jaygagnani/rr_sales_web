<?php
include_once './db_config.php';

$db = new DbConnection;

$user = $db->sendOrderInvoiceMail($_REQUEST['user'], $_REQUEST['order']);

print_r($user);

return $user;

?>