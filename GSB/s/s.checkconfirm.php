<?PHP
header('Content-Type: text/html; charset=tis-620');


	//เริ่มเชื่อมต่อฐานข้อมูล
	$dbhost="localhost";
	$dbuser = "root";
	$dbpass = "WebServer";
	$conn=mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_query("SET character_set_results=tis620");
    	mysql_query("SET character_set_client=tis620");
   	mysql_query("SET character_set_connection=tis620");
   	$objDB = mysql_select_db("webportal");

$raw_result = mysql_query("SELECT member_no  FROM confirmbal where member_no = '".$member_no."' and confirm_period = '".$year.'-'.$month.'-'. $day."';");
$results = mysql_fetch_array($raw_result );
         
		if($results['member_no'] == ""){
			$chk_cf = true;
		}else{
			$chk_cf = false;
		}
mysql_close($conn);
?>