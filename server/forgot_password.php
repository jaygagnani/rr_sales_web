<?php
include_once './db_config.php';

$db = new DbConnection;

$reply = $db->forgotPassword($_REQUEST['email']);

print_r($reply);

return $reply;

?>