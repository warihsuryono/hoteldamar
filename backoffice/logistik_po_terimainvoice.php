<?php
	include_once "header.php";
	include_once "func.openwin.php";
	$kode=$_GET["kode"];
	if($_POST["save"]){
		$sql="DELETE FROM invoice_receive WHERE pomode='logistik' AND pono='$kode'";
		mysql_query($sql,$db);
		$invoiceno=$_POST["invoiceno"];
		$tglinvoice=$_POST["tglinvoice"];
		//$jatuhtempo=$_POST["jatuhtempo"];
		$jatuhtempo=date("Y-m-d",mktime(0,0,0,substr($tglinvoice,5,2),substr($tglinvoice,8,2)+30,substr($tglinvoice,0,4)));
		$actionlink.="&nbsp;&nbsp;<a href=''invoice_receive_detail.php?invoiceno=$invoiceno&pono=$kode&pomode=logistik''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO invoice_receive (invoiceno,tglinvoice,jatuhtempo,pomode,pono,createby,createdate,actionlink) VALUES ";
		$sql.="('$invoiceno','$tglinvoice','$jatuhtempo','logistik','$kode','$__username',NOW(),'$actionlink')";
		mysql_query($sql,$db);
		//echo $sql;
		?><script language="javascript"> window.close(); </script><?php
	}
	$sql="SELECT invoiceno,tglinvoice,jatuhtempo FROM invoice_receive WHERE pomode='logistik' AND pono='$kode'";
	$hslinv=mysql_query($sql,$db);
	if(mysql_affected_rows($db)>0){
		list($invoiceno,$tglinvoice,$jatuhtempo)=mysql_fetch_array($hslinv);
	}else{
		$tglinvoice=date("Y-m-d");
		$jatuhtempo="(30 Hari Setelah Tanggal Invoice)";
	}
?>
	<form method="POST" action="<?php echo $__phpself; ?>?kode=<?php echo $kode; ?>">
		<table width="100%"><tr><td align="center"><b>Penerimaan Invoice</b></td></tr></table>
		<table width="100%">
			<tr>
				<td><b>No Invoice</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="invoiceno" value="<?php echo $invoiceno; ?>"></td>
			</tr>
			<tr>
				<td><b>Tanggal Invoice</b></td>
				<td><b>:</b></td>
				<td>
					<input id="tglinvoice" type="text" name="tglinvoice" value="<?php echo $tglinvoice; ?>" size="12" onblur="updatejthtempo(this.value);">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tglinvoice')">
				</td>
			</tr>
			<tr>
				<td><b>Tanggal Jth Tempo</b></td>
				<td><b>:</b></td>
				<td><?php echo $jatuhtempo; ?></td>
			</tr>
			<tr>
				<td><b>PO No</b></td>
				<td><b>:</b></td>
				<td><b><?php echo $kode; ?></b></td>
			</tr>
		</table>
		<table width="100%"><tr><td align="center"><input type="submit" value="Save" name="save"></td></tr></table>
	</form>
<?php
	include_once "footer.php";
?>