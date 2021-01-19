<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=tis-260" />
	<script src="../js/jquery.js"></script>
	<script>
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			document.getElementById('welcomeDiv').style.display = "block";
			window.print();

			document.body.innerHTML = originalContents;
		}

		function handleEnter(field, event) {
			var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if (keyCode == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
					if (field == field.form.elements[i])
						break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			} else
				return true;
		}
	</script>
	<style type="text/css" media="print">
		@media print {

			#Header,
			#Footer {
				display: none !important;
			}

			h2 {
				font: 30px "angsana New";
				color: #000;
				margin-bottom: 5px;
			}

			table {
				width: 780px;
				height: 50px;
				border: 1px solid #000;
				border-collapse: collapse;
				background: #ffffff;
			}

			th {
				height: 30px;
				padding: 0px 6px;
				font: bold 23px "angsana NEW";
				color: #000;
				background: #f8f8f8;
				border: 1px solid #000;
			}

			td {
				height: 20px;
				padding: 0px 6px;
				font: 23px "angsana NEW";
				color: #000;
				border: 1px solid #000;
				vertical-align: middle;
			}
		}
	</style>
	<style type="text/css" media="screen">
		.maincontent {
			width: 800px;
			height: 300px;
			border: 0px;
			font: 16px "Verdana";
		}

		.subcontent {
			width: 730px;
			height: 30px;
			border: 1px solid #000;
			border-collapse: collapse;
			background: #ffffff;
		}

		.subcontent th {
			height: 30px;
			padding: 5px 6px;
			font: bold 23px "angsana NEW";
			color: #000;
			background: #f8f8f8;
			border: 1px solid #000;
		}

		.subcontent td {
			height: 20px;
			padding: 5px 6px;
			font: 23px "angsana NEW";
			color: #000;
			border: 1px solid #000;
			vertical-align: middle;
		}

		.scrollit {
			overflow: auto;
			height: 500px;
		}
	</style>
</head>

