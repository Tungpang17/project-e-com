<?php

//============ Start Session และทำการเรียก Function ติดต่อฐานข้อมูล 
require_once('../connect/connect.php');
require_once('../connect/function.php');

$type=1;
if(isset($_GET["type"])) $type=$_GET["type"];

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

      
      <div class="row">
        <div class="col-md-12">
            <br>
            <form method="get">
          <select class="form-control form-control-lg" name="type" onchange="submit();">
            <option value="1">รายสัปดาห์</option>
            <option value="2" <?php if($type==2) echo "selected";?> >รายเดือน</option>
            <option value="3" <?php if($type==3) echo "selected";?>>รายปี</option>
          </select>
           </form>
            <br>
        </div>
          
        <div class="col-md-12">
          <?php
    if($type==1){
        

        $title_chart="สัปดาห์";
        
      //หาค่าเริ่มต้น และสิ้นสุดของวันที่
      $sql='SELECT  MIN(`Date`) AS date_min, MAX(`Date`) AS date_max  FROM `cusorder` WHERE 1';
      $que=mysql_query($sql);
      $re=mysql_fetch_assoc($que);    
       $date_min=$re["date_min"];
       $date_max=$re["date_max"];
        
          
          
      $sql='SELECT * FROM `category`';
      $que=mysql_query($sql);
        @$data_chart.="['".$title_chart."'";
          while($re=mysql_fetch_assoc($que)){
              @$num++;
             @$data_chart.=", '".$re["CategoryName"]."'";
             $CatId[$num]=$re["CatID"];
          }
        @$data_chart.="]";
        
        
        while($date_min<=$date_max){
            
             
        
           
            @$data_chart.=",['".@++$week."'";
            
                    for($i=1;$i<=$num;$i++){
                    $re2="SELECT * ,sum((`d1`.`Quanlity`*`d3`.`Price`) ) AS `sum_price` FROM `order_detail` AS `d1` LEFT JOIN `cusorder` AS `d2` ON `d1`.`OrderNo`=`d2`.`OrderNo` LEFT JOIN `product` AS `d3` ON `d1`.`ProductID`=`d3`.`ProductID` WHERE `d2`.`Date` BETWEEN '".$date_min."' AND '".add_date($date_min,6,0,0)."' AND `d3`.`CatID`='".$CatId[$i]."' GROUP BY `d3`.`CatID`";
                        
                    $que2=mysql_query($re2);
                    $re2=mysql_fetch_array($que2);
                        @$data_chart.=",".number_format($re2["sum_price"],0,",","");
                    }
            @$data_chart.="]";
            
            $date_min=add_date($date_min,7,0,0);
        }
    }elseif($type==2){
        $title_chart="เดือน";
        
      //หาค่าเริ่มต้น และสิ้นสุดของวันที่
      $sql='SELECT  MIN(`Date`) AS date_min, MAX(`Date`) AS date_max  FROM `cusorder` WHERE 1';
      $que=mysql_query($sql);
      $re=mysql_fetch_assoc($que);    
       $date_min=$re["date_min"];
       $date_max=$re["date_max"];
        
          
          
      $sql='SELECT * FROM `category`';
      $que=mysql_query($sql);
        @$data_chart.="['".$title_chart."'";
          while($re=mysql_fetch_assoc($que)){
              @$num++;
             @$data_chart.=", '".$re["CategoryName"]."'";
             $CatId[$num]=$re["CatID"];
          }
        @$data_chart.="]";
        
        
        while($date_min<=$date_max){
            
             
            $date_array = explode("-", $date_min);
            $like_date=$date_array[0]."-".$date_array[1]."";
           
            @$data_chart.=",['".$like_date."'";
            
                    for($i=1;$i<=$num;$i++){
                    $re2="SELECT * ,sum((`d1`.`Quanlity`*`d3`.`Price`) ) AS `sum_price` FROM `order_detail` AS `d1` LEFT JOIN `cusorder` AS `d2` ON `d1`.`OrderNo`=`d2`.`OrderNo` LEFT JOIN `product` AS `d3` ON `d1`.`ProductID`=`d3`.`ProductID` WHERE `d2`.`Date` LIKE '".$like_date."-%' AND `d3`.`CatID`='".$CatId[$i]."' GROUP BY DATE_FORMAT(`d2`.`Date`, '-%m-%y') , `d3`.`CatID`";
                        
                    $que2=mysql_query($re2);
                    $re2=mysql_fetch_array($que2);
                        @$data_chart.=",".number_format($re2["sum_price"],0,",","");
                    }
            @$data_chart.="]";
            
            $date_min=add_date($date_min,0,1,0);
        }
        
        
        
        

        
    }elseif($type==3){

        $title_chart="เดือน";
        
      //หาค่าเริ่มต้น และสิ้นสุดของวันที่
      $sql='SELECT  MIN(`Date`) AS date_min, MAX(`Date`) AS date_max  FROM `cusorder` WHERE 1';
      $que=mysql_query($sql);
      $re=mysql_fetch_assoc($que);    
       $date_min=$re["date_min"];
       $date_max=$re["date_max"];
        
          
          
      $sql='SELECT * FROM `category`';
      $que=mysql_query($sql);
        @$data_chart.="['".$title_chart."'";
          while($re=mysql_fetch_assoc($que)){
              @$num++;
             @$data_chart.=", '".$re["CategoryName"]."'";
             $CatId[$num]=$re["CatID"];
          }
        @$data_chart.="]";
        
        
        while($date_min<=$date_max){
            
             
            $date_array = explode("-", $date_min);
            $like_date=$date_array[0];
           
            @$data_chart.=",['".$like_date."'";
            
                    for($i=1;$i<=$num;$i++){
                    $re2="SELECT * ,sum((`d1`.`Quanlity`*`d3`.`Price`) ) AS `sum_price` FROM `order_detail` AS `d1` LEFT JOIN `cusorder` AS `d2` ON `d1`.`OrderNo`=`d2`.`OrderNo` LEFT JOIN `product` AS `d3` ON `d1`.`ProductID`=`d3`.`ProductID` WHERE `d2`.`Date` LIKE '".$like_date."-%' AND `d3`.`CatID`='".$CatId[$i]."' GROUP BY DATE_FORMAT(`d2`.`Date`, '-%y') , `d3`.`CatID`";
                        
                    $que2=mysql_query($re2);
                    $re2=mysql_fetch_array($que2);
                        @$data_chart.=",".number_format($re2["sum_price"],0,",","");
                    }
            @$data_chart.="]";
            
            $date_min=add_date($date_min,0,0,1);
        }
        
        
        
        

        
    
    }
    
?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php echo $data_chart;?>
            
        ]);

        var options = {
          title: 'แผนภูมิยอดขายตามรายการสินค้า',
          vAxis: {title: 'ยอดขาย'},
          hAxis: {title: '<?php echo $title_chart;?>',  titleTextStyle: {color: '#333'}},
          
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>

        </div>
      </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>