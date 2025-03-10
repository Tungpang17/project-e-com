 <?php
include("head.php");
?>
<script type="text/javascript">
  var obj;

</script>
<div class="container">
<br>
<br>
<br>


<div class="row no-gutters">
    <center>
      <div class="col-md-4">
      <img src="img/1.png" class="card-img">
      <br>
      <br>
    </div>
<h2>จัดการข้อมูลพนักงาน</h2>
  </center>
<form id="form1">
  <div class="">
    <div class="card-body">


      <div class="col-md-12">
   <table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">รหัสพนักงาน</th>
      <th scope="col">ชื่อพนักงาน</th>
      <th scope="col">เบอร์โทร</th>
    </tr>
  </thead>


  <tbody id="tbody1">
    

  </tbody>
</table>
</div>

<br>
<br>
 <div class="row">    
   <div class="col-md-6">
      <input class="form-control" type="text" placeholder="ใส่รหัสพนักงาน" name="user_id" id="user_id" hidden="">

    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">username:</label>
    <div class="col-sm-7">
      <input class="form-control" type="text" placeholder="username" name="username" id="username">
    </div>
    </div>
    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">password:</label>
    <div class="col-sm-7">
      <input class="form-control" type="text" placeholder="password" name="password" id="password">
    </div>
    </div>
    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">ชื่อพนักงาน:</label>
    <div class="col-sm-7">
      <input class="form-control" type="text" placeholder="ใส่ชื่อพนักงาน" name="user_name" id="user_name">
    </div>
    </div>
    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">ที่อยู่พนักงาน:</label>
    <div class="col-sm-7">
    <textarea class="form-control" id="address" name="address" placeholder="ใส่ที่อยู่พนักงาน" rows="3"></textarea>
    </div>
    </div>
</div>




<div class="col-md-6">
    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">FB & Line:</label>
    <div class="col-sm-7">
      <input class="form-control" type="text" placeholder="ใส่ FB & Line" name="Fb_line" id="Fb_line">
    </div>
    </div>
    <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">เบอร์โทร:</label>
    <div class="col-sm-7">
      <input class="form-control" type="text" placeholder="ใส่เบอร์โทร" name="phone" id="phone">
    </div>
    </div>
   <div class="mb-3 row">
    <label class="col-sm-3 col-form-label" style="font-size: 20px">กำหนดสิทธิ์ :</label>
<div class="col-sm-7">
      <select class="form-select" aria-label="Default select example" name="type_id" id="type_id">
     </select>
    </div>
    </div>
</div> 
</div>
<center>
<button type="button" class="btn btn-success" onclick="add()">เพิ่ม</button>
<button type="button" class="btn btn-danger" onclick="de()">ลบ</button>
<button type="button" class="btn btn-warning" onclick="up()">แก้ไข</button>
<button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
</center>
</form>

</div>
</div>
<br>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script>

  function add(){
if($("#username").val()==''){
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
            url: 'call_add_user.php',
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
if($("#username").val()==''){
  Swal.fire({
  icon: 'error',
  title: 'แจ้งเตือน',
  text: 'โปรดใส่ข้อมูล',
})
  return false;
}      // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_de_user.php',
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
if($("#username").val()==''){
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

 
  
function show(){
    $.post("call_show.php",{
      table:'type_user',
      condition3:''
    },function(data){
    ad=JSON.parse(data);
    console.log(ad);

$("#type_id").html('<option selected>กำหนดสิทธิ์</option>');

for(var i=0;i<ad.length; i++){
$("#type_id").html($("#type_id").html()+'<option value="'+ad[i].type_id+'">'+ad[i].type_name+'</option>');
}  }); 

} 


    function show_tbody1(){
    $.post("call_user.php",{
    },function(data){
 obj=JSON.parse(data);
      console.log(obj);

for(var i=0;i<obj.length; i++){


  $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].user_id+'</td><td>'+obj[i].user_name+'</td><td>'+obj[i].phone+'</td></tr>');
    
   

}
       
$('#example').DataTable({
                    "oLanguage": {
                    "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :"
            }
});
      }); 

    } 


    

    function show_click(id){
      console.log(obj);
      $("#user_id").val(obj[id].user_id);
      $("#username").val(obj[id].username);
      $("#password").val(obj[id].password);
      $("#user_name").val(obj[id].user_name);
      $("#address").val(obj[id].address);
      $("#Fb_line").val(obj[id].Fb_line);
      $("#phone").val(obj[id].phone);
      $("#type_id").val(obj[id].type_id);
    }  

    show_tbody1(); 
    show();

        



</script>

<?php
include("foot.php");
?>