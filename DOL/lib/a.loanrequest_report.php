<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<?php date_default_timezone_set("Asia/Bangkok"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>

<?php
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$member_no = $_POST['member_no'];
$loanrequest_status  = $_POST['loanrequest_status'];
?>

<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="5" align="left"><strong>
                <font size="4" face="Tahoma">รายงานรายละเอียดขอกู้</font>
            </strong></td>
    </tr>
    <tr>
        <td colspan="5" align="left">
            <font color="#0000FF" size="2" face="Tahoma">Loan Request Report</font>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left">
            <hr color="#999999" size="1" />
        </td>
        <td><br><br></td>
    </tr>
    <table width="65%" border="0" align="right" cellpadding="0" cellspacing="0" style="padding-right: 3%;">
        <form id="FORM01" name="FORM01" method="post" action="">
            <tr>
                <td align="right" width="40%">วันที่ : </td>
                <td align="center"><input style="width: 90%; margin-bottom: 5%;" type="date" name="date1" value="<?= $_REQUEST["date1"] ?>"></td>
                <td align="right" width="20%">ถึงวันที่ : </td>
                <td align="center"><input style="width: 90%; margin-bottom: 5%;" type="date" name="date2" value="<?= $_REQUEST["date2"] ?>"></td>
                <td rowspan="2" width="20%"><input type="submit" id="submit" name="submit" value="ดึงข้อมูล" /></td>
            </tr>
            <tr>
                <td align="right">เลขทะเบียน : </td>
                <td align="center"><input style="width: 90%;" type="text" name="member_no" value="<?= $_REQUEST["member_no"] ?>"></td>
                <td align="right">สถานะ : </td>
                <td align="center">
                    <select style="width: 90%;" name="loanrequest_status" onchange="changView()" value="<?= $_REQUEST["loanrequest_status"] ?>">
                        <option value="0" <?= $_REQUEST["loanrequest_status"] == 0 ? "selected" : "" ?>>0 : รอลงรับ
                        </option>
                        <option value="8" <?= $_REQUEST["loanrequest_status"] == 8 ? "selected" : "" ?>>8 : ลงรับ
                        </option>
                        <option value="1" <?= $_REQUEST["loanrequest_status"] == 1 ? "selected" : "" ?>>1 : อนุมัติ
                        </option>
                        <option value="-9" <?= $_REQUEST["loanrequest_status"] == -9 ? "selected" : "" ?>>-9 : ยกเลิก
                        </option>
                    </select>
                </td>
            </tr>
        </form>
    </table>
</table>
<br>

<?php
if ($date1 != "" && $date2 != "") {

    $sqlshow = "and cast(ml.entry_date AS date) between str_to_date('$date1','%Y-%m-%d') and str_to_date('$date2','%Y-%m-%d')";
}

if ($member_no != "") {

    $sqlshow .=  " and ml.member_no = '$member_no'";
}

if ($_POST["submit"] == "ดึงข้อมูล") {
    $sql = "select 
            concat(concat(concat(concat(substr(date_format(ml.entry_date,'%d%m%Y'),1,2),'/'),substr(date_format(ml.entry_date,'%d%m%Y'),3,2)),'/'),substr(date_format(ml.entry_date,'%d%m%Y'),5,4) +543) as entry_date,
            ml.member_no as member_no_show,
            mb.memb_fullname as memb_fullname,
            (case when ml.loantype_code = '11' then 'สามัญปกติ'
                when ml.loantype_code = '12' then 'สามัญหุ้นค้ำ'
                when ml.loantype_code = '17' then 'สามัญหุ้นค้ำ(สมทบ)'
                when ml.loantype_code = '19' then 'เงินสงเคราะห์ล่วงหน้า'
                when ml.loantype_code = '21' then 'ฉุกเฉิน'
                when ml.loantype_code = '22' then 'ฉุกเฉินสมทบ'
                when ml.loantype_code = '73' then 'เพื่อการศึกษา'
            else '' end) as loantype_code,
            ml.loanrequest_amt as loanrequest_amt,
            (case when ml.loanrequest_status = 0 then 'รอลงรับ'
                when ml.loanrequest_status = 1 then 'ลงรับ'
                when ml.loanrequest_status = 8 then 'อนุมัติ'
                when ml.loanrequest_status = -9 then 'ยกเลิก'
            else '' end) as loanrequest_status_show
            from mdbreqloan ml left join webmbmembmaster mb on ml.member_no = mb.member_no
            where ml.loanrequest_status = '$loanrequest_status' ";
    $sql = $sql . $sqlshow;
    $sql .=  " order by ml.entry_date,ml.member_no,ml.loanreq_docno";
    $value = array('entry_date', 'member_no_show', 'memb_fullname', 'loantype_code', 'loanrequest_amt', 'loanrequest_status_show');
    list($Num_Rows, $list_info) = get_value_many_sql($sql, $value);
    $j = 0;
    for ($i = 0; $i < $Num_Rows; $i++) {
        $entry_date[$i]                 =       $list_info[$i][$j++];
        $member_no_show[$i]             =       $list_info[$i][$j++];
        $memb_fullname[$i]              =       $list_info[$i][$j++];
        $loantype_code[$i]              =       $list_info[$i][$j++];
        $loanrequest_amt[$i]            =       $list_info[$i][$j++];
        $loanrequest_status_show[$i]    =       $list_info[$i][$j++];
        $j = 0;
    }
}
?>
<div class="MyTable" id="MyTable">
    <title>รายงานรายละเอียดขอกู้</title>

    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <THEAD>
            <tr>
                <td><br><br></td>
            </tr>
            <tr colspan="6">
                <td colspan="6" align="center">
                    <h2><strong>รายงานรายละเอียดขอกู้</strong></h2>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center">
                    <?php if ($date1 != "" && $date2 != "") { ?>
                        <h3 style="font-weight: normal;">วันที่ : <?php echo date(("d/m") . "/" . (date("Y", strtotime($date1)) + 543), strtotime($date1)) ?> ถึงวันที่ : <?php echo date(("d/m") . "/" . (date("Y", strtotime($date2)) + 543), strtotime($date2)) ?></h3>
                    <?php } ?>
                    <?php if ($member_no != "") { ?>
                        <h3 style="font-weight: normal;">เลขทะเบียน : <?php echo $member_no ?></h3>
                    <?php } ?>
                </td>
            </tr>
            <tr class="table_th" style="height: 25px;">
                <th width="10%">วันที่บันทึก</th>
                <th width="10%">เลขทะเบียน</th>
                <th width="25%">ชื่อสกุล</th>
                <th width="20%">ประเภทเงินกู้</th>
                <th width="15%">วงเงินกู้</th>
                <th width="15%" style="border-right-style: solid;">สถานะ</th>
            </tr>
        </THEAD>
        <?php for ($i = 0; $i < $Num_Rows; $i++) { ?>
            <tr class="table_td" style="height: 22px;">
                <td align="center"><?= $entry_date[$i] ?></td>
                <td align="center"><?= $member_no_show[$i] ?></td>
                <td><?= $memb_fullname[$i] ?></td>
                <td><?= $loantype_code[$i] ?></td>
                <td align="right"><?= number_format($loanrequest_amt[$i], 2) ?></td>
                <td align="center" style="border-right-style: solid;"><?= $loanrequest_status_show[$i] ?></td>
            </tr>
        <?php } ?>
        <tfoot>
            <tr>
                <td>
                    <br><br><br><br>
                </td>
            </tr>
        </tfoot>
    </table>
    <style>

        @media print {

            body,
            td,
            th {
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 12px;
            }

            /* td {
                background-color: #000000;
            } */

            .table_th th {
                text-align: center;
                background-color: #6699FF;
                color: #FFFFFF;
                border: solid 1px #000000;
                border-right-style: none;
            }

            .table_td td {
                background-color: #FFFFFF;
                padding-left: 5px;
                padding-right: 5px;
                border: solid 1px #000000;
                border-right-style: none;
                border-top-style: none;
            }

            p strong {
                font-size: 18px;
            }
        }
    </style>
</div>
<br>
<a onclick="printContent('MyTable')" style="float: right; margin-right: 22px;"><img src="../img/print_icon.jpg"></a>

<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        location.reload();
    }

    function changView() {
        document.getElementById("loanreq_docno").value = "";
        document.getElementById("formID1").submit();
    }
</script>

<style>
    .table_th th {
        text-align: center;
        background-color: #6699FF;
        color: #FFFFFF;
        border: solid 1px #000000;
        border-right-style: none;
    }

    .table_td td {
        background-color: #FFFFFF;
        padding-left: 5px;
        padding-right: 5px;
        border: solid 1px #000000;
        border-right-style: none;
        border-top-style: none;
    }

    div.MyTable {
        height: 450px;
        overflow: auto;
    }
</style>