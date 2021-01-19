<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
$ses_userid = $_SESSION['ses_userid'];
$member_no = $_SESSION['ses_member_no'];
if ($ses_userid <> session_id() or $member_no == "") {
    header("Location: index.php");
}
require "../include/conf.conn.php";
require "../include/conf.c.php";
require "../include/lib.Etc.php";
require "../include/lib.Oracle.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="../img/logo_etc.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <?php require "../include/conf.d.php" ?>

    <script langauge="javascript">
        function checkconfirmclosewindow() {
            if (true) {
                window.close();
            }
        }

        function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>
    <style type="text/css">
        @page {
            size: auto;
            /* auto is the current printer page size */
            margin: 5mm;
            /* this affects the margin in the printer settings */

        }

        body {
            background-color: #FFFFFF;
            border: solid 0px black;
            margin: 0.2px;
            /* the margin on the content before printing */

        }

        body,
        td,
        th {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000;
        }
    </style>
</head>

<body>
    <?php
    function getMname($mn)
    {
        $thai_months = array("01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน", "05" => "พฤษภาคม", "06" => "มิถุนายน", "07" => "กรกฏาคม", "08" => "สิงหาคม", "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");
        return $thai_months[$mn];
    }
    ?>
    <table width="100%" border="0" cellspacing="1" cellpadding="6">
        <tr>
            <td align="right">
                <form id="form3" name="form1" method="post" action="">
                    <input name="b_print2" type="button" class="ipt; button1" onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์" />
                    <input name="aa2" type="submit" id="aa3" value="ปิด" onclick="checkconfirmclosewindow()" class="button2" />
                </form>
            </td>
        </tr>
    </table>
    <?php
    require "../s/s.member_info.php";
    require "../s/s.share.php";
    require "../s/s.payment_etc.php";
    ?>
    <div id="div_print1">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">
                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                        <tr>
                            <td align="right">โทร 089-9524343</td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="3" cellpadding="0">
                                    <tr>
                                        <td align="right" valign="top">
                                            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                <tr>
                                                    <td width="20%" height="80" align="center">
                                                        <font face='Tahoma' size="5"><strong>
                                                                <img src="../img/logo_etc.png" alt="" width="90" height="90"></strong></font><br />
                                                    </td>
                                                    <td width="80%" align="center">
                                                        <!--<font face='Tahoma' size="5"><strong><?//=$titles?></strong></font><br/>-->
                                                        <font face='Tahoma' size="5"><strong>ใบเสร็จรับเงิน</strong></font><br>
                                                        <font face='Tahoma' size="5"><strong>สมาคม ฌาปนกิจสงเคราะห์</strong></font><br>
                                                        <font face='Tahoma' size="5"><strong>สหกรณ์ออมทรัพย์สาธารณสุขเชียงราย - พะเยา</strong></font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table width="100%" border="0" cellspacing="2" cellpadding="1">
                                                <tr>
                                                    <td width="16%"><strong>วันที่</strong></td>
                                                    <td width="40%"><?= substr($receipt_date, 0, 2) . ' ' . getMname(substr($receipt_date, 3, 2)) . ' ' . substr($receipt_date, 6, 4) ?> </td>
                                                    <?php if ($Num_Rows4 !=  0) {
                                                        $jcoll = 0    ?>
                                                        <td rowspan="4" style="vertical-align: top;">
                                                            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                                                                <tr>
                                                                    <td width="50%"><strong>ผู้รับผลประโยชน์</strong></td>
                                                                </tr>
                                                                <?php for ($coll_i = 0; $coll_i < ($Num_Rows4 / 2); $coll_i++) { ?>
                                                                    <tr>
                                                                        <td><?= $coll[$jcoll++] ?></td>
                                                                        <td><?= $coll[$jcoll++] ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td><strong>ได้รับเงินจาก</strong></td>
                                                    <td><?= $full_name ?> </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>หน่วยงาน</strong>&nbsp;&nbsp;</td>
                                                    <td><?= $membgroup_code ?> - <?= $membgroup ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>เลขทะเบียนสหกรณ์</strong></td>
                                                    <td><?= $member_no ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <hr size="1" color="#CCCCCC">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table width="100%" border="0" cellspacing="6" cellpadding="1">
                                                <tr>
                                                    <td width="7%" align="center"><strong>ลำดับที่</strong></td>
                                                    <td width="50%" align="center"><strong>รายการ</strong></td>
                                                    <!--<td width="7%" align="center"><strong>งวดที่</strong></td>
                  <td width="10%" align="right"><strong>เงินต้น</strong></td>
                  <td width="10%" align="right"><strong>ดอกเบี้ย</strong></td>-->
                                                    <td width="13%" align="center"><strong>รวมเงิน</strong></td>


                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <hr size="1" color="#CCCCCC">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table width="100%" border="0" cellspacing="4" cellpadding="1">
                                                <?php for ($i = 0; $i < $Num_Rows; $i++) { ?>
                                                    <tr>
                                                        <td width="7%" align="center"><?= ($i + 1) . '. ' ?></td>
                                                        <td width="50%" align="left"><?= $keepothitemtype_desc[$i] ?></td>
                                                        <td width="7%" align="center"></td>
                                                        <td width="10%" align="right"></td>
                                                        <td width="10%" align="right"></td>
                                                        <td width="13%" align="right"><?= number_format($item_payment[$i], 2) ?></td>

                                                    </tr>
                                                <?php } ?>
                                                <tr style="display:none">
                                                    <td colspan="7" align="left" valign="middle">
                                                        <?php for ($i = 0; $i < $Num_Rows2; $i++) { ?>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $coll_desc[$i] ?><?= $coll_member_no[$i] ?><br>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" align="center" valign="middle">
                                                        <hr size="1" color="#CCCCCC">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="30" colspan="4" align="center" valign="middle"><strong>( - <?= convertthai($totalpayment - $payment_a) ?> - )</strong></td>
                                                    <td align="right" valign="middle"><strong>ยอดสุทธิ</strong></td>
                                                    <td width="13%" align="right" valign="middle"><strong><?= number_format($totalpayment - $payment_a, 2) ?></strong></td>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <hr size="1" color="#CCCCCC"><br></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table width="95%" cellspacing="3" cellpadding="1">
                                                <tr>
                                                    <td align="center" valign="middle">
                                                        <img src="../img/mg_etc.png" height="75">
                                                    </td>
                                                    <td width="17%" align="center" valign="middle">&nbsp;</td>
                                                    <td align="center" valign="middle">
                                                        <img src="../img/fn_etc.png" height="75">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php if ($printcollno == 0) { ?>
                            <?php require "../s/s.ref_collno.php"; ?>
                            <?php if ($Num_Rows != 0) { ?>
                                <tr>
                                    <td>
                                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="left"><strong>
                                                        <fontface="Tahoma">ข้อมูลการค้ำประกัน</font>
                                                    </strong><br />
                                            </tr>
                                        </table><br>
                                        <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="13%" align="center" style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;"><strong>คุณค้ำใคร</strong></td>
                                                <td width="88%">
                                                    <table width="100%" cellspacing="1" cellpadding="5" style="border-collapse: collapse;">
                                                        <tr style="border: 1px solid black;">
                                                            <td width="20%" align="center" style="border: 1px solid black;">สัญญาเลขที่</td>
                                                            <td width="56%" align="center" style="border: 1px solid black;">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
                                                            <td width="24%" align="center" style="border: 1px solid black;">ยอดคงเหลือ</td>
                                                        </tr>
                                                        <?php for ($a = 0; $a < $Num_Rows; $a++) { ?>
                                                            <tr style="border: 1px solid black;">
                                                                <td align="center" style="border: 1px solid black;"><?= $coll_loan[$a] ?></td>
                                                                <td align="left" style="border: 1px solid black;"><?= $coll_name[$a] ?></td>
                                                                <td align="right" style="border: 1px solid black;"><?= $coll_balance[$a] ?> บาท</td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php } ?> <br />
                                    <?php if ($Num_Rows1 != 0) { ?>
                                        <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="13%" align="center" style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;"><strong>ใครค้ำคุณ</strong></td>
                                                <td width="88%">
                                                    <table width="100%" cellspacing="1" cellpadding="5" style="border-collapse: collapse;">
                                                        <tr style="border: 1px solid black;">
                                                            <td width="20%" align="center" style="border: 1px solid black;">สัญญาเลขที่</td>
                                                            <td width="56%" align="center" style="border: 1px solid black;">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
                                                            <td width="24%" align="center" style="border: 1px solid black;">ยอดคงเหลือ</td>
                                                        </tr>
                                                        <?php for ($b = 0; $b < $Num_Rows1; $b++) { ?>
                                                            <tr style="border: 1px solid black;">
                                                                <td align="center" valign="middle" bgcolor="#FFFFFF" style="border: 1px solid black;"><?= $coll_loan_r[$b] ?></td>
                                                                <td align="left" valign="top" bgcolor="#FFFFFF" style="border: 1px solid black;">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <?php require "../s/s.ref_collno1.php"; ?>
                                                                        <?php for ($c = 0; $c < $Num_Rows2; $c++) { ?>
                                                                            <tr>
                                                                                <td align="left"><?= $who_coll_name[$c] ?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                </td>
                                                                <td align="right" bgcolor="#FFFFFF" style="border: 1px solid black;"><?= $principal_balance[$b] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                <?php }
                                } ?>
                                <tr>
                                    <td align="center"><br><strong><?php
                                                                    echo "พิมพ์เมื่อวันที่  " . date("Y-m-d") . " : " . date('H:i:s', strtotime(date("H:i:s") . ' +300 minutes'));
                                                                    ?></strong><br></td>
                                </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
    </div>
</body>

</html>