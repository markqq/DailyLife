<?php
    $con = mysql_connect("127.0.0.1","root","");
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET utf8");
    if(!$con){
        die(mysql_error());
    }
    mysql_select_db("tan90",$con);
?>