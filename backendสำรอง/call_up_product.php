<?php
include("conf/mariadb.php");
$sql="UPDATE `product` SET `product_id`='".$_POST["product_id"]."',
`Product_name`='".$_POST["Product_name"]."',
`Product_detail`='".$_POST["Product_detail"]."',
`product_cos`='".$_POST["product_cos"]."',
`Product_Price`='".$_POST["Product_Price"]."',
`Qty`='".$_POST["Qty"]."',
`Img`='".$_POST["Img"]."',
`type_id`='".$_POST["type_id"]."',
`com_id`='".$_POST["com_id"]."',
`pro`='".$_POST["pro"]."',
`pro_s`='".$_POST["pro_s"]."',
`pro_e`='".$_POST["pro_e"]."'
WHERE `product_id` = '".$_POST["product_id"]."'";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>