<?php
@header('Content-Type: text/html; charset=tis-620');
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'TH8TISASCII');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อฐานข้อมูลได้") </script> ';
    }
$strSQL = "SELECT concern_code, gain_concern FROM mbucfgainconcern order by concern_code ASC";
$objParse4 = oci_parse($objConnect, $strSQL);
oci_execute ($objParse4,OCI_DEFAULT);
$row = $_POST["row"];
?>
<select class="inputs" id="gain_relation<?=$row?>" style="width:150px;text-align:center;" name="gain_relation" required>
<option value="">กรุณาเลือกความสัมพันธ์</option>
<?php
while($objResult4 = oci_fetch_array($objParse4,OCI_BOTH)){ ?>
<option value="<?=$objResult4[0]?>"><?=$objResult4[1]?></option>
<?php } ?>
</select>
<?php
?>