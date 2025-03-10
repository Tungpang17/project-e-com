<?php
include("conf/mariadb.php");
$sql="SELECT * FROM `buy` WHERE `buy_id`='".$_GET["buy_id"]."'";

$que=mysqli_query($con,$sql);
$re_sall=mysqli_fetch_assoc($que);

?> 

<!DOCTYPE html>
<script type="text/javascript">
  print();
  setTimeout("history.back()",1000);
  //history.back();
</script>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
       
        <title>ใบสั่งซื้อ</title>
    </head>
    <body>
        <div class="ticket" style="font-size: 26px"> 
           <center><img src="img/ru.png" width="100" height="100"></center>
           <center> ร้านเอกสิงห์บุรีสปอร์ต </center>
           <center> 14/17 หมู่ 5  ตำบลต้นโพธิ์  อ.เมือง จ.สิงห์บุรี 16000 โทร 062-5398989</center>
            <p class="centered">
                   <center>ใบสั่งซื้อ</center>
                <br>เลขที่ใบเสร็จ:    <?php echo $re_sall["buy_id"];?>
                <br>วันที่:    <?php echo $re_sall["buy_date"];?></p>
          <table style="font-size: 26px" width="100%">
                <thead>
                  <tr>

                        <td colspan=""><hr></td>
                    </tr>
                    <tr>
                        <td style="width: 26px">จำนวน</td>
                        <td></td> 
                        <td></td> 
                       
                        <td style="text-align: center;">รายการ</td>
                        <td></td> 
                        <td style="text-align: right;">ราคา</td>
                    </tr>
                </thead>
                <tbody>

                  <?php
$sql="SELECT * FROM `buy_detail` 
LEFT JOIN `product` ON `buy_detail`.`product_id`=`product`.`product_id`
WHERE `buy_id`='".$_GET["buy_id"]."'";

$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

                  ?>
                    <tr>
                        <td><?php echo $re["amont"];?></td>
                        <td></td> 
                        <td></td> 
                        
                        <td style="text-align: center;"><?php echo $re["Product_name"];?></td>
                        <td><?php if($re["amont"]>1) echo "@".$re["price"];?></td>
                        <td style="text-align: right;"><?php  echo number_format($re["price"]*$re["amont"],2);?></td>
                    </tr>
                  
                  <?php } ?>
                   <tr>

                        <td colspan="4"><hr></td>
                    </tr>
                    <tr>
                        <td>รวม</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;"><?php echo number_format($re_sall["buy_price"],2);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>

