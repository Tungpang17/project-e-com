 <?php
include("head.php");
?>
<div class="container">
  <br>
  <br>
  
<br>
<h2>จัดการหมวดหมู่สินค้า</h2>
<div class="row">
  <div class="col-md-12">
   <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">รหัสหมวดหมู่</th>
      <th scope="col">ชื่อหมวดหมู่</th>
    </tr>
  </thead>


  <tbody id="tbody1">
    

  </tbody>
</table>
  </div>

  <div class="col-md-12">
   <form id="form1">
    <div>
    <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
    <div class="card-body">
        
   
      <input class="form-control" type="text" placeholder="ใส่รหัสหมวดหมู่" id="type_id" name="type_id" hidden="">
      <label class="card-text" style="font-size: 20px">ชื่อหมวดหมู่ :</label>
      <input class="form-control" type="text" placeholder="ใส่ชื่อหมวดหมู่" id="type_name" name="type_name">

 </div>
 </div>
</div>
</div>

<center>
<button type="button" class="btn btn-success" onclick="add()">เพิ่ม</button>
<button type="button" class="btn btn-danger" onclick="de()">ลบ</button>
<button type="button" class="btn btn-warning"onclick="up()">แก้ไข</button>
<button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
</center>
</form>
  </div>
</div>
</div>

 <script>
  function add(){
if($("#type_name").val()==''){
  Swal.fire({
  icon: 'error',
  title: 'แจ้งเตือน',
  text: 'โปรดใส่ข้อมูล',
})
  return false;
}
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_add_stock.php',
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
                      title: 'เพิ่มรายการสำเร็จ',
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



function de(){
if($("#type_name").val()==''){
  Swal.fire({
  icon: 'error',
  title: 'แจ้งเตือน',
  text: 'โปรดใส่ข้อมูล',
})
  return false;
}
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_de_stock.php',
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
                      title: 'ลบรายการสำเร็จ',
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

   
function up(){
if($("#type_name").val()==''){
  Swal.fire({
  icon: 'error',
  title: 'แจ้งเตือน',
  text: 'โปรดใส่ข้อมูล',
})
  return false;
}
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_up_stock.php',
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


    function show_tbody1(){

      

       $.post("call_stock.php",{
     
    },function(data){

 obj=JSON.parse(data);
      console.log(obj);

for(var i=0;i<obj.length; i++){


  $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].type_id+'</td><td>'+obj[i].type_name+'</td></tr>');
}
      
      

      }); 

    } 
    function show_click(id){
      $("#type_id").val(obj[id].type_id);
      $("#type_name").val(obj[id].type_name);
    

    }  

    show_tbody1();  
</script>


<?php
include("foot.php");
?>