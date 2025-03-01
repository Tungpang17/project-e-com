<?php include "head.php"; ?>

<?php
$query =
    'SELECT * FROM (
    SELECT `product`.`product_id`, `product`.`Product_name`, `product`.`Product_detail`, `product`.`Product_Price`, `propic`.`pic_url` FROM `product`
    LEFT JOIN `propic` ON `propic`.`product_id` = `product`.`product_id`
	WHERE `product`.`type_id` = "00001"
	LIMIT 1
) as A
UNION
SELECT * FROM (
    SELECT `product`.`product_id`, `product`.`Product_name`, `product`.`Product_detail`, `product`.`Product_Price`, `propic`.`pic_url` FROM `product`
    LEFT JOIN `propic` ON `propic`.`product_id` = `product`.`product_id`
	WHERE `product`.`type_id` = "00002"

    LIMIT 1
) as B
UNION
SELECT * FROM (
    SELECT `product`.`product_id`, `product`.`Product_name`, `product`.`Product_detail`, `product`.`Product_Price`, `propic`.`pic_url` FROM `product`
    LEFT JOIN `propic` ON `propic`.`product_id`  = `product`.`product_id`
	WHERE `product`.`type_id` = "00003"
    LIMIT 1
    
 ) as C;
    ';

$result = mysqli_query($con, $query);

$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
?>

<div class="col-lg-8">
    <h1>สินค้าขายดี</h1>
    <div class="row">
        <?php foreach ($rows as $row) { ?>
            <div class="d-flex flex-column align-items-center justify-content-center col">
                <img src="backend/img/product/<?php echo $row["pic_url"]; ?>" style="width: 160px; height: 160px" />

                <h2>
                    <?php echo $row["Product_name"] ?>
                </h2>

                <p>
                    <?php echo $row["Product_detail"] ?>
                </p>

                <?php if (!isset($_SESSION["otop"]["ID"])): ?>
                    <a href="login.php"><button type="button" class="btn btn-dark">
                            เพิ่มลงตะกร้า <strong><?php echo $row["Product_Price"]; ?> บาท</strong></button></a>
                <?php else: ?>
                    <a href="add_taka.php?product_id=<?php echo $row["product_id"]; ?>"><button type="button" class="btn btn-dark">
                            เพิ่มลงตะกร้า <strong><?php echo $row["Product_Price"]; ?> บาท</strong></button></a>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php include "foot.php"; ?>