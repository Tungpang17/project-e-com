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
	<h3>รายงานข้อมูลรายได้สถานประกอบการ  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 
    
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>
  <br>
  <form >
  <div class="row justify-content-md-center">
<!-- <div class="col-sm-3">
  <label id="icon" for="m_email">เริ่มต้น</label>
  <input type="date" name="date_s" class="form-control" value="<?php echo $_GET["date_s"]?>" /> 
</div>
 -->
<div class="col-sm-3">
  <label id="icon" for="m_email">เลือกสถานประกอบการ</label>
  <!-- <input type="date" name="date_e" class="form-control" value="<?php echo $_GET["date_e"]?>"/>  -->
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" onchange="submit()" name="s">
    <option value="">ทั้งหมด</option>
<?php 
$sql="SELECT * FROM `comunity`";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>
    <option <?php if(isset($_GET["s"]) && $_GET["s"]==$re["com_id"]) echo "selected";?> value="<?php echo $re["com_id"];?>"><?php echo $re["com_name"];?></option>
    <?php }?>

  </select>
</div>

<div class="col-sm-3">

<button id="hid" type="submit" class="btn btn-secondary" style="margin-top:32px" onmousedown="s.value='';">ทั้งหมด</button>
</div>
</div>
</form>
<table  class="table" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th scope="col">วันที่</th>
    <th scope="col">ชื่อสถานประกอบการ</th>
      <th scope="col">จำนวนสินค้าที่ขาย</th>
      <th scope="col">ต้นทุนทั้งหมด</th>
      <th scope="col">ยอดขายทั้งหมด</th>
      <th scope="col">กำไร</th>
    </tr>
  </thead>

  <tbody id="tbody1">
    <?php
    $sql="SELECT * ,sum(pro_amount) AS amount,sum(product_cos*pro_amount) as sumcos,sum(Product_Price*pro_amount) as sumprice FROM `order_detail` 
    LEFT JOIN `orders` ON `order_detail`.`order_id` = `orders`.`order_id`
    LEFT JOIN product ON `order_detail`.product_id=`product`.product_id
    LEFT JOIN `comunity` ON product.com_id=`comunity`.`com_id`
    WHERE 1 ";

    if($_GET["date_s"] !="" && $_GET["date_e"] !=""){
        $sql.=" AND (order_date >='".$_GET["date_s"]."' AND order_date <='".$_GET["date_e"]."') ";    
    }

    if(isset($_GET["s"]) && $_GET["s"]!=""){
      $sql.=" AND product.`com_id`='".$_GET["s"]."' ";    
    }

    $sql.=" GROUP BY product.com_id,order_date";
    $que=mysqli_query($con,$sql);
  
    while($re=mysqli_fetch_assoc($que)){

    ?>
    <tr>
    <td><?php echo $re["order_date"];?></td>
    <td><?php echo $re["com_name"];?></td>
      <td><?php $sum_amount+=$re["amount"];echo $re["amount"];?></td>
      <td><?php $sum_sumcos+=$re["sumcos"];echo $re["sumcos"];?></td>
<td><?php $sum_sumprice+=$re["sumprice"];echo $re["sumprice"];?></td>
<td><?php echo $re["sumprice"]-$re["sumcos"];?></td>
    </tr>

<?php }?>

<tr>
    
    <th scope="col" colspan="2">รวม</th>
      <th scope="col"><?php echo $sum_amount;?></th>
      <th scope="col"><?php echo $sum_sumcos;?></th>
      <th scope="col"><?php echo $sum_sumprice;?></th>
      <th scope="col"><?php echo $sum_sumprice-$sum_sumcos;?></th>
    </tr>
  </tbody> 

</table>

 </div>



<?php
include("foot.php");
?>