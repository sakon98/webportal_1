<?php
@session_start();
header('Content-Type: text/html; charset=tis-620');
?>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php
/*
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
*/

//copy this to http.conf
//SetEnv NLS_DATE_FORMAT DD-MM-YYYY
//SetEnv NLS_LANG AMERICAN_AMERICA.TH8TISASCII
//SetEnv NLS_LANG AMERICAN_AMERICA.WE8MSWIN1252	


    putenv("ORACLE_SID=gcoop");
    putenv("NLS_LANG=AMERICAN_AMERICA.TH8TISASCII");  
    putenv("NLS_DATE_FORMAT=DD-MM-YYYY");    

	//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    
    /**** function connection to database Oracle****/	
	$IPSERVER = '192.168.1.101';
	$SERVICEDB = 'gcoop';
	$USER = 'iscopth';
	$PASSWORD = 'iscopth';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB);                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	
	
function getEncryptData($data){
	GLOBAL $encrypt_mode;
	
	if(isset($encrypt_mode)&&$encrypt_mode==2){
		$strSQL="select FT_ENC('".$data."') as d from dual";
		$value = get_single_value_oci($strSQL,"D");
		return $value;
	}else{
		return md5($data);
	}
	
}

	function get_single_value_oci($strSQL,$value){  	// ถึงข้อมูล Single จาก database		
        GLOBAL $objConnect; 
        $stmt = oci_parse($objConnect, $strSQL );
        @oci_execute($stmt);
        while ($row = @oci_fetch_assoc($stmt)) {   
            return $row[$value];
        }           
    } 

    function get_value_many_oci($strSQL,$colunm=array()){     // ถึงข้อมูล Mulit จาก database
        $value=array();
        GLOBAL $objConnect;  
        $objParse = oci_parse ($objConnect, $strSQL);
        @oci_execute ($objParse,OCI_DEFAULT);
        $Num_Rows = @oci_fetch_all($objParse, $Result);       
        for($i=0;$i<$Num_Rows;$i++){
            for($j=0;$j<count($colunm);$j++){
                $value[$i][$j] =  $Result[$colunm[$j]][$i];
            }     
        }    
        return array($Num_Rows,$value);
    } 
	
	function replaceStr($in){
		$out=strtolower($in);
		$out=str_replace("arrear","_arrear_",$out);
		$out=str_replace("name","_name_",$out);
		$out=str_replace("rcv","rcv_",$out);
		$out=str_replace("coll","_guarantee_",$out);
		$out=str_replace("main","main_",$out);
		$out=str_replace("mate","mate_",$out);
		$out=str_replace("memnew","new_member_",$out);
		$out=str_replace("memold","old_member_",$out);
		$out=str_replace("dead","dead_",$out);
		$out=str_replace("shre","share",$out);
		$out=str_replace("shrlon","share_loan_",$out);
		$out=str_replace("oldexp","old_expense_",$out);
		$out=str_replace("newexp","new_expense_",$out);
		$out=str_replace("membtype","memb_type_",$out);
		$out=str_replace("membdate","memb_date_",$out);
		$out=str_replace("ln","loan_",$out);
		$out=str_replace("dp","deptosit_",$out);
		$out=str_replace("req","_request_",$out);
		$out=str_replace("trn","_transfer_",$out);
		$out=str_replace("loan","loan_",$out);
		$out=str_replace("stk","_strock",$out);
		$out=str_replace("appl","application_",$out);
		$out=str_replace("docno","document_no",$out);
		$out=str_replace("memno","memb_no_",$out);
		$out=str_replace("memtype","memb_type",$out);
		$out=str_replace("membgroup","memb_group",$out);
		$out=str_replace("mariage","marriage",$out);
		$out=str_replace("memb_","member_",$out);
		$out=str_replace("cal","calculate_",$out);
		$out=str_replace("_interest","_int",$out);
		$out=str_replace("rkeep","round_Charged",$out);
		$out=str_replace("_int","_interest_",$out);
		$out=str_replace("int_","_interest_",$out);
		$out=str_replace("_contin","_contdition_in",$out);
		$out=str_replace("chg","change_",$out);
		$out=str_replace("mth","method_",$out);
		$out=str_replace("bf","before_",$out);
		$out=str_replace("ename","english_name_",$out);
		$out=str_replace("tname","thai_name_",$out);
		$out=str_replace("mem_","member_",$out);
		$out=str_replace("_mem","_member_",$out);
		$out=str_replace("_tel","_telephone",$out);
		$out=str_replace("curr","current_",$out);
		$out=str_replace("apv"," approve",$out);
		$out=str_replace("_desc","_description",$out);
		$out=str_replace("_mb_"," _member_",$out);
		$out=str_replace("_"," ",$out);
		$out=str_replace("flag"," status",$out);
		$out=str_replace("coop"," cooperative",$out);
		$out=str_replace("value"," value",$out);
		$out=str_replace("amt"," amount",$out);
		$out=str_replace("addr"," address",$out);
		return $out;
	}
	
	$table=$_REQUEST["t"];  
	$strSQLM="select tname from tab where ( tname not like '%$%' and tname not like '%PB%'  ) and lower(tname) like lower('%".$table."%') order by tname asc";
		//echo $strSQL;
	$valueM = array('TNAME');
	list($Num_Rows_M,$list_info_M) = get_value_many_oci($strSQLM,$valueM); 
	
	$output = "<br/><hr><table border=1 cellpadding=2 cellspacing=2 >";
	echo $output."\r\n"; 
    for($i=0;$i<$Num_Rows_M;$i++){
	  $table_name=	$list_info_M[$i][0];
	  
	  $strSQLM = "SELECT column_name,data_type, data_length,DATA_PRECISION,DATA_SCALE,nullable , 
							(SELECT decode(A.CONSTRAINT_TYPE,'P','PK','') as pk FROM USER_CONSTRAINTS A, USER_CONS_COLUMNS B WHERE A.TABLE_NAME = B.TABLE_NAME AND B.TABLE_NAME = C.table_name  AND A.CONSTRAINT_NAME = B.CONSTRAINT_NAME and A.CONSTRAINT_TYPE in ('P') and c.column_name =b.column_name and rownum =1 ) as  IS_PK , 
							(SELECT decode(A.CONSTRAINT_TYPE,'R','FK','') as fk  FROM USER_CONSTRAINTS A, USER_CONS_COLUMNS B WHERE A.TABLE_NAME = B.TABLE_NAME AND B.TABLE_NAME = C.table_name  AND A.CONSTRAINT_NAME = B.CONSTRAINT_NAME and A.CONSTRAINT_TYPE in ('R') and c.column_name =b.column_name and rownum =1 ) as  IS_FK  
							, '' as cdesc 
							, '' as tdesc 
							, '' as from_system 
							, c.table_name 
							FROM USER_TAB_COLUMNS c  WHERE  lower(c.table_name) = lower('".$list_info_M[$i][0]."') order by c.table_name asc , IS_PK asc, IS_FK asc";
     
		$valueM_ = array('COLUMN_NAME','DATA_TYPE','DATA_LENGTH','DATA_PRECISION','DATA_SCALE','NULLABLE','IS_PK','IS_FK','CDESC','TDESC','FROM_SYSTEM','TABLE_NAME');
		list($Num_Rows_M_,$list_info_M_) = get_value_many_oci($strSQLM,$valueM_); 
		
		$output = "<tr><td colspan=7 style=\"background-color:gray\" >Table Name : ".$table_name."</td></tr>";
		$output.="<tr style=\"background-color:#CCCCCC\"><td>No</td><td>Column Name </td><td> Description </td><td>Data Type</td><td>IS NULL</td><td>IS PK</td><td>IS FK</td></tr>";		 
		echo $output."\r\n"; 
		
		for($j=0;$j<$Num_Rows_M_;$j++){
		  $cols_name = $list_info_M_[$j][0];
		  $data_type = $list_info_M_[$j][1];
		  $data_length = $list_info_M_[$j][2];
		  $data_pre = $list_info_M_[$j][3];
		  $data_scale = $list_info_M_[$j][4];
		  $output = "<tr><td>".($j+1) ."</td>";
		  $output.="<td>".($cols_name."")."</td><td> ";
		  echo $output."\r\n"; 
		  ?><input type="hidden" id="txtSource<?=$table_name.$j?>" value="<?=replaceStr($cols_name)?>"/>
		  <input type="text"  id="txtTarget<?=$table_name.$j?>" value="" size="40"/>
		  <script type="text/javascript">
		  $( document ).ready(function() {
            var url = "https://translation.googleapis.com/language/translate/v2?key=AIzaSyB4OP9_0jWycZjSrwD4qVXuCvzJDw3Lozo";
            url += "&source=" + "EN";
            url += "&target=" + "TH";
            url += "&q=" + escape($("#txtSource<?=$table_name.$j?>").val());
            $.get(url, function (data, status) {
                $("#txtTarget<?=$table_name.$j?>").val(data.data.translations[0].translatedText);
            });
			});
		</script>
		  <?php
		  $output = "</td><td>".$data_type;
                            if ($data_type != "DATE")
                            {
                                if ($data_type== "NUMBER")
                                {
                                    if ($data_pre != "" && $data_scale != "")
                                    {
                                        $output .= "(" .$data_pre.(($data_scale  != "0" && $data_scale  != "") ? ("," .$data_scale ) : "") . ")";
                                    }
                                    else
                                    {
                                        $output .= "(" .$data_length. ")";
                                    }
                                }
                                else
                                {
                                    $output .= "("  .$data_length. ")";
                                }
                            }
                            $output .= "</td>";
							
		  $nullable = $list_info_M_[$j][5];
		  $is_pk = $list_info_M_[$j][6];
		  $is_fk = $list_info_M_[$j][7];
		  
                            $output .= "<td>".$nullable."</td><td>".$is_pk."</td><td>".$is_fk."</td></tr>";
		
		  echo $output;
		}
		echo "<tr><td colspan=7 ><br/><br/></td></tr>"; 
	}
		echo "</table>";
   // error_reporting(E_ERROR | E_PARSE);
?>