<?php
include("conf/mariadb.php");
$sql="INSERT INTO `type`(`type_name`) VALUES(
'".$_POST["type_name"]."'
)";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>