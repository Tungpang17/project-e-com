 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>




<div class="container">

  <h3><img src="img/11.png" width="50" height="50"> แจ้งการชำระเงิน  
</h3> 
  
<div id="button1">

</div>	
<br>
 <table id="example" class="table" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      
      <th scope="col">รหัสแจ้งชำระ</th>
      <th scope="col">เลขใบสั่งซื้อ</th>
      <th scope="col">ชื่อผู้แจ้งชำระ</th>
      <th scope="col">จำนวนเงิน</th>
      <th scope="col">วันทำการ</th>
      <th scope="col">หลักฐานแนบ</th>
      <th scope="col">การตรวจสอบ</th>
    </tr>
  </thead>


  <tbody >


<?php
$sql="SELECT `payments`.* FROM `payments`
-- LEFT JOIN `type` ON `product`.`type_id`=`type`.`type_id`
-- LEFT JOIN `stock2` ON `product`.`product_id`=`stock2`.`product_id`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>
 <tr>
            <td><?php echo $re["pay_id"];?></td>
            <td><?php echo $re["order_id"];?></td>
            <td><?php echo $re["referId"];?></td>
            <td><?php echo $re["money"];?></td>
            <td><?php echo $re["datetime"];?></td>
            <td><img src="img/payment/<?php echo $re["pay_file"];?>" alt="..." class="img-thumbnail" width="300px"></td>



            <td>
              
            <?php
            if($re["pay_status"]==0){
            ?>
            <button onclick="location.href='pay_ok.php?pay_id=<?php echo $re["pay_id"];?>'" type="button" class="btn btn-Warning" style="font-size: 14" 
            data-toggle="modal" data-target="#staticBackdrop" onmousedown="form1.product_id.value='<?php echo $re["product_id"];?>';form1.Product_name.value='<?php echo $re["Product_name"];?>';form1.qty.value='<?php echo $re["qty"];?>'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg> ยืนยันการชำระเงิน</button>
            <?php }elseif($re["pay_status"]==1){?>
              <span class="badge badge-success">ชำระเงินสำเร็จ</span>
              <a href="invoice-print.php?order_id=<?php echo $re["order_id"];?>"><span class="badge badge-danger">ออกใบเสร็จ</span></a>

            <?php }?>
            

          
          
          
          
          </td>
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
                      title: 'เบิกสินค้าสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.reload()",1500);
                }else if(obj.status==0){
                    Swal.fire({
                      icon: 'error',
                      title: 'เบิกสินค้าเกินจำนวน',
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