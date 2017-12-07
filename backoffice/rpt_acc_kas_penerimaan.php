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
						<input type="button" name="detail" value="Load Detail" onclick="window.open('rpt_acc_kas_penerimaan_detail.php?arrpost=<?php echo $arrpost; ?>','rpt_acc_kas_penerimaan_detail','width=800,height=600,top=300,scrollbars=yes');">
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
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>KAS PENERIMAAN</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>No. 01 Bln. <?php echo $_periode; ?></h3></td></tr></table>
<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td><b><u>DEBET :</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
		$hsltemp=mysql_query($sql,$db);
		list($coakas)=mysql_fetch_array($hsltemp);
		$sql="SELECT description FROM acc_mst_coa WHERE coa='$coakas'";
		$hsltemp=mysql_query($sql,$db);
		list($keterangan)=mysql_fetch_array($hsltemp);
		$sql="SELECT kodejurnal,debit FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coakas' AND kredit=0";
		$hsltemp=mysql_query($sql,$db);
		$debitkas=0;
		while(list($kodejurnal,$debit)=mysql_fetch_array($hsltemp)){
			$debitkas+=$debit;
			$arrkodejurnal[$kodejurnal]=1;
		}
		$debittotal+=$debitkas;
	?>
	<tr>
		<td align="center"><?php echo $coakas; ?></td>
		<td><?php echo $keterangan; ?></td>
		<td align="right"><?php echo number_format($debitkas,2); ?></td>
	</tr>
	<?php
		$sql="SELECT coa FROM acc_mst_coa WHERE description LIKE 'bank%'";
		$hslbank=mysql_query($sql,$db);
		while(list($coabank)=mysql_fetch_array($hslbank)){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coabank'";
			$hsltemp=mysql_query($sql,$db);
			list($keterangan)=mysql_fetch_array($hsltemp);
			$sql="SELECT kodejurnal,debit FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coabank' AND kredit=0";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql";
			$debitbank=0;
			while(list($kodejurnal,$debit)=mysql_fetch_array($hsltemp)){
				$debitbank+=$debit;
				$arrkodejurnal[$kodejurnal]=1;
			}
			
			if($debitbank!=0){
				$debittotal+=$debitbank;
	?>
			<tr>
				<td align="center"><?php echo $coabank; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="right"><?php echo number_format($debitbank,2); ?></td>
			</tr>
		<?php } ?>
	<?php } ?>	
	<?php
		$_kodejurnal="";
		foreach($arrkodejurnal as $kodejurnal => $val){
			$_kodejurnal.="'$kodejurnal',";
		}
		$_kodejurnal=substr($_kodejurnal,0,strlen($_kodejurnal)-1);
	?>
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
		$sql="SELECT coa,kredit FROM acc_jurnal_detail WHERE kodejurnal IN ($_kodejurnal) AND debit='0'";
		$sql="SELECT coa,sum(kredit) FROM acc_jurnal_detail WHERE kodejurnal IN ($_kodejurnal) AND debit='0' GROUP BY coa";
		$hslkredit=mysql_query($sql,$db);
		while(list($coakredit,$kredit)=mysql_fetch_array($hslkredit)){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coakredit'";
			$hsltemp=mysql_query($sql,$db);
			list($keterangan)=mysql_fetch_array($hsltemp);
			if($kredit!=0){
				$kredittotal+=$kredit;
	?>
			<tr>
				<td align="center"><?php echo $coakredit; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="right"><?php echo number_format($kredit,2); ?></td>
			</tr>
		<?php } ?>
	<?php } ?>	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><b><?php echo number_format($kredittotal,2); ?></b></td>
	</tr>
</table>
<?php } ?>
<?php include_once "footer.php"; ?>