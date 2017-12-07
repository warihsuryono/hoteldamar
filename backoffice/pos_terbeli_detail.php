<?php
	session_start();
	include_once "connect.php";
	if(!$_SESSION["outlet"]){$_SESSION["outlet"]="999";}
	// if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	// mysql_select_db($dbname,$db);
	$kode=sanitasi($_GET["kode"]);
	$discmember=sanitasi($_GET["discmember"]);
	$outlet=$_SESSION["outlet"];
?>
<table border="1" width="100%">
	<tr>
		<td><b>Items Code</b></td>
		<td><b>Items Name</b></td>
		<td><b>Color</b></td>
		<td><b>Unit Price</b></td>
		<td><b>Qty</b></td>
		<td><b>Sisa Qty</b></td>
		<td><b>Disc</b></td>
		<!--td><b>Disc Member</b></td-->
		<td><b>Sub Total</b></td>
	</tr>
	<?php
		$sql="SELECT * FROM trx_pos_detail WHERE kode='$kode' ORDER BY seqno";
		$hsl=mysql_query($sql,$db);
		while($rs=mysql_fetch_array($hsl)){
			$barcode=$rs["barcode"];
			$qty=$rs["qty"];
			$sql="SELECT stok FROM outlet_stok WHERE kode_outlet='$outlet' AND kode_produk='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($stok)=mysql_fetch_array($hsltemp);
			//$stok=1000;
			$sisa_qty=$stok-$qty;
			$disc=$rs["disc"];
			$sql="SELECT nama,hargajual,kode_warna FROM produk WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($nama,$price,$kode_warna)=mysql_fetch_array($hsltemp);	
			$price=$rs["harga"];
			$sql="SELECT warna FROM mst_warna WHERE kode='$kode_warna'";
			$hsltemp=mysql_query($sql,$db);
			list($warna)=mysql_fetch_array($hsltemp);
			$subtotal=($price-($price*$disc/100))*$qty;
			//$subtotal=$price*$qty;
	?>
		<tr>
			<td nowrap width="1%"><a href="#" ondblclick="window.parent.document.getElementById('barcode').value='<?php echo $barcode; ?>';window.parent.document.getElementById('qty').value='<?php echo $qty; ?>';window.parent.document.getElementById('qty').select();"><?php echo $barcode; ?></a></td>
			<td nowrap width="1%"><?php echo $nama; ?></td>
			<td nowrap width="1%"><?php echo $warna; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($price)); ?></td>
			<td nowrap width="1%" align="right"><?php echo $qty; ?></td>
			<td nowrap width="1%" align="right"><?php echo $sisa_qty; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($disc)); ?></td>
			<!--td nowrap width="1%" align="right"><?php echo number_format(round($discmember)); ?></td-->
			<td nowrap width="1%" align="right"><?php echo number_format(round($subtotal)); ?></td>
		</tr>
	<?php
		}
	?>
</table>