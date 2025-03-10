<?php
include("conf/mariadb.php");
$sql="DELETE FROM `product` WHERE `product_id`='".$_POST["product_id"]."'";
$que=mysqli_query($con,$sql);



$que=mysqli_query($con,$sql);
$sql="DELETE FROM `stock2`(`product_id`,`qty`) VALUES(
'".$_POST["product_id"]."',
'0'
)";


echo '{"status":"1"}';
?>