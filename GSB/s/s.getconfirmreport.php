<?PHP
$dbhost="localhost";
$dbuser = "root";
$dbpass = "WebServer";
$conn=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
$objDB = mysql_select_db("webportal");

//echo $cfperiod; exit();

$m= 0;
$raw_result = mysql_query("SELECT distinct member_no,member_name,confirm_period,confirm_status,remark,entry_date,loan,dep,shr  FROM confirmbal WHERE confirm_period = '$cfperiod' order by member_no;");

while($results = mysql_fetch_array($raw_result)){
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
	$loan[$m] = $results["loan"];
	$dep[$m] = $results["dep"];
	$shr[$m] = $results["shr"];
	$m = $m+1;

         }
		 
		 $raw_result2 = mysql_query("SELECT sum(loan) as s_loan  FROM confirmbal WHERE confirm_period = '$cfperiod' order by member_no;");
		 
		 while($results2 = mysql_fetch_array($raw_result2)){
	
	 $s_loan = $results2["s_loan"];

         }
		 
		  $raw_result3 = mysql_query("SELECT sum(dep) as s_dep  FROM confirmbal WHERE confirm_period = '$cfperiod' order by member_no;");
		 
		 while($results3 = mysql_fetch_array($raw_result3)){
	
	 $s_dep = $results3["s_dep"];

         }
		 
		 $raw_result4 = mysql_query("SELECT sum(shr) as s_shr  FROM confirmbal WHERE confirm_period = '$cfperiod' order by member_no;");
		 
		 while($results4 = mysql_fetch_array($raw_result4)){
	
	 $s_shr = $results4["s_shr"];

         }
		 

mysql_close($conn);
?>