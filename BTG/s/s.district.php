<?php
header('Content-Type: text/html; charset=tis-620');
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'TH8TISASCII');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
if(isset($_POST["province"])){

if(isset($_POST["district_old"])){
   $olddistrict = $_POST["district_old"];
    }

	$province = $_POST["province"];
	$strSQL4 = "SELECT district_code,  district_desc, 1 as sorter  FROM mbucfdistrict 
				where province_code = '$province' order by sorter, district_code ASC";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	while($objResult4 = oci_fetch_array($objParse4,OCI_BOTH)){
	?> 
	<?php if($objResult4[0] ==  $olddistrict){ ?>
	
		 <option value="<?=$objResult4[0]?>" id="<?=$objResult4[0]?>" selected><?=$objResult4[1]?></option>
		<?php } else { ?>
		<option value="<?=$objResult4[0]?>" id="<?=$objResult4[0]?>" ><?=$objResult4[1]?></option>
		<?php } ?>
		
	<?php  }
}else if(isset($_POST["district"])){
    if(isset($_POST["tambol_old"])){
        $oldtembol = $_POST["tambol_old"];
    }
	$district = $_POST["district"];
	$strSQL4 = "SELECT tambol_code, tambol_desc, 1 as sorter  FROM mbucftambol where district_code = '$district' 
	order by sorter, tambol_code ASC";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	while($objResult4 = oci_fetch_array($objParse4,OCI_BOTH)){
            if($objResult4[0] ==  $oldtembol){ ?>
                <option value="<?=$objResult4[0]?>" id="<?=$objResult4[0]?>" selected><?=$objResult4[1]?></option>
           <?php }else{
	?>
		<option value="<?=$objResult4[0]?>" id="<?=$objResult4[0]?>" ><?=$objResult4[1]?></option>
	<?php  }
        }
}else if(isset($_POST["province2"])&& isset($_POST["district2"])){
	$province = $_POST["province2"];
	$district = $_POST["district2"];
	$strSQL4 = "SELECT postcode FROM mbucfdistrict where province_code = '$province' and district_code = '$district'";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_ASSOC);
	echo $objResult4["POSTCODE"];
}



					
						