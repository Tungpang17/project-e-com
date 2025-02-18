<?php
include("conf/mariadb.php");
$conditon = "";
$leftjoin = "";
if ($_POST["conditon"] != '') {
	$conditon = " AND `type_id` ='" . $_POST["conditon"] . "'";
}
if ($_POST["leftjoin"] != "") {
	$leftjoin = "LEFT JOIN `" . $_POST["leftjoin"] . "` ON `" . $_POST["leftjoin"] . "`.`" . $_POST["leftjoin_column"] . "` = `" . $_POST["table"] . "`.`" . $_POST["table_leftjoin_column"] . "`";
}
$sql = "SELECT * FROM `" . $_POST["table"] . "` " . $leftjoin . " WHERE 1 " . $conditon;




if ($_POST["search"] != "") {
	$sql .= " AND (`product`.`product_id` LIKE '%" . $_POST["search"] . "%'  OR `product`.`Product_name` LIKE '%" . $_POST["search"] . "%')";
}

if ($_POST["com_id"] != "") {
	$sql .= " AND `com_id`='" . $_POST["com_id"] . "'";
	$sql .= " ORDER BY `product`.`Qty` ASC";
}


$que = mysqli_query($con, $sql);
if ($que->num_rows <= 0) {
	$array = array();
} else {
	while ($re = mysqli_fetch_assoc($que)) {
		$array[] = $re;
	}
}
echo json_encode($array, JSON_UNESCAPED_UNICODE);

//echo $_POST["pro_id"];
