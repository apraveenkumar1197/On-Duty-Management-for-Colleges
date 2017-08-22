
<html>
<head>
 <title>ON DUTY</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link  rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	  <div class="login">  
  <h2 class="login-header">Enter Details</h2>
<form action="getdetails.php" method="post" class="login-container">
PROCTOR ID:<input type="text" name="t1">
ACADEMIC CO ORDINATOR ID:<input type="text" name="t2">
HOD ID:<input type="text" name="t3">
<input type="submit" value="Submit">
</form>
</div>
</body>
</html>
<?php
//Get PROCTOR_id, AC_id AND HOD_id DETAILS
$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$user=base64_decode($_COOKIE['user']);
	$proc=$_POST['t1'];
	$ac=$_POST['t2'];
	$hod=$_POST['t3'];
	mysql_query("update user set proc_id='$proc',ac_id='$ac',hod_id='$hod' where regno='$user'",$con);

	setcookie("proc_id",$proc,time()+8600000,"/");
	setcookie("ac_id",$ac,time()+8600000,"/");
	setcookie("hod_id",$hod,time()+8600000,"/");
	
	header('Location:logout.php');
}
	
?>