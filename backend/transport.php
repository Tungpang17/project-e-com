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
<br>
 <table id="example" class="table" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      
      <th scope="col">เลขใบสั่งซื้อ</th>
      <th scope="col">บริษัทขนส่ง</th>
      <th scope="col">เลข Tracking</th>
      <th scope="col">วันที่จัดส่ง</th>
      <th scope="col">เวลา</th>
      <th scope="col">สถานะ</th>
    </tr>
  </thead>


  <tbody >


  <?php
$sql="SELECT `payments`.*,transport.tra_id,transport.tra_name,transport.tra_track,transport.tra_date,transport.tra_time,transport.tra_status FROM `payments` 
LEFT JOIN `transport` ON `payments`.`order_id`=`transport`.`order_id`
WHERE `payments`.pay_status=1
-- LEFT JOIN `stock2` ON `product`.`product_id`=`stock2`.`product_id`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>
 <tr>
            <td><?php echo $re["order_id"];?></td>
            <td><?php echo $re["tra_name"]!="" ? $re["tra_name"]:'<span class="badge badge-danger">ยังไม่จัดส่ง</span>';?></td>
            <td><?php echo $re["tra_track"]!=""? $re["tra_track"].'<br><a href="https://ems.thaiware.com/'.$re["tra_track"].'" target="_blank"><span class="badge badge-secondary">ตรวจสอบ</span></a>':'<span class="badge badge-danger">ยังไม่จัดส่ง</span>';?></td>
            <td><?php echo $re["tra_date"]!=""? $re["tra_date"]:'<span class="badge badge-danger">ยังไม่จัดส่ง</span>';?></td>
            <td><?php echo $re["tra_time"]!=""? $re["tra_time"]:'<span class="badge badge-danger">ยังไม่จัดส่ง</span>';?></td>


            <td>
              
            <?php
            if($re["tra_id"]==""){
            ?>
            <button type="button" class="btn btn-Warning" style="font-size: 14" 
            data-toggle="modal" data-target="#exampleModal" onmousedown="form1.order_id.value='<?php echo $re["order_id"];?>';form1.Product_name.value='<?php echo $re["Product_name"];?>';form1.qty.value='<?php echo $re["qty"];?>'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg> จัดส่ง</button>
            <?php }elseif($re["tra_status"]==0){?>
                <span class="badge badge-warning">อยู่ระหว่างขนส่ง</span>
            <?php }elseif($re["tra_status"]==1){?>
                <span class="badge badge-success">จัดส่งสำเร็จ</span>
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
                <input class="form-control" type="text"  name="order_id" id="order_id" hidden="">
           <div class="mb-3 row">
              <label class="col-sm-5 col-form-label" style="font-size: 20px">บริษัทขนส่ง :</label>
              <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="บริษัทขนส่ง" name="tra_name" id="tra_name">
              </div>
           </div>
           <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">เลข Traking :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="xxxxxxxx" name="tra_track" id="tra_track" ></label>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">วันที่จัดส่ง :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="date"  id="tra_date" name="tra_date">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">เวลาจัดส่ง :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="time"  name="tra_time" id="tra_time"></label>
                  </div>
                </div>
              </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="up()">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </form>
      </div>

    </div>
  </div>
</div>
  </div>
<script>
function up(){
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_add_transport.php',
            type: 'POST',
            data:formData,
           // contentType: 'multipart/form-data',
            /*async: false,*/
            cache: false,
            contentType: false,
            processData: false
        }).done(function(data){
            try{
                var obj = JSON.parse(data);
                if(obj.status==1){
                    Swal.fire({
                      icon: 'success',
                      title: 'บันทึกสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.reload()",1500);
                }else if(obj.status==0){
                    Swal.fire({
                      icon: 'error',
                      title: 'ผิดพลาด',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.reload()",1500);
                }
     
                
                console.log(data);  // ทดสอบแสดงค่า  ดูผ่านหน้า console
/*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
            }catch(err){
                alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ'+data);return 0;
            }
            

            
        }); 
        
  }




function show_click(id){
$("#product_id").val(obj[id].product_id);
$("#Product_name").val(obj[id].Product_name);
$("#Qty").val(obj[id].Qty);
}

</script>


<?php
include("foot.php");
?>