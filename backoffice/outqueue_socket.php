<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	$return="";
	$returnsql="";
	$sql="SELECT id,modem_id,msisdn,qtime,message FROM outqueue WHERE status=0 ORDER BY id LIMIT 1";
	$hslout=mysql_query($sql,$db);
	list($idx,$modem_id,$msisdn,$qtime,$message)=mysql_fetch_array($hslout);
	$return="$idx|||$modem_id|||$msisdn|||$qtime|||$message";
	$sql="UPDATE outqueue SET exectime=NOW(),status=1 WHERE id='$idx';";
	mysql_query($sql,$db);
	$returnsql="<br>".$sql;
	echo $return;
?>