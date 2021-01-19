<?PHP
$dbhost="localhost";
$dbuser = "root";
$dbpass = "WebServer";
$conn=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
$objDB = mysql_select_db("ptt");

$n= 0;
$raw_result = mysql_query("SELECT confirm_period FROM confirmbal GROUP BY  confirm_period ORDER BY confirm_period DESC;");
while($results = mysql_fetch_array($raw_result)){
               $confirmdate[$n] = $results["confirm_period"];
	$n = $n+1;
         }

mysql_close($conn);
?>