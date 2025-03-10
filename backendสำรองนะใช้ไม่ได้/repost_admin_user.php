<?php
include("head.php");

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสิทธิ์การเข้าใช้งาน</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto; /* ห่างจาก navbar 1rem */
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }
        .header img {
            margin-right: 15px;
        }
        .header h3 {
            margin: 0;
            color: #333;
            font-weight: bold;
        }
        .table {
            margin-top: 20px;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px;
            text-align: center;
        }
        .table tbody td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        .table tbody tr.selected {
            background-color: #cce5ff !important; /* สีเมื่อเลือกแถว */
        }
        .btn-light {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .btn-light:hover {
            background-color: #e9ecef;
        }
        .btn-light svg {
            margin-right: 5px;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .search-box input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        /* ปรับความกว้างคอลัมน์ */
        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 100px; /* กำหนดความกว้าง 100px */
        }
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 150px; /* กำหนดความกว้าง 150px */
        }
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 150px; /* กำหนดความกว้าง 150px */
        }
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 200px; /* กำหนดความกว้าง 200px */
        }
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 150px; /* กำหนดความกว้าง 150px */
        }
        /* ซ่อนปุ่มเมื่อพิมพ์ */
        @media print {
            .print-button, .dataTables_length, .dataTables_filter, .filters-container {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="img/ru1.png" width="50" height="50" alt="โลโก้ร้านค้า">
            <h3>ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
        </div>

        <!-- Report Title and Print Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>รายงานสิทธิ์การเข้าใช้งาน</h3>
            <button type="button" class="btn btn-light print-button" onclick="window.print();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                </svg>
                พิมพ์
            </button>
        </div>

        <!-- Member Table -->
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">รหัสพนักงาน</th>
                    <th scope="col">username</th>
                    <th scope="col">password</th>
                    <th scope="col">ชื่อพนักงาน</th>
                    <th scope="col">สิทธิ์</th>
                </tr>
            </thead>
            <tbody id="tbody1"></tbody>
        </table>
    </div>

    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        let obj = []; // ตัวแปรเก็บข้อมูลจากเซิร์ฟเวอร์

        // ฟังก์ชันแสดงข้อมูลในตาราง
        function show_tbody1() {
            $.post("call_user.php", {}, function (data) {
                obj = JSON.parse(data);
                console.log(obj);

                let html = "";
                for (let i = 0; i < obj.length; i++) {
                    html += `<tr onclick="show_click(${i})" style="cursor:pointer">
                                <td>${obj[i].user_id}</td>
                                <td>${obj[i].username}</td>
                                <td>${obj[i].password}</td>
                                <td>${obj[i].user_name}</td>
                                <td>${obj[i].type_name}</td>
                            </tr>`;
                }
                $("#tbody1").html(html);

                // Initialize DataTable
                $('#example').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/th.json" // ภาษาไทย
                    }
                });
            });
        }

        // ฟังก์ชันเมื่อคลิกที่แถว
        function show_click(id) {
            $("#user_id").val(obj[id].user_id);
            $("#username").val(obj[id].username);
            $("#password").val(obj[id].password);
            $("#user_name").val(obj[id].user_name);
            $("#type_name").val(obj[id].type_name);
        }

        // เรียกฟังก์ชันแสดงข้อมูลเมื่อโหลดหน้าเว็บ
        $(document).ready(function () {
            show_tbody1();
        });
    </script>

    <?php
    include("foot.php");
    ?>
</body>
</html>