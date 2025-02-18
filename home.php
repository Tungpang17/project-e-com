<?php include("backend/conf/mariadb.php"); ?>
<!--First row-->
<div class="row wow fadeIn" data-wow-delay="0.3s">
  <div class="col-lg-12">
    <!-- <div class="divider-new">
            <h2 class="h2-responsive">โปรโมชั่น</h2>
          </div> -->


    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <!--First slide-->
        <div class="carousel-item active">
          <img src="backend/img/pomotion/1.jpg" width="100%" alt="First slide">
          <div class="carousel-caption">
            <h4></h4>
            <br>
          </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
          <img src="backend/img/pomotion/4.jpg" width="100%" alt="Second slide">
          <div class="carousel-caption">
            <h4></h4>
            <br>
          </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
          <img src="backend/img/pomotion/3.jpg" width="100%" alt="Third slide">
          <div class="carousel-caption">
            <h4></h4>
            <br>
          </div>
        </div>
        <!--/Third slide-->
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
  </div>
</div>
<!--/.First row-->
<br>
<hr class="extra-margins">

<!--Second row-->
<div class="row">


  <?php

  $conditon = "AND ((pro_s < '" . date("Y-m-d H:i:s") . "' AND pro_e > '" . date("Y-m-d H:i:s") . "') OR `pro`=0) ";
  if ($_GET["type_id"] != '') {
    $conditon .= " AND `type_id` ='" . $_GET["type_id"] . "'";
  }
  $sql = "SELECT * FROM `product` WHERE 1 " . $conditon;




  if (isset($_GET["search"]) && $_GET["search"] != "") {
    $sql .= " AND `Product_name` LIKE '%" . $_GET["search"] . "%'";
  }

  if (@$_GET["com_id"] != "") {
    $sql .= " AND `com_id`='" . $_GET["com_id"] . "'";
    $sql .= " ORDER BY `product`.`Qty` ASC";
  }


  $que = mysqli_query($con, $sql);
  while ($re = mysqli_fetch_assoc($que)) {
    ?>

    <!--First columnn-->
    <div class="col-lg-4">
      <!--Card-->
      <div class="card  wow fadeIn" data-wow-delay="0.2s">

        <!--Card image-->
        <div class="view overlay hm-white-slight">
          <?php
          $sql = "SELECT * FROM `product`
RIGHT JOIN `propic` ON `product`.`product_id`=`propic`.`product_id`
WHERE 1 AND `propic`.`product_id`='" . $re["product_id"] . "'";
          $quepic = mysqli_query($con, $sql);
          $repic = mysqli_fetch_assoc($quepic);
          ?>
          <img src="/img/<?php echo $repic["pic_url"] ?>" class="img-fluid" alt="">
          <a href="#">
            <div class="mask"></div>
          </a>
        </div>
        <!--/.Card image-->

        <!--Card content-->
        <div class="card-block">
          <!--Title-->
          <h4 class="card-title"><?php echo $re["Product_name"]; ?></h4>
          <!--Text-->
          <?php
          if ($re["pro"] == 1) {
            ?>
            <span class="badge badge-danger">สิ้นค้าขายดี3อันดับยอดนิยม</span>
          <?php } ?>
          <p class="card-text"><?php echo $re["Product_detail"]; ?></p>
          <p class="card-text">คงเหลือ <?php echo $re["Qty"]; ?></p>
          <?php if(!isset($_SESSION["otop"]["ID"])): ?>
            <a href="login.php"><button type="button" class="btn btn-dark">
            เพิ่มลงตะกร้า <strong><?php echo $re["Product_Price"]; ?> บาท</strong></button></a>
          <?php else: ?>
            <a href="add_taka.php?product_id=<?php echo $re["product_id"]; ?>"><button type="button" class="btn btn-dark">
              เพิ่มลงตะกร้า <strong><?php echo $re["Product_Price"]; ?> บาท</strong></button></a>
          <?php endif; ?>
        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->
    </div>
    <!--First columnn-->
  <?php } ?>




</div>
<!--/.Second row-->