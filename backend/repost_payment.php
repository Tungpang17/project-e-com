 <?php
    include("head.php");
    ?>
 <br>
 <br>
 <br>
 <br>




 <div class="container">
     <h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
     <h3>รายงานข้อมูลการชำระเงิน <button type="button" class="btn btn-light" onclick="print();" id="hid">

             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                 <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                 <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
             </svg> พิมพ์</button></h3>

             <table  class="table" cellspacing="0" width="100%">
  <thead>
    <tr>
      
      <th scope="col">ใบสั่งซื้อสินค้า</th>
      <th scope="col">ชื่อลูกค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col">วัน/เดือน/ปี/ที่สั่งซื้อ เวลา</th>
      <!-- <th scope="col">เวลา</th> -->
      
    </tr>
  </thead>
  <tbody id="tbody1">
      <?php
      $sql = "SELECT * FROM payments
LEFT JOIN orders ON orders.`order_id` = payments.`order_id`
LEFT JOIN member ON member.`m_id` = orders.`m_id`";

      $que = mysqli_query($con, $sql);
      while ($re = mysqli_fetch_assoc($que)) {

        ?>
        <tr>

          <td><?php echo $re["pay_id"]; ?></td>
          <td><?php echo $re["m_fullname"]; ?></td>
          <td><?php echo $re["money"]; ?></td>
          <td><?php echo $re["datetime"]; ?></td>
        </tr>

      <?php } ?>
    </tbody>
    <?php
    $sql="SELECT * FROM `payment.php` WHERE 1 ";

    if($_GET["date_s"] !="" && $_GET["date_e"] !=""){
        $sql.=" AND (m_datetime>='".$_GET["date_s"]."' AND m_datetime<='".$_GET["date_e"]."')";    
    }
    
    while($re=mysqli_fetch_assoc($que)){

    ?>
    
  <?php echo var_dump($re);?>
    <tr>
      
      <td><?php echo $re["order_id"];?></td>
      <td><?php echo $re["name"];?></td>
      <td><?php echo $re["money"];?></td>
      <td><?php echo $re["datetime"];?></td>
      <td><?php echo $re["pay_status"];?></td>
      
    </tr>

<?php }?>
  </tbody> 

</table>