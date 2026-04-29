<?php
include_once('../../function/orderFunction.php');

$order = new Order();
echo $order->markDelivered($_POST['id']);
?>