<?php
include("conf/mariadb.php");
$sql="UPDATE `payments` SET
`pay_status`=1
WHERE `pay_id`='".$_GET["pay_id"]."'";
$que=mysqli_query($con,$sql);
header("location:payment.php");
?>