<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
    function count_date($date,$type_show){ // นับจำนวนวันการเป็นสมาชิก "Show" จำนวนปี เดือน วัน / ปล่อยว่าง ส่งคืน จำนวนเดือน      
		$date1 = new DateTime($date);
		$date2 = new DateTime(date('d-m-Y'));
		$interval = $date1->diff($date2);
		if($type_show == "ym"){
			return  $interval->y ." ปี " .$interval->m." เดือน";
		}else if($type_show == "m"){
			return (($interval->y)*12)+($interval->m);			
		}else if($type_show == "d"){
			return (($interval->d));			
		}     
    }

    function DateDiff($strDate1,$strDate2){     // นับจำนวนวัน จาก 2 ค่า
		list($day1,$month1,$year1) = explode("-",$strDate1);   
		$year1 = $year1;
		$strDate1 = $day1.'-'.$month1.'-'.$year1;
		list($day2,$month2,$year2) = explode("-",$strDate2);   
		$year2 = $year2;
		$strDate2 = $day2.'-'.$month2.'-'.$year2;
		$str = strtotime($strDate2) - strtotime($strDate1);
        return floor($str/3600/24);
	 } 
	
	function show_month($date){
		$t_month=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$m = substr($date,4,2);
		$y = substr($date,0,4);
		return $t_month[intval($m)].' '.$y;		
	}
	
	function DateThai($strDate)	{
		if($strDate == ""){
			return null;
		}else{
			$strYear = date("Y",strtotime($strDate))+543;
			$strMonth= date("n",strtotime($strDate));
			$strDay= date("j",strtotime($strDate));
			$strHour= date("H",strtotime($strDate));
			$strMinute= date("i",strtotime($strDate));
			$strSeconds= date("s",strtotime($strDate));
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$strMonthThai=$strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		}
	}
	
	function ConvertDate($date,$type,$show){
		if($date != null or $date != ""){	
			//echo $date;
			$date = str_replace( '/','-', $date ); 	
			$getValue = explode("-",$date);    
			$day = $getValue[0];
			$month = $getValue[1];
			$year = $getValue[2];
			
			$engmonth=array("","January","February","March","April","May","June","July","August","September.","October","November","December"); 
			$thaimonth=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			$thaishort=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$number = array("","01","02","03","04","05","06","07","08","09","10","11","12"); 			
			
			//echo $day."->".$month."->".$year."->".$type."->".$show."->".$number[$month*1];
		
			if($type == "bc"){
				if($show == "th"){
					$year = $year+543;
					return $value = $day.' '.$thaimonth[$month*1].' '.$year;
				}else if($show == "th_s"){
					$year = $year+543;
					return $value = $day.' '.$thaishort[$month*1].' '.$year;
				}else if($show == "num"){
					$year = $year+543;
					return $value = $day.' '.$number[$month*1].' '.$year;
				}else if($show == "num2"){
					$year = $year+543;
					return $value = $day.'/'.$number[$month*1].'/'.$year;
				}
			}else if($type == "ad"){
				if($show == "th"){
					return $value = $day.' '.$thaimonth[$month*1].' '.$year;
				}else if($show == "th_s"){
					return $value = $day.' '.$thaishort[$month*1].' '.$year;
				}else if($show == "eng"){
					return $value = $day.' '.$engmonth[$month*1].' '.$year;
				}else if($show == "eng_s"){
					return $value = $day.' '.substr($engmonth[$month*1],3).' '.$year;		
				}else if($show == "num"){
					return $value = $day.' '.$number[$month*1].' '.$year;
				}else if($show == "num2"){
					return $value = $day.'-'.$number[$month*1].'-'.substr($year,2);
				} 
			}
		}else{ return ""; }
	}
	
		
	
?>
