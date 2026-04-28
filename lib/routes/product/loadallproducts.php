<?php
include_once('../../function/productFunction.php');

$productobject = new product();


 

$result = $productobject->petproducts();

echo($result);
?>