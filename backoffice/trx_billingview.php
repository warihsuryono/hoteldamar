<?php
	include_once "header.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	include_once "func_jurnal.php";
	$kode=$_GET["kode"];	
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
		
		$notes="Room Bill [$room ($arrival/$departure)] an. $namacust";
		
		//INSERT ACCOUNTING			
		$kodejurnal=add_jurnal($tanggal,$norek,$vendor,$notes);
		
		//JURNAL RESTAURANT
		$sql="SELECT kode FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
		$hsldetrest=mysql_query($sql,$db);
		$seqno=-1;	
		while(list($koderest)=mysql_fetch_array($hsldetrest)){
			$sql="UPDATE trx_restaurant_bill SET paid='2',paymenttype='$paymenttype',coabank='$coabank',norek='$norek' WHERE kode='$koderest'";
			mysql_query($sql,$db);
			
			$sql="SELECT notes,room,withppn,withservice,nett,disc,discname FROM trx_restaurant_bill WHERE kode='$koderest'";
			$hsltemp=mysql_query($sql,$db);
			list($notes,$room,$withtax,$withservice,$_nettrest,$_disc,$_discname)=mysql_fetch_array($hsltemp);
			$sql="SELECT nama FROM mst_room WHERE kode='$room'";
			$hsltemp=mysql_query($sql,$db);
			list($room)=mysql_fetch_array($hsltemp);
			if($paymenttype=="01" || !$paymenttype){//cash
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coa1)=mysql_fetch_array($hsltemp);
			}else{
				if(!$coabank){
					$sql="SELECT coa FROM acc_setting_coa WHERE id='2'";
					$hsltemp=mysql_query($sql,$db);
					list($coabank)=mysql_fetch_array($hsltemp);
				}
				$coa1=$coabank;
			}
			$sql="SELECT sum(qty * price) FROM trx_restaurant_bill_detail WHERE kode ='$koderest'";
			$hsltemp=mysql_query($sql,$db);
			list($subtotal)=mysql_fetch_array($hsltemp);
			
			$sql="SELECT foodid,qty,price,keterangan FROM trx_restaurant_bill_detail WHERE kode='$koderest'";
			$hsldet=mysql_query($sql,$db);
			$subtotal1=0;
			while(list($foodid,$qty,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
				$sql="SELECT description FROM mst_food WHERE kode='$foodid'";
				$hsltemp=mysql_query($sql,$db);
				list($namafood)=mysql_fetch_array($hsltemp);
				$sql="SELECT coa FROM acc_setting_coa WHERE id='7'";//Pendapatan Restauant
				$hsltemp=mysql_query($sql,$db);
				list($coa)=mysql_fetch_array($hsltemp);
				$kredit=$qty*$harsat;
				$subtotal1+=$kredit;
				if($_nettrest){$tottemp=(100*$kredit)/111;$kredit=(100*$tottemp)/110;}
				$debit=0;
				$keterangan="$namafood ($qty X)";
				add_jurnal_detail($kodejurnal,$coa,$keterangan,$debit,$kredit);
			}
			
			if($_nettrest){
				$subtotal2=(100*$subtotal1)/111;
				$service=$subtotal1-$subtotal2;
				$subtotal1=(100*$subtotal2)/110;
				$ppn=$aftertax-$subtotal1;
			}
			
			$subtotal2=$subtotal1-($subtotal1*$_disc/100);
			
			if($_disc>0){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='3'";//Discount
				$hsltemp=mysql_query($sql,$db);
				list($coadisc)=mysql_fetch_array($hsltemp);
				$keterangan="Discount $_discname";
				if($notes){$keterangan.=" ($notes)";}
				$debit=0;
				$kreditvoucher=$subtotal1*$_disc/100*-1;
				add_jurnal_detail($kodejurnal,$coadisc,$keterangan,$debit,$kreditvoucher);
			}		
			
			
			//TAX (Kredit)
			$kredittax=0;
			if($withtax || true){
				$debit=0;
				$sql="SELECT coa FROM acc_setting_coa WHERE id='5'";//pajak masukan
				$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
				$hsltemp=mysql_query($sql,$db);
				list($coatax)=mysql_fetch_array($hsltemp);
				$kredittax=$subtotal2*0.1;
				$keterangan="Pajak Keluaran Restaurant";
				add_jurnal_detail($kodejurnal,$coatax,$keterangan,$debit,$kredittax);
			}
			//SERVICE (Kredit)
			$kreditservice=0;
			if($withservice || true){
				$debit=0;
				$sql="SELECT coa FROM acc_setting_coa WHERE id='4'";//service
				$hsltemp=mysql_query($sql,$db);
				list($coaservice)=mysql_fetch_array($hsltemp);
				$kreditservice=($subtotal2+$kredittax)*0.11;
				$keterangan="Service Restaurant";
				add_jurnal_detail($kodejurnal,$coaservice,$keterangan,$debit,$kreditservice);
			}
		}
		
		//JURNAL ADDITONAL
		$sql="SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')";
		$hsldetadd=mysql_query($sql,$db);
		while(list($kodeadd)=mysql_fetch_array($hsldetadd)){
			$sql="UPDATE trx_additional SET paid='2',paymenttype='$paymenttype',coabank='$coabank',norek='$norek' WHERE kode='$kodeadd'";
			mysql_query($sql,$db);
						
			$sql="SELECT notes,room,withppn,withservice,nett,disc,discname FROM trx_additional WHERE kode='$kodeadd'";
			$hsltemp=mysql_query($sql,$db);
			list($notes,$room,$withtax,$withservice,$_nettadds,$_disc,$_discname)=mysql_fetch_array($hsltemp);
			$sql="SELECT nama FROM mst_room WHERE kode='$room'";
			$hsltemp=mysql_query($sql,$db);
			list($room)=mysql_fetch_array($hsltemp);
			if($paymenttype=="01" || !$paymenttype){//cash
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coa1)=mysql_fetch_array($hsltemp);
			}else{
				if(!$coabank){
					$sql="SELECT coa FROM acc_setting_coa WHERE id='2'";
					$hsltemp=mysql_query($sql,$db);
					list($coabank)=mysql_fetch_array($hsltemp);
				}
				$coa1=$coabank;
			}
			$sql="SELECT sum(qty * price) FROM trx_additional_detail WHERE kode ='$kodeadd'";
			$hsltemp=mysql_query($sql,$db);
			list($subtotal)=mysql_fetch_array($hsltemp);
			
			$sql="SELECT kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode='$kodeadd'";
			$hsldet=mysql_query($sql,$db);
			$subtotal1=0;
			while(list($kode_add,$qty,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
				$sql="SELECT description FROM mst_additional WHERE kode='$kode_add'";
				$hsltemp=mysql_query($sql,$db);
				list($namaadd)=mysql_fetch_array($hsltemp);
				$sql="SELECT coa FROM acc_setting_coa WHERE id='9'";//Pendapatan Kamar
				$hsltemp=mysql_query($sql,$db);
				list($coa)=mysql_fetch_array($hsltemp);
				$kredit=$qty*$harsat;
				$subtotal1+=$kredit;
				if($_nettadds){$tottemp=(100*$kredit)/111;$kredit=(100*$tottemp)/110;}
				
				$debit=0;
				$keterangan="$namaadd ($qty X)";
				add_jurnal_detail($kodejurnal,$coa,$keterangan,$debit,$kredit);
			}
			
			if($_nettadds){
				$subtotal2=(100*$subtotal1)/111;
				$service=$subtotal1-$subtotal2;
				$subtotal1=(100*$subtotal2)/110;
				$ppn=$aftertax-$subtotal1;
			}
			
			$subtotal2=$subtotal1-($subtotal1*$_disc/100);
			
			if($_disc>0){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='3'";//Discount
				$hsltemp=mysql_query($sql,$db);
				list($coadisc)=mysql_fetch_array($hsltemp);
				$keterangan="Discount $_discname";
				if($notes){$keterangan.=" ($notes)";}
				$debit=0;
				$kreditvoucher=$subtotal1*$_disc/100*-1;
				add_jurnal_detail($kodejurnal,$coadisc,$keterangan,$debit,$kreditvoucher);
			}		
			
			
			//TAX (Kredit)
			$kredittax=0;
			if($withtax || true){
				$debit=0;
				$sql="SELECT coa FROM acc_setting_coa WHERE id='5'";//pajak masukan
				$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
				$hsltemp=mysql_query($sql,$db);
				list($coatax)=mysql_fetch_array($hsltemp);
				$kredittax=$subtotal2*0.1;
				$keterangan="Pajak Masukan Miscellaneous";
				$keterangan="Pajak Keluaran Miscellaneous";
				add_jurnal_detail($kodejurnal,$coatax,$keterangan,$debit,$kredittax);
			}
			//SERVICE (Kredit)
			$kreditservice=0;
			if($withservice || true){
				$debit=0;
				$sql="SELECT coa FROM acc_setting_coa WHERE id='4'";//service
				$hsltemp=mysql_query($sql,$db);
				list($coaservice)=mysql_fetch_array($hsltemp);
				$kreditservice=($subtotal2+$kredittax)*0.11;
				$keterangan="Service Miscellaneous";
				add_jurnal_detail($kodejurnal,$coaservice,$keterangan,$debit,$kreditservice);
			}
		}	
		
		
		//JURNAL STORE
		$sql="SELECT kode FROM trx_pos WHERE kodebooking='$kodebooking' AND paid='2'";
		$hsldetadd=mysql_query($sql,$db);
		while(list($kodepos)=mysql_fetch_array($hsldetadd)){
			$sql="UPDATE trx_pos SET paid='2',pembayaran=total_amount WHERE kode='$kodepos'";
			mysql_query($sql,$db);
						
			$sql="SELECT room,nama FROM trx_pos WHERE kode='$kodepos'";
			$hsltemp=mysql_query($sql,$db);
			list($room,$namacusttoko)=mysql_fetch_array($hsltemp);
			$sql="SELECT nama FROM mst_room WHERE kode='$room'";
			$hsltemp=mysql_query($sql,$db);
			list($room)=mysql_fetch_array($hsltemp);
			
			$sql="SELECT sum(qty * harga) FROM trx_pos_detail WHERE kode ='$kodepos'";
			$hsltemp=mysql_query($sql,$db);
			list($subtotal)=mysql_fetch_array($hsltemp);
			
			$sql="SELECT barcode,qty,harga FROM trx_pos_detail WHERE kode='$kodepos'";
			$hsldet=mysql_query($sql,$db);
			$subtotaltoko=0;
			while(list($barcode,$qty,$harga)=mysql_fetch_array($hsldet)){
				$sql="SELECT nama FROM mst_material_part WHERE kode='$barcode'";
				$hsltemp=mysql_query($sql,$db);
				list($namabarang)=mysql_fetch_array($hsltemp);
				$sql="SELECT coa FROM acc_setting_coa WHERE id='15'";//Pendapatan Toko
				$hsltemp=mysql_query($sql,$db);
				list($coa)=mysql_fetch_array($hsltemp);
				$kredit=$qty*$harga;
				$subtotaltoko+=$kredit;
				
				$debit=0;
				$keterangan="Penjualan $namabarang ($qty X @ Rp.$harga)";
				add_jurnal_detail($kodejurnal,$coa,$keterangan,$debit,$kredit);
			}
		}	
		
		//JURNAL HOTEL
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
		//echo "<br>$__subtotal1=$totalrate+($lamainap*$chargeextraperson);";
		$_discount=$__subtotal1*($__disc/100);
		$__subtotal2=$__subtotal1-$_discount;
		if($_withppn || true){$__ppn=$__subtotal2*0.1;}
		$__subtotal3=$__subtotal2+$__ppn;
		if($_withservice || true){$__service=$__subtotal3*0.11;}
		$__totalroom=$__subtotal3+$__service;
			
		//INSERT PENDAPATAN SEWA KAMAR
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='9'";//Pendapatan Kamar
		$hsltemp=mysql_query($sql,$db);
		list($coakamar)=mysql_fetch_array($hsltemp);
		$keterangan="Pendapatan Sewa Kamar [$room ($arrival/$departure)] an. $namacust";
		add_jurnal_detail($kodejurnal,$coakamar,$keterangan,$debit,$__subtotal1);
		
		//INSERT DISCOUNT
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='3'";//Discount
		$hsltemp=mysql_query($sql,$db);
		list($coadisc)=mysql_fetch_array($hsltemp);
		$keterangan="Discount Sewa Kamar [$room ($arrival/$departure)] an. $namacust";
		$__discount=$_discount*-1;
		add_jurnal_detail($kodejurnal,$coadisc,$keterangan,$debit,$__discount);	
		
		//TAX (Kredit)
		$kredittax=0;
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='5'";//pajak masukan
		$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
		$hsltemp=mysql_query($sql,$db);
		list($coatax)=mysql_fetch_array($hsltemp);
		$keterangan="Pajak Keluaran Sewa Kamar [$room ($arrival/$departure)] an. $namacust";
		add_jurnal_detail($kodejurnal,$coatax,$keterangan,$debit,$__ppn);
		
		//SERVICE (Kredit)
		$kreditservice=0;
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='4'";//service
		$hsltemp=mysql_query($sql,$db);
		list($coaservice)=mysql_fetch_array($hsltemp);
		$keterangan="Service Sewa  Kamar [$room ($arrival/$departure)] an. $namacust";
		add_jurnal_detail($kodejurnal,$coaservice,$keterangan,$debit,$__service);
		
		$sql="SELECT dp,dptype,dpbank,dp2,dptype2,dpbank2,dp3,dptype3,dpbank3,dp4,dptype4,dpbank4,dp5,dptype5,dpbank5 FROM trx_booking WHERE kode='$kodebooking'";
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
		
		if($totalcash!=0){
			$keterangan="DP Reservation Cash [$room ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0);
			//echo "<br>add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0)";
		}
		
		foreach($arrnoncash as $coabank => $__debitbank){
			if($__debitbank!=0){
				$keterangan="DP Reservation Bank[$room ($arrival/$departure)] an. $namacust";
				add_jurnal_detail($kodejurnal,$coabank,$keterangan,$__debitbank,0);
				//echo "<br>add_jurnal_detail($kodejurnal,$coabank,$keterangan,$__debitbank,0)";
			}
		}	
		
		if($paycash!=0){
			$keterangan="Billing Kamar Cash [$room ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$paycash,0,1);
			add_mutasi_uang($tanggal,"kas",$coa1,"",basename($__phpself),$kode,"","",$keterangan,$paycash,0);
		}
		if($payedc1!=0){
			$keterangan="Billing Kamar EDC [$room ($arrival/$departure)] an. $namacust ($noedc1)";
			add_jurnal_detail($kodejurnal,$coaedc1,$keterangan,$payedc1,0,1);
			add_mutasi_uang($tanggal,"EDC",$coaedc1,"",basename($__phpself),$kode,"","",$keterangan,$payedc1,0);
		}
		if($payedc2!=0){
			$keterangan="Billing Kamar EDC [$room ($arrival/$departure)] an. $namacust ($noedc2)";
			add_jurnal_detail($kodejurnal,$coaedc2,$keterangan,$payedc2,0,1);
			add_mutasi_uang($tanggal,"EDC",$coaedc2,"",basename($__phpself),$kode,"","",$keterangan,$payedc2,0);
		}
		if($paytrf!=0){
			$keterangan="Billing Kamar Transfer [$room ($arrival/$departure)] an. $namacust ($notrf)";
			add_jurnal_detail($kodejurnal,$coatrf,$keterangan,$paytrf,0,1);
			add_mutasi_uang($tanggal,"Bank",$coatrf,"",basename($__phpself),$kode,"","",$keterangan,$paytrf,0);
		}		
		
		$sql="UPDATE trx_billing SET paymenttype='$paymenttype',paid=1 WHERE kode='$kode'";
		mysql_query($sql,$db);
	}
