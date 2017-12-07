<?php
	session_start();
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	$to=$_GET["to"];
	$message=$_GET["message"];
	if($to=="__ALL__"){
		$sql="SELECT username FROM user_account ORDER BY nama";
		$hsluser=mysql_query($sql,$db);
		while(list($to_s)=mysql_fetch_array($hsluser)){
			$sql="INSERT INTO popup_message (username,tanggal,message,status,`from`) VALUES ('$to_s',NOW(),'$message','0','".$_SESSION["username"]."')";
			mysql_query($sql,$db);
		}
		echo mysql_affected_rows($db);
	}else{
		$sql="INSERT INTO popup_message (username,tanggal,message,status,`from`) VALUES ('$to',NOW(),'$message','0','".$_SESSION["username"]."')";
		mysql_query($sql,$db);
		echo mysql_affected_rows($db);
	}
?>