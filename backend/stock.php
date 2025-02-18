 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="form1" name="form1">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">เบิกสินค้าคงคลัง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <div class="card-body">
                <input class="form-control" type="text" placeholder="ใส่รหัสสถานประกอบการ" name="product_id" id="product_id" hidden="">
           <div class="mb-3 row">
              <label class="col-sm-5 col-form-label" style="font-size: 20px">ชื่อสินค้า :</label>
              <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="ชื่อสินค้า" name="Product_name" id="Product_name" disabled="">
              </div>
           </div>
           <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">คงเหลือ :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="ชื่อสินค้า" name="qty" id="qty" disabled=""></label>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">นำเข้า :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="ใส่จำนวน" id="Qty" name="Qty">
                  </div>
                </div>
              </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="up()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg> นำเข้า</button>

      </div>
    </form>
    </div>
  </div>
</div>


<div class="container">

  <h3>จัดการข้อมูลสินค้าคงคลัง</h3> 
  
<div id="button1">

</div>	
<br>
 <table id="example" class="table" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ประเภทสินค้า</th>
      <th scope="col">คงเหลือ</th>
      <th scope="col">นำเข้า</th>
    </tr>
  </thead>


  <tbody >


<?php
$sql="SELECT `product`.*,`type` .*,`stock2`.`qty` FROM `product`
LEFT JOIN `type` ON `product`.`type_id`=`type`.`type_id`
LEFT JOIN `stock2` ON `product`.`product_id`=`stock2`.`product_id`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>
 <tr>
            <td><?php echo $re["product_id"];?></td>
            <td><?php echo $re["Product_name"];?></td>
            <td><span class="badge badge-info" style="font-size: 18"><?php echo $re["type_name"];?></span></td>
            <td><?php echo $re["Qty"];?></td>



            <td><button type="button" class="btn btn-success" style="font-size: 14" 
            data-toggle="modal" data-target="#staticBackdrop" onmousedown="form1.product_id.value='<?php echo $re["product_id"];?>';form1.Product_name.value='<?php echo $re["Product_name"];?>';form1.qty.value='<?php echo $re["Qty"];?>'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg> นำเข้า</button></td>
  </tr>

<?php } ?>
  </tbody>

  
</table>
  </div>
<script>
function up(){
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_up_proqty2.php',
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
                      title: 'นำเข้าสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.reload()",1500);
                }else if(obj.status==0){
                    Swal.fire({
                      icon: 'error',
                      title: 'ไม่สำเร็จ',
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