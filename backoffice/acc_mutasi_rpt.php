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
	include_once "func_jurnal.php";
	$updateby=$_SESSION["username"];
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	if($reset){$_POST=array();}
	$periode1=sanitasi($_POST["periode1"]);
	if(!$periode1){$periode1=date("Y-m-d",mktime(0,0,0,date("m"),1));}
	$periode2=sanitasi($_POST["periode2"]);
	if(!$periode2){$periode2=date("Y-m-d",mktime(0,0,0,date("m")+1,0));}
	$_periode="PERIODE ".format_tanggal($periode1)." - ".format_tanggal($periode2);
	$bankid=sanitasi($_POST["bankid"]);
	
	$load=sanitasi($_POST["load"]);
	$arrpost=base64_encode(serialize($_POST));
?>
	<?php if(!$_POST["export"]) {?>
	<script language="JavaScript">
		var detailsWindow;		
		function showCalendar(textid) {
		   detailsWindow = window.open("calendar.php?textid="+textid+"","calendar","width=260,height=250,top=300,scrollbars=yes");
		   detailsWindow.focus();   
		}
	</script>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<fieldset>
			<legend><b>Filter</b></legend>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<table>
							<tr>
								<td nowrap><b>Periode</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<input id="periode1" type="text" name="periode1" value="<?php echo $periode1; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode1')">
									-
									<input id="periode2" type="text" name="periode2" value="<?php echo $periode2; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode2')">
								</td>
							</tr>
							<tr>
								<td><b>Kas / Bank</b></td>
								<td><b>:</b></td>
								<td>
									<select id="bankid" name="bankid">
										<option value="">-Semua Rekening-</option>
										<option value="1.0.00" <?=("1.0.00" == $bankid) ? "selected":"";?>>Kas</option>
										<?php
											$sql="SELECT coa,description FROM acc_mst_coa WHERE koder='AKTIVA LANCAR' AND description LIKE '%bank%' ORDER BY description";
											$hsltemp=mysql_query($sql,$db);
											while(list($_kode,$description)=mysql_fetch_array($hsltemp)){
												$selected = "";
												if($_kode == $bankid) $selected = "selected";
										?>
											<option value="<?php echo $_kode; ?>" <?=$selected;?>><?php echo $description; ?></option>
										<?php
											}
										?>
									</select>
								</td>
							</tr>
						</table>
					</td>			
			</table>
			<table width="100%">
				<tr>
					<td align="center">
						<input type="submit" name="load" value="Load">
						<input type="submit" name="reset" value="Reset">
						<input type="submit" name="export" value="Export">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php } ?>
	<?php
		if($load){
			generateMutasi($periode1,$periode2);
			$totalcolom = 7;
			?>
			<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
			<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>MUTASI KAS/BANK</h3></td></tr></table>
			<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo $_periode; ?></h3></td></tr></table>
			<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
				<tr class="content_header">
					<td><b>No</b></td>
					<td><b>Tgl</b></td>
					<td><b>Bank/Kas</b></td>
					<td><b>Reference<br>Number</b></td>
					<td><b>Description</b></td>
					<td><b>Debit</b></td>
					<td><b>Kredit</b></td>
				</tr>
			<?php
			if($bankid != "") $whereclause = "AND coa = '".$bankid."'";
			$no = 0;
			$DEBIT = 0;
			$KREDIT = 0;
			$sql = "SELECT * FROM trx_mutasi WHERE trxDate BETWEEN '".$periode1."' AND '".$periode2."' ".$whereclause." ORDER BY trxDate";
			$hslMutasi = mysql_query($sql,$db);
			while($mutasi = mysql_fetch_array($hslMutasi)){
				$no++;
				$sql = "SELECT description FROM acc_mst_coa WHERE coa='".$mutasi["coa"]."'";$hsltemp = mysql_query($sql,$db);
				list($coaDesc) = mysql_fetch_array($hsltemp);
				$debit = $mutasi["debit"];
				$kredit = $mutasi["credit"];
				$DEBIT += $debit;
				$KREDIT += $kredit;
				?>
					<tr>
						<td align="right"><?php echo $no; ?></td>
						<td><?=format_tanggal($mutasi["trxDate"]); ?></td>
						<td><?=$coaDesc; ?></td>
						<td><?=$mutasi["refno"]; ?></td>
						<td><?=$mutasi["description"]; ?></td>
						<td align="right"><?php if($debit>=1){if($_POST["export"]){echo $debit;}else{echo number_format($debit,2);}}else{echo "";} ?></td>
						<td align="right"><?php if($kredit>=1){if($_POST["export"]){echo $kredit;}else{echo number_format($kredit,2);}}else{echo "";} ?></td>
					</tr>
					
				<?php
			}
			?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>TOTAL</b></td>
					<td align="right"><b><?php if($DEBIT>=1){if($_POST["export"]){echo $DEBIT;}else{echo number_format($DEBIT,2);}}else{echo "";} ?></b></td>
					<td align="right"><b><?php if($KREDIT>=1){if($_POST["export"]){echo $KREDIT;}else{echo number_format($KREDIT,2);}}else{echo "";} ?></b></td>
				</tr>
			</table>
			<?php
		}
	?>
	
<?php
	include_once "footer.php";
?>