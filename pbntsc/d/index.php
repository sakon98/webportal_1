<?php
session_start();
//header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "desktop";
?>
<?php require "header.php"; ?>
<?php if ($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null) { ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 hidden-xs">
				<div id="carousel-299058" class="carousel slide">
							 <ol class="carousel-indicators">
							<li data-target="#carousel1" data-slide-to="0" class="active"> </li>
						   
						  </ol>
						  <div class="carousel-inner">
							<div class="item active"> <img class="img-responsive"  src="img/img1.jpg"  alt="thumb">
							  <!--<div class="carousel-caption" style="position:absolute; top:-25px; color:#FB5B08"><h4>สหกรณ์มั่งคง เป็นเลิศบริการ บริหารโปร่งใส ใส่ใจสมาชิก</h4></div>-->
							</div>
						  </div>
						  <!--<a class="left carousel-control" href="#carousel-299058" data-slide="prev"><span class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel-299058" data-slide="next"><span class="icon-next"></span></a>-->
					</div>
            </div>
            <div class="col-lg-4 col-md-6 col-md-offset-4 col-lg-offset-0">
                <div class="well">
                    <h3><i class="fa fa-user"></i> ลงชื่อเข้าใช้งานระบบ</h3>
                    <form name="formID1" method="post" action="" class="form-horizontal" >
                        <div class="form-group">
                            <label for="username" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> : เลขทะเบียนสมาชิก</b></label>
                            <div class="input-group">
                                <div class="input-group-addon"></div>
                                <input type="text" class="form-control" name="usr" id="usr" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> : รหัสผ่าน</b></label>
                            <div class="input-group">
                                <div class="input-group-addon"></span></div>
                                <input type="password" class="form-control" name="pwd" id="pwd" required>
                            </div>
                        </div>
                        <p class="text-center">
                            <input type="submit" name="Submit" class="btn btn-default" role="button" value="เข้าสู่ระบบ" >
                            <?php if ($connection == 0) { ?>
                                <a href="register.php" class="btn btn-default" role="button">สมัครใช้บริการ</a></p><br>
                            <?php } ?>

                        </div>
                    </form>
                </div>
            </div>

            <?php require "footer.php"; ?>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <script src="js/jquery-1.11.2.min.js"></script> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 
            <script src="js/bootstrap.min.js"></script>
            <?php
        } else {
            require "../include/lib.Etc.php";
            require "../include/lib.MySql.php";
            require "../include/lib.Oracle.php";
            require "../lib/login.php";
        }
        ?>
    </div>
</body>
</html>