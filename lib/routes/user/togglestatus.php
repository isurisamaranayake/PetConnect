<?php
include_once('../../function/staffFunction.php');

$staff = new Staff();
echo $staff->toggleStatus($_POST['id']);
?>