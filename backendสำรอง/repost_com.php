<?php
include("head.php");
?>
<br>
<br>
<br>
<br>



<div class="container">
  <h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
<h3>รายงานสถานประกอบการ  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 

  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>
  <br>
 <table class="table"  class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      
      <th scope="col">รหัสสถานประกอบการ</th>
      <th scope="col">ชื่อสถานประกอบการ</th>
      <th scope="col">ที่ออยู่สถานประกอบการ</th>
      <th scope="col">เบอร์โทร</th>
    </tr>
  </thead>


  <tbody id="tbody1">
    
  </tbody> 

</table>
  </div>

 <script>
 function show_tbody1(){

      

       $.post("call_comy.php",{
     
    },function(data){

 obj=JSON.parse(data);
      console.log(obj);

for(var i=0;i<obj.length; i++){


  $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><td>'+obj[i].com_id+'</td><td>'+obj[i].com_name+'</td></td><td>'+obj[i].com_add+'</td><td>'+obj[i].com_phone+'</td></tr>');
}
      
      

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

<?php
include("foot.php");
?>