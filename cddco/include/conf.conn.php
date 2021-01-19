<?php
@session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
    //putenv("ORACLE_SID=we");
    putenv("ORACLE_SID=orcl");
    putenv("NLS_LANG=AMERICAN_AMERICA.TH8TISASCII");  
    //putenv("NLS_LANG=AMERICAN_AMERICA.WE8MSWIN1252");  
    putenv("NLS_DATE_FORMAT=DD-MM-YYYY");    

    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    
    /**** function connection to database Oracle****/	
	//$IPSERVER = '192.168.1.83';
	$IPSERVER = '192.168.1.100';
	$SERVICEDB = 'orcl';
	$USER = 'scobkkpc';
	$PASSWORD = 'scobkkpc';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB);    
    
    //echo '<script type="text/javascript"> window.alert("สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ ") </script> ';
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	

    /**** function connection to database MySql****/
	$dbhost="localhost";
	$dbuser = "root";
	$dbpass = "";
	$conn=mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
   	mysql_query("SET character_set_connection=tis620");
   	$objDB = mysql_select_db("scobkkpc_new");
        
        //echo '<script type="text/javascript"> window.alert("สามารถเชื่อมต่อกับ ฐานข้อมูล Mysql ได้ ") </script> ';
        
	if (!$conn) {
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Mysql ได้ กรุณาลองใหม่ภายหลัง") </script> ';	
	}

    
?>
