<?php 
	include_once "header.php";
	include_once "func.openwin.php"; 
	$reset=sanitasi($_POST["reset"]);
	$periode=$_POST["periode"];
	if(!$periode){$periode=date("Y-m-")."01";}
	if($_POST["save"]){ $periode=$_POST["periode2"]; }
	$_periode=explode("-",$periode);
	$_tanggal=date("Y-m-",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$kodejurnal="ASSET/"."".$_periode[0]."".$_periode[1]."01/001";
	$kodejurnal_1="ASSET/".date("Ym",mktime(0,0,0,$_periode[1]-1,1,$_periode[0]))."01/001";
	$_periode=date("F Y",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	if($_POST["save"]){
		$tanggal=date("Y-m-d");
		$tanggal=$periode;
		$sql="DELETE FROM acc_jurnal WHERE kodejurnal='$kodejurnal'";
		mysql_query($sql,$db);
		$sql="DELETE FROM acc_jurnal_detail WHERE kodejurnal='$kodejurnal'";
		mysql_query($sql,$db);
		
		$createby=$__username;
		$notes="Jurnal Asset Periode $_periode";
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','1','$tanggal','$norek','$vendor','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);	
		//echo "<br>$sql => ".mysql_error();
		foreach($_POST["assetval"] as $kodeasset => $valueasset){
			$seqno=$kodeasset;
			$sql="SELECT category,nama_barang,jml FROM asset_detail WHERE kode='$kodeasset'";
			$hsltemp=mysql_query($sql,$db);
			list($category,$nama_barang,$jml)=mysql_fetch_array($hsltemp);
			$sql="SELECT coabiaya FROM asset_category WHERE kode='$category'";
			$hsltemp=mysql_query($sql,$db);
			list($coabiaya)=mysql_fetch_array($hsltemp);			
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coabiaya'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$keterangan="Biaya Penyusutan $nama_barang $jml X";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coabiaya','$koder','$keterangan','$valueasset','0')";
			mysql_query($sql,$db);
		}
		
		$sql="SELECT seqno FROM acc_jurnal_detail WHERE kodejurnal='$kodejurnal' ORDER BY seqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($seqno)=mysql_fetch_array($hsltemp);
		foreach($_POST["assetval"] as $kodeasset => $valueasset){
			$seqno++;
			$sql="SELECT category,nama_barang,jml FROM asset_detail WHERE kode='$kodeasset'";
			$hsltemp=mysql_query($sql,$db);
			list($category,$nama_barang,$jml)=mysql_fetch_array($hsltemp);
			$sql="SELECT coaakum FROM asset_category WHERE kode='$category'";
			$hsltemp=mysql_query($sql,$db);
			list($coaakum)=mysql_fetch_array($hsltemp);			
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coaakum'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$keterangan="Akum.Penyusutan $nama_barang $jml X";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coaakum','$koder','$keterangan','0','$valueasset')";
			mysql_query($sql,$db);
		}
		?> <script language="javascript"> alert("Jurnal Asset Telah Disimpan!"); </script> <?php
	}
	if($_POST["load"] || $_POST["save"] || $_POST["export"]){$load=1;}
?>
<fieldset>
	<legend>Filter</legend>
	<form method="POST" action="<?php echo $__phpself; ?>">
		<table>
			<tr>
				<td>Periode</td>
				<td>:</td>
				<td>
					<input id="periode" type="text" name="periode" value="<?php echo $periode; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('periode','periode')">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="load" value="Load">
				</td>
			</tr>
		</table>
	<form>
</fieldset>
<?php if($load){ ?>
<?php
	$totalcolom=6;	
?>
<form method="POST" action="<?php echo $__phpself; ?>?periode=<?php echo $periode; ?>">
	<input type="hidden" name="periode2" value="<?php echo $periode; ?>">
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>ASSET MANAGEMENT</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>Bln. <?php echo $_periode; ?></h3></td></tr></table>
	<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td><b>TGL PEMBELIAN</b></td>
			<td><b>JML</b></td>
			<td><b>KETERANGAN</b></td>
			<td><b>NILAI PEMBELIAN</b></td>
			<td><b>Penyusutan s/d Bulan lalu</b></td>
			<td><b>Penyusutan Bln <?php echo $_periode; ?></b></td>
		</tr>
		<?php
			$sql="SELECT kode,coa,category,penyusutan FROM asset_category ORDER BY kode";
			$hslcat=mysql_query($sql,$db);
			while(list($kodecat,$coaasset,$category,$penyusutan)=mysql_fetch_array($hslcat)){
		?>
			<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td nowrap><b><?php echo strtoupper($category); ?></b></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><?php if($penyusutan>0){echo "($penyusutan % X Nilai Buku)";}else{echo "&nbsp"; } ?></td>
			</tr>
			<?php
				$sql="SELECT kode,nama_barang,jml,tgl_pembelian,nilai_pembelian FROM asset_detail WHERE category='$kodecat'";
				$hslasset=mysql_query($sql,$db);
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
			?>
				<tr>
					<td align="center"><?php echo $tgl_pembelian; ?></td>
					<td align="right"><?php echo $jml; ?></td>
					<td><?php echo $nama_barang; ?></td>
					<td align="right"><?php echo number_format($nilai_pembelian); ?></td>
					<td align="right"><?php if($penyusutan>0){ ?><?php echo number_format($penyusutanblnlalu); ?><?php } ?></td>
					<td align="right">
						<?php if($penyusutan>0){ ?>
						<input type="text" style="text-align: right" name="assetval[<?php echo $kodeasset; ?>]" value="<?php echo $nilaiasset; ?>">
						<?php } ?>
					</td>
				</tr>
			<?php
				}
			?>
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