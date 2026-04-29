<?php
include_once('../../function/consultationFunction.php');

$petObject = new Con();

$pet_id = $_POST['pet_id'];

echo $petObject->loadpethistory($pet_id);
?>