<?php
	include_once "header.php";
	include_once "func.openwin.php";
	include_once "ajax.init.php";
?>
<script language="javascript">
		function loadRoomRate(){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					document.getElementById("RoomRate").innerHTML=returnvalue;
					var iframe_height=document.getElementById('content_body_id').scrollHeight;
					var iframe_width=document.getElementById('content_body_id').scrollWidth;
					iframe_height=iframe_height+20;
					iframe_width=iframe_width+20;
					window.parent.document.getElementById('main_frame_id').height=iframe_height;
					window.parent.document.getElementById('main_frame_id').width=iframe_width;
				}
			}
			var tanggal = document.getElementById("tanggal").value;
			var book_chk = document.getElementById("reservationCodes").getElementsByTagName("input");
			var books = "";
			for(var ii = 0 ; ii < book_chk.length ; ii++){
				if(book_chk[ii].checked == true){ books += book_chk[ii].id.replace("chkbooking_","") + "|"; }
			}
			xmlHttp.open("GET","ajax.loadRoomRate.php?tanggal="+tanggal+"&books="+books,true);
			xmlHttp.send(null);	
		}
</script>
<?php
	if($_GET["correctingArrivalDate"]){
		$arrivalDate = $_GET["correctingArrivalDate"];
		$falseBookingArrival = explode("|",$_GET["falseBookingArrival"]);
		foreach($falseBookingArrival as $_booking){
			$sql = "UPDATE trx_booking SET arrival='".$arrivalDate."',checkindate='".$arrivalDate." 12:00:00' WHERE kode='".$_booking."'";
			mysql_query($sql,$db);
			$_POST["booking"][$_booking] = "1";
		}
		$_POST["tanggal"] = $_GET["departure"];
		$_POST["nett"] = $_GET["nett"];
		$_POST["latecheckoutFee"] = $_GET["latecheckoutFee"];
		$_POST["calculate"] = "Calculate Bill";
	}
	
	if(!$_POST["tanggal"]){$tanggal=date("Y-m-d");}else{$tanggal=$_POST["tanggal"];}
