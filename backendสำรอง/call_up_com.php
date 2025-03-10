<?php
include("conf/mariadb.php");
$sql="UPDATE `comunity` SET
`com_name`='".$_POST["com_name"]."',
`com_add`='".$_POST["com_add"]."',
`com_phone`='".$_POST["com_phone"]."',
`com_img`='".$_POST["com_img"]."'
WHERE `com_id`='".$_POST["com_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>