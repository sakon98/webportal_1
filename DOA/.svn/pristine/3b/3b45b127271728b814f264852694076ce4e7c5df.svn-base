<?php

$ip=$_REQUEST["ip"];
$sid=$_REQUEST["sid"];
$u=$_REQUEST["u"];
$p=$_REQUEST["pwd"];
$coop_id=$_REQUEST["coop_id"];

$f=$_REQUEST["f"];
$app=$_REQUEST["a"];

//http://localhost/DOA/Webportal/s/svc.php?ip=127.0.0.1&sid=gcoop&u=iscodoa&pwd=iscodoa&coop_id=032001&f=of_withdraw_deposit_trans&a=n_deposit&p[]=0101005551&p[]=0104016155&p[]=2018-10-24T13:23:00&p[]=WTR&p[]=DTR&p[]=100.00

//http://localhost/CORE/GCOOP/WcfService125/n_deposit.svc?singleWsdl
$svc = $app;
$port = '80';
$func = $f;
$url = 'http://127.0.0.1:'.$port.'/CORE/GCOOP/WcfService125/'.$svc.".svc";

$client = @new SoapClient($url."?singleWsdl");

if($app=="n_deposit"){
	if($f=="of_withdraw_deposit_trans"){
		try {	
				//กรณี เป็น Date ต้องเป็น Format : date("Y-m-d")."T".date("H:i:s"),		
				$parameters = array(
					'as_wspass' => "Data Source=$ip/$sid;Persist Security Info=True;User ID=$u;Password=$p;Unicode=True;coop_id=$coop_id;coop_control=$coop_id;",
					'as_src_deptaccount_no' => $_REQUEST["p"][0],
					'as_dest_deptaccount_no' => $_REQUEST["p"][1],
					'adtm_operate' => $_REQUEST["p"][2],
					'as_wslipitem_code'=>$_REQUEST["p"][3],
					'as_dslipitem_code'=>$_REQUEST["p"][4],
					'adc_amt'=>$_REQUEST["p"][5]
				);
				
			   $ret = $client->of_withdraw_deposit_trans($parameters);
			   print_r($ret);
			   //echo $ret;
		}catch(Exception $e){
			   echo $e->getMessage();
		}
	}
}
?>