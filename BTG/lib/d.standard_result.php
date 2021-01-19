<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script src="/js/pdfobject.js"></script>

<?php   require "../include/jquery.popup.php";   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">�š�èѴ�ҵðҹ</font></strong><br />
      <font face="Tahoma" size="2" color="#0000FF">Standard_Result</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/s.upload.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($h=0;$h<$Num_Rows4;$h++){ ?>
  <tr>
    <td width="98%" align="left" valign="top"><a href="../d/myfile_standard/<?php echo $filesname_standard[$h];?>"><font face="Tahoma" size="2"> --> <?php echo $file_topic_standard[$h]?> </font></td>
  </tr>
    <?php } ?>
</table>
<br />
<br />