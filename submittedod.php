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
          <li ><a href="student.php">Home</a></li>
          <li class="selected"><a href="submittedod.php">SUBMITTED ODs</a></li>
          <li><a href="changepass.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
<center><h2>SUBMITTED ODs</h2></center>
<?php
$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
$user=base64_decode($_COOKIE['user']);
			
$proc=base64_decode($_COOKIE['proc_id']);
$ac=base64_decode($_COOKIE['ac_id']);
$hod=base64_decode($_COOKIE['hod_id']);
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$name=base64_decode($_COOKIE['name']);
	$text=$_POST['t1'];
	$text1=$_POST['t2'];
	mysql_query("insert into good (regno,name,clg,goodthings) values ('$user','$name','$text','$text1')");
}
$res=mysql_query("select * from od where regno='$user'",$con);
echo "<center><table border=6><tr><th>SNO</th><th>EVENT</th><th>COLLEGE</th><th>DAYS</th><th>DATE</th><th>ACHEIVEMENTS</th><th>PHOTO</th><th>PROCTOR STATUS</th><th>AC STATUS</th><th>HOD STATUS</th></tr>";
$count=1;
while($row=mysql_fetch_array($res))
{
	$eve=$row['event'];
	$clg=$row['clg'];
	$days=$row['days'];
	$date=$row['date'];
	$photo=$row['photo'];
	$ache=$row['acheivements'];
	$sno=$row['sno'];
	$hod_verify=$row['hod_verify'];
	$ac_verify=$row['ac_verify'];
	$proc_verify=$row['proc_verify'];
	if($proc_verify == 'acc')
	{
		$proc_verify = 'Accepted';
	}
	elseif($proc_verify == 'rej')
	{
		$proc_verify = 'Rejected';
	}
	else
	{
		$proc_verify = 'Pending';
	}
	if($ac_verify == 'acc')
	{
		$ac_verify = 'Accepted';
	}
	elseif($ac_verify == 'rej')
	{
		$ac_verify = 'Rejected';
	}
	else
	{
		$ac_verify = 'Pending';
	}
	if($photo == '' || $ache == '')
	{
	if($hod_verify == 'acc')
	{
		$hod_verify="Accepted";
		echo "<tr><td>$count</td><td>$eve</td><td>$clg</td><td>$days</td><td>$date</td><form action=\"image_upload.php\" method=\"POST\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"sno\" value=\"$sno\"\"><td><input type=\"text\" name=\"text1\"></td><td> <input type=\"file\" name=\"image\" onchange=\"form.submit()\"/></td></form><td>$proc_verify</td><td>$ac_verify</td><td>$hod_verify</td></tr>";
	}
	elseif($hod_verify == 'rej')
	{
		$hod_verify="Rejected";
		echo "<tr><td>$count</td><td>$eve</td><td>$clg</td><td>$days</td><td>$date</td><td></td><td></td><td>$proc_verify</td><td>$ac_verify</td><td>$hod_verify</td></tr>";
	}
	else
	{
		$hod_verify="Pending";
		echo "<tr><td>$count</td><td>$eve</td><td>$clg</td><td>$days</td><td>$date</td><td></td><td></td><td>$proc_verify</td><td>$ac_verify</td><td>$hod_verify</td></tr>";	
	}	
	}
	else
	{
		echo "<tr><td>$count</td><td>$eve</td><td>$clg</td><td>$days</td><td>$date</td><td>$ache</td><td>Updated</td></tr>";
	}
	$count=$count+1;
}
echo "</table></center>";
?>
</br></br></br></br>
<center><form action="submittedod.php" method="post">
COLLEGE NAME : <input type="text" name="t1"></br>
Enter about your good experiance of the college you visited (Maximum 500 character): </br>
<textarea rows="4" cols="50" name="t2"></textarea>
<input type="submit" value="SUBMIT">
</form></center>
</body>
</html>
