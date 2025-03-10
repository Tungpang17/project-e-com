<?php
include("head.php");
include("conf/mariadb.php");

// รับค่าจาก GET
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// เงื่อนไข SQL
$condition = "";
if (!empty($start_date) && !empty($end_date)) {
    $condition = "WHERE created_at BETWEEN '$start_date' AND '$end_date'";
} elseif (!empty($start_date)) {
    $condition = "WHERE created_at >= '$start_date'";
} elseif (!empty($end_date)) {
    $condition = "WHERE created_at <= '$end_date'";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลสมาชิก</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
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
        /* ซ่อนปุ่มเมื่อพิมพ์ */
        @media print {
            .print-button, .dataTables_length, .dataTables_filter, .filters-container, form {
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
            <h3>รายงานข้อมูลสมาชิกกลุ่มทอผ้า</h3>
            <button type="button" class="btn btn-light print-button" onclick="window.print();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                </svg>
                พิมพ์
            </button>
        </div>

        <form method="GET" action="">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">วันที่เริ่มต้น:</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">วันที่สิ้นสุด:</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">กรองข้อมูล</button>
                    <a href="repost_tailorss.php" class="btn btn-secondary ms-2">ล้างค่า</a>
                </div>
            </div>
        </form>

        

        <!-- Member Table -->
        <table id="memberTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">รหัสสมาชิก</th>
                    <th scope="col">ชื่อสมาชิก</th>
                    <th scope="col">ที่อยู่</th>
                    <th scope="col">เบอร์โทร</th>
                    <th scope="col">วันที่เป็นสมาชิก</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `tailor` $condition";
                $que = mysqli_query($con, $sql);
                while ($re = mysqli_fetch_assoc($que)) {
                ?>
                    <tr>
                        <td><?php echo $re["id"]; ?></td>
                        <td><?php echo $re["name"]; ?></td>
                        <td><?php echo $re["address"]; ?></td>
                        <td><?php echo $re["phone_number"]; ?></td>
                        <td><?php echo $re["created_at"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#memberTable').DataTable({
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

            // Search Function
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Row Selection
            $('#memberTable tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });
        });
    </script>

    <?php
    include("foot.php");
    ?>
</body>
</html>