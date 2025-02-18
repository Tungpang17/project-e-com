<?php
include("conf/mariadb.php");
$sql="DELETE FROM `user` WHERE `user_id`='".$_POST["user_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>