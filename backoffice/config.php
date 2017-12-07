<?php
	include_once "connect_config.php";

$link=mysql_connect($host,$user,$pass);
mysql_select_db($dbname,$link);
?>