<?php
include("conf/mariadb.php");
$conditon="";
if($_POST["conditon2"]!=''){
$conditon=" WHERE `com_id` ='".$_POST["conditon2"]."'";
}
if($_POST["com_id"]!=""){
	$sql.= " AND `com_id`='".$_POST["com_id"]."')";
}
$sql="SELECT * FROM `".$_POST["table"]."` ".$conditon;
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

   $array[]=$re;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE); 

//echo $_POST["pro_id"];

?>