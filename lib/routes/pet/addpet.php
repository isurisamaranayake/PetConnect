<?php
include_once('../../function/petFunction.php');

$petobject = new Pet();

$type = $_POST['type'];
$breed = $_POST['breed'];

$name = $_POST['name'];
$gender = $_POST['gender'];
$pet_age = $_POST['pet_age'];
$pet_size = $_POST['pet_size'];
$pet_color = $_POST['pet_color'];
$pet_location = $_POST['pet_location'];
$otherdetails = $_POST['otherdetails'];

$imageName = $_FILES['petimage']['name']; //file name
$imageType = $_FILES['petimage']['type']; //file type png,jpg
$imageLocation = $_FILES['petimage']['tmp_name'];

$petfor = $_POST['petfor'];
 

$result = $petobject->addpet($type, $breed, $name, $gender, $pet_age, $pet_size, $pet_color, $pet_location,
 $otherdetails, $imageName, $imageType, $imageLocation,$petfor);

echo($result);
?>