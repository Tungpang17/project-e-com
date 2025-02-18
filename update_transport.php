<?php
session_start();
include("backend/conf/mariadb.php");
$sql="UPDATE `transport` SET 
`tra_status`=1
WHERE `tra_id`='".$_GET["tra_id"]."'
";
$que=mysqli_query($con,$sql);
header("location:order.php");
?>