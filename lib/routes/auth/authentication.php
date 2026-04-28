<?php
include_once('../../function/authFunction.php');

$authobject = new Auth();

$username = $_POST['username'];
$password = $_POST['password'];
 

$result = $authobject->authentication($username,$password);

echo($result);
?>  