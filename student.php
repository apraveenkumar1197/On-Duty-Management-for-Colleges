<?php
$posi=base64_decode($_COOKIE['posi']);
if($posi == 'student')
{
$host="localhost";
$user="root";
$pass="";
$dbname="od";
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname,$con);
$name=base64_decode($_COOKIE['name']);
if($_SERVER["REQUEST_METHOD"] == 'POST')
	{
	 if($_POST['pagecheck'] == "od") 
		{
			$eventtype=$_POST['eventtype'];
			$event=$_POST['t1'];
			$clg=$_POST['t2'];
			$days=$_POST['t3'];
			$date=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
			if($eventtype == 'Symposium' || $eventtype == 'Workshop' || $eventtype == 'Seminar')
			{}
			else
			{
				header("Location:valid.php");
			}
			if($event == '' || $clg == '' || $days == '' || $date == '')
			{
				echo "Fill all the details correctly";
			}
			else
			{
				$user=base64_decode($_COOKIE['user']);
				$proc=base64_decode($_COOKIE['proc_id']);
				$ac=base64_decode($_COOKIE['ac_id']);
				$hod=base64_decode($_COOKIE['hod_id']);
				mysql_query("insert into `od`(`regno`,`name`,`event`,`clg`,`days`,`date`,`proc_id`,`ac_id`,`hod_id`,`eventtype`) values ('$user','$name','$event','$clg',$days,'$date','$proc','$ac','$hod','$eventtype')",$con);
			}
			
        }
		if($_POST['pagecheck'] == "logout")
			{
				setcookie("user","",time()+8600000,"/");
				setcookie("posi","",time()+8600000,"/");
				setcookie("name","",time()+8600000,"/");
				setcookie("proc_id","",time()+8600000,"/");
				setcookie("ac_id","",time()+8600000,"/");
				setcookie("hod_id","",time()+8600000,"/");
				header("Location:index.php");
			}
		}
	}
else
{
	header("Location:valid.php");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}

body {
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  font-weight: 100;
  font-size: 12px;
  line-height: 30px;
  color: #777;
  background: #FFFFFF;
}

.container {
  max-width: 400px;
  width: 100%;
  margin: 0 auto;
  position: relative;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea,
#contact button[type="submit"] {
  font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
}

#contact {
  background: #F9F9F9;
  padding: 25px;
  margin: 150px 0;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

#contact h3 {
  display: block;
  font-size: 30px;
  font-weight: 300;
  margin-bottom: 10px;
}

#contact h4 {
  margin: 5px 0 15px;
  display: block;
  font-size: 13px;
  font-weight: 400;
}

fieldset {
  border: medium none !important;
  margin: 0 0 10px;
  min-width: 100%;
  padding: 0;
  width: 100%;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea {
  width: 100%;
  border: 1px solid #ccc;
  background: #FFF;
  margin: 0 0 5px;
  padding: 10px;
}

#contact input[type="text"]:hover,
#contact input[type="email"]:hover,
#contact input[type="tel"]:hover,
#contact input[type="url"]:hover,
#contact textarea:hover {
  -webkit-transition: border-color 0.3s ease-in-out;
  -moz-transition: border-color 0.3s ease-in-out;
  transition: border-color 0.3s ease-in-out;
  border: 1px solid #aaa;
}

#contact textarea {
  height: 100px;
  max-width: 100%;
  resize: none;
}

#contact button[type="submit"] {
  cursor: pointer;
  width: 100%;
  border: none;
  background: #4CAF50;
  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
}

#contact button[type="submit"]:hover {
  background: #43A047;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active {
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
  text-align: center;
}

#contact input:focus,
#contact textarea:focus {
  outline: 0;
  border: 1px solid #aaa;
}

::-webkit-input-placeholder {
  color: #888;
}

:-moz-placeholder {
  color: #888;
}

::-moz-placeholder {
  color: #888;
}

:-ms-input-placeholder {
  color: #888;
}
</style>
  <title>ON DUTY</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="student.php">Home</a></li>
          <li><a href="submittedod.php">SUBMITTED ODs</a></li>
          <li><a href="changepass.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
<div class="container">
  <form id="contact" action="student.php" method="post">
  <?php
echo "<h4>Hi ".$name."</h4>";
?>
  <form action="" method="post">
  <fieldset>
EVENT TYPE:   <select name="eventtype">
<option value="Symposium">Symposium</option>
<option value="Workshop">Workshop</option>
<option value="Seminar">Seminar</option>
</select></fieldset>
<fieldset>COLLEGE:<input type="text" name="t2"></fieldset>
<fieldset>EVENT (or) TOPIC:<input type="text" name="t1"></fieldset>
<fieldset>DAYS:<input type="text" name="t3"></fieldset>
<fieldset>
DATE:<select name="date">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="00">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="month">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="00">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select><select name="year">
<?php
 echo "<option value=".date("Y").">". date("Y")."</option>";
 echo "<option value=".(date("Y")+1).">". (date("Y")+1)."</option>";
?>
</select></fieldset>
<input type="hidden" name="pagecheck" value="od">
<fieldset>
<input type="submit" value="Submit" id="contact-submit"></fieldset>
</form>
</div>
</body>
</html>