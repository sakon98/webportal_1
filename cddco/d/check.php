<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php require "../include/conf.d.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ตรวจสอบข้อมูลสมาชิก</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Member Verify</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
    <tr>
      <td align="center"><strong><font size="2" face="Tahoma">ค้นหาข้อมูลจากชื่อ 
        <label for="search"></label>
        <input name="search" type="text" id="search" size="35" />
         <input type="submit" name="button" id="button" value="ค้นหา" class="button4" />
      </font></strong></td>
    </tr>
  </table>
</form>
<?php 
if($_POST["button"] == "ค้นหา"){
	
		$name = $_POST["search"];
	
                    $strSQL2 = " SELECT MEMBER_NO,
                                MUP.PRENAME_DESC || MB.MEMB_NAME || ' ' || MB.MEMB_SUENAME as FULL_NAME,
                                MUG.MEMBGROUP_DESC,
                                MUG.MEMBGROUP_CODE,
                                MUD.POSITION_GROUPDET,
                                MB.MEMB_ADDR,
				MB.MOOBAN,
				MB.SOI,
                                MB.ROAD,
				MB.TAMBOL,
				DS.DISTRICT_DESC,
				PV.PROVINCE_DESC,
				MB.POSTCODE
                                FROM MBMEMBMASTER MB , MBUCFPRENAME MUP , MBUCFMEMBGROUP mug , MBUCFPOSITIONGROUP MUD , MBUCFDISTRICT DS, MBUCFPROVINCE PV
                                where MB.PRENAME_CODE = MUP.PRENAME_CODE and
                                MB.MEMBGROUP_CODE =  MUG.MEMBGROUP_CODE and 
                                MB.position_group = MUD.POSITION_GROUP and
                                MB.DISTRICT_CODE = DS.DISTRICT_CODE(+) AND
                                MB.PROVINCE_CODE = PV.PROVINCE_CODE(+) AND
                                MB.POSTCODE = DS.POSTCODE(+) AND
                                MB.MEMB_NAME LIKE '%$name%'";
						$value2 = array('MEMBER_NO','FULL_NAME','MEMBGROUP_DESC','MEMBGROUP_CODE','POSITION_GROUPDET','MEMB_ADDR','MOOBAN','SOI','ROAD','TAMBOL','DISTRICT_DESC','PROVINCE_DESC','POSTCODE');
						list($Num_Rows2,$list_wf) = get_value_many_oci($strSQL2,$value2);
                
$ms = 0;
for($sq = 0 ; $sq < $Num_Rows2 ; $sq++){
    
	$MEMBER_NO[$sq] = $list_wf[$sq][$ms++]; 
	$FULL_NAME[$sq] = $list_wf[$sq][$ms++]; 
	$MEMBGROUP_DESC[$sq] = $list_wf[$sq][$ms++]; 
	$MEMBGROUP_CODE[$sq] = $list_wf[$sq][$ms++]; 
        $POSITION_GROUPDET[$sq] = $list_wf[$sq][$ms++]; 
        $MEMB_ADDR[$sq] = $list_wf[$sq][$ms++]; 
        $MOOBAN[$sq] = $list_wf[$sq][$ms++]; 
        $SOI[$sq] = $list_wf[$sq][$ms++]; 
        $ROAD[$sq] = $list_wf[$sq][$ms++]; 
        $TAMBOL[$sq] = $list_wf[$sq][$ms++]; 
        $DISTRICT_DESC[$sq] = $list_wf[$sq][$ms++]; 
        $PROVINCE_DESC[$sq] = $list_wf[$sq][$ms++]; 
        $POSTCODE[$sq] = $list_wf[$sq][$ms++]; 
        
        if($MOOBAN[$sq] == ""){
             
             $MOOBAN[$sq] = ' -';
         }
         if($SOI[$sq] == ""){
             
             $SOI[$sq] = ' -';
         }
         if($ROAD[$sq] == ""){
             
             $ROAD[$sq] = ' -';
         }
         if($TAMBOL[$sq]== ""){
             
             $TAMBOL[$sq] = ' -';
         }
         if($DISTRICT_DESC[$sq] == ""){
             
             $DISTRICT_DESC[$sq] = ' -';
         }
         if($PROVINCE_DESC[$sq] == ""){
             
             $PROVINCE_DESC[$sq] = ' -';
         }
         if($POSTCODE[$sq] == ""){
             
             $POSTCODE[$sq] = ' ';
         }
         
     
     if ($PROVINCE_DESC[$sq] == 'กรุงเทพ ฯ') {
             
             $FULL_ADDR[$sq] = $MEMB_ADDR[$sq] .' หมู่บ้าน.'.$MOOBAN[$sq] .' ซอย.'.$SOI[$sq].' ถนน.'.$ROAD[$sq] .' เเขวง'.$TAMBOL[$sq].' เขต'.$DISTRICT_DESC[$sq].' จ.'.$PROVINCE_DESC[$sq].' '.$POSTCODE[$sq];
         }
     elseif ($PROVINCE_DESC != 'กรุงเทพ ฯ' && $PROVINCE_DESC != '<ไม่ระบุ>') {
             
             $FULL_ADDR[$sq] = $MEMB_ADDR[$sq] .' หมู่บ้าน.'.$MOOBAN[$sq] .' ซอย.'.$SOI[$sq].' ถนน.'.$ROAD[$sq] .' ตำบล'.$TAMBOL[$sq].' อำเภอ'.$DISTRICT_DESC[$sq].' จ.'.$PROVINCE_DESC[$sq].' '.$POSTCODE[$sq];
   
     }elseif ($PROVINCE_DESC == '<ไม่ระบุ>') {
         
             $FULL_ADDR[$sq] = $MEMB_ADDR[$sq];
         
     }
     
     
     if($membgroup_code[$sq] == '010' || $membgroup_code[$sq] == '011' || $membgroup_code[$sq] == '012'){
         
         $full_addr[$sq] = "";
         
     }
        

        $ms = 0;
        
        

}
		?>
<div style="width: 100%; height: 340px; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>ทะเบียนสมาชิก</strong></td>
        <td width="16%" align="center" bgcolor="#CCCCFF"><strong>ชื่อ - สกุล</strong></td>
        <td width="10%" align="center" bgcolor="#CCCCFF"><strong>หน่วยสมาชิก</strong></td>
        <td width="10%" align="center" bgcolor="#CCCCFF"><strong>กลุ่มงาน</strong></td>
        <td width="29%" align="center" bgcolor="#CCCCFF"><strong>ที่อยู่</strong></td>

      </tr>
    <?php for($sq = 0 ; $sq < $rowSQL ; $sq++){       
        ?>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$MEMBER_NO[$sq]?></td>
        <td align="left" bgcolor="#FFFFFF"><?=$FULL_NAME[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$MEMBGROUP_DESC[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$POSITION_GROUPDET[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$FULL_ADDR[$sq]?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
</div>
		
<?php }else{
    
    
    echo '<script type="text/javascript"> window.alert("ไม่พบชื่อดังกล่าวในฐานข้อมูล กรุณาตรวจสอบ") </script> ';
				echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
				exit;
    
} ?>
 
 