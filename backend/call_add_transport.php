<?php
include("conf/mariadb.php");
$sql =
  "UPDATE transport 
  SET 
  tra_name='" . $_POST["tra_name"] . "',
  tra_track='" . $_POST["tra_track"] . "',
  tra_date='" . $_POST["tra_date"] . "',
  tra_time='" . $_POST["tra_time"] . "'
  WHERE tra_id='" . $_POST["tra_id"] . "'";

$que = mysqli_query($con, $sql);

echo '{"status":"1"}';
?>