<?php
session_start();
include("backend/conf/mariadb.php");
$m_id = $_SESSION["otop"]["ID"];
$product_id = $_GET["product_id"];

// ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าหรือยัง
$sql_check = "SELECT amount FROM taka WHERE m_id = ? AND product_id = ?";
$stmt = $con->prepare($sql_check);
$stmt->bind_param("ii", $m_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // สินค้ามีอยู่แล้วในตะกร้า อัปเดตจำนวน
    $row = $result->fetch_assoc();
    $new_amount = $row["amount"] + 1;
    
    $sql_update = "UPDATE taka SET amount = ? WHERE m_id = ? AND product_id = ?";
    $stmt = $con->prepare($sql_update);
    $stmt->bind_param("iii", $new_amount, $m_id, $product_id);
    $stmt->execute();
} else {
    // สินค้ายังไม่มีในตะกร้า ให้เพิ่มแถวใหม่
    $sql_insert = "INSERT INTO taka (m_id, product_id, amount) VALUES (?, ?, 1)";
    $stmt = $con->prepare($sql_insert);
    $stmt->bind_param("ii", $m_id, $product_id);
    $stmt->execute();

}
header("location:taka.php");
?>