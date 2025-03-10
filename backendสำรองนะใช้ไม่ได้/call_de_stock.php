<?php
include("conf/mariadb.php");
$sql="DELETE FROM `type` WHERE `type_id`='".$_POST["type_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>