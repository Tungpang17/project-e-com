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
        <div class="col-6">
            <td><input id="search_product" type="text" class="form-control" style="width:230px"
                    placeholder="โปรดใส่ชื่อสมาชิก"> </td>
        </div>
        <div class="col-6">
            <button class="btn btn-warning" type="submit" onclick="search();">Search</button>
        </div>
    </div>
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
            <tbody id="tailor-tbody">

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

        async function search() {
            try {
                const search = `%${document.getElementById('search_product').value ?? ''}%`;

                const response = await fetch(`search_tailors.php?search=${search}`)

                const data = await response.json();

                const container = document.getElementById('tailor-tbody');

                container.innerHTML = '';

                for (const d of data) {
                    const row = document.createElement('tr')

                    row.innerHTML = `
                         <td>
                            ${d.id}
                        </td>
                        <td>
                            ${d.name}
                        </td>
                        <td>
                            ${d.address}
                        </td>
                        <td>
                            ${d.phone_number}
                        </td>
                        <td>
                            ${d.created_at}
                        </td>
                    `;

                    container.appendChild(row);
                }

            } catch (e) {}
        }

        search();
    </script>
    <?php
    include("foot.php");
    ?>