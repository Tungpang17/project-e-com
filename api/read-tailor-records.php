<?php
include './../backend/conf/mariadb.php';

$search = $_GET['search'] ?? '%%';

$sql =
  "SELECT * FROM `tailor_record`
  LEFT JOIN `tailor` ON `tailor_record`.`tailor_id` = `tailor`.`id`
  LEFT JOIN `product` ON `tailor_record`.`product_id` = `product`.`product_id`
  WHERE `tailor`.`name` LIKE ?
  OR `product`.`Product_name` LIKE ?
  ";

$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
$rows = [];
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}
$rows = is_array($rows) ? $rows : [];

header('Content-Type: application/json');
echo json_encode($rows);
