<?php
include_once './db_config.php';

$db = new DbConnection;

$addressline2 = $_POST['addressline2'];

if($addressline2 == ""){
	$addressline2 = null;
}

$address_change = $db->addAddressToUser($_POST['email'], $_POST['addressline1'], $addressline2, $_POST['area'], $_POST['town'], $_POST['pincode'], $_POST['state'], $_POST['country']);

print_r($address_change);

return $address_change;

?>