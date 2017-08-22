<?php
$sno=$_POST['sno'];
$ache=$_POST['text1'];
echo $sno;
echo $ache;
$host="localhost";
$user="root";
$pass="";
$dbname="od";
 
$con=mysql_connect($host,$user,$pass);
mysql_select_db($dbname);
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 5242880){
         $errors[]='File size must be excately 2 MB';
      }
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$sno.".".$file_ext);
		 mysql_query("update od set photo='OK' where sno=$sno",$con);
		 mysql_query("update od set acheivements='$ache' where sno=$sno",$con);
		 
		 
		header('Location:submittedod.php');
      }else{
         print_r($errors);
      }
   }
?>