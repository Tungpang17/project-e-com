<?php
include("conf/mariadb.php");
$sql="DELETE FROM `member` WHERE `m_id`='".$_POST["m_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>