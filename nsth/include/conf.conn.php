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


    /*putenv("ORACLE_SID=iorcl");
    putenv("NLS_LANG=AMERICAN_AMERICA.TH8TISASCII");  
    putenv("NLS_DATE_FORMAT=DD-MM-YYYY");    

	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    
    //function connection to database Oracle	
	$IPSERVER = 'localhost';
	$SERVICEDB = 'gcoop';
	$USER = 'iscostk';
	$PASSWORD = 'iscostk';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB);                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }*/
	
	/*$objConnect = mssql_connect("172.24.8.224","sa","ExY9%Zyg");
	if($objConnect)
	{
	echo "Database Connected.";
	}
	else
	{
	echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Sqlserver ได้ กรุณาลองใหม่ภายหลัง") </script> ';
	}

	mssql_close($objConnect);*/
	
	ini_set('display_errors', 1);
	error_reporting(~0);
	$serverName = "localhost";
	//$serverName = "172.24.8.224";
	$userName = "sa";
	//$userPassword = "ExY9%Zyg";
	$userPassword = "wbz_JV7M";
	$dbName = "isconsth";
	$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);
	$objConnect = sqlsrv_connect( $serverName, $connectionInfo);
	if($objConnect)
	{
	//echo "Database Connected.";
	}
	else
	{
	echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Sqlserver ได้ กรุณาลองใหม่ภายหลัง") </script> ';
	}
	//sqlsrv_close($conn);

    /**** function connection to database MySql****/
	$dbhost="localhost";
	$dbuser = "root";
	$dbpass = "";
	$conn=@mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_query("SET character_set_results=tis620");
    	mysql_query("SET character_set_client=tis620");
   	mysql_query("SET character_set_connection=tis620");
   	$objDB = mysql_select_db("nsth");
	if (!$conn) {
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Mysql ได้ กรุณาลองใหม่ภายหลัง") </script> ';	
	}

    
?>
