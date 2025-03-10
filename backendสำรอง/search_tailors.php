<?php
include("conf/mariadb.php");
try {

    // รับค่าค้นหาจาก GET
    $search = isset($_GET['search']) ? trim($_GET['search']) : '%%';

    // ค้นหา name ที่คล้ายกับคำค้นหา
    $stmt = $con->prepare("SELECT * FROM tailor WHERE name LIKE ?");
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // แสดงผลลัพธ์เป็น JSON
    header('Content-Type: application/json');
    echo json_encode($rows);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
}
