<?php
include_once('../../function/petFunction.php');

$petobject = new Pet();


 

$result = $petobject->filteredpetlistforadoption($_GET['category'], $_GET['pet_age'], $_GET['pet_size'] , $_GET['petlocation']);

echo($result);
?>