<?php
include 'conn.php';
$id = $_GET["id"];
if(isset($_COOKIE['liked_'.$id])){
	if($_COOKIE['liked_'.$id]=="1"){
		echo '{"err":1}';
		exit;
	}
}
$sql="select * from dailylife where id=".$id;
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$likedNum = intval($data[4])+1;
if(mysql_query("UPDATE dailylife SET likeNum = ".$likedNum." WHERE id = ".$id)){
	setcookie('liked_'.$id,'1');
	echo '{"err":0}';
}
?>