<?php
include_once './db_config.php';

$db = new DbConnection;

$old_pwd = '';
$new_pwd = '';

if( ($_REQUEST['old_pwd'] == null || $_REQUEST['old_pwd'] == '') && ($_REQUEST['new_pwd'] == null || $_REQUEST['new_pwd'] == '') ){
	$old_pwd = null;
	$new_pwd = null;
}
else{
	$old_pwd = $_REQUEST['old_pwd'];
	$new_pwd = $_REQUEST['new_pwd'];
}

$user = $db->updateUserDetails($_REQUEST['user'], $_REQUEST['name'], $_REQUEST['contact'], $_REQUEST['addressline1'], $_REQUEST['addressline2'],  $_REQUEST['area'], $_REQUEST['town'], $_REQUEST['state'], $_REQUEST['pincode'], $_REQUEST['country'], $old_pwd, $new_pwd);

// $user = json_encode('abc');

print_r($user);

return $user;

?>