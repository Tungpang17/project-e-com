 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>





<div class="container">
   <h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
  <h3>รายงานรายรับ รายเดือน/ปี 
 <a href="repost_pay2.php" class="btn btn-success btn-lg active" role="button" aria-pressed="true" id="hid">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
</svg>ดูรายจ่าย</a>


  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>


<form id="hid">
เลือกเดือน<input type="month" class="form-control" name="date" style="width:15%" onchange="submit()" value="<?php echo $_GET["date"]; ?>">
</form>

<form id="hid">
เลือกปี<input type="year" class="form-control" name="date" style="width:15%" onchange="submit()" value="<?php echo $_GET["date"]; ?>">
</form>

<div id="button1">
</div> 
 <table class="table" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
    
      <th scope="col">ว/ด/ป</th>
      <th scope="col">จำนวน</th>
      <th scope="col">รายรับ</th>
    </tr>
  </thead>
<tbody>

<?php
/* 
$query= "SELECT `sall_date`,SUM(sall_price) FROM `sall_detail`"; 
$result = mysqli_query($con,$query);
 while($row = mysqli_fetch_array($result)){ 
  echo "Total ". $row['sall_date']. " = $". $row['SUM(sall_price)']; 
  echo "<br />"; 
}*/
?>


<?php
$sql="SELECT *,sum(amont) as tt,sum(price*amont) as monney FROM `sall_detail`
LEFT JOIN `product` ON `sall_detail`.`product_id`=`product`.`product_id`
LEFT JOIN `sall` ON `sall_detail`.`sall_id`=`sall`.`sall_id`
where sall_date like  '".$_GET["date"]."%' group by sall_date";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
  $sum+=$re["monney"];
?>
 <tr>
            <td><?php echo $re["sall_date"];?></td>
            <td><?php echo $re["tt"];?></td>
            <td><?php echo $re["monney"];?></td>
            
          </tr>

<?php } ?>
  </tbody>
  <tr>
            <td></td>
            <td>รวมทั้งหมด</td>
            <td><?php echo $sum; ?></td>
          </tr>
</table>
</div>

<br>
<?php
include("foot.php");
?>