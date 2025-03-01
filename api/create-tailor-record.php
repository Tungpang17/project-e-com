<?php
include '../backend/conf/mariadb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tailor_id = $_POST['tailor_id'];
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  $sql =
    "INSERT INTO tailor_record (tailor_id, product_id, quantity) VALUES ($tailor_id, $product_id, $quantity);
      UPDATE product SET Qty = Qty + $quantity WHERE product_id = $product_id;
    ";

  if ($con->multi_query($sql) === TRUE) {
    http_response_code(201);

    echo json_encode(['status' => 'success']);
  } else {
    http_response_code(500);

    echo json_encode(['status' => $con->error]);
  }
} else {
  http_response_code(400);

  echo json_encode(['status' => 'error']);
}

?>