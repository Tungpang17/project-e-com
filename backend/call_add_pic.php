<?php
include("conf/mariadb.php");
@session_start();

function add_pic(){
    if($_FILES["file"]["size"]!=0){
        $profile_pic=substr(md5(rand(0,1000)."Td".date('i')),0,10);//เปลี่ยนชื่อ ภาพ โดยการเข้ารหัส
                $ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);//นามสกุล
                
                $path="img/product/";
                
                
                $status=move_uploaded_file($_FILES["file"]["tmp_name"],$path.$profile_pic.".".$ext);
                chmod ($path.$profile_pic.".".$ext, 0777);
    
                if($status){
                   return $profile_pic.".".$ext;
                }
        }else{
            return '';
        }
    }


 $sql="INSERT INTO `propic`( `product_id`, `pic_url`) VALUES (
        '".$_POST["product_id"]."',
        '".add_pic()."'
    )";

        if(mysqli_query($con,$sql)){
            echo '{"status":"1"}';
        }


?>