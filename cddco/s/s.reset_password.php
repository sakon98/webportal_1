<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$servername = "localhost";
$username = "root";
$password = "WebServer";
$dbname = "scobkkpc_new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$repwd = md5("1234");


echo $sql = "UPDATE mbmembmaster SET password = '$repwd' WHERE member_no = '".$_POST["mb"]."'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
    echo '<script type="text/javascript"> window.alert("ระบบได้เปลี่ยนรหัสสมาชิกให้เป็น 1234 แล้วกรุณาเข้าด้วยรหัสผ่านดังกล่าว") </script> ';
    echo "<script>window.location = 'administrator.php'</script>";
    exit;
} else {
   // echo "Error updating record: " . $conn->error;
    echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบระบบไม่สามารถเปลี่ยนแปลงได้") </script> ';
    echo "<script>window.location = 'administrator.php'</script>";
    exit;
}

$conn->close();



				

