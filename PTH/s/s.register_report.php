<?php
@header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/lib.MySql.php";
require "../include/lib.Oracle.php";

function insert_value_sql_IGNORE($table,$condition,$value){   // insert ลงตาราง  Mysql     
        $strSQL = "INSERT IGNORE INTO $table $condition VALUES $value";
        $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
        return $objQuery;     
    }
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MB.MEMBER_NO,
						MP.PRENAME_DESC || MB.MEMB_NAME || ' ' || MB.MEMB_SURNAME AS FULLNAME,
						MB.CARD_PERSON,
						MB.RESIGN_STATUS,
						MB.MEMBER_STATUS,
						(CASE WHEN MB.ADDR_MOBILEPHONE IS NULL OR MB.ADDR_MOBILEPHONE = '' THEN MB.ADDR_PHONE ELSE MB.ADDR_MOBILEPHONE END) AS MOBILEPHONE
					FROM MBMEMBMASTER MB,
						MBUCFPRENAME MP
					WHERE MB.PRENAME_CODE = MP.PRENAME_CODE
						AND MB.RESIGN_STATUS = 0
						AND MEMBER_NO <> '00000000'
					ORDER BY MB.MEMBER_NO";
	$value=array('MEMBER_NO','FULLNAME','CARD_PERSON','RESIGN_STATUS','MEMBER_STATUS','MOBILEPHONE');
	list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){
		$MEMBER_NO[$i]			= $list_info[$i][$j++];  
		$FULLNAME[$i]  				= $list_info[$i][$j++];
		$CARD_PERSON[$i]			= $list_info[$i][$j++];
		$RESIGN_STATUS[$i]  	= $list_info[$i][$j++];
		$MEMBER_STATUS[$i]  	= $list_info[$i][$j++];
		$MOBILEPHONE[$i]  		= $list_info[$i][$j++];
		$j=0;
	}
	
	for($i=0;$i<$Num_Rows;$i++){
	$table = "MBMEMBMASTER_ORACLE";
	$condition = "WHERE MEMBER_NO = '$MEMBER_NO[$i]' ";
	$value  = "MEMBER_NO = '$MEMBER_NO[$i]',
					CARD_PERSON = '$CARD_PERSON[$i]',
					RESIGN_STATUS = '$RESIGN_STATUS[$i]',
					MEMBER_STATUS = '$MEMBER_STATUS[$i]',
					MEMB_FULLNAME = '$FULLNAME[$i]',
					PHONE = '$MOBILEPHONE[$i]' ";
	update_value_sql($table,$condition,$value);
	
	$table = "MBMEMBMASTER_ORACLE";
	$condition = "(MEMBER_NO,CARD_PERSON,RESIGN_STATUS,MEMBER_STATUS,MEMB_FULLNAME,PHONE)";
	$value  = "('$MEMBER_NO[$i]','$CARD_PERSON[$i]','$RESIGN_STATUS[$i]','$MEMBER_STATUS[$i]','$FULLNAME[$i]','$MOBILEPHONE[$i]')";
	insert_value_sql_IGNORE($table,$condition,$value);
	}
?>