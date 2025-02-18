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
	<h3>รายงานข้อมูลการจัดส่งสินค้า  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 
    
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
      
    <th scope="col">รหัสการจัดส่ง</th>
      <th scope="col">ชื่อบริษัทขนส่ง</th>
      <th scope="col">Tracking ID</th>
      <th scope="col">วันที่จัดส่ง</th>
      <th scope="col">เวลาจัดส่ง</th>
      <th scope="col">สถานะการจัดส่ง</th>
      <th scope="col">เลขที่ออเดอร์</th>
      <th scope="col">ชื่อลูกค้า</th>
    </tr>
  </thead>

  <tbody id="tbody1">
    <?php
    $sql="SELECT * FROM `transport`
    LEFT JOIN `orders` ON `transport`.`order_id` = `orders`.`order_id`
    LEFT JOIN `member` ON `orders`.`m_id`= `member`.`m_id`
    WHERE 1 ";

    if($_GET["date_s"] !="" && $_GET["date_e"] !=""){
        $sql.=" AND (tra_date >='".$_GET["date_s"]."' AND tra_date <='".$_GET["date_e"]."')";    
    }
    $que=mysqli_query($con,$sql);
    while($re=mysqli_fetch_assoc($que)){

    ?>
    <tr>
      
    <td><?php echo $re["tra_id"];?></td>
      <td><?php echo $re["tra_name"];?></td>
      <td><?php echo $re["tra_track"];?></td>
    <td><?php echo $re["tra_date"];?></td>
    <td><?php echo $re["tra_time"];?></td>
    <td>
  <?php if($re["tra_status"]==0){?>    
     อยู่ระหว่างจัดส่ง
    <?php }else{?>
      ได้รับสินค้าแล้ว
      <?php }?>
  </td>
    <td><?php echo $re["order_id"];?></td>
    <td><?php echo $re["m_fullname"];?></td>
    </tr>

<?php }?>
  </tbody> 

</table>

 </div>



<?php
include("foot.php");
?>