<?php
include '../backend/conf/mariadb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $tailor_id = $_POST['tailor_id'];
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  $sql = "SELECT * FROM tailor_record WHERE id = $id";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_quantity = $row["quantity"];
  }

  $difference = $quantity - $existing_quantity;

  $sql =
    "UPDATE tailor_record SET tailor_id = $tailor_id, product_id = $product_id, quantity = $quantity WHERE id = $id;
    UPDATE product SET Qty = Qty + $difference WHERE product_id = $product_id;
    ";

  if ($con->multi_query($sql) === TRUE) {
    http_response_code(200);
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