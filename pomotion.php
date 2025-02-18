<?php
include("head.php");
?>
<style>



</style>

    <!--Main column-->
    <div class="col-lg-8">


    <div class="testbox">
  <h1>สินค้าขายดี</h1><hr>
     <!--Second row-->
     <div class="row">


<?php

$conditon="AND ((pro_s < '".date("Y-m-d H:i:s")."' AND pro_e > '".date("Y-m-d H:i:s")."') AND `pro`=1) ";
if($_GET["type_id"]!=''){
$conditon=" AND `type_id` ='".$_GET["type_id"]."'";
}
$sql="SELECT * FROM `product` WHERE 1 ".$conditon;




if(isset($_GET["search"]) && $_GET["search"]!=""){
	$sql.= " AND (`product_id` LIKE '%".$_GET["search"]["search"]."%'  OR `Product_name` LIKE '%".$_GET["search"]."%')";
}

if(@$_GET["com_id"]!=""){
	$sql.= " AND `com_id`='".$_GET["com_id"]."'";
	$sql.= " ORDER BY `product`.`Qty` ASC";
}


$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){
?>

        <!--First columnn-->
        <div class="col-lg-4">
          <!--Card-->
          <div class="card  wow fadeIn" data-wow-delay="0.2s">

            <!--Card image-->
            <div class="view overlay hm-white-slight">

            <?php
$sql="SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='".$re["product_id"]."'";
$quepic=mysqli_query($con,$sql);
$repic=mysqli_fetch_assoc($quepic);
?>
              <img src="backend/img/product/<?php echo $repic["pic_url"]?>" class="img-fluid" alt="">
              <a href="#">
                <div class="mask"></div>
              </a>
            </div>
            <!--/.Card image-->

            <!--Card content-->
            <div class="card-block">
              <!--Title-->
              <h4 class="card-title"><?php echo $re["Product_name"];?></h4>
              <!--Text-->
              <p class="card-text"><?php echo $re["Product_detail"];?></p>
              <a href="add_taka.php?product_id=<?php echo $re["product_id"];?>"><button type="button" class="btn btn-dark"> 
              เพิ่มลงตะกร้า <strong><?php echo $re["Product_Price"];?> บาท</strong></button></a>
             
            </div>
            <!--/.Card content-->

          </div>
          <!--/.Card-->
        </div>
        <!--First columnn-->
<?php }?>




      </div>
      <!--/.Second row-->
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

  