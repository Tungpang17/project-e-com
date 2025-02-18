<?php
include("conf/mariadb.php");
$sql="INSERT INTO `user`(`username`, `password`, `user_name`, `address`, `Fb_line`,`phone`,`type_id`) VALUES(
'".$_POST["username"]."',
'".$_POST["password"]."',
'".$_POST["user_name"]."',
'".$_POST["address"]."',
'".$_POST["Fb_line"]."',
'".$_POST["phone"]."',
'".$_POST["type_id"]."'
)";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>