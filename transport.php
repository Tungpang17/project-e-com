<?php
include("head.php");
?>

<?php
$sql = "SELECT `payments`.*,transport.tra_id,transport.tra_name,transport.tra_track,transport.tra_date,transport.tra_time,transport.tra_status FROM `payments` 
LEFT JOIN `transport` ON `payments`.`order_id`=`transport`.`order_id`
WHERE `payments`.pay_status=1
-- LEFT JOIN `stock2` ON `product`.`product_id`=`stock2`.`product_id`";

// --   WHERE 1 AND `order_id`='". $_GET["order_id"]."' 

// Generate query
$result = $con->query($sql);
?>

<div class="col-lg-8">
    <table>
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>เลขพัสดุ</th>
            <th>วันที่จัดส่ง</th>
            <th>สถานะ</th>
        </tr>
    </thead>

        <tbody>
            
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row[""] ?>
                    </td>
                    <td>
                        <?php echo $row["tra_track"] ?>
                    </td>
                    <td>
                        <?php echo $row["tra_date"] ?>
                    </td>
                    <td>
                        <?php if ($row["tra_status"] == 0) {
                            echo  "อยู่ระหว่างจัดส่ง";
                        } else {
                            echo "จัดส่งแล้ว";
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
    </table>
</div>