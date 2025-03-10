<?php
include("conf/mariadb.php");
include("function.php");
$sql="SELECT * FROM `sall` WHERE `sall_id`='".$_GET["sall_id"]."'";

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
       
        <title>ใบเสร็จรับเงิน</title>
    </head>
    <body>
        <div class="ticket" style="font-size: 8px"> 
           <center><img src="img/ru1.png" width="80" height="80"></center>
           <center> ร้านเอกสิงห์บุรีสปอร์ต 14/17 หมู่ 5  ตำบลต้นโพธิ์  อ.เมือง จ.สิงห์บุรี 16000 โทร 062-5398989</center>
            <p class="centered">
                   <center>ใบเสร็จรับเงิน/ใบกำกับภาษีอย่างย่อ</center>
                <br>เลขที่ใบเสร็จ:    <?php echo $re_sall["sall_id"];?>
                <br>วันที่:  <?php echo changdate($re_sall["sall_date"]);?></p>
          <table style="font-size: 8px" width="90%">
                <thead>
                  <tr>

                        <td colspan="4"><hr></td>
                    </tr>
                    <tr>
                        <td style="width: 11px">Q</td>
                        <td>รายการ</td>
                        <td></td>
                        <td style="text-align: right;">ราคา</td>
                    </tr>
                </thead>
                <tbody>

                  <?php
$sql="SELECT * FROM `sall_detail`
LEFT JOIN `product` ON `sall_detail`.`product_id`=`product`.`product_id`
WHERE `sall_id`='".$_GET["sall_id"]."'";

$que=mysqli_query($con,$sql);
while($re=mysqli_fetch_assoc($que)){

                  ?>
                    <tr>
                        <td><?php echo $re["amont"];?></td>
                        <td><?php echo $re["Product_name"];?></td>
                        <td><?php if($re["amont"]>1) echo "@".$re["price"];?></td>
                        <td style="text-align: right;"><?php  echo number_format($re["price"]*$re["amont"],2);?></td>
                    </tr>
                  
                  <?php } ?>
                   <tr>

                    <td colspan="4"><hr></td>
                    </tr>
                     <tr>
                        <td colspan="2">เงินสด</td>
                         <td></td>
                        <td style="text-align: right;"><?php echo $re_sall["monney"];?></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">เงินทอน</td>
                         <td></td>
                        <td style="text-align: right;"><?php echo number_format($re_sall["monney"]-$re_sall["sall_price"],2);?></td>
                    </tr>
                     <tr>
                        <td colspan="2">ไม่รวมภาษี</td>
                        <td></td>
                        
                        <td style="text-align: right;"><?php echo number_format($re_sall["sall_price"]*0.93,2);?></td>
                    </tr>
                     <tr>
                        <td colspan="2">ภาษี 7%</td>
                        <td></td>
                       
                        <td style="text-align: right;"><?php echo number_format($re_sall["sall_price"]*0.07,2);?></td>
                    </tr>
                    <tr>
                        <td colspan="2">ยอดสุทธิ</td>
                        <td></td>
                        <td style="text-align: right;"><?php echo number_format($re_sall["sall_price"],2);?></td>
                    </tr>
                   
                </tbody>
            </table>
            <br>
        </div>
    </body>
</html>

