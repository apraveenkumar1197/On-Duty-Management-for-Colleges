<?php
setcookie("user","",time()+8600000,"/");
setcookie("posi","",time()+8600000,"/");
setcookie("name","",time()+8600000,"/");
setcookie("proc_id","",time()+8600000,"/");
setcookie("ac_id","",time()+8600000,"/");
setcookie("hod_id","",time()+8600000,"/");
header("Location:index.php");
?>