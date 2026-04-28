<?php
include_once('../../function/trackingFunction.php');

$petObject = new Tracking();

$pet_id = $_POST['pet_id'];

echo $petObject->getTracker($pet_id);
?>
