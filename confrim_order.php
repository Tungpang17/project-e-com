<?php
include("head.php");
?>

<?php if(isset($_GET["alert"])){?>
  <script >
  alert('<?php echo $_GET["alert"];?>');
</script>
  <?php }?>
<style>



</style>

    <!--Main column-->
    <div class="col-lg-8">


    <div class="testbox">
  <h1>ยืนยันรายการสั่งซื้อ</h1>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ภาพ</th>
      <th scope="col">รายการสินค้า</th>
      <th scope="col">จำนวน</th>
      <th scope="col">ราคา</th>
      <th scope="col">ราคารวม</th>
    </tr>
  </thead>
  <tbody>


      <?php
      $sql="SELECT * FROM `taka`
      LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`
      
       WHERE 1 AND `m_id`='".$_SESSION["otop"]["ID"]."' ";    
      $que=mysqli_query($con,$sql);
      while($re=mysqli_fetch_assoc($que)){
      ?>
      <form name="f<?php echo $re["k_id"];?>" action="update_taka.php" method="post">
      <input type="hidden" name="k_id" value="<?php echo $re["k_id"];?>">
    <tr>
      <th scope="row"><?php echo @++$i;?></th>


      <?php
$sql="SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='".$re["product_id"]."'";
$quepic=mysqli_query($con,$sql);
$repic=mysqli_fetch_assoc($quepic);
?>
       <td><img src="backend/img/product/<?php echo $repic["pic_url"]?>" class="card-img" alt="..."></td>
      <td><?php echo $re["Product_name"];?></td>
      <td><?php echo $re["amount"];?></td>
      <td><?php echo $re["Product_Price"];?></td>
      <td><?php echo $re["Product_Price"]*$re["amount"];?></td>
    </tr>
    </form>
    <?php }?>
  </tbody>
</table>
<hr>
<a href="add_order.php" ><button type="button" class="btn btn-primary">ยืนยันการสั่งซื้อ</button></a>
<a href="taka.php" ><button type="button" class="btn btn-secondary">แก้ไขรายการสั่งซื้อ</button></a>
    </div>
    <!--/.Main column-->

  </div>
</div>
<!--/.Main layout-->

</main>

<?php
include("foot.php");
?>

  