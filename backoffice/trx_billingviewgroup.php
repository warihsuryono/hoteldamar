<?php
	include_once "header.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	include_once "func_jurnal.php";
	if(!$_POST["tanggal"]){$tanggal=date("Y-m-d");}else{$tanggal=$_POST["tanggal"];}
?>
<?php
	$kode=$_GET["kode"];
	$sql="SELECT booking,grup,withppn,withservice,nett,paid FROM trx_billing WHERE kode='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking,$_grup,$_withppn,$_withservice,$_nett,$paid)=mysql_fetch_array($hsltemp);
	$sql="SELECT kode,grup,title,nama,idtype,idno,alamat,phone,email,company,departement,grup,dp,dptype,room,roomtipe,person,DATE(checkindate),departure,DATEDIFF(DATE(departure),DATE(checkindate)),rate,extraperson,chargeextraperson,rate1,rate2,discname,disc,notes FROM trx_booking WHERE kode='$kodebooking' AND grup='$_grup'";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking,$grup,$title,$nama,$idtype,$idno,$alamat,$phone,$email,$company,$departement,$grup,$__dp,$dptype,$room,$roomtipe,$person,$arrival,$departure,$lamainap,$rate,$extraperson,$chargeextraperson,$rate1,$rate2,$__discname,$__disc,$notes)=mysql_fetch_array($hsltemp);
	$namacust=$title." ".$nama;
	$tanggal=$departure;
	$roomtipe=strtoupper($roomtipe);
	if($_GET["paid"]){
		$__subtotal=0;
		$__subtotal2=0;
		$__subtotal3=0;
		$__subtotal4=0;
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
		
		//$tanggal=date("Y-m-d");
		$tanggal=$departure;
		$createby=$__username;
		$notes="Room Bill GROUP [$roomtipe X $person ($arrival/$departure)] an. $namacust";
		//INSERT ACCOUNTING	
		$kodejurnal=add_jurnal($tanggal,$norek,$vendor,$notes);
		
		//JURNAL RESTAURANT
		$sql="SELECT ((breakfast*breakfastprice*breakfastqty)+(lunch*lunchprice*lunchqty)+(bbq*bbqprice*bbqqty)+(dinner*dinnerprice*dinnerqty)+(snack*snackprice*snackqty)) FROM trx_booking_makan WHERE kode='$kodebooking'";
		$hsltemp=mysql_query($sql,$db);
		//echo "<br>$sql => ".mysql_error();
		list($totalrestaurant)=mysql_fetch_array($hsltemp);
		$totalrestaurant=$totalrestaurant*$person;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='7'";//Pendapatan Restauant
		$hsltemp=mysql_query($sql,$db);
		list($coa)=mysql_fetch_array($hsltemp);
		$kreditmakan=$totalrestaurant;
		$debit=0;
		$keterangan="Paket Makan Group ($person X) an. $namacust";
		add_jurnal_detail($kodejurnal,$coa,$keterangan,$debit,$kreditmakan);
			
		//JURNAL HOTEL
		$price=$rate1;
		$price2=$rate2;
		//echo "<br>$price,$price2";
		$totalrate=0;
		$_tanggalxx=$arrival;
		while($_tanggalxx!=$departure){
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
		$kreditkamar=$totalrate;
		$__subtotal=$kreditkamar+$kreditmakan;
		//TAX (Kredit)
		$kredittax=0;
		if($_withppn){
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='5'";//pajak masukan
			$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$kredittax=$__subtotal*0.1;
			$keterangan="Pajak Keluaran Sewa Group [$roomtipe X $person ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coatax,$keterangan,$debit,$kredittax);
		}
		$__subtotal2=$__subtotal+$kredittax;
		//SERVICE (Kredit)
		$kreditservice=0;
		if($_withservice){
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='4'";//service
			$hsltemp=mysql_query($sql,$db);
			list($coaservice)=mysql_fetch_array($hsltemp);
			$kreditservice=$__subtotal2*0.11;
			$keterangan="Service Sewa Group [$roomtipe X $person ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coaservice,$keterangan,$debit,$kreditservice);
		}
		$__subtotal3=$__subtotal2+$kreditservice;
		//NETT
		if($_nett){
			$__subtotal2=(100*$__subtotal3)/111;
			$__service=$__subtotal3-$__subtotal2;
			$__subtotal=(100*$__subtotal2)/110;
			$__ppn=$__subtotal2-$__subtotal;
			
			//TAX (Kredit)
			$kredittax=0;
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='5'";//pajak masukan
			$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$kredittax=$__ppn;
			$keterangan="Pajak Keluaran Sewa Group [$roomtipe X $person ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coatax,$keterangan,$debit,$kredittax);
			
			//SERVICE (Kredit)
			$kreditservice=0;
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='4'";//service
			$hsltemp=mysql_query($sql,$db);
			list($coaservice)=mysql_fetch_array($hsltemp);
			$kreditservice=$__service;
			$keterangan="Service Sewa Group [$roomtipe X $person ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coaservice,$keterangan,$debit,$kreditservice);		
		}		
		
		
		//SEWA KAMAR
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='9'";//Pendapatan Kamar
		$hsltemp=mysql_query($sql,$db);
		list($coakamar)=mysql_fetch_array($hsltemp);
		if($_nett){
			$kreditkamar=$totalrate-($__service+$__ppn);
		}else{
			$kreditkamar=$totalrate;
		}
		$keterangan="Pendapatan Sewa Group [$roomtipe X $person ($arrival/$departure)] an. $namacust";
		add_jurnal_detail($kodejurnal,$coakamar,$keterangan,$debit,$kreditkamar);
		
		//DISCOUNT 
		$kreditdisc=0;
		if($__disc!=0){
			//INSERT ACCOUNTING		
			$kodejurnal_end=$kodejurnal."/1";
			$notes_end="Discount $discname ($__disc %) [$roomtipe X $person ($arrival/$departure)]";
			$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal_end''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal_end''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
			$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal_end','$idseqno','$tanggal','$norek','$vendor','$notes_end','$createby',NOW(),'$actionlink')";
			mysql_query($sql,$db);
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='3'";//Discount
			$hsltemp=mysql_query($sql,$db);
			list($coadisc)=mysql_fetch_array($hsltemp);
			$keterangan="Discount $discname ($__disc %) [$roomtipe X $person ($arrival/$departure)]";
			//$__subtotal1=$totalrate+($lamainap*$chargeextraperson)+$totalrestaurant+$totaladditional;
			$kreditdisc=$__subtotal3*($__disc/100);
			add_jurnal_detail($kodejurnal_end,$coadisc,$keterangan,$debit,$kreditdisc);
			//LAWAN DISC
			$kredit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='9'";//Pendapatan Kamar
			$hsltemp=mysql_query($sql,$db);
			list($coakamar)=mysql_fetch_array($hsltemp);
			$debitkamardisc=$kreditdisc;
			$keterangan="Disc Pendapatan Sewa Kamar ($__disc %) [$roomtipe X $person ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal_end,$coakamar,$keterangan,$debitkamardisc,$kredit);
			$__subtotal4=$__subtotal3-$debitdisc;
			$seqno++;
			$debit=0;
			$_kreditkamardisc=$kreditdisc*-1;
			add_jurnal_detail($kodejurnal,$coakamar,$keterangan,$debit,$_kreditkamardisc);
		}else{
			$__subtotal4=$__subtotal3;
		}
		//DP 
		$sql="SELECT dp,dptype,dpbank,dp2,dptype2,dpbank2,dp3,dptype3,dpbank3,dp4,dptype4,dpbank4,dp5,dptype5,dpbank5 FROM trx_booking WHERE kode='$kodebooking' AND grup='$_grup'";
		$hsltemp=mysql_query($sql,$db);
		list($dp,$dptype,$dpbank,$dp2,$dptype2,$dpbank2,$dp3,$dptype3,$dpbank3,$dp4,$dptype4,$dpbank4,$dp5,$dptype5,$dpbank5)=mysql_fetch_array($hsltemp);
		//echo "<br>$dp,$dptype,$dpbank,$dp2,$dptype2,$dpbank2,$dp3,$dptype3,$dpbank3,$dp4,$dptype4,$dpbank4,$dp5,$dptype5,$dpbank5";
		
		$totalnoncash=0;
		$totalcash=0;
		$arrnoncash=array();
		if($dptype!="01"){$totalnoncash+=$dp;$arrnoncash[$dpbank]+=$dp;}else{$totalcash+=$dp;}
		if($dptype2!="01"){$totalnoncash+=$dp2;$arrnoncash[$dpbank2]+=$dp2;}else{$totalcash+=$dp2;}
		if($dptype3!="01"){$totalnoncash+=$dp3;$arrnoncash[$dpbank3]+=$dp3;}else{$totalcash+=$dp3;}
		if($dptype4!="01"){$totalnoncash+=$dp4;$arrnoncash[$dpbank4]+=$dp4;}else{$totalcash+=$dp4;}
		if($dptype5!="01"){$totalnoncash+=$dp5;$arrnoncash[$dpbank5]+=$dp5;}else{$totalcash+=$dp5;}
		
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
		$hsltemp=mysql_query($sql,$db);
		list($coa1)=mysql_fetch_array($hsltemp);
		
		if($totalcash>0){
			$keterangan="DP Booking Group Cash ($arrival/$departure) an. $namacust";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0);
			//echo "<br>add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0)";
		}
		
		foreach($arrnoncash as $coabank => $__debitbank){
			if($__debitbank!=0){
				$keterangan="DP Booking Group Bank ($arrival/$departure) an. $namacust";
				add_jurnal_detail($kodejurnal,$coabank,$keterangan,$__debitbank,0);
				//echo "<br>add_jurnal_detail($kodejurnal,$coabank,$keterangan,$__debitbank,0)";
			}
		}	
		
		if($paycash>0){
			$keterangan="Billing Group Cash ($arrival/$departure) an. $namacust";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$paycash,0,1);
			add_mutasi_uang($tanggal,"kas",$coa1,"",basename($__phpself),$kode,"","",$keterangan,$paycash,0);
		}
		if($payedc1>0){
			$keterangan="Billing Group EDC ($arrival/$departure) an. $namacust ($noedc1)";
			add_jurnal_detail($kodejurnal,$coaedc1,$keterangan,$payedc1,0,1);
			add_mutasi_uang($tanggal,"EDC",$coaedc1,"",basename($__phpself),$kode,"","",$keterangan,$payedc1,0);
		}
		if($payedc2>0){
			$keterangan="Billing Group EDC ($arrival/$departure) an. $namacust ($noedc2)";
			add_jurnal_detail($kodejurnal,$coaedc2,$keterangan,$payedc2,0,1);
			add_mutasi_uang($tanggal,"EDC",$coaedc2,"",basename($__phpself),$kode,"","",$keterangan,$payedc2,0);
		}
		if($paytrf>0){
			$keterangan="Billing Group Transfer ($arrival/$departure) an. $namacust ($notrf)";
			add_jurnal_detail($kodejurnal,$coatrf,$keterangan,$paytrf,0,1);
			add_mutasi_uang($tanggal,"Bank",$coatrf,"",basename($__phpself),$kode,"","",$keterangan,$paytrf,0);
		}	
		
		$sql="UPDATE trx_billing SET paymenttype='$paymenttype',paid=1 WHERE kode='$kode'";
		mysql_query($sql,$db);
		$paid=1;
	}
	
	
	$sql="SELECT dp FROM trx_billing WHERE kode='$kode'";$hsltemp=mysql_query($sql,$db);
	list($__dp)=mysql_fetch_array($hsltemp);
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
	
	$sql="SELECT roomtipe FROM trx_booking WHERE kode='$kodebooking'";			
	$hsltemp=mysql_query($sql,$db);
	list($roomtipe)=mysql_fetch_array($hsltemp);
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
					<td colspan="5" align="center"><input type="submit" name="ok" value="PAY"></td>
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
	</div>
	<div id="buttonrowdiv">
	<input type="button" value="Back" id="backbutton" onclick="window.location='trx_billinglist.php'">
	<?php
		$sql="SELECT paid FROM trx_billing WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($paid)=mysql_fetch_array($hsltemp);
	?>
	<?php if(!$paid){ ?>
	<input type="button" value="Pay" id="paidbutton" onclick="divpay.style.visibility='visible';paymenttype.focus()">
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