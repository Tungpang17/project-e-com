<?php
include("head.php");
?>
<?php
$query =
    "SELECT * FROM `tailor`";
$result = mysqli_query($con, $query);

$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
?>
<br><br><br><br>
<div class="col-lg-8">
    <h1>สมาชิกกลุ่มทอผ้า</h1>
    <div class="row">
        <table class="table">
            <thead>
                <tr>

                    <th>ID</th>
                    <th>ชื่อสมาชิก</th>
                    <th>ลายผ้า</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row["id"] ?>
                        </td>
                        <td>
                            <?php echo $row["name"] ?>
                        </td>
                        <td>
                            <?php echo $row["pattern"] ?>
                        </td>
                        <td>
                            <?php echo $row["address"] ?>
                        </td>
                        <td>
                            <?php echo $row["phone_number"] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </divclass>

        <form id="form1">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <br>

                        <input class="form-control" type="text" placeholder="ใส่รหัสพนักงาน" name="m_id" id="m_id" hidden="">
                        <div class="mb-3 row">
                            <lass="col-sm-3 col-form-label" style="font-size: 20px">อีเมล์:</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="username" name="m_email" id="m_email">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">password:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="password" name="m_pass" id="m_pass">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">ชื่อสมาชิก:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="ชื่อสมาชิก" name="m_fullname" id="m_fullname">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">ลายผ้า:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="ลายผ้า" name="m_fullname" id="m_fullname">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-body">
                        <br>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">ที่อยู่สมาชิก:</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="address" name="address" placeholder="ที่อยู่สมาชิก" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">เบอร์โทร:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="ใส่เบอร์โทร" name="m_phone" id="m_phone">
                            </div>
                        </div>
                    </div>

                </div>
                <center>
                    <button type="button" class="btn btn-success" onclick="add()">เพิ่ม</button>
                    <button type="button" class="btn btn-danger" onclick="de()">ลบ</button>
                    <button type="button" class="btn btn-warning" onclick="up()">แก้ไข</button>
                    <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                </center>

            </div>
        </form>
    </div>
    <?php
    include("foot.php");
    ?>