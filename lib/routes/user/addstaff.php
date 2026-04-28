<?php
include_once('../../function/staffFunction.php');

$staffobject = new Staff();

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$userid = $_POST['userid'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

 

$result = $staffobject->addstaff($full_name, $email, $phone, $userid, $password, $confirm_password, $role);

echo($result);
?>