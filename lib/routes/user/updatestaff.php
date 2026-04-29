<?php
include_once('../../function/staffFunction.php');

$staff = new Staff();

echo $staff->updateStaff(
    $_POST['staff_id'],
    $_POST['full_name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['userid'],
    $_POST['role']
);
?>