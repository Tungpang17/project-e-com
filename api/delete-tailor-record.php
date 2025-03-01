<?php
include './../backend/conf/mariadb.php';

$id = $_GET['id'] ?? null;

if (empty($id)) {
  http_response_code(400);

  echo json_encode(['error' => 'id is required']);
} else {
  $sql =
    "SELECT * FROM tailor_record WHERE id = ?";

  $stmt = $con->prepare($sql);
  $stmt->bind_param("i", $id);

  $stmt->execute();
  $result = $stmt->get_result();
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $quantity = $row['quantity'];
    $product_id = $row['product_id'];
  }

  $sql =
    "DELETE FROM tailor_record WHERE id = $id;
    UPDATE product SET Qty = Qty - $quantity WHERE product_id = $product_id;
    ";
  echo $sql;
  $result = $con->multi_query($sql);

  if ($result) {
    echo json_encode(['success' => true]);
  } else {
    http_response_code(500);

    echo json_encode(['error' => $con->error]);
  }
}
