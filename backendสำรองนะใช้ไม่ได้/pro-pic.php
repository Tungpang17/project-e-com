 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>
<div class="container">

  <h3><img src="img/11.png" width="50" height="50"> จัดการภาพสินค้า
      <a href="add_pic.php?id=<?php echo $_GET["id"];?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">เพิ่มรูปภาพ 
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
       <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
      </svg></a>
</h3> 
  
<div id="button1">

</div>	
<br>

<div class="container" style="margin-top:10px">
<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
$sql="SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='".$_GET["id"]."'";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>

    
   
  <div class="col">
    <div class="card h-100">
      <img src="img/product/<?php echo $re["pic_url"];?>" class="card-img-top" alt="...">
      <div class="card-body">
        <!-- <h5 class="card-title">GCPhone v3</h5>
        <p class="card-text">สามารถโพส Twitter แล้วแจ้งเตือนเป็นภาพได้</p>
          <p>IP Server : 1.1.1.1            
                  </p> -->
          
          
                    
          <a href="del_pic.php?pic_id=<?php echo $re["pic_id"];?>&id=<?php echo $_GET["id"];?>"><button type="button" class="btn btn-danger">ลบ</button></a>
                    
          
          
          
      </div>
    </div>
  </div>

   

   

<?php } ?>

</div>
</div>
  </div>
<script>
function up(){
 
        // เตรียมข้อมูล form สำหรับส่ง
       var formData =  new FormData($("#form1")[0]);

                // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
        $.ajax({
            url: 'call_up_proqty2.php',
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
                      title: 'เบิกสินค้าสำเร็จ',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout("location.reload()",1500);
                }else if(obj.status==0){
                    Swal.fire({
                      icon: 'error',
                      title: 'เบิกสินค้าเกินจำนวน',
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




function show_click(id){
$("#product_id").val(obj[id].product_id);
$("#Product_name").val(obj[id].Product_name);
$("#Qty").val(obj[id].Qty);
}

</script>


<?php
include("foot.php");
?>