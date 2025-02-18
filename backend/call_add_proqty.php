<?php
include("conf/mariadb.php");



$sql="INSERT INTO `stock`(`date_time`, `buy_id`) VALUES (
'".date("Y-m-d H:i:s")."','".$_POST["buy_id"]."')";
$que=mysqli_query($con,$sql);
$stock_id=mysqli_insert_id($con);
for($i=0;$i<count($_POST["product_id"]);$i++) {
	$sql2="UPDATE `stock2` SET `qty`=`qty`+'".$_POST["amont"][$i]."'
	WHERE `product_id` = '".$_POST["product_id"][$i]."'";
	$que2=mysqli_query($con,$sql2);

	$indetail="INSERT INTO `stock_detail`(`stock_id`, `product_id`, `price`, `qty`) VALUES (
	'".$stock_id."',
	'".$_POST["product_id"][$i]."',
	'".$_POST["product_cos"][$i]."',
	'".$_POST["amont"][$i]."'
)";
mysqli_query($con,$indetail);
	
}
if($que2){
	echo '{"status":"1"}';
}

?>