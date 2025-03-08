<?php
include("backend/conf/mariadb.php");
include("backend/function.php");
$sql =
  "SELECT 
  `orders`.*, 
  `member`.*
  FROM `orders` 
LEFT JOIN `payments` ON `orders`.`order_id`=`payments`.`order_id`
LEFT JOIN `member` ON `orders`.`m_id`=`member`.`m_id`
WHERE `orders`.`order_id`='" . $_GET["order_id"] . "'";

$que = mysqli_query($con, $sql);
$re_sall = mysqli_fetch_assoc($que);

?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="backend/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h2 class="page-header">
              ใบสั่งซื้อ<br>
              <img src="backend/img/ru1.png" width="85" height="85"></i>ร้านค้าสหกิจชุมชนบ้านพวนผ้ามัดหมี่
              <small class="float-right">Date: <?php echo changdate($re_sall["order_date"]); ?></small>

            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <h5>เลขที่ใบสั่งซื้อ: <?php echo $re_sall["order_id"]; ?></h5>
          </div>
          <div class="col-sm-5">
            <!-- <h5>รหัสพนักงาน: </h5>  -->
          </div>
        </div>

        <div class="row">

          <div class="col-sm-5">
            จาก
            <address style="font-size: 20">
              <strong>ร้านค้าสหกิจชุมชนบ้านพวนผ้ามัดหมี่</strong><br>
              อำเภอ บ้านหมี่ จังหวัด ลพบุรี<br>
              โทร 036-111222<br>
              Email: kanyarat221043@gmail.com

            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-5">
            ถึง
            <address style="font-size: 20">
              <strong><?php echo $re_sall["m_fullname"]; ?> <?php echo $re_sall["address"]; ?></strong><br>
            </address>
          </div>
        </div>


        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped" style="font-size: 20">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>รหัสสินค้า</th>
                  <th>รายการสินค้า</th>
                  <th>จำนวน</th>
                  <th>ราคาสินค้า</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM `order_detail` 
LEFT JOIN `product` ON `order_detail`.`product_id`=`product`.`product_id`
WHERE `order_id`='" . $_GET["order_id"] . "'";

                $que = mysqli_query($con, $sql);
                while ($re = mysqli_fetch_assoc($que)) {
                  $sum += $re["pro_amount"];
                  $sum2 += $re["price"] * $re["pro_amount"];
                  ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $re["product_id"]; ?></td>
                    <td><?php echo $re["Product_name"]; ?></td>
                    <td><?php echo $re["pro_amount"]; ?></td>
                    <td><?php echo $re["price"]; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td>ค่าขนส่ง</td>
                  <td></td>
                  <td>50 บาท</td>
                </tr>
                <tr>
                  <td colspan="5"></td>
                </tr>
                <tr>
                  <td style="border-style: hidden;" colspan="4"></td>
                </tr>
                <tr style="border-style: none none double none ;">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>จำนวนรวมสินค้า :</td>
                  <td><?php echo $sum; ?> ชิ้น</td>
                </tr>
                <tr style="border-style: none none double none ;">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>ราคารวมสุทธิ์:</td>
                  <td><?php echo $sum2 + 50; ?> บาท</td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="table-responsive">
              <center>
                <th style="width:50%">
                  <address style="font-size: 20">
                    <strong>ผู้ขาย</strong><br>
                    <br>
                    <br>
                    .............................................<br>
                    (.............................................)
                  </address>
              </center>
              </th>
              </tr>
              <button id="print-button" class="d-print-none btn btn-primary ">
                พิมพ์
              </button>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
      const printButton = document.getElementById('print-button');

      printButton.addEventListener("click", () => window.print());
    </script>
</body>

</html>