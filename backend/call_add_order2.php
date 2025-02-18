<?php
@session_start();
include("conf/mariadb.php");




$taka=json_decode($_POST["taka"],true);
for ($i=0; $i < count($taka); $i++) { 


$sql="UPDATE `product` SET `Qty`=`Qty`+".$taka[$i]["qty"]." WHERE `product_id`='".$taka[$i]["pro_id"]."'";
mysqli_query($con,$sql);
}


echo '{"status":"1"}';
?>