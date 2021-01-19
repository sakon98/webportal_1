<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
require "../include/lib.Etc.php";
require "../include/lib.Oracle.php";
require "../include/lib.MySql.php";
$connectby = "desktop";
?>
<?php require "header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <?php if ($_POST["agree"] != "agree") { ?>
                    <h3><i class="fa fa-chevron-circle-right"></i> เงื่อนไขและข้อตกลงในการสมัครสมาชิก</h3>
                    <p style="padding-left: 35px;">1.การเข้าใช้งานระบบข้อมูลสมาชิกจะต้องทำการสมัครเข้าใช้งานระบบและต้องเป็นสมาชิกของ เท่านั้น </p>
                    <p style="padding-left: 35px;">2.เพื่อความเรียบร้อยในการสมัครใช้งาน ระบบฯ และเพื่อยืนยันผู้สมัคร กรุณาทำตามขั้นตอนที่ระบบแนะนำ </p>
                    <p style="padding-left: 35px;">3.หากปรากฏว่า ชื่อหรือหมายเลขสมาชิก ของท่านได้มีการสมัครใช้งานแล้ว โดยท่านไม่ทราบ หรือทำการสมัครด้วยตัวท่านเอง กรุณาแจ้งเจ้าหน้าที่เพื่อทำการตรวจสอบความถูกต้อง ต่อไปกรุณาเก็บรักษา username / password ของท่าน</p>
                    <p style="padding-left: 35px;">4.เพื่อสิทธิและความปลอดภัยในข้อมูลของท่านเองหากปรากฏว่ามีบุคคลแอบอ้าง สมัครใช้งานระบบและเจ้าหน้าที่ตรวจสอบแล้วจะทำการลบรายชื่อนั้นๆ ออกจากระบบ โดยไม่ต้องแจ้งให้ทราบ </p>
                    <p style="padding-left: 35px;">5.ข้อมูลของสมาชิก ในระบบจะทำการปรับปรุงข้อมูล หากสมาชิกท่านใดพบข้อมูลไม่ตรงหรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่</p>
                    <p style="padding-left: 35px;">6.ข้าพเจ้าได้อ่านข้อตกลงดังกล่าวแล้ว และยินยอมในเงื่อนไขต่าง ๆ ที่ทาง สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ กำหนดไว้</p>
                    <br>
                    <br>
                    <form name="formID1" id="formID1" method="post" action="" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputmember" class="col-lg-2 control-label text-right">เลขทะเบียนสมาชิก :</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="member_no" id="member_no" maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputidcard" class="col-lg-2 control-label text-right">เลขที่บัตรประชาชน :</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" id="idchk" name="idchk" maxlength="13" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-3">
                                    <div class="checkbox">
                                        <label>
                                            <input name="agree" type="checkbox" value="agree" required>
                                            ข้าพเจ้ายอมรับเงื่อนไงทั้งหมด</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="Submit" id="button" class="btn btn-default">ตกลง</button>
                                    <button type="reset" class="btn btn-default" onclick="location.href = 'index.php'">ยกเลิก</button>
                                    <input name="ref" type="hidden" id="ref" value="checkuser" />
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                <?php
            } else {
                require "../s/s.member_info_1.php";
                //echo $card_person;
                //echo $Num_Rows;
                $register_status = true;
                if ($Num_Rows == 0) { // ไม่พบทะเบียน 
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }

                if ($countmemb > 0 or $countidcard > 0) { // เคยสมัครแล้ว
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านเคยสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }

                if ($card_person != $idchk) { // เลขบัตรไม่ถูกต้อง
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ทะเบียนสมาชิกหรือเลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบ") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }


                if ($register_status) {//เริ่มการสมัคร
                    ?>
                    <form action="" method="post" id="formID2">
                        <h3><i class="fa fa-chevron-circle-right"></i> ข้อมูลสมาชิก</h3>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">เลขทะเบียนสมาชิก :</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="memb_no" name="memb_no"  value="<?= $member_no ?>" size="10" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">ชื่อ-สกุล :</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="memb_fullname" name="memb_fullname"  value="<?= $full_name ?>"  maxlength="13" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">เลขที่บัตรประชาชน :</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="idcard1" name="idcard1"  value="<?= $card_person ?>"  maxlength="13" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">มือถือ :</label>
                            <div class="col-lg-3">
                                <?php if ($mobile_register == 1) { ?>
                                    <input type="text" class="form-control validate[required,minSize[10]]" id="mobile1" name="mobile1"  value="<?= $mobile ?>"   required >
                                <?php } else { ?> 
                                    <input type="text" class="form-control validate[required,minSize[10]]" id="mobile1" name="mobile1"  value="<?= $mobile ?>"  >
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">Email :</label>
                            <div class="col-lg-3">
                                <?php if ($email_register == 1) { ?>
                                    <input type="email" class="form-control" id="email1" name="email1"  value="<?= $email ?>" >
                                <?php } else { ?> 
                                    <input type="email" class="form-control" id="email1" name="email1"  value="<?= $email ?>" >
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">รหัสผ่าน  :</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control validate[minSize[8]]" id="pwd_r" name="pwd_r"  maxlength="16"  required >
                            </div>
                            <div class="col-lg-4">
                                <p>กำหนดรหัสผู้ใช้อย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 16 ตัวอักษร</p>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label  class="col-lg-2 control-label text-right">ยืนยันรหัสผ่าน :</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control validate[minSize[8]]" id="pwd_r1" name="pwd_r1"  maxlength="16" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" name="button"  id="button2" class="btn btn-default">ตกลง</button>
                                <button type="reset" class="btn btn-default" id="button3" name="button3">ยกเลิก</button>
                                <input name="reg" type="hidden" id="reg" value="done">
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
            <?php
            if ($_POST["reg"] == "done") {
                require "../s/s.register.php";
            }
            ?>   
        </div>
    </div>

    <?php require "footer.php"; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</div>
</body>
</html>
