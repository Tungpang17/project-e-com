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
<div class="row">
<div class="col-md-6">
<label style="font-size:30px">รับสินค้าเข้าคลัง</label>
<br>
<br>
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
<center>
<button type="button" class="btn btn-warning" onclick="add()">เพิ่มสินค้า</button>
<button type="button" class="btn btn-warning" onclick="de()">ลบสินค้า</button>
<button type="button" class="btn btn-warning" onclick="up()">แก้ไขสินค้า</button>
<button type="reset" class="btn btn-warning" >ล้างข้อมูล</button>
</center>
</form>
  </form>
</table>

</div>

<div class="col-md-6">

<button type="button" class="btn btn-warning btn-lg btn-block" onclick="order()">เพิ่มสินค้า</button>
</div>
</div>
</div>

<script>
function order(){

    
    $.post("call_add_order2.php", {
            taka:JSON.stringify(taka),
            monney:$("#money").val()
         
        }, function(data){

            try{
                var obj = JSON.parse(data);
                if(obj.status==0){

                }else if(obj.status==1){
                        location.href='add_product.php?sall_id='+obj.sall_id;
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

      $("#qty").html("จำนวน :  "+obj.Qty+"  ชิ้น");

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

$("#pro_price").html("ราคา :  "+0+"  บาท");
sum=0;
for(var i=0;i<taka.length; i++){

var total=taka[i].qty*taka[i].pro_price;
sum+=total;
  
 
 $("#pro_price").html("ราคา :  "+sum+"  บาท");

  $("#tbody1").html($("#tbody1").html()+'<tr style="cursor:pointer"><th scope="row">'+(i+1)+'</th><td>'+taka[i].pro_id+'</td><td>'+taka[i].pro_name+'</td><td>'+taka[i].pro_price+'</td><td><input id="qty'+i+'" class="form-control" type="text" style="width: 50px" value="'+taka[i].qty+'" onchange="change_qty('+i+')"></td><td>'+total+'</td><td onclick="remove('+i+')"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg>ลบ</td></tr>');
}

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