?>
	<?php if(!$_POST["calculate"]){ ?>
		<form method="POST" action="<?php echo $__phpself; ?>">
			<fieldset>
				<legend><b>Guest Bill</b></legend>
				<table>
					<tr>
						<td valign="top">
							<table>
								<tr>
									<td><b>Bill No<b></td>
									<td><b>:<b></td>
									<td><i>Auto Generate</i></td>
								</tr>
								<tr>
									<td><b>Tanggal</b></td>
									<td><b>:</b></td>
									<td>
										<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12" onkeyup="loadRoomRate();">
										<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
									</td>
								</tr>
								<tr>
									<td valign="top"><b>Reservation Code<b></td>
									<td valign="top"><b>:<b></td>
									<td>
										<div id="reservationCodes" style="overflow:scroll; height:400px;width:400px;border:1px solid grey;">
											<table>
											<?php
												$sql="SELECT grup FROM trx_booking WHERE kode='".$_GET["booking_kode"]."'";
												$hsl = mysql_query($sql,$db);
												list($grup) = mysql_fetch_array($hsl);
												if(!$grup){
													$kodes[$_GET["booking_kode"]] = 1;
												} else {
													$sql = "SELECT kode FROM trx_booking WHERE grup = '$grup'";
													$hsl = mysql_query($sql,$db);
													while(list($kodeBooking) = mysql_fetch_array($hsl)){
														$kodes[$kodeBooking] = 1;
													}
												}
												$sql="SELECT kode,arrival,departure,nama,room FROM trx_booking WHERE room<>'' AND kode NOT IN (SELECT booking FROM trx_billing WHERE paid='1') ORDER BY departure DESC,nama,room LIMIT 200";
												$hslbook=mysql_query($sql,$db);
												while(list($_kode,$_arrival,$_tanggal,$_nama,$_room)=mysql_fetch_array($hslbook)){
													$sql="SELECT nama FROM mst_room WHERE kode='$_room'";
													$hsltemp=mysql_query($sql,$db);
													list($_room)=mysql_fetch_array($hsltemp);
													$ischecked = "";
													if($_POST["booking"][$_kode] || $_GET["booking_kode"] == $_kode || $kodes[$_kode]){$ischecked = "checked";}
											?>
												<tr>
													<td><input onchange="loadRoomRate();" type="checkbox" id="chkbooking_<?=str_replace("/","_",$_kode); ?>" name="booking[<?=$_kode; ?>]" value="1" <?=$ischecked;?>></td>
													<td>
														Kode Booking:<?=$_kode; ?> <b><?=format_tanggal3($_tanggal); ?></b><br>
														[Room:<b><?=$_room; ?></b>;C/I: <?=format_tanggal3($_arrival); ?>]  <b><?=$_nama; ?></b>
													</td>
												</tr>
											<?php
												}
											?>
											</table>
										</div>
									</td>
								</tr>	
								<tr>
									<td nowrap><b>Late Checkout Fee</b></td>
									<td><b>:</b></td>
									<td nowrap>
										Rp. <input name="latecheckoutFee" id="latecheckoutFee">
									</td>
								<tr>			
								<tr>
									<td><b>Nett</b></td>
									<td><b>:</b></td>
									<td nowrap>
										<input type="checkbox" name="nett" id="nett" checked onclick="return false;" value="1" <?php if(isset($_POST["nett"])){echo "checked";} ?>>NETT
									</td>
								<tr>			
								<tr>
									<td colspan="3"><input type="submit" name="calculate" value="Calculate Bill"></td>
								</tr>
							</table>
						</td>
						<td width="1">&nbsp;</td>
						<td valign="top" id="RoomRate" width="1"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	<?php } ?>
	<?php
		if($_POST["calculate"]){
			foreach($_POST["booking"] as $_booking => $val){
				$sql="SELECT kode,grup FROM trx_billing WHERE booking='$_booking'";$hsltemp = mysql_query($sql,$db);
				list($kodebilling,$kodegrup) = mysql_fetch_array($hsltemp);
				$sql="DELETE FROM trx_billing_details WHERE kode='$kodebilling'";
				mysql_query($sql,$db);
				$sql="DELETE FROM trx_billing WHERE booking='$_booking'";
				mysql_query($sql,$db);
				if($kodegrup != "" && $kodegrup != 0){
					$sql="DELETE FROM trx_billing WHERE grup='$kodegrup'";
					mysql_query($sql,$db);
				}
			}
			$billinggrup = "";

			$arrivalValid=true;
			foreach($_POST["booking"] as $_booking => $val){
				$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF('$tanggal',DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$_booking'";
				$hsltemp=mysql_query($sql,$db);
				list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$__dp2,$__dp3,$__dp4,$__dp5,$dptype,$room,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
				if($arrival == "0000-00-00"){ $arrivalValid=false; break; }
				if($lamainap<=0 || $lamainap > 120){ $arrivalValid=false;break; }
			}
			
			if($arrivalValid){
				foreach($_POST["booking"] as $_booking => $val){
					$createby=$_SESSION["username"];		
					$tanggal=$_POST["tanggal"];
					$payment=$_POST["payment"];
					$coabank=$_POST["coabank"];
					$norek=$_POST["norek"];
					$_room=$_POST["room"];
					// $_booking=$_POST["booking"];
					$_withppn="1";
					$_withservice="1";
					$_nett="0";
					if(isset($_POST["nett"])){$_nett="1";$_withppn="0";$_withservice="0";}
					$latecheckoutFee=$_POST["latecheckoutFee"];
					$_periodetrx=substr($tanggal,0,8);
					//$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF('$tanggal',DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE room='$_room' AND checkin='1' AND checkindate<='$tanggal' AND kode NOT IN (SELECT booking FROM trx_billing WHERE tanggal LIKE '".$_periodetrx."%') ORDER BY tanggal DESC LIMIT 1";
					$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF('$tanggal',DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$_booking'";
					$hsltemp=mysql_query($sql,$db);
					list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$__dp2,$__dp3,$__dp4,$__dp5,$dptype,$room,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
					
					
					$__dp=$__dp+$__dp2+$__dp3+$__dp4+$__dp5;
					$sql="UPDATE trx_booking SET arrival=DATE(checkindate),departure='$tanggal' WHERE kode='$kodebooking'";
					mysql_query($sql,$db);
					$sql="SELECT description FROM mst_name_title WHERE kode='$title'";$hsltemp=mysql_query($sql,$db);
					list($title)=mysql_fetch_array($hsltemp);
					$sql="SELECT description FROM mst_id_type WHERE kode='$idtype'";$hsltemp=mysql_query($sql,$db);
					list($idtype)=mysql_fetch_array($hsltemp);
					$sql="SELECT description FROM mst_pay_type WHERE kode='$dptype'";$hsltemp=mysql_query($sql,$db);
					list($dptype)=mysql_fetch_array($hsltemp);
					$kdroom=$room;
					$sql="SELECT nama FROM mst_room WHERE kode='$room'";$hsltemp=mysql_query($sql,$db);
					list($room)=mysql_fetch_array($hsltemp);
					//rate,chargeextraperson,restaurant,additional,subtotal1,ppn,subtotal2,service,grandtotal,paymenttype
					//cari additional
					$sql="SELECT sum(grandtotal) FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
					$hsltemp=mysql_query($sql,$db);
					list($__totaladditional)=mysql_fetch_array($hsltemp);
					//cari restaurant
					$sql="SELECT sum(grandtotal) FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
					$hsltemp=mysql_query($sql,$db);
					list($__totalrestaurant)=mysql_fetch_array($hsltemp);
					$price=$rate1;
					$price2=$rate2;
					$totalrate=0;
					$_tanggalxx=$arrival;
					while($_tanggalxx!=$tanggal){
						//cari tipe days
						$arrtgl=explode("-",$_tanggalxx);
						$_tgl=$arrtgl[2];
						$_bln=$arrtgl[1];
						$_thn=$arrtgl[0];
						
						/* $tipeday=date("N",mktime(0,0,0,$_bln,$_tgl,$_thn));
						if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
							$totalrate+=$price;
						}else{
							$totalrate+=$price2;
						} */
						$totalrate+=$_POST["rate"][$kdroom][$_tanggalxx];
						
						$_tanggalxx=date("Y-m-d",mktime(0,0,0,$_bln,$_tgl+1,$_thn));
					}
					$__ppn=0;
					$__service=0;
					
					//with nett
					if($_nett){
						$totalrate_service=(100*$totalrate)/111;
						$__service=$totalrate-$totalrate_service;
						$totalrate_ppn=(100*$totalrate_service)/110;
						$__ppn=$totalrate_service-$totalrate_ppn;
						$totalrate=$totalrate-($__service+$__ppn);
					}
					
					$__subtotal1=$totalrate+($lamainap*$chargeextraperson);
					$_discount=$__subtotal1*($__disc/100);
					$__subtotal2=$__subtotal1-$_discount;
					if($_withppn || true){$__ppn=$__subtotal2*0.1;}
					$__subtotal3=$__subtotal2+$__ppn;
					if($_withservice || true){$__service=$__subtotal3*0.11;}
					$__totalroom=$__subtotal3+$__service;
					$__grandtotal=($__totalroom+$__totalrestaurant+$__totaladditional)-$__dp;
					
					$kode="BILL/".date("Ymd")."/";
					$sql="SELECT idseqno FROM trx_billing WHERE kode LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
					$hsltemp=mysql_query($sql,$db);
					list($idseqno)=mysql_fetch_array($hsltemp);
					$idseqno++;
					$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
					if($billinggrup=="") $billinggrup = $kode;
					
					$sql="INSERT INTO trx_billing (kode,grup,idseqno,tanggal,booking,room,withppn,withservice,nett,rate,rate2,chargeextraperson,restaurant,additional,subtotal1,ppn,subtotal2,service,latecheckoutFee,dp,discname,disc,grandtotal,paymenttype,coabank,norek,createby,createdate) VALUES ";
					$sql.="('$kode','$billinggrup','$idseqno','$tanggal','$kodebooking','$kdroom','$_withppn','$_withservice','$_nett','$rate1','$rate2','$chargeextraperson','$totalrestaurant','$totaladditional','$__subtotal1','$__ppn','$__subtotal2','$__service','$latecheckoutFee','$__dp','$__discname','$__disc','$__grandtotal','$payment','$coabank','$norek','$createby',NOW())";
					mysql_query($sql,$db);
					$sql="UPDATE mst_room SET available='0',booked='0' WHERE kode='$kdroom'";
					mysql_query($sql,$db);
				}
				?>
				<script language="javascript">
					window.location="trx_billingview.php?kode=<?php echo $kode; ?>&rates=<?=base64_encode(serialize($_POST["rate"]));?>";
				</script>
				<?php 
				exit(); 
			} else {
				$falseBookingArrival = "";
				foreach($_POST["booking"] as $_booking => $val){ $falseBookingArrival .= $_booking."|"; }
				$falseBookingArrival = substr($falseBookingArrival,0,-1);
				$_d = substr($_POST["tanggal"],8,2) - 1;
				$_m = substr($_POST["tanggal"],5,2);
				$_y = substr($_POST["tanggal"],0,4);
				?>
				<script language="javascript">
					var arrivalDate = prompt("Ada kesalahan tanggal checkin, Silakan masukkan tanggal checkin", "<?=date("Y-m-d",mktime(0,0,0,$_m,$_d,$_y));?>");
					if (arrivalDate != null) {
						window.location = "?correctingArrivalDate="+arrivalDate+"&departure=<?=$_POST["tanggal"];?>&latecheckoutFee=<?=$_POST["latecheckoutFee"];?>&nett=<?=$_POST["nett"];?>&falseBookingArrival=<?=$falseBookingArrival;?>";
					}
				</script>
				<?php 
				exit();
			}
		}
	?>
	<?php if($_GET["booking_kode"] != ""){ ?>
	<script> 
		document.getElementById("tanggal").value = "<?=$_GET["checkoutDate"];?>"; 
		$("#reservationCodes").animate({scrollTop : $("#chkbooking_<?=str_replace("/","_",$_GET["booking_kode"]); ?>").offset().top-60},800);
		loadRoomRate();
	</script>
	<?php } ?>
<?php
	include_once "footer.php";
?>