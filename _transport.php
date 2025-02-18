<?php
include("head.php");
?>
<?php
$sql = "SELECT * FROM `orders`
      
       WHERE 1 AND `order_id`='" . $_GET["order_id"] . "' ";
$que = mysqli_query($con, $sql);
$re = mysqli_fetch_assoc($que);
?>
<style>



</style>

<!--Main column-->
<div class="col-lg-8">


  <div class="testbox">
    <h1>การชำระเงิน</h1>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">การสั่งซื้อเลยที่ #<?php echo $_GET["order_id"]; ?></h4>
      <p>รายการ</p>
      <p></p>
      <hr>
      <p class="mb-0">จำนวนเงินทั้งหมด <?php echo number_format($re["order_tatal"], 2); ?> บาท</p>
    </div>
    <hr>
    <div class="row justify-content-md-center">
      <div class="col-md-6">
        <form id="form_p">
          <input type="hidden" name="order_id" value="<?php echo $_GET["order_id"]; ?>">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">เลขที่อ้างอิง : </label>
            <input type="text" class="form-control" id="referId" name="referId" placeholder="เลขที่อ้างอิง xxxxxxxxxxxxxx">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">จำนวนเงิน (ใส่เฉพาะตัวเลข )</label>
            <input type="number" class="form-control" id="money" name="money" placeholder="เช่น 1200" value="<?php echo $re["order_tatal"]; ?>" readonly="readonly">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">วันเวลาตามใบเสร็จ</label>
            <input type="datetime-local" class="form-control" id="datetime" name="datetime" placeholder="เช่น 1200">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">แนบหนักฐาน</label>
            <input type="file" class="form-control" id="pay_file" name="pay_file">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">ที่อยู่การจัดส่ง</label>
            <textarea class="form-control" id="pay_address" name="pay_address" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <center>
              <button type="submit" class="btn btn-primary" id="bt_submit">แจ้งโอนเงิน</button>
              <button type="reset" class="btn btn-secondary">ยกเลิก</button>
            </center>
          </div>


        </form>
      </div>
    </div>
    <hr>

  </div>
  <!--/.Main column-->

</div>
</div>
<!--/.Main layout-->

</main>

<?php
include("foot.php");
?>

<script>
  $(function() {

    // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
    $("#form_p").on("submit", function(e) {
      e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax

      // เตรียมข้อมูล form สำหรับส่ง
      var formData = new FormData($("#form_p")[0]);
      //   document.getElementById("bt_submit").innerHTML='กำลังบันทึก <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true"></i>';
      //          document.getElementById("bt_submit").disabled=true;
      // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม

      $.ajax({
        url: 'call_payment.php',
        type: 'POST',
        data: formData,
        // contentType: 'multipart/form-data',
        /*async: false,*/
        cache: false,
        contentType: false,
        processData: false
      }).done(function(data) {
        try {
          var obj = JSON.parse(data);
          if (obj.status == 1) {
            Swal.fire({
              icon: 'success',
              title: 'แจ้งชำระเงินสำเร็จ',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout("location.href='index.php'", 1500);
          }
          //  document.getElementById("bt_submit").disabled=false;
          //  document.getElementById("bt_submit").innerHTML="";

          console.log(data); // ทดสอบแสดงค่า  ดูผ่านหน้า console
          /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                          http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
        } catch (err) {
          alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data);
          return 0;
        }



      });




    });


  });
</script>