<?php 
@header('Content-Type: text/html; charset=tis-620'); ?>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>
<?php
$bank_code = $_POST["bank"];
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';
 $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'UTF8');     
$strSQL = "select branch_id,branch_name from cmucfbankbranch where bank_code = '".$bank_code."' ";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
?>
สาขา
<p>
<select name="expense_branch">
<?php
while($objResult = oci_fetch_array($objParse,OCI_BOTH)){
?>
<option value="<?=$objResult["BRANCH_ID"] ?>"><?=$objResult["BRANCH_ID"] ?> - <?=$objResult["BRANCH_NAME"] ?></option>
<?php
}
?>
</select>
</p>