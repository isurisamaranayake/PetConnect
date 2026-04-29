<?php
include_once('../../function/eventsFunction.php');

$event = new Event();

$id = $_POST['event_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['event_date'];
$time = $_POST['event_time'];
$location = $_POST['location'];

$imageName = $_FILES['image']['name'];
$imageType = $_FILES['image']['type'];
$imageLocation = $_FILES['image']['tmp_name'];

echo $event->updateEvent(
    $id, $title, $description, $date, $time, $location,
    $imageName, $imageType, $imageLocation
);
?>