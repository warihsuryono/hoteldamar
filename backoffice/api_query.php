<?php
include_once "connect_config.php";
$db=mysql_connect($host,$user,$pass);
mysql_select_db($dbname,$db);
$sql = base64_decode($_POST["sql"]);
$mode = $_POST["mode"];
$hsl = mysql_query($sql,$db);
if($mode == "select"){
	$return = array();
	while($arr = @mysql_fetch_array($hsl)){$return[] = $arr;}
	echo base64_encode(serialize($return));
}else{
	echo @mysql_affected_rows($db);
}
?>