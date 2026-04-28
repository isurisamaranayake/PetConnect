<?php
include_once('../../function/authFunction.php');

$authobject = new Auth();

$email = $_POST['email'];
$name = $_POST['username'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$usertype = $_POST['type']; 

$result = $authobject->registration($email,$name,$phone,$password,$usertype);

echo($result);
?>