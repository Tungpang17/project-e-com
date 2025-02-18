<?php
include("conf/mariadb.php");
$sql="UPDATE `member` SET 
`m_fullname`='".$_POST["m_fullname"]."',

`m_phone`='".$_POST["m_phone"]."',
`m_email`='".$_POST["m_email"]."',
`address`='".$_POST["address"]."',
`m_pass`='".$_POST["m_pass"]."',
`m_datetime`='".$_POST["m_datetime"]."'
WHERE `m_id`='".$_POST["m_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>