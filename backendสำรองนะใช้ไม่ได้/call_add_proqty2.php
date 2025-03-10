<?php
include("conf/mariadb.php");
$sql="UPDATE `product` SET
`Qty`='".$_POST["Qty"]."',
WHERE `product_id`='".$_POST["product_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>