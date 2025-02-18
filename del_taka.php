<?php
session_start();
include("backend/conf/mariadb.php");
$sql="DELETE FROM `taka` 
WHERE `k_id`='".$_GET["id"]."'
";
$que=mysqli_query($con,$sql);
header("location:taka.php");
?>