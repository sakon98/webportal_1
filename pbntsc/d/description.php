<?php require 'header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <h3><i class="fa fa-chevron-circle-right"></i> ขั้นตอนการใช้งาน</h3>
                <ol>
                    <li>การสมัครใช้บริการ / ลงทะเบียนสมาชิก
                        <ol>
                            <li>ที่หน้าแรกของเว็บไซต์ คลิกที่ลิ้งค์ "สมัครใช้บริการ"  ที่อยู่ด้านล่างแบบฟอร์มสำหรับเข้าสู่ระบบ</li>
                            <li>ในหน้าถัดมา ให้สมาชิกกรอกเลขที่สมาชิกจำนวน 6 หลัก ลงในช่อง "เลขทะเบียนสมาชิก" และกรอกเลขที่บัตรประชาชน ลงในช่อง<br>"เลขที่บัตรประชาชน"
                                ให้ถูกต้องและครบถ้วน</li>
                            <li>คลิกเลือกที่ช่อง "ข้าพเจ้ายอมรับเงื่อนไขทั้งหมด" เสร็จแล้วกดปุ่ม "ตกลง"</li>
                            <li>ในหน้าจอถัดมา ระบบจะทำการดึงข้อมูลชื่อ - สกุล ของสมาชิกขึ้นมาให้อัตโนมัติ จากนั้นให้สมาชิกใส่ข้อมูลเบอร์โทรศัพท์ที่สามารถ<br>ติดต่อได้ลงในช่อง "มือถือ"
                                และกรอกข้อมูล Email (ถ้ามี) เพื่อรับข้อมูลข่าวสารสมาชิก</li>
                            <li>กำหนดรหัสผ่านลงในช่อง "รหัสผ่าน" และใส่รหัสผ่านซ้ำอีกครั้งในช่อง "ยืนยันรหัสผ่าน" จากนั้นคลิกที่ปุ่ม "ตกลงสมัคร" เป็นอันเสร็จ<br>เรียบร้อย</li>
                        </ol>
                    </li>
                    <li>การลงชื่อเข้าสู่ระบบ
                        <ol>
                            <li>ที่หน้าแรกของเว็บไซต์ กรอกเลขที่ทะเบียนสมาชิกลงในช่อง "ทะเบียนสมาชิก"</li>
                            <li>กรอกรหัสผ่านลงในช่อง "รหัสผ่าน"</li>
                            <li>จากนั้น คลิกที่ปุ่ม "เข้าสู่ระบบ" หากข้อมูลถูกต้องจะพบกับเมนูสำหรับผู้ใช้งานปรากฏขึ้นมา</li>
                        </ol>
                    </li>
                </ol>    
                <br><br>
                <div class="form-group">
                    <div class="col-md-12">
                        <a href="index.php" class="btn btn-primary" role="button">ลงชื่อเข้าใช้งานระบบ</a>
                        <a href="register.php" class="btn btn-primary" role="button">สมัครใช้บริการ</a>
                    </div>              
                </div>
            </div>
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
