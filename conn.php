<?php
    $databaseName = "";
    $databaseServer = "";
    $databaseUsername = "";
    $databasePassword = "";

    $con = mysql_connect($databaseServer,$databaseUsername,$databasePassword);
    //mysql_query("SET NAMES 'utf8'");
    //mysql_query("SET CHARACTER SET utf8");
    if(!$con){
        die(mysql_error());
    }
    mysql_select_db($databaseName,$con);
?>
