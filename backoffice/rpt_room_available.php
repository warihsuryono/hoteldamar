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
	if(!$periode1){$periode1=date("Y-m-d",mktime(0,0,0,date("m"),1));}
	$periode2=sanitasi($_POST["periode2"]);
	if(!$periode2){$periode2=date("Y-m-d",mktime(0,0,0,date("m")+1,0));}
	
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
								<td nowrap><b>Periode</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<input id="periode1" type="text" name="periode1" value="<?php echo $periode1; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode1')">
									-
									<input id="periode2" type="text" name="periode2" value="<?php echo $periode2; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode2')">
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
			$sql="SELECT DATEDIFF('$periode2','$periode1')";
			$hsltemp=mysql_query($sql,$db);
			list($numdate)=mysql_fetch_array($hsltemp);
			$numdate++;
			$errmessage="";
			if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
		}
	?>
	<?php
		echo $errmessage;
		if($errmessage=="" && $load){
			$totalcolom=$numdate+2;
			$arrperiode1=explode("-",$periode1);
			$tahun1=$arrperiode1[0];
			$bulan1=$arrperiode1[1];
			$tanggal1=$arrperiode1[2];
			$sql="SELECT kode,title,nama,room,arrival,departure,confirmasi,checkin FROM trx_booking WHERE departure>='$periode1' AND arrival<='$periode2'";
			$hslbook=mysql_query($sql,$db);
			
			$arr_book=array();
			$arr_bookmode=array();
			$arr_bookio=array();
			$arr_booknama=array();
			$arr_bookkode=array();
			
			$_periode=format_tanggal($periode1)." s/d ".format_tanggal($periode2);
			while(list($kode,$_title,$nama,$room,$arrival,$departure,$confirmasi,$checkin)=mysql_fetch_array($hslbook)){
				$__tanggal=$arrival;
				while($__tanggal<=$departure){
					$sql="SELECT description FROM mst_name_title WHERE kode='$_title'";
					$hsltemp=mysql_query($sql,$db);
					list($title)=mysql_fetch_array($hsltemp);
					
					$arr_booknama[$room][$__tanggal][$kode]=$title." ".$nama;
					$arr_bookkode[$room][$__tanggal][$kode]=$kode;
					$arr_book[$room][$__tanggal][$kode]=$confirmasi;
					$arr_bookio[$room][$__tanggal][$kode]=3;
					if($__tanggal==$arrival){$arr_bookio[$room][$__tanggal][$kode]=1;}
					if($__tanggal==$departure){$arr_bookio[$room][$__tanggal][$kode]=2;}
					
					if($checkin){
						$arrbook[$room][$__tanggal]=3;
						$arr_book[$room][$__tanggal][$kode]=3;
						$arr_bookmode[$room][$__tanggal]=1;
					}
					$__arrtanggal=explode("-",$__tanggal);
					$__tahun=$__arrtanggal[0];
					$__bulan=$__arrtanggal[1];
					$__tgl=$__arrtanggal[2];
					$__tanggal=date("Y-m-d",mktime(0,0,0,$__bulan,$__tgl+1,$__tahun));
				}
			}
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>AVAILABLE ROOM</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo $_periode; ?></h3></td></tr></table>
	
	<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td rowspan="2"><b>Room Type</b></td>
			<td align="center" colspan="<?php echo $numdate; ?>"><b>Date</b></td>
		</tr>
		<tr class="content_header">
			<?php for($day=0;$day<$numdate;$day++){ $tgl=date("d",mktime(0,0,0,$bulan1,$tanggal1+$day));  ?>
				<td align="right"><b><?php echo $tgl; ?></b></td>
			<?php } ?>
		</tr>
		<?php
			$arrtotal = array();
			$sql="SELECT id,description FROM mst_room_type ORDER BY id";
			$hslroom=mysql_query($sql,$db);
			while(list($room_type_id,$nama)=mysql_fetch_array($hslroom)){
				$no++;
		?>
			<tr>
				<td><b><?php echo $nama; ?></b></td>
				<?php 
					for($day=0;$day<$numdate;$day++){
						$tgl=$tanggal1+$day; 
						$currentdate=date("Y-m-d",mktime(0,0,0,$bulan1,$tgl,$tahun1));
						
						$sql = "SELECT count(0) FROM mst_room WHERE tipe='".$room_type_id."'"; $hsltemp = mysql_query($sql,$db);
						list($roomAvailable) = mysql_fetch_array($hsltemp);
						
						$roomOO = 0;
						$sql = "SELECT kode FROM mst_room WHERE tipe='".$room_type_id."'";
						$hslroom2 = mysql_query($sql,$db);
						while(list($kodeRoom) = mysql_fetch_array($hslroom2)){
							$sql = "SELECT id,status FROM room_status_history WHERE room_id='".$kodeRoom."' AND effective_at <= '".$currentdate."' ORDER BY effective_at DESC LIMIT 1";
							$hsltemp = mysql_query($sql,$db);
							list($roomStatusId,$roomStatus) = mysql_fetch_array($hsltemp);
							if($roomStatus == 0 && $roomStatusId > 0) $roomOO++;
						}
						$roomtotal = $roomAvailable - $roomOO;
						
						$checkintotal = 0;
						$sql="SELECT count(0) FROM trx_booking WHERE room IN (SELECT kode FROM mst_room WHERE tipe='".$room_type_id."') AND checkin='1' AND arrival<='".$currentdate."' GROUP BY room";
						if($periode1 > "2018-02-28") $sql="SELECT count(0) FROM trx_booking WHERE room IN (SELECT kode FROM mst_room WHERE tipe='".$room_type_id."') AND checkin='1' AND arrival>='2018-03-01' AND arrival<='".$currentdate."' AND  GROUP BY room";
						$hsltemp = mysql_query($sql,$db);
						while(list($total) = mysql_fetch_array($hsltemp)){
							$checkintotal += $total;
						}
						
						$checkouttotal = 0;
						$sql="SELECT count(0) FROM trx_billing WHERE room IN (SELECT kode FROM mst_room WHERE tipe='".$room_type_id."') AND paid='1' AND tanggal<='".$currentdate."' GROUP BY room";
						if($periode1 > "2018-02-28") $sql="SELECT count(0) FROM trx_billing WHERE room IN (SELECT kode FROM mst_room WHERE tipe='".$room_type_id."') AND paid='1' AND tanggal>'2018-03-01' AND tanggal<='".$currentdate."' AND booking IN (SELECT kode FROM trx_booking WHERE room IN (SELECT kode FROM mst_room WHERE tipe='".$room_type_id."') AND checkin='1' AND arrival>='2018-03-01') GROUP BY room";
						$hsltemp = mysql_query($sql,$db);
						while(list($total) = mysql_fetch_array($hsltemp)){
							$checkouttotal += $total;
						}
						
						$available = $roomtotal - $checkintotal + $checkouttotal;
						if($available > $roomtotal) $available = $roomtotal;
						$arrtotal[$currentdate] += $available;
						if($available > 0){
							$available = "<a href='trx_bookingadd.php?roomtype=".$room_type_id."&arrivalDate=".$currentdate."'>".$available."</a>";
						}
				?>
					<td align="right" valign="top"><?php echo $available; ?></td>
				<?php } ?>
			</tr>
		<?php
			}
		?>
		<tr>
			<td align="right"><b>Total</b></td>
			<?php 
				for($day=0;$day<$numdate;$day++){
					$tgl=$tanggal1+$day; 
					$currentdate=date("Y-m-d",mktime(0,0,0,$bulan1,$tgl,$tahun1));
					?>
					<td align="right" valign="top"><b><?=$arrtotal[$currentdate];?></b></td>
			<?php } ?>
		</tr>
	</table>
	<?php } ?>
<?php
	include_once "footer.php";
?>