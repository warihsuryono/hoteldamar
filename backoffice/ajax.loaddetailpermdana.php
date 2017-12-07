<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$permno=$_GET["permno"];
	$sql="SELECT kodebarang,qty,satuan,harsat,keterangan FROM logistik_perm_dana_detail WHERE kodepermohonan='$permno'";
	$hsldet=mysql_query($sql,$db);
	$returnval="";
	while(list($kodebarang,$qty,$satuan,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$jumlah=$harsat*$qty;
		$returnval.=$kodebarang."|||".$namabarang."|||".$qty."|||".$satuan."|||".$harsat."|||".$jumlah."|||".$keterangan."<br>";
	}
	echo $returnval;
?>