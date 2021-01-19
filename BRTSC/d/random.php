<?PHP
	session_start();
	$result='';
		for($a==1;$a<1;$a++)
		{ // จำนวนรอบที่ต้องการทดสอบ หรือ สุ่ม
			$number='0123456789'; // อักขระ ที่จะเอาไปสุ่ม
			for($i==1;$i<4;$i++)
			{ // จำนวนหลักที่ต้องการสามารถเปลี่ยนได้ตามใจชอบ จาก 5 เป็น 3 หรือ 6 หรือ 10 เป็นต้น
				$random=rand(0,strlen($number)-1); //สุ่มอักขระ
				
				$cut_txt=substr($number,$random,1); //ตัดอักขระจากตำแหน่งที่สุ่มได้มา 1 ตัว
				$result.=substr($number,$random,1); // เก็บค่าที่ตัดมาแล้วใส่ตัวแปร
				$number=str_replace($cut_txt,'',$number); // ลบ หรือ แทนที่อักขระนั้นด้วยค่า ว่าง
			}
			$i=0;
		}	
		$_SESSION[ses_repwd] = $result;
		if($result<>'')
		{
			header ("Location: repassword.php");
			exit();
		}
?>