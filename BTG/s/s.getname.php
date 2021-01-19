<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
 

 $stid = oci_parse($objConnect, "SELECT 
					memb_name || '  '||
					memb_surname AS SHARE_AMT					 
				FROM 
					mbmembmaster
				WHERE
					MEMBER_NO = '$memno' 		 ");
					oci_execute($stid);

					while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
	 
						$SHARE_AMT =  $row[0]  ;                 
						}
						oci_free_statement($stid);

?>

