    
<?php 
$but_class[0]="btn btn-light";
$but_class[1]="btn btn-dark";
?>
<button type="button" class="<?php if(basename($_SERVER['PHP_SELF'])=='report_sales.php') { echo $but_class[1];}else{ echo $but_class[0];}?>" onclick="location.href='report_sales.php' ">ยอดขาย</button>

    <button type="button" class="<?php if(basename($_SERVER['PHP_SELF'])=='report_sales_product.php') { echo $but_class[1];}else{ echo $but_class[0];}?>" onclick="location.href='report_sales_product.php' ">ยอดขายตามรายการสินค้า</button>
    


<button type="button" class="<?php if(basename($_SERVER['PHP_SELF'])=='report_sales_analyze.php') { echo $but_class[1];}else{ echo $but_class[0];}?>" onclick="location.href='report_sales_analyze.php' ">วิเคระห์กลุ่มลูกค้า</button>
    <button type="button" class="<?php if(basename($_SERVER['PHP_SELF'])=='report_sales_bep.php') { echo $but_class[1];}else{ echo $but_class[0];}?>" onclick="location.href='report_sales_bep.php' ">จุดคุ้มทุน</button>
    <button type="button" class="<?php if(basename($_SERVER['PHP_SELF'])=='report_sales_balance.php') { echo $but_class[1];}else{ echo $but_class[0];}?>" onclick="location.href='report_sales_balance.php' ">สินค้าคงเหลือ</button>

    <button type="button" class="btn btn-danger" onclick="location.href='menu.php' ">กลับเมนูหลัก</button>