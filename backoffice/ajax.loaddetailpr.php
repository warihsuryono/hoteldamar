<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$prno=$_GET["prno"];
	$sql="SELECT kode_pekerjaan FROM workshop_pr WHERE prno='$prno'";
	$hsltemp=mysql_query($sql,$db);
	list($kode_pekerjaan)=mysql_fetch_array($hsltemp);
	$returnval="$kode_pekerjaan<field1>";
	$sql="SELECT partno,qty,satuan,keterangan FROM workshop_pr_detail WHERE prno='$prno'";
	$hsldet=mysql_query($sql,$db);
	while(list($kodebarang,$qty,$satuan,$keterangan)=mysql_fetch_array($hsldet)){
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$returnval.=$kodebarang."|||".$namabarang."|||".$qty."|||".$satuan."|||".$keterangan."<br>";
	}
	echo $returnval;
?>