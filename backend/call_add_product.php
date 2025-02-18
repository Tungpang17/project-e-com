<?php
include("conf/mariadb.php");
$sql="INSERT INTO `product`( `Product_name`, `Product_detail`, `Product_Price`, `Qty`, `Img`,`type_id`,`product_cos`,`com_id`,`pro`,`pro_s`,`pro_e`) VALUES(
'".$_POST["Product_name"]."',
'".$_POST["Product_detail"]."',
'".$_POST["Product_Price"]."',
'".$_POST["Qty"]."',
'".$_POST["Img"]."',
'".$_POST["type_id"]."',
'".$_POST["product_cos"]."',
'".$_POST["com_id"]."',
'".$_POST["pro"]."',
'".$_POST["pro_s"]."',
'".$_POST["pro_e"]."'
)";

$que=mysqli_query($con,$sql);



echo '{"status":"1"}';
?>