?>
<?php
		
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
		$sql="SELECT description FROM mst_pay_type WHERE kode='$dptype'";$hsltemp=mysql_query($sql,$db);
		list($dptype)=mysql_fetch_array($hsltemp);
		$kdroom=$room;
		
		$sql="SELECT nama FROM mst_room WHERE kode='$room'";$hsltemp=mysql_query($sql,$db);
		list($room)=mysql_fetch_array($hsltemp);
		
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
				$sql="DELETE FROM trx_billing_details WHERE kode='".$kode."'";
				mysql_query($sql,$db);
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
				$_tanggalxx=$arrival;
				while($_tanggalxx!=$tanggal){
					$arrtgl=explode("-",$_tanggalxx);
					$_tgl=$arrtgl[2]; $_bln=$arrtgl[1]; $_thn=$arrtgl[0];
					$tipeday=date("N",mktime(0,0,0,$_bln,$_tgl,$_thn));
					if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
						$description = "Room Charge (Week Days)";
						$nominal = $rate1;
					}else{
						$description = "Room Charge (Week Ends)";
						$nominal = $rate2;
					}
					$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$_tanggalxx."','$description','$nominal')";
					$_tanggalxx=date("Y-m-d",mktime(0,0,0,$_bln,$_tgl+1,$_thn));
					mysql_query($sql,$db);
				}
				//miscellaneous
				$sql="SELECT kode FROM trx_additional_detail WHERE kode IN (SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')) ORDER BY kode,seqno";
				$hslrest=mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
				}
				$sql="SELECT kode,tanggal,paid,refno FROM trx_additional WHERE kodebooking='$kodebooking' ORDER BY kode";
				$hsladditionals = mysql_query($sql,$db);
				while(list($kode_additional,$additionalDate,$paid,$refno) = mysql_fetch_array($hsladditionals)){
					$sql="SELECT kode,kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode='$kode_additional'  ORDER BY kode,seqno";
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
				$balance = $totDeposit - $totRoom - $totMiscellaneous;
				if($balance <= 0) $balance = "<td></td><td align='right'><b>".number_format($balance * -1)."</b></td>";
				else $balance = "<td align='right'><b>".number_format($balance)."</b></td>";
				?>
				<tr><td></td><td align="right">Deposit</td><td></td><td align="right"><?=number_format($totDeposit);?></td></tr>
				<tr><td></td><td align="right">Room Charge</td><td align="right"><?=number_format($totRoom);?></td></tr>
				<tr><td></td><td align="right">Miscellaneous</td><td align="right"><?=number_format($totMiscellaneous);?></td></tr>
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