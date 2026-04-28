<?php
include_once('../../function/eventsFunction.php');

$eventobject = new Event();


$title = $_POST['title'];
$description = $_POST['description'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$location = $_POST['location'];


$imageName = $_FILES['image']['name'];
$imageType = $_FILES['image']['type'];
$imageLocation = $_FILES['image']['tmp_name'];


$result = $eventobject->addevent($title, $description, $event_date, $event_time, $location, $imageName, $imageType, $imageLocation);

echo($result);
?>