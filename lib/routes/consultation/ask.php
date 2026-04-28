<?php
include_once('../../function/consultationFunction.php');

$petbject = new Con();

$petid = $_POST['petid'];
$description = $_POST['description'];
$priority = $_POST['priority']; 

$imageName = $_FILES['document']['name'];
$imageType = $_FILES['document']['type'];
$imageLocation = $_FILES['document']['tmp_name'];

$result = $petbject->askquestion($petid, $description, $priority, $imageName, $imageType, $imageLocation);

echo($result);
?>