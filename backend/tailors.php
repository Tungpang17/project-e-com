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
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                    <th>วันที่สมัครสมาชิก</th>
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
                            <?php echo $row["address"] ?>
                        </td>
                        <td>
                            <?php echo $row["phone_number"] ?>
                        </td>
                        <td>
                            <?php echo $row["created_at"] ?>
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
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-size: 20px">ชื่อสมาชิก:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="ชื่อสมาชิก" name="name" id="name">
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
                                <input class="form-control" type="text" placeholder="ใส่เบอร์โทร" name="phone_number" id="phone_number">
                            </div>
                        </div>
                    </div>

                </div>
                <center>
                    <button type="button" class="btn btn-success" onclick="addTailor()">เพิ่ม</button>
                    <button type="button" class="btn btn-danger" onclick="deleteTailor()">ลบ</button>
                    <button type="button" class="btn btn-warning" onclick="updateTailor()">แก้ไข</button>
                    <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                </center>

            </div>
        </form>

    </div>
    <script>
        async function addTailor() {
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value)
            formData.append('address', document.getElementById('address').value)
            formData.append('phone_number', document.getElementById('phone_number').value)

            const response = await fetch('../api/create_tailor.php', {
                method: 'POST',

                body: formData
            });

            if (response.ok) {
                alert('เพิ่มข้อมูลสำเร็จ');

                window.location.reload();
            } else {
                alert('ไม่สามารถเพิ่มข้อมูลได้');

                console.error(await response.text());
            }
        }

        async function deleteTailor() {
            const id = prompt('โปรดระบุ ID สมาชิก');

            if (!id) {
                return;
            }

            const response = await fetch(`../api/delete_tailor.php?id=${id}`, {
                method: 'DELETE',
            });

            if (response.ok) {
                alert('ลบข้อมูลสำเร็จ');

                window.location.reload();
            } else {
                alert('ไม่สามารถเพิ่มข้อมูลได้');

                console.error(await response.text());
            }
        }

        async function updateTailor() {
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value)
            formData.append('address', document.getElementById('address').value)
            formData.append('phone_number', document.getElementById('phone_number').value)

            const id = prompt('โปรดระบุ ID สมาชิก');

            if (!id) {
                return;
            }

            const response = await fetch(`../api/update_tailor.php?id=${id}`, {
                method: 'POST',

                body: formData
            });

            if (response.ok) {
                alert('แก้ไขข้อมูลสำเร็จ');

                window.location.reload();
            } else {
                alert('ไม่สามารถเพิ่มข้อมูลได้');

                console.error(await response.text());
            }
        }
    </script>
    <?php
    include("foot.php");
    ?>