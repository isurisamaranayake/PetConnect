<?php
include_once('../../function/trackingFunction.php');

$petObject = new Tracking();

$pet_id = $_POST['pet_id'];
$trackers = json_decode($_POST['trackers'], true);

$result = $petObject->saveTracker($pet_id, $trackers);

echo $result;
?>