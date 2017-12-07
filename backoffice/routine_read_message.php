<?php
	session_start();
	include_once "connect_config.php";
	function format_tanggal($tanggal){
		$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		return $temp;
	}
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	//cari tanggal login terakhir
	$sql="SELECT tanggal FROM log_record WHERE mode='login' AND username='".$_SESSION["username"]."' ORDER BY seqno DESC LIMIT 1";
	$hsltemp=mysql_query($sql,$db);
	list($lastlogin)=mysql_fetch_array($hsltemp);
	$sql="SELECT id,message FROM popup_message WHERE username='".$_SESSION["username"]."' AND tanggal>'$lastlogin' AND status='0'";
	mysql_query($sql,$db);
	$viewmessage="";
	if(mysql_affected_rows($db)>0){
		$sql="SELECT id,date(tanggal),time(tanggal),message,`from` FROM popup_message WHERE username='".$_SESSION["username"]."' AND tanggal>'$lastlogin' ORDER BY id DESC LIMIT 10";
		//$sql="SELECT id,message FROM popup_message WHERE tanggal>'$lastlogin' AND status='0' ORDER BY id LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		while(list($id,$tanggal,$time,$message,$from)=mysql_fetch_array($hsltemp)){
			//if($message){echo "<br>".$message;}
			if($tanggal!=date("Y-m-d")){$time=format_tanggal($tanggal)." ".$time;}
			if($message){$viewmessage="<br>(".strtoupper($from).")".$time." : ".$message.$viewmessage;}
			$sql="UPDATE popup_message SET status='1' WHERE id='$id'";
			mysql_query($sql,$db);
		}
		//$sql="UPDATE popup_message SET status='1' WHERE username='".$_SESSION["username"]."'";
	}
	echo $viewmessage;
?>