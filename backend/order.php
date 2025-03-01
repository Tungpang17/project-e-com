<?php
include("head.php");
?>
<br>
<br>
<br>
<br>




<div>

  <h3><img src="img/11.png" width="50" height="50"> รายการสั่งซื้อ

  </h3>


  <div>
    <button type="button" class="btn btn-primary" onclick="setStatus()">ทั้งหมด</button>
    <button type="button" class="btn btn-secondary" onclick="setStatus(0)">ยังไม่ชำระเงิน</button>
    <button type="button" class="btn btn-success" onclick="setStatus(1)">ชำระเงินแล้ว</button>
  </div>

  <div>
    <form id="date-form" action="order.php" method="get">
      <label for="start_date">เริ่มต้น</label>
      <input type="date" id="start_date" name="start_date" value="<?php echo $_GET["start_date"]; ?>">
      <label for="end_date">สิ้นสุด</label>
      <input type="date" id="end_date" name="end_date" value="<?php echo $_GET["end_date"]; ?>">
      <button type="submit">ค้นหา</button>
    </form>
  </div>

  <br>
  <table id="example" class="table" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>

        <th scope="col">รหัสสั่งซื้อ</th>
        <th scope="colr">รหัสลูกค้า</th>
        <th scope="col">ชื่อลูกค้า</th>
        <th scope="col">ที่อยู่จัดส่ง</th>
        <th scope="col">ราคารวม</th>
        <th scope="col">วันที่สั่งซื้อ</th>
        <th scope="col">สถานะ</th>
        <!-- <th scope="col">แก้ไข</th> -->
      </tr>
    </thead>


    <tbody>


      <?php
      $status = $_GET["status"];
      $status_sql = "";
      if ($status == "0") {
        $status_sql = "AND `payments`.pay_status=0";
      } else if ($status == "1") {
        $status_sql = "AND `payments`.pay_status=1";
      }

      $start_date = validateDate($_GET["start_date"]) ? $_GET["start_date"] : "1970-01-01";
      $end_date = validateDate($_GET["end_date"]) ? $_GET["end_date"] : date("Y-m-d");
      $date_sql =
        "AND `orders`.`order_date` BETWEEN '$start_date' AND '$end_date'";

      function validateDate($date)
      {
        $d = DateTime::createFromFormat("Y-m-d", $date);
        return $d && strtolower($d->format('Y-m-d')) === strtolower($date);
      }

      $sql =
        "SELECT 
        `orders`.*,
        `member`.`m_fullname`,
        `member`.`address`,
        `payments`.`pay_status`
        FROM `orders`
        LEFT JOIN `member` ON `orders`.`m_id`=`member`.`m_id`
        LEFT JOIN `payments` ON `orders`.`order_id`=`payments`.`order_id`
        WHERE 1
        $date_sql
        $status_sql
        ";
      $que = mysqli_query($con, $sql);
      while ($re = mysqli_fetch_assoc($que)) {
        ?>

        <tr>
          <td><?php echo $re["order_id"]; ?></td>
          <td><?php echo $re["m_id"]; ?></td>
          <td><?php echo $re["m_fullname"] ?></td>
          <td><?php echo $re["address"] ?></td>
          <td><?php echo $re["order_tatal"] ?></td>
          <td><?php echo $re["order_date"] ?></td>
          <td>
            <?php echo $re["pay_status"] == 0 ? 'ยังไม่ได้ชำระเงิน' : $re["pay_status"] == 1 ? 'ชำระเงินแล้ว' : 'ไม่ทราบสถานะ' ?>
          </td>

          <!-- <td><button type="button" class="btn btn-Warning" style="font-size: 14" 
            data-toggle="modal" data-target="#staticBackdrop" onmousedown="form1.product_id.value='<?php echo $re["product_id"]; ?>';form1.Product_name.value='<?php echo $re["Product_name"]; ?>';form1.qty.value='<?php echo $re["qty"]; ?>'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg> เบิกสินค้า</button></td> -->
        </tr>

      <?php } ?>
    </tbody>


  </table>
</div>
<script>
  function up() {

    // เตรียมข้อมูล form สำหรับส่ง
    var formData = new FormData($("#form1")[0]);

    // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
    $.ajax({
      url: 'call_up_proqty2.php',
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
            title: 'เบิกสินค้าสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout("location.reload()", 1500);
        } else if (obj.status == 0) {
          Swal.fire({
            icon: 'error',
            title: 'เบิกสินค้าเกินจำนวน',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout("location.reload()", 1500);
        }


        console.log(data);  // ทดสอบแสดงค่า  ดูผ่านหน้า console
        /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                        http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
      } catch (err) {
        alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data); return 0;
      }



    });

  }




  function show_click(id) {
    $("#product_id").val(obj[id].product_id);
    $("#Product_name").val(obj[id].Product_name);
    $("#Qty").val(obj[id].Qty);
  }

  function setStatus(status) {
    const url = new URL(window.location.href);
    if (status === undefined) {
      url.searchParams.delete('status');
    } else {
      url.searchParams.set('status', status);
    }
    window.location = url.href;
  }

  document.getElementById('date-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const url = new URL(window.location.href);
    url.searchParams.set('start_date', document.getElementById('start_date').value);
    url.searchParams.set('end_date', document.getElementById('end_date').value);
    window.location = url.href;
  });
</script>


<?php
include("foot.php");
?>