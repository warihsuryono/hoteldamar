<?php
    header("Content-Disposition: attachment; filename=backup.sql");
    header("Content-type: sql");
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	$id=sanitasi($_GET["id"]);
	$sql="SELECT description,filename FROM trx_backup WHERE id='$id'";
	$hslbackup=mysql_query($sql,$db);
	list($description,$filename)=mysql_fetch_array($hslbackup);	
	$fp  = fopen("backup/".$filename, 'r');
	$content = fread($fp, filesize("backup/".$filename));
	fclose($fp);
	echo $content;

	exit;

?>