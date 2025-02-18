<?php
session_start();
if(isset($_SESSION["otop"])){
    unset ($_SESSION["otop"]); 
}
header("location:index.php");
?>