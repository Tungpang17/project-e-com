<?php
include("conf/mariadb.php");
$sql="INSERT INTO `member`( `m_fullname`, `m_phone`, `m_email`, `address`, `m_pass`, `m_datetime`) VALUES(
'".$_POST["m_fullname"]."',
'".$_POST["m_phone"]."',
'".$_POST["m_email"]."',
'".$_POST["address"]."',
'".$_POST["m_pass"]."',
'".date('Y-m-d H:i:s')."'
)";
$que=mysqli_query($con,$sql);
echo '{"status":"1"}';
?>