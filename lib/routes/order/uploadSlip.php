<?php

include_once('../../function/productFunction.php');

$order = new Product();

$order_id = $_POST['order_id'];

$imageName = $_FILES['slip']['name'];
$imageType = $_FILES['slip']['type'];
$imageTmp  = $_FILES['slip']['tmp_name'];

echo $order->uploadSlip($order_id, $imageName, $imageType, $imageTmp);
?>