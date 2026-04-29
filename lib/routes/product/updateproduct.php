<?php
include_once('../../function/productFunction.php');

$product = new Product();

echo $product->updateProduct(
    $_POST['product_id'],
    $_POST['product_name'],
    $_POST['description'],
    $_POST['price'],
    $_POST['cost_price'],
    $_POST['stock_quantity'],
    $_FILES['product_image']['name'],
    $_FILES['product_image']['type'],
    $_FILES['product_image']['tmp_name']
);
?>