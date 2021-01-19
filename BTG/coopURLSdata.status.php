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
$filename="coopdata.php";

if($_POST["update"]=="update"){

   //print_r($_POST["coop_seq"]);
   $data=""; 
   for($i=0;$i<count($_POST["coop_id"]);$i++){    
    if($_POST["coop_id"][$i]!=""){
     $data.="'".$_POST["coop_id"][$i]."'".",";
     $data.="'".$_POST["coop_name"][$i]."'".",";
     $data.="'".$_POST["coop_url"][$i]."'".",";
     $data.="'".$_POST["coop_logo"][$i]."'"."";
	 $data.="\r\n";
	 }
   }
    $data.=";";
	$data=str_replace("\r\n;","",$data);
	//echo str_replace("\r\n","<br/>",$data);
	$fp = fopen($filename, 'w');
	fwrite($fp,$data);
	fclose($fp);
}

/*
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
	 */
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



if ($file = fopen($filename, "r")) {
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
  
 function urlExists($url) {

        $handle = curl_init($url);		
		curl_setopt($handle, CURLOPT_TIMEOUT, 5);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        curl_close($handle);
		
		//echo "<script>alert('".$httpCode."');</script>";
		
        if(($httpCode >= 200 && $httpCode <= 400)||$httpCode==0) {
            return true;
        } else {
            return false;
        }

 }
 
 function checkUrl($url, $nredirects = 0) {
    return urlExists($url);
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

?>
<script>

function imageExists(image_url){

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;

}

function getStatus(url,id)
{
	var found=imageExists(url);
	alert(id+':'+url+':'+found);
	 document.getElementById(id).innerHTML=(found?"<span style=\"color:blue\"><b>/</b></span>":"<span style=\"color:red\"><b>X</b></span>");
	
}

</script>
<div align="center">* ถ้ารูปไม่ขึ้นแสดงว่า Link หรือ Server มีปัญหา </div>
<?php
//if(isset ($_GET['callback'])){
   // header("Content-Type: application/json");
	if(isset($_SESSION["coop_id"])){
     removeExcept($_SESSION["coop_id"]);
	}
	//echo $_SESSION["coop_id"];
    //print_r($arr);
   //  echo $_GET['callback']."(".json_encode($arr).")";
  echo "<form action=\"coopURLSdata.status.php\" method=\"post\" name=\"form_\" id=\"form_\" onsubmit=\"return confirm('ยืนยันทำรายการ');\" >";	
   echo "<table border=1 align=\"center\" >";	
		
		echo "<tr><td colspan=\"5\" align=\"center\">";
		echo "<input type=\"submit\" name=\"update\" id=\"update\" value=\"update\" /> ";
		echo "<input type=\"reset\" name=\"reset\" id=\"reset\" value=\"reset\" /> <br/>";
		echo "* ถ้าต้องการลบให้แก้ไข coop_id เป็น ไม่มีค่า และ <br/> ";
		echo " กด update รายการทะเบียนสหกรณ์นั้น <br/> ";
		echo " จะถูกลบ ออกจากรายการ Coop Mobile App</td></tr>";
		
        echo "<tr>";
		//echo "<td>coop_status</td>";
		echo "<td>coop_status</td>";
		echo "<td>coop Link </td>";
		echo "</tr>";		
   $i=0;		
   foreach($arr as  $key =>$value){
       $i=($key+1);	
		echo "<tr><td align=\"center\"><img src=\"".$value["coop_logo"]."\" width=50 alt=\"".$value["coop_logo"]."\"/><br/>";
		echo "<a href=\"".$value["coop_url"]."\"  onclick=\"window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=320, height=568');return false;\">open</a></td>";
		echo "<td><table>";
		echo "<tr><td>NO :</td><td><input type=\"text\" name=\"coop_seq[]\" value=\"".($key+1)."\" size=3 /></td></tr>";
		echo "<tr><td>ID :</td><td><input type=\"text\" name=\"coop_id[]\" value=\"".$value["coop_id"]."\" size=5 /></td></tr>";
		echo "<tr><td>NM :</td><td><input type=\"text\" name=\"coop_name[]\" value=\"".$value["coop_name"]."\" size=25 /></td></tr>";
		echo "<tr><td>URL :</td><td><input type=\"text\" name=\"coop_url[]\" value=\"".$value["coop_url"]."\" size=50 /></td></tr>";
		echo "<tr><td>LOGO : </td><td><input type=\"text\" name=\"coop_logo[]\" value=\"".$value["coop_logo"]."\" size=50/></td></tr>";
		echo "</table> </td>";		
		echo "</tr>";
   }
      $i++;	
		echo "<tr><td align=\"center\"></td>";
		echo "<td><table>";
		echo "<tr><td>NO :</td><td><input type=\"text\" name=\"coop_seq[]\" value=\"".($i)."\" size=3 /></td></tr>";
		echo "<tr><td>ID :</td><td><input type=\"text\" name=\"coop_id[]\" value=\"\" size=5 /></td></tr>";
		echo "<tr><td>NM :</td><td><input type=\"text\" name=\"coop_name[]\" value=\"\" size=25 /></td></tr>";
		echo "<tr><td>URL :</td><td><input type=\"text\" name=\"coop_url[]\" value=\"\" size=50 /></td></tr>";
		echo "<tr><td>LOGO : </td><td><input type=\"text\" name=\"coop_logo[]\" value=\"\" size=50/></td></tr>";
		echo "</table> </td>";		
		echo "</tr>";
   echo "</table></form>";
//}

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