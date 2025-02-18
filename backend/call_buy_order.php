<?php
@session_start();
include("conf/mariadb.php");
$sum=0;
$qty=0;
$sql="INSERT INTO `buy`( `buy_date`,`monney`,`com_id`,`user_id`) VALUES(
'".date('Y-m-d')."',
'".$_POST["monney"]."',
'".$_POST["com_id"]."',
 '".$_SESSION["shopee"]["user_id"]."'
)";
$que=mysqli_query($con,$sql);

$buy_id=mysqli_insert_id($con);
$orser=json_decode($_POST["orser"],true);
for ($i=0; $i < count($orser); $i++) { 

$sql="INSERT INTO `buy_detail`(`buy_id`, `product_id`, `price`, `amont`) VALUES(
'".$buy_id."',
'".$orser[$i]["pro_id"]."',
'".$orser[$i]["pro_cos"]."',
'".$orser[$i]["qty"]."'
)";

$qty+=$orser[$i]["qty"];
$tatel+=$orser[$i]["pro_cos"]*$orser[$i]["qty"];

$que=mysqli_query($con,$sql);


}

$sql="UPDATE `buy` SET 
`buy_qty`=".$qty.", 
`monney`=".$tatel."
WHERE `buy_id`=".$buy_id."
";
$que=mysqli_query($con,$sql);

echo '{"status":"1","buy_id":"'.$buy_id.'"}';
?>