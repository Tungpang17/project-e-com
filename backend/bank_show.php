<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>สถิติการทอผ้าของสมาชิกกลุ่มทอผ้า</title>
    <link href="boostrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="boostrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include 'menu1.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <h4>เรียกการทอผ้า</h4>
                </div><br>
                <div class="card-body">
                    <form action="bank_rs_pdf.php" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>ระบุเดือน</h4>
                                <select class="form-select" name="month" required>
                                    <option value="">เลือกเดือน</option>
                                    <option value="01">มกราคม</option>
                                    <option value="02">กุมภาพันธ์</option>
                                    <option value="03">มีนาคม</option>
                                    <option value="04">เมษายน</option>
                                    <option value="05">พฤษภาคม</option>
                                    <option value="06">มิถุนายน</option>
                                    <option value="07">กรกฎาคม</option>
                                    <option value="08">สิงหาคม</option>
                                    <option value="09">กันยายน</option>
                                    <option value="10">ตุลาคม</option>
                                    <option value="11">พฤศจิกายน</option>
                                    <option value="12">ธันวาคม</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h4>ระบุปี</h4>
                                <select class="form-select" name="year" required>
                                    <option value="">เลือกปี</option>
                                    <?php
                                    for ($year = date('Y'); $year >= 2000; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h4>.</h4>
                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                                <!-- <a href="bank_all_pdf.php"><button type="button" class="btn btn-success">แสดงทั้งหมด</button></a> -->
                                    <br><br>
                            </div>
                        </div>
                    </form><br>
                    <a href="bank.php"><button type="button" class="btn btn-primary">กลับ</button></a><br><br>
                </div>
            </div>
        </main>
    </div>
</body>

</html>