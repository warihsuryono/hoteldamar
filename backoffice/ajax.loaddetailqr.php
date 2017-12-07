<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$qrno=$_GET["qrno"];
	$vendorid=$_GET["vendorid"];
	$returnval="";
	if($vendorid){
		$sql="SELECT kodebarang,qty,satuan,harsat,keterangan FROM logistik_qr_vendor_detail WHERE qrno='$qrno' AND vendorid='$vendorid'";
		$hsldet=mysql_query($sql,$db);
		while(list($kodebarang,$qty,$satuan,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$jumlah=$harsat*$qty;
			$returnval.=$kodebarang."|||".$namabarang."|||".$qty."|||".$satuan."|||".$harsat."|||".$jumlah."|||".$keterangan."<br>";
		}
	}else{
		$sql="SELECT kodebarang,qty,satuan,keterangan FROM logistik_qr_detail WHERE qrno='$qrno'";
		$hsldet=mysql_query($sql,$db);
		while(list($kodebarang,$qty,$satuan,$keterangan)=mysql_fetch_array($hsldet)){
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$harsat=0;$jumlah=0;
			$returnval.=$kodebarang."|||".$namabarang."|||".$qty."|||".$satuan."|||".$harsat."|||".$jumlah."|||".$keterangan."<br>";
		}
	}
	echo $returnval;
?>