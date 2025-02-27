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
