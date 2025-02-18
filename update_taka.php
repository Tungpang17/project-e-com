<?php
session_start();
include("backend/conf/mariadb.php");



$sql="SELECT * FROM `taka` 
LEFT JOIN `product` ON `taka`.`product_id` =`product`.`product_id` 
WHERE 1 AND `k_id`='".$_POST["k_id"]."' AND `Qty`>=".$_POST["amount"]."";
$quepic=mysqli_query($con,$sql);
if(mysqli_num_rows($quepic)!=0){
    $sql="UPDATE `taka` SET 
    `amount`='".$_POST["amount"]."'
    WHERE `k_id`='".$_POST["k_id"]."'
    ";
    $que=mysqli_query($con,$sql);
    header("location:taka.php");
}else{
    header("location:taka.php?alert=จำนวนสินค้ามีไม่เพียงพอ");
}


?>