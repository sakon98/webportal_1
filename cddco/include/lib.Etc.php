<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

    function get_type($var){ // Check Type value
		if (is_numeric($var)) return "member";
		if (is_string($var)) return "staff";
		return "error";
	} 

    function GetFormatMember($member_no){    // จัดการ format สมาชิก
        $FormatNumber = 6;   // จำนวนหลักของสมาชิก
        $InputFormat =   strlen($member_no);
        if($InputFormat < $FormatNumber){
            $insertFormat = $FormatNumber - $InputFormat ;
            for($i=0;$i<$insertFormat;$i++){
                $member_no = "0".$member_no;
            }
        }
        return $member_no;
    }

    function GetFormatSlip($slipno){    // จัดการ format slip
		$subid1 = substr($slipno,0,2);
        $subid2 = substr($slipno,2,2);
        $subid3 = substr($slipno,4,8);
      
        $slipno = $subid1.'/'.$subid2.'-'.$subid3;
        return $slipno;
    }
    
    function GetFormatidcare($idcare){    // จัดการ format บัตรประชาชน
         $subid1 = substr($idcare,0,1);
         $subid2 = substr($idcare,1,4);
         $subid3 = substr($idcare,5,5);
         $subid4 = substr($idcare,10,2);
         $subid5 = substr($idcare,12,1);
         $idcare = $subid1.'-'.$subid2.'-'.$subid3.'-'.$subid4.'-'.$subid5;
        return $idcare;
    }                          
    
     function GetFormatDep($deptaccount_no){    // จัดการ format เลขที่บัญชี
         $subid1 = substr($deptaccount_no,0,2);
         $subid2 = substr($deptaccount_no,2,2);
         $subid3 = substr($deptaccount_no,4,6);
         $deptaccount_no = $subid1.'-'.$subid2.'-'.$subid3;
         return $deptaccount_no;
    }

    function convertthai($amount_number)       // หน่วยลงท้าย
    {
        $amount_number = number_format($amount_number, 2, ".","");
        //echo "<br/>amount = " . $amount_number . "<br/>";
        $pt = strpos($amount_number , ".");
        $number = $fraction = "";
        if ($pt === false)
            $number = $amount_number;
        else
        {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        //list($number, $fraction) = explode(".", $number);
        $ret = "";
        $baht = ReadNumber ($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = ReadNumber($fraction);
        if ($satang != "")
            $ret .=  $satang . "สตางค์";
        else
            $ret .= "ถ้วน";
        //return iconv("UTF-8", "TIS-620", $ret);
        return $ret;
    }

    function ReadNumber($number)   // แปรงตัวเลขเป็นตัวอักษร
    {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000)
        {
            $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while($number > 0)
        {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
            ((($divider == 10) && ($d == 1)) ? "" :
                ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    } 
	
	function ConvertDate($date,$type_show){
		if($date != null or $date != ""){
			$date = str_replace( '/','-', $date ); 		
			list($day,$month,$year) = split("[-]",$date);    
			$thaimonth=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			$thaishort=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			
			if($type_show == "long"){
				$year = $year+543;
				return $value = $day.' '.$thaimonth[$month*1].' '.$year;
			}else if($type_show == "short"){
				$year = $year+543;
				return $value = $day.' '.$thaishort[$month*1].' '.$year;
			}else if($type_show == "num"){
				$year = $year+543;
				return $value = $day.'/'.$month.'/'.$year;
			}
		}else{ return ""; }
	}

    function count_member($date,$type_show){ // นับจำนวนวันการเป็นสมาชิก "Show" จำนวนปี เดือน วัน / ปล่อยว่าง ส่งคืน จำนวนเดือน      
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
		list($day1,$month1,$year1) = split("[/]",$strDate1);   
		$year1 = $year1 - 543;
		$strDate1 = $day1.'-'.$month1.'-'.$year1;
		list($day2,$month2,$year2) = split("[/]",$strDate2);   
		$year2 = $year2 - 543;
		$strDate2 = $day2.'-'.$month2.'-'.$year2;
        return ((strtotime($strDate2) - strtotime($strDate1)) /  ( 60 * 60 * 24 ));  // 1 day = 60*60*24
    } 
	
	    function DateDiff_cu($strDate1,$strDate2){     // นับจำนวนวัน จาก 2 ค่า
		list($day1,$month1,$year1) = split("[-]",$strDate1);   
		$year1 = $year1 ;
		$strDate1 = $day1.'-'.$month1.'-'.$year1;
		list($day2,$month2,$year2) = split("[-]",$strDate2);   
		$year2 = $year2 ;
		$strDate2 = $day2.'-'.$month2.'-'.$year2;
        return ((strtotime($strDate2) - strtotime($strDate1)) /  ( 60 * 60 * 24 ));  // 1 day = 60*60*24
    } 
	
	
	function Show_Slip($date) {
		$fixdate = 1; // กำหนดให้แสดงทุกวันที่ xx เดือน ปี	
		$date = str_replace( '/','-', $date ); 		
		list($day,$month,$year) = split("[-]",$date); 
		
		$day = intval($day);
		
		if($day  < $fixdate){  //echo 'น้อยกว่า';
			$showslip = date('Y').''.date('m')-1;
		}else if($day  == $fixdate){ //echo 'เท่ากัน';
			$showslip = date('Y').''.date('m');
		}else if($day  > $fixdate){ //echo 'มากกว่า';
			$showslip = date('Y').''.date('m');
		}
		$y = substr($showslip,0,4);
		$m = substr($showslip,4,2);
		$showslip = ($y+543).''.$m;
		return $showslip;
		
		/*
		//echo $date;
		$fixdate = date('15-m-Y');		// กำหนดให้แสดงทุกวันที่ xx เดือน ปี	
		$arrDate1 = explode("-",$fixdate);
		$arrDate2 = explode("-",$date);
		$timStmp1 = mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]);
		$timStmp2 = mktime(0,0,0,$arrDate2[1],$arrDate2[2],$arrDate2[0]);
		
		if ($timStmp1 == $timStmp2) {
			$showslip = date('Y').''.date('m');
		} else if ($timStmp1 > $timStmp2) {
			$showslip = gmdate ("Ym", mktime (0,0,0,date('m'),date('d'),date('Y')));
		} else if ($timStmp1 < $timStmp2) {
			$showslip = date('Y').''.date('m')-1;
		}
		$y = substr($showslip,0,4);
		$m = substr($showslip,4,2);
		$showslip = ($y+543).''.$m;
	return $showslip;*/
	}
	
	function show_list($date,$value,$member){
            
              $date = date("Y-m-d");
              $year = date("Y");
              $month = date("m");
              $day = date("d");
              //$month = 02;
              //$day = 15;
              
              if($day >= 15 && $year > $year - 1 && $month >= 01){
              
              $date = $year + 543 . $month;
              
              } else if($day < 15 && $year > $year - 1 && $month == 01) {
                  
                  $date = ($year-1) + 543 . 12;
				  
              } else if($day < 15 && $year > $year - 1 && $month != 01) {
                  
                  $date = $year + 543 . ($month - 1);
              }
			  else {
             
                  $date = $year + 543 . $month;
             
              }
                      
                     

            
		$t_month=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$s_month=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			
		$strSQL1 = "SELECT 
						  	NVL( 
							  MONTHS_BETWEEN(
							  (SELECT MAX(TO_DATE(RECV_PERIOD||'01','YYYYMMDD')) FROM KPTEMPRECEIVEDET  WHERE MEMBER_NO = '$member'),
							  (SELECT MIN(TO_DATE(RECV_PERIOD||'01','YYYYMMDD')) FROM KPMASTRECEIVEDET  WHERE MEMBER_NO = '$member') )
							,1) AS DIFFSLIP
						FROM dual ";
		$value1 = ('DIFFSLIP');
		$diffslip = get_single_value_oci($strSQL1,$value1);
		if($value > $diffslip){
			 $value = $diffslip;
		}
		 $y = substr($date,0,4)-543;
		 $m = substr($date,4,2)+2;

		$d = date('d');

		if($d == 30 || $d == 31){

		$d = 29;

		}

		for($i=0;$i<$value;$i++){
  
                        
                         $showslip = gmdate ("Ym", mktime (0,0,0,date($m-1)-$i,$d,date($y)));
                        
                   
			//$showslip = gmdate ("Ym", mktime (0,0,0,date($m)-$i,date('d'),date($y)));
                    
                    
                    
                        //$showslip = gmdate ("Ym", mktime (0,0,0,date($m+1)-$i,date('d'),date($y)));
                        
                        
                        //echo $showslip;
			$slipy = substr($showslip,0,4)+543;
			$slipm = substr($showslip,4,2);
			$slip_m[$i] = $t_month[intval($slipm)].' '.$slipy;
			$slip_s[$i] = $s_month[intval($slipm)].' '.$slipy;
			$slip[$i] = $slipy.''.$slipm;
			
		 	$strSUM = "SELECT * FROM (
								SELECT 
									TO_CHAR(SUM(KTD.ITEM_PAYMENT),'99G999G999G999D00') AS SUMALL 
								FROM 
									KPTEMPRECEIVEDET KTD
								WHERE 
									KTD.MEMBER_NO = '$member' 
									AND KTD.RECV_PERIOD = '$slip[$i]'
									AND KTD.POSTING_STATUS = 0
							UNION
								SELECT 
									TO_CHAR(SUM(KMD.ITEM_PAYMENT),'99G999G999G999D00') AS SUMALL 
								FROM 
									KPMASTRECEIVEDET KMD
								WHERE 
									KMD.MEMBER_NO = '$member' 
									AND KMD.RECV_PERIOD = '$slip[$i]'
									) WHERE SUMALL IS NOT NULL ";
			$valuesum = ('SUMALL');
			$slipsum[$i]  = get_single_value_oci($strSUM,$valuesum);
		}
		return array($slip,$slip_m,$slip_s,$slipsum);
	}
	
	function show_month($date){
		$t_month=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                /* $date = date("Y-m-d");
                $year = date("Y");
               $month = date("m");
               $day = date("d");
              //$month = 02;
              //$day = 15;
              
              if($day >= 15 && $year > $year - 1 && $month >= 01){
              
               $date = $year + 543 . $month;
              
              } else if($day < 15 && $year > $year - 1 && $month == 01) {
                  
                   $date = ($year-1) + 543 . 12;
				   
              } else if($day < 15 && $year > $year - 1 && $month != 01) {
                  
                     $date = $year + 543 . ($month - 1);
				   
              } else {
				  
				   $date = $year + 543 . $month;
				  
			  }*/
			  
			  
		$m = substr($date,4,2);
	    //$m = $m + 2;
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
	
	function ConvertDate_cu($date,$type,$show){
		if($date != null or $date != ""){
			$date = str_replace( '/','-', $date ); 		
			list($day,$month,$year) = split("[-]",$date);    
			$engmonth=array("","January","February","March","April","May","June","July","August","September.","October","November","December"); 
			$thaimonth=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			$thaishort=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$number=array("","01","02","03","04","05","06","07","08","09","10","11","12"); 						
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
				}else if($show == "num1"){
					$year = $year+543;
					return $value = $day.'/'.$number[$month*1].'/'.$year;
				}else if($show == "num2"){
					$year = $year+543;
					return $value = $day.'/'.$number[$month*1].'/'.substr($year,2);
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
					return $value = $day.' '.$number[$month*1].' '.substr($year,2);
				} 
			}
		}else{ return ""; }
	}
	
	
?>
