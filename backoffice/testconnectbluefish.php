<?php
	set_time_limit(0);
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "<br>DB Not Connect!".mysql_error();}
	mysql_select_db("bluefish_ip",$db);
	
	$sql="SELECT ip FROM ip LIMIT 1";
	$hsltemp=mysql_query($sql,$db);
	list($ip)=mysql_fetch_array($hsltemp);
	
	if(!$db=mysql_connect($ip,$user2,$pass2)){echo "<br>DB BF Not Connect!".mysql_error();}
	mysql_select_db($dbname2,$db);
	echo "<br>".$ip;
	//$ip="39.213.204.92";
?>