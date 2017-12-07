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
				$keterangan="Pajak Masukan Additional";
				$keterangan="Pajak Keluaran Additional";
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
				$keterangan="Service Additional";
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
			$keterangan="DP Booking Room Cash [$room ($arrival/$departure)] an. $namacust";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0);
			//echo "<br>add_jurnal_detail($kodejurnal,$coa1,$keterangan,$totalcash,0)";
		}
		
		foreach($arrnoncash as $coabank => $__debitbank){
			if($__debitbank!=0){
				$keterangan="DP Booking Room Bank[$room ($arrival/$departure)] an. $namacust";
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
		<?php $__captiontitle="ROOM BILL";include_once "header_document.php"; ?>
		<fieldset style="width:100%">
			<legend><b>Guest Bill</b></legend>
			<table width="100%">
				<tr>
					<td valign="top" width="25%">
						<table width="25%">
							<tr>
								<td style="font-size : 12px;" nowrap><b>Bill No</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $kode; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Room</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $room; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Date</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo format_tanggal($tanggal); ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Name</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $title." ".$nama; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>ID Number</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $idno." ($idtype)"; ?></td>
							</tr>
						</table>
					<td>
					<td valign="top" width="25%">
						<table width="25%">
							<tr>
								<td style="font-size : 12px;" nowrap><b>Address</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;"><?php echo $alamat; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Phone</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $phone; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>E-Mail</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $email; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Company</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $company; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Department</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo $departement; ?></td>
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
								<td style="font-size : 12px;" nowrap><b>Person</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right"><?php echo $person; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Arrival</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo format_tanggal($arrival); ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Departure</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" nowrap><?php echo format_tanggal($tanggal); ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Rate Week Days</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($rate1); ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Rate Week End</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($rate2); ?></td>
							</tr>
						</table>
					<td>
					<td valign="top" width="25%">
						<table width="25%">
							<tr>
								<td style="font-size : 12px;" nowrap><b>Charge Person</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right" nowrap><?php echo "($extraperson) ".number_format($chargeextraperson); ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Long Stay(s)</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right"><?php echo $lamainap; ?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" nowrap><b>Down Payment</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__dp); ?></td>
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
								<td style="font-size : 12px;" nowrap><b>Notes</b></td>
								<td style="font-size : 12px;"><b>:</b></td>
								<td style="font-size : 12px;"><?php echo $notes; ?></td>
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
					<td style="font-size : 12px;">No</td>
					<td style="font-size : 12px;">Bill No</td>
					<td style="font-size : 12px;">Food/Drink Code</td>
					<td style="font-size : 12px;">Description</td>
					<td style="font-size : 12px;">Notes</td>
					<td style="font-size : 12px;">Qty</td>
					<td style="font-size : 12px;">Disc</td>
					<td style="font-size : 12px;">Price</td>
					<td style="font-size : 12px;">Total</td>
				</tr>
				<?php
					$no=0;
					$txtbillno="";
					$billnonow="";
					$sql="SELECT kode,foodid,qty,price,keterangan FROM trx_restaurant_bill_detail WHERE kode IN (SELECT kode FROM trx_restaurant_bill WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')) ORDER BY kode,seqno";
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
						<td style="font-size : 12px;" align="right"><?php echo $no; ?></td>
						<td style="font-size : 12px;"><?php echo $txtbillno; ?></td>
						<td style="font-size : 12px;"><?php echo $foodid; ?></td>
						<td style="font-size : 12px;"><?php echo $description; ?></td>
						<td style="font-size : 12px;"><?php echo $keterangan; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo $qty; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($disc); ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price); ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price*$qty); ?></td>
					</tr>
				<?php
					}
					
					$_ppn=$_subtotal1*0.1;
					$_subtotal2=$_subtotal1+$_ppn;
					$_service=$_subtotal2*0.11;
					$__totalrestaurant=$_subtotal2+$_service;
				?>
				<tr id="rowdetail_footer">
					<td valign="top" colspan="8" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><i>Sub Total 1</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Tax 10 %</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Sub Total 2</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Service 11 %</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Restaurant Total</i></td></tr>
						</table>
					</td>
					<td valign="top" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_subtotal1);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_ppn);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_subtotal2);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_service);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><?php echo number_format($__totalrestaurant);?></b></td></tr>
						</table>
					</td>					
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend><b>Additional Detail</b></legend>
			<table class="content_table" width="100%">
				<tr class="content_header">
					<td style="font-size : 12px;">No</td>
					<td style="font-size : 12px;">Bill No</td>
					<td style="font-size : 12px;">Additional Code</td>
					<td style="font-size : 12px;">Description</td>
					<td style="font-size : 12px;">Notes</td>
					<td style="font-size : 12px;">Qty</td>
					<td style="font-size : 12px;">Disc</td>
					<td style="font-size : 12px;">Price</td>
					<td style="font-size : 12px;">Total</td>
				</tr>
				<?php
					$no=0;
					$txtbillno="";
					$billnonow="";
					$sql="SELECT kode,kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode IN (SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')) ORDER BY kode,seqno";
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
						<td style="font-size : 12px;" align="right"><?php echo $no; ?></td>
						<td style="font-size : 12px;"><?php echo $txtbillno; ?></td>
						<td style="font-size : 12px;"><?php echo $addid; ?></td>
						<td style="font-size : 12px;"><?php echo $description; ?></td>
						<td style="font-size : 12px;"><?php echo $keterangan; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo $qty; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($disc); ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price); ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price*$qty); ?></td>
					</tr>
				<?php
					}
					$_ppn=$_subtotal1*0.1;
					$_subtotal2=$_subtotal1+$_ppn;
					$_service=$_subtotal2*0.11;
					$__totaladditional=$_subtotal2+$_service;
				?>
				<tr id="rowdetail_footer">
					<td valign="top" colspan="8" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><i>Sub Total 1</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Tax 10 %</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Sub Total 2</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Service 11 %</i></td></tr>
							<tr><td style="font-size : 12px;" align="right"><i>Additional Total</i></td></tr>
						</table>
					</td>
					<td valign="top" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_subtotal1);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_ppn);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_subtotal2);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_service);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><?php echo number_format($__totaladditional);?></b></td></tr>
						</table>
					</td>					
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend><b>Store Detail</b></legend>
			<table class="content_table" width="100%">
				<tr class="content_header">
					<td style="font-size : 12px;">No</td>
					<td style="font-size : 12px;">Bill No</td>
					<td style="font-size : 12px;">Barcode</td>
					<td style="font-size : 12px;">Description</td>
					<td style="font-size : 12px;">Qty</td>
					<td style="font-size : 12px;">Price</td>
					<td style="font-size : 12px;">Total</td>
				</tr>
				<?php
					$no=0;
					$txtbillno="";
					$billnonow="";
					$sql="SELECT kode,barcode,qty,harga FROM trx_pos_detail WHERE kode IN (SELECT kode FROM trx_pos WHERE kodebooking='$kodebooking' AND paid='2') ORDER BY kode,seqno";
					$hslrest=mysql_query($sql,$db);
					$_subtotaltoko=0;
					while(list($billno,$barcode,$qty,$price)=mysql_fetch_array($hslrest)){
						$_subtotaltoko+=($price*$qty);
						$no++;
						$txtbillno="";
						if($billnonow!=$billno){$billnonow=$billno;$txtbillno=$billno;if($__nett){$txtbillno.=" (NETT)";}}
						$sql="SELECT nama FROM mst_material_part WHERE kode='$barcode'";
						$hsltemp=mysql_query($sql,$db);
						list($namabarang)=mysql_fetch_array($hsltemp);
				?>
					<tr>
						<td style="font-size : 12px;" align="right"><?php echo $no; ?></td>
						<td style="font-size : 12px;"><?php echo $billno; ?></td>
						<td style="font-size : 12px;"><?php echo $barcode; ?></td>
						<td style="font-size : 12px;"><?php echo $namabarang; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo $qty; ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price); ?></td>
						<td style="font-size : 12px;" align="right"><?php echo number_format($price*$qty); ?></td>
					</tr>
				<?php
					}
				?>
				<tr id="rowdetail_footer">
					<td valign="top" colspan="6" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><i>Store Total</i></td></tr>
						</table>
					</td>
					<td valign="top" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><b><?php echo number_format($_subtotaltoko);?></b></td></tr>
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
								<td style="font-size : 12px;" align="right"><i>Sub Total</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__subtotal1);?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" align="right"><i>Discount</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($_discount);?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" align="right"><i>Sub Total 2</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__subtotal2);?></td>
							</tr>
						</table>
					<td>
					<td valign="top" width="50%">
						<table width="100%">
							<tr>
								<td style="font-size : 12px;" align="right"><i>PPN 10 %</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__ppn);?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" align="right"><i>Sub Total 3</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__subtotal3);?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" align="right"><i>Service 11 %</i></td>
								<td style="font-size : 12px;" align="right"><?php echo number_format($__service);?></td>
							</tr>
							<tr>
								<td style="font-size : 12px;" align="right"><i>Room Total</i></td>
								<td style="font-size : 12px;" align="right"><b><?php echo number_format($__totalroom);?></b></td>
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
							<tr><td style="font-size : 12px;" align="right"><b><i>Resturant</i></b></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><i>Additional</i></b></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><i>Store</i></b></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><i>Room</i></b></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><i>Down Payment</i></b></td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><i>Grand Total</i></b></td></tr>
						</table>
					</td>
					<td valign="top" align="right">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($__totalrestaurant);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($__totaladditional);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($_subtotaltoko);?></td></tr>
							<tr><td style="font-size : 12px;" align="right"><?php echo number_format($__totalroom);?></td></tr>
							<tr><td style="font-size : 12px;" align="right">(<?php echo number_format($__dp);?>)</td></tr>
							<tr><td style="font-size : 12px;" align="right"><b><?php echo number_format($__grandtotal);?></b></td></tr>
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