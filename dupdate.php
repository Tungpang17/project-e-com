<?php
include("db_connect.php"); // เชื่อมต่อฐานข้อมูล

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // อัปเดตสถานะเป็น "ชำระเงินแล้ว"
    $sql = "UPDATE orders SET payment_status = 'paid' WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    
    if ($stmt->execute()) {
        header("Location: orders.php"); // รีเฟรชหน้าหลังอัปเดต
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>