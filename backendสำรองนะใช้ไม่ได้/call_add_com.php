<?php
include("conf/mariadb.php");
$sql="INSERT INTO `comunity`(`com_name`, `com_add`, `com_phone`, `com_img`) VALUES(
'".$_POST["com_name"]."',
'".$_POST["com_add"]."',
'".$_POST["com_phone"]."',
'".$_POST["com_img"]."'
)";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>