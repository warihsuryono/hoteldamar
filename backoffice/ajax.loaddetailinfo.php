<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$wintablename=$_GET["wintablename"];
	$tablename=$_GET["tablename"];
	$value=$_GET["value"];
	$kode_pekerjaan=$_GET["kode_pekerjaan"];
	if($wintablename=="logistik_stock_control"){
		//$gudang=$_GET["gudang"];
		$sql="SELECT nama,satuan FROM mst_material_part WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($nama,$satuan)=mysql_fetch_array($hsltemp);
		//qtymasuk
		$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE destid='$gudang' AND kodebarang='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($qtymasuk)=mysql_fetch_array($hsltemp);
		//qtykeluar
		$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE sourceid='$gudang' AND kodebarang='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($qtykeluar)=mysql_fetch_array($hsltemp);
		$systemqty=$qtymasuk-$qtykeluar;
		echo "$nama|||$satuan|||".number_format($systemqty)."|||";
	}
	if($wintablename=="logistik_transfer_material"){
		$sql="SELECT nama,satuan FROM mst_material_part WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($nama,$satuan)=mysql_fetch_array($hsltemp);
		$sql="SELECT sum(volume) FROM rap_detail WHERE kode_pekerjaan='$kode_pekerjaan' AND item='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($projectqty)=mysql_fetch_array($hsltemp);
		$sql="SELECT sum(transqty) FROM logistik_transfer_material_detail WHERE transkode IN (SELECT transkode FROM logistik_transfer_material WHERE kode_pekerjaan='$kode_pekerjaan' AND ambilby!='') AND kodebarang='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($settledqty)=mysql_fetch_array($hsltemp);
		$outstandingqty=$projectqty-$settledqty;
		echo "$nama|||$satuan|||".number_format($projectqty)."|||".number_format($outstandingqty);
	}
	if($wintablename=="mst_material_part"){
		//if($tablename=="logistik_mr"){
			$sql="SELECT nama,satuan FROM $wintablename WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($nama,$satuan)=mysql_fetch_array($hsltemp);
			$sql="SELECT sum(volume) FROM rap_detail WHERE kode_pekerjaan='$kode_pekerjaan' AND item='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($rap)=mysql_fetch_array($hsltemp);
			if(!$rap){$rap=0;}
			$sql="SELECT sum(recvqty) FROM logistik_receive_material_detail WHERE recvkode IN(SELECT recvkode FROM logistik_receive_material WHERE kode_pekerjaan='$kode_pekerjaan') AND kodebarang='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($tot_ming_lalu)=mysql_fetch_array($hsltemp);
			if(!$tot_ming_lalu){$tot_ming_lalu=0;}
			echo "$nama|||".number_format($rap)."|||".number_format($tot_ming_lalu)."|||$satuan";
			// echo "$nama|||1|||2|||$satuan";
			// echo "xxx|||cccc|||vvvv|||bbbb";
		// }else{
			// $sql="SELECT nama,satuan FROM $wintablename WHERE kode='$value'";
			// $hsltemp=mysql_query($sql,$db);
			// list($nama,$satuan)=mysql_fetch_array($hsltemp);
			// echo "$nama|||$satuan|||".number_format($rap)."|||".number_format($tot_ming_lalu);
		// }
	}
	if($wintablename=="win_food_"){
		$sql="SELECT description,price FROM mst_food WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($namamakanan,$price)=mysql_fetch_array($hsltemp);
		echo "$namamakanan|||1|||$price|||";
	}
	if($wintablename=="win_additional_"){
		$sql="SELECT description,price FROM mst_additional WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($description,$price)=mysql_fetch_array($hsltemp);
		echo "$description|||1|||$price|||";
	}
	if($wintablename=="win_toko"){
		$sql="SELECT nama,satuan FROM mst_material_part WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($nama,$satuan)=mysql_fetch_array($hsltemp);
		$sql="SELECT harga FROM mst_harga_toko WHERE kode='$value'";
		$hsltemp=mysql_query($sql,$db);
		list($harga)=mysql_fetch_array($hsltemp);
		echo "$nama|||$satuan|||$harga|||";
	}
?>