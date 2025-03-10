<?php
@session_start();
include("../conf/mariadb.php");


$sql="SELECT * FROM `user` WHERE `username`='".$_POST["username"]."' AND `password`='".$_POST["password"]."'";
$que=mysqli_query($con,$sql);
if(mysqli_num_rows($que)!=0){    
   $re=mysqli_fetch_assoc($que);
    
			 $_SESSION["shopee"]["user_id"]=$re["user_id"];
			 $_SESSION["shopee"]["user_name"]=$re["user_name"];
			 $_SESSION["shopee"]["type_id"]=$re["type_id"];
           
    echo '{"status":"1"}';
}else{
    echo '{"status":"0"}';
}

?>