<?php include './head.php'; ?>

<div>
  <div class="pt-4">
    <h1>รายการทอผ้า</h1>
  </div>

  <div>
    <input id="search" type="text" class="form-control" placeholder="ค้นหา...">

    <button class="btn btn-primary" onclick="fetchAndRender()">ค้นหา</button>
  </div>

  <div>
    <table class="table">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อลูกค้า</th>
          <th>ชื่อผ้า</th>
          <th>จำนวน</th>
          <th>วันที่</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody id="tailor-records">
        <!-- Render tailor records here -->
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-end">
    <a href="./add-tailor-record.php" class="btn btn-primary">เพิ่มรายการทอผ้า</a>
  </div>

</div>
<script>
  async function fetchAndRender() {
    const search = document.getElementById('search').value;

    const tailorRecordContainer = document.getElementById('tailor-records');

    tailorRecordContainer.innerHTML = '';

    const tailorRecords = await fetch(`./../api/read-tailor-records.php?search=%${search}%`).then((res) => res.json());

    if (!tailorRecords || Array.isArray(tailorRecords) && tailorRecords.length === 0) {
      return tailorRecordContainer.innerHTML = '<tr><td colspan="6">ไม่มีข้อมูล</td></tr>';
    } else if (Array.isArray(tailorRecords) && tailorRecords.length > 0) {
      tailorRecords.forEach((record, index) => {
        const columns = document.createElement('tr');

        columns.appendChild(document.createElement('td')).textContent = record.id;
        columns.appendChild(document.createElement('td')).textContent = record.name;
        columns.appendChild(document.createElement('td')).textContent = record.Product_name;
        columns.appendChild(document.createElement('td')).textContent = record.quantity;
        columns.appendChild(document.createElement('td')).textContent = record.created_at;
        columns.appendChild((() => {
          const td = document.createElement('td');
          const editButton = document.createElement('button');
          editButton.classList.add('btn', 'btn-warning');
          editButton.textContent = 'แก้ไข';
          editButton.onclick = function () { window.location.href = './edit-tailor-record.php?id=' + record.id };
          td.appendChild(editButton);
          const deleteButton = document.createElement('button');
          deleteButton.classList.add('btn', 'btn-error');
          deleteButton.textContent = 'ลบ';
          deleteButton.onclick = function () { deleteRecord(record.id) };
          td.appendChild(deleteButton);
          return td;
        })());

        tailorRecordContainer.appendChild(columns);
      })
    }
  }

  async function deleteRecord(id) {
    if (!confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')) {
      return;
    }

    await fetch('./../api/delete-tailor-record.php?id=' + id, {
      method: 'DELETE'
    })
      .then((res) => {
        if (res.ok) {
          alert('ลบข้อมูลสำเร็จ');
          fetchAndRender();
        } else {
          alert('เกิดข้อผิดพลาด');
        }
      });
  }

  fetchAndRender();
</script>

<?php include './foot.php'; ?>