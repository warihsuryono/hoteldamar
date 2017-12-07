<?php 
	if($_POST["export"]){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=report.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$_POST["load"]="LOAD";
	}
	include_once "header.php";
	include_once "func.openwin.php"; 
	$periode=$_POST["periode"];
	if(!$periode){$periode=date("Y-m-")."01";}
	if($_POST["load"] || $_POST["detail"] || $_POST["export"]){$load=1;}
	$arrpost=base64_encode(serialize($_POST));
	if(!$_POST["export"]){
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
						<input type="button" name="detail" value="Load Detail" onclick="window.open('rpt_acc_jurnal_asset_detail.php?arrpost=<?php echo $arrpost; ?>','rpt_acc_jurnal_asset_detail','width=800,height=600,top=300,scrollbars=yes');">
						<input type="submit" name="export" value="Export">
					</td>
				</tr>
			</table>
		<form>
	</fieldset>
<?php
	}
?>
<?php if($load){ ?>
<?php
	$totalcolom=3;
	$_periode=explode("-",$_POST["periode"]);
	$_tanggal=date("Y-m-",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$_periode=date("F Y",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$debittotal=0;
	$arrkodejurnal="";
?>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>JURNAL ASSET</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>No. 03 Bln. <?php echo $_periode; ?></h3></td></tr></table>
<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td><b><u>DEBIT :</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php
		$debittotal=0;
		$sql="SELECT coabiaya FROM asset_category ORDER BY kode";
		$hslbank=mysql_query($sql,$db);
		while(list($coabiaya)=mysql_fetch_array($hslbank)){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coabiaya'";
			$hsltemp=mysql_query($sql,$db);
			list($keterangan)=mysql_fetch_array($hsltemp);
			$sql="SELECT sum(debit) FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coabiaya' AND kredit=0";
			$hsltemp=mysql_query($sql,$db);
			list($debit)=mysql_fetch_array($hsltemp);
			
			if($debit!=0){
				$debittotal+=$debit;
	?>
			<tr>
				<td align="center"><?php echo $coabiaya; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="right"><?php echo number_format($debit,2); ?></td>
			</tr>
		<?php } ?>
	<?php } ?>	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($debittotal,2); ?></b></td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td><b><u>KREDIT :</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php
		$kredittotal=0;
		$sql="SELECT coaakum FROM asset_category ORDER BY kode";
		$hslbank=mysql_query($sql,$db);
		while(list($coaakum)=mysql_fetch_array($hslbank)){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coaakum'";
			$hsltemp=mysql_query($sql,$db);
			list($keterangan)=mysql_fetch_array($hsltemp);
			$sql="SELECT sum(kredit) FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coaakum' AND debit=0";
			$hsltemp=mysql_query($sql,$db);
			list($kredit)=mysql_fetch_array($hsltemp);
			
			if($kredit!=0){
				$kredittotal+=$kredit;
	?>
			<tr>
				<td align="center"><?php echo $coaakum; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="right"><?php echo number_format($kredit,2); ?></td>
			</tr>
		<?php } ?>
	<?php } ?>	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($debittotal,2); ?></b></td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
<?php } ?>
<?php include_once "footer.php"; ?>