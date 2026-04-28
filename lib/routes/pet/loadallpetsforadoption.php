<?php
include_once('../../function/petFunction.php');

$petobject = new Pet();


 

$result = $petobject->petlistforadoption();

echo($result);
?>