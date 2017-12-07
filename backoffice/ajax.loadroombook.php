<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$jmlkamar=$_GET["jmlkamar"];
?>
<table>
	<?php for($zz=0;$zz<$jmlkamar;$zz++) { ?>
	<tr>
		<td>
			<select name="arrroom[]">
				<option value="">-room-</option>
				<?php 
					$sql="SELECT kode,nama FROM mst_room ORDER BY kode";
					$hsltemp=mysql_query($sql,$db);
					while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
				?>
					<option value="<?php echo $_kode; ?>"><?php echo $_desc; ?></option>
				<?php
					}
				?>
			</select>
		</td>
	</tr>
	<?php } ?>
</table>