<?php
session_start();
//@header('Content-Type: application/json; charset=utf-8' );
//require "include/conf.c.php";
//require "include/conf.d.php" 
//require "include/conf.conn.php";
//require "include/lib.Etc.php";
//require "include/lib.MySql.php";
//require "include/lib.Oracle.php";
$connectby = "desktop";
$out="{\"Data\":[".
				"{".
					"\"coop_id\":\"500001\",".
					"\"coop_name\":\"สค.คลองจั่น จำกัด\",".
					"\"coop_url\":\"http://web.coopsiam.com/CUKJ/Webportal/w/\",".
					"\"coop_logo\":\"http://web.coopsiam.com/CUKJ/Webportal/img/ic_launcher.png\"".
				"}".
			",".
				"{".
					"\"coop_id\":\"013001\",".
					"\"coop_name\":\"สอ.ธนาคารออมสิน จำกัด\",".
					"\"coop_url\":\"http://182.52.226.144/webportal/w/\",".
					"\"coop_logo\":\"http://182.52.226.144/webportal/img/ic_launcher.png\"".
				"}".
			",".
				"{".
					"\"coop_id\":\"003001\",".
					"\"coop_name\":\"สอ.ครูแม่ฮ่องสอน จำกัด\",".
					"\"coop_url\":\"http://122.154.237.21:90/MHS/w/\",".
					"\"coop_logo\":\"http://122.154.237.21:90/MHS/img/ic_launcher.png\"".
				"}".
			"]".
	 "}";
//echo $out;	 
/*
$arr[]=array(	'coop_id'=>'013001',
				'coop_name'=>'สอ.ธนาคารออมสิน จำกัด',
				'coop_url'=>'http://182.52.226.144/webportal/w/',
				'coop_logo'=>'http://182.52.226.144/webportal/img/ic_launcher.png');
*/
/*
$arr[]=array(	'coop_id'=>'032001',
				'coop_name'=>'สอ.กรมวิชาการเกษตร จำกัด',
				'coop_url'=>'http://web.coopsiam.com/Webportal/DOA/w/',
				'coop_logo'=>'http://web.coopsiam.com/Webportal/DOA/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'003001',
				'coop_name'=>'สอ.ครูแม่ฮ่องสอน จำกัด',
				'coop_url'=>'http://122.154.237.21:90/MHS/w/',
				'coop_logo'=>'http://122.154.237.21:90/MHS/img/logo.png');
$arr[]=array(	'coop_id'=>'009001',
				'coop_name'=>'สค.ไทยฮอนด้า จำกัด',
				'coop_url'=>'http://110.77.137.118:81/webportal/w/',
				'coop_logo'=>'http://110.77.137.118:81/webportal/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'026001',
				'coop_name'=>'สอ.ครูสารคาม จำกัด',
				'coop_url'=>'http://182.52.57.68:81/webportal/w/',
				'coop_logo'=>'http://182.52.57.68:81/webportal/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'000301',
				'coop_name'=>'สหกรณ์การเกษตรนาหมื่น จำกัด',
				'coop_url'=>'http://101.109.83.178:90/IEXT/w/',
				'coop_logo'=>'http://101.109.83.178:90/IEXT/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'000000',
				'coop_name'=>'สอ.ไอโซแคร์ ซิสเต็มส์ จำกัด',
				'coop_url'=>'http://web.coopsiam.com/Webportal/ISC/w/',
				'coop_logo'=>'http://web.coopsiam.com/Webportal/ISC/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'900001',
				'coop_name'=>'สส.ชสอ',
				'coop_url'=>'http://web.coopsiam.com/CMT/Webportal/w/',
				'coop_logo'=>'http://web.coopsiam.com/CMT/Webportal/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'500001',
				'coop_name'=>'สค.คลองจั่น จำกัด',
				'coop_url'=>'http://web.coopsiam.com/CUKJ/Webportal/w/',
				'coop_logo'=>'http://web.coopsiam.com/CUKJ/Webportal/img/logo.png');
$arr[]=array(	'coop_id'=>'015001',
				'coop_name'=>'สอ.กรมการพัฒนาชุมชน จำกัด',
				'coop_url'=>'http://182.52.236.49:90/cddco/m/',
				'coop_logo'=>'http://182.52.236.49:90/cddco/img/logo.png');
				
//echo json_encode($arr);
*/
///*
// แก้ Index Coop ที่ File coopdata.php แทน
if ($file = fopen("coopdata.php", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
		$line = str_replace("\xEF\xBB\xBF",'',$line); 
		//if(strlen(str_replace("\r\n","",$line))>0){
		//echo str_replace($line,"'","")."<br\>";
		$data = explode(",", str_replace("'","",$line));
		//print_r($data);
		$arr[]=array(	
				'coop_id'=>$data[0],
				'coop_name'=>$data[1],
				'coop_url'=>$data[2],
				'coop_logo'=>str_replace("\r\n","",$data[3])
				);
		//}
    }
    fclose($file);
}
//*/
if(isset($_GET["coop_id"])){
  $_SESSION["coop_id"]=$_GET["coop_id"];
  }
 
function removeExcept($excep_coop_id){ 
global $arr;
$_GET["coop_id"]=$excep_coop_id;
if(isset($_GET["coop_id"])){
  $c=count($arr);
  for($i=0;$i<$c;$i++){
    //echo $arr[$i]['coop_id' ]."=".$_GET["coop_id"]."<br/>";
    if($arr[$i]['coop_id' ]!=$_GET["coop_id"]&&$_GET["coop_id"]!=""){	  
	  unset($arr[$i]);	  
	  //$c--;
	  //$i--;
	  }
	  if($i<0) $i=0;
   }
   
 //  print_r($arr);
 //  header("Content-Type: application/json");
 //  echo $_GET['callback']."(".json_encode($arr).")";
}

}

if(isset ($_GET['callback']))
{
    header("Content-Type: application/json");
	if(isset($_SESSION["coop_id"])){
     removeExcept($_SESSION["coop_id"]);
	}
	//echo $_SESSION["coop_id"];
    //print_r($arr);
     echo $_GET['callback']."(".json_encode($arr).")";
}

/*


update mbmembmaster set memb_name=member_no,memb_surname='' where member_no='00008073';
commit;

update lncontcoll set description =concat(loancontract_no,seq_no) where loancontract_no in
 (select loancontract_no from lncontmaster where member_no in
 (select member_no from mbmembmaster where member_no='00008073'));
commit;

update mbmembmaster set memb_name=member_no,memb_surname='' 
where member_no in (
select ref_collno from lncontcoll  where loancontract_no in
 (select loancontract_no from lncontmaster where member_no in
 (select member_no from mbmembmaster where member_no='00008073'))
);
commit;



*/

?>