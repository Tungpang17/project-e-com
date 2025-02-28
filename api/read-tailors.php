<?php
include './../backend/conf/mariadb.php';

$search = $_GET['search'] ?? '%%';

$sql =
  "SELECT * FROM `tailor`
  WHERE `tailor`.`name` LIKE ?
  ";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
$rows = [];
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}
$rows = is_array($rows) ? $rows : [];

header('Content-Type: application/json');
echo json_encode($rows);
