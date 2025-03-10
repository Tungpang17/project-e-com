<?php
include("head.php");
?>
<br>
<br>
<br>
<br>




<div class="container">

  <h3><img src="img/11.png" width="50" height="50"> รายการการจัดส่ง
  </h3>

  <div id="button1">

  </div>

  <div>
    <button type="button" class="btn btn-secondary" onclick="setStatus(1)">จัดส่งแล้ว</button>
    <button type="button" class="btn btn-success" onclick="setStatus(0)">ยังไม่ได้จัดส่ง</button>
  </div>

  <div>
    <?php if ($_GET['status'] !== '0') { ?>
      <form id="date-form" action="transport.php?status=1" method="get">
        <label for="start_date">เริ่มต้น</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo $_GET["start_date"] ?? '2025-01-01'; ?>">
        <label for="end_date">สิ้นสุด</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo $_GET["end_date"] ?? date('Y-m-d'); ?>">
        <button type="submit">ค้นหา</button>
      </form>
    <?php } ?>
  </div>
  <br>
  <table id="example" class="table" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>

        <th scope="col">เลขใบสั่งซื้อ</th>
        <th scope="col">ชื่อลูกค้า</th>
        <th scope="col">บริษัทขนส่ง</th>
        <th scope="col">เลข Tracking</th>
        <th scope="col">ที่อยู่</th>
        <th scope="col">เบอร์โทรศัพท์</th>
        <th scope="col">วันที่จัดส่ง</th>
        <!-- <th scope="col">เวลา</th> -->
        <th scope="col">สถานะ</th>
        <th scope="col">จัดการ</th>
      </tr>
    </thead>


    <tbody>


      <?php
      $start_date = $_GET['start_date'];
      $end_date = $_GET['end_date'];

      $start_date = validateDate($start_date) ? $start_date : '2000-01-01';
      $end_date = validateDate($end_date) ? $end_date : date('Y-m-d');

      $date_sql = $_GET['status'] !== '0' ? "AND (transport.tra_date) BETWEEN '$start_date' AND '$end_date'" : '';

      function validateDate($date, $format = 'Y-m-d')
      {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
      }

      $status_sql = $_GET['status'] === '0' ? 'AND transport.tra_status IS NULL' : ($_GET['status'] === '1' ? 'AND transport.tra_status = 0' : '');


      $sql = "SELECT payments.*,transport.tra_id,transport.tra_name,transport.tra_track,transport.tra_date,transport.tra_time,transport.tra_status,m_fullname,member.address, member.m_phone FROM payments 
LEFT JOIN transport ON payments.`order_id`=`transport`.`order_id`
LEFT JOIN orders ON orders.order_id = payments.order_id
LEFT JOIN member ON member.m_id =  orders.m_id
WHERE payments.pay_status=1
$status_sql
$date_sql
ORDER BY transport.tra_status DESC";
      $que = mysqli_query($con, $sql);

      while ($re = mysqli_fetch_assoc($que)) {
        ?>
        <tr>
          <td><?php echo $re["order_id"]; ?></td>
          <td><?php echo $re["m_fullname"]; ?></td>
          <td>
            <?php echo $re["tra_name"] != "" ? $re["tra_name"] : '<span class="badge badge-danger">ยังไม่จัดส่ง</span>'; ?>
          </td>
          <td>
            <?php echo $re["tra_track"] != "" ? $re["tra_track"] : '<span class="badge badge-danger">ยังไม่จัดส่ง</span>'; ?>
          </td>
          <td>
            <?php echo $re["address"] ?>
          </td>
          <td>
            <?php echo $re["m_phone"] ?>
          </td>
          <td>
            <?php echo $re["tra_date"] != "" ? $re["tra_date"] : '<span class="badge badge-danger">ยังไม่จัดส่ง</span>'; ?>
          </td>
          <!-- <td><?php echo $re["tra_time"] != "" ? $re["tra_time"] : '<span class="badge badge-danger">ยังไม่จัดส่ง</span>'; ?></td> -->


          <td>

            <?php
            if ($re["tra_id"] == "") {
              ?>
              <span class="badge badge-secondary">รอการจัดส่ง</span>
            <?php } elseif ($re["tra_status"] == 0) { ?>
              <span class="badge badge-warning">อยู่ระหว่างขนส่ง</span>
            <?php } elseif ($re["tra_status"] == 1) { ?>
              <span class="badge badge-success">จัดส่งสำเร็จ</span>
            <?php } ?>

          </td>

          <td>
            <?php if (!$re["tra_id"]) { ?>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                onclick="orderId = <?php echo $re['order_id']; ?>">
                จัดส่ง
              </button>
            <?php } ?>

            <?php if ($re["tra_id"] && $re["tra_status"] == 0) { ?>
              <button type="button" class="btn btn-danger"
                onclick="deleteItem(<?php echo $re["tra_id"]; ?>)">ยกเลิก</button>
            <?php } ?>
          </td>
        </tr>

      <?php } ?>
    </tbody>


  </table>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">บันทึกการจัดส่ง</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form1" name="form1">
            <div class="card-body">
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" style="font-size: 20px">บริษัทขนส่ง :</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" placeholder="บริษัทขนส่ง" name="tra_name" id="tra_name">
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" style="font-size: 20px">เลข Traking :</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" placeholder="xxxxxxxx" name="tra_track"
                    id="tra_track"></label>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" style="font-size: 20px">วันที่จัดส่ง :</label>
                <div class="col-sm-7">
                  <input class="form-control" type="date" id="tra_date" name="tra_date">
                </div>
              </div>
              <!-- <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">เวลาจัดส่ง :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="time"  name="tra_time" id="tra_time"></label>
                  </div>
                </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="up()">บันทึก</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<script>
  let orderId;

  function up() {
    // เตรียมข้อมูล form สำหรับส่ง
    var formData = new FormData(document.getElementById("form1"));

    formData.append("order_id", orderId);

    // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
    $.ajax({
      url: 'call_add_transport.php',
      type: 'POST',
      data: formData,
      // contentType: 'multipart/form-data',
      /*async: false,*/
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      try {
        var obj = JSON.parse(data);
        if (obj.status == 1) {
          Swal.fire({
            icon: 'success',
            title: 'บันทึกสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout("location.reload()", 1500);
        } else if (obj.status == 0) {
          Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout("location.reload()", 1500);
        }


        console.log(data); // ทดสอบแสดงค่า  ดูผ่านหน้า console
        /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                        http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
      } catch (err) {
        alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data);
        return 0;
      }



    });

  }




  function show_click(id) {
    $("#product_id").val(obj[id].product_id);
    $("#Product_name").val(obj[id].Product_name);
    $("#Qty").val(obj[id].Qty);
  }

  function deleteItem(id) {
    if (confirm('ยืนยันการลบข้อมูล')) {
      window.open('delete_transport.php?id=' + id, '_parent')
    }
  }

  function setStatus(status = '') {
    window.location.href = 'transport.php?status=' + status;
  }
</script>


<?php
include("foot.php");
?>
ems.thaiware.com