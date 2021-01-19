<?php
//@session_start();
//$member_no =$_SESSION['ses_repass']; 
require "../include/conf.conn.php" ;
require "../include/lib.MySql.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>Untitled Document</title>
</head>

<body>

<?php  

$date_log = date("Y-m-d H:i:s");
$member_no;
	
	
	/*$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscokeep';
	$PASSWORD = 'iscokeep';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }*/

$member_no = $_POST["member_no"];

 $appl_docno = $_POST["doc_no"]; 
	
$appl_docno = substr($appl_docno,-10); 
$card_person = $_POST["card_person"];
$card_person = str_replace("-","", $card_person);


$strSQL_sysdate = "select count(1) as check_work from hremployee where emp_status = 1 and emp_no = '$member_no' and work_date < sysdate";
	        $objParse_sysdate = oci_parse($objConnect, $strSQL_sysdate);
			oci_execute ($objParse_sysdate,OCI_DEFAULT);
			$objResult3_sysdate = oci_fetch_array($objParse_sysdate,OCI_BOTH);
			
			$sysdate = $objResult3_sysdate[0];
			
			
			if($sysdate == 1){
			
			
			
			
			$strSQL_resign = "select 
											FLOOR(MONTHS_BETWEEN(SYSDATE,resign_date)) as month_resign
											from mbmembmaster where resign_status = 1 and card_person = '$card_person' and resign_date = (select max(resign_date) from mbmembmaster where resign_status = 1 and card_person = '$card_person')";
	        $objParse_resign = oci_parse($objConnect, $strSQL_resign);
			oci_execute ($objParse_resign,OCI_DEFAULT);
			$objResult_resign = oci_fetch_array($objParse_resign,OCI_BOTH);
			
			$resign = $objResult_resign[0];
			
			if($resign > 5 || $resign  == "")  {



$strSQL9 = "SELECT last_documentno + 1 as last_documentno from cmdocumentcontrol where document_code = 'MBAPPLDOCNO'";  // คิวรี่เอาค่า last docno + 1 ไปยิงกลับ cmdocumentcontrol
						$objParse9 = oci_parse($objConnect, $strSQL9);
						oci_execute ($objParse9,OCI_DEFAULT);
							while($objResult9 = oci_fetch_array($objParse9,OCI_BOTH)){
                                                        $last_documentno = $objResult9[0]; 
                                                        }
														
						$strSQL15= "select 
											FLOOR(MONTHS_BETWEEN(SYSDATE,resign_date)) as month_resign
											from mbmembmaster where resign_status = 1 and card_person = '$card_person' and resign_date = (select max(resign_date) from mbmembmaster where resign_status = 1 and card_person = '$card_person') ";  // เช็ควันที่ลาออก
						$objParse15 = oci_parse($objConnect, $strSQL15);
						oci_execute ($objParse15,OCI_DEFAULT);
							while($objResult15 = oci_fetch_array($objParse15,OCI_BOTH)){
                                                        $month_resign = $objResult15[0]; 

                                                      
                                                        if($month_resign > 5){
															
														$c  = "1";
															
														 $month_resign_insert = "04";
														 $appltype_code = "02";
															
														}else {
															
															$c  = "2";
															
															$month_resign_insert = "01";
															$appltype_code = "01";
															
														}
                                                                                                                
                                                        }
														
														if($c != "1"){
														
														
														
														$month_resign_insert = "01";
														$appltype_code = "01";
														
														
														}
                                                        
 
 ///////////////////////////////////////////////////////////////////////////	
	
 if($appl_docno == "" || $appl_docno == null) {													
                                                        
 $strSQL10 = "select document_prefix , substr(document_year,3,2) as document_year , last_documentno as  appl_docno1,coop_id,last_documentno as last_documentno from cmdocumentcontrol where document_code = 'MBAPPLDOCNO'";  // คิวรี่ปั้นเลขที่ใบคำขอสมาชิก
						$objParse10 = oci_parse($objConnect, $strSQL10);
						oci_execute ($objParse10,OCI_DEFAULT);
							while($objResult10 = oci_fetch_array($objParse10,OCI_BOTH)){
                                                        $document_prefix = $objResult10[0]; 
                                                        $document_year = $objResult10[1];
                                                        $appl_docno1 = $objResult10[2];
														$appl_docno1 = $appl_docno1 + 1;
                                                        $coop_id = $objResult10[3];
														$last_documentno = $objResult10[4];
														$last_documentno = $last_documentno + 1;
                                                        
                                                        $FormatNumber = 8;  
                                                        $InputFormat =   strlen($appl_docno1);
                                                        if($InputFormat < $FormatNumber){
                                                            $insertFormat = $FormatNumber - $InputFormat ;
                                                            for($i=0;$i<$insertFormat;$i++){
                                                                 $appl_docno1 = "0".$appl_docno1;
                                                            }
                                                        }
                                                        
                                                        $appl_docno = $document_year.$appl_docno1;
														
		$strSQL_gain = "SELECT count(appl_docno) as y_gain from mbreqapplgain where appl_docno = '$appl_docno'"; 
		$objParse_gain = oci_parse($objConnect, $strSQL_gain);
					 oci_execute ($objParse_gain,OCI_DEFAULT);
					 while($objResult_gain = oci_fetch_array($objParse_gain,OCI_BOTH)){
                     $y_gain = $objResult_gain[0]; 
					
                     }
					 
					 if($y_gain > 0){ // delete gain อาจจะซ้ำ
						 
						 $strSQL_Delete1 = "DELETE FROM mbreqapplgain WHERE APPL_DOCNO = '$appl_docno'";  
						 $objParse_Delete1 = oci_parse($objConnect, $strSQL_Delete1);  
						 $objExecute_Delete1 = oci_execute($objParse_Delete1, OCI_DEFAULT);  
					     oci_commit($objConnect);
						 
					 }
														
                                                        }
	}else{
		
		$strSQL9 = "SELECT last_documentno as last_documentno from cmdocumentcontrol where document_code = 'MBAPPLDOCNO'";  // คิวรี่เอาค่า last docno + 1 ไปยิงกลับ cmdocumentcontrol
		$objParse9 = oci_parse($objConnect, $strSQL9);
					 oci_execute ($objParse9,OCI_DEFAULT);
					 while($objResult9 = oci_fetch_array($objParse9,OCI_BOTH)){
                     $last_documentno = $objResult9[0]; 
					 $last_documentno = $last_documentno + 1;
                     }

$appl_docno = $appl_docno;

}
														
///////////////////////////////////////////////////////////////////////////
 
$coop_id = "035001"; // coop_id ของเเต่ละไซต์งาน
$prename_code = $_POST["prename"];
$memb_name = $_POST["memb_name"];
$memb_surname = $_POST["memb_surname"];
$memb_ename = $_POST["memb_ename"];
$memb_esurname = $_POST["memb_esurname"];
$sex = $_POST["sex"];
$membgroup_code = $_POST["membgroup_code"]; 
$membgroup_code2 = $_POST["membgroup_code2"]; 
$birth_date = $_POST["birth_date"];          ////
$birth_date1 = substr($birth_date, 0, 2);
$birth_date2 = substr($birth_date, 3, 2);
$birth_date3 = substr($birth_date, 6, 4);
$birth_date3 =  $birth_date3 - 543;
$birth_date = $birth_date3 . "-".$birth_date2."-".$birth_date1;
if($birth_date == "-543--"){

 $birth_date = "''";	
	
}else{
	
	$birth_date ;//= "to_date('$birth_date','yyyy-mm-dd')";
	
}

$nationality = $_POST["nationality"];
$memb_addr = $_POST["memb_addr"];
$addr_group = $_POST["addr_group"];
$soi = $_POST["soi"];
$mooban = $_POST["mooban"];
$road = $_POST["road"];
$province_code = $_POST["province_code"];
$district_code = $_POST["district_code"];
$tambol_code = $_POST["tambol_code"];
$postcode = $_POST["postcode"];
$email_address = $_POST["email_address"];
$mem_tel = $_POST["mem_tel"];
$mem_telmobile = $_POST["mem_telmobile"];

$curraddr_no = $_POST["curraddr_no"];
$curraddr_moo = $_POST["curraddr_moo"];
$curraddr_soi = $_POST["curraddr_soi"];
$curraddr_village = $_POST["curraddr_village"];
$curraddr_road = $_POST["curraddr_road"];
$currtambol_code = $_POST["currtambol_code"];
$curramphur_code = $_POST["curramphur_code"];
$currprovince_code = $_POST["currprovince_code"];
$curraddr_postcode = $_POST["curraddr_postcode"];

$position_code = $_POST["position_code"];
$level_code = $_POST["level_code"];

$salary_amount = $_POST["salary_amount"];

$salary_amount = str_replace(",","",$salary_amount);
$salary_amount = str_replace(".00","",$salary_amount); 


$strSQL19 = "select TO_CHAR(DECODE((s.minshare_amt * sh.unitshare_value),0,null,(s.minshare_amt * sh.unitshare_value)),'99G999G999G999D00') as periodbase_value from shsharetypemthrate s , shsharetype sh 
where s.sharetype_code = sh.sharetype_code and $salary_amount between start_salary and end_salary";  // คิวรี่เอาค่า last docno + 1 ไปยิงกลับ cmdocumentcontrol
						$objParse19 = oci_parse($objConnect, $strSQL19);
						oci_execute ($objParse19,OCI_DEFAULT);
							while($objResult19 = oci_fetch_array($objParse19,OCI_BOTH)){
                                                        $periodbase_value = $objResult19[0]; 
                                                        }

$work_date = $_POST["work_date"];            ////
$work_date1 = substr($work_date, 0, 2);
$work_date2 = substr($work_date, 3, 2);
$work_date3 = substr($work_date, 6, 4);
$work_date3 =  $work_date3 - 543;
$work_date = $work_date3 . "-".$work_date2."-".$work_date1;

if($work_date == "-543--"){

 $work_date = "''";	
	
}else{
	
	$work_date ;//= "to_date('$work_date','yyyy-mm-dd')";
	
}

$work_date_str = $_POST["work_str_date"];  
$work_date_str1 = substr($work_date_str, 0, 2);
$work_date_str2 = substr($work_date_str, 3, 2);
$work_date_str3 = substr($work_date_str, 6, 4);
$work_date_str3 =  $work_date_str3 - 543;
$work_date_str = $work_date_str3 . "-".$work_date_str2."-".$work_date_str1;

if($work_date_str == "-543--"){

 $work_date_str = "''";	
	
}else{
	
	$work_date_str ;
	
}


$periodshare_value = $_POST["periodshare_value"];

$periodshare_value = str_replace(",","",$periodshare_value);
$periodshare_value = str_replace(".00","",$periodshare_value);

$periodbase_value = str_replace(",","",$periodbase_value);
$periodbase_value = str_replace(".00","",$periodbase_value);

$refer_name = $_POST["refer_name"];
$concern_code = $_POST["concern_code"];
//$refer_name_addr = $_POST["refer_name_addr"];
$refer_name_tel = $_POST["refer_name_tel"];
$expense_bank = $_POST["expense_bank"];
$expense_branch = $_POST["expense_branch"];
$expense_accid = $_POST["expense_accid"];
$referaddr_no = $_POST["referaddr_no"];
$referaddr_moo = $_POST["referaddr_moo"];
$referaddr_soi = $_POST["referaddr_soi"];
$referaddr_village = $_POST["referaddr_village"];
$referaddr_road = $_POST["referaddr_road"];
$referprovince_code = $_POST["referprovince_code"];
$referamphur_code = $_POST["referamphur_code"];
$refertambol_code = $_POST["refertambol_code"];
$referaddr_postcode = $_POST["referaddr_postcode"];
$position_work = $_POST["position_work"];
$date_now = date("Y-m-d");        ///


//exit();

$chech1 = "";


/// insert table mbreqappl
                                
        $strSQL13 = "INSERT INTO mbreqappl ";
                                $strSQL13 .="(COOP_ID ,APPL_DOCNO , APPLTYPE_CODE , APPLY_DATE , PRENAME_CODE , MEMB_NAME , MEMB_SURNAME , MEMB_ENAME , MEMB_ESURNAME ,MEMBGROUP_CODE , 
                                              BIRTH_DATE ,SEX , MARIAGE , MEMB_ADDR ,  ADDR_GROUP , SOI ,MOOBAN , ROAD , TAMBOL_CODE , DISTRICT_CODE , PROVINCE_CODE , POSTCODE , MEM_TEL ,
                                              MEM_TELMOBILE , EMAIL_ADDRESS , CURRADDR_NO , CURRADDR_MOO , CURRADDR_SOI , CURRADDR_VILLAGE ,CURRADDR_ROAD , CURRTAMBOL_CODE , CURRAMPHUR_CODE ,
                                              CURRPROVINCE_CODE , CURRADDR_POSTCODE , CURRADDR_PHONE , MEMREF_FLAG , CARD_PERSON , WORK_DATE , RETRY_DATE , DEPARTMENT_CODE , POSITION_CODE ,
                                              POSITION_DESC , LEVEL_CODE , SALARY_ID ,SALARY_AMOUNT , REMARK , DATE_RESIGN , OLD_MEMBER_NO , MEMBER_REF , APPL_STATUS , 
                                              ENTRY_ID , ENTRY_DATE , ENTRY_BYCOOPID , APPROVE_ID , APPROVE_DATE , MEMNOFIX_FLAG , MEMBER_NO , MEMBER_TYPE , MEMBTYPE_CODE ,EMP_TYPE , 
                                              MEM_TELWORK , MEMBDATEFIX_FLAG  ,  MEMBDATEFIX_DATE ,LNDROPGRANTEE_FLAG ,NATIONALITY , FATHER_NAME , MATHER_NAME , INCOMEETC_AMT , MATE_NAME ,
                                              MATE_CARDPERSON , MATE_SALARYID , MATEADDR_NO , MATEADDR_MOO , MATEADDR_VILLAGE , MATEADDR_SOI , MATEADDR_ROAD , MATETAMBOL_CODE , 
                                              MATEAMPHUR_CODE , MATEPROVINCE_CODE , MATEADDR_POSTCODE , MATEADDR_PHONE , EXPENSE_CODE , EXPENSE_BANK , EXPENSE_BRANCH , EXPENSE_ACCID , 
                                              PERIODSHARE_VALUE , PERIODBASE_VALUE , TAMBOL_DESC ,REMEMB_FLAG  , CURRENT_COOPID , RCV_SHAREVALUE , RCVSHARE_DATE , refer_name , refer_relation, 
                                              referaddr_phone,referaddr_no,referaddr_moo,referaddr_soi,referaddr_village,referaddr_road,referprovince_code,referamphur_code,refertambol_code,
                                              referaddr_postcode) ";
                                $strSQL13 .="VALUES ";
                                $strSQL13 .="('$coop_id','$appl_docno','$appltype_code',to_date('".$date_now."','yyyy-mm-dd'),'$prename_code','$memb_name','$memb_surname','$memb_ename','$memb_esurname','$membgroup_code2',to_date('".$birth_date."','yyyy-mm-dd'),'$sex',''"
                                          . ",'$memb_addr','$addr_group','$soi','$mooban','$road','$tambol_code','$district_code','$province_code','$postcode','$mem_tel','$mem_telmobile','$email_address','$curraddr_no','$curraddr_moo','$curraddr_soi','$curraddr_village','$curraddr_road','$currtambol_code','$curramphur_code','$currprovince_code','$curraddr_postcode','','0',"
                                          . "'$card_person',to_date('".$work_date."','yyyy-mm-dd'),'','','$position_code','','$level_code','$member_no',$salary_amount,'$position_work','','','','8','user',to_date('".$date_now."','yyyy-mm-dd'),'$coop_id','','','0','','1','$month_resign_insert',"
                                          . "'','','0','','1','$nationality','','',0,'','','','','','','','','','','','','','CBT','$expense_bank',
                                              '$expense_branch','$expense_accid',$periodshare_value,$periodbase_value,'','0','','','','$refer_name','$concern_code','$refer_name_tel','$referaddr_no','$referaddr_moo','$referaddr_soi','$referaddr_village','$referaddr_road','$referprovince_code','$referamphur_code','$refertambol_code','$referaddr_postcode')";  
											  
										 
											  
                                $objParse13 = oci_parse($objConnect, $strSQL13);
                                $objExecute13 = oci_execute($objParse13, OCI_DEFAULT);
                                if($objExecute13)
                                {
                                oci_commit($objConnect); 
                                
                                 $chech3 = "1";
                                
                                }
                                else
                                {
                                oci_rollback($objConnect); 
                                 "Error Save [".$strSQL13."";  //exit();
                                }
								
								//exit();
								
                                //oci_close($objConnect);  


