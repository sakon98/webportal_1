<?php
//session_start();
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
$arr[]=array(	'coop_id'=>'000000',
				'coop_name'=>'สอ.ไอโซแคร์ ซิสเต็มส์ จำกัด',
				'coop_url'=>'http://web.coopsiam.com:8080/WPM/w/',
				'coop_logo'=>'http://web.coopsiam.com:8080/WPM/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'003001',
				'coop_name'=>'สอ.ครูแม่ฮ่องสอน จำกัด',
				'coop_url'=>'http://122.154.237.21:90/MHS/w/',
				'coop_logo'=>'http://122.154.237.21:90/MHS/img/logo.png');
$arr[]=array(	'coop_id'=>'013001',
				'coop_name'=>'สอ.ธนาคารออมสิน จำกัด',
				'coop_url'=>'http://182.52.226.144/webportal/w/',
				'coop_logo'=>'http://182.52.226.144/webportal/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'009001',
				'coop_name'=>'สค.ไทยฮอนด้า จำกัด',
				'coop_url'=>'http://110.77.137.118:81/webportal/w/',
				'coop_logo'=>'http://110.77.137.118:81/webportal/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'001013',
				'coop_name'=>'สอ.กรมส่งเสริมการเกษตร จำกัด',
				'coop_url'=>'http://web.coopsiam.com:8080/DOA/w/',
				'coop_logo'=>'http://web.coopsiam.com:8080/DOA/img/ic_launcher.png');
$arr[]=array(	'coop_id'=>'500001',
				'coop_name'=>'สค.คลองจั่น จำกัด',
				'coop_url'=>'http://web.coopsiam.com/CUKJ/Webportal/w/',
				'coop_logo'=>'http://web.coopsiam.com/CUKJ/Webportal/img/logo.png');
$arr[]=array(	'coop_id'=>'013005',
				'coop_name'=>'สอ.กรมการพัฒนาชุมชน จำกัด',
				'coop_url'=>'http://182.52.236.49:90/cddco/m/',
				'coop_logo'=>'http://182.52.236.49:90/cddco/img/logo.png');
				
//echo json_encode($arr);

if(isset ($_GET['callback']))
{
    header("Content-Type: application/json");

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