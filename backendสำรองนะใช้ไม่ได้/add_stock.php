<script>
var taka=[];
var sum;
</script>
<?php
include("head.php");
?>
<?php
//header("location:login/");
?>
<br>
<br>
<br>
<div class="container-fluid">


<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">เลขที่ใบส่งสินค้า</label>
      <input type="text" class="form-control" id="text1">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">วัน/เดือน/ปี</label>
      <input type="date" class="form-control" id="text2">
    </div>
    <div class="form-group col-md-4">
    <label for="exampleFormControlSelect1">ส่งมาจาก</label>
    <select class="form-select" aria-label="Default select example" name="com_id" id="com_id">
    </select>
  </div>
  </div>



  <div class="row">
    <div class="col-md-6">
      <label style="font-size:30px">รายการสินค้า</label>
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">รหัสสินค้า</th>
            <th scope="col">ชื่อสินค้า</th>
            <th scope="col">ราคา</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคารวม</th>
            <th scope="col">ลบ</th>
          </tr>
        </thead>
        <tbody id="tbody1">
          
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
     ใสรหัสสินค้า
      <div class="card mb-3" style="max-width: 10000px;">
        <div class="row no-gutters">
          <div class="col-md-2">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <div class="mb-3 row">
                <label class="col-sm-4 col-form-label" style="font-size: 20px">รหัสสินค้า :</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" placeholder="ใส่รหัสสินค้า" aria-label="deafult input example" id="pro_id" autofocus="">
                </div>
              </div>
              <h5 class="card-title" style="font-size: 30px" id="pro_price">รวมราคา :  0.00  บาท</h5>
            </div>
          </div>
        </div>
      </div>
</form>


      <center>
      <button type="button" class="btn btn-success btn-lg" onclick="up()">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg> นำเข้าสินค้า</button>

      <button type="button" class="btn btn-danger btn-lg">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
      </svg> ล้างข้อมูล</button>
      </center>

    </div>
  </div>
</div>
<script>
function show_button2(){
    $.post("call_show2.php",{
      table:'comunity',
      condition2:''
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);

$("#com_id").html('<option selected>เลือก</option>');
for(var i=0;i<obj.length; i++){
$("#com_id").html($("#com_id").html()+'<option value="'+obj[i].com_id+'">'+obj[i].com_name+'</option>');
}  }); 
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
 show_button2();
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



function order(){

$.post("call_add_order.php", {
taka:JSON.stringify(taka),
monney:$("#money").val()

}, function(data){
$("#money").val('');
try{
var obj = JSON.parse(data);
if(obj.status==0){
}else if(obj.status==1){
location.href='bill.php?sall_id='+obj.sall_id;
}
}catch(err){
Swal.fire(
'เกิดข้อผิดพลาดไม่ทราบสาเหตุ',
'โปรดลองใหม่อีกครั้ง'+err+data,
'error'
)
}
});
}
var input = document.getElementById("pro_id");
input.addEventListener("keyup", function(event) {
if (event.keyCode === 13) {
$.post("call_product.php",{
pro_id:$("#pro_id").val()
},function(data){
var obj=JSON.parse(data);
console.log(obj.Product_name);
$("#pro_name").html(obj.Product_name);
$("#pro_de").html(obj.Product_detail);

$("#pro_id").val('');

for ( var index=0; index<taka.length; index++ ) {
if ( taka[index].pro_id==obj.product_id) {
taka[index].qty++;
var check_pro=true;break;
}
}
if(!check_pro){
taka.push({ "pro_id": obj.product_id,"pro_name": obj.Product_name,"pro_price": obj.Product_Price, "qty": 1 } );
}
show_tbody1();
console.log(taka);
});
}
});
function show_tbody1(){
$("#tbody1").html('');
$("#pro_price").html("รวมราคา :  "+0+"  บาท");
var qty=0;
sum=0;
for(var i=0;i<taka.length; i++){
var total=taka[i].qty*taka[i].pro_price;
sum+=total;
qty+=taka[i].qty*1;

$("#pro_price").html("รวมราคา :  "+sum+"  บาท");
$("#tbody1").html($("#tbody1").html()+'<tr style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+taka[i].pro_id+'</td><td>'+taka[i].pro_name+'</td><td>'+taka[i].pro_price+'</td><td><input id="qty'+i+'" class="form-control" type="text" style="width: 50px" value="'+taka[i].qty+'" onchange="change_qty('+i+')"></td><td>'+total+'</td><td onclick="remove('+i+')"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg>ลบ</td></tr>');
}
$("#qty").html("จำนวน :  "+qty*1+"  ชิ้น");
}
function change_qty(id){

taka[id].qty=$("#qty"+id).val();
show_tbody1();

}
function remove(id){
taka.splice(id,1);
show_tbody1();
$("#pro_name").html('');
$("#pro_de").html('');
$("#qty").html("จำนวน :    ชิ้น");
}
function money(){
if($("#money").val()<sum){
Swal.fire(
'แจ้งเตือน',
'จำนวนเงินของคุณไม่เพียงพอ',
'error'
)
}else{
$("#c_money").html($("#money").val()-sum);
}

}
</script>
<?php
include("foot.php");
?>