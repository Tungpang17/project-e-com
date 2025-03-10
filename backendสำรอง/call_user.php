<?php
include("conf/mariadb.php");
$sql="SELECT * FROM `user` LEFT JOIN `type_user` ON `user`.`type_id`=`type_user`.`type_id`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

   $array[]=$re;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE); 

//echo $_POST["pro_id"];

?>