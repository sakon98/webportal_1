<?php
@header('Content-Type: text/html; charset=tis-620');
$IPSERVER = 'inetiscoscr.coopsiam.com';
	$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'TH8TISASCII');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อฐานข้อมูลได้") </script> ';
    }
$strSQL5 = "SELECT prename_code, prename_desc FROM mbucfprename order by prename_code ASC";
$objParse5 = oci_parse($objConnect, $strSQL5);
oci_execute ($objParse5,OCI_DEFAULT);
$row5 = $_POST["row"];
?>
<select class="inputs" id="prename_code<?=$row5?>" style="width:100px;text-align:center;" name="prename_code" required>
<option value="">กรุณาเลือกคำนำหน้า</option>
<?php
while($objResult5 = oci_fetch_array($objParse5,OCI_BOTH)){ ?>
<option value="<?=$objResult5[0]?>"><?=$objResult5[1]?></option>
<?php } ?>
</select>

<?php
?>