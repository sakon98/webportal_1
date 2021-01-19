

<?php
//require('../include/conf_connection.php');
//require('../include/lib.Oracle.php');

/*function get_single_value_oci($strSQL,$value){  	// ถึงข้อมูล Single จาก database		
        GLOBAL $objConnect; 
        $stmt = oci_parse($objConnect, $strSQL );
        @oci_execute($stmt);
        while ($row = @oci_fetch_assoc($stmt)) {   
            return $row[$value];
        }           
    } 

    function get_value_many_oci($strSQL,$colunm=array()){     // ถึงข้อมูล Mulit จาก database
        $value=array();
        GLOBAL $objConnect;  
        $objParse = oci_parse ($objConnect, $strSQL);
        @oci_execute ($objParse,OCI_DEFAULT);
        $Num_Rows = @oci_fetch_all($objParse, $Result);       
        for($i=0;$i<$Num_Rows;$i++){
            for($j=0;$j<count($colunm);$j++){
                $value[$i][$j] =  $Result[$colunm[$j]][$i];
            }     
        }    
        return array($Num_Rows,$value);
    } */

	
$member_no = $_POST["member_no"];
$loancontract_no = (isset($_POST["loancontract_no"]) ? $_POST["loancontract_no"] : []);
$ldc_sumloan = 0;

foreach($loancontract_no as $value){
 
	$IPSERVER = '10.100.100.3';
	$SERVICEDB = 'iorcl';
	$USER = 'iscodol_last';
	$PASSWORD = 'iscodol_last';

    $objConnect2 = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect2){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อฐานข้อมูลได้") </script> ';
    }
    
      $query = "select lm.loanpay_code,
                                                        ft_RoundMoney(((lm.principal_balance * ft_getcontintrate( lm.coop_id, lm.loancontract_no, lm.lastcalint_date ))/ 100) * (30 / 365), '012001', 'LON', 'loanint') as intestimate_amt,
                                                        ln.loanpayment_type,
                                                        lm.period_payment,
                                                        nvl(cm.salarybal_amt,0) as salarybal_amt
                                                        from lncontmaster lm , lnloantype ln , cmucfsalarybalance cm
                                                        where lm.loantype_code = ln.loantype_code 
                                                        and ln.salarybal_code = cm.salarybal_code(+)
                                                        and	lm.member_no = '$member_no' 
                                                        and lm.contract_status > 0 
                                                        and lm.loancontract_no = '$value'";

                                $cursor = ociparse($objConnect2, $query); 
                                $result = ociexecute($cursor);


                                while (ocifetchInto($cursor, $values)) {
                                    
                                     $loanpay_code = $values[0];  
                                     $intestimate_amt = $values[1]; 
                                     $loanpayment_type = $values[2]; 
                                     $period_payment = $values[3]; 
                                }
                                        
                                      
                                        
                                        
                                        
                            if ($loanpay_code == "KEP")
                        {
                            if ($loanpayment_type == 0)
                            {
                                 $period_payment = 0;
                              
                            }
                            else if ($loanpayment_type == 1)
                            {
                                 $period_payment += $intestimate_amt;
                              
                            }
                            else if ($loanpayment_type == 3)
                            {
                                 $period_payment = $intestimate_amt;
                               
                            }
                            
                            $ldc_sumloan += $period_payment;

                        }
                        
                    }

echo $ldc_sumloan;

?>