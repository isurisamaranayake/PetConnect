<?php
include_once('../../function/adoptionFunction.php');

$petobject = new Adoption();

$petid = $_GET['pet_id'];


 

$result = $petobject->interested($petid);

echo($result);
?>