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
						<td><b>Group<b></td>
						<td><b>:<b></td>
						<td>
							<select name="group" id="group">
								<option value="">-group-</option>
								<?php 
									$sql="SELECT grup,title,nama FROM trx_booking WHERE grup<>'0' GROUP BY grup ORDER BY grup DESC LIMIT 20";
									$hslgrup=mysql_query($sql,$db);
									while(list($_kode,$_title,$_nama)=mysql_fetch_array($hslgrup)){
										$sql="SELECT description FROM mst_name_title WHERE kode='$_title'";
										$hsltemp=mysql_query($sql,$db);
										list($_title)=mysql_fetch_array($hsltemp);
								?>
									<option value="<?php echo $_kode; ?>" <?php if($_POST["group"]==$_kode){echo "selected";} ?>><?php echo $_kode." [$_title $_nama]"; ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>				
					<tr>
						<td><b>PPN & Service</b></td>
						<td><b>:</b></td>
						<td nowrap>
							<input type="checkbox" name="withppn" id="withppn" value="1" <?php if(isset($_POST["withppn"])){echo "checked";} ?> onchange="if(this.checked==true){nett.checked=false;}">With PPN
							<input type="checkbox" name="withservice" id="withservice" value="1" <?php if(isset($_POST["withservice"])){echo "checked";} ?> onchange="if(this.checked==true){nett.checked=false;}">With Service
							<input type="checkbox" name="nett" id="nett" value="1" <?php if(isset($_POST["nett"])){echo "checked";} ?> onchange="if(this.checked==true){withppn.checked=false;withservice.checked=false;}">NETT
						</td>
					<tr>
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
			$_grup=$_POST["group"];
			$sql="DELETE FROM trx_billing WHERE grup='$_grup'";
			mysql_query($sql,$db);
			$kode="BILL/".date("Ymd")."/";
			$sql="SELECT idseqno FROM trx_billing WHERE kode LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			list($idseqno)=mysql_fetch_array($hsltemp);
			$idseqno++;
			$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
			$_withppn="0";
			$_withservice="0";
			if(isset($_POST["withppn"])){$_withppn="1";}
			if(isset($_POST["withservice"])){$_withservice="1";}
			if(isset($_POST["nett"])){$_nett="1";}
			$_periodetrx=substr($tanggal,0,8);
			$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dp2,dp3,dp4,dp5,dptype,room,person,DATE(checkindate),departure,DATEDIFF('$tanggal',DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE grup='$_grup' AND checkin='1' AND checkindate<='$tanggal' AND kode NOT IN (SELECT booking FROM trx_billing WHERE tanggal LIKE '".$_periodetrx."%') ORDER BY tanggal DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
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
			//rate,chargeextraperson,restaurant,additional,subtotal1,ppn,subtotal2,service,grandtotal,paymenttype
			//cari additional
			/* $sql="SELECT sum(grandtotal) FROM trx_additional WHERE kodebooking='$kodebooking' AND paid=0";
			$hsltemp=mysql_query($sql,$db);
			list($totaladditional)=mysql_fetch_array($hsltemp); */
			//cari restaurant
			//$sql="SELECT sum(grandtotal) FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND paid=0";
			$sql="SELECT ((breakfast*breakfastprice*breakfastqty)+(lunch*lunchprice*lunchqty)+(bbq*bbqprice*bbqqty)+(dinner*dinnerprice*dinnerqty)+(snack*snackprice*snackqty)) FROM trx_booking_makan WHERE kode='$kodebooking'";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
			list($totalrestaurant)=mysql_fetch_array($hsltemp);
			$totalrestaurant=$totalrestaurant*$person;
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
			$totalrate=$totalrate*$person;
			$__subtotal1=$totalrate+$totalrestaurant+$totaladditional;
			$__ppn=0;
			$__service=0;
			if($_withppn){$__ppn=$__subtotal1*0.1;}
			$__subtotal2=$__subtotal1+$__ppn;
			if($_withservice){$__service=$__subtotal2*0.11;}
			$__subtotal3=$__subtotal2+$__service;
			//with nett
			if($_nett){
				$__subtotal2=(100*$__subtotal3)/111;
				$__service=$__subtotal3-$__subtotal2;
				$__subtotal1=(100*$__subtotal2)/110;
				$__ppn=$__subtotal2-$__subtotal1;
			}
			
			$_discount=$__subtotal3*($__disc/100);
			$__subtotal4=$__subtotal3-$_discount;
			$__grandtotal=$__subtotal4-$__dp;
			$sql="INSERT INTO trx_billing (kode,grup,idseqno,tanggal,booking,room,withppn,withservice,nett,rate,rate2,chargeextraperson,restaurant,additional,subtotal1,ppn,subtotal2,service,dp,discname,disc,grandtotal,paymenttype,coabank,norek,createby,createdate) VALUES ";
			$sql.="('$kode','$grup','$idseqno','$tanggal','$kodebooking','$kdroom','$_withppn','$_withservice','$_nett','$rate1','$rate2','$chargeextraperson','$totalrestaurant','$totaladditional','$__subtotal1','$__ppn','$__subtotal2','$__service','$__dp','$__discname','$__disc','$__grandtotal','$payment','$coabank','$norek','$createby',NOW())";
			mysql_query($sql,$db);
			$sql="SELECT room FROM trx_booking WHERE kode='$kodebooking'";
			$hslbook=mysql_query($sql,$db);
			while(list($kdroom)=mysql_fetch_array($hslbook)){
				$sql="UPDATE mst_room SET available='0',booked='0' WHERE kode='$kdroom'";
				mysql_query($sql,$db);
			}
			$sql="SELECT roomtipe FROM trx_booking WHERE kode='$kodebooking'";			
			$hsltemp=mysql_query($sql,$db);
			list($roomtipe)=mysql_fetch_array($hsltemp);
			?>
			<script language="javascript">
				window.location="trx_billingviewgroup.php?kode=<?php echo $kode; ?>";
			</script>
			<?php $__captiontitle="ROOM BILL (GROUP)";include_once "header_document.php"; ?>
			<fieldset>
				<legend><b>Group Bill</b></legend>
				<table>
					<tr>
						<td valign="top">
							<table>
								<tr>
									<td><b>Bill No</b></td>
									<td><b>:</b></td>
									<td><?php echo $kode; ?></td>
								</tr>
								<tr>
									<td><b>Group</b></td>
									<td><b>:</b></td>
									<td><?php echo $grup; ?></td>
								</tr>
								<tr>
									<td><b>Date</b></td>
									<td><b>:</b></td>
									<td><?php echo $tanggal; ?></td>
								</tr>
								<tr>
									<td><b>Name</b></td>
									<td><b>:</b></td>
									<td><?php echo $title." ".$nama; ?></td>
								</tr>
								<tr nowrap>
									<td><b>ID Number</b></td>
									<td><b>:</b></td>
									<td><?php echo $idno." ($idtype)"; ?></td>
								</tr>
								<tr>
									<td><b>Address</b></td>
									<td><b>:</b></td>
									<td><?php echo $alamat; ?></td>
								</tr>
								<tr>
									<td><b>Phone</b></td>
									<td><b>:</b></td>
									<td><?php echo $phone; ?></td>
								</tr>
								<tr>
									<td><b>E-Mail</b></td>
									<td><b>:</b></td>
									<td><?php echo $email; ?></td>
								</tr>
								<tr>
									<td><b>Company</b></td>
									<td><b>:</b></td>
									<td><?php echo $company; ?></td>
								</tr>
								<tr>
									<td><b>Department</b></td>
									<td><b>:</b></td>
									<td><?php echo $departement; ?></td>
								</tr>
							</table>
						<td>
						<td valign="top">
							<table>
								<tr>
									<td><b>Tipe Kamar</b></td>
									<td><b>:</b></td>
									<td><?php echo strtoupper($roomtipe); ?></td>
								</tr>
								<tr>
									<td><b>Pax</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo $person; ?></td>
								</tr>
								<tr>
									<td><b>Arrival</b></td>
									<td><b>:</b></td>
									<td><?php echo $arrival; ?></td>
								</tr>
								<tr>
									<td><b>Departure</b></td>
									<td><b>:</b></td>
									<td><?php echo $tanggal; ?></td>
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
								<tr>
									<td nowrap><b>Charge Person</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo "($extraperson) ".number_format($chargeextraperson); ?></td>
								</tr>
								<tr>
									<td nowrap><b>Long Stay(s)</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo $lamainap; ?></td>
								</tr>
								<tr>
									<td nowrap><b>Down Payment</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo "($dptype) ".number_format($__dp); ?></td>
								</tr>
								<tr>
									<td><b>Restaurant</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo number_format($totalrestaurant); ?></td>
								</tr>
								<tr>
									<td><b>Additional</b></td>
									<td><b>:</b></td>
									<td align="right"><?php echo number_format($totaladditional); ?></td>
								</tr>
								<tr>
									<td><b>Notes</b></td>
									<td><b>:</b></td>
									<td><?php echo $notes; ?></td>
								</tr>
							</table>
						<td>
						<td valign="top">
							<fieldset>
								<legend><b>Paket Makan</b></legend>
								<?php
									$sql="SELECT breakfast,breakfastprice,breakfastqty,lunch,lunchprice,lunchqty,bbq,bbqprice,bbqqty,dinner,dinnerprice,dinnerqty,snack,snackprice,snackqty FROM trx_booking_makan WHERE kode='$kodebooking'";
									$hsltemp=mysql_query($sql,$db);
									if(mysql_affected_rows($db)>0){
										list($breakfast,$breakfastprice,$breakfastqty,$lunch,$lunchprice,$lunchqty,$bbq,$bbqprice,$bbqqty,$dinner,$dinnerprice,$dinnerqty,$snack,$snackprice,$snackqty)=mysql_fetch_array($hsltemp);		
										$checkedbreakfast="checked";
										$checkedlunch="checked";
										$checkedbbq="checked";
										$checkeddinner="checked";
										$checkedsnack="checked";
										if($breakfast){$checkedbreakfast="checked";}
										if($lunch){$checkedlunch="checked";}
										if($bbq){$checkedbbq="checked";}
										if($dinner){$checkeddinner="checked";}
										if($snack){$checkedsnack="checked";}
									}
								?>
								<table>
									<tr>
										<td nowrap><input disabled type="checkbox" name="breakfast" value="1" <?php echo $checkedbreakfast; ?>>Breakfast</td>
										<td nowrap>:</td>
										<td nowrap>@ <input readonly size="10" type="text" id="breakfastprice" name="breakfastprice" value="<?php echo $breakfastprice;?>"></td>
										<td nowrap>Jml : <input readonly size="3" type="text" id="breakfastqty" name="breakfastqty" value="<?php echo $breakfastqty;?>">X</td>
									</tr>
									<tr>
										<td nowrap><input disabled type="checkbox" name="lunch" value="1" <?php echo $checkedlunch; ?>>Lunch</td>
										<td nowrap>:</td>
										<td nowrap>@ <input readonly size="10" type="text" id="lunchprice" name="lunchprice" value="<?php echo $lunchprice;?>"></td>
										<td nowrap>Jml : <input readonly size="3" type="text" id="lunchqty" name="lunchqty" value="<?php echo $lunchqty;?>">X</td>
									</tr>
									<tr>
										<td nowrap><input disabled type="checkbox" name="bbq" value="1" <?php echo $checkedbbq; ?>>BBQ</td>
										<td nowrap>:</td>
										<td nowrap>@ <input readonly size="10" type="text" id="bbqprice" name="bbqprice" value="<?php echo $bbqprice;?>"></td>
										<td nowrap>Jml : <input readonly size="3" type="text" id="bbqqty" name="bbqqty" value="<?php echo $bbqqty;?>">X</td>
									</tr>
									<tr>
										<td nowrap><input disabled type="checkbox" name="dinner" value="1" <?php echo $checkeddinner; ?>>Dinner</td>
										<td nowrap>:</td>
										<td nowrap>@ <input readonly size="10" type="text" id="dinnerprice" name="dinnerprice" value="<?php echo $dinnerprice;?>"></td>
										<td nowrap>Jml : <input readonly size="3" type="text" id="dinnerqty" name="dinnerqty" value="<?php echo $dinnerqty;?>">X</td>
									</tr>
									<tr>
										<td nowrap><input disabled type="checkbox" name="snack" value="1" <?php echo $checkedsnack; ?>>Snack</td>
										<td nowrap>:</td>
										<td nowrap>@ <input readonly size="10" type="text" id="snackprice" name="snackprice" value="<?php echo $snackprice;?>"></td>
										<td nowrap>Jml : <input readonly size="3" type="text" id="snackqty" name="snackqty" value="<?php echo $snackqty;?>">X</td>
									</tr>
								</table>
							</fieldset>
						</td>
					<tr>
				</table>
			</fieldset>
			<fieldset>
				<legend><b>Summary</b></legend>
				<table class="content_table" width="100%">
					<tr id="rowdetail_footer">
						<td valign="top" colspan="5" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><i>Sub Total</i></td></tr>
								<tr><td align="right"><i>PPN 10 %</i></td></tr>
								<tr><td align="right"><i>Sub Total 2</i></td></tr>
								<tr><td align="right"><i>Service 11 %</i></td></tr>
								<tr><td align="right"><i>Sub Total 3</i></td></tr>
								<tr><td align="right"><i>Discount (<?php echo $__discname;?>)</i></td></tr>
								<tr><td align="right"><i>Total</i></td></tr>
								<tr><td align="right"><i>Down Payment</i></td></tr>
								<tr><td align="right"><i>Grand Total</i></td></tr>
							</table>
						</td>
						<td valign="top" align="right">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td align="right"><?php echo number_format($__subtotal1);?></td></tr>
								<tr><td align="right"><i><?php echo number_format($__ppn);?></i></td></tr>
								<tr><td align="right"><?php echo number_format($__subtotal2);?></td></tr>
								<tr><td align="right"><i><?php echo number_format($__service);?></i></td></tr>
								<tr><td align="right"><?php echo number_format($__subtotal3);?></td></tr>
								<tr><td align="right"><i><?php echo number_format($_discount);?></i></td></tr>
								<tr><td align="right"><?php echo number_format($__subtotal4);?></td></tr>
								<tr><td align="right"><i><?php echo number_format($__dp);?></i></td></tr>
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