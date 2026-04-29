<?php
include_once('../../function/staffFunction.php');

$staff = new Staff();
echo $staff->resetPassword($_POST['id']);
?>