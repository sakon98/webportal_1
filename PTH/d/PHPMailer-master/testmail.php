<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);     
try { 
				  //ตั้งค่า Server
				  $mail->SMTPDebug = 0;                                
				  $mail->isSMTP();                                     
				  $mail->Host = '172.30.110.16'; 
				  $mail->SMTPAuth = true;                              
				  //$mail->Username = 'no-reply@isocare.co.th';                 
				  //$mail->Password = '@Iso1888';                     
				  $mail->SMTPSecure = 'tls';                           
				  $mail->Port = 25;                                

				  //ผู้รับ
				  $mail->CharSet = 'UTF-8';
				  $mail->setFrom('no-reply@isocare.co.th', 'iCoop Mobile Application');
				  $mail->addAddress('zcrimxelz@gmail.com');               

				  //เนื้อหา
				  $mail->isHTML(true);                                  // ตั้งค่า Mail เป็นแบบ HTML
				  $mail->Subject = 'แจ้งเตือนการเข้าใช้งานระบบ iCoop Mobile Application';
				  $mail->Body    = '
					<html>
					  <head>
						  <style>
							  table {
								width:100%;
								height:70%;
								margin:auto;
								box-shadow: 3px 2px 12px 0px rgba(0,0,0,0.75);
								border-radius: 5px 5px 5px 5px;
								border: 0px solid #000000;
							  }
						  </style>
					  </head>
						<body>
						   <table>
							   <thead>
								   <tr style="height:30%;">
										<th >
									   </th>
									   <th style="text-align:center;color:black">
										   <img src="http://loancloud.coopsiam.com/MobileAppWS/react/img/AppIcon.png" width="200px">
										   <h2> เรียนคุณ พี่เหน่ง</h2>
									   </th>
								   </tr>
							  </thead>
							  <tbody>
								  <tr style="text-align:left;color:black;height:60%;">
									 <td style="width:10%">
									 </td>
									 <td style="width:80%;" valign="top">ทดสอบส่งเมล ThaiAir
										 <p style="color:black;">หมายเหตุ : หากคุณไม่ได้เป็นคนเข้าสู่ระบบด้วยตัวเองกรุณาทำการเปลี่ยนรหัสผ่านบัญชีของท่านหรือเข้าไปที่เมนูจัดการอุปกรณ์ที่หน้าตั้งค่าได้เลยค่ะ </p>
										 หากมีข้อสงสัยกรุณาติดต่อมาที่ <a href="mailto:mhs.mobilesupport@gensoft.co.th">mhs.mobilesupport@gensoft.co.th</a> ค่ะ
									 </td> 
									 <td style="width:10%">
									 </td>
								   </tr>
									<tr style="height:10%;">
								   </tr>
							  </tbody>
						  </table>
						</body>
				  </html>
				  ';

				  $mail->send();
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>