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
	$updateby=$_SESSION["username"];
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	if($reset){$_POST=array();}
	$periode1=sanitasi($_POST["periode1"]);
	if(!$periode1){$periode1=date("d/m/Y",mktime(0,0,0,date("m"),1));}
	$periode2=sanitasi($_POST["periode2"]);
	if(!$periode2){$periode2=date("d/m/Y",mktime(0,0,0,date("m")+1,0));}
	$tahun=sanitasi($_POST["tahun"]);
	$xtanggal=sanitasi($_POST["xtanggal"]);
	if(!$xtanggal){$xtanggal="18";}
	
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
								<td nowrap><b>Tanggal</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<select name="xtanggal">
										<?php for ($i=1;$i<=31;$i++){ ?>
											<?php $tgl=substr("00",0,2-strlen($i)).$i;?>
											<option value="<?php echo $tgl; ?>" <?php if($tgl==$xtanggal){echo "selected";} ?>><?php echo $tgl; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap><b>Tahun</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<select name="tahun">
										<?php for ($thn=date("Y");$thn>=date("Y")-100;$thn--){ ?>
											<option value="<?php echo $thn; ?>" <?php if($thn==$tahun){echo "selected";} ?>><?php echo $thn; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
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
			$errmessage="";
			//if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
		}
	?>
	<?php
		echo $errmessage;
		if($errmessage=="" && $load){
			$totalcolom=3;
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>Laporan Occupancy</h3></td></tr></table>
	<table>
		<tr>
			<td valign="top">
				<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
					<tr class="content_header">
						<td>No</td>
						<td>Periode</td>
						<td>Occupancy</td>
					</tr>
				<?php
					$total=0;
					for($bln=1;$bln<13;$bln++){
						$periode=$tahun."-".substr("00",0,2-strlen($bln)).$bln."-";
						$periode=str_ireplace(" ","",$periode);  
						$sql="SELECT tanggal,arrival,departure,datediff(departure,arrival) FROM trx_booking WHERE checkin='1' AND room<>'' AND arrival LIKE '$periode%' ORDER BY arrival";
						//echo "<br>$sql";
						$hsldet=mysql_query($sql,$db);
						$_occupancy=0;
						while(list($tanggal,$arrival,$departure,$occupancy)=mysql_fetch_array($hsldet)){
							$_occupancy+=$occupancy;
						}	
						$total+=$_occupancy;
				?>	
					<tr ondblclick="window.open('rpt_pa_photo.php?kodepelanggan=<?php echo $kodepelanggan; ?>','rpt_pa_photo','width=800,height=600');">
						<td align="right"><?php echo $bln; ?></td>
						<td><?php echo format_tanggal2($periode."01"); ?></td>
						<td align="right"><?php echo $_occupancy; ?></td>
					</tr>
				<?php
					}
				?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td align="right"><b><?php echo $total; ?></b></td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
					<tr class="content_header">
						<td>No</td>
						<td>Periode</td>
						<td>Occupancy</td>
					</tr>
				<?php
					$total=0;
					for($bln=1;$bln<13;$bln++){
						$periode=$tahun."-".substr("00",0,2-strlen($bln)).$bln."-";
						$periode=str_ireplace(" ","",$periode);  
						$periode1=date("Y-m-d",mktime(0,0,0,$bln-1,$xtanggal+1,$tahun));
						$periode2=date("Y-m-d",mktime(0,0,0,$bln,$xtanggal,$tahun));
						$sql="SELECT tanggal,arrival,departure,datediff(departure,arrival) FROM trx_booking WHERE checkin='1' AND room<>'' AND arrival BETWEEN '$periode1' AND '$periode2' ORDER BY arrival";
						//echo "<br>$sql";
						$hsldet=mysql_query($sql,$db);
						$_occupancy=0;
						while(list($tanggal,$arrival,$departure,$occupancy)=mysql_fetch_array($hsldet)){
							$_occupancy+=$occupancy;
						}	
						$total+=$_occupancy;
				?>	
					<tr ondblclick="window.open('rpt_pa_photo.php?kodepelanggan=<?php echo $kodepelanggan; ?>','rpt_pa_photo','width=800,height=600');">
						<td align="right"><?php echo $bln; ?></td>
						<td><?php echo format_tanggal($periode1); ?> s/d <?php echo format_tanggal($periode2); ?></td>
						<td align="right"><?php echo $_occupancy; ?></td>
					</tr>
				<?php
					}
				?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td align="right"><b><?php echo $total; ?></b></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php
		}
	include_once "footer.php";
?>