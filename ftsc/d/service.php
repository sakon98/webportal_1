<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?=$title?></title>
<script type="text/javascript">
function number_write(x)
{
  var text_box = document.getElementById("number");
  if(x>=0 && x<=9)
  {
	  
    if(isNaN(text_box.value))
    text_box.value ="";
 	text_box.value = (text_box.value * 10)+x;
  }
}
function number_clear()
{
  document.getElementById("number").value = 0;
}
function number_c()
{
  var text_box = document.getElementById("number");
  var num = text_box.value;
  var num1 = num%10;
  num -= num1;
  num /= 10;
  text_box.value = num;
}
</script>
<style type="text/css">
.main_panel
{
	width: 270px;
	height: 430px;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	padding: 0px;
}
.number_button
{
width:70px;
height:70px;
margin:10px;
float:left;
background-color:#fa800a;
border-top-right-radius:20px;
border-top-left-radius:20px;
border-bottom-right-radius:20px;
border-bottom-left-radius:20px;
font-size:36px;
text-align:center;
}
.number_center {
	padding-top: 0.6ex;
}
.number_button:hover
{
background-color:#455555;
}
.text_box
{
width:380px; 
height:100px;
font-size:85px;
text-align:right;
maxlength:8;
}
.text_box1 {width:380px; 
height:100px;
font-size:85px;
text-align:right;
maxlength:8;
}
.ok{
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
body,td,th {
	color: #FFF;
}
body {
	background-color: #000;
}
.text_box11 {width:380px; 
height:100px;
font-size:85px;
text-align:right;
maxlength:8;
}
html, body{
	padding:0px;
	margin:0px;
	height:100%;
}

</style>
</head>
<body>
<form name="form1" method="post" action="">
  <table width="995" height="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td ><table width="995" border="0" align="center" cellpadding="0" cellspacing="0" background="../img/bgsv.png">
        <tr>
          <td width="59%" height="597" align="center"><p>
            <input name="num" type="text" class="text_box11" id="number" style="text-align:center"  />
          </p></td>
          <td width="41%" align="left"><div class="main_panel"> <br />
            <center>
            </center>
            <br />
            <br />
            <div class="number_button" onClick="number_write(1);">
              <div class="number_center">1</div>
            </div>
            <div class="number_button" onClick="number_write(2);">
              <div class="number_center">2</div>
            </div>
            <div class="number_button" onClick="number_write(3);">
              <div class="number_center">3</div>
            </div>
            <div class="number_button" onClick="number_write(4);">
              <div class="number_center">4</div>
            </div>
            <div class="number_button" onClick="number_write(5);">
              <div class="number_center">5</div>
            </div>
            <div class="number_button" onClick="number_write(6);">
              <div class="number_center">6</div>
            </div>
            <div class="number_button" onClick="number_write(7);">
              <div class="number_center">7</div>
            </div>
            <div class="number_button" onClick="number_write(8);">
              <div class="number_center">8</div>
            </div>
            <div class="number_button" onClick="number_write(9);">
              <div class="number_center">9</div>
            </div>
            <div class="number_button" onClick="number_clear();">
              <div class="number_center">C</div>
            </div>
            <div class="number_button" onClick="number_write(0);">
              <div class="number_center">0</div>
            </div>
            <div class="number_button" onClick="number_c();">
              <div class="number_center"><img src="../img/arrow.png" alt="" width="47" height="47"></div>
            </div>
            
          </div>
          
          <button type="submit" name="ok" style="height:55; width:255; background:#0C0; font-size:36;" class="ok" > ตกลง </button>
          </td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<?php 
$member_no = $_POST["num"];
if($member_no == "" or $member_no == 0){

}else{
	$member_no = GetFormatMember($member_no);
	
	$strSQL ="SELECT
						CARD_PERSON AS CARD_PERSON
					FROM
						MBMEMBMASTER
					WHERE
						MEMBER_NO='$member_no'
					";
	$value = "CARD_PERSON";
	$id_card = get_single_value_oci($strSQL,$value );
	
	if($id_card  == null){
		echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกไม่ถูกต้อง") </script> ';
	}else{
		$_SESSION[ses_member_no] = $member_no;
		echo "<script>window.location = 'service_slip_month.php'</script>";
	}
}



?>














</body>
</html>

