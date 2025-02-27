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

  echo ('Expected ID parameter');
}

$sql = 'DELETE FROM `tailor` WHERE `tailor`.`id` = ?';

$statement = $con->prepare($sql);

$statement->bind_param('i', $id);

// Inserts tailors.
$result = $statement->execute();

if ($result) {
  echo 'Success';
} else {
  http_response_code(500);

  echo 'Unexpected error';
}
