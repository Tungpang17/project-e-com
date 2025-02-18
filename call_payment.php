<?php
@session_start();
include("backend/conf/mariadb.php");
function add_pic(){
    if($_FILES["pay_file"]["size"]!=0){
        $profile_pic=substr(md5(rand(0,100)."Pay".date('i')),0,10);//เปลี่ยนชื่อ ภาพ โดยการเข้ารหัส
                $ext = pathinfo($_FILES["pay_file"]["name"],PATHINFO_EXTENSION);//นามสกุล
                
                $path="backend/img/payment/";
                
                
                $status=move_uploaded_file($_FILES["pay_file"]["tmp_name"],$path.$profile_pic.".".$ext);
                chmod ($path.$profile_pic.".".$ext, 0777);
    
                if($status){
                   return $profile_pic.".".$ext;
                }
        }else{
            return '';
        }
    }



    $sql="INSERT INTO `payments`(`order_id`, `referId`, `money`, `datetime`, `pay_file`, `pay_address`) VALUES (
        '".$_POST["order_id"]."',
        '".$_POST["referId"]."',
        '".$_POST["money"]."',
        '".$_POST["datetime"]."',
        '".add_pic()."',
        '".$_POST["pay_address"]."'
    )";

        if(mysqli_query($con,$sql)){
            
            echo '{"status":"1"}';
        }

?>