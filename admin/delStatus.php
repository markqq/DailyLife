<?php
include '../conn.php';
$id = $_GET["id"];
$sql = "delete from dailylife where id = '$id'";
$result = mysql_query($sql);
echo '{"err":0}';
?>