<?php
include("conf/mariadb.php");
$sql="SELECT * FROM `sall_detail` 
LEFT JOIN `product` ON `sall_detail`.`product_id`=`product`.`product_id`
WHERE `sall_id`='".$_POST["sall_id"]."'";

$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

   $array[]=$re;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE); 

//echo $_POST["pro_id"];

?> 