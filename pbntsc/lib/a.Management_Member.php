<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php require "../include/conf.d_admin.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">�к��Ѵ�����Ҫԡ</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Member Management</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
    <tr>
      <td align="center"><strong><font size="2" face="Tahoma">������Ҫԡ 
        <label for="search"></label>
        <input name="search" type="text" id="search" size="35" />
         <input type="submit" name="button" id="button" value="����" class="button4" />
      </font></strong></td>
    </tr>
  </table>
</form>
<?php 
if($_POST["button"] == "����"){
	if(get_type($_POST["search"]) == "member"){
		$member_no = GetFormatMember ($_POST["search"]);
	}else{
		echo '<script type="text/javascript"> window.alert("�Ţ����¹��Ҫԡ���١��ͧ��سҵ�Ǩ�ͺ") </script> ';
		echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
		exit();	
	}
		/*$strSQL= "SELECT mc.member_password FROM memberclare mc INNER  JOIN mbmembmaster mm ON mc.member_no=mm.member_no WHERE mc.member_no='$member_no'";
		$value = array('member_password');
		list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
		$password_clare = $list_info[0][0];*/
		
		$strSQL = " select mb.id,mb.date_reg,mb.ipconnect,mb.confirm_date,mb.who_approve,mc.member_password from mbmembmaster mb left join memberclare mc on
					      mb.member_no=mc.member_no where mb.member_no = '$member_no'  ";
		$value = array('id','date_reg','ipconnect','confirm_date','who_approve','member_password');
		list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
		$id = $list_info[0][0];
		$date_reg = $list_info[0][1];
		$ipconnect = $list_info[0][2];
		$confirm_date = $list_info[0][3];
		$who_approve = $list_info[0][4];
		$password_clare = $list_info[0][5];
		
		if($date_reg == ""){ // ��Ҫԡ�ѧ�������Ѥú�ԡ�ü�ҹ Internet 
			$register_member = '��Ҫԡ�ѧ�������Ѥú�ԡ��';
			$bg_reg = "#FF0000";
		}else{
			$register_member = '��Ҫԡ����Ѥ����ԡ������'; 
			$bg_reg = "#2dff11"; 
		}
	if($confirm2use == 1){	
		if($who_approve == ""){
			$confirm_memeber= '�ѧ������Ѻ���͹��ѵ�';
			$bg_conf = "#FF0000";
		}else{
			$confirm_memeber = '��Ҫԡ�׹�ѹ������'; 
			$bg_conf = "#2dff11"; 
		}	
	}	
	require "../s/s.member_info.php";
	if($Num_Rows != 0){
		?>
		<table width="85%" border="0" align="center" cellpadding="1" cellspacing="6">
		  <tr>
			<td width="17%" align="right">����¹��Ҫԡ :</td>
			<td width="38%" align="left"><?=$member_no?></td>
			<td width="14%" align="right">��������Ҫԡ :</td>
			<td width="31%" align="left"><?=$member_type?></td>
		  </tr>
		  <tr>
			<td align="right">���� - ʡ�� :</td>
			<td align="left"><?=$full_name?></td>
			<td align="right">�ѹ�Դ :</td>
			<td align="left"><?=ConvertDate($birthday,"short")?>
			  (
			  <?=count_member($birthday,'ym')?>
			  )</td>
		  </tr>
		  <tr>
			<td align="right">�Ţ���ѵû�ЪҪ� :</td>
			<td align="left"><?=GetFormatidcare($card_person)?></td>
			<td align="right">��Ͷ�� :</td>
			<td align="left"><?=$mobile?></td>
		  </tr>
		  <tr>
			<td align="right">�ѹ�������Ҫԡ :</td>
			<td align="left"><?=ConvertDate($member_date,"short")?>
			  (
			  <?=count_member($member_date,'ym')?>
			  )</td>
			<td align="right">������ :</td>
			<td align="left"><?=$email?></td>
		  </tr>
		  <tr>
			<td align="right">�ѧ�Ѵ :</td>
			<td align="left"><?=$membgroup?></td>
			<td align="right">���ʼ�ҹ :</td>
			<td align="left"><?=$password_clare?></td>
		  </tr>
		  <tr>
		    <td align="right">&nbsp;</td>
		    <td colspan="3" align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right">ʶҹ� : </td>
		    <td align="center"  bgcolor="<?=$bg_reg?>" ><?=$register_member?></td>
		    <td colspan="2" align="left">
				<?php if($date_reg != "" or $date_reg != null){
					
							echo '�ѹ��� : '.DateThai($date_reg);
                } ?>
             </td>
	      </tr>
		<?php if($confirm2use == 1){	 ?>
		  <tr>
		    <td align="right">͹��ѵ� :</td>
		    <td align="center"  bgcolor="<?=$bg_conf?>" ><?=$confirm_memeber?></td>
		    <td colspan="2" align="left">
				<?php 
				if($who_approve != "" or $who_approve != null){
					echo '�ѹ��� : '.DateThai($confirm_date);
					$logstatus = 1;
                } ?>
            </td>
	      </tr>
          <?php if($who_approve != "" or $who_approve != null){
			  $logstatus = 1; ?>
		  <tr>
		    <td align="right">���͹��ѵ� : </td>
		    <td align="left" ><?=$who_approve?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
          <?php } ?>
          <?php } ?>
		  <tr>
		    <td align="center">&nbsp;</td>
		    <td colspan="3" align="left"><form id="form1" name="form1" method="post" action="">
		      <?php if($who_approve == "" and $confirm2use == 1 and $date_reg != ""){ ?>
              <input type="submit" name="actions" id="actions" value="͹��ѵ�" class="button1" onclick="return confirm('��ҹ��ͧ���͹��ѵ������Ҫԡ���ԡ���� �� ���� ��� !!!')">
              <?php } ?>
              <?php if($date_reg != "" or $date_reg != null){ ?>
              <input type="submit" name="actions" id="actions" value="ź" class="button3" onclick="return confirm('��ҹ��ͧ���ź�������� ���� ��� !!!')">
              <?php } ?>
              <input type="hidden" name="id" id="id" value="<?=$id ?>" />
              <input name="table" type="hidden" value="mbmembmaster" />
              <input name="member" type="hidden" value="<?=$member_no?>" />
		    </form>   
            <?php  //if($logstatus == 1){ ?>
           <form id="form2" name="form2" method="post" action="../lib/Update.php">
				<input type="submit" name="actions" id="actions" value="����¹�����繤���������">
				<input name="member" type="hidden" value="<?=$member_no?>" />
				 </form>    <a class="popup-alink-1"><b>�ٻ���ѵԡ������� 10 ��������ش</b></a>
			    
           	 	<?php //if($repassword == 1){ ?>
            	<!-- <a class="popup-alink-2" onclick="return confirm('��ҹ��ͧ�������¹���ʼ�ҹ �� '1234' �� ���� ��� !!!')"><b>����¹�����繤���������</b></a> -->
            	<?php  //} ?>
            <?php  //} ?>
            <div class="popup-box" id="popup-abox-1">
                <div class="close">X</div>
                    <div class="top" align="left">
                        <strong><font size="4" face="Tahoma">�ٻ���ѵԡ�������</font></strong><br />
                        <font face="Tahoma" size="2" color="#FF6600">History</font>    
                    </div>
                <div class="bottom"><?php require "../s/s.log.php"; ?>   </div>
            </div>
            
            <div class="popup-box" id="popup-abox-2">
                <div class="close">X</div>
                    <div class="top" align="left">
                        <strong><font size="4" face="Tahoma">�������</font></strong><br />
                        <font face="Tahoma" size="2" color="#FF6600">Change password to default</font>    
                    </div>
					
					
                <div class="bottom" align="center">
				
                <?php  
				/*echo '���';
				
				$member_no_new = "00".$member_no;
				$repwd = md5("12345678");
				$table_u_pwd ="mbmembmaster";
				$condition_u_pwd = "WHERE member_no = '$member_no_new' ";
				$value_u_pwd = "password = '$repwd'";
				$update_status = update_value_sql($table_u_pwd,$condition_u_pwd,$value_u_pwd);
				
				$table_u_pwd_clare ="memberclare";
				$condition_u_pwd_clare = "WHERE member_no = '$member_no_new' ";
				$value_u_pwd_clare = "member_password = '12345678'";
				 update_value_sql($table_u_pwd_clare,$condition_u_pwd_clare,$value_u_pwd_clare);
                if(!$update_status){*/ ?>                
                	<!--<br/><font size="4" color="#FF0000">��سҵ�Ǩ�ͺ�к��������ö����¹�ŧ��</font><p>     -->
                 <?php //}else { ?>
                 <!--	<br/>�к�������¹������Ҫԡ����� <font size="4" color="#FF0000">"12345678</font> ���ǡ�س���Ҵ������ʼ�ҹ�ѧ�����<p>  -->
                 <?php //} ?>         
                </div>
            </div>
            
    
    </td>
	      </tr>
          
		
	    </table>
<?php }else{
				echo '<script type="text/javascript"> window.alert("��辺�Ţ����¹�ѧ�����㹰ҹ������ ��سҵ�Ǩ�ͺ") </script> ';
				echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
				exit;
			}
			

 } ?>
 
 <?php
