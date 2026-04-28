<?php
include_once('../../function/adoptionFunction.php');

$petobject = new Adoption();

$interestid = $_POST['interestid'];
$transfernotes = $_POST['transfernotes'];
$ipetid = $_POST['ipetid'];
$icby = $_POST['icby'];

$imageName = $_FILES['documents']['name']; //file name
$imageType = $_FILES['documents']['type']; //file type png,jpg
$imageLocation = $_FILES['documents']['tmp_name'];
 

$result = $petobject->transferpet($interestid, $ipetid, $icby, $transfernotes,  $imageName, $imageType, $imageLocation);

echo($result);
?>