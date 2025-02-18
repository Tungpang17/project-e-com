 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>

<div class="container">
   <h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
  <h3>รายงานการขายสินค้า ราย วัน/เดือน/ปี  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>

<div class="row">
  <div class="col-md-4">
    <form id="hid">
  เลือกวัน<input type="date" class="form-control" name="date" style="width:50%" onchange="submit()" value="<?php echo $_GET["date"]; ?>">
</form>
  </div>
   <div class="col-md-4">
    <form id="hid">
เลือกเดือน<input type="month" class="form-control" name="date" style="width:50%" onchange="submit()" value="<?php echo $_GET["date"]; ?>">
</form>
  </div>
   <div class="col-md-4">
    <form id="hid">
เลือกปี<input type="year" class="form-control" name="date" style="width:50%" onchange="submit()" value="<?php echo $_GET["date"]; ?>">
</form>
  </div>
</div>







<div id="button1">
</div>  
<br>
 <table  class="table" class="table table-striped table-bordered" style="width:100%" id="example">
  <thead>
    <tr>
     
      <th scope="col">วันที่ขาย</th>
      <th scope="col">รหัสการขาย</th>
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">จำนวนสินค้า/ชิ้น</th>
      <th scope="col">ราคาขาย/ชิ้น</th>
      <th scope="col">ราคารวม</th>
      <th scope="col">รับเงิน</th>
      <th scope="col">พนักงานขาย</th>
    </tr>
  </thead>


<tbody>


<?php
$sql="SELECT * FROM `sall_detail`
LEFT JOIN `product` ON `sall_detail`.`product_id`=`product`.`product_id`
LEFT JOIN `sall` ON `sall_detail`.`sall_id`=`sall`.`sall_id`
where sall_date like '".$_GET["date"]."%'";
$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>
 <tr>
          
            <td><?php echo explode("-",$re["sall_date"])[0];?>-<?php echo explode("-",$re["sall_date"])[1];?></td>
            <td><?php echo $re["sall_id"];?></td>
            <td><?php echo $re["product_id"];?></td>
            <td><?php echo $re["Product_name"];?></td>
            <td><?php echo $re["amont"];?></td>
            <td><?php echo $re["price"];?></td>
            <td><?php echo number_format($re["sall_price"],2);?></td>
            <td><?php echo $re["monney"];?></td>
            <td><?php echo $re["user_id"];?></td>
          </tr>

<?php } ?>
  </tbody>
  
</table>
  </div>
  <script>
    
$(document).ready(function () {
  $('#dt-filter-select').dataTable({

    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          var select = $('<select  class="browser-default custom-select form-control-sm"><option value="" selected>เลือก</option></select>')
              .appendTo( $(column.footer()).empty() )
              .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                  );

                  column
                      .search( val ? '^'+val+'$' : '', true, false )
                      .draw();
              } );

          column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
      } );
  }
  });
});   

  </script>
<?php
include("foot.php");
?>