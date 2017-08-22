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
          <li><a href="listod.php">SEARCH ODs</a></li>
          <li><a href="changepass.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	</br></br></br>
<form action="listod.php" method="post">
<center>Enter the Register Number :  <input type="text" name="t1">
<input type="submit" value="SEE LIST"></center>
</form>
</body>
</html>
<?php
$posi=base64_decode($_COOKIE['posi']);
if($posi == "proctor" || $posi == "ac" || $posi == "hod")
{
$host="localhost";
$user="root";
$pass="";
$dbname="od";
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$reg=$_POST['t1'];
	$res=mysql_query("select * from od where regno='$reg'");
	echo "<center><table border=6><tr><th>SNO</th><th>REGNO</th><th>NAME</th><th>COLLEGE</th><th>EVENT</th><th>DAYS</th><th>DATE</th></tr>";
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
		echo "<tr><td>$sno1</td><td>$regno</td><td>$name1</td><td>$clg</td><td>$eve</td><td>$days</td><td>$date</td></tr>";
		$sno1=$sno1+1;
	}
	echo "</table></center>";
}
}
else
{
	header("Location:valid.php");
}
?>
