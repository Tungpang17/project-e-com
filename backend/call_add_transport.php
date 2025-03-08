<?php
include("conf/mariadb.php");

$sql =
  "INSERT INTO transport 
  (tra_name, tra_track, tra_date, tra_time, tra_status, order_id)
  VALUES
  ('" . $_POST["tra_name"] . "', '" . $_POST["tra_track"] . "', '" . $_POST["tra_date"] . "', '" . $_POST["tra_time"] . "', '" . $_POST["tra_status"] . "', '" . $_POST["order_id"] . "')";
;

$que = mysqli_query($con, $sql);

if ($que) {
  echo "{\"status\":1}";
} else {
  echo "{\"status\":0}";
}
?>