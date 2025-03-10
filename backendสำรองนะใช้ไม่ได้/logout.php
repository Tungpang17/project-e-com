<?php
session_start();
if(isset($_SESSION["shopee"])){
    unset ($_SESSION["shopee"]); 
}
header("location:index.php");
?>