<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
<center><h1>Nandha Engineering College<h1></center>
<center><h2>ON DUTY Login</h2></center>
  <div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>

  <form class="login-container" action="index.php" method="post">
    <p><input type="text" placeholder="Register Number" name="t1"></p>
    <p><input type="password" placeholder="Password" name="t2"></p>
    <p><input type="submit" value="Log in"></p>
  </form>
</div>

  
</body>
</html>

<?php

$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$u1=$_POST['t1'];
	$p1=$_POST['t2'];
	$res=mysql_query("select pass,position,name,proc_id,ac_id,hod_id from user where regno='$u1'",$con);
	$row=mysql_fetch_assoc($res);
	$p2=$row['pass'];
	if($p1 == $p2)
	{
		if($row['position'] == 'student')
		{
			
			setcookie("user",base64_encode($u1),time()+8600000,"/");
			setcookie("posi",base64_encode($row['position']),time()+8600000,"/");
			setcookie("name",base64_encode($row['name']),time()+8600000,"/");
			if($row['proc_id'] == '' || $row['ac_id'] == '' || $row['hod_id'] == '' )
			{
				header('Location:getdetails.php');
			}
			else
			{
				setcookie("proc_id",base64_encode($row['proc_id']),time()+8600000,"/");
				setcookie("ac_id",base64_encode($row['ac_id']),time()+8600000,"/");
				setcookie("hod_id",base64_encode($row['hod_id']),time()+8600000,"/");
				header('Location:student.php');
			}
				
			
		}
		else
		{
			setcookie("user",base64_encode($u1),time()+8600000,"/");
			setcookie("posi",base64_encode($row['position']),time()+8600000,"/");
			setcookie("name",base64_encode($row['name']),time()+8600000,"/");
			
			header('Location:staff.php');
		}
		
	}
	else
	{
		echo("Wrong Password");
	}
}

?>