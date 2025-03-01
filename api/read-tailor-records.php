<?php
include './../backend/conf/mariadb.php';

$search = $_GET['search'] ?? '%%';

$sql =
  "SELECT 
    `tailor_record`.`id`,
    `tailor_record`.`tailor_id`,
    `tailor_record`.`product_id`,
    `tailor_record`.`quantity`,
    `tailor_record`.`created_at`,
    `tailor`.`id` as `tailor_id`,
    `tailor`.`name`,
    `product`.`product_id`,
    `product`.`Product_name`
   FROM `tailor_record`
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
