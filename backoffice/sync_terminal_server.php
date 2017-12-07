<?php
	session_start();
	include_once "connect_config.php";
	if(!$db2=mysql_connect($host2,$user2,$pass2)){echo "DB2 Not Connect!".mysql_error();}
	mysql_select_db($dbname2,$db2);
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	
	$sql="SHOW TABLES";
	$hsltable=mysql_query($sql,$db);
	$tanggal=date("Y-m-d");
	while(list($tablename)=mysql_fetch_array($hsltable)){
		$keys="";
		$sql="SHOW COLUMNS FROM `$tablename` WHERE `Key`='PRI'";
		$hslfield=mysql_query($sql,$db);
		while($rsfield=mysql_fetch_assoc($hslfield)){
			$keys.=$rsfield["Field"]."; ";
		}
		if($keys==""){
			$sql="SHOW COLUMNS FROM `$tablename` WHERE `Key`='MUL'";
			$hslfield=mysql_query($sql,$db);
			while($rsfield=mysql_fetch_assoc($hslfield)){
				$keys.=$rsfield["Field"].";";
			}
		}
		$keys=str_ireplace(" ","",$keys);
		if($keys!=""){
			// echo "<br><b>$tablename</b><br>";
			// echo "$keys";
			$sql="SELECT * FROM $tablename WHERE xtimestamp LIKE '$tanggal%'";
			$hslterminal=mysql_query($sql,$db);
			while($rsterminal=mysql_fetch_assoc($hslterminal)){
				$arrkey=explode(";",$keys);
				$wherekeys="WHERE ";
				foreach ($arrkey as $_no => $key) {
					if($key){
						$wherekeys.="`$key`='".$rsterminal[$key]."' AND ";
					}
				}
				$wherekeys=substr($wherekeys,0,strlen($wherekeys)-5);
				
				$into="(";
				$values="(";
				$sql="SHOW COLUMNS FROM $tablename";
				$hsltemp=mysql_query($sql,$db);
				while(list($fieldname)=mysql_fetch_array($hsltemp)){
					$_value=$rsterminal[$fieldname];
					$_value=str_ireplace("'","''",$_value);
					$into.="`$fieldname`,";
					$values.="'".$_value."',";
				}
				$into=substr($into,0,strlen($into)-1).")";
				$values=substr($values,0,strlen($values)-1).")";
				
				$sql="SELECT xtimestamp FROM $tablename $wherekeys";
				$hsltimeserver=mysql_query($sql,$db2);
				if(mysql_affected_rows($db2)<=0){//belom ada di server
					$sql="INSERT INTO $tablename $into VALUES $values";
					mysql_query($sql,$db2);
					//echo "<br>$sql => ".mysql_error();
				}else{//sudah ada, cari yang terbaru
					$timelocal=$rsterminal["xtimestamp"];
					list($timeserver)=mysql_fetch_array($hsltimeserver);
					if($timeserver<$timelocal){//update data server
						$sql="DELETE FROM $tablename $wherekeys";
						mysql_query($sql,$db2);						
						$sql="INSERT INTO $tablename $into VALUES $values";
						mysql_query($sql,$db2);
					}
				}
			}
		}
	}
?>
<?php
	include_once "footer.php";
?>