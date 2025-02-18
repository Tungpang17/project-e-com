<?php
include("conf/mariadb.php");
$sql="SELECT * FROM `user` WHERE `user_id` like '%".$_POST["user_id"]."%'";
$que=mysqli_query($con,$sql);
$re=mysqli_fetch_assoc($que);
if(mysqli_num_rows($que)>0){
   echo json_encode($re,JSON_UNESCAPED_UNICODE); 
}else{
    echo '{"status":"0"}';
}


//echo $_POST["pro_id"];

?>