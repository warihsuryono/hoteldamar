<?php
	session_start();
	function format_tanggal($tanggal){
		$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		return $temp;
	}
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	if(!$_SESSION["outlet"]){$_SESSION["outlet"]="999";}
	$lebarstruk=260;
	$outlet=$_SESSION["outlet"];
	
	$trx1="Barang yang sudah dibeli";
	$trx2="Tidak dapat ditukar/dikembalikan";
	
	$kode=sanitasi($_GET["kode"]);
	$sql="SELECT * FROM trx_pos WHERE kode='$kode'";//echo $sql;
	$hsl=mysql_query($sql,$db);
	$rs=mysql_fetch_array($hsl);
	$tgltrx=explode(" ",$rs["tanggal"]);
	$jamtrx=$tgltrx[1];
	$tgltrx=$tgltrx[0];
	$total=$rs["total_amount"];
	$cash=$rs["pembayaran"];
	$jenis_bayar=$rs["jenis_bayar"];
	$sql="SELECT carabayar FROM jenis_bayar WHERE kode='$jenis_bayar'";
	$hsltemp=mysql_query($sql,$db);
	list($jenis_bayar)=mysql_fetch_array($hsltemp);
	$returno=$rs["returno"];
	$sql="SELECT total_amount FROM trx_pos_retur WHERE kode='$returno'";
	$hsltemp=mysql_query($sql,$db);
	list($retur)=mysql_fetch_array($hsltemp);
?>
<style>
	td{
		font-size:10px;
		font-family:verdana;
	}
	body{
		font-size:10px;
		font-family:verdana;
	}
</style>

<body leftmargin="0" topmargin="0">
	<table width="<?php echo $lebarstruk; ?>">
		<tr>
			<td align="center"><img src="images/logo.jpg" width="40" height="34"></td>
		</tr>
	<table>	
	<table width="<?php echo $lebarstruk; ?>">
		<tr><td nowrap><hr></td></tr>
	</table>
	<table width="<?php echo $lebarstruk; ?>">
		<tr>
			<td nowrap>Cashier: <?php echo $_SESSION["username"]; ?></td>
			<td nowrap align="right">Tgl: <?php echo format_tanggal($tgltrx); ?></td>
		</tr>
	</table>
	<table width="<?php echo $lebarstruk; ?>">
		<tr>
			<td nowrap>Invoice: <?php echo $kode; ?></td>
		</tr>
	</table>
	<table border="0" width="<?php echo $lebarstruk; ?>">
		<tr><td nowrap colspan="3"><hr></td></tr>
		<tr>
			<td nowrap><b><u>Items Name</u></b></td>
			<td nowrap><b><u>Unit Price X Qty</u></b></td>
			<td nowrap><b><u>Sub Total</u></b></td>
		</tr>
		<?php			
			$sql="SELECT disc_member,disc_special FROM trx_pos WHERE kode='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($disc_member,$disc_special)=mysql_fetch_array($hsltemp);
			$sql="SELECT * FROM trx_pos_detail WHERE kode='$kode' ORDER BY seqno";
			$hsl=mysql_query($sql,$db);
			$totalqty=0;
			$totaldiscmember=0;
			$subtotdisc=0;
			$gross=0;
			$subtotal=0;
			$subtotal2=0;
			$_TOTALAMOUNT=0;
			while($rs=mysql_fetch_array($hsl)){
				$barcode=$rs["barcode"];
				$qty=$rs["qty"];
				$totalqty+=$qty;
				$sql="SELECT mst_material_part.nama,mst_harga_toko.harga FROM mst_material_part INNER JOIN mst_harga_toko ON (mst_material_part.kode=mst_harga_toko.kode) WHERE mst_material_part.kode='$barcode'";
				$hsltemp=mysql_query($sql,$db);
				list($nama,$price)=mysql_fetch_array($hsltemp);	
				$gross+=($price*$qty);
				$subtotdisc=($price*$disc/100)*$qty;
				//$subtotal=($price-($price*$disc/100))*$qty;
				$subtotal=($price*$qty)-($price*$qty*$disc/100);
				$_TOTALAMOUNT+=$subtotal;
				$subtotal2+=($price-($price*$disc/100))*$qty;
				
				$totaldiscmember+=($price*$disc_member/100);
				if(strlen($nama)>20){
					$nama=substr($nama,0,20)."..";
				}
		?>
			<!--tr>
				<td nowrap width="1%"><?php echo $barcode; ?></td>
			</tr-->
			<tr>
				<td nowrap width="1%" colspan="3">&nbsp;&nbsp;&nbsp;<?php echo $nama; ?></td>
			</tr>
			<tr>
				<td></td>
				<td nowrap width="1%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $price; ?> X <?php echo $qty; ?></td>
				<td nowrap width="1%" align="right"><?php echo round($subtotal); ?></td>
			</tr>
		<?php
			}
			$sql="SELECT customer,disc_special FROM trx_pos WHERE kode='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($customer_id,$disc_special)=mysql_fetch_array($hsltemp);
			$sql="SELECT type FROM customer WHERE id='$customer_id'";
			$hsltemp=mysql_query($sql,$db);
			list($typemember)=mysql_fetch_array($hsltemp);
			$sql="SELECT disc FROM customer_disc WHERE id='$typemember' AND min<='$subtotal' AND max>='$subtotal'";
			$hsl=mysql_query($sql,$db);
			list($disc_member)=mysql_fetch_array($hsl);
			
			$tot_disc_member=$disc_member+$disc_special;
			$discmember=($subtotal2*$tot_disc_member/100);
			
			$totalalldisc=$gross-$_TOTALAMOUNT;
			$cashback=$cash-$_TOTALAMOUNT;
		?>
		<tr>
			<td nowrap colspan="2"><b>Total Disc</b></td>
			<td nowrap align="right"><b><?php echo round($totalalldisc); ?></b></td>
		</tr>
		<tr>
			<td nowrap colspan="2"><b>TOTAL</b></td>
			<td nowrap align="right"><b><?php echo round($_TOTALAMOUNT); ?></b></td>
		</tr>
	</table>
	<table border="0" width="<?php echo $lebarstruk; ?>">
		<tr><td nowrap>&nbsp;</td></tr>
	</table>
	<table border="0" width="<?php echo $lebarstruk; ?>">
		<tr>
			<td nowrap colspan="3"><b>TOTAL QTY</b></td>
			<td nowrap align="right"><b><?php echo round($totalqty); ?></b></td>
		</tr>
		<tr>
			<td nowrap><b>VIA : <?php echo $jenis_bayar; ?></b></td>
			<td nowrap align="right"><b><?php echo round($cash);?></b></td>
		</tr>
		<?php
			if($retur>0){
		?>
		<tr>
			<td nowrap><b>RETUR</b></td>
			<td nowrap align="right"><b><?php echo round($retur);?></b></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td nowrap><b>ADDED COST</b></td>
			<td nowrap align="right"><b><?php echo round($addedcost);?></b></td>
		</tr>
		<!--tr>
			<td nowrap>NON CASH</td>
			<td nowrap align="right"><?php echo round($noncash);?></td>
		</tr-->
		<tr>
			<td nowrap><b>CASH BACK</b></td>
			<td nowrap align="right"><b><?php echo round($cashback);?></b></td>
		</tr>
	</table>
	<table width="<?php echo $lebarstruk; ?>">
		<tr><td nowrap align="center"><?php echo $trx1; ?></td></tr>
		<tr><td nowrap align="center"><?php echo $trx2; ?></td></tr>
	<table>
</body>
<script language="javascript">
	window.print();
</script>