<?php
	include_once "header.php";
	include_once "func.openwin.php";
	if(!$_POST["tanggal"]){$tanggal=date("Y-m-d");}else{$tanggal=$_POST["tanggal"];}
	$kode="BILL/".date("Ymd")."/";
	$sql="SELECT idseqno FROM trx_billing WHERE kode LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
	$hsltemp=mysql_query($sql,$db);
	list($idseqno)=mysql_fetch_array($hsltemp);
	$idseqno++;
	$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
?>
	<?php if(!$_POST["calculate"]){ ?>
		<form method="POST" action="<?php echo $__phpself; ?>">
			<fieldset>
				<legend><b>Guest Bill</b></legend>
				<table>
					<tr>
						<td><b>Bill No<b></td>
						<td><b>:<b></td>
						<td><?php echo $kode; ?></td>
					</tr>
					<tr>
						<td><b>Tanggal</b></td>
						<td><b>:</b></td>
						<td>
							<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
							<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
						</td>
					</tr>
					<tr>
						<td><b>Kode Booking<b></td>
						<td><b>:<b></td>
						<td>
							<select name="booking" id="booking">
								<option value="">-Kode booking-</option>
								<?php 
									$sql="SELECT kode,departure,nama,room FROM trx_booking WHERE grup='0' AND room<>'' ORDER BY departure DESC,room LIMIT 200";
									$hslbook=mysql_query($sql,$db);
									while(list($_kode,$_tanggal,$_nama,$_room)=mysql_fetch_array($hslbook)){
										$sql="SELECT nama FROM mst_room WHERE kode='$_room'";
										$hsltemp=mysql_query($sql,$db);
										list($_room)=mysql_fetch_array($hsltemp);
								?>
									<option value="<?php echo $_kode; ?>" <?php if($_POST["booking"]==$_kode){echo "selected";} ?>><?php echo $_tanggal; ?> [Room:<?php echo $_room; ?>]  <?php echo $_kode; ?> [Cust:<?php echo $_nama; ?>]</option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>	
					<tr>
						<td><b>Nett</b></td>
						<td><b>:</b></td>
						<td nowrap>
							<input type="checkbox" name="nett" id="nett" value="1" <?php if(isset($_POST["nett"])){echo "checked";} ?>>NETT
						</td>
					<tr>			
					<!--tr>
						<td><b>PPN & Service</b></td>
						<td><b>:</b></td>
						<td>
							<input type="checkbox" name="withppn" id="withppn" value="1" <?php if(isset($_POST["withppn"])){echo "checked";} ?>>With PPN
							<input type="checkbox" name="withservice" id="withservice" value="1" <?php if(isset($_POST["withservice"])){echo "checked";} ?>>With Service
						</td>
					<tr-->
					<!--
					<tr>
						<td><b>Payment Type<b></td>
						<td><b>:<b></td>
						<td>
							<select name="payment" id="payment">
								<option value="">-payment-</option>
								<?php 
									$sql="SELECT kode,description FROM mst_pay_type ORDER BY kode";
									$hsltemp=mysql_query($sql,$db);
									while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
								?>
									<option value="<?php echo $_kode; ?>" <?php if($_POST["payment"]==$_kode){echo "selected";} ?>><?php echo $_desc; ?></option>
								<?php
									}
								?>
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
									<option value="<?php echo $_kode; ?>" <?php if($_POST["payment"]==$_kode){echo "selected";} ?>><?php echo $description; ?></option>
								<?php
									}
								?>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td><b>No Card /  No Rek</b></td>
						<td>:</b></td>
						<td><input type="text" name="norek" id="norek" value="<?php echo $_POST["norek"]; ?>"></td>
					</tr>
					-->
					<tr>
						<td colspan="3"><input type="submit" name="calculate" value="Calculate Bill"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	<?php } ?>
	<?php
		if($_POST["calculate"]){
			$createby=$_SESSION["username"];		
			$tanggal=$_POST["tanggal"];
			$payment=$_POST["payment"];
			$coabank=$_POST["coabank"];
			$norek=$_POST["norek"];
			$_room=$_POST["room"];
			$_booking=$_POST["booking"];
			$_withppn="1";
			$_withservice="1";
			$_nett="0";
			// if(isset($_POST["withppn"])){$_withppn="1";}
			// if(isset($_POST["withservice"])){$_withservice="1";}
			if(isset($_POST["nett"])){$_nett="1";$_withppn="0";$_withservice="0";}
			$_periodetrx=substr($tanggal,0,8);
			$sql="DELETE FROM trx_billing WHERE booking='$_booking'";
			mysql_query($sql,$db);
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
			//cari total rate
			// $sql="SELECT price,price2 FROM mst_room WHERE kode='$kdroom'";
			// $hsltemp=mysql_query($sql,$db);
			// list($price,$price2)=mysql_fetch_array($hsltemp);
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
				$tipeday=date("N",mktime(0,0,0,$_bln,$_tgl,$_thn));
				if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
					$totalrate+=$price;
				}else{
					$totalrate+=$price2;
				}
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
			$__grandtotal=($__totalroom+$__totalrestaurant+$__totaladditional)-$__dp;
			//echo "$__grandtotal=($__totalroom+$__totalrestaurant+$__totaladditional)-$__dp;";
			
			
			$sql="INSERT INTO trx_billing (kode,grup,idseqno,tanggal,booking,room,withppn,withservice,nett,rate,rate2,chargeextraperson,restaurant,additional,subtotal1,ppn,subtotal2,service,dp,discname,disc,grandtotal,paymenttype,coabank,norek,createby,createdate) VALUES ";
			$sql.="('$kode','0','$idseqno','$tanggal','$kodebooking','$kdroom','$_withppn','$_withservice','$_nett','$rate1','$rate2','$chargeextraperson','$totalrestaurant','$totaladditional','$__subtotal1','$__ppn','$__subtotal2','$__service','$__dp','$__discname','$__disc','$__grandtotal','$payment','$coabank','$norek','$createby',NOW())";
			mysql_query($sql,$db);
			$sql="UPDATE mst_room SET available='0',booked='0' WHERE kode='$kdroom'";
			mysql_query($sql,$db);
						
			?>
			<script language="javascript">
				window.location="trx_billingview.php?kode=<?php echo $kode; ?>";
			</script>
			<?php $__captiontitle="ROOM BILL";include_once "header_document.php"; ?>
			<fieldset style="width:100%">
				<legend><b>Guest Bill</b></legend>
				<table width="100%">
					<tr>
						<td valign="top" width="25%">
							<table width="25%">
								<tr>
									<td nowrap><b>Bill No</b></td>
									<td><b>:</b></td>
									<td><?php echo $kode; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Room</b></td>
									<td><b>:</b></td>
									<td><?php echo $room; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Date</b></td>
									<td><b>:</b></td>
									<td><?php echo format_tanggal($tanggal); ?></td>
								</tr>
								<tr>
									<td nowrap><b>Name</b></td>
									<td><b>:</b></td>
									<td><?php echo $title." ".$nama; ?></td>
								</tr>
								<tr>
									<td nowrap><b>ID Number</b></td>
									<td><b>:</b></td>
									<td><?php echo $idno." ($idtype)"; ?></td>
								</tr>
							</table>
						<td>
						<td valign="top" width="25%">
							<table width="25%">
								<tr>
									<td nowrap><b>Address</b></td>
									<td><b>:</b></td>
									<td><?php echo $alamat; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Phone</b></td>
									<td><b>:</b></td>
									<td><?php echo $phone; ?></td>
								</tr>
								<tr>
									<td nowrap><b>E-Mail</b></td>
									<td><b>:</b></td>
									<td><?php echo $email; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Company</b></td>
									<td><b>:</b></td>
									<td><?php echo $company; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Department</b></td>
									<td><b>:</b></td>
									<td><?php echo $departement; ?></td>
								</tr>
								<!--tr>
									<td><b>Group</b></td>
									<td><b>:</b></td>
									<td><?php echo $grup; ?></td>
								</tr-->
							</table>
						<td>
						<td valign="top" width="25%">
							<table width="25%">
								<tr>
									<td nowrap><b>Person</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo $person; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Arrival</b></td>
									<td><b>:</b></td>
									<td><?php echo format_tanggal($arrival); ?></td>
								</tr>
								<tr>
									<td nowrap><b>Departure</b></td>
									<td><b>:</b></td>
									<td><?php echo format_tanggal($tanggal); ?></td>
								</tr>
								<tr>
									<td nowrap><b>Rate Week Days</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo number_format($rate1); ?></td>
								</tr>
								<tr>
									<td nowrap><b>Rate Week End</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo number_format($rate2); ?></td>
								</tr>
							</table>
						<td>
						<td valign="top" width="25%">
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
									<td nowrap><b>Additional</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo number_format($totaladditional); ?></td>
								</tr-->
								<tr>
									<td nowrap><b>Notes</b></td>
									<td><b>:</b></td>
									<td><?php echo $notes; ?></td>
								</tr>
							</table>
						</td>
					<tr>
				</table>
			</fieldset>
			<fieldset>
				<legend><b>Restaurant Detail</b></legend>
				<table class="content_table" width="100%">
					<tr class="content_header">
						<td>No</td>
						<td>Bill No</td>
						<td>Food/Drink Code</td>
						<td>Description</td>
						<td>Qty</td>
						<td>Disc</td>
						<td>Price</td>
						<td>Total</td>
						<td>Notes</td>
					</tr>
					<?php
						$no=0;
						$txtbillno="";
						$billnonow="";
						$sql="SELECT kode,foodid,qty,price,keterangan FROM trx_restaurant_bill_detail WHERE kode IN (SELECT kode FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND paid='0') ORDER BY kode,seqno";
						$hslrest=mysql_query($sql,$db);
						$_subtotal1=0;
						while(list($billno,$foodid,$qty,$price,$keterangan)=mysql_fetch_array($hslrest)){
							$sql="SELECT nett,disc FROM trx_restaurant_bill WHERE kode='$billno'";
							$hsltemp=mysql_query($sql,$db);
							list($__nett,$__disc)=mysql_fetch_array($hsltemp);
							if($__nett){$temp=$price*100/111;$price=$temp*100/110;}
							$disc=$price*$__disc/100;
							$price=$price-$disc;
							$_subtotal1+=($price*$qty);
							$no++;
							$txtbillno="";
							if($billnonow!=$billno){$billnonow=$billno;$txtbillno=$billno;if($__nett){$txtbillno.=" (NETT)";}}
							$sql="SELECT description FROM mst_food WHERE kode='$foodid'";$hsltemp=mysql_query($sql,$db);
							list($description)=mysql_fetch_array($hsltemp);
					?>
						<tr>
							<td align="right"><?php echo $no; ?></td>
							<td><?php echo $txtbillno; ?></td>
							<td><?php echo $foodid; ?></td>
							<td><?php echo $description; ?></td>
							<td align="right"><?php echo $qty; ?></td>
							<td align="right"><?php echo number_format($disc); ?></td>
							<td align="right"><?php echo number_format($price); ?></td>
							<td align="right"><?php echo number_format($price*$qty); ?></td>
							<td><?php echo $keterangan; ?></td>
						</tr>
					<?php
						}
						
						$_ppn=$_subtotal1*0.1;
						$_subtotal2=$_subtotal1+$_ppn;
						$_service=$_subtotal2*0.11;
						$__totalrestaurant=$_subtotal2+$_service;
					?>
					<tr id="rowdetail_footer">
						<td valign="top" colspan="7" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><i>Sub Total 1</i></td></tr>
								<tr><td align="right"><i>Tax 10 %</i></td></tr>
								<tr><td align="right"><i>Sub Total 2</i></td></tr>
								<tr><td align="right"><i>Service 11 %</i></td></tr>
								<tr><td align="right"><i>Restaurant Total</i></td></tr>
							</table>
						</td>
						<td valign="top" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><?php echo number_format($_subtotal1);?></td></tr>
								<tr><td align="right"><?php echo number_format($_ppn);?></td></tr>
								<tr><td align="right"><?php echo number_format($_subtotal2);?></td></tr>
								<tr><td align="right"><?php echo number_format($_service);?></td></tr>
								<tr><td align="right"><b><?php echo number_format($__totalrestaurant);?></b></td></tr>
							</table>
						</td>					
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend><b>Additional Detail</b></legend>
				<table class="content_table" width="100%">
					<tr class="content_header">
						<td>No</td>
						<td>Bill No</td>
						<td>Additional Code</td>
						<td>Description</td>
						<td>Qty</td>
						<td>Disc</td>
						<td>Price</td>
						<td>Total</td>
						<td>Notes</td>
					</tr>
					<?php
						$no=0;
						$txtbillno="";
						$billnonow="";
						$sql="SELECT kode,kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode IN (SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND paid='0') ORDER BY kode,seqno";
						$hslrest=mysql_query($sql,$db);
						$_subtotal1=0;
						while(list($billno,$addid,$qty,$price,$keterangan)=mysql_fetch_array($hslrest)){
							$sql="SELECT nett,disc FROM trx_additional WHERE kode='$billno'";
							$hsltemp=mysql_query($sql,$db);
							list($__nett,$__disc)=mysql_fetch_array($hsltemp);
							if($__nett){$temp=$price*100/111;$price=$temp*100/110;}
							$disc=$price*$__disc/100;
							$price=$price-$disc;
							$_subtotal1+=($price*$qty);
							$no++;
							$txtbillno="";
							if($billnonow!=$billno){$billnonow=$billno;$txtbillno=$billno;if($__nett){$txtbillno.=" (NETT)";}}
							$sql="SELECT description FROM mst_additional WHERE kode='$addid'";$hsltemp=mysql_query($sql,$db);
							list($description)=mysql_fetch_array($hsltemp);
					?>
						<tr>
							<td align="right"><?php echo $no; ?></td>
							<td><?php echo $txtbillno; ?></td>
							<td><?php echo $addid; ?></td>
							<td><?php echo $description; ?></td>
							<td align="right"><?php echo $qty; ?></td>
							<td align="right"><?php echo number_format($disc); ?></td>
							<td align="right"><?php echo number_format($price); ?></td>
							<td align="right"><?php echo number_format($price*$qty); ?></td>
							<td><?php echo $keterangan; ?></td>
						</tr>
					<?php
						}
						$_ppn=$_subtotal1*0.1;
						$_subtotal2=$_subtotal1+$_ppn;
						$_service=$_subtotal2*0.11;
						$__totaladditional=$_subtotal2+$_service;
					?>
					<tr id="rowdetail_footer">
						<td valign="top" colspan="7" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><i>Sub Total 1</i></td></tr>
								<tr><td align="right"><i>Tax 10 %</i></td></tr>
								<tr><td align="right"><i>Sub Total 2</i></td></tr>
								<tr><td align="right"><i>Service 11 %</i></td></tr>
								<tr><td align="right"><i>Additional Total</i></td></tr>
							</table>
						</td>
						<td valign="top" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><?php echo number_format($_subtotal1);?></td></tr>
								<tr><td align="right"><?php echo number_format($_ppn);?></td></tr>
								<tr><td align="right"><?php echo number_format($_subtotal2);?></td></tr>
								<tr><td align="right"><?php echo number_format($_service);?></td></tr>
								<tr><td align="right"><b><?php echo number_format($__totaladditional);?></b></td></tr>
							</table>
						</td>					
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend><b>Room Detail</b></legend>
				
				<table class="content_table" width="100%">
					<tr>
						<td valign="top" width="50%">
							<table width="100%">
								<tr>
									<td align="right"><i>Sub Total</i></td>
									<td align="right"><?php echo number_format($__subtotal1);?></td>
								</tr>
								<tr>
									<td align="right"><i>Discount</i></td>
									<td align="right"><?php echo number_format($_discount);?></td>
								</tr>
								<tr>
									<td align="right"><i>Sub Total 2</i></td>
									<td align="right"><?php echo number_format($__subtotal2);?></td>
								</tr>
							</table>
						<td>
						<td valign="top" width="50%">
							<table width="100%">
								<tr>
									<td align="right"><i>PPN 10 %</i></td>
									<td align="right"><?php echo number_format($__ppn);?></td>
								</tr>
								<tr>
									<td align="right"><i>Sub Total 3</i></td>
									<td align="right"><?php echo number_format($__subtotal3);?></td>
								</tr>
								<tr>
									<td align="right"><i>Service 11 %</i></td>
									<td align="right"><?php echo number_format($__service);?></td>
								</tr>
								<tr>
									<td align="right"><i>Room Total</i></td>
									<td align="right"><b><?php echo number_format($__totalroom);?></b></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>				
			</fieldset>
			
			<fieldset>
				<legend><b>Summary</b></legend>
				<table class="content_table" width="100%">
					<tr id="rowdetail_footer">
						<td valign="top" colspan="5" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><b><i>Resturant</i></b></td></tr>
								<tr><td align="right"><b><i>Additional</i></b></td></tr>
								<tr><td align="right"><b><i>Room</i></b></td></tr>
								<tr><td align="right"><b><i>Down Payment</i></b></td></tr>
								<tr><td align="right"><b><i>Grand Total</i></b></td></tr>
							</table>
						</td>
						<td valign="top" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><?php echo number_format($__totalrestaurant);?></td></tr>
								<tr><td align="right"><?php echo number_format($__totaladditional);?></td></tr>
								<tr><td align="right"><?php echo number_format($__totalroom);?></td></tr>
								<tr><td align="right">(<?php echo number_format($__dp);?>)</td></tr>
								<tr><td align="right"><b><?php echo number_format($__grandtotal);?></b></td></tr>
							</table>
						</td>					
					</tr>
				</table>
			</fieldset>
			
			<div id="buttonrowdiv">
			<input type="button" value="Back" id="backbutton" onclick="window.location='trx_billinglist.php'">
			<input type="button" value="Print" id="printbutton" onclick="buttonrowdiv.style.visibility='hidden';window.print();buttonrowdiv.style.visibility='visible';">
			</div>
			<?php
		}
	?>
<?php
	include_once "footer.php";
?>