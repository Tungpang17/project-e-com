 <script type="text/javascript">
   var obj;
   var obj1;
   var type_id='';
   var send_buy_id;
 </script>
 <?php
include("head.php");
?>
<div class="container">
<br>
<br>
<br>
<div class="row">
<div class="col-md-6">
<select class="form-select" aria-label="Default select example" id="buy_id" name="buy_id" onchange="show_click();">
</select>

<br>

<div class="card mb-3" style="max-width: 10000px;">
  <div class="row">
  <div class="col-md-2">
  </div>
    <div class="col-md-8">
    <div class="card-body">
        
    <div class="row">
    <center><h3>ใบส่งสินค้า</h3></center>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">วันที่ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="buy_date">-</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" >เลขที่ใบสั่งซื้อ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="buy_id1">-</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">ถึง :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px" id="com_name1">-</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">รายการสินค้า :</label>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
      <th scope="col">รวม</th>
    </tr>
  </thead>


  <tbody id="tbody2">
   
  </tbody>
 

</table>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">จำนวนสินค้า :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px" id="buy_qty">-</label>
    </div>
      </div>
    </div>
  </div>
</div>
 
  </div>

<div class="col-md-6">  
<div class="row">
 

 <div class="col-6">
  <input id="search_product" type="text" class="form-control" style="width:230px"  placeholder="โปรดใส่ชื่อสินค้า"> 
  </div>
  <div class="col-6">
  <button class="btn btn-warning" type="submit" onclick="search();">Search</button>
  </div>

</div>
<br>
<form id="form1" method="post">
 <table class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">คงเหลือ</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
      
    </tr>
  </thead>


  <input type="hidden" name="buy_id" id="send_buy_id">
  <tbody id="tbody1">


  </tbody>

</table>
</form>
 <button type="button" class="btn btn-success btn-lg btn-block" onclick="up()">นำเข้าสินค้า</button>
</div>

</div>
</div>
<script>

 function up(){
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_add_proqty.php',
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
                      title: 'นำเข้าสำเร็จ',
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


function show_button3(){
    $.post("call_show3.php",{
    },function(data){
    obj1=JSON.parse(data);
    console.log(obj1);

$("#buy_id").html('<option selected>เลือกใบส่งสินค้า</option>');
for(var i=0;i<obj1.length; i++){
$("#buy_id").html($("#buy_id").html()+'<option value="'+i+'">'+obj1[i].buy_id+'</option>');
}  }); 
} 

function show_button4(){
    $.post("call_show.php",{
      table:`comunity`,
      conditon2:''
    },function(data){
    obj1=JSON.parse(data);
    console.log(obj1);

$("#com_id").html('<option selected >เลือกสถานประกอบการ</option>');
for(var i=0;i<obj1.length; i++){
$("#com_id").html($("#com_id").html()+'<option value="'+obj[i].com_id+'">'+obj[i].com_name+'</option>');
}  }); 
} 


 function show_button1(){
    $.post("call_show.php",{
      table:`comunity`,
      conditon2:''
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);


for(var i=0;i<obj.length; i++){
$("#button1").html($("#button1").html()+'<button type="button" class="btn btn-warning" onclick="show_tbody1(\'\',\'\',\''+obj[i].com_id+'\');com_id=\''+obj[i].com_id+'\';">'+obj[i].com_name+'</button>  ');

$("#com_id").html($("#com_id").html()+'<option value="'+obj[i].com_id+'">'+obj[i].com_name+'</option>');
}  }); 
}



function add_order(id,name,cos,){

  for ( var index=0; index<orser.length; index++ ) {
    if ( orser[index].pro_id==id) {
        orser[index].qty++;
        var check_pro=true;break;
    }

}
if(!check_pro){
  orser.push({ "pro_id":id ,"qty": 1 ,"pro_name":name,"pro_cos":cos});
}
  console.log(orser);

  show_order();
}




 function show_tbody2(buy_id){
    $.post("call_buy2.php",{
     buy_id:buy_id
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
$("#tbody2").html('');
$("#tbody1").html('');
var item='';

for(var i=0;i<obj.length; i++){
  
    $("#tbody2").html($("#tbody2").html()+'<tr><th scope="row">'+(i+1)+'</th><td>'+obj[i].Product_name+'</td><td>'+obj[i].price+'</td><td>'+obj[i].amont+'</td><td>'+obj[i].price*obj[i].amont+'</td></tr>');
     
    var node=document.createElement("tr");
     node.innerHTML='<th scope="row">'+(i+1)+'</th><td>'+obj[i].product_id+'</td><td>'+obj[i].Product_name+'</td><td>'+obj[i].Qty+'</td><td><input class="form-control" type="text" style="width: 50px" value="'+obj[i].product_cos+'" name="product_cos[]"></td><td><input class="form-control" type="text" style="width: 50px" value="'+obj[i].amont+'" name="amont[]"></td><input class="form-control" type="hidden" style="width: 50px" value="'+obj[i].product_id+'" name="product_id[]">';

    document.getElementById("tbody1").appendChild(node);
 
}
    $("#bt_print").html('<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href=\'invoice-print.php?buy_id='+buy_id+'\'">พิมพ์ใบเสร็จ</button>');  
      

 }); 

} 

function search() {
  show_tbody1()
var search=document.getElementById("search_product").value
show_tbody1(type_id,search);
}

function show_click(){
      var id =$("#buy_id").val();
      send_buy_id=obj1[id].buy_id;
      $("#send_buy_id").val(obj1[id].buy_id);

      $("#buy_date").html(obj1[id].buy_date);
      $("#com_id1").html(obj1[id].com_id);
      $("#com_name1").html(obj1[id].com_name);
      $("#buy_id1").html(obj1[id].buy_id);
      $("#buy_price").html((obj1[id].buy_price*1).toFixed(2)+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#monney").html(obj1[id].monney+"&nbsp&nbsp&nbsp&nbsp บาท");
      $("#buy_qty").html(obj1[id].buy_qty+"&nbsp&nbsp&nbsp&nbsp ชิ้น");
show_tbody2(obj1[id].buy_id);
console.log(obj1);
      }
    show_button1();
    show_button4();
    show_button3();
    show_tbody1('');   
</script>
<?php
include("foot.php");
?>