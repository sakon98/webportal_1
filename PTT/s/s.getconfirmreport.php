<?PHP
$dbhost="localhost";
$dbuser = "root";
$dbpass = "WebServer";
$conn=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
$objDB = mysql_select_db("ptt");

$m= 0;
$raw_result = mysql_query("SELECT member_no,member_name,confirm_period,confirm_status,remark,entry_date  FROM confirmbal WHERE confirm_period = '$cfperiod' order by member_no;");while($results = mysql_fetch_array($raw_result)){
	$edate = explode("-",$results["entry_date"]);
	$edate[0] += 543;
	$cdate = explode("-",$results["confirm_period"]);
	$cdate[0] += 543;
               $membno[$m] = $results["member_no"];
               $membname[$m] = $results["member_name"];
	 $cfpr[$m] = $cdate[2] . "/".$cdate[1] . "/".$cdate[0];
	$entrydate[$m] = $edate[2] . "/".$edate[1] . "/".$edate[0];
	 $cfsts[$m] = $results["confirm_status"];
	$remark[$m] = $results["remark"];
	$m = $m+1;
         }

mysql_close($conn);
?>