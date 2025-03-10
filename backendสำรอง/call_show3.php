<?php
include("conf/mariadb.php");
$sql="SELECT * FROM `buy`
LEFT JOIN `comunity` ON `buy`.`com_id`=`comunity`.`com_id`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

   $array[]=$re;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE); 

//echo $_POST["pro_id"];

?>