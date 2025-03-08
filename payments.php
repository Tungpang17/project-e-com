<?php
include("head.php");
?>
<?php
$sql = "SELECT * FROM `orders` 
LEFT JOIN `payments` ON payments.order_id =orders.order_id
LEFT JOIN `order_detail` ON `orders`.`order_id`=`order_detail`.`order_id`
LEFT JOIN `product` ON `order_detail`.`product_id`=`product`.`product_id`
WHERE `payments`.pay_id IS NULL
AND `orders`.`m_id` = '".$_SESSION['otop']['ID']."'
-- LEFT JOIN `stock2` ON `product`.`product_id`=`stock2`.`product_id`";

// --   WHERE 1 AND `order_id`='". $_GET["order_id"]."' 

// Generate query
$result = $con->query($sql);

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
?>

<div class="col-lg-8">
    <table class="table">
    <thead>
        <tr>
            <th>หมายเลขคำสั่งซื้อ</th>
            <th>ราคารวม</th>
            <th>วันที่สั่งซื้อ</th>
            <th>แจ้งชำระเงิน</th>
            <th>สถานะ</th>
            
        </tr>
    </thead>

        <tbody>
            
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td>
                        <a href="payment.php?order_id=<?php echo $row['order_id']?>">    
                            <?php echo $row["order_id"] ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $row["order_tatal"] ?> บาท
                    </td>
                    <td>
                        <?php echo $row["order_date"] ?>
                        <?php echo $row["order_time"] ?>
                       
                    </td>
                    <td>
                        <a href="payment.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-success">แจ้งชำระเงิน</a>
                    </td>
                    <td>
                     <?php 
                        if ($row["payment_status"] == "paid") {
                         echo '<span class="badge bg-success">ชำระเงินแล้ว</span>';
                        } else {
                         echo '<span class="badge bg-warning">รอชำระเงิน</span>';
                    }
    ?>
                    </td>
                    
                    
                </tr>
                <?php } ?>
            </tbody>
    </table>
    </div>
<?php
include("foot.php");
?>