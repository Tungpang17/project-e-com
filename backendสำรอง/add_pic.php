<?php
include("head.php");
?>
<br>
<br>
<br>
<br>
<div class="container">
<h3><img src="img/11.png" width="50" height="50"> จัดการภาพสินค้า
</h3> 
<div class="row">
        <div class="col-12">






          <div class="card">

            <br>
            <div class="card-body p-1">

              <div class="row justify-content-md-center">
 <div class="col-sm-4">
     <form id="form1">
  <input type="hidden" name="product_id" value="<?php echo $_GET["id"];?>">
<div class="form-group">
    <label for="exampleInputEmail1">เลือกภาพ</label><label style="color: red;">*</label>
    <input type="file" class="form-control"  name="file" accept="image/*">
  </div>

<div class="row justify-content-md-center">
                  <div class="col-sm-4" style="text-align:center;">
                            <button type="submit" class="btn btn-primary" id="bt_submit">บันทึก</button>
                    </div>


                </div>
</form>
</div>



                </div>



              </div>

            </div>
              
          </div>

          
        

          


        </div>
        <!-- /.col -->
      </div>
</div>

<?php
include("foot.php");
?>
<script> 
    $(function(){
     
    // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
    $("#form1").on("submit",function(e){
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);
 document.getElementById("bt_submit").innerHTML='กำลังบันทึก <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true"></i>';
        document.getElementById("bt_submit").disabled=true;
                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
    
        $.ajax({
                url: 'call_add_pic.php',
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
                      title: 'เพิ่มรูปภาพสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.href='pro-pic.php?id=<?php echo $_GET["id"];?>'",1500);
                }
                // document.getElementById("bt_submit").disabled=false;
                // document.getElementById("bt_submit").innerHTML="";
                
                console.log(data);  // ทดสอบแสดงค่า  ดูผ่านหน้า console
/*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
            }catch(err){
                alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ'+data);return 0;
            }
            

            
        }); 
        
        
        
         
    });
     
     
});
</script>