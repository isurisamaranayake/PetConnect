<?php
include_once('../../function/productFunction.php');

$productobject = new Product();

$productid = $_GET['productid'];


 

$result = $productobject->productdatabyid($productid);

echo($result);
?>