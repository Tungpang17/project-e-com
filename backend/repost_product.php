 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>



<div class="container">
 <h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
  <h3>รายงานข้อมูลสถิติการทอผ้าของสมาชิกกลุ่มทอผ้า <button type="button" class="btn btn-light" onclick="print();" id="hid">

  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>
  <div>
    <form id="date-form" action="order.php" method="get">
      <label for="start_date">เริ่มต้น</label>
      <input type="date" id="start_date" name="start_date" value="<?php echo $_GET["start_date"]; ?>">
      <label for="end_date">สิ้นสุด</label>
      <input type="date" id="end_date" name="end_date" value="<?php echo $_GET["end_date"]; ?>">
      <button type="submit">ค้นหา</button>
    </form>
  </div>
<div id="button1">

</div>	
<br>
 <table class="table" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">รายระเอียด</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
      <th scope="col">วันที่สั่งซื้อ</th>
    </tr>
  </thead>


  <tbody id="tbody1">


  </tbody>
</table>
  </div>

 <script>
 function show_button1(){
    $.post("call_show.php",{
      table:'type',
      condition:''
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);

$("#type_id").html('<option selected>เลือกสต็อก</option>');
$("#button1").html('<button type="button" id="hid" class="btn btn-warning" onclick="show_tbody1(\'\')">ทั้งหมด</button>  ');
for(var i=0;i<obj.length; i++){

$("#button1").html($("#button1").html()+'<button type="button" id="hid" class="btn btn-warning" onclick="show_tbody1(\''+obj[i].type_id+'\')">'+obj[i].type_name+'</button>  ');
$("#type_id").html($("#type_id").html()+'<option value="'+obj[i].type_id+'">'+obj[i].type_name+'</option>');
}  }); 
} 

 function show_tbody1(type_id){
  $.post("call_show.php",{
    table:'product',
    conditon:type_id
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
    $("#tbody1").html('');
for(var i=0;i<obj.length; i++){
    $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><td>'+obj[i].product_id+'</td><td>'+obj[i].Product_name+'</td><td>'+obj[i].Product_detail+'</td><td>'+obj[i].Product_Price+'</td><td>'+obj[i].Qty+'</td></tr>');}  }); 
} 
    

    function show_click(id){
      $("#pro_id").val(obj[id].product_id);
      $("#pro_name").val(obj[id].Product_name);
      $("#pro_de").val(obj[id].Product_detail);
      $("#pro_price").val(obj[id].Product_Price);
      $("#qty").val(obj[id].Qty);
      $("#type_id").val(obj[id].type_id);
      $("#com_id").val(obj[id].com_id);
      $("#com_name").val(obj[id].com_name);
   }  
    show_button1();
    
    show_tbody1('');  
</script>

<?php
include("foot.php");
?>