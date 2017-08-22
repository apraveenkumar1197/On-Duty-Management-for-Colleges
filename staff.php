<html>
<head>
 <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>
<body>
<div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="staff.php">Home</a></li>
          <li><a href="listod.php">Search ODs</a></li>
          <li><a href="changepass.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
<?php
$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
$posi=base64_decode($_COOKIE['posi']);
if($posi == "proctor" || $posi == "ac" || $posi == "hod")
{
if($_SERVER["REQUEST_METHOD"] == 'POST')
{

	$value=$_POST['val'];
	$sno=$_POST['sno'];
	
	if($value == 'acc')
	{
		if($posi == 'proctor')
		{
			mysql_query("update od set proc_verify='acc' where sno=$sno",$con);
		}
		if($posi == 'ac')
		{
			mysql_query("update od set ac_verify='acc' where sno=$sno",$con);
		}
		if($posi == 'hod')
		{
			mysql_query("update od set hod_verify='acc' where sno=$sno",$con);
		}
	}
	if($value == 'rej')
	{
		if($posi == 'proctor')
		{
			mysql_query("update od set proc_verify='rej' where sno=$sno",$con);
		}
		if($posi == 'ac')
		{
			mysql_query("update od set ac_verify='rej' where sno=$sno",$con);
		}
		if($posi == 'hod')
		{
			mysql_query("update od set hod_verify='rej' where sno=$sno",$con);
		}
	}
}	

$user=base64_decode($_COOKIE['user']);

$name=base64_decode($_COOKIE['name']);
$res="";

if($posi == 'proctor')
{
	$res=mysql_query("select * from od where proc_id='$user' and proc_verify=''",$con);
}
if($posi == 'ac')
{
	$res=mysql_query("select * from od where ac_id='$user' and proc_verify='acc' and ac_verify=''",$con);
}
if($posi == 'hod')
{
	$res=mysql_query("select * from od where hod_id='$user' and hod_verify='' and ac_verify='acc'",$con);
}
echo "<center><table border=2><tr><th>SNO</th><th>REGNO</th><th>NAME</th><th>COLLEGE</th><th>EVENT</th><th>DAYS</th><th>DATE</th><th>ATTENDED OD DAYS</th></tr>";
$sno1=1;
while($row=mysql_fetch_array($res))
{
	$regno=$row['regno'];
	$sno=$row['sno'];
	$name1=$row['name'];
	$eve=$row['event'];
	$clg=$row['clg'];
	$days=$row['days'];
	$date=$row['date'];
	$res1=mysql_query("select sum(days) as sum from od where regno='$regno'");
	$row1=mysql_fetch_array($res1);
	$adays=$row1['sum']-$days;
	echo "<tr><td>$sno1</td><td>$regno</td><td>$name1</td><td>$clg</td><td>$eve</td><td>$days</td><td>$date</td><td>$adays</td><td><form action=\"staff.php\" method=\"post\" name=\"submit\"><input type=\"hidden\" name=\"val\" value=\"acc\"><input type=\"hidden\" name=\"sno\" value=\"$sno\"><input type=\"submit\" value=\"accept\"></form></td><td><form action=\"staff.php\" method=\"post\"><input type=\"hidden\" name=\"val\" value=\"rej\"><input type=\"hidden\" name=\"sno\" value=\"$sno\"><input type=\"submit\" value=\"reject\"><input type=\"hidden\" name=\"pagecheck\" value=\"submit\"></form></td></tr>";
	$sno1=$sno1+1;
}
echo "</table></center>";
}
else
{
	header("Location:valid.php");
}
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
</form>
</body>
</html>