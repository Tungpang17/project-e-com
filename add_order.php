<?php
session_start();
include("backend/conf/mariadb.php");

$sql="SELECT * FROM `taka` 
 LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`
WHERE `m_id`='".$_SESSION["otop"]["ID"]."'";
$que=mysqli_query($con,$sql);
if(mysqli_num_rows($que)!=0){

    $or_insert="INSERT INTO `orders`(`order_date`,`order_time` ,`m_id`) VALUES(
        '".date('Y-m-d')."',
        '".date('H:i:s')."',
        '".$_SESSION["otop"]["ID"]."'
        )";
        mysqli_query($con,$or_insert);
        $orser_id=mysqli_insert_id($con);
   while($re=mysqli_fetch_assoc($que)){
    $sql="INSERT INTO `order_detail`( `order_id`, `product_id`, `pro_amount`,`price`) VALUES (
        '".$orser_id."',
        '".$re["product_id"]."',
        '".$re["amount"]."',
        '".$re["Product_Price"]."'
        )";

        $sqlUpPro="UPDATE `product` SET `Qty`=`Qty`-'".$re["amount"]."' WHERE `product_id`='".$re["product_id"]."'";
            mysqli_query($con,$sqlUpPro);
        $que=mysqli_query($con,$sql);
        @$order_tatal+=($re["amount"]*$re["Product_Price"]);
   }
   $sql_update="UPDATE `orders` SET `order_tatal`='".$order_tatal."' WHERE `order_id`='".$orser_id."'";
   mysqli_query($con,$sql_update);
   $sql_del="DELETE FROM `taka` WHERE `m_id` ='".$_SESSION["otop"]["ID"]."'";
   mysqli_query($con,$sql_del);
}

header("location:invoice-print.php?order_id=".$orser_id);
?>