<?php
function get_dob($dateStart,$dateEnd){
  //$dateStart="1998-3-29";//วันที่เริ่มต้นหรือวันเกิด
  //$dateEnd="2020-1-8";//วันที่สิ้นสุดหรือวันที่ปัจจับัน อาจจะใช้ date("Y-m-d");

  list($year_s, $month_s, $day_s)= explode("-",$dateStart);
  list($year_e, $month_e, $day_e)= explode("-",$dateEnd);

  //ชั่วโมง , นาที, วินาที, เดือน, วัน, ปี
  $second_s = mktime(0, 0, 0, $month_s, $day_s, $year_s);
  $second_e = mktime(0, 0, 0, $month_e, $day_e, $year_e);
  $difference = ($second_e - $second_s);//ช่วงเวลาที่ต่างกันเป็นวินาที

  $yyy=date("Y", $difference)-1970;//จำนวนปี
  $mmm=date("m",$difference)-1;//จำนวนเดือน
  $ddd=date("d",$difference)-1;//จำนวนวัน
  $DayOnly=($difference/86400);

  //echo $yyy." ปี ".$mmm." เดือน ".$ddd." วัน ";
  //echo "<br>หรือ ".($mmm+($yyy*12))." เดือน ".$ddd." วัน ";
  //echo "<br>หรือ ".($difference/86400)." วัน";
  return ([$yyy,$mmm,$ddd,$DayOnly]);
}

function changdate($dates)
	{
		$c_date=explode("-",$dates);
		$ddd=$c_date[2];//วัน
		$c_m=$c_date[1];//เดือน
		$c_y=$c_date[0];//ปี
		
		
		if($c_m=="01"){
			$mmm="มกราคม";
		}else if($c_m=="02"){
			$mmm="กุมภาพันธ์";
		}else if($c_m=="03"){
			$mmm="มีนาคม";
		}else if($c_m=="04"){
			$mmm="เมษายน";
		}else if($c_m=="05"){
			$mmm="พฤษภาคม";
		}else if($c_m=="06"){
			$mmm="มิถุนายน";
		}else if($c_m=="07"){
			$mmm="กรกฎาคม";
		}else if($c_m=="08"){
			$mmm="สิงหาคม";
		}else if($c_m=="09"){
			$mmm="กันยายน";
		}else if($c_m=="10"){
			$mmm="ตุลาคม";
		}else if($c_m=="11"){
			$mmm="พฤศจิกายน";
		}else{
			$mmm="ธันวาคม";
		}
		$yyy=$c_y+543;
		$txtdate=$ddd." ".$mmm." ".$yyy;
		return $txtdate;
	
	}
?>
