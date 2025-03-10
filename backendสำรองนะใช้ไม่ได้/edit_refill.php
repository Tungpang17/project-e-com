 <?php
include("head.php");
?>
<script type="text/javascript">
  var orders;
</script>
<div class="container">
<br>
<br>
<br>
 
<div class="row">
  <div class="col-md-6">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">วันที่</th>
      <th scope="col">เลขที่ใบเสร็จ</th>
      <th scope="col">ราคารวม</th>
    </tr>
  </thead>


  <tbody id="tbody1">
    
  </tbody>

</table>
  </div>

  <div class="col-md-6">
   
  <div class="card mb-3" style="max-width: 10000px;">
  <div class="row">
  <div class="col-md-2">
  </div>
    <div class="col-md-8">
    <div class="card-body">
        
    <div class="row">
    <center><h3>ใบเสร็จ</h3></center>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">วันที่ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="sall_date"></label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">เลขที่ใบเสร็จ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="sall_id"></label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">รายการสินค้า :</label>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคาชิ้น</th>
      <th scope="col">ราคารวม</th>
    </tr>
  </thead>
  <tbody id="tbody2">
   
  </tbody>
</table>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">จำนวนสินค้า :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px" id="sall_qty">0 &nbsp&nbsp&nbsp ชิ้น</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">รวม :</label>

    <label class="col-sm-7 col-form-label" style="font-size: 20px" id="sall_price">0.00</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">เงินสด :</label>
    <label class="col-sm-7 col-form-label" style="font-size: 20px" id="monney">-</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">เงินทอน :</label>
    <label class="col-sm-7 col-form-label" style="font-size: 20px" id="monney2">-</label>
    </div>
      </div>
    </div>
  </div>
</div>
<center>
  <div id="bt_print">
<button type="button" class="btn btn-warning btn-lg btn-block">พิมพ์ใบเสร็จ</button>
</div>
</center>

  </div>
</div>
</div>

<script>
  function show_tbody1(){
 $.post("call_refill.php",{
    },function(data){
 obj=JSON.parse(data);
 orders=obj;
      console.log(obj);
for(var i=0;i<obj.length; i++){
 $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].sall_date+'</td><td>'+obj[i].sall_id+'</td><td>'+obj[i].sall_price+'</td></tr>');
  
}
      
      

 }); 

} 


 function show_tbody2(sall_id){
    $.post("call_taka.php",{
     sall_id:sall_id
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
$("#tbody2").html('');
for(var i=0;i<obj.length; i++){
    $("#tbody2").html($("#tbody2").html()+'<tr><th scope="row">'+obj[i].amont+'</th><td>'+obj[i].Product_name+'</td><td>'+obj[i].price+'</td><td>'+obj[i].price*obj[i].amont+'</td></tr>');
 
}
    $("#bt_print").html('<button type="button" class="btn btn-warning btn-lg btn-block" onclick="location.href=\'bill.php?sall_id='+sall_id+'\'">พิมพ์ใบเสร็จ</button>');  
      

 }); 

} 

function show_click(id){
      $("#sall_date").html(orders[id].sall_date);
      $("#sall_id").html(orders[id].sall_id);
      $("#sall_price").html((orders[id].sall_price*1).toFixed(2)+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#monney").html(orders[id].monney+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#monney2").html((orders[id].monney-orders[id].sall_price).toFixed(2)+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#sall_qty").html(orders[id].sall_qty+"&nbsp&nbsp&nbsp&nbsp ชิ้น");
show_tbody2(orders[id].sall_id);
      }


      show_tbody1();  
      <?php
      if (isset($_GET["sall_id"])) { ?>
      show_tbody2('<?php echo $_GET["sall_id"];?>');
   <?php } ?>
</script>

<?php
include("foot.php");
?>