<?PHP
       if($_POST){
           $cfperiod= $_POST['cd'];
          include "../s/s.getconfirmreport.php";
	$showdata = true;
         }else{
	$showdata = false;
        }
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=tis-260" />
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     document.getElementById('welcomeDiv').style.display = "block";
     window.print();

     document.body.innerHTML = originalContents;
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

.subcontent{ width:780px;
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

<form name="confirmlist" method ="POST" action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
<h2>รายงานสมาชิกยืนยันยอด</h2></th><th align="right">
<select name="cd" type='list' onChange="submit()">
<option value="" selected>------เลือกเดือน------</option>
       <?PHP
            include("../s/s.getmonthconfirm.php");
            for($i =  0;$i < $n;$i++){
	   $cfdate = explode("-", $confirmdate[$i]);
                  echo "<option  value='" . $confirmdate[$i] ."'>" .$cfdate[2]."/".$cfdate[1]."/".$cfdate[0]."</option>";
                }
        ?>
 </select>
</form>
</th>
<tr>
<td colspan=2 valign="top">
<?PHP if($showdata == true){ ?>
<div id="printableArea"><div id="welcomeDiv"  style="display:none;"  ><h2>รายงานสมาชิกยืนยันยอด</h2></div>
<table class="subcontent" align="center">
<tr>
<th width="50px">ที่</th><th width="100px">เลขสมาชิก</th>
<th width="350px">ชื่อ - สกุลสมาชิก</th><th width="100px">งวดที่ยืนยัน</th>
<th width="100px">วันที่ยืนยัน</th><th width="70px">สถานะ</th></tr>
<?PHP
	$f = 1;
	$str = "";
	for($i = 0 ;$i<$m;$i++){
		echo "<tr align=center><td>$f</td>";

		echo "<td align=center>" . $membno[$i] . "</td>";

		echo "<td align=left>" . $membname[$i] . "</td>";
		echo "<td>" . $cfpr[$i] . "</td>";
		echo "<td>" . $entrydate[$i] . "</td>";
		
		if($cfsts[$i] == "1"){
		echo "<td align=center>ถูกต้อง</td>";
		}else if($cfsts[$i] == "-1"){
		echo "<td align=center>ผิด</td>";
		}
		echo "</tr>";
		$f = $f+1;
	}
?>
</table>
</div>
<?php } ?>
</td>
</tr>
<?PHP if($showdata == true){ ?>
<tr>
<td align="right" height="30px">
<a href="#" onclick="printDiv('printableArea')" ><img src="../img/print_icon.jpg" border="0"></a>
</td></tr>
<?php } ?>
</table>
</body>
</html>