<?php
include_once('../../function/petFunction.php');

$petobject = new Pet();

$petid = $_GET['petid'];


 

$result = $petobject->petdatabyid($petid);

echo($result);
?>