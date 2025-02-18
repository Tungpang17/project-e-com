 <?php
include("head.php");
include("conf/mariadb.php");
?>
<br>
<br>
<br>
<br>



<div class="container">
<h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
	<h3>รายงานข้อมูลการขาย  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 
    
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>
  <br>
  <form >
  <div class="row justify-content-md-center">
<div class="col-sm-3">
  <label id="icon" for="m_email">เริ่มต้น</label>
  <input type="date" name="date_s" class="form-control" value="<?php echo $_GET["date_s"]?>" /> 
</div>
<div class="col-sm-3">
  <label id="icon" for="m_email">สิ้นสุด</label>
  <input type="date" name="date_e" class="form-control" value="<?php echo $_GET["date_e"]?>"/>
</div>
<div class="col-sm-3">

<button id="hid" type="submit" class="btn btn-primary" style="margin-top:32px">กรอง</button>
<button id="hid" type="submit" class="btn btn-secondary" style="margin-top:32px" onmousedown="date_s.value='';date_e.value='';">ทั้งหมด</button>
</div>
</div>
</form>
<table  class="table" cellspacing="0" width="100%">
  <thead>
    <tr>
      
    <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">รายละเอียด</th>
      <th scope="col">รูปภาพ</th>
      <th scope="col">จำนวนการขาย</th>
      <th scope="col">วันที่ขาย</th>
    </tr>
  </thead>

  <tbody id="tbody1">
    <?php
    $sql="SELECT * ,CONCAT(`orders`.order_date,' ',`orders`.order_time) AS `d_s`,sum(pro_amount) AS sum_amount FROM `order_detail` 
    LEFT JOIN `orders` ON `order_detail`.`order_id` = `orders`.`order_id`
    LEFT JOIN product ON `order_detail`.product_id=`product`.product_id
    WHERE 1 ";

    if($_GET["date_s"] !="" && $_GET["date_e"] !=""){
        // $sql.=" AND (order_date >='".$_GET["date_s"]."' AND order_date <='".$_GET["date_e"]."')";    
         $sql.=" AND order_date  BETWEEN '".$_GET["date_s"]."' AND '".$_GET["date_e"]."' ";  
    }
    $sql.="    GROUP BY `order_detail`.product_id , orders.order_date ";
    $que=mysqli_query($con,$sql);
    while($re=mysqli_fetch_assoc($que)){

    ?>
    <tr>
      
    <td><?php echo $re["product_id"];?></td>
      <td><?php echo $re["Product_name"];?></td>
      <td><?php echo $re["Product_detail"];?></td>
      <?php
$sql="SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='".$re["product_id"]."'";
$quepic=mysqli_query($con,$sql);
$repic=mysqli_fetch_assoc($quepic);
?>
      <td> <img src="img/product/<?php echo $repic["pic_url"]?>" width="200px" class="img-fluid" alt=""></td>
<td><?php echo $re["sum_amount"];?></td>
<td><?php echo $re["order_date"];?></td>
    </tr>

<?php }?>
  </tbody> 

</table>

 </div>



<?php
include("foot.php");
?>