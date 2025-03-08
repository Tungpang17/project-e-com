<?php
@session_start();
include("backend/conf/mariadb.php");

function getIP(){
    // ตรวจสอบ IP กรณีการใช้งาน share internet
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }else{
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// การเรียกใช้ IP
$visitorIP = getIP();

$sql="SELECT * FROM `member` WHERE `m_email`='".$_POST["user"]."' AND `m_pass`='".$_POST["pass"]."' AND revoked = 0";
$que=mysqli_query($con,$sql);
if(mysqli_num_rows($que)!=0){    
    $re=mysqli_fetch_assoc($que);
    
            $id=$re["m_id"];
            // $Sit=$re["Sit"];
            // $ck_authen=substr(sha1("si".$id."fe"),10,20);
            // $ck_loginid=sha1($id."five".$ck_authen);
    
    
            $_SESSION["otop"]["ID"]=$id;
            $_SESSION["otop"]["m_fullname"]=$re["m_fullname"];
            $_SESSION["otop"]["address"]=$re["address"];

    echo '{"status":"1"}';
}else{
    echo '{"status":"0"}';
}

?>