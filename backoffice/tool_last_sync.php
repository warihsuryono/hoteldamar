<?php
	include_once "header.php";
	$sql="SELECT last_sync FROM trx_sync WHERE id=1";
	$hsl=mysql_query($sql,$db);
	list($last_sync)=mysql_fetch_array($hsl);
	echo "Last Syncronisation : $last_sync";
	include_once "footer.php";
?>
