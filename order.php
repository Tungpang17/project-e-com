<?php
include("head.php");
?>
<style>



</style>

<!--Main column-->
<div class="col-lg-8">


  <div class="testbox">
    <div>
      <h1>การสั่งซื้อของฉัน</h1>

      <a href="order-history.php"><button type="button" class="btn btn-primary">ประวัติการสั่งซื้อ</button></a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ลำดับ</th>
          <th scope="col">วันที่สั่งซื้อ</th>
          <th scope="col">ราคารวม</th>
          <th scope="col">สถานะ</th>
          <!-- <th scope="col"></th> -->

          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>


        <?php
        $sql = "SELECT `orders`.*,`payments`.pay_status,transport.tra_id,transport.tra_name,transport.tra_track,transport.tra_date,transport.tra_time,transport.tra_status FROM `orders` 
      LEFT JOIN `payments` ON `orders`.`order_id`=`payments`.`order_id`
      LEFT JOIN `transport` ON `payments`.`order_id`=`transport`.`order_id`
    --   LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`
      
       WHERE 1 AND `m_id`='" . $_SESSION["otop"]["ID"] . "' ";
        $que = mysqli_query($con, $sql);
        while ($re = mysqli_fetch_assoc($que)) {
          ?>

          <span>
            <th scope="row"><?php echo @++$i; ?></th>
            <td><?php echo $re["order_date"] . " " . $re["order_time"]; ?></td>
            <td><?php echo number_format($re["order_tatal"], 2); ?></td>
            <td>
              <?php if ($re["pay_status"] == 0 and $re["pay_status"] != "") { ?>
                <span class="badge badge-primary">รอการตรวจสอบ</span>
              <?php } elseif ($re["pay_status"] == "") { ?>
                <span><span class="badge badge-warning">ยังไม่ชำระเงิน</span></span>
              <?php } elseif ($re["pay_status"] == 1 && $re["tra_track"] == "") { ?>
                <span class="badge badge-warning">ชำระเงินสำเร็จ รอการจัดส่ง</span>
              <?php } elseif ($re["pay_status"] == 1 && $re["tra_track"] != "" && $re["tra_status"] != 1) { ?>
                <span class="badge badge-info">อยู่ระหว่างขนส่ง</span><br> Tracking :
                <?php echo $re["tra_track"] . '<br><a href="https://ems.thaiware.com/' . $re["tra_track"] . '" target="_blank"><span class="badge badge-secondary">ตรวจสอบ</span></a>'; ?>
              <?php } else { ?>
                ยืนยันได้รับสินค้าแล้ว
              <?php } ?>
            </td>
            <td><?php if ($re["pay_status"] == 1 && $re["tra_track"] != "" && $re["tra_status"] != 1) { ?>
                <a href="update_transport.php?tra_id=<?php echo $re["tra_id"]; ?>"><button type="button"
                    class="btn btn-primary">หากได้รับสินค้าแล้ว โปรดคลิก</button></a>
              <?php } ?>
            </td>
            <td>
              <a href="invoice-print.php?order_id=<?php echo $re["order_id"] ?>">
                <button>พิมพ์ใบสั่งซื้อ</button>
              </a>
            </td>
            </tr>



            <tr>
              <td colspan="6">




                <?php
                $sql2 = "SELECT * FROM `order_detail` 
      LEFT JOIN `product` ON `order_detail`.`product_id`=`product`.`product_id`
    --   LEFT JOIN `product` ON `taka`.`product_id`=`product`.`product_id`
      
       WHERE 1 AND `order_id`='" . $re["order_id"] . "' ";
                $que2 = mysqli_query($con, $sql2);
                while ($re2 = mysqli_fetch_assoc($que2)) {
                  ?>
                  <div class="card mb-3" style="max-width: 100%;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <?php
                        $sql = "SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='" . $re2["product_id"] . "'";
                        $quepic = mysqli_query($con, $sql);
                        $repic = mysqli_fetch_assoc($quepic);
                        ?>
                        <img src="backend/img/product/<?php echo $repic["pic_url"] ?>" class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $re2["Product_name"]; ?></h5>
                          <p class="card-text"><?php echo $re2["Product_detail"]; ?></p>
                          <p class="card-text"><small class="text-muted"> จำนวน <?php echo $re2["pro_amount"]; ?> ชิ้น
                            </small></p>
                          <h3>ราคา <?php echo number_format($re2["pro_amount"] * $re2["price"], 2); ?> บาท</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>



              </td>
            </tr>
          <?php } ?>
      </tbody>
    </table>
    <hr>

  </div>
  <!--/.Main column-->

</div>
</div>
<!--/.Main layout-->

</main>

<?php
include("foot.php");
?>