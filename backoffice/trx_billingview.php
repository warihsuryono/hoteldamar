<?php
	include_once "header.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	include_once "func_jurnal.php";
	$kode=$_GET["kode"];
	$sql = "SELECT rates FROM trx_billing WHERE kode = '".$kode."'";
	$hsltemp = mysql_query($sql,$db);
	list($_GET["rates"]) = mysql_fetch_array($hsltemp);
	$rates = unserialize(base64_decode($_GET["rates"]));
	$sql="SELECT kode,grup,booking FROM trx_billing WHERE grup IN (SELECT grup FROM trx_billing WHERE kode = '$kode') ORDER BY booking";
	$hsl=mysql_query($sql,$db);
	$affectted_row = mysql_affected_rows($db);
	if($affectted_row > 1){
		$_arrtemp = mysql_fetch_array($hsl);
		$_grupBilling = $_arrtemp["grup"];
		if(strtolower(substr($_grupBilling,0,4)) == "bill"){
			$multiroom = $affectted_row;
			$_parentBooking = $_arrtemp["booking"];
		} else {
			$multiroom = false;
		}
	} else if($affectted_row <= 0){
		?> <script> 
			alert("Ada kesalahan, silakan ulangi lagi!");
			window.history.back();
		</script><?php
		exit();
	} else {
		$multiroom = false;
	}
	
	
	$_withppn="1";
	$_withservice="1";
	$sql="SELECT booking,room,rate,rate2,chargeextraperson,restaurant,additional,subtotal1,subtotal2,dp,discname,disc,grandtotal,nett,paid FROM trx_billing WHERE kode='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking,$room,$rate1,$rate2,$chargeextraperson,$restaurant,$additional,$subtotal1,$subtotal2,$dp,$discname,$disc,$grandtotal,$_nett,$paid)=mysql_fetch_array($hsltemp);
	
	$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF(DATE(departure),DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$kodebooking'";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$__dp2,$__dp3,$__dp4,$__dp5,$dptype,$room,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
	// echo "<br>".$sql;
	// echo "<br>".$lamainap;
	$__dp=$__dp+$__dp2+$__dp3+$__dp4+$__dp5;
	$custtitle=$title;
	$custnama=$nama;	
	$namacust=$custtitle." ".$custnama;
	$sql="SELECT nama FROM mst_room WHERE kode='$room'";
	$hsltemp=mysql_query($sql,$db);
	list($room)=mysql_fetch_array($hsltemp);
	$tanggal=$departure;
	
	if($_GET["paid"]){
		$paymenttype=$_GET["paymenttype"];
		$coabank=$_GET["coabank"];
		$norek=$_GET["norek"];
		$paycash=un_formated($_POST["paycash"]);
		$payedc1=un_formated($_POST["payedc1"]);
		$coaedc1=$_POST["coaedc1"];
		$noedc1=$_POST["noedc1"];
		$payedc2=un_formated($_POST["payedc2"]);
		$coaedc2=$_POST["coaedc2"];
		$noedc2=$_POST["noedc2"];
		$paytrf=un_formated($_POST["paytrf"]);
		$coatrf=$_POST["coatrf"];
		$notrf=$_POST["notrf"];
		if($paymenttype=="01"){$modeuang="kas";}
		if($paymenttype=="02"){$modeuang="EDC";}
		if($paymenttype=="03"){$modeuang="EDC";}
		if($paymenttype=="04"){$modeuang="Bank";}
		
		if($multiroom) $sql="UPDATE trx_billing SET paymenttype='$paymenttype',paid=1 WHERE grup='$_grupBilling'";
		else $sql="UPDATE trx_billing SET paymenttype='$paymenttype',paid=1 WHERE kode='$kode'";
		mysql_query($sql,$db);
		
		$kodeBilling = $kode;
		if($multiroom) $grupBilling = $_grupBilling;
		else $grupBilling = "";
		if($paycash != 0){
			$sql = "INSERT INTO trx_billing_payments (kodeBilling,grupBilling,paid_at,paymenttype,nominal,coabank,noedc,created_at,created_by) VALUES ";
			$sql .= "('$kodeBilling','$grupBilling','$tanggal','01','$paycash','','',NOW(),'$__username')";
			mysql_query($sql,$db);
		}
		if($payedc1 != 0){
			$sql = "INSERT INTO trx_billing_payments (kodeBilling,grupBilling,paid_at,paymenttype,nominal,coabank,noedc,created_at,created_by) VALUES ";
			$sql .= "('$kodeBilling','$grupBilling','$tanggal','02','$payedc1','$coaedc1','$noedc1',NOW(),'$__username')";
			mysql_query($sql,$db);
		}
		if($payedc2 != 0){
			$sql = "INSERT INTO trx_billing_payments (kodeBilling,grupBilling,paid_at,paymenttype,nominal,coabank,noedc,created_at,created_by) VALUES ";
			$sql .= "('$kodeBilling','$grupBilling','$tanggal','02','$payedc2','$coaedc2','$noedc2',NOW(),'$__username')";
			mysql_query($sql,$db);
		}
		if($paytrf != 0){
			$sql = "INSERT INTO trx_billing_payments (kodeBilling,grupBilling,paid_at,paymenttype,nominal,coabank,noedc,created_at,created_by) VALUES ";
			$sql .= "('$kodeBilling','$grupBilling','$tanggal','04','$paytrf','$coatrf','$notrf',NOW(),'$__username')";
			mysql_query($sql,$db);
		}
	}
?>
<?php
		
		if($multiroom) $kodebooking=$_parentBooking;
		$_booking=$kodebooking;
		$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF('$tanggal',DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$_booking'";
		$hsltemp=mysql_query($sql,$db);
		list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$__dp2,$__dp3,$__dp4,$__dp5,$dptype,$room,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
		$__dp=$__dp+$__dp2+$__dp3+$__dp4+$__dp5;
		
		$_periodetrx=substr($tanggal,0,8);
		$sql="SELECT description FROM mst_name_title WHERE kode='$title'";$hsltemp=mysql_query($sql,$db);
		list($title)=mysql_fetch_array($hsltemp);
		$sql="SELECT description FROM mst_id_type WHERE kode='$idtype'";$hsltemp=mysql_query($sql,$db);
		list($idtype)=mysql_fetch_array($hsltemp);
		
		$kdroom=$room;
		if($multiroom){
			$room = $multiroom." Rooms";
			$sql = "SELECT sum(person) FROM trx_booking WHERE kode IN (SELECT booking FROM trx_billing WHERE grup='$_grupBilling')";$hsltemp=mysql_query($sql,$db);
			list($person)=mysql_fetch_array($hsltemp);
		}else{
			$sql="SELECT description FROM mst_pay_type WHERE kode='$dptype'";$hsltemp=mysql_query($sql,$db);
			list($dptype)=mysql_fetch_array($hsltemp);	
			$sql="SELECT nama FROM mst_room WHERE kode='$room'";$hsltemp=mysql_query($sql,$db);
			list($room)=mysql_fetch_array($hsltemp);
		}
		
		$sql="SELECT sum(grandtotal) FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
		$hsltemp=mysql_query($sql,$db);
		list($__totaladditional)=mysql_fetch_array($hsltemp);
		//cari restaurant
		$sql="SELECT sum(grandtotal) FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
		$hsltemp=mysql_query($sql,$db);
		list($__totalrestaurant)=mysql_fetch_array($hsltemp);
		//cari store
		$sql="SELECT sum(total_amount) FROM trx_pos WHERE kodebooking='$kodebooking' AND paid='2'";
		$hsltemp=mysql_query($sql,$db);
		list($__totalstore)=mysql_fetch_array($hsltemp);
		//cari total rate
		$price=$rate1;
		$price2=$rate2;
		//echo "<br>$price,$price2";
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
			$totalrate+=$rates[$kdroom][$_tanggalxx];
			//echo "<br>$_tanggalxx ( $tipeday ) :$totalrate";
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
		$__grandtotal=($__totalroom+$__totalrestaurant+$__totaladditional+$__totalstore)-$__dp;
		?>		
		<div id="divpay" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
			<form method="POST" action="<?php echo $__phpself;?>?paid=1&kode=<?php echo $_GET["kode"]; ?>">
				<table border="0" bgcolor="c5f05e">
					<tr>
						<td><b>Cash</b></td>
						<td><b>:</b></td>
						<td><input type="text" name="paycash" id="paycash" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
					</tr>
					<tr>
						<td><b>EDC 1</b></td>
						<td><b>:</b></td>
						<td><input type="text" name="payedc1" id="payedc1" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
						<td>
							<select name="coaedc1" id="coaedc1">
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
								<option></option>
							</select>
						</td>
						<td><input type="text" name="noedc1" id="noedc1" size="30"></td>
					</tr>
					<tr>
						<td><b>EDC 2</b></td>
						<td><b>:</b></td>
						<td><input type="text" name="payedc2" id="payedc2" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
						<td>
							<select name="coaedc2" id="coaedc2">
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
								<option></option>
							</select>
						</td>
						<td><input type="text" name="noedc2" id="noedc2" size="30"></td>
					</tr>
					<tr>
						<td><b>Transfer</b></td>
						<td><b>:</b></td>
						<td><input type="text" name="paytrf" id="paytrf" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
						<td>
							<select name="coatrf" id="coatrf">
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
								<option></option>
							</select>
						</td>
						<td><input type="text" name="notrf" id="notrf" size="30"></td>
					</tr>
					<tr>
						<td colspan="5" align="center">
							<input type="submit" name="ok" value="PAY">
							<input type="button" value="Close" onclick="divpay.style.visibility='hidden';">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="divpay_old" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
			<table border="0" bgcolor="c5f05e">
				<tr>
					<td><b>Metode Bayar</b></td>
					<td>:</b></td>
					<td>
						<select name="paymenttype" id="paymenttype">
							<?php
								$sql="SELECT kode,description FROM mst_pay_type ORDER BY kode";
								$hsltemp=mysql_query($sql,$db);
								while(list($_kode,$description)=mysql_fetch_array($hsltemp)){
							?>
								<option value="<?php echo $_kode; ?>"><?php echo $description; ?></option>
							<?php
								}
							?>
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Bank</b></td>
					<td>:</b></td>
					<td>
						<select name="coabank" id="coabank">
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
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>No Card / No Rek</b></td>
					<td>:</b></td>
					<td><input type="text" name="norek" id="norek"></td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="button" value="OK" id="paidbutton" onclick="window.location='<?php echo $__phpself;?>?paid=1&kode=<?php echo $_GET["kode"]; ?>&paymenttype='+paymenttype.value+'&coabank='+coabank.value+'&norek='+norek.value;">
					</td>
				</tr>
			</table>
		</div>
		<div id="printarea">
		<?php $__captiontitle="GUEST BILL";include_once "header_document.php"; ?>
		<fieldset>
			<table width="100%">
				<tr>
					<td valign="top" width="45%">
						<table width="100%">
							<tr>
								<td nowrap><b>Bill No</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $kode; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Room</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $room; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Date</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo format_tanggal($tanggal); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Guest Name</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $title." ".$nama; ?></td>
							</tr>
							<!--tr>
								<td nowrap><b>ID Number</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $idno." ($idtype)"; ?></td>
							</tr-->
						</table>
					<td>
					<td valign="top" width="10%">&nbsp;</td>
					<!--td valign="top" width="25%">
						<table width="25%">
							<tr>
								<td nowrap><b>Address</b></td>
								<td><b>:</b></td>
								<td><?php echo $alamat; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Phone</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $phone; ?></td>
							</tr>
							<tr>
								<td nowrap><b>E-Mail</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $email; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Company</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $company; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Department</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo $departement; ?></td>
							</tr>
							<!--tr>
								<td><b>Group</b></td>
								<td><b>:</b></td>
								<td><?php echo $grup; ?></td>
							</tr->
						</table>
					<td-->
					<td valign="top" width="45%">
						<table width="100%">
							<tr>
								<td nowrap><b>Arrival Date</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo format_tanggal3($arrival); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Departure Date</b></td>
								<td><b>:</b></td>
								<td nowrap><?php echo format_tanggal3($tanggal); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Rate</b></td>
								<td><b>:</b></td>
								<td nowrap align="right"><?php echo number_format($rate1); ?> / <?php echo number_format($rate2); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Person</b></td>
								<td><b>:</b></td>
								<td align="right"><?php echo $person; ?></td>
							</tr>
						</table>
					<td>
					<!--td valign="top" width="25%">
						<table width="25%">
							<tr>
								<td nowrap><b>Charge Person</b></td>
								<td><b>:</b></td>
								<td align="right" nowrap><?php echo "($extraperson) ".number_format($chargeextraperson); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Long Stay(s)</b></td>
								<td><b>:</b></td>
								<td align="right"><?php echo $lamainap; ?></td>
							</tr>
							<tr>
								<td nowrap><b>Down Payment</b></td>
								<td><b>:</b></td>
								<td align="right"><?php echo number_format($__dp); ?></td>
							</tr>
							<!--tr>
								<td nowrap><b>Restaurant</b></td>
								<td><b>:</b></td>
								<td align="right"><?php echo number_format($totalrestaurant); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Miscellaneous</b></td>
								<td><b>:</b></td>
								<td align="right"><?php echo number_format($totaladditional); ?></td>
							</tr>
							<tr>
								<td nowrap><b>Notes</b></td>
								<td><b>:</b></td>
								<td><?php echo $notes; ?></td>
							</tr>
						</table>
					</td-->
				<tr>
			</table>
		</fieldset>
		<fieldset>
			<legend><b>Guest Bill Detail</b></legend>
			<table width="100%">
				<tr>
					<td nowrap width="15%"><b>Date</b></td>
					<td nowrap width="55%"><b>Description</b></td>
					<td nowrap width="15%" align="right"><b>Debit</b></td>
					<td nowrap width="15%" align="right"><b>Credit</b></td>
				</tr>
				<tr><td colspan="4"><hr></td><tr>
				<?php
				if($multiroom) $sql="DELETE FROM trx_billing_details WHERE kode IN (SELECT kode FROM trx_billing WHERE grup='$_grupBilling')";
				else $sql="DELETE FROM trx_billing_details WHERE kode='".$kode."'";
				mysql_query($sql,$db);
				if($multiroom) $sql = "SELECT booking FROM trx_billing WHERE grup='$_grupBilling' ORDER BY booking";
				else $sql = "SELECT booking FROM trx_billing WHERE kode='$kode' ORDER BY booking";
				$hslBookings = mysql_query($sql,$db);
				while(list($kodebooking) = mysql_fetch_array($hslBookings)){
					//deposits
					$sql="SELECT dp,dptype,dpbank,dpdate,refno,dp2,dptype2,dpbank2,dpdate2,refno2,dp3,dptype3,dpbank3,dpdate3,refno3,dp4,dptype4,dpbank4,dpdate4,refno4,dp5,dptype5,dpbank5,dpdate5,refno5 FROM trx_booking WHERE kode='".$kodebooking."'";
					$hsltemp=mysql_query($sql,$db);
					list($dp,$dptype,$dpbank,$dpdate,$refno,$dp2,$dptype2,$dpbank2,$dpdate2,$refno2,$dp3,$dptype3,$dpbank3,$dpdate3,$refno3,$dp4,$dptype4,$dpbank4,$dpdate4,$refno4,$dp5,$dptype5,$dpbank5,$dpdate5,$refno5)=mysql_fetch_array($hsltemp);
					$arrdp[1]=$dp ;$arrdptype[1]=$dptype; $arrdpbank[1]=$dpbank; $arrdpdate[1]=$dpdate; $arrrefno[1]=$refno;
					$arrdp[2]=$dp2;$arrdptype[2]=$dptype2;$arrdpbank[2]=$dpbank2;$arrdpdate[2]=$dpdate2;$arrrefno[2]=$refno2;
					$arrdp[3]=$dp3;$arrdptype[3]=$dptype3;$arrdpbank[3]=$dpbank3;$arrdpdate[3]=$dpdate3;$arrrefno[3]=$refno3;
					$arrdp[4]=$dp4;$arrdptype[4]=$dptype4;$arrdpbank[4]=$dpbank4;$arrdpdate[4]=$dpdate4;$arrrefno[4]=$refno4;
					$arrdp[5]=$dp5;$arrdptype[5]=$dptype5;$arrdpbank[5]=$dpbank5;$arrdpdate[5]=$dpdate5;$arrrefno[5]=$refno5;
					foreach($arrdp as $xx => $dp){
						if($dp > 0){
							$sql = "SELECT description FROM mst_pay_type WHERE kode = '".$arrdptype[$xx]."'";$hsltemp = mysql_query($sql,$db);
							list($paytype) = mysql_fetch_array($hsltemp);
							if($arrdptype[$xx] != "01"){
								$sql = "SELECT description FROM acc_mst_coa WHERE coa = '".$arrdpbank[$xx]."'";$hsltemp = mysql_query($sql,$db);
								list($bank) = mysql_fetch_array($hsltemp);
								$paytype .= " -- ".$bank;
							}
							$description = "Deposit [$paytype]";
							if($arrrefno[$xx]) $description .= " ;Refno: ".$arrrefno[$xx];
							$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,credit) VALUES ('$kode','".$arrdpdate[$xx]."','$description','$dp')";
							mysql_query($sql,$db);
						}
					}
					
					//room
					$sql = "SELECT kode,nama FROM mst_room WHERE kode IN (SELECT room FROM trx_booking WHERE kode='$kodebooking')";$hsltemp = mysql_query($sql,$db);
					list($_kdroom,$roomname) = mysql_fetch_array($hsltemp);
					$_tanggalxx=$arrival;
					while($_tanggalxx!=$tanggal){
						$arrtgl=explode("-",$_tanggalxx);
						$_tgl=$arrtgl[2]; $_bln=$arrtgl[1]; $_thn=$arrtgl[0];
						$tipeday=date("N",mktime(0,0,0,$_bln,$_tgl,$_thn));
						$nominal = $rates[$_kdroom][$_tanggalxx];
						if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
							$description = "Room Charge -- $roomname (Week Days)";
							if($nominal == 0 && $_tanggalxx < "2018-02-15") $nominal = $rate1;
						}else{
							$description = "Room Charge -- $roomname (Week Ends)";
							if($nominal == 0 && $_tanggalxx < "2018-02-15") $nominal = $rate2;
						}
						$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$_tanggalxx."','$description','$nominal')";
						mysql_query($sql,$db);
						$_tanggalxx=date("Y-m-d",mktime(0,0,0,$_bln,$_tgl+1,$_thn));
					}
					//miscellaneous
					$sql="SELECT kode FROM trx_additional_detail WHERE kode IN (SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')) ORDER BY kode,seqno";
					$hslrest=mysql_query($sql,$db);
					if(mysql_affected_rows($db)>0){
					}
					$sql="SELECT kode,tanggal,paid,refno FROM trx_additional WHERE kodebooking='$kodebooking' ORDER BY kode";
					$hsladditionals = mysql_query($sql,$db);
					while(list($kode_additional,$additionalDate,$paid,$refno) = mysql_fetch_array($hsladditionals)){
						$sql="SELECT kode,kode_add,qty,(price * qty),keterangan FROM trx_additional_detail WHERE kode='$kode_additional'  ORDER BY kode,seqno";
						$hsladditionaldetail=mysql_query($sql,$db);
						while(list($billno,$addid,$qty,$price,$keterangan)=mysql_fetch_array($hsladditionaldetail)){
							$sql="SELECT description FROM mst_additional WHERE kode='$addid'";$hsltemp=mysql_query($sql,$db);
							list($additional)=mysql_fetch_array($hsltemp);
							$description = "Miscellaneous -- $additional";
							if($keterangan != "") $description .= " ($keterangan)";
							if($refno) $description .= " ;Refno: ".$refno;
							$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$additionalDate."','$description','$price')";
							mysql_query($sql,$db);
							if($paid == 1){
								$description = "Miscellaneous Paid -- $additional";
								$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,credit) VALUES ('$kode','".$additionalDate."','$description','$price')";
								mysql_query($sql,$db);
							}
						}
					}
				}
				//latecheckout
				$latecheckout = 0;
				if($multiroom) $sql="SELECT tanggal,latecheckoutFee FROM trx_billing WHERE grup='$_grupBilling' AND latecheckoutFee > 0 LIMIT 1";
				else $sql="SELECT tanggal,latecheckoutFee FROM trx_billing WHERE kode='$kode' AND latecheckoutFee > 0 LIMIT 1";
				$hsltemp=mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
					list($latecheckoutDate,$latecheckout) = mysql_fetch_array($hsltemp);
					$description = "Late Checkout Fee";
					$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$latecheckoutDate."','$description','$latecheckout')";
					mysql_query($sql,$db);
				}
				
				$rowdetail = 0;
				$_debit = 0;
				$_credit = 0;
				$totDeposit = 0;
				$totRoom = 0;
				$totMiscellaneous = 0;
				$sql="SELECT tanggal,description,debit,credit FROM trx_billing_details WHERE kode='$kode' ORDER BY tanggal,id";
				$hslbillings = mysql_query($sql,$db);
				while(list($tanggalbiling,$description,$debit,$credit) = mysql_fetch_array($hslbillings)){
					if($debit == 0) $debit = "";
					if($credit == 0) $credit = "";
					$rowdetail++;
					$_debit += $debit;
					$_credit += $credit;
					if(strpos(" ".$description,"Deposit") > 0) $totDeposit += $credit;
					if(strpos(" ".$description,"Room Charge ") > 0) $totRoom += $debit;
					if(strpos(" ".$description,"Miscellaneous --") > 0) $totMiscellaneous += $debit;
					if(strpos(" ".$description,"Miscellaneous Paid") > 0) $totDeposit += $credit;
				?>
				<tr>
					<td><?=format_tanggal3($tanggalbiling);?></td>
					<td><?=$description;?></td>
					<td align="right"><?=number_format($debit);?></td>
					<td align="right"><?=number_format($credit);?></td>
				</tr>
				<?php 
				} 
				
				for($xx = $rowdetail; $xx <= 18; $xx++){
					?><tr><td colspan="4">&nbsp;</td></tr><?php
				}
				$balance = $totDeposit - $totRoom - $totMiscellaneous - $latecheckout;
				$__grandtotal = $balance;
				if($__grandtotal < 0) $__grandtotal = $__grandtotal * -1;
				if($totDeposit > $totRoom + $totMiscellaneous) $__grandtotal = $__grandtotal * -1;
				if($balance < 0) $balance = "<td></td><td align='right'><b>".number_format($balance * -1)."</b></td>";
				else $balance = "<td align='right'><b>".number_format($balance)."</b></td>";
				?>
				<tr><td></td><td align="right">Deposit</td><td></td><td align="right"><?=number_format($totDeposit);?></td></tr>
				<tr><td></td><td align="right">Room Charge</td><td align="right"><?=number_format($totRoom);?></td></tr>
				<tr><td></td><td align="right">Miscellaneous</td><td align="right"><?=number_format($totMiscellaneous);?></td></tr>
				<?php if($latecheckout > 0){ ?>
					<tr><td></td><td align="right">Late Checkout Fee</td><td align="right"><?=number_format($latecheckout);?></td></tr>
				<?php } ?>
				<tr><td></td><td colspan="3"><hr></td></tr>
				<tr><td></td><td align="right"><b>Balance</b></td><?=$balance;?></tr>
				
			</table>
		</fieldset>
		<br><br>
		<table width="25%">
			<tr><td width="20%"></td><td align="center">Guest Signature</td></tr>
			<tr><td></td><td><br><br><br><br><br><br><br></td></tr>
			<tr><td></td><td align="center"><hr></td></tr>
		</table>
		</div>
		<div id="buttonrowdiv">
		<input type="button" value="Back" id="backbutton" onclick="window.location='trx_billinglist.php'">
		<?php
			$sql="SELECT paid FROM trx_billing WHERE kode='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($paid)=mysql_fetch_array($hsltemp);
		?>
		<?php if(!$paid){ ?>
		<input type="button" value="Pay" id="paidbutton" onclick="divpay.style.visibility='visible';paycash.focus()">
		<?php }else{ ?>
			PAID !
		<?php } ?>
		<!--input type="button" value="Print" id="printbutton" onclick="buttonrowdiv.style.visibility='hidden';window.print();buttonrowdiv.style.visibility='visible';"-->
		<input type="button" value="Print" id="printbutton" onclick="document.getElementById('printarea').className = 'print_mode';buttonrowdiv.style.visibility='hidden';window.print();buttonrowdiv.style.visibility='visible';document.getElementById('printarea').className = '';">
		</div>
<script language="javascript">
	paycash.value="<?php echo number_format($__grandtotal);?>";
	paycash.focus();
</script>
<?php
	include_once "footer.php";
?>