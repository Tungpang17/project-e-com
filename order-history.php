<?php
include "head.php";
@session_start();
?>
<div class="col-lg-8">
  <h1>ประวัติกการสั่งซื้อ</h1>

  <div>
    <table class="table w-100">


      <tbody>
        <?php
        $user_id = $_SESSION['otop']['ID'];

        $query =
          "SELECT * 
      FROM orders
      LEFT JOIN `payments` ON `orders`.`order_id` = `payments`.`order_id`
      WHERE `pay_status` = 1 AND `m_id` = '$user_id'
      ORDER BY `order_date` DESC
      ";

        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td class="fw-bold">วันที่สั่งซื้อ: <?php echo $row['order_date'] . " " . $row['order_time']; ?></td>
            <td colspan="2"></td>
            <td>ราคารวม <?php echo number_format($row['order_tatal'], 2); ?></td>
          </tr>

          <?php
          $item_query =
            "SELECT `product`.*, `order_detail`.*, `propic`.`pic_url`
                FROM `order_detail`
                LEFT JOIN `product` ON `order_detail`.`product_id` = `product`.`product_id`
                LEFT JOIN `propic` ON `product`.`product_id` = `propic`.`product_id`
                WHERE `order_id` = '{$row['order_id']}'
                ";

          $result_item = mysqli_query($con, $item_query);

          while ($row_item = mysqli_fetch_assoc($result_item)) {
            ?>
            <tr>
              <td>
                <img src="backend/img/product/<?php echo $row_item['pic_url']; ?>" alt=""
                  style="width: 100px; height: 100px;">
              </td>
              <td>
                <p><?php echo $row_item['Product_name']; ?></p>
              </td>
              <td>
                <p><?php echo $row_item['pro_amount']; ?></p>
              </td>
              <td>
                <p><?php echo $row_item['price']; ?></p>
              </td>
            </tr>
          <?php } ?>

        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
include "foot.php";
?>