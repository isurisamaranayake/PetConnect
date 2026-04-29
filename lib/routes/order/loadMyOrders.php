<?php
include_once('../../function/productFunction.php');

$order = new Product();

$order->loadMyOrders($_SESSION['user_id']);
?>