<?php
	session_start();
	include_once "connect.php";
	include_once "clsnaikanharga.php";
	if(!$_SESSION["outlet"]){$_SESSION["outlet"]="999";}
	// if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	// mysql_select_db($dbname,$db);
	$kode=sanitasi($_GET["kode"]);
	$outlet=$_SESSION["outlet"];
?>
<table border="1" width="100%">
	<tr>
		<td><b>Items Code</b></td>
		<td><b>Items Name</b></td>
		<td><b>Unit Price</b></td>
		<td><b>Qty</b></td>
		<td><b>Sisa Qty</b></td>
		<td><b>Disc</b></td>
		<td><b>Sub Total</b></td>
	</tr>
	<?php
		$sql="SELECT * FROM trx_pos_retur_temp_detail WHERE kode='$kode' ORDER BY seqno";
		$hsl=mysql_query($sql,$db);
		while($rs=mysql_fetch_array($hsl)){
			$barcode=$rs["barcode"];
			$qty=$rs["qty"];
			$sql="SELECT stok FROM outlet_stok WHERE kode_outlet='$outlet' AND kode_produk='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($stok)=mysql_fetch_array($hsltemp);
			$sisa_qty=$stok+$qty;
			$disc=$rs["disc"];
			$sql="SELECT nama,hargajual FROM produk WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($nama,$price)=mysql_fetch_array($hsltemp);
			//naikkan harga
			$sql="SELECT id_markas FROM outlet WHERE id='$outlet'";
			$hsltemp=mysql_query($sql,$db);
			list($id_markas)=mysql_fetch_array($hsltemp);
			$price=naikkanharga($price,$barcode,$id_markas);
			$subtotal=($price-($price*$disc/100))*$qty;
	?>
		<tr>
			<td nowrap width="1%"><a href="#" ondblclick="window.parent.document.getElementById('barcode').value='<?php echo $barcode; ?>';window.parent.document.getElementById('qty').value='<?php echo $qty; ?>';window.parent.document.getElementById('qty').select();"><?php echo $barcode; ?></a></td>
			<td nowrap width="1%"><?php echo $nama; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($price)); ?></td>
			<td nowrap width="1%" align="right"><?php echo $qty; ?></td>
			<td nowrap width="1%" align="right"><?php echo $sisa_qty; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($disc)); ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($subtotal)); ?></td>
		</tr>
	<?php
		}
	?>
</table>