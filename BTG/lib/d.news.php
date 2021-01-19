<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script src="/js/pdfobject.js">
</script>

<style>
#pp{
	text-align:right;
}
#mm{
	text-align:left;
	line-height:12px;
	font-size:14px;
}
</style>



<?php   require "../include/jquery.popup.php";   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข่าวประชาสัมพันธ์</font></strong><br />
      <font face="Tahoma" size="2" color="#0000FF">News</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/my.news.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($i=0;$i<$Num_Rows;$i++){ ?>


 <tr>
  <td id="mm" >
    
	
	<a align="right" face="Tahoma"  class="popup-link-<?=$i?>"><?= $n_topic[$i]?></a>
</td>

<td id="pp">	
     <a><font color="#0000FF" face="Tahoma" >วันที่ประกาศ  <?= DateThai($n_date[$i])?>&nbsp;&nbsp;<?= $t_date[$i]?></font></a>
</td>     
	


 </tr>

  
  
    <div class="popup-box" id="popup-box-<?=$i?>">
        <div class="close">X</div>
            <div class="top" align="left">
                <strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
            <font face="Tahoma" size="2" color="#0000FF">News</font>            </div>
            <div class="bottom">
            	<p><strong><?= $n_topic[$i]?></strong>
                    <textarea name="a" rows="8" readonly="readonly" id="a" style="width:100%; resize:none; font-size:14px; font-family:Tahoma" > <?= $n_details[$i]?></textarea></font>
                  <br><br>

                  <?php 
                      
                    $strSQL1 = " SELECT 
						img_name as  img_name
					FROM 
						news_img where id = $id[$i]
					order by id desc
					LIMIT 0 , 2 ";
	            $value1 = array('img_name');
	            list($Num_Rows1,$list_info1) = get_value_many_sql($strSQL1,$value1);
	            $a=0;
	            for($b=0;$b<$Num_Rows1;$b++){
		    $img_name[$b]		 =	 $list_info1[$b][$a++];
		    $a=0;
                  
                  
                  
                  if($Num_Rows1 == 0){
                       ?>

                  <?php }else if ($Num_Rows1 == 2){ ?>
                  
                  <img src="../lib/myimg/<?php echo $img_name[$b];?>" width="360" height="200" border="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  
                  <?php }else if ($Num_Rows1 == 1){ ?>
                  
                <center><img src="../lib/myimg/<?php echo $img_name[$b];?>" width="360" height="200" border="2"></center>
                  
                  <?php } ?>
                  
                   <?php } ?>
                   
                    
                <br><br>

                ผู้ประกาศ  : <font face="Tahoma" size="2" color="#0000FF"><?= $who_post[$i]?></font>     
                &nbsp;&nbsp;&nbsp;วันที่ประกาศ : <font face="Tahoma" size="2" color="#0000FF"><?= DateThai($n_date[$i])?>&nbsp;&nbsp;<?= $t_date[$i]?></font><br><br>
                
                    <?php if($FilesName[$i] != ""){?>
                    
                    <right> ดาวน์โหลดไฟล์รับข่าวสารเพิ่มเติม <a href="../lib/myfile/<?php echo $FilesName[$i];?>"> <font face="Tahoma" size="2" color="green">  คลิก!! </font> </a> </right>
                
                    <?php }else{?>
                    
                    
                     <?php }?>
                    
                </div>
             </div>
        </div>
    		
  
  <tr>
    <td><hr size="1" color="#CCCCCC" /></td>
  </tr>
    <?php } ?>
</table>

<br />
<br />