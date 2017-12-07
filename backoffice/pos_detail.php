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
<table class="content_table" width="100%">
	<tr class="content_header">
		<td><b>Items Code</b></td>
		<td><b>Items Name</b></td>
		<td><b>Unit Price</b></td>
		<td><b>Qty</b></td>
		<td><b>Sub Total</b></td>
	</tr>
	<?php
		$sql="SELECT barcode,qty FROM trx_pos_temp_detail WHERE kode='$kode' ORDER BY seqno";
		$hsl=mysql_query($sql,$db);
		while(list($barcode,$qty)=mysql_fetch_array($hsl)){
			$sql="SELECT mst_material_part.nama,mst_harga_toko.harga FROM mst_material_part INNER JOIN mst_harga_toko ON (mst_material_part.kode=mst_harga_toko.kode) WHERE mst_material_part.kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($nama,$price)=mysql_fetch_array($hsltemp);	
			$subtotal=($price-($price*$disc/100))*$qty;
			//$subtotal=$price*$qty;
	?>
		<tr>
			<td nowrap width="1%"><a href="#" ondblclick="window.parent.document.getElementById('barcode').value='<?php echo $barcode; ?>';window.parent.document.getElementById('qty').value='<?php echo $qty; ?>';window.parent.document.getElementById('qty').select();"><?php echo $barcode; ?></a></td>
			<td nowrap width="1%"><?php echo $nama; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($price)); ?></td>
			<td nowrap width="1%" align="right"><?php echo $qty; ?></td>
			<td nowrap width="1%" align="right"><?php echo number_format(round($subtotal)); ?></td>
		</tr>
	<?php
		}
	?>
</table>