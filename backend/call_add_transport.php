<?php
include("conf/mariadb.php");
$sql="INSERT INTO `transport`(`order_id`, `tra_name`, `tra_track`, `tra_date`, `tra_time`) VALUES (
'".$_POST["order_id"]."',
'".$_POST["tra_name"]."',
'".$_POST["tra_track"]."',
'".$_POST["tra_date"]."',
'".$_POST["tra_time"]."'
)";

$que=mysqli_query($con,$sql);



echo '{"status":"1"}';
?>