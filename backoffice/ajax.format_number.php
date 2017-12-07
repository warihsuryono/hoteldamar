<?php
	$pnumber=$_GET["pnumber"];
	$mode=$_GET["mode"];
	if($mode=="format"){echo number_format($pnumber,2,".",",");}
	if($mode=="unformat"){echo str_ireplace(",","",$pnumber);}
?>