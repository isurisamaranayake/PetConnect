<?php
include_once('../../function/petFunction.php');

$petobject = new Pet();


 

$result = $petobject->mypetlist();

echo($result);
?>