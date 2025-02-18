<?php
include("head.php");

?>
      <?php
      $sql="SELECT * FROM `member`
      
       WHERE 1 AND `m_id`='".$_SESSION["otop"]["ID"]."' ";    
      $que=mysqli_query($con,$sql);
      $re=mysqli_fetch_assoc($que);
      ?>
<style>



</style>

    <!--Main column-->
    <div class="col-lg-8">


    <div class="testbox">
  <h1>แก้ไขข้อมูลส่วนตัว</h1>

  <form id="form_re">
  <input type="hidden" name="m_id" id="m_id"value="<?php echo $re["m_id"];?>" />
  <hr>
  <div class="row justify-content-md-center">
<div class="col-sm-4">
  <label id="icon" for="m_email"><i class="icon-envelope "></i></label>
  <input type="email" name="m_email" id="m_email" placeholder="Email" value="<?php echo $re["m_email"];?>" required/>
</div>


<div class="col-sm-4">
  <label id="icon" for="m_fullname"><i class="icon-user"></i></label>
  <input type="text" name="m_fullname" id="m_fullname" placeholder="ชื่อ-สกุล"  value="<?php echo $re["m_fullname"];?>" required/>
  </div>
  <div class="col-sm-4">
 <label id="icon" for="name"><i class="fa fa-phone" aria-hidden="true"></i></label>
  <input type="text" name="m_phone" id="m_phone" placeholder="เบอร์โทร"  value="<?php echo $re["m_phone"];?>" required/><br>
</div>
<div class="col-sm-4">
  <label id="icon" for="name"><i class="icon-shield"></i></label> 
  <input type="password" name="m_pass" id="m_pass" placeholder="รหัสผ่าน"  value="<?php echo $re["m_pass"];?>" required/>
  </div>
  <div class="col-sm-4">
  <label id="icon" for="name"><i class="fa fa-globe" aria-hidden="true"></i></label> 
  <input type="text" name="address" id="address" placeholder="ที่อยู่"  value="<?php echo $re["address"];?>" required/>
  </div>
  <div class="col-sm-4"></div>
   <!-- <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p> -->
   <div class="col-sm-4">
   <button type="submit" class="btn btn-primary" id="bt_regis">บันทึกการแก้ไข</button>
   </div>
   </div>
  </form>
</div>

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

    
    
    
    $(function(){
     
    // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
    $("#form_re").on("submit",function(e){
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form_re")[0]);
//  document.getElementById("bt_submit").innerHTML='กำลังบันทึก <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true"></i>';
        // document.getElementById("bt_submit").disabled=true;
                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
    
        $.ajax({
            url: 'call_edit-registration.php',
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
                      title: 'สมัครสมาชิกสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.href='index.php'",1500);
                }
                // document.getElementById("bt_submit").disabled=false;
                // document.getElementById("bt_submit").innerHTML="เพิ่มผู้ใช้";
                
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
  