<?php
include("conf/mariadb.php");
$sql="DELETE FROM `comunity` WHERE `com_id`='".$_POST["com_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>