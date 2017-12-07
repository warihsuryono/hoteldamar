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
	$totalcolom=8;
	$_periode=explode("-",$_POST["periode"]);
	$_tanggal=date("Y-m-",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$capbulanlalu=date("F Y",mktime(0,0,0,$_periode[1]-1,1,$_periode[0]));
	$_periode=date("F Y",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$debittotal=0;
	$arrkodejurnal="";
?>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>NERACA</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>PERIODE. <?php echo $_periode; ?></h3></td></tr></table>
<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
	<tr class="content_header">
		<td rowspan="2"><b>NO<br>A/C</b></td>
		<td rowspan="2"><b>ACCOUNT</b></td>
		<td colspan="2"><b>S/D <?php echo strtoupper($capbulanlalu); ?></b></td>
		<td colspan="2"><b>MUTASI <?php echo strtoupper($_periode); ?></b></td>
		<td colspan="2"><b>S/D <?php echo strtoupper($_periode); ?></b></td>
	</tr>
	<tr class="content_header">
		<td><b>DEBET</b></td>
		<td><b>KREDIT</b></td>
		<td><b>DEBET</b></td>
		<td><b>KREDIT</b></td>
		<td><b>DEBET</b></td>
		<td><b>KREDIT</b></td>
	</tr>
	<?php
		$groups="'MODAL SAHAM','AKTIVA TETAP','AKTIVA LANCAR','PIUTANG DAGANG','HUTANG DAGANG'";
		$sql="SELECT coa,koder,description FROM acc_mst_coa WHERE description<>'' AND koder IN ($groups) ORDER BY coa";
		$hslcoa=mysql_query($sql,$db);
		$totdebitblnlalu=0;
		$totkreditblnlalu=0;
		$totdebitblnini=0;
		$totkreditblnini=0;
		$totdebitsd=0;
		$totkreditsd=0;
		while(list($coa,$koder,$description)=mysql_fetch_array($hslcoa)){
			$sql="SELECT sum(debit),sum(kredit) FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal<'$periode') AND coa='$coa'";//081320068068
			$hsltemp=mysql_query($sql,$db);
			list($debitblnlalu,$kreditblnlalu)=mysql_fetch_array($hsltemp);
			$sql="SELECT sum(debit),sum(kredit) FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coa'";
			$hsltemp=mysql_query($sql,$db);
			list($debitblnini,$kreditblnini)=mysql_fetch_array($hsltemp);
			$debitsd=$debitblnlalu+$debitblnini;
			$kreditsd=$kreditblnlalu+$kreditblnini;
			$totdebitblnlalu+=$debitblnlalu;
			$totkreditblnlalu+=$kreditblnlalu;
			$totdebitblnini+=$debitblnini;
			$totkreditblnini+=$kreditblnini;
			$totdebitsd+=$debitsd;
			$totkreditsd+=$kreditsd;
	?>
		<tr>
			<td><?php echo $coa; ?></td>
			<td><?php echo $description; ?></td>
			<td align="right"><?php echo number_format($debitblnlalu,2); ?></td>
			<td align="right"><?php echo number_format($kreditblnlalu,2); ?></td>
			<td align="right"><?php echo number_format($debitblnini,2); ?></td>
			<td align="right"><?php echo number_format($kreditblnini,2); ?></td>
			<td align="right"><?php echo number_format($debitsd,2); ?></td>
			<td align="right"><?php echo number_format($kreditsd,2); ?></td>
		</tr>
	<?php
		}
	?>
	<tr>
		<td>&nbsp;</td>
		<td><b>TOTAL :</b></td>
		<td align="right"><b><?php echo number_format($totdebitblnlalu,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totkreditblnlalu,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitblnini,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totkreditblnini,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitsd,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totkreditsd,2); ?></b></td>
	</tr>
	<?php
		$rugidebitblnlalu=$totkreditblnlalu-$totdebitblnlalu;
		$rugidebitblnini=$totkreditblnini-$totdebitblnini;
		$rugidebitsd=$totkreditsd-$totdebitsd;
	?>
	<tr>
		<td>&nbsp;</td>
		<td><b>RUGI :</b></td>
		<td align="right"><b><?php echo number_format($rugidebitblnlalu,2); ?></b></td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($rugidebitblnini,2); ?></b></td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($rugidebitsd,2); ?></b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($totdebitblnlalu,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitblnlalu,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitblnini,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitblnini,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitsd,2); ?></b></td>
		<td align="right"><b><?php echo number_format($totdebitsd,2); ?></b></td>
	</tr>
</table>
<?php } ?>
<?php include_once "footer.php"; ?>