<?php 
	if($_POST["export"]){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=report.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$_POST["load"]="LOAD";
	}
	include_once "header.php";
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	$periode=$_POST["periode"];
	$_periode=explode("-",$_POST["periode"]);
	$_tanggal=date("Y-m-",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$_periode=date("F Y",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	if($_POST["load"] || $_POST["save"] || $_POST["export"]){$load=1;}
?>
<?php if($load){ ?>
<?php
	$totalcolom=8;	
?>
<form method="POST" action="<?php echo $__phpself; ?>?periode=<?php echo $periode; ?>">
	<input type="hidden" name="periode2" value="<?php echo $periode; ?>">
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>JURNAL ASSET</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>No. 03 Bln. <?php echo $_periode; ?></h3></td></tr></table>
	<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td><b>TGL PEMBELIAN</b></td>
			<td><b>JML</b></td>
			<td><b>KETERANGAN</b></td>
			<td><b>NILAI PEMBELIAN</b></td>
			<td><b>Penyusutan<br>s/d Bulan lalu</b></td>
			<td><b>Penyusutan<br>Bln <?php echo $_periode; ?></b></td>
			<td><b>Penyusutan<br>s/d <?php echo $_periode; ?></b></td>
			<td><b>Nilai Buku<br>Akhir Bln <?php echo $_periode; ?></b></td>
		</tr>
		<?php
			$sql="SELECT kode,coa,category,penyusutan FROM asset_category ORDER BY kode";
			$hslcat=mysql_query($sql,$db);
			while(list($kodecat,$coaasset,$category,$penyusutan)=mysql_fetch_array($hslcat)){
		?>
			<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td nowrap><b><?php echo strtoupper($category); ?></b></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><?php if($penyusutan>0){echo "($penyusutan % X Nilai Buku)";}else{echo "&nbsp"; } ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<?php
				$sql="SELECT kode,nama_barang,jml,tgl_pembelian,nilai_pembelian FROM asset_detail WHERE category='$kodecat'";
				$hslasset=mysql_query($sql,$db);
				$totnilai_pembelian=0;
				$totpenyusutanblnlalu=0;
				$totnilaiasset=0;
				$totnilaiassetsd=0;
				$totnilaibuku=0;
				while(list($kodeasset,$nama_barang,$jml,$tgl_pembelian,$nilai_pembelian)=mysql_fetch_array($hslasset)){
					$penyusutanblnlalu=0;
					$sql="SELECT sum(debit) FROM acc_jurnal_detail WHERE kodejurnal LIKE 'ASSET/%' AND seqno='$kodeasset' AND kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE kodejurnal LIKE 'ASSET/%' AND tanggal<'$periode')";
					$hsltemp=mysql_query($sql,$db);
					list($penyusutanblnlalu)=mysql_fetch_array($hsltemp);
					$nilaiasset=0;
					$sql="SELECT debit FROM acc_jurnal_detail WHERE kodejurnal='$kodejurnal' AND seqno='$kodeasset'";
					$hsltemp=mysql_query($sql,$db);
					if(mysql_affected_rows($db)>0){
						list($nilaiasset)=mysql_fetch_array($hsltemp);
					}else{
						$nilaiasset=round(($nilai_pembelian*$penyusutan/100)/12);
					}
					$nilaiassetsd=$penyusutanblnlalu+$nilaiasset;
					$nilaibuku=$nilai_pembelian-$nilaiassetsd;
					$totnilai_pembelian+=$nilai_pembelian;
					$totpenyusutanblnlalu+=$penyusutanblnlalu;
					$totnilaiasset+=$nilaiasset;
					$totnilaiassetsd+=$nilaiassetsd;
					$totnilaibuku+=$nilaibuku;
			?>
				<tr>
					<td align="center"><?php echo $tgl_pembelian; ?></td>
					<td align="right"><?php echo $jml; ?></td>
					<td><?php echo $nama_barang; ?></td>
					<td align="right"><?php echo number_format($nilai_pembelian); ?></td>
					<td align="right"><?php if($penyusutan>0){ ?><?php echo number_format($penyusutanblnlalu); ?><?php } ?></td>
					<td align="right"><?php if($penyusutan>0){ ?><?php echo number_format($nilaiasset); ?><?php } ?></td>
					<td align="right"><?php if($penyusutan>0){ ?><?php echo number_format($nilaiassetsd); ?><?php } ?></td>
					<td align="right"><?php if($penyusutan>0){ ?><?php echo number_format($nilaibuku); ?><?php } ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right"><b><?php echo number_format($totnilai_pembelian); ?></b></td>
				<td align="right"><b><?php echo number_format($totpenyusutanblnlalu); ?></b></td>
				<td align="right"><b><?php echo number_format($totnilaiasset); ?></b></td>
				<td align="right"><b><?php echo number_format($totnilaiassetsd); ?></b></td>
				<td align="right"><b><?php echo number_format($totnilaibuku); ?></b></td>
			</tr>
		<?php
			}
		?>
	</table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>>
		<input type="submit" name="save" value="Simpan">
		<input type="button" name="clear" value="Reset" onclick="window.location='<?php echo $__phpself; ?>';">
	</td></tr></table>
</form>
<?php } ?>
<?php include_once "footer.php"; ?>