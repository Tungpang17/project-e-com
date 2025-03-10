<?php
// เริ่มคำสั่ง Export ไฟล์ PDF
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

$mpdf->SetFont('sarabun', '', 14);
ob_start();

include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลรายรับและรายจ่ายจากตาราง bank
$sql_bank = "SELECT id, des, input, output, date FROM bank";
$result_bank = mysqli_query($conn, $sql_bank);

// ดึงข้อมูลการสั่งซื้อสินค้าจาก tb_order
$sql_order = "SELECT o.order_id, o.buy_date, o.order_status, o.pay_id, o.total_price
              FROM tb_order o
              WHERE o.order_status IN (0, 2, 3, 4, 5)";
$result_order = mysqli_query($conn, $sql_order);

// คำนวณรวมรายรับและรายจ่าย
$total_income = 0;
$total_expense = 0; // รวมรายจ่ายทั้งหมด
$current_balance = 0;

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชีร้านค้า ( รายรับ-รายจ่าย )</title>
    <style>
        body {
            font-family: 'sarabun', sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .text-end {
            text-align: right;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid black;
            /* เพิ่มเส้นขอบ */
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="text-end">
        <img src="../img/x.png" width="50" height="50" alt="Logo"><br>
        ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่
        <!-- <div>วัดศรีรัตนคีรี ตำบล ท่าศาลา อ.เมือง ลพบุรี 15000</div> -->
        <div class="date"><?php echo date('d/m/Y'); ?></div>
    </div>
    <h4 class="text-center">สถิติการขายสินค้า 5 อันดับยอดนิยม</h4>
    <p></p>
    <table class="table">
        <thead>
            <tr>
                <th>วันที่</th>
                <th>รายการสินค้า</th>
                <th>จำนวนที่ขาย</th>
                <!-- <th>รายจ่าย</th>
                <th>คงเหลือ</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            // แสดงข้อมูลจากตาราง bank
            while ($row_bank = mysqli_fetch_array($result_bank, MYSQLI_ASSOC)) {
                $total_income += $row_bank['input'];
                $total_expense += $row_bank['output'];
                $current_balance += $row_bank['input'] - $row_bank['output'];
            ?>
                <tr>
                    <td><?= date('d/m/Y ', strtotime($row_bank['date'])) ?></td>
                    <td><?= htmlspecialchars($row_bank['des']) ?></td>
                    <td><?= number_format($row_bank['input'], 2) ?></td>
                    <td><?= number_format($row_bank['output'], 2) ?></td>
                    <td><?= number_format($current_balance, 2) ?></td>
                </tr>
                <?php
            }

            // แสดงข้อมูลจากตาราง tb_order
            while ($row_order = mysqli_fetch_array($result_order, MYSQLI_ASSOC)) {
                $description = "";
                $income = "-";
                $expense = "-";

                // ตรวจสอบสถานะและ pay_id
                if ($row_order['order_status'] == 0) {
                    // รายการยกเลิกการจัดส่งสินค้าของลูกค้า
                    $total_income += $row_order['total_price'];
                    $total_expense += $row_order['total_price'];
                    $description = "รายการยกเลิกการจัดส่งสินค้าของลูกค้า";
                    $income = number_format($row_order['total_price'], 2);
                    $expense = number_format($row_order['total_price'], 2);
                } elseif ($row_order['order_status'] == 5 && ($row_order['pay_id'] != '000000' && !empty($row_order['pay_id']))) {
                    // รายการยกเลิกการสั่งซื้อสินค้าของลูกค้า
                    $total_income += $row_order['total_price'];
                    $total_expense += $row_order['total_price'];
                    $description = "รายการยกเลิกการสั่งซื้อสินค้าของลูกค้า";
                    $income = number_format($row_order['total_price'], 2);
                    $expense = number_format($row_order['total_price'], 2);
                } elseif (in_array($row_order['order_status'], [2, 3, 4])) {
                    // ดึงข้อมูลจาก order_detail สำหรับสถานะ 2, 3, 4
                    $order_id = $row_order['order_id'];
                    $sql_detail = "SELECT SUM(total) AS total_price FROM order_detail WHERE order_id = '$order_id'";
                    $result_detail = mysqli_query($conn, $sql_detail);
                    $detail_row = mysqli_fetch_array($result_detail, MYSQLI_ASSOC);
                    $total_price = $detail_row['total_price'] ? $detail_row['total_price'] : 0;

                    $total_income += $total_price;
                    $current_balance += $total_price;
                    $description = "ยอดขายจากคำสั่งซื้อของลูกค้า";
                    $income = number_format($total_price, 2);
                    $expense = "0.00";
                }

                // แสดงเฉพาะรายการที่มีการกำหนด description
                if ($description) {
                ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($row_order['buy_date'])) ?></td>
                        <td><?= $description ?></td>
                        <td><?= $income ?></td>
                        <td><?= $expense ?></td>
                        <td><?= number_format($current_balance, 2) ?></td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
        
        <tr>
            <td colspan="4" class="text-end"><strong>คงเหลือ:</strong></td>
            <td><strong><?= number_format($current_balance, 2) ?></strong></td>
        </tr>

        <!-- <tr>
            <td class="text-end" colspan="2"><strong>รวม: </strong></td>
            <td><strong><?= number_format($total_income, 2) ?></strong></td>
            <td><strong><?= number_format($total_expense, 2) ?></strong></td>
            <td><strong><?= number_format($current_balance, 2) ?></strong></td>
        </tr> -->
    </table>

    <?php
    // คำสั่งการ Export ไฟล์เป็น PDF
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output('Report.pdf');
    ob_end_flush();
    ?>
    <br>
    <a href="Report.pdf"><button class="btn btn-primary">พิมพ์</button></a>
    <a href="bank_show.php"><button class="btn btn-secondary">กลับ</button></a>

    </div>
</body>

</html>