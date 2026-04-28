<?php
include_once('../../function/consultationFunction.php');

$obj = new Con();

$id = $_POST['id'];
$answer = $_POST['answer'];

echo $obj->submitAnswer($id, $answer);
?>