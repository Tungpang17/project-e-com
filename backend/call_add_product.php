<?php
include("conf/mariadb.php");
$sql="INSERT INTO `product`( `Product_name`, `Product_detail`, `Product_Price`, `Qty`, `Img`,`type_id`,`product_cos`,`com_id`,`pro`,`pro_s`,`pro_e`) VALUES(
'".$_POST["Product_name"]."',
'".$_POST["Product_detail"]."',
'".$_POST["Product_Price"]."',
'".$_POST["Qty"]."',
'".$_POST["Img"]."',
'".$_POST["type_id"]."',
'".$_POST["product_cos"]."',
'".$_POST["com_id"]."',
'".$_POST["pro"]."',
'".$_POST["pro_s"]."',
'".$_POST["pro_e"]."'
)";

$que=mysqli_query($con,$sql);
$last_inserted_id = $con->insert_id;
$target_dir = "img/product";
$target_file = $target_dir . basename($last_inserted_id . strtolower(pathinfo($_FILES["picture"]["name"],PATHINFO_EXTENSION)));
$temp=explode(".",$_FILES["picture"]["name"]);
$file_name=$last_inserted_id.'.'.end($temp);
// echo $target_dir . "/".$file_name;
move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir . "/".$file_name);
    
  

$propic_sql = "INSERT INTO `propic` (`product_id`, `pic_url`) VALUES ('$last_inserted_id', '".$file_name."')";

mysqli_query($con, $propic_sql);


echo '{"status":"1"}';
?>