<?php
$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
$user=base64_decode($_COOKIE['user']);
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$res=mysql_query("select pass from user where regno='$user'");
	$row=mysql_fetch_array($res);
	$oldd=$row['pass'];
	$old=$_POST['t1'];
	$new1=$_POST['t2'];
	$new2=$_POST['t3'];
	if($new1 == $new2 and $oldd == $old)
	{
		mysql_query("update user set pass='$new1' where regno='$user'");
	}
	else
	{
		echo "WRONG DATA";
	}
}
?>
<html>
<head>
 <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>
<body>
 <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
         
		  <?php
		  if(base64_decode($_COOKIE['posi']) == 'student')
		  {
			 echo "<li><a href=\"student.php\">Home</a></li><li><a href=\"submittedod.php\">SUBMITTED ODs</a></li>";
		  }
		  else
		  {
			  echo "<li><a href=\"staff.php\">Home</a></li> <li><a href=\"listod.php\">Search ODs</a></li>";
		  }
		  ?>
          <li class="selected"><a href="changepass.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	  <div class="login">  
  <h2 class="login-header">Change Password</h2>
<form action="changepass.php"  class="login-container" method="post">
<p>OLD PASSWORD<input type="text" name="t1"></p>
<p>NEW PASSWORD<input type="text" name="t2"></p>
<p>REPEAT PASSWORD<input type="text" name="t3"></p>
<input type="submit" value="UPDATE">
</form>
</div>
</body>
</html>