<?php
include("conf/mariadb.php");
$sql="DELETE FROM `propic` WHERE `pic_id`='".$_GET["pic_id"]."'";
$que=mysqli_query($con,$sql);
header("location:pro-pic.php?id=".$_GET["id"]);
?>