<?php
include '../conn.php';

$statusDate=$_POST["statusDate"];
$statusContent=$_POST["statusContent"];
$hashTag=$_POST["hashTag"];
$statusContent = str_replace("'","\\'",$statusContent);

if($statusDate=="" || $statusContent==""){
  echo '{"err":2}';
  exit();
}

$q = "INSERT INTO dailylife (statusDate,statusContent,hashTag) values('$statusDate','$statusContent','$hashTag');";
if(!mysql_query($q, $con)){
  echo '{"err":1,"Msg":"Can not write on the database"}';
  exit();
}
$id=mysql_insert_id();
clearstatcache();
echo '{"err":0,"id":"'.$id.'"}';
?>