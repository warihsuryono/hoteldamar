<?php
	include_once "header.php";
	$kode=$_GET["kode"];
	$sql="SELECT tanggal,nocek,vendor,notes,createby FROM acc_jurnal WHERE kodejurnal='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($tanggal,$nocek,$vendor,$notes,$createby)=mysql_fetch_array($hsltemp);
	$tanggal=format_tanggal($tanggal);
	$sql="SELECT nama FROM mst_vendor WHERE kode='$vendor'";
	$hsltemp=mysql_query($sql,$db);
	list($vendor)=mysql_fetch_array($hsltemp);
	$sql="SELECT nama,signature FROM user_account WHERE username='$createby'";
	$hsltemp=mysql_query($sql,$db);
	list($_createby,$__createby)=mysql_fetch_array($hsltemp);
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__tahuby)){$__tahuby=$imgnull;}
	if(!is_file("signature/".$__periksaby)){$__periksaby=$imgnull;}
	if(!is_file("signature/".$__setujuby)){$__setujuby=$imgnull;}
	if(!is_file("signature/".$__terimaby)){$__terimaby=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_tahuby){$_tahuby=$null;}
	if(!$_periksaby){$_periksaby=$null;}
	if(!$_setujuby){$_setujuby=$null;}
	if(!$_terimaby){$_terimaby=$null;}
?>	
	<table width="100%"><tr><td align="center"><h2><b>BUKTI BANK KELUAR</b></h2></td></tr></table>
	<table width="100%">
		<tr>
			<td valign="top">
				<table>
					<tr>
						<td><b>Kode Bukti</b></td>
						<td>:</td>
						<td><?php echo $kode; ?></td>
					</tr>
					<tr>
						<td><b>Dibayar Kepada</b></td>
						<td>:</td>
						<td><?php echo $vendor; ?></td>
					</tr>
					<tr>
						<td><b>Tanggal</b></td>
						<td>:</td>
						<td><?php echo $tanggal; ?></td>
					</tr>
				</table>
			</td>

			<td valign="top">
				<table valign="top">
					<tr>
						<td><b>No Check/BG</b></td>
						<td>:</td>
						<td><?php echo $nocek; ?></td>
					</tr>
					<tr>
						<td><b>Catatan</b></td>
						<td>:</td>
						<td><?php echo $notes; ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="content_table" width="100%" id="tabledetail">
		<tr class="content_header" id="rowdetail_header">
			<td width="1"><b>No</b></td>
			<td><b>Keterangan</b></td>
			<td><b>Nominal</b></td>
		</tr>
		<?php
			$sql="SELECT coa,koder,keterangan,debit,kredit FROM acc_jurnal_detail WHERE kodejurnal='$kode' ORDER BY seqno";
			$hsldet=mysql_query($sql,$db);
				$no=0;
			while(list($coa,$koder,$keterangan,$debit,$kredit)=mysql_fetch_array($hsldet)){
				$no++;
				if($debit!="0"){$nominal=$debit;}else{$nominal=$kredit;}
				$sql="SELECT description FROM acc_mst_coa WHERE coa='$coa' AND koder='$koder'";
				$hsltemp=mysql_query($sql,$db);
				list($description)=mysql_fetch_array($hsltemp);
				if($keterangan!=""){
					$keterangan=$description." ( $keterangan)";
				}else{
					$keterangan=$description;
				}
		?>
		<tr id="rowdetail" class="content_ganjil">
			<td align="right"><?php echo $no;?></td>
			<td><?php echo $keterangan; ?></td>
			<td align="right"><?php echo number_format($nominal,2);?></td>
		</tr>
		<?php
			}
		?>
	</table>
	
	<table width="100%">
		<tr style="text-align:left;">
			<td>Dibuat</td>
			<td>Diketahui</td>
			<td>Diperiksa</td>
			<td>Disetujui</td>
			<td>Diterima</td>
		</tr>
		<tr style="text-align:left;vertical-align:bottom;height:80px">
			<td align="left"><img src="signature/<?php echo $__createby;?>" width="100" height="50" border='0'></td>
			<td align="left"><img src="signature/<?php echo $__tahuby;?>" width="100" height="50" border='0'></td>
			<td align="left"><img src="signature/<?php echo $__periksaby;?>" width="100" height="50" border='0'></td>
			<td align="left"><img src="signature/<?php echo $__setujuby;?>" width="100" height="50" border='0'></td>
			<td align="left"><img src="signature/<?php echo $__terimaby;?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:left;">
			<td>(<?php echo $_createby; ?>)</td>
			<td>(<?php echo $_tahuby; ?>)</td>
			<td>(<?php echo $_periksaby; ?>)</td>
			<td>(<?php echo $_setujuby; ?>)</td>
			<td>(<?php echo $_terimaby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
			</td>
		</tr>
	</table>
