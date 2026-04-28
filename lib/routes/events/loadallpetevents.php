<?php
include_once('../../function/eventsFunction.php');

$eventobject = new Event();


 

$result = $eventobject->loadallpetevents();

echo($result);
?>