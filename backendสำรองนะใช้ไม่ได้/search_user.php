 
 <?php
session_start();
include("head.php");
?>
<div class="container">
	<br>
  <br>
  <br>

<br>
 <div class="card mb-3" style="max-width: 10000px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="img/4.jpg" class="card-img" alt="...">
      <br>
      <br>

    </div>

    <div class="col-md-8">
    <div class="card-body">

<form name="form1" id="form1">

<input class="form-control" type="hidden"  id="user_id" name="user_id">
<input class="form-control" type="hidden"  id="type_id" name="type_id">
<input class="form-control" type="hidden"  id="username" name="username">
<input class="form-control" type="hidden"  id="password" name="password">
    <div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">ชื่อ :</label>
    <div class="col-sm-8">
    <input class="form-control" type="text"  id="user_name" name="user_name">
    </div>
    </div>

    <div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">ที่อยู่ :</label>
    <div class="col-sm-8">
    <input class="form-control" type="text"  id="address" name="address">
    </div>
    </div>

    <div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">facebook หรือ Line :</label>
    <div class="col-sm-8">
    <input class="form-control" type="text"  id="Fb_line" name="Fb_line">
    </div>
    </div>

   <div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">เบอร์โทร :</label>
    <div class="col-sm-8">
    <input class="form-control" type="text"  id="phone" name="phone">
    </div>
    </div>
</form>
    </div>
    <center>
    <button type="button" class="btn btn-success" onclick="up()">บันทึก</button>
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    </center>
    </div>
    </div>
  </div>
</div>


<script>
var input = document.getElementById("user_name");




     $.post("call_search.php",{
      user_id:'<?php echo $_SESSION["shopee"]["user_id"];?>'
    },function(data){


      var obj=JSON.parse(data);
      console.log(obj.user_name);
      $("#username").val(obj.username);
      $("#password").val(obj.password);
      $("#user_id").val(obj.user_id);
      $("#user_name").val(obj.user_name);
      $("#address").val(obj.address);
      $("#Fb_line").val(obj.Fb_line);
      $("#phone").val(obj.phone);
      $("#type_id").val(obj.type_id);

      });




function up(){

        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_up_user.php',
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
                      title: 'แก้ไขรายการสำเร็จ',
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


</script>
<br>

</div>
<?php
include("foot.php");
?>