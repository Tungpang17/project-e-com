<?php

//============ Start Session และทำการเรียก Function ติดต่อฐานข้อมูล 
require_once('../connect/connect.php');
require_once('../connect/function.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>วิเคราะห์ยอดขายร้าน</title>
  </head>
  <body>
<div class="container">
    <?php
    //นำเข้า เมนูด้านบน
    include("report_menu.php");
    ?>

      
      <!--<div class="row">
        <div class="col-md-12">
            <br>
          <select class="form-control form-control-lg">
            <option>รายสัปดาห์</option>
            <option>รายเดือน</option>
            <option>รายปี</option>
          </select>
            <br>
        </div>-->
          
        <div class="col-md-12">
          <table class="table table-hover">
  <thead>
    <tr  style="text-align:center">
      <th scope="col">ลำดับที่</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ทุนสินค้า(ต่อชิ้น)</th>
      <th scope="col">ราคาขาย(ต่อชิ้น)</th>
      <th scope="col">จำนวนชิ้น</th>
      <th scope="col">จุดคุ้มทุน</th>
    </tr>
  </thead>
  <tbody>
      
            <?php 
      $sql='SELECT * FROM `product`';
      $que=mysql_query($sql);
      while($re=mysql_fetch_assoc($que)){
      ?>
    <tr>
      <td scope="row" style="text-align:right"><?php echo $re["ProductID"];?></td>
      <td style="text-align:right"><?php echo $re["ProductName"];?></td>
      <td style="text-align:right"><?php echo $re["cap_price"];?></td>
      <td style="text-align:right"><?php echo $re["Price"];?></td>
    <td style="text-align:right"><?php echo $re["Stock"];?></td>
      <td style="text-align:right"><?php echo ceil($re["Stock"]*$re["cap_price"]/$re["Price"])." ชื้น"; ?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>