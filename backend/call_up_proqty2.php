<?php
include("conf/mariadb.php");


	$sql="UPDATE `product` SET
	`Qty`= `Qty`+".$_POST["Qty"]."
	WHERE `product_id`='".$_POST["product_id"]."'";
	$que=mysqli_query($con,$sql) or die (mysqli_error());
	echo '{"status":"1"}';






?>