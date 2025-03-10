<?php
@session_start();
include("conf/mariadb.php");
$sum=0;
$qty=0;
$sql="INSERT INTO `sall`( `sall_date`,`monney`,`user_id`) VALUES(
'".date('Y-m-d')."',
'".$_POST["monney"]."',
 '".$_SESSION["shopee"]["user_id"]."'
)";
$que=mysqli_query($con,$sql);

$sall_id=mysqli_insert_id($con);
$taka=json_decode($_POST["taka"],true);
for ($i=0; $i < count($taka); $i++) { 

$sql="INSERT INTO `sall_detail`(`sall_id`, `product_id`, `price`, `amont`) VALUES(
'".$sall_id."',
'".$taka[$i]["pro_id"]."',
'".$taka[$i]["pro_price"]."',
'".$taka[$i]["qty"]."'
)";
$sum+=$taka[$i]["pro_price"]*$taka[$i]["qty"];
$qty+=$taka[$i]["qty"];
$que=mysqli_query($con,$sql);

$sql="UPDATE `product` SET `Qty`=`Qty`-".$taka[$i]["qty"]." WHERE `product_id`='".$taka[$i]["pro_id"]."'";
mysqli_query($con,$sql);
}

$sql="UPDATE `sall` SET 
`sall_qty`=".$qty.", 
`sall_price`=".$sum."
WHERE `sall_id`=".$sall_id."
";
$que=mysqli_query($con,$sql);

echo '{"status":"1","sall_id":"'.$sall_id.'"}';
?>