if($_POST["actions"] == "ź"){
	$status = delete_value_sql($_POST["table"],$_POST["id"]);
	if($status){
		$action_page = $_POST["table"];
		$table = "log_action";
		$condition = "(action_do,action_desc,action_id,user,ipconnect,date_log,connectby)";
		$value  = "('".$action_page."','Delete','".$_POST["member"]."','".$_SESSION[ses_member_no]."','".$ipconnect."','".$date_log."','".$connectby."')";
		$status = insert_value_sql($table,$condition,$value);
		if($status){
			echo '<script type="text/javascript"> window.alert("�к���ź����������") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
		}else{
			echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! �������ö�ѹ�֡����ѵ��� ��سҵԴ�������������") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
		}
	}else{
		echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! �������öź���������ô�ͧ�ա����") </script> ';
		echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
	}
}elseif($_POST["actions"] == "͹��ѵ�"){
	$table = $_POST["table"];
	$condition = "where id = '".$_POST["id"]."' ";
	$value  = "confirm_date = '".$date_log."',
					who_approve = '".$_SESSION[ses_member_no]."' ";
	if(update_value_sql($table,$condition,$value)){
		$action_page = $table;
		$table = "log_action";
		$condition = "(action_do,action_desc,action_id,user,ipconnect,date_log,connectby)";
		$value  = "('Approve','".$action_page."','".$_POST["member"]."','".$_SESSION[ses_member_no]."','".$ipconnect."','".$date_log."','".$connectby."')";
		$status = insert_value_sql($table,$condition,$value);
		if($status){
			echo '<script type="text/javascript"> window.alert("�к���͹��ѵԡ��������ԡ�����º��������") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
			exit();
		}else{
			echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! ��س���������ա����") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
			exit();
		}			
	}else{
		echo '<script type="text/javascript"> window.alert("�������ö�ѹ�֡���سҵԴ��� �����������������") </script> ';
		echo "<script>window.location = '../d/administrator.php?menu=Management_Member'</script>";
		exit();
	}		
}

 ?>
 
 