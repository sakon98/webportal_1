<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

	$strSQL = " select id,file_topic,filesname from upload_file order by id desc limit 50 ";
	$value = array('id','file_topic','filesname');
	list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){
		$id[$i]		 =	 $list_info[$i][$j++];
		$file_topic[$i]	 =	 $list_info[$i][$j++];
		$filesname[$i]	 =	 $list_info[$i][$j++];
		$j=0;
	}
	
	 $strSQL1 = " select id_order,file_topic_order,filesname_order from upload_order order by id_order desc limit 50 ";
	$value1 = array('id_order','file_topic_order','filesname_order');
	list($Num_Rows1,$list_info1) = get_value_many_sql($strSQL1,$value1);
	$a=0;
	for($b=0;$b<$Num_Rows1;$b++){
		$id_order[$b]		 =	 $list_info1[$b][$a++];
		$file_topic_order[$b]	 =	 $list_info1[$b][$a++];
		$filesname_order[$b]	 =	 $list_info1[$b][$a++];
		$a=0;
	}
        
        $strSQL2 = " select id_overall,file_topic_overall,filesname_overall from upload_overall order by id_overall desc limit 50 ";
	$value2 = array('id_overall','file_topic_overall','filesname_overall');
	list($Num_Rows2,$list_info2) = get_value_many_sql($strSQL2,$value2);
	$c=0;
	for($d=0;$d<$Num_Rows2;$d++){
		$id_overall[$d]		 =	 $list_info2[$d][$c++];
		$file_topic_overall[$d]	 =	 $list_info2[$d][$c++];
		$filesname_overall[$d]	 =	 $list_info2[$d][$c++];
		$c=0;
	}
        
        $strSQL3 = " select id_consult,file_topic_consult,filesname_consult from upload_consult order by id_consult desc limit 50 ";
	$value3 = array('id_consult','file_topic_consult','filesname_consult');
	list($Num_Rows3,$list_info3) = get_value_many_sql($strSQL3,$value3);
	$e=0;
	for($f=0;$f<$Num_Rows3;$f++){
		$id_consult[$f]		 =	 $list_info3[$f][$e++];
		$file_topic_consult[$f]	 =	 $list_info3[$f][$e++];
		$filesname_consult[$f]	 =	 $list_info3[$f][$e++];
		$e=0;
	}
        
        $strSQL4 = " select id_standard,file_topic_standard,filesname_standard from upload_standard order by id_standard desc limit 50 ";
	$value4 = array('id_standard','file_topic_standard','filesname_standard');
	list($Num_Rows4,$list_info4) = get_value_many_sql($strSQL4,$value4);
	$g=0;
	for($h=0;$h<$Num_Rows4;$h++){
		$id_standard[$h]		 =	 $list_info4[$h][$g++];
		$file_topic_standard[$h]	 =	 $list_info4[$h][$g++];
		$filesname_standard[$h]	         =	 $list_info4[$h][$g++];
		$g=0;
	}
	
	 $strSQL5 = " select id_servicecoop,file_topic_servicecoop,filesname_servicecoop from upload_servicecoop order by id_servicecoop desc limit 50 ";
	$value5 = array('id_servicecoop','file_topic_servicecoop','filesname_servicecoop');
	list($Num_Rows5,$list_info5) = get_value_many_sql($strSQL5,$value5);
	$n=0;
	for($m=0;$m<$Num_Rows5;$m++){
		$id_servicecoop[$m]		 =	 $list_info5[$m][$n++];
		$file_topic_servicecoop[$m]	 =	 $list_info5[$m][$n++];
		$filesname_servicecoop[$m]	         =	 $list_info5[$m][$n++];
		$n=0;
	}
?>

