<?php
include_once './db_config.php';

$db = new DbConnection;

$email = '';
$password = '';

if(isset($_REQUEST['email'])){
	$email = $_REQUEST['email'];
}

if(isset($_REQUEST['pwd'])){
	$password = $_REQUEST['pwd'];
}

if($_REQUEST['operation'] == "register"){
	$result = $db->sendNewRegisterMail($email, $password);
}

print_r($result);

return $result;

?>