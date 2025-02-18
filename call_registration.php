<?php
@session_start();
include("backend/conf/mariadb.php");



$sql="SELECT * FROM `member` WHERE `m_email`='".$_POST["m_email"]."'";
$que=mysqli_query($con,$sql);
if(mysqli_num_rows($que)!=0){
    echo '{"status":"0"}';
}
else{
    $sql="INSERT INTO `member`(`m_fullname`, `m_phone`, `m_email`, `m_pass`,`address`)  VALUES (
        '".$_POST["m_fullname"]."',
        '".$_POST["m_phone"]."',
        '".$_POST["m_email"]."',
        '".$_POST["m_pass"]."',
        '".$_POST["address"]."'
    )";

        if(mysqli_query($con,$sql)){
            
            echo '{"status":"1"}';
        }

        
}
?>