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
      <th scope="col">เลขที่บสั่งซื้อ</th>
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
    <center><h3>ใบสั่งซื้อสินค้า</h3></center>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">วันที่ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="buy_date"></label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">เลขที่ใบเสร็จ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="buy_id"></label>
     <label class="col-sm-6 col-form-label" style="font-size: 20px">ถึง :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="com_name"></label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">รายการสินค้า :</label>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">จำนวน</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคาชิ้น</th>
      <th scope="col">ราคารวม</th>
    </tr>
  </thead>
  <tbody id="tbody2">
   
  </tbody>
</table>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">จำนวนสินค้า :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px" id="buy_qty">0 &nbsp&nbsp&nbsp ชิ้น</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">ราคารวม :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px" id="monney">0 &nbsp&nbsp&nbsp บาท</label>
    </div>
      </div>
    </div>
  </div>
</div>
<center>
  <div id="bt_print">
<button type="button" class="btn btn-danger btn-lg btn-block">พิมพ์ใบเสร็จ</button>
</div>
</center>

  </div>
</div>
</div>

<script>
  function show_tbody1(){
 $.post("call_buy.php",{
    },function(data){
 obj=JSON.parse(data);
 orders=obj;
      console.log(obj);
for(var i=0;i<obj.length; i++){
 $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].buy_date+'</td><td>'+obj[i].buy_id+'</td><td>'+obj[i].monney+'</td></tr>');
  
}
      
      

 }); 

} 


 function show_tbody2(buy_id){
    $.post("call_buy2.php",{
     buy_id:buy_id
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
$("#tbody2").html('');
for(var i=0;i<obj.length; i++){
    $("#tbody2").html($("#tbody2").html()+'<tr><th scope="row">'+obj[i].amont+'</th><td>'+obj[i].Product_name+'</td><td>'+obj[i].price+'</td><td>'+obj[i].price*obj[i].amont+'</td></tr>');
 
}
    $("#bt_print").html('<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href=\'invoice-print.php?buy_id='+buy_id+'\'">พิมพ์ใบเสร็จ</button>');  
      

 }); 

} 

function show_click(id){
      $("#buy_date").html(orders[id].buy_date);
      $("#com_name").html(orders[id].com_name);
      $("#buy_id").html(orders[id].buy_id);
      $("#buy_price").html((orders[id].buy_price*1).toFixed(2)+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#monney").html(orders[id].monney+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#buy_qty").html(orders[id].buy_qty+"&nbsp&nbsp&nbsp&nbsp ชิ้น");
show_tbody2(orders[id].buy_id);
      }


      show_tbody1();  
      <?php
      if (isset($_GET["buy_id"])) { ?>
      show_tbody2('<?php echo $_GET["buy_id"];?>');
   <?php } ?>
</script>

<?php
include("foot.php");
?>