<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func.cekroomavailabel.php";
	
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp' AND field<>'id'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($_GET["editing"] && false){
		$sql="SELECT checkin FROM $tablename WHERE $kodename='".$_GET["kode"]."'";
		$hsltemp=mysql_query($sql,$db);
		list($__approved)=mysql_fetch_array($hsltemp);
		if($__approved!=0){ ?> <script language="javascript">alert("Dokumen ini sudah Settled, Sehingga tidak boleh diubah!");window.location="<?php echo $tablename."list.php";?>";</script> <?php }
	}
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
	//cek data
	$datavalid=true;
	$errormessage="";
	if($modebutton=="simpan" || $modebutton=="simpandancheckin"){
		
		if(!$tanggal){$errormessage="Isi Reservation Date!";$datavalid=false;}
		if(!$title){$errormessage="Pilih Title!";$datavalid=false;}
		if(!$nama){$errormessage="Isi Nama!";$datavalid=false;}
		if(!$arrival){$errormessage="Isi Tanggal Arrival!";$datavalid=false;}
		if(!$departure){$errormessage="Isi Tanggal Departure!";$datavalid=false;}
		
		$sql="SELECT DATEDIFF(DATE('$departure'),DATE('$arrival'))";
		$hsltemp=mysql_query($sql,$db);
		list($lamainap)=mysql_fetch_array($hsltemp);
		if($lamainap<=0){$errormessage="Tanggal Arrival dan atau departure Salah!";$datavalid=false;}		
		
		if($datavalid){//tidak ada masalah dengan tanggal arrival dan departure
			foreach($_POST["rooms"] as $room => $val){
				$roomavailable=funccekroomavailable($_GET["kode"],$room,$arrival,$departure);
				if(!$roomavailable){$errormessage="Kamar sudah dipesan! Batalkan Reservation sebelumnya atau Selesaikan Payment Reservation sebelumnya jika tetap ingin di Simpan!";$datavalid=false;}
			}
		}
		
		if(count($_POST["rooms"]) <= 0){$errormessage="Pilih Room!";$datavalid=false;}
		if(!$rate1){$errormessage="Isi Rate Week Days!";$datavalid=false;}
		if(!$rate2){$errormessage="Isi Rate Week End!";$datavalid=false;}
		if(!$refno && $dp > 0){$errormessage="Isi Reference Number!";$datavalid=false;}
	}
	
	if(!$datavalid){
		?>
			<script language="javascript">
				alert("<?php echo $errormessage;?>");
			</script>
		<?php
	}
	
	if(($modebutton=="simpan" || $modebutton=="simpandancheckin") && $datavalid){
		$kode=$_GET["kode"];
		if($_GET["editing"]){
			$sql="SELECT grup FROM trx_booking WHERE kode='$kode'";
			$hsl = mysql_query($sql,$db);
			list($grup) = mysql_fetch_array($hsl);
			if(!$grup){
				$kodes[0] = $kode;
			} else {
				$sql = "SELECT kode FROM trx_booking WHERE grup = '$grup' ORDER BY kode";
				$hsl = mysql_query($sql,$db);
				while(list($kodeBooking) = mysql_fetch_array($hsl)){
					$kodes[] = $kodeBooking;
				}
			}
			foreach($kodes as $delkode){
				$sql="DELETE FROM $tablename WHERE $kodename='$delkode'";
				mysql_query($sql,$db);
				$sql="DELETE FROM $tabledetailname WHERE $kodename='$delkode'";
				mysql_query($sql,$db);
			}
		}
		$room_i = 0;
		foreach($_POST["rooms"] as $room => $val){
			$room_i++;
			$tanggal=date("Y-m-d");
			if(!$_GET["editing"]){
				$kode="BOOK/".date("Ymd")."/";
				$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
				$hsltemp=mysql_query($sql,$db);
				list($idseqno)=mysql_fetch_array($hsltemp);
				$idseqno++;
				$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
				$periode=date("Y-m-01");
				$_POST["idseqno"] = $idseqno;
				$_POST["kode"] = $kode;
				if(count($_POST["rooms"]) > 1){
					if($room_i == 1) $_POST["grup"] = $kode;
				} else {
					$_POST["grup"] = 0;
				}
				$grup = $_POST["grup"];
			}else{
				$_POST["grup"] = $kodes[0];
				$grup = $_POST["grup"];
				if($kodes[$room_i-1]){
					$kode = $kodes[$room_i-1];
					$_POST["kode"] = $kode;
					$idseqno = substr($kode,-3);
					$_POST["idseqno"] = $idseqno;
				} else {
					$kode="BOOK/".date("Ymd")."/";
					$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
					$hsltemp=mysql_query($sql,$db);
					list($idseqno)=mysql_fetch_array($hsltemp);
					$idseqno++;
					$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
					$_POST["idseqno"] = $idseqno;
					$_POST["kode"] = $kode;
				}
			}
			if($room_i > 1){ $dp = "";	$dptype = "";	$dpbank = "";	$dpdate = "";	$refno = ""; }
			$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp' AND field<>'id'";
			$hsltemp=mysql_query($sql,$db);
			$into="(";
			$values="(";
			$createby=$__username;
			$createdate=$__now;
			$detailfile=$tabledetailname.".php?kode=$kode";
			$actionlink="<a href=''$__phpself?editing=1&kode=$kode''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
			$actionlink.="&nbsp;&nbsp;<a href=''$detailfile''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
			while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
				$into.="`$fieldname`,";
				if($fieldtype=="double"){
					eval("\$values .= \"'\".unformated(\$$fieldname).\"',\";");
				}else{
					eval("\$values .= \"'\".\$$fieldname.\"',\";");
				}
			}
			$into=substr($into,0,strlen($into)-1).")";
			$values=substr($values,0,strlen($values)-1).")";
			$sql="INSERT INTO $tablename $into VALUES $values";
			mysql_query($sql,$db);
			// echo "<br>$sql => ".mysql_error();
			//INSERT DETAIL
			eval("\$countrow = count($$kodedetailname);");
			$seqno=-1;
			for($_seqno=0;$_seqno<$countrow;$_seqno++){
				eval("\$isvalue = $$kodedetailname"."[".$_seqno."]".";");
				if($isvalue){//ada isinya
					$seqno++;
					$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
					$hsltemp=mysql_query($sql,$db);
					$intodetail="(";
					$valuesdetail="(";
					while(list($fielddetailname,$fielddetailtype)=mysql_fetch_array($hsltemp)){
						$intodetail.="`$fielddetailname`,";
						if($fielddetailtype=="double"){
							eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".unformated(\$$fielddetailname"."[".$_seqno."]".").\"',\";}else{\$valuesdetail .= \"'\".unformated(\$$fielddetailname).\"',\";}");
						}else{
							eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".\$$fielddetailname"."[".$_seqno."]".".\"',\";}else{\$valuesdetail .= \"'\".\$$fielddetailname.\"',\";}");
						}
					}
					$intodetail=substr($intodetail,0,strlen($intodetail)-1).")";
					$valuesdetail=substr($valuesdetail,0,strlen($valuesdetail)-1).")";
					$sql="INSERT INTO $tabledetailname $intodetail VALUES $valuesdetail";
					mysql_query($sql,$db);
					// echo "<br>$sql => ".mysql_error();
				}
			}
			if($modebutton=="simpandancheckin"){
				$sql="UPDATE trx_booking SET confirmasi='1',confirmby='".$_SESSION["username"]."',confirmdate=NOW(),checkin='1',checkinby='".$_SESSION["username"]."',checkindate=NOW() WHERE kode='$kode'";
				mysql_query($sql,$db);
			}
		}
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."list.php";?>";
			</script>
		<?php
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function cekroomavailable(){
			var xmlHttp;
			room=document.getElementById("room").value;
			arrival=document.getElementById("arrival").value;
			departure=document.getElementById("departure").value;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					if(returnvalue!=""){
						alert(returnvalue);
						document.getElementById("room").focus();
					}
				}
			}
			xmlHttp.open("GET","ajax.cekroomavailable.php?kode=<?php echo $_GET["kode"]; ?>&room="+room+"&arrival="+arrival+"&departure="+departure,true);
			xmlHttp.send(null);	
		}
		function loadrate(room){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById("rate1").value=arrreturnvalue[0];
					document.getElementById("rate2").value=arrreturnvalue[1];
				}
			}
			xmlHttp.open("GET","ajax.loadrate.php?room="+room,true);
			xmlHttp.send(null);	
		}
		function loaddisc(discname){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					document.getElementById("disc").value=returnvalue;
				}
			}
			xmlHttp.open("GET","ajax.loaddisc.php?discname="+discname,true);
			xmlHttp.send(null);	
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<input type="hidden" id="grup" name="grup">
		<input type="hidden" id="dp2" name="dp2">
		<input type="hidden" id="dptype2" name="dptype2">
		<input type="hidden" id="dpbank2" name="dpbank2">
		<input type="hidden" id="dpdate2" name="dpdate2">
		<input type="hidden" id="refno2" name="refno2">
		<input type="hidden" id="dp3" name="dp3">
		<input type="hidden" id="dptype3" name="dptype3">
		<input type="hidden" id="dpbank3" name="dpbank3">
		<input type="hidden" id="dpdate3" name="dpdate3">
		<input type="hidden" id="refno3" name="refno3">
		<input type="hidden" id="dp4" name="dp4">
		<input type="hidden" id="dptype4" name="dptype4">
		<input type="hidden" id="dpbank4" name="dpbank4">
		<input type="hidden" id="dpdate4" name="dpdate4">
		<input type="hidden" id="refno4" name="refno4">
		<input type="hidden" id="dp5" name="dp5">
		<input type="hidden" id="dptype5" name="dptype5">
		<input type="hidden" id="dpbank5" name="dpbank5">
		<input type="hidden" id="dpdate5" name="dpdate5">
		<input type="hidden" id="refno5" name="refno5">
		<input type="hidden" id="roomtipe" name="roomtipe">
		<input type="hidden" id="jmlkamar" name="jmlkamar">
		<input type="hidden" id="rate" name="rate">
		<input type="hidden" id="confirmasi" name="confirmasi">
		<input type="hidden" id="checkin" name="checkin">
		<input type="hidden" id="checkinby" name="checkinby">
		<input type="hidden" id="checkindate" name="checkindate">
		<input type="hidden" id="confirmby" name="confirmby">
		<input type="hidden" id="confirmdate" name="confirmdate">
		<table width="100%"><tr><td align="center"><h3><b>RESERVATION</b></h3></td></tr></table>
		<table>
			<tr>
				<td valign="top">
					<table>
						<tr>
							<td>Reservation Code</td>
							<td>:</td>
							<td>
								<?php if($_GET["editing"]){ ?>
									<input type="text" id="kode" name="kode" readonly size="30">
								<?php } else { ?>
									<i>Auto Generate</i>
								<?php }  ?>
							</td>
						</tr>
						<tr>
							<td nowrap>Reservation Date</td>
							<td>:</td>
							<td>
								<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
								<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
							</td>
						</tr>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td>
								<select name="title" id="title">
									<option value="">-title-</option>
									<?php 
										$sql="SELECT kode,description FROM mst_name_title ORDER BY description";
										$hsltemp=mysql_query($sql,$db);
										while(list($_kode,$_title)=mysql_fetch_array($hsltemp)){
									?>
										<option value="<?php echo $_kode; ?>"><?php echo $_title; ?></option>
									<?php
										}
									?>
								</select>
								<input id="nama" type="text" name="nama" size="20">
							</td>
						</tr>
						<tr>
							<td nowrap>ID Number</td>
							<td>:</td>
							<td>
								<select name="idtype" id="idtype">
									<option value="">-tipe id-</option>
									<?php 
										$sql="SELECT kode,description FROM mst_id_type ORDER BY description";
										$hsltemp=mysql_query($sql,$db);
										while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
									?>
										<option value="<?php echo $_kode; ?>"><?php echo $_desc; ?></option>
									<?php
										}
									?>
								</select>
								<input id="idno" type="text" name="idno" size="20">
							</td>
						</tr>
						<tr>
							<td>Arrival</td>
							<td>:</td>
							<td>
								<input id="arrival" type="text" name="arrival" value="<?php echo $arrival; ?>" size="12">
								<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('arrival')">
							</td>
						</tr>
						<tr>
							<td>Departure</td>
							<td>:</td>
							<td>
								<input id="departure" type="text" name="departure" value="<?php echo $departure; ?>" size="12">
								<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('departure')">
							</td>
						</tr>
						<tr>
							<td valign="top">Room</td>
							<td valign="top">:</td>
							<td><div id="numberOfRooms">0 Room</div><br>
								<div id="reservationRooms" style="overflow:scroll; height:150px;width:150px;border:1px solid grey;">
									<?php 
										$sql="SELECT kode,nama FROM mst_room ORDER BY kode";
										if($_GET["roomtype"]){
											$sql="SELECT kode,nama FROM mst_room WHERE tipe='".$_GET["roomtype"]."' ORDER BY kode";
										}
										$hsltemp=mysql_query($sql,$db);
										while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
									?>
										<input onchange="loadNumberOfRooms();" type="checkbox" id="chkroom_<?=$_kode; ?>" name="rooms[<?=$_kode; ?>]" value="1" <?php if($_POST["rooms"][$_kode]){echo "checked";} ?>><?=$_desc; ?><br>
									<?php
										}
									?>
								</div>
								<!--select name="room" id="room" onchange="loadrate(this.value);cekroomavailable();">
									<option value="">-room-</option>
									<?php 
										$sql="SELECT kode,nama FROM mst_room ORDER BY kode";
										if($_GET["roomtype"]){
											$sql="SELECT kode,nama FROM mst_room WHERE tipe='".$_GET["roomtype"]."' ORDER BY kode";
										}
										$hsltemp=mysql_query($sql,$db);
										while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
									?>
										<option value="<?php echo $_kode; ?>"><?php echo $_desc; ?></option>
									<?php
										}
									?>
								</select-->
							</td>
						</tr>
						<tr>
							<td>Rate Week Days</td>
							<td>:</td>
							<td>
								<input id="rate1" type="text" name="rate1" size="20" style="text-align:right;">
							</td>
						</tr>
						<tr>
							<td>Rate Week End</td>
							<td>:</td>
							<td>
								<input id="rate2" type="text" name="rate2" size="20" style="text-align:right;">
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><textarea name="alamat" id="alamat" cols="50" rows="2"></textarea></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>
								<input id="phone" type="text" name="phone" size="20">
							</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>
								<input id="email" type="text" name="email" size="20">
							</td>
						</tr>
						<tr>
							<td>Company</td>
							<td>:</td>
							<td>
								<input id="company" type="text" name="company" size="40">
							</td>
						</tr>
						<tr>
							<td>Departement</td>
							<td>:</td>
							<td>
								<input id="departement" type="text" name="departement" size="40">
							</td>
						</tr>
						<!--tr>
							<td>Group</td>
							<td>:</td>
							<td>
								<input id="grup" type="text" name="grup" size="40">
							</td>
						</tr-->
					</table>
				</td>
				<td valign="top">
					<table>
						<tr>
							<td valign="top" nowrap>Down Payment <?php echo $xyz; ?></td>
							<td valign="top">:</td>
							<td valign="top" nowrap>
								<table>
									<tr>
										<td>Date</td>
										<td>
											<input id="dpdate" type="text" name="dpdate" value="<?php echo $dpdate; ?>" size="12">
											<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('dpdate')">
										</td>
									</tr>
									<tr>
										<td>Tipe Payment</td>
										<td>								
											<select name="dptype<?php echo $_noxx; ?>" id="dptype<?php echo $_noxx; ?>">
												<option value="">-tipe payment-</option>
												<?php 
													$sql="SELECT kode,description FROM mst_pay_type ORDER BY description";
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
									<tr>
										<td>Nominal</td>
										<td>
											Rp.<input id="dp<?php echo $_noxx; ?>" type="text" name="dp<?php echo $_noxx; ?>" size="20" style="text-align:right;">
										</td>
									</tr>
									<tr>
										<td>Bank</td>
										<td>
											<select name="dpbank<?php echo $_noxx; ?>" id="dpbank<?php echo $_noxx; ?>">
												<option value="">-Pilih Bank-</option>
												<?php
													$sql="SELECT coa,description FROM acc_mst_coa WHERE koder='AKTIVA LANCAR' AND description LIKE '%bank%' ORDER BY description";
													$hsltemp=mysql_query($sql,$db);
													while(list($_kode,$description)=mysql_fetch_array($hsltemp)){
												?>
													<option value="<?php echo $_kode; ?>"><?php echo $description; ?></option>
												<?php
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Reference Number</td>
										<td>
											<input type="text" id="refno<?=$_noxx;?>" name="refno<?=$_noxx;?>" placeholder="Reference Number">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Person</td>
							<td>:</td>
							<td>
								<input id="person" type="text" name="person" size="3">
							</td>
						</tr>
						<tr>
							<td>Extra Person</td>
							<td>:</td>
							<td>
								<input id="extraperson" type="text" name="extraperson" size="2">
							</td>
						</tr>
						<tr>
							<td nowrap>Charge Extra Person (All)</td>
							<td>:</td>
							<td>
								<input id="chargeextraperson" type="text" name="chargeextraperson" size="20">
							</td>
						</tr>
						<tr>
							<td nowrap>Discount</td>
							<td>:</td>
							<td>
								<select name="discname" id="discname" onchange="loaddisc(this.value);">
									<option value="">-disc-</option>
									<?php 
										$sql="SELECT name FROM mst_discount ORDER BY id";
										$hsltemp=mysql_query($sql,$db);
										while(list($_name)=mysql_fetch_array($hsltemp)){
									?>
										<option value="<?php echo $_name; ?>"><?php echo $_name; ?></option>
									<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Disc</td>
							<td>:</td>
							<td><input type="text" size="3" name="disc" id="disc"> %</td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td>:</td>
							<td><textarea name="notes" id="notes" cols="50" rows="2"></textarea></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<script>
		function showingSimpanCheckin(){
			if(document.getElementById("arrival").value == "<?=date("Y-m-d");?>"){
				document.getElementById("simpanCheckin").style.visibility = "visible";
			} else {
				document.getElementById("simpanCheckin").style.visibility = "hidden";
			}
		}
		function loadNumberOfRooms(){
			var numberOfRooms = 0;
			<?php 
				$sql="SELECT kode,nama FROM mst_room ORDER BY kode";
				if($_GET["roomtype"]){
					$sql="SELECT kode,nama FROM mst_room WHERE tipe='".$_GET["roomtype"]."' ORDER BY kode";
				}
				$hsltemp=mysql_query($sql,$db);
				while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
					?> 
						if(document.getElementById("chkroom_<?=$_kode; ?>").checked == true){
							loadrate("<?=$_kode;?>");
							numberOfRooms++; 
						}
					<?php
				}
			?>
			if(numberOfRooms > 1){
				document.getElementById("numberOfRooms").innerHTML = numberOfRooms+" Rooms";
			} else if(numberOfRooms >= 0) {
				document.getElementById("numberOfRooms").innerHTML = numberOfRooms+" Room";
			}
		}
		loadNumberOfRooms();
	</script>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Simpan" onclick="modebutton.value='simpan';formsubmit.click();" onmousemove="showingSimpanCheckin();">
				<input type="button" id="simpanCheckin" style="visibility:hidden;" value="Simpan dan Checkin" onmousemove="showingSimpanCheckin();" onclick="modebutton.value='simpandancheckin';formsubmit.click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari kode [BOOK/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode="BOOK/".date("Ymd")."/";
		$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$periode=date("Y-m-01");
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
		?><script language="javascript">document.getElementById("tanggal").value="<?php echo $tanggal; ?>";</script><?php
		?><script language="javascript">document.getElementById("dpdate").value="<?php echo $tanggal; ?>";</script><?php
		if($_GET["arrivalDate"]){
			?><script language="javascript">document.getElementById("arrival").value="<?php echo $_GET["arrivalDate"]; ?>";</script><?php
		}
	}else{//load editing
		$kode=$_GET["kode"];
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp' AND field<>'id'";
		$hsltemp=mysql_query($sql,$db);
		$fieldselect="";
		while(list($fieldname)=mysql_fetch_array($hsltemp)){
			if($fieldname!=$kodename){
				$fieldselect.="`$fieldname`,";
			}
		}
		$fieldselect=substr($fieldselect,0,strlen($fieldselect)-1);
		$sql="SELECT $fieldselect FROM $tablename WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		$tablevalues=mysql_fetch_assoc($hsltemp);
		foreach ($tablevalues as $varname => $value){
			$value=str_ireplace(chr(13).chr(10)," ",$value);
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").value="<?php echo $value; ?>";</script><?php
		}
		
		$sql="SELECT grup,room FROM trx_booking WHERE kode='$kode'";
		$hsl = mysql_query($sql,$db);
		list($grup,$koderoom) = mysql_fetch_array($hsl);
		if(!$grup){
			$roomfocus = $koderoom;
			?><script language="javascript">document.getElementById("chkroom_<?=$koderoom; ?>").checked=true;</script><?php
		} else {
			$sql = "SELECT kode,room FROM trx_booking WHERE grup = '$grup'";
			$hsl = mysql_query($sql,$db);
			while(list($kodeBooking,$koderoom) = mysql_fetch_array($hsl)){
				$roomfocus = $koderoom;
				?><script language="javascript">document.getElementById("chkroom_<?=$koderoom; ?>").checked=true;</script><?php
			}
		}
		
		?><script language="javascript">loadNumberOfRooms();</script><?php
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
	}
	if($modebutton=="reload" || $modebutton=="simpan"){
		foreach($_POST as $var_id => $postvalue){
			if(is_array($postvalue)){
				if(!$tambahrow){
					for($zz=1;$zz<count($postvalue);$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
					$tambahrow=true;
				}
				foreach($postvalue as $seqno => $postvalue1){
					?><script language="javascript">document.getElementById("<?php echo $var_id; ?>[<?php echo $seqno; ?>]").value="<?php echo $postvalue1; ?>";</script><?php
				}
			}else{
				?><script language="javascript">document.getElementById("<?php echo $var_id; ?>").value="<?php echo $postvalue; ?>";</script><?php
			}
		}
	}
?>
<?php if($_GET["editing"]){ ?>
<script> 
	$("#reservationRooms").animate({scrollTop : $("#chkroom_<?=$roomfocus; ?>").offset().top-250},800);
</script>
<?php } ?>
<?php
	include_once "footer.php";
?>
