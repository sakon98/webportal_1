<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

//echo $show_share;

$strSQL = "SELECT 
						TO_CHAR(DECODE(Y.DIV_AMT,0,null,Y.DIV_AMT),'99G999G999G999D00') AS DIV_BALAMT ,
						TO_CHAR(DECODE(Y.AVG_AMT,0,null,Y.AVG_AMT),'99G999G999G999D00') AS AVG_BALAMT ,
						TO_CHAR(DECODE(Y.ETC_AMT,0,null,Y.ETC_AMT),'99G999G999G999D00') AS ETC_BALAMT ,
						TO_CHAR(DECODE((Y.DIV_AMT+Y.AVG_AMT+Y.ETC_AMT),0,null,(Y.DIV_AMT+Y.AVG_AMT+Y.ETC_AMT)),'99G999G999G999D00') AS SUMDIV,
                           Y.DIV_YEAR
					FROM 
						YRDIVMASTER Y , YRCFRATE YR
					WHERE 
						Y.MEMBER_NO = '$member_no ' 
                       AND Y.DIV_YEAR = YR.DIV_YEAR AND YR.WEBSHOW_FLAG = 1 
                       order by Y.DIV_YEAR desc";
$value=array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUMDIV','DIV_YEAR');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$DIV_BALAMT[$i]= $list_info[$i][$j++];
	$AVG_BALAMT[$i]  = $list_info[$i][$j++];
	$ETC_BALAMT[$i]= $list_info[$i][$j++];
	$SUMDIV[$i]  = $list_info[$i][$j++];
	$DIV_YEAR[$i]= $list_info[$i][$j++];
	
	$j=0;
}
?>