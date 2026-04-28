<?php
include_once('../../function/consultationFunction.php');

$obj = new Con();

$id = $_POST['id'];
$status = $_POST['status'];

echo $obj->updateStatus($id, $status);
?>