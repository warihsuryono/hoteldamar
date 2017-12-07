<?php
	include_once "header.php";
	$kode=$_GET["kode"];
	$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF(DATE(departure),DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$__dp2,$__dp3,$__dp4,$__dp5,$dptype,$room,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
	if($grup==0){$grup="";}
	$payment=$__dp+$__dp2+$__dp3+$__dp4+$__dp5;
	$sql="SELECT nama FROM mst_room WHERE kode='$room'";
	$hsltemp=mysql_query($sql,$db);
	list($room)=mysql_fetch_array($hsltemp);
?>
<body style="width:800px">
<style>
	td{
		font-size:14px;
	}
</style>
<table width="100%"><tr><td nowrap align="center"><b style="font-size:30px;">HOTEL DAMAR</b> <span style="font-size:20px;">Malang</span></td></tr></table>
<table width="100%">
	<tr>
		<td align="right">
			<table width="">
				<tr><td>No</td><td>: <?php echo $kodebooking; ?></td></tr>
				<tr><td>Date</td><td>: <?php echo format_tanggal($arrival); ?></td></tr>
			</table>
		</td>
	</tr>
</table>
<table width="100%">
	<tr>
		<td valign="top">
			<table>
				<tr><td nowrap>Name</td><td nowrap>: <?php echo $nama; ?></td></tr>
				<tr><td nowrap>ID Number</td><td nowrap>: <?php echo $idno; ?></td></tr>
				<tr><td nowrap>Address</td><td nowrap valign="top">: <?php echo $alamat; ?></td></tr>
				<tr><td nowrap>Phone</td><td nowrap>: <?php echo $phone; ?></td></tr>
				<tr><td nowrap>Email</td><td nowrap>: <?php echo $email; ?></td></tr>
				<tr><td nowrap>Company</td><td nowrap>: <?php echo $company; ?></td></tr>
				<tr><td nowrap>Departement</td nowrap><td>: <?php echo $departement; ?></td></tr>
				<tr><td nowrap>Group</td><td nowrap>: <?php echo $grup; ?></td></tr>
				<tr><td nowrap>Payment</td><td nowrap>: <?php echo number_format($payment,0,",","."); ?></td></tr>
			</table>
		</td>
		<td valign="top">
			<table>
				<tr><td nowrap>Room</td><td nowrap>: <?php echo $room; ?></td></tr>
				<tr><td nowrap>Person</td><td nowrap>: <?php echo $person; ?></td></tr>
				<tr><td nowrap>Cashier</td><td nowrap>: <?php echo $alamat; ?></td></tr>
				<tr><td nowrap>Arrival</td><td nowrap>: <?php echo format_tanggal($arrival); ?></td></tr>
				<tr><td nowrap>Departure</td><td nowrap>: <?php echo format_tanggal($departure); ?></td></tr>
				<tr><td nowrap>Rate</td><td nowrap>: <?php echo "WD:".number_format($rate1,0,",",".")."/WE:".number_format($rate2,0,",","."); ?></td></tr>
				<tr><td nowrap>Notes</td><td nowrap>: <?php echo $notes; ?></td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">
			<br><br><br><br>
			<u>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</u><br>
			Guest Signature
		</td>
	</tr>
</table>
<table id="tblbtn">
	<tr>
		<td><input type="button" value="print" onclick="tblbtn.style.visibility='hidden'; window.print(); tblbtn.style.visibility='visible';"></td>
	</tr>
</table>
</body>
<?php
	include_once "footer.php";
?>