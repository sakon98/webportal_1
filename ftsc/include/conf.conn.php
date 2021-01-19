<?php
@session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

//copy this to http.conf
//SetEnv NLS_DATE_FORMAT DD-MM-YYYY
//SetEnv NLS_LANG AMERICAN_AMERICA.TH8TISASCII
//SetEnv NLS_LANG AMERICAN_AMERICA.WE8MSWIN1252	


    putenv("ORACLE_SID=icoop");
    putenv("NLS_LANG=AMERICAN_AMERICA.TH8TISASCII");  
    putenv("NLS_DATE_FORMAT=DD-MM-YYYY");    

	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    
    /**** function connection to database Oracle****/	
	$IPSERVER = 'localhost';
	$SERVICEDB = 'ftsc';
	$USER = 'iscocmtftsc';
	$PASSWORD = 'iscocmtftsc';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB);                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	

    /**** function connection to database MySql****/
	$dbhost="localhost:3306";
	$dbuser = "root";
	$dbpass = "root";
	$conn=mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_query("SET character_set_results=tis620");
    	mysql_query("SET character_set_client=tis620");
   	mysql_query("SET character_set_connection=tis620");
   	$objDB = mysql_select_db("iscofcmt");
	if (!$conn) {
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Mysql ได้ กรุณาลองใหม่ภายหลัง") </script> ';	
	}

    
?>
