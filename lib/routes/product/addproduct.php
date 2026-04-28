<?php
include_once('../../function/productFunction.php');

$productobject = new Product();


$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$cost_price = $_POST['cost_price'];
$stock_quantity = $_POST['stock_quantity'];


$imageName = $_FILES['product_image']['name'];
$imageType = $_FILES['product_image']['type'];
$imageLocation = $_FILES['product_image']['tmp_name'];


$result = $productobject->addproduct($product_name, $description, $price, $cost_price, $stock_quantity, $imageName, $imageType, $imageLocation );

echo($result);
?>