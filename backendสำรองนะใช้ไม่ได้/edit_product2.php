 <script type="text/javascript">
   var obj;
   var type_id='';
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

<div id="button1">

</div>

<br>


<div class="row">
 <div class="col-6">
  <td><input id="search_product" type="text" class="form-control" style="width:230px"  placeholder="โปรดใส่ชื่อสินค้า"> </td>
  </div>
  <div class="col-6">
  <button class="btn btn-warning" type="submit" onclick="search();">Search</button>
  </div>
</div>


<br>
  <table class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>


  <tbody id="tbody1">


  </tbody>
</table>
  </div>

  <div class="col-md-6">
   
    <div class="card mb-3" style="max-width: 10000px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="img/1.png" class="card-img" alt="...">
      <br>
      <br>

    </div>
<form id="form1">
    <div class="col-md-12">
    <div class="card-body">
        
    <div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">รหัสสินค้า :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" placeholder="ใส่รหัสสินค้า" name="product_id" id="pro_id">
    </div>
    </div>

    <label class="card-text" style="font-size: 20px">ชื่อสินค้า :</label>
    <input class="form-control" type="text" placeholder="ใส่ชื่อสินค้า" name="Product_name" id="pro_name">

    <label class="card-text" style="font-size: 20px">รายระเอียดสินค้า :</label>
    <textarea class="form-control" placeholder="รายระเอียดสินค้า" rows="3" name="Product_detail" id="pro_de"></textarea>
<br>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">ราคา :</label>
    <div class="col-sm-5">
      <input class="form-control" type="text" placeholder="ใส่ราคา" name="Product_Price" id="pro_price">
    </div>
    </div>
      
        
	<div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">จำนวน :</label>
    <div class="col-sm-5">
      <input class="form-control" type="text" placeholder="ใส่จำนวน" name="Qty" id="qty">
    </div>
    </div>

<div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">เลือกหมวดหมู่ :</label>
<div class="col-sm-5">
      <select class="form-select" aria-label="Default select example" name="type_id" id="type_id">
     </select>
    </div>
    </div>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label" style="font-size: 20px">เลือก :</label>
<div class="col-sm-5">
      <select class="form-select" aria-label="Default select example" name="com_id" id="com_id">
     </select>
    </div>
    </div>



 </div>
 </div>
</div>
</div>
</form>
</div>

    
<script>
/*var input = document.getElementById("Product_name");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) { 
    s();
  }




});

function s(){

     $.post("call_search2.php",{
      Product_name:$("#Product_name").val()
    },function(data){


      var obj=JSON.parse(data);
      console.log(obj.Product_name);
      $("#product_id").html(obj.product_id);
      $("#Product_name").html(obj.Product_name);
      $("#Product_Price").html(obj.Product_Price);
      $("#Qty").html(obj.Qty);
      


      });
}*/


  function add(){
if($("#pro_id").val()==''){
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
            url: 'call_add_product.php',
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
if($("#pro_id").val()==''){
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
            url: 'call_de_product.php',
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
if($("#pro_id").val()==''){
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
            url: 'call_up_product.php',
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

 function show_button1(){
    $.post("call_show.php",{
      table:'type',
      condition:''
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);

$("#type_id").html('<option selected>เลือกหมวดหมู่สินค้า</option>');
$("#button1").html('<button type="button" class="btn btn-warning" onclick="show_tbody1(\'\',\'\');type_id=\'\';">ทั้งหมด</button>  ');
for(var i=0;i<obj.length; i++){

$("#button1").html($("#button1").html()+'<button type="button" class="btn btn-warning" onclick="show_tbody1(\''+obj[i].type_id+'\',\'\');type_id=\''+obj[i].type_id+'\';">'+obj[i].type_name+'</button>  ');
$("#type_id").html($("#type_id").html()+'<option value="'+obj[i].type_id+'">'+obj[i].type_name+'</option>');
}  }); 
} 

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



  function show_tbody1(type_id,search){
  $.post("call_show.php",{
    table:'product',
    conditon:type_id,
    search:search
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
    $("#tbody1").html('');
for(var i=0;i<obj.length; i++){
    $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].product_id+'</td><td>'+obj[i].Product_name+'</td><td>'+obj[i].Product_Price+'</td><td>'+obj[i].Qty+'</td></tr>');}  }); 

} 

function search() {

var search=document.getElementById("search_product").value
show_tbody1(type_id,search);
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
    show_button2();
    show_tbody1();  
</script>
</div>
</div>
<br>
<?php
include("foot.php");
?>