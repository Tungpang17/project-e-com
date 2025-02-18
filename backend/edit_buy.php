 <script type="text/javascript">
   var obj;
   var type_id='';
   var orser=[];
   var com_id;
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

<div class="card mb-3" style="max-width: 10000px;">
  <div class="row">
  <div class="col-md-2">
  </div>
    <div class="col-md-8">
    <div class="card-body">
        
    <div class="row">
    <center><h3>ใบสั่งซื้อสินค้า</h3></center>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">วันที่ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px"><?php echo date("d/m/Y"); ?></label>
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
    <label class="col-sm-5 col-form-label" style="font-size: 20px" id="sum">0</label>
    </div>
      </div>
    </div>
  </div>
</div>


 <button type="button" class="btn btn-success btn-lg btn-block" onclick="order();">พิมพ์ใบสั่งซื้อ</button>

  </div>

<div class="col-md-6">
<div class="row">
  <select class="form-select" aria-label="Default select example" id="com_id" name="com_id" onchange="show_tbody1();">
</select>
 <br>
 <br>
 <div class="col-6">
  <input id="search_product" type="text" class="form-control" style="width:230px"  placeholder="โปรดใส่ชื่อสินค้า"> 
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
      <th scope="col">คงเหลือ</th>
      <th scope="col">เพิ่ม</th>
    </tr>
  </thead>


  <tbody id="tbody1">


  </tbody>
</table>
<br>
  </div>
</div>
</div>

<script>

function order(){
    $.post("call_buy_order.php", {
            orser:JSON.stringify(orser),
            com_id:$("#com_id").val()
            
         
        }, function(data){
   
            try{
                var obj = JSON.parse(data);
                if(obj.status==0){

                }else if(obj.status==1){
                        location.href='invoice-print.php?buy_id='+obj.buy_id;

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



function show_button4(){
    $.post("call_show.php",{
      table:`comunity`,
      conditon2:''
    },function(data){
    obj1=JSON.parse(data);
    console.log(obj);

$("#com_id").html('<option selected disabled>เลือกสถานประกอบการ</option>');
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
$("#button1").html($("#button1").html()+'<option selected onchange="show_tbody1(\'\',\'\',\''+obj[i].com_id+'\');com_id=\''+obj[i].com_id+'\';">'+obj[i].com_name+'</button>  ');
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


function edit_order(id){
  
        orser[id].qty=$("#kfc"+id).val();
  console.log(orser);
  show_order();
}


function show_order(){//แสดงรายการสั่งซื้อ
$("#tbody2").html("");
var sum=0;
var tatel=0;

 for(var i=0;i<orser.length; i++){
    $("#tbody2").html($("#tbody2").html()+'<tr style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+orser[i].pro_name+'</td><td>'+orser[i].pro_cos+'</td><td><input class="form-control" type="text" style="width: 60px" value="'+orser[i].qty+'" onchange="edit_order('+i+');" id="kfc'+i+'"></td><td>'+orser[i].pro_cos*orser[i].qty+'</td><td onclick="remove('+i+')"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg>ลบ</td></tr></tr>');
sum+=orser[i].qty*1;
tatel+=orser[i].pro_cos*orser[i].qty;
  }
$("#sum").html(sum*1);
$("#tatel").html(tatel);
}


function remove(id){
  orser.splice(id,1);
  show_order();
     
}


 function show_tbody1(type_id,search,com_id){
  com_id=com_id;
  $.post("call_show.php",{
    table:'product',
    conditon:type_id,
    search:search,
    com_id:$("#com_id").val()
    },function(data){
    obj=JSON.parse(data);
    console.log(obj);
    $("#tbody1").html('');
for(var i=0;i<obj.length; i++){
    $("#tbody1").html($("#tbody1").html()+'<tr style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+obj[i].product_id+'</td><td>'+obj[i].Product_name+'</td><td>'+obj[i].product_cos+'</td><td>'+obj[i].Qty+'</td><td><svg onclick="add_order(\''+obj[i].product_id+'\',\''+obj[i].Product_name+'\',\''+obj[i].product_cos+'\')"  width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg></td></tr></tr>');}  }); 

} 



 
function search() {
var search=document.getElementById("search_product").value;
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
    show_button4();
    show_tbody1('');  
   
</script>
<?php
include("foot.php");
?>