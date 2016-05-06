<?php
include_once './db_config.php';

$db = new DbConnection;

$user = $db->sendContactMail($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['contact'], $_REQUEST['msg']);

print_r($user);

return $user;

?>