/// insert table mbreqapplmoneytr

$strSQL11 = "INSERT INTO mbreqapplmoneytr ";
                                $strSQL11 .="(COOP_ID, APPL_DOCNO, TRTYPE_CODE, MONEYTYPE_CODE,BANK_CODE,BANK_BRANCH,BANK_ACCID) ";
                                $strSQL11 .="VALUES ";
                                $strSQL11 .="('$coop_id', '$appl_docno', 'KEEP1','SAL','$expense_bank','$expense_branch','$expense_accid')";  
                                $objParse11 = oci_parse($objConnect, $strSQL11);
                                $objExecute11 = oci_execute($objParse11, OCI_DEFAULT);
                                if($objExecute11)
                                {
                                oci_commit($objConnect); 
                                $chech1 = "1";
                                }
                                else
                                {
                                oci_rollback($objConnect); 
                                 "Error Save [".$strSQL."";
                                }
                               // oci_close($objConnect);
                                
                                
/// insert table mbreqapplgain
                                
        /*$strSQL12 = "INSERT INTO mbreqapplgain ";
                                $strSQL12 .="(COOP_ID, APPL_DOCNO, SEQ_NO, MEMBER_NO,GAIN_NAME,GAIN_SURNAME,GAIN_ADDR,GAIN_RELATION,REMARK,WRITE_DATE,WRITE_AT,AGE,PRENAME_CODE,GAIN_PERCENT) ";
                                $strSQL12 .="VALUES ";
                                $strSQL12 .="('$coop_id', '$appl_docno', 1,'','','','','','','','','','',0)";  
                                $objParse12 = oci_parse($objConnect, $strSQL12);
                                $objExecute12 = oci_execute($objParse12, OCI_DEFAULT);
                                if($objExecute12)
                                {
                                oci_commit($objConnect); 
                                 $chech2 = "1";
                                }
                                else
                                {
                                oci_rollback($objConnect); 
                                echo "Error Save [".$strSQL."";
                                }*/
                               // oci_close($objConnect);                        
  
  echo $chech1 ; echo '<br>';
  echo $chech3 ;
  
                              if($chech1 == "1" && $chech3 == "1"){
                                    
                                     $strSQL14 = "UPDATE cmdocumentcontrol SET ";
                                        $strSQL14 .="last_documentno = $last_documentno ";
                                        $strSQL14 .="WHERE document_code = 'MBAPPLDOCNO'";
                                        
                                        $objParse14 = oci_parse($objConnect, $strSQL14);
                                        $objExecute14 = oci_execute($objParse14, OCI_DEFAULT);
                                        if($objExecute14)
                                        {
                                        oci_commit($objConnect); 
                                        }
                                        else
                                        {
                                        oci_rollback($objConnect); 
                                       // echo "Error Save [".$strSQL."";
                                        }
                                        oci_close($objConnect);
                                    
                                     echo '<script type="text/javascript"> window.alert("บันทึกสำเร็จ กรุณาปริ้นใบสมัครในขั้นตอนต่อไป") </script> ';
			                         echo "<script>window.location = 'print_register.php?appl_docno=" . $appl_docno . "'</script>";
			                         exit;
                                    
                                    
                                }else{
									
									
								$strSQL_Delete = "DELETE FROM mbreqappl WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete = oci_parse($objConnect, $strSQL_Delete);  
									$objExecute_Delete = oci_execute($objParse_Delete, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete1 = "DELETE FROM mbreqapplgain WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete1 = oci_parse($objConnect, $strSQL_Delete1);  
									$objExecute_Delete1 = oci_execute($objParse_Delete1, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete2 = "DELETE FROM mbreqapplmoneytr WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete2 = oci_parse($objConnect, $strSQL_Delete2);  
									$objExecute_Delete2 = oci_execute($objParse_Delete2, OCI_DEFAULT);  
									oci_commit($objConnect);

                                    echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาทำรายการใหม่อีกครั้ง") </script> ';
                                    echo "<script>window.location = 'index.php'</script>";
			            exit;
                                    
		                   }
		
		
		}else{
		
		$strSQL_Delete = "DELETE FROM mbreqappl WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete = oci_parse($objConnect, $strSQL_Delete);  
									$objExecute_Delete = oci_execute($objParse_Delete, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete1 = "DELETE FROM mbreqapplgain WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete1 = oci_parse($objConnect, $strSQL_Delete1);  
									$objExecute_Delete1 = oci_execute($objParse_Delete1, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete2 = "DELETE FROM mbreqapplmoneytr WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete2 = oci_parse($objConnect, $strSQL_Delete2);  
									$objExecute_Delete2 = oci_execute($objParse_Delete2, OCI_DEFAULT);  
									oci_commit($objConnect);
		
		                            echo '<script type="text/javascript"> window.alert("ไม่สามารถบันทึกข้อมูลได้ เนื่องจากลาออกไม่ครบ 6 เดือน") </script> ';
                                    echo "<script>window.location = 'index.php'</script>";
			                        exit;
		
		}
		
		}
		
		else{
		
		$strSQL_Delete = "DELETE FROM mbreqappl WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete = oci_parse($objConnect, $strSQL_Delete);  
									$objExecute_Delete = oci_execute($objParse_Delete, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete1 = "DELETE FROM mbreqapplgain WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete1 = oci_parse($objConnect, $strSQL_Delete1);  
									$objExecute_Delete1 = oci_execute($objParse_Delete1, OCI_DEFAULT);  
									oci_commit($objConnect);
									
								$strSQL_Delete2 = "DELETE FROM mbreqapplmoneytr WHERE APPL_DOCNO = '$appl_docno'";  
									$objParse_Delete2 = oci_parse($objConnect, $strSQL_Delete2);  
									$objExecute_Delete2 = oci_execute($objParse_Delete2, OCI_DEFAULT);  
									oci_commit($objConnect);
		
		                            echo '<script type="text/javascript"> window.alert("ไม่สามารถบันทึกข้อมูลได้ เนื่องจากอายุงานไม่ครบ 120 วัน") </script> ';
                                    echo "<script>window.location = 'index.php'</script>";
			                        exit;
		
		}
                           
?>

</body>
</html>