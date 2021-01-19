<?php
//@session_start();
//$member_no =$_SESSION['ses_repass']; 


    
    /**** function connection to database Oracle****/	
	$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }

	
$date_log = date("Y-m-d H:i:s");
$member_no;
 $gain =  implode($_POST['mbgain'],',');
 $gainex =  explode(',',$gain);
 $seq_no = $gainex[0];
 $prename_code = $gainex[1];
 $name = $gainex[2];
 $surname = $gainex[3];
 $address = $gainex[4];
 $relation = $gainex[5];
 $card_person = $gainex[6];
 $card_person = str_replace("-","", $card_person);
 $percent = $gainex[7];
 $appl_docno = "";
/// insert table mbreqapplgain

					
					$strSQL10 = "select document_prefix , substr(document_year,3,2) as document_year , last_documentno + 1 as  appl_docno,coop_id from cmdocumentcontrol where document_code = 'MBAPPLDOCNO'";  // คิวรี่ปั้นเลขที่ใบคำขอสมาชิก
						$objParse10 = oci_parse($objConnect, $strSQL10);
						oci_execute ($objParse10,OCI_DEFAULT);
							while($objResult10 = oci_fetch_array($objParse10,OCI_BOTH)){
                                                       // $document_prefix = $objResult10["DOCUMENT_PREFIX"]; 
                                                        $document_year = $objResult10["DOCUMENT_YEAR"];
                                                        $appl_docno = $objResult10["APPL_DOCNO"];
                                                        $coop_id = $objResult10["COOP_ID"];
                                                        
                                                        $FormatNumber = 8;  
                                                        $InputFormat =   strlen($appl_docno);
                                                        if($InputFormat < $FormatNumber){
                                                            $insertFormat = $FormatNumber - $InputFormat ;
                                                            for($i=0;$i<$insertFormat;$i++){
                                                                 $appl_docno = "0".$appl_docno;
                                                            }
                                                        }
                                                        
                                                        $appl_docno = $document_year.$appl_docno;   
                                                        
                                                        }
					
					
					
        $strSQL12 = "INSERT INTO mbreqapplgain ";
                                $strSQL12 .="(COOP_ID, APPL_DOCNO, SEQ_NO, MEMBER_NO,GAIN_NAME,GAIN_SURNAME,GAIN_ADDR,GAIN_RELATION,REMARK,WRITE_DATE,WRITE_AT,AGE,PRENAME_CODE,GAIN_PERCENT,GAINCARD_PERSON) ";
                                $strSQL12 .="VALUES ";
                                $strSQL12 .="('035001', '$appl_docno',$seq_no,'','$name','$surname','$address','$relation','','','','','$prename_code','$percent','$card_person')";  
                                $objParse12 = oci_parse($objConnect, $strSQL12);
                                $objExecute12 = oci_execute($objParse12, OCI_DEFAULT);
                                if($objExecute12)
                                {
								echo $appl_docno;
                                oci_commit($objConnect); 
								
								//oci_close($objConnect);
								
                                }
                                else
                                {
                                oci_rollback($objConnect); 
                                 "Error Save [".$strSQL12."";
                                }
                                
 
                           
?>
