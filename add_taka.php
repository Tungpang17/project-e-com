<?php
session_start();
include("backend/conf/mariadb.php");
$sql="INSERT INTO  `taka`(`m_id`, `product_id`, `amount`) VALUES(
'".$_SESSION["otop"]["ID"]."',
'".$_GET["product_id"]."',
1
)";
$que=mysqli_query($con,$sql);
header("location:taka.php");
?>