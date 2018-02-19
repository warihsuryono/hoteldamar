<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	function format_tanggal($tanggal){
		$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		return $temp;
	}
	$tanggal = $_GET["tanggal"];
	$checkindate = "3000-12-12";
	$rooms = array();
	$books = trim(str_replace("_","/",$_GET["books"]));
	$books = explode("|",$books);
	$kodeBooking = "";
	foreach($books as $book){
		if($book){
			if(!$kodeBooking) $kodeBooking = $book;
			$sql = "SELECT IF(date(checkindate)<>'0000-00-00',date(checkindate),arrival) as checkindate,room,rate1,rate2 FROM trx_booking WHERE kode = '".$book."'";
			$hsltemp = mysql_query($sql,$db);
			list($_checkindate,$room,$rate1,$rate2) = mysql_fetch_array($hsltemp);
			if($_checkindate < $checkindate && $_checkindate != "") $checkindate = $_checkindate;
			if($room){
				$rooms[$room] = 1;
				$roomrates[$room][1] = $rate1;
				$roomrates[$room][2] = $rate2;
			}
		}
	}
	
	if(count($rooms) <= 0) exit();
	$arr=explode("-",$checkindate);
	$_thn=$arr[0];
	$_bln=$arr[1];
	$_tgl=$arr[2];
	$sql="SELECT DATEDIFF('$tanggal','$checkindate')";
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
				foreach($rooms as $room => $val){
					$sql = "SELECT nama FROM mst_room WHERE kode='".$room."'"; $hsltemp=mysql_query($sql,$db);
					list($roomName) = mysql_fetch_array($hsltemp);
			?>
				<td nowrap><b><?=$roomName;?></b></td>
			<?php } ?>
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
					foreach($rooms as $room => $val){
						/* $sql = "SELECT nama FROM mst_room WHERE kode='".$room."'"; $hsltemp=mysql_query($sql,$db);
						list($roomName) = mysql_fetch_array($hsltemp);
						if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
 							$rate = $roomrates[$room][1];
						}else{
 							$rate = $roomrates[$room][2];
						} */
						$sql = "SELECT rates FROM trx_booking WHERE kode='".$kodeBooking."'";
						$hslrates = mysql_query($sql,$db);
						list($rates) = mysql_fetch_array($hslrates);
						$rates = unserialize(base64_decode($rates));
						$rate = $rates[$room][$currentdate];
						if($rate == 0){
							$sql = "SELECT nama,price,price2 FROM mst_room WHERE kode='".$room."'"; $hsltemp=mysql_query($sql,$db);
							list($roomName,$price,$price2) = mysql_fetch_array($hsltemp);
							if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
								$rate = $price;
							}else{
								$rate = $price2;
							}
						}
				?>
					<td align="right">
						<input name="rate[<?=$room;?>][<?=$currentdate;?>]" value="<?=$rate;?>" size="7">
					</td>
				<?php } ?>
			</tr>
		<?php } ?>
	</table>
</fieldset>