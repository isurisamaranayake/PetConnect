<?php
include_once('../../function/productFunction.php');

$orderObject = new Product();

$data = json_decode($_POST['order'], true);

$result = $orderObject->makeOrder($data);

echo($result);
?>