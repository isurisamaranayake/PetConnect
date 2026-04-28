<?php
include_once('main.php');

class ImageUpload extends Main{

public function imgUpload($imagename, $imageType, $folderName, $tmpName, $id){
    $customName = $id.".".$imagename;
    $path = "../../Upload/".$folderName."/".$customName;
    $dbpath = "Upload/".$folderName."/".$customName;

    move_uploaded_file($tmpName, $path);
    return($dbpath);
}
}

?>