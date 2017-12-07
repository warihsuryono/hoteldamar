<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$pono=$_GET["pono"];
	$sql="SELECT kode_pekerjaan,vendorid FROM logistik_po WHERE pono='$pono'";
	$hsltemp=mysql_query($sql,$db);
	list($kode_pekerjaan,$vendorid)=mysql_fetch_array($hsltemp);
	$returnval="$kode_pekerjaan<field1>$vendorid<field2>";
	$sql="SELECT kodebarang,qty,satuan,keterangan FROM logistik_po_detail WHERE pono='$pono'";
	$hsldet=mysql_query($sql,$db);
	while(list($kodebarang,$qty,$satuan,$keterangan)=mysql_fetch_array($hsldet)){
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$poqty=0;
		$sql="SELECT sum(qty) FROM logistik_po_detail WHERE pono='$pono' AND kodebarang='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($poqty)=mysql_fetch_array($hsltemp);
		$outstandingqty=0;
		$sql="SELECT sum(recvqty) FROM logistik_receive_material_detail WHERE recvkode IN (SELECT recvkode FROM logistik_receive_material WHERE pono='$pono' AND periksaby!='') AND kodebarang='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($settledqty)=mysql_fetch_array($hsltemp);
		$outstandingqty=$poqty-$settledqty;
		$returnval.=$kodebarang."|||".$namabarang."|||".$poqty."|||".$outstandingqty."|||".$outstandingqty."|||".$satuan."|||".$keterangan."|||<br>";
	}
	echo $returnval;
?>