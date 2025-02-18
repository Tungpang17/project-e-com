<?php
include("conf/mariadb.php");
$sql="UPDATE `type` SET
`type_name`='".$_POST["type_name"]."'
WHERE `type_id`='".$_POST["type_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>