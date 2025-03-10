<?php
include("head.php");
?>
<div class="container">
  <br>
  <br>
  <br>
  <div class="row">
    <div class="col-md-12">
      
      <div>
        <div class="row no-gutters">
          <center><div class="col-md-4">
            <img src="img/1.png" class="card-img" alt="...">
            <br>
            <br>
          </div>
        <h2>จัดการข้อมูลสถานประกอบการ</h2>
      </center>


<div class="col-md-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">รหัสสถานประกอบการ</th>
            <th scope="col">ชื่อสถานประกอบการ</th>
            <th scope="col">เบอร์โทร</th>
          </tr>
        </thead>
        <tbody id="tbody1">
          
        </tbody>
      </table>
    </div>


          <form id="form1">
            <div class="col-md-12">
              <div class="card-body">
                

<br>


                
                <input class="form-control" type="text" placeholder="ใส่รหัสสถานประกอบการ" name="com_id" id="com_id" hidden="">
                
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">ชื่อสถานประกอบการ :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="ใส่ชื่อสถานประกอบการ" name="com_name" id="com_name">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">ที่อยู่สถานประกอบการ :</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" placeholder="ใส่ที่อยู่สถานประกอบการ" rows="3" id="com_add" name="com_add"></textarea>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label" style="font-size: 20px">เบอร์โทร :</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" placeholder="ใส่เบอร์โทร" id="com_phone" name="com_phone">
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
    </form>
  </div>
</div>
</div>
<script>
function add(){
if($("#com_name").val()==''){
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
url: 'call_add_com.php',
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
if($("#com_name").val()==''){
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
url: 'call_de_com.php',
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
if($("#com_name").val()==''){
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
url: 'call_up_com.php',
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

$.post("call_comy.php",{

},function(data){
obj=JSON.parse(data);
console.log(obj);
for(var i=0;i<obj.length; i++){
$("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].com_id+'</td><td>'+obj[i].com_name+'</td><td>'+obj[i].com_phone+'</td></tr>');
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
$("#com_id").val(obj[id].com_id);
$("#com_name").val(obj[id].com_name);
$("#com_add").val(obj[id].com_add);
$("#com_phone").val(obj[id].com_phone);
$("#com_img").val(obj[id].com_img);

}
show_tbody1();



</script>
<br>
<?php
include("foot.php");
?>