<body>
	<table align="center" class="maincontent">
		<tr>
			<th height="30px" valign="top" align="left">

				<form id="formID1" name="formID1" method="post" action="">
					<table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
						<tr>
							<td align="center"><strong>
									<font size="2" face="Tahoma">กรอกเลขทะเบียนสมาชิก :
										<label for="search"></label>
										<input name="search" type="text" id="search" size="35" placeholder="กรอกเลขทะเบียนสมาชิก" onkeypress="return handleEnter(this, event)" />
										<input type="submit" name="button" id="button" value="ค้นหา" class="button4" />
									</font>
								</strong></td>
						</tr>
					</table>
				</form>
			</th>
		<tr>
			<td colspan=2 valign="top">
				<?PHP if (@$_POST["button"] == "ค้นหา") { ?>

					<?php

					$member_no = $_POST["search"];
					$servername = "localhost";
					$username = "root";
					$password = "WebServer";
					$dbname = "dol";


					$conn = new mysqli($servername, $username, $password, $dbname);
					mysqli_set_charset($conn, "TIS620");

					if ($conn->connect_error) {
					}

					$stmt1 = $conn->prepare("select  
										m.member_no as member_no_user,
										m.memb_fullname as memb_fullname_user
									from webmbmembmaster m where m.member_no = ? ");

					$stmt1->bind_param("s", $member_no);

					//$result = $conn->query($sql);
					$stmt1->execute();
					$resut1 = $stmt1->get_result();

					//$member_no_user = $row1['member_no_user'];
					//$memb_fullname_user = $row1['memb_fullname_user'];
					$sql = "select  
							m.member_no as member_no_user,
							m.memb_fullname as memb_fullname_user
							from webmbmembmaster m where m.member_no = '$member_no' ";

					$value = array('member_no_user', 'memb_fullname_user');
					list($Num_Rows, $list_info) = get_value_many_sql($sql, $value);
					$j = 0;
					for ($i = 0; $i < $Num_Rows; $i++) {
						$member_no_user[$i]                 =       $list_info[$i][$j++];
						$memb_fullname_user[$i]             =       $list_info[$i][$j++];
						$j = 0;
					}

					?>

					<table width="85%" border="0" align="center" cellpadding="1" cellspacing="6">
						<?php while ($row1 = $resut1->fetch_assoc()) { ?>
							<tr>
								<td width="17%" align="right">ทะเบียนสมาชิก :</td>
								<td width="38%" align="left"><?php echo $row1['member_no_user']; ?></td>
								<td width="14%" align="right">ชื่อ - สกุล :</td>
								<td width="31%" align="left"><?php echo $row1['memb_fullname_user']; ?></td>
							</tr>
						<?php } ?>
					</table>
					<br>
					<div id="MyTable">
						<div class='scrollit'>
							<table width="730px" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
								<thead>
									<tr>
										<td><br><br></td>
									</tr>
									<tr>
										<td width="17%" align="center" colspan="2">
											<div id="header1" style="display: none;">ทะเบียนสมาชิก : <?php echo $member_no_user[0]; ?></div>
										</td>
										<!-- <td width="38%" align="left"><?php echo $member_no_user[0]; ?></td> -->
										<td width="14%" align="center" colspan="2">
											<div id="header2" style="display: none;">ชื่อ - สกุล : <?php echo $memb_fullname_user[0]; ?></div>
										</td>
										<!-- <td width="31%" align="left"><?php echo $memb_fullname_user[0]; ?></td> -->
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr class="subcontent">
										<th width="10%"></th>
										<!--<th width="70px">เลขสมาชิก</th>
										<th width="240px">ชื่อ - สกุลสมาชิก</th>-->
										<th width="30%">Date Acess</th>
										<th width="30%">Time Acess</th>
										<th width="30%">Action</th>
									</tr>
								</thead>
								<?PHP
								//$date1 = $date1_day . "/".$date1_month."/".$date1_year_cs;
								$stmt = $conn->prepare("select distinct 
									l.user as user,
									m.memb_fullname as memb_fullname,
									concat(concat(concat(concat(substr(date_format(date_log,'%d/%m/%Y'),1,2),'/'),substr(date_format(date_log,'%d/%m/%Y'),4,2)),'/'),substr(date_format(date_log,'%d/%m/%Y'),7,4) +543) as date_log,
									date_format(l.date_log,'%T') as time,
									(case when l.action_do = 'Change Password' then 'Change Password' 
									when l.action_do = 'Reset Password' then 'Reset Password ' 
									when l.action_do = 'Login' then 'Login'
									when l.action_do = 'Register' then 'Register'
									else '' end)
									as action_do 
									from weblog_action l join webmbmembmaster m on l.user = m.member_no
									where (l.action_do in ('Change Password','Reset Password','Login','Register') and l.user = ?) order by l.date_log desc");

								$stmt->bind_param("s", $member_no);



								//$result = $conn->query($sql);
								$stmt->execute();
								$resut = $stmt->get_result();

								$f = 1;
								$str = "";

								while ($row = $resut->fetch_assoc()) {

									echo "<tr class=subcontent align=center>
											<td><font size=4>$f</font></td>";
									//echo "<td align=center><font size=4>" . $row['user'] . "</font></td>";
									//echo "<td align=left><font size=4>" . $row['memb_fullname'] . "</font></td>";
									echo "<td><font size=4>" . $row['date_log'] . "</font></td>";
									echo "<td><font size=4>" . $row['time'] . "</font></td>";
									echo "<td><font size=4>" . $row['action_do'] . "</font></td>";
									echo "</tr>";

									$f = $f + 1;
								}

								$stmt->close();
								$conn->close();

								?>
								<tfoot style="display: block;">
								</tfoot>
							</table>
						</div>
					<?php } ?>
					<style>
						@media print {

							body,
							td,
							th {
								font-family: Tahoma, Geneva, sans-serif;
								font-size: 14px;
							}

							.subcontent {
								width: 730px;
								height: 30px;
								/* border: 1px solid #000; */
								/* border-collapse: collapse; */
								background: #ffffff;
							}

							.subcontent th {
								height: 30px;
								padding: 5px 6px;
								font: bold 23px "angsana NEW";
								color: #000;
								background: #f8f8f8;
								border: 1px solid #000;
							}

							.subcontent td {
								height: 20px;
								padding: 5px 6px;
								font: 23px "angsana NEW";
								color: #000;
								border: 1px solid #000;
								vertical-align: middle;
							}
						}
					</style>
					</div>
			</td>
		</tr>
		<?PHP if (@$_POST["button"] == "ค้นหา") { ?>
			<tr>
				<td align="right" height="30px">
					<!-- <a href="#" onclick="printDiv('printableArea')"><img src="../img/print_icon.jpg" border="0"></a> -->
					<a onclick="printContent('MyTable')" style="float: right; margin-right: 22px;"><img src="../img/print_icon.jpg"></a>
				</td>
			</tr>
		<?php } ?>
	</table>

</body>

</html>

<script>
	function printContent(el) {
		document.getElementById('header1').style.display = "block";
		document.getElementById('header2').style.display = "block";
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
		location.reload();
	}
</script>

<script>
	// set format / วันที่ เป็น พ.ศ
	/*  $('#search').blur(function(){


	        var search = $('#search').val();
			
			var check = search.length;

			if(check > 0){
	  
	        var d = new Date();
	        var now_year = d.getFullYear();

	        search = search.replace("/", "");
	        search = search.replace("/", "");

	        search = search.trim();
	        var search_day = search.substring(0,4);
	        var search_year = search.substring(4);


	        if(search_year > now_year){
	            
	            var slash = search.indexOf('/')
			if(slash == -1){
				var one = search.substr(0,2);
				var two = search.substr(2,2);
				var three = search.substr(4,4);
				var value = one+'/'+two+'/'+three 
				$('#search').val(value)
			}


	        }else{
	            
	            

	        var  year_ps = parseInt(search_year) + parseInt(543);

	        var return_date = search_day.concat(year_ps);

	        var slash = return_date.indexOf('/')
			if(slash == -1){
				var one = search.substr(0,2);
				var two = search.substr(2,2);
				var three = search.substr(4,4);
				var value = one+'/'+two+'/'+year_ps 
				$('#search').val(value)
			}

	        }
			
			}else{
			
			
			var  value = "";
			
			$('#search').val(value)
			
			}

	        });*/
</script>