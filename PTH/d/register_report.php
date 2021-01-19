<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=tis-260" />
 <script src="../js/jquery.js"></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     document.getElementById('welcomeDiv').style.display = "block";
     window.print();

     document.body.innerHTML = originalContents;
}

function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	} 

</script>
<style type="text/css"media="print">
@media print {
    #Header, #Footer { display: none !important;}
   h2{font:30px "angsana New";color:#000;margin-bottom:5px;}

table { width:780px;
	height:50px;
	border: 1px solid #000;
	border-collapse: collapse;
	background:#ffffff;
}
 th{height:30px;
	padding:0px 6px;
	font:bold 23px "angsana NEW";
	color:#000;
	background:#f8f8f8;
	border:1px solid #000;
	}
td{height:20px;
	padding:0px 6px;
	font:23px "angsana NEW";
	color:#000;
	border:1px solid #000;
   	vertical-align:middle;
	}
}

</style>
<style type="text/css"media="screen">
.maincontent{ width:800px;
height:300px;
border:0px;
font:16px "Verdana";
}

.subcontent{ width:730px;
	height:50px;
	border: 1px solid #000;
	border-collapse: collapse;
	background:#ffffff;
}
.subcontent th{height:30px;
	padding:5px 6px;
	font:bold 23px "angsana NEW";
	color:#000;
	background:#f8f8f8;
	border:1px solid #000;
	}
.subcontent td{height:20px;
	padding:5px 6px;
	font:23px "angsana NEW";
	color:#000;
	border:1px solid #000;
   	vertical-align:middle;
	}
</style>


</style>
</head>
<body>
<table align="center"class="maincontent">
<tr>
<th height="30px" valign="top" align="left">

<form id="formID1" name="formID1" method="post" action=""> <center>
  <select name="desc" id="desc" onchange= "this.form.submit()" style="width: 190px;height: 24px;">
 

          <option  value=""> - เลือกรายการ -</option> 
          <option value="1"> <center>รายงานสมาชิกสมัครใช้บริการ</center></option>
		  <option value="2"> <center>รายงานสมาชิกยังไม่สมัครใช้บริการ</center></option>
         </select> </center>
</form>
</th>
<tr>
<td colspan=2 valign="top">


<?PHP if(@$_REQUEST["desc"] != ""){ ?>

<?php $desc = $_REQUEST["desc"]; ?>

<?php 

$dbhost="localhost";
$dbuser = "root";
$dbpass = "WebServer";
$conn=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
$objDB = mysql_select_db("webportal"); 

$raw_c1 = mysql_query("SELECT count(w.member_no) AS count_member_no FROM webmbmembmaster w INNER JOIN mbmembmaster_oracle mb ON w.member_no = mb.member_no WHERE mb.resign_status = 0 ORDER BY w.date_reg ASC;");
    
    while($results1 = mysql_fetch_array($raw_c1)) {
	
	                          $count_member_no = $results1['count_member_no'] ;
						
	
	}
	
	
	


?>

<?php if($desc == "1") { ?>



<div id="printableArea"><div id="welcomeDiv"><h4 style="margin-left: 30px;">สมาชิกสมัครใช้บริการเเล้ว  <font color="#339933"><?php echo number_format($count_member_no,0) ?> </font>ราย</h4></div> 
<?php }else if ($desc == "2") {
	$raw_c1 = mysql_query("SELECT count(m.member_no) AS count_member_no2 FROM mbmembmaster_oracle m WHERE m.resign_status = 0 	AND m.member_no <> '00000000' AND m.member_no NOT IN (SELECT member_no FROM webmbmembmaster)");

    while($results1 = mysql_fetch_array($raw_c1)) {
	
							  $count_member_no2 = $results1['count_member_no2'] ;
	}
	?>
<div id="printableArea"><div id="welcomeDiv"><h4 style="margin-left: 30px;">สมาชิกยังไม่สมัครใช้บริการ <font color="#339933"><?php echo number_format($count_member_no2,0) ?> </font>ราย</h4></font></div> 
<?php } ?>



    <br>
<table class="subcontent" align="center">
<tr>
<th width="20px"></th>
<th width="80px">เลขสมาชิก</th>
<th width="200px">ชื่อ - สกุล</th>
<th width="90px">บัตรประชาชน</th>
<th width="90px">เบอร์โทรศัพท์</th>
<th width="90px">วันที่สมัคร</th>
</tr>

<?PHP



if($desc == "1"){

$f= 1;
$raw_result = mysql_query("SELECT w.member_no , w.memb_fullname , w.idcard , w.mobile , concat(concat(concat(concat(date_format(w.date_reg,'%d'),'/'),date_format(w.date_reg,'%m')),'/'),date_format(w.date_reg,'%Y')+543) as date_reg FROM webmbmembmaster w join mbmembmaster_oracle mb on w.member_no = mb.member_no WHERE mb.resign_status = 0 and mb.member_no <> '00000000' order by w.date_reg asc ;");
    
    while($results = mysql_fetch_array($raw_result)) {
        
        echo "<tr align=center><td><font size=4>$f</font></td>";

		echo "<td align=center><font size=4>" . $results['member_no'] . "</font></td>";

		echo "<td align=left><font size=4>" . $results['memb_fullname'] . "</font></td>";
		echo "<td><font size=4>" . $results['idcard'] . "</font></td>";
                echo "<td><font size=4>" . $results['mobile'] . "</font></td>";
		echo "<td><font size=4>" . $results['date_reg'] . "</font></td>";
		echo "</tr>";
		
                $f = $f+1;
    }
	?>
	
	<?php
	
} 


else if($desc == "2"){
require "../s/s.register_report.php";

$f= 1;
$raw_result = mysql_query("select m.member_no,m.memb_fullname,m.card_person,m.phone from mbmembmaster_oracle m where m.resign_status = 0 and m.member_no not in (select member_no from webmbmembmaster) and m.member_no <> '00000000' order by m.member_no;");
    
    while($results = mysql_fetch_array($raw_result)) {
        
        echo "<tr align=center><td><font size=4>$f</font></td>";

		echo "<td align=center><font size=4>" . $results['member_no'] . "</font></td>";

		echo "<td align=left><font size=4>" . $results['memb_fullname'] . "</font></td>";
		echo "<td><font size=4>" . $results['card_person'] . "</font></td>";
                echo "<td><font size=4>" . $results['phone'] . "</font></td>";
		echo "<td><font size=4>ยังไม่ได้สมัคร</font></td>";
		echo "</tr>";
		
                $f = $f+1;
    }

}



?>

</table>
</div>
<?php } ?>
</td>
</tr>
<?PHP if(@$_POST["desc"] != ""){ ?>
<tr>
<td align="right" height="30px">
<a href="#" onclick="printDiv('printableArea')" ><img src="../img/print_icon.jpg" border="0"></a>
</td></tr>
<?php } ?>
</table>
</body>
</html>

