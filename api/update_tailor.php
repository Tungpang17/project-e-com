<?php
include '../backend/conf/mariadb.php';

@session_start();

if (!$_SESSION["shopee"]["user_id"]) {
  http_response_code(401);

  echo 'Unauthorized';
}


$id = intval($_GET['id']);

if (!$id) {
  http_response_code(400);

  echo 'Expected ID parameter';
}

$data = [
  'name' => $_POST['name'] ?? '',
  'address' => $_POST['address'] ?? '',
  'phone_number' => $_POST['phone_number'] ?? ''
];

echo var_dump($data);

if (!$data['name'] || !$data['address'] || !$data['phone_number']) {
  http_response_code(400);

  echo 'Expected \'name\', \'address\', and \'phone_number\' in body';

  return;
}

$sql = 'UPDATE `tailor` SET `tailor`.`name` = ?, `tailor`.`address` = ?, `tailor`.`phone_number` = ? WHERE `tailor`.`id` = ?';

$statement = $con->prepare($sql);

$statement->bind_param('sssi', $data['name'], $data['address'], $data['phone_number'], $id);

// Inserts tailors.
$result = $statement->execute();

if ($result && $_FILES["image"]["name"]) {
  $target_dir = "./../public/images/uploads/tailors";
  $target_file = $target_dir . basename($id . strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)));
  $temp = explode(".", $_FILES["image"]["name"]);
  $file_name = $id . '.' . end($temp);
  // echo $target_dir . "/".$file_name;
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . "/" . $file_name);
}


if ($result) {
  echo 'Success';
} else {
  http_response_code(500);

  echo 'Unexpected error';
}
