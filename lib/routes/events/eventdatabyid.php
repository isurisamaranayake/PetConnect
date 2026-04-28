<?php
include_once('../../function/eventsFunction.php');

$eventsobject = new Event();

$eventstid = $_GET['eventsid'];


 

$result = $eventsobject->eventsdatabyid($eventstid);

echo($result);
?>