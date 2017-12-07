<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	//cari apakah ada pesanan yang belum di baca
	$tanggal=date("Y-m-d");
	$sql="SELECT kode,tanggal,room FROM trx_restaurant_bill WHERE tanggal LIKE '$tanggal' AND isread='0' ORDER BY kode";
	$hslorder=mysql_query($sql,$db);
	if(mysql_affected_rows($db)>0){
?>
<table>
	<tr>
		<td bgcolor="pink">
			<fieldset style="background:pink">
				<legend><b>Restaurant Order</b></legend>
				<table class="content_table">
					<tr class="content_header">
						<td><b>No</b></td>
						<td><b>Kode</b></td>
						<td><b>Room</b></td>
						<td><b>Action</b></td>
					</tr>
					<?php
						$no=0;
						while(list($kode,$tanggal,$room)=mysql_fetch_array($hslorder)){
							$no++;
							$sql="SELECT nama FROM mst_room WHERE kode='$room'";
							$hsltemp=mysql_query($sql,$db);
							list($room)=mysql_fetch_array($hsltemp);
					?>
						<tr>
							<td align="right"><?php echo $no; ?></td>
							<td><?php echo $kode; ?></td>
							<td><?php echo $room; ?></td>
							<td><input type="button" name="view" value="View" onclick="window.open('trx_restaurant_billview.php?kode=<?php echo $kode; ?>','trx_restaurant_billview','width=800,height=600,top=300,scrollbars=yes');"></td>
						</tr>
					<?php
						}
					?>
				</table>
			</fieldset>
		</td>
	</tr>
</table>
<?php
	}
?>