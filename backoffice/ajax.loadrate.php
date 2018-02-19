<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	function format_tanggal($tanggal){
		$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		return $temp;
	}
	$rooms=explode("|",$_GET["rooms"]);
	$isediting=$_GET["isediting"];
	$kodeBooking=$_GET["kodeBooking"];
	$arrival=$_GET["arrival"];
	$departure=$_GET["departure"];
	$arr=explode("-",$arrival);
	$_thn=$arr[0];
	$_bln=$arr[1];
	$_tgl=$arr[2];
	$sql="SELECT DATEDIFF('$departure','$arrival')";
	$hsltemp=mysql_query($sql,$db);
	list($numdate)=mysql_fetch_array($hsltemp);
	if($numdate <= 0) exit();
	?>
		<fieldset>
			<legend><b>Room Rate</b></legend>
			<table border="1">
				<tr>
					<td><b>Tanggal</b></td>
					<?php 
						foreach($rooms as $room){
							if($room){
								$sql = "SELECT nama FROM mst_room WHERE kode='".$room."'"; $hsltemp=mysql_query($sql,$db);
								list($roomName) = mysql_fetch_array($hsltemp);
								?><td nowrap><b><?=$roomName;?></b></td><?php 
							} 
						} 
					?>
				</tr>
				<?php
					for($day=0;$day<$numdate;$day++){
						$tgl=$_tgl+$day; 
						$currentdate=date("Y-m-d",mktime(0,0,0,$_bln,$tgl,$_thn));
						$tipeday=date("N",mktime(0,0,0,$_bln,$tgl,$_thn));
				?>
					<tr>
						<td nowrap><?=format_tanggal($currentdate);?></td>
						<?php 
							foreach($rooms as $room){
								if($room){
									if(!$isediting){
										$sql = "SELECT nama,price,price2 FROM mst_room WHERE kode='".$room."'"; $hsltemp=mysql_query($sql,$db);
										list($roomName,$price,$price2) = mysql_fetch_array($hsltemp);
										if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
											$rate = $price;
										}else{
											$rate = $price2;
										}
									} else {
										$sql = "SELECT rates FROM trx_booking WHERE kode='".$kodeBooking."'";
										$hslrates = mysql_query($sql,$db);
										list($rates) = mysql_fetch_array($hslrates);
										if($rates){
											$rates = unserialize(base64_decode($rates));
											$rate = $rates[$room][$currentdate];
										} else {
											$sql = "SELECT rate1,rate2 FROM trx_booking WHERE kode = '".$kodeBooking."'"; $hsltemp = mysql_query($sql,$db);
											list($rate1,$rate2) = mysql_fetch_array($hsltemp);
											if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
												$rate = $rate1;
											}else{
												$rate = $rate2;
											}
										}
									}
						?>
								<td align="right">
									<input name="rate[<?=$room;?>][<?=$currentdate;?>]" value="<?=$rate;?>" size="7">
								</td>
						<?php 
								} 
							} 
						?>
					</tr>
				<?php } ?>
			</table>
		</fieldset>
	<?php
?>