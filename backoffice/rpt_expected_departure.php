<?php
	if($_POST["export"]){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=report.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
	$_POST["load"]="LOAD";
	include_once "header.php";
	include_once "func.openwin.php";
	$updateby=$_SESSION["username"];
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	if($reset){$_POST=array();}
	$periode1=sanitasi($_POST["periode1"]);
	if(!$periode1){$periode1=date("Y-m-d");}
	
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
	
	<div id="divcap" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
		<table cellspacing="4" cellpadding="4"><tr><td bgcolor="c5f05e" id="tdcap" style="font-weight:bold;"></td></tr></table>
	</div>
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
									<input id="periode1" type="text" name="periode1" value="<?php echo $periode1; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode1')">
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
		echo $errmessage;
		if($errmessage=="" && $load){
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>EXPECTED DEPARTURE</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo format_tanggal3($periode1); ?></h3></td></tr></table>
	<?php
		$sql="SELECT kode,title,nama,phone,room,arrival FROM trx_booking WHERE departure = '".$periode1."' ORDER BY room";
		$hslbook=mysql_query($sql,$db);
		if(mysql_affected_rows($db) <= 0){
			echo "<center><font color='red'><h3><b>DATA TIDAK DITEMUKAN</b></h3></font></center>";
		} else {
	?>
	
		<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
			<tr class="content_header">
				<td><b>No</b></td>
				<td><b>Room</b></td>
				<td><b>Name</b></td>
				<td><b>Phone</b></td>
				<td><b>Action</b></td>
			</tr>
			<?php
				$no=0;
				while(list($kode,$title,$nama,$phone,$room,$arrival)=mysql_fetch_array($hslbook)){
					$no++;
					$sql="SELECT nama FROM mst_room WHERE kode='".$room."'";$hsltemp=mysql_query($sql,$db);
					list($room) = mysql_fetch_array($hsltemp);
					$sql = "SELECT kode FROM trx_billing WHERE booking='".$kode."' AND paid=1";
					$hsltemp = mysql_query($sql,$db);
					list($kodeBilling) = mysql_fetch_array($hsltemp);
			?>
				<tr>
					<td align="right"><?php echo $no; ?></td>
					<td><?php echo $room; ?></td>
					<td><?=$title;?> <?php echo $nama; ?></td>
					<td><?php echo $phone; ?></td>
					<td>
						<?php if(!$kodeBilling){ ?>
						<input type="button" value="Check Out" onclick="window.location='trx_billingadd.php?booking_kode=<?=$kode;?>&checkoutDate=<?=$periode1;?>';">
						<?php } else { ?>
						<a href="trx_billingview.php?kode=<?=$kodeBilling;?>">View Billing</a>
						<?php } ?>
					</td>
				</tr>
			<?php
				}
			?>
		</table>
		<?php } ?>
	<?php } ?>
<?php
	include_once "footer.php";
?>