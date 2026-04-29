<?php
include_once('../../function/productFunction.php');

$product = new Product();
echo $product->deleteProduct($_POST['id']);
?>