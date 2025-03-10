<?php
include("conf/mariadb.php");
$sql="UPDATE `user` SET
`username`='".$_POST["username"]."',
`password`='".$_POST["password"]."',
`user_name`='".$_POST["user_name"]."',
`address`='".$_POST["address"]."',
`Fb_line`='".$_POST["Fb_line"]."', 
`phone`='".$_POST["phone"]."',
`type_id`='".$_POST["type_id"]."'
WHERE `user_id`='".$_POST["user_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>