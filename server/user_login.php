<?php
session_start();
include_once './db_config.php';
$db=new DbConnection();


$user_login=$db->loginUser($_POST['email'],$_POST['password']);

$decode_login = json_decode($user_login, true);

if(isset($decode_login['user_email'])){
    $_SESSION['user'] = $decode_login['user_email'];
    $_SESSION['user_role'] = $decode_login['user_role'];
    $_SESSION['user_name'] = $decode_login['user_name'];
}

print_r($user_login);
return $user_login;

?>
