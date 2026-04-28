<?php
include_once('../../function/adoptionFunction.php');

$petobject = new Adoption();

$petid = $_GET['petid'];


 

$result = $petobject->interestlist($petid);

echo($result);
?>