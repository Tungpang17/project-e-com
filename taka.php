<?php
include("head.php");
?>

<?php if (isset($_GET["alert"])) { ?>
  <script>
    alert('<?php echo $_GET["alert"]; ?>');
  </script>
<?php } ?>
<style>

<?php 
$sql = "SELECT * FROM `taka`
LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`

 WHERE 1 AND `m_id`='" . $_SESSION["otop"]["ID"] . "' ";

 $result = mysqli_query($con, $sql);

 $items = [];

 while ($row = mysqli_fetch_assoc($result)) {
  $items[] = $row;
 }
?>

</style>

<!--Main column-->
<div class="col-lg-8">


  <div class="testbox">
    <h1>ตะกร้าสินค้า</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ลำดับ</th>
          <th scope="col">รายการสินค้า</th>
          <th scope="col">จำนวน</th>
          <th scope="col">ราคา</th>
          <th scope="col">ราคารวม</th>
          <th scope="col">ลบ</th>
        </tr>
      </thead>
      <tbody>


        <?php
        $sql = "SELECT * FROM `taka`
      LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`
      
       WHERE 1 AND `m_id`='" . $_SESSION["otop"]["ID"] . "' ";
    
        $que = mysqli_query($con, $sql);
        while ($re = mysqli_fetch_assoc($que)) {
        ?>
          <form name="f<?php echo $re["k_id"]; ?>" action="update_taka.php" method="post">
            <input type="hidden" name="k_id" value="<?php echo $re["k_id"]; ?>">
            <tr>
              <th scope="row"><?php echo @++$i; ?></th>
              <td><?php echo $re["Product_name"]; ?></td>
              <td><input type="number" class="form-control" value="<?php echo $re["amount"]; ?>" style="width:100px" name="amount"></td>
              <td><?php echo $re["Product_Price"]; ?></td>
              <td><?php echo $re["Product_Price"] * $re["amount"]; ?></td>
              <td><button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $re["k_id"]; ?>)">ลบ</button></td>
            </tr>
          </form>
        <?php } ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>ราคารวมทั้งหมด</td>
          <td>
            <?php
              $total = 0;  

              foreach ($items as $item) {
                $total = ($item["Product_Price"] * $item["amount"]) + $total;
              } 

              echo $total;
            ?>
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <hr>
    <a href="confrim_order.php"><button type="button" class="btn btn-primary">สั่งซื้อ</button></a>
    <a href="index.php"><button type="button" class="btn btn-secondary">เลือกสินค้าเพิ่มเติม</button></a>
  </div>
  <!-- /.Main column -->

</div>
</div>
<!-- /.Main layout -->

</main>

<script>
  function deleteItem(id) {
    if (confirm('ยืนยันการลบข้อมูล')) {
      window.open('del_taka.php?id=' + id)
    }
  }
  </script>

<?php
include("foot.php");
?>