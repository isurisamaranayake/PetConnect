<?php
include_once('../../function/eventsFunction.php');

$event = new Event();

$id = $_POST['id'];

echo $event->deleteEvent($id);
?>