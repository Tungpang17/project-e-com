<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//header("location:update.html");exit();
$hostname= "sql109.infinityfree.com";
$database= "if0_38480136_otop";
$username= "if0_38480136";
$password= "EbytWggvCTADrP";

$con = mysqli_connect($hostname,$username,$password,$database);
//mysqli_select_db($con,$database);
date_default_timezone_set("Asia/Bangkok");
$con->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
error_reporting (E_ALL ^ E_NOTICE);
?>
