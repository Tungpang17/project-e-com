<?php
include '../backend/conf/mariadb.php';

@session_start();

if (!$_SESSION["shopee"]["user_id"]) {
  http_response_code(401);

  echo 'Unauthorized';
}

try {
  $data = [
    'name' => $_POST['name'] ?? '',
    'address' => $_POST['address'] ?? '',
    'phone_number' => $_POST['phone_number'] ?? ''
  ];

  if (!$data['name'] || !$data['address'] || !$data['phone_number']) {
    http_response_code(400);

    echo 'Expected \'name\', \'address\', and \'phone_number\' in body';

    return;
  }

  $sql = 'INSERT INTO `tailor` (`tailor`.`name`, `tailor`.`address`, `tailor`.`phone_number`) VALUES (?, ?, ?)';

  $statement = $con->prepare($sql);

  $statement->bind_param('sss', $data['name'], $data['address'], $data['phone_number']);

  // Inserts tailors.
  $result = $statement->execute();

  if ($result && $_FILES["image"]["name"]) {
    echo "Test";
    $last_inserted_id = $con->insert_id;
    $target_dir = "./../public/images/uploads/tailors";
    $target_file = $target_dir . basename($last_inserted_id . strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)));
    $temp = explode(".", $_FILES["image"]["name"]);
    $file_name = $last_inserted_id . '.' . end($temp);
    // echo $target_dir . "/".$file_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . "/" . $file_name);
  }


  if ($result) {
    echo 'Success';
  } else {
    http_response_code(500);

    echo 'Unexpected error';
  }
} catch (Exception $error) {
  http_response_code(500);

  echo $error;
}
