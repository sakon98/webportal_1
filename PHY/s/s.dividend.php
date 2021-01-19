<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(YRDIVMASTER.DIV_YEAR) AS MAXDIV ,MIN(YRDIVMASTER.DIV_YEAR) AS MINDIV 
				FROM YRDIVMASTER,YRCFRATE 
				WHERE YRDIVMASTER.DIV_YEAR  = YRCFRATE.DIV_YEAR 
				AND YRCFRATE.WEBSHOW_FLAG = 1  
				AND YRDIVMASTER.MEMBER_NO = '$member_no' ";
	$value = array('MAXDIV','MINDIV');
	list($NumDIV,$listslip) = get_value_many_oci($strSQL,$value);	
	$maxdiv	 =  $listslip[0][0];   				
	$mindiv =  $listslip[0][1];		

	if($_REQUEST["divyear"] == ""){
		$divyear = $maxdiv;
	}else{
		$divyear = $_REQUEST["divyear"];
	}		
	
	$strSQL = "SELECT 
						TO_CHAR(DECODE(DIV_AMT,0,null,DIV_AMT),'99G999G999G999D00') AS DIV_BALAMT ,
						TO_CHAR(DECODE(AVG_AMT,0,null,AVG_AMT),'99G999G999G999D00') AS AVG_BALAMT ,
						TO_CHAR(DECODE(ETC_AMT,0,null,ETC_AMT),'99G999G999G999D00') AS ETC_BALAMT ,
						TO_CHAR(DECODE((DIV_AMT+AVG_AMT+ETC_AMT),0,null,(DIV_AMT+AVG_AMT+ETC_AMT)),'99G999G999G999D00') AS SUMDIV
					FROM 
						YRDIVMASTER 
					WHERE 
						MEMBER_NO = '$member_no'
						AND DIV_YEAR = '$divyear' ";
	$value = array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUMDIV');
	list($Num_div,$slip_show) = get_value_many_oci($strSQL,$value);
	$div_balamt = $slip_show[0][0]; 
	$avg_balamt = $slip_show[0][1];
	$etc_balamt = $slip_show[0][2];
	$sumdiv = $slip_show[0][3];

	if($Num_div  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	$strSQL1 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'";
	$value1 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID');
	list($Num_div1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
	//echo $Num_div1;
	$typepay = $slip_show1[0][0]; 
	$totalpay = $slip_show1[0][1]; 
	$bank_desc = $slip_show1[0][2]; 
	$bank_acc = $slip_show1[0][3]; 
	
	/// select ปันผล ใหม่
	
	 $strSQL3 = "select
y.div_year
,((y.div_amt + y.avg_amt + y.etc_amt) - nvl(lon.pay_amt,0) - nvl(cmt.pay_amt,0) - nvl(cma.pay_amt,0) - nvl(cso.pay_amt,0) - nvl(csa.pay_amt,0) - nvl(cnt.pay_amt,0)) as sumnet
,y.div_amt
,y.div_balamt
,y.avg_amt
,y.avg_balamt
,y.etc_amt
,y.etc_balamt
,y.item_balamt
,nvl(lon.pay_amt,0) as LON
,nvl(cmt.pay_amt,0) as CMT
,nvl(cma.pay_amt,0) as CMA
,nvl(cso.pay_amt,0) as CSO
,nvl(csa.pay_amt,0) as CSA
,nvl(cnt.pay_amt,0) as CNT
,nvl(dep.expense_accid,'') as DEP
from yrbgmaster ybg
,yrdivmaster y
,yrcfrate yr
,mbucfmembgroup mga
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'LON' and b.paytype_code = 'VAL') lon
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'CMT' and b.paytype_code = 'VAL') cmt
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'CMA' and b.paytype_code = 'VAL') cma
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'CSO' and b.paytype_code = 'VAL') cso
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'CSA' and b.paytype_code = 'VAL') csa
,(select a.div_year,a.member_no,b.pay_amt from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'CNT' and b.paytype_code = 'VAL') cnt
,(select a.div_year,a.member_no,b.expense_accid from yrreqmethpay a,yrreqmethpaydet b where a.methreq_docno = b.methreq_docno and b.methpaytype_code = 'DEP' and b.paytype_code = 'ALL') dep
where ybg.coop_id =  y.coop_id(+)
and ybg.div_year = y.div_year(+)
and ybg.member_no = y.member_no(+)
and y.div_year = yr.div_year(+)
and ybg.membgroup_code = mga.membgroup_code
and trim(ybg.div_year) = trim(lon.div_year(+))
and ybg.member_no = lon.member_no(+)
and ybg.div_year = cmt.div_year(+)
and ybg.member_no = cmt.member_no(+)
and ybg.div_year = cma.div_year(+)
and ybg.member_no = cma.member_no(+)
and ybg.div_year = cso.div_year(+)
and ybg.member_no = cso.member_no(+)
and ybg.div_year = cnt.div_year(+)
and ybg.member_no = cnt.member_no(+)
and ybg.div_year = csa.div_year(+)
and ybg.member_no = csa.member_no(+)
and ybg.div_year = dep.div_year(+)
and ybg.member_no = dep.member_no(+)
and trim(ybg.div_year) =  trim('$divyear')
and trim(ybg.member_no) = trim('$member_no') ";
	//echo($strSQL3);
	$value3 = array('DIV_YEAR','SUMNET','DIV_AMT','DIV_BALAMT','AVG_AMT','AVG_BALAMT','ETC_AMT','ETC_BALAMT','ITEM_BALAMT','LON','CMT','CMA','CSO','CSA','DEP','CNT');
	list($Num_div3,$slip_show3) = get_value_many_oci($strSQL3,$value3);
	$div_year = $slip_show3[0][0]; 
	$sumnet = $slip_show3[0][1];
	$div_amt = $slip_show3[0][2];
	$div_balamt = $slip_show3[0][3];
	$avg_amt = $slip_show3[0][4];
	$avg_balamt = $slip_show3[0][5];
	$etc_amt = $slip_show3[0][6];
	$etc_balamt = $slip_show3[0][7];
	$item_balamt = $slip_show3[0][8];
	$lon = $slip_show3[0][9];
	$cmt = $slip_show3[0][10];
	$cma = $slip_show3[0][11];
	$cso = $slip_show3[0][12];
	$csa = $slip_show3[0][13];
	$dep = $slip_show3[0][14];
	$cnt = $slip_show3[0][15];
	
	$sull_all = $div_amt + $avg_amt + $etc_amt;
	$sull_cut = $lon + $cmt + $cma + $cso + $csa + $cnt;
	
	if($Num_div3  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	
	


?>

