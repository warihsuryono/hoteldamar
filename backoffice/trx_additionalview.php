<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	include_once "func_jurnal.php";
	if($_GET["paid"]){
		$kode=$_GET["kode"];
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
		$tanggalbayar=$_GET["tanggalbayar"];
		$sql="UPDATE trx_additional SET paid='1',paymenttype='$paymenttype',coabank='$coabank',norek='$norek' WHERE kode='".$_GET["kode"]."'";
		mysql_query($sql,$db);
		//INSERT ACCOUNTING
		if(!$tanggalbayar){$tanggal=date("Y-m-d");}else{$tanggal=$tanggalbayar;}
		$createby=$__username;
		$sql="SELECT room FROM trx_additional WHERE kode='".$_GET["kode"]."'";
		$hsltemp=mysql_query($sql,$db);
		list($room)=mysql_fetch_array($hsltemp);
		$sql="SELECT nama FROM mst_room WHERE kode='$room'";
		$hsltemp=mysql_query($sql,$db);
		list($room)=mysql_fetch_array($hsltemp);
		$notes="Additional Bill Room $room";
		$kodejurnal=add_jurnal($tanggal,$norek,$vendor,$notes);
		
		$sql="SELECT notes,room,withppn,withservice,nett,disc,discname FROM trx_additional WHERE kode='".$_GET["kode"]."'";
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
		$sql="SELECT sum(qty * price) FROM trx_additional_detail WHERE kode ='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($subtotal)=mysql_fetch_array($hsltemp);
		
		$sql="SELECT kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode='$kode'";
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
			if(!$coa1){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coa1)=mysql_fetch_array($hsltemp);
			}
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
			
		//VOUCHER
		$kreditvoucher=0;
		if($_GET["paidvoucher"]){
			$sql="SELECT coa FROM acc_setting_coa WHERE id='3'";//Discount
			$hsltemp=mysql_query($sql,$db);
			list($coadisc)=mysql_fetch_array($hsltemp);
			$keterangan="Discount Voucher Additional [$room]";
			if($notes){$keterangan.=" ($notes)";}
			$debit=0;
			$kreditvoucher=($subtotal+$kredittax+$kreditservice)*-1;
			add_jurnal_detail($kodejurnal,$coadisc,$keterangan,$debit,$kreditvoucher);
			if(!$coa1){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coa1)=mysql_fetch_array($hsltemp);
			}
		}
		
		//KAS/BANK (Debit)
		$keterangan="Additional Bill [$room]";
		if($notes){$keterangan.=" ($notes)";}
		$kredit=0;
		$debit1=$subtotal2+$kredittax+$kreditservice;
		$debit1=$debit1+$kreditvoucher;
		if($paycash>0){
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
			$hsltemp=mysql_query($sql,$db);
			list($coa1)=mysql_fetch_array($hsltemp);
			$keterangan="Additional Bill Cash [$room]";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$paycash,0);
			add_mutasi_uang($tanggal,"kas",$coa1,"",basename($__phpself),$kode,"","",$keterangan,$paycash,0);
		}
		if($payedc1>0){
			$keterangan="Additional Bill EDC [$room] ($noedc1)";
			add_jurnal_detail($kodejurnal,$coaedc1,$keterangan,$payedc1,0);
			add_mutasi_uang($tanggal,"EDC",$coaedc1,"",basename($__phpself),$kode,"","",$keterangan,$payedc1,0);
		}
		if($payedc2>0){
			$keterangan="Additional Bill EDC [$room] ($noedc2)";
			add_jurnal_detail($kodejurnal,$coaedc2,$keterangan,$payedc2,0);
			add_mutasi_uang($tanggal,"EDC",$coaedc2,"",basename($__phpself),$kode,"","",$keterangan,$payedc2,0);
		}
		if($paytrf>0){
			$keterangan="Additional Bill Transfer [$room] ($notrf)";
			add_jurnal_detail($kodejurnal,$coatrf,$keterangan,$paytrf,0);
			add_mutasi_uang($tanggal,"Bank",$coatrf,"",basename($__phpself),$kode,"","",$keterangan,$paytrf,0);
		}	
	}
	$tablename=str_ireplace("view.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
	if(!$tanggalbayar){$tanggalbayar=date("Y-m-d");}
?>
	<?php include_once "ajax.init.php"; ?>
	<style>
		input{
			height:18px;
			font-size:10px;
			padding-top:0px;
			font-family:verdana;
			border:none;
		}
	</style>
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
				<td><b>Tanggal Bayar</b></td>
				<td>:</b></td>
				<td>
					<input id="tanggalbayar" type="text" name="tanggalbayar" value="<?php echo $tanggalbayar; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggalbayar')">
				</td>
			</tr>
			<tr>
				<td><b>Metode Bayar</b></td>
				<td>:</b></td>
				<td>
					<select name="paymenttype" id="paymenttype">
						<?php
							$sql="SELECT kode,description FROM mst_pay_type ORDER BY kode";
							$hsltemp=mysql_query($sql,$db);
							while(list($kode,$description)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $kode; ?>"><?php echo $description; ?></option>
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
							while(list($kode,$description)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $kode; ?>"><?php echo $description; ?></option>
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
					<input type="button" value="OK" id="paidbutton" onclick="window.location='<?php echo $__phpself;?>?paid=1&kode=<?php echo $_GET["kode"]; ?>&paymenttype='+paymenttype.value+'&tanggalbayar='+tanggalbayar.value+'&coabank='+coabank.value+'&norek='+norek.value;">
				</td>
			</tr>
		</table>
	</div>
	<div id="printarea">
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<!--table width="100%"><tr><td align="center"><h3><b>ADDITIONAL</b></h3></td></tr></table-->
		<?php $__captiontitle="ADDITIONAL BILL";include_once "header_document.php"; ?>
		<table>
			<tr>
				<td>Transaction No</td>
				<td>:</td>
				<td id="kode"></td>
			</tr>
			<tr>
				<td>Date</td>
				<td>:</td>
				<td id="tanggal"></td>
			</tr>
			<tr>
				<td>Room</td>
				<td>:</td>
				<td id="room"></td>
			</tr>
			<!--tr>
				<td>PPN & Service</td>
				<td>:</td>
				<td>
					<input type="checkbox" name="withppn" id="withppn" value="1" disabled>With PPN
					<input type="checkbox" name="withservice" id="withservice" value="1" disabled>With Service
				</td>
			<tr-->
			<!--tr>
				<td nowrap>Discount</td>
				<td>:</td>
				<td>
					<select name="discname" id="discname" onchange="loaddisc(this.value);" disabled>
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
			</tr-->
			<tr>
				<td>Notes</td>
				<td>:</td>
				<td id="notes"></td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1">
					<b>No</b>
				</td>
				<!--td><b>Code</b></td-->
				<td width="1"><b>Additional</b></td>
				<td><b>Notes</b></td>
				<td width="1"><b>Qty</b></td>
				<td width="1"><b>Price</b></td>
				<td width="1"><b>Total</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<!--td>
					<input id="kode_add[0]" type="text" name="kode_add[0]" size="20" readonly>
				</td-->
				<td id="namaadditional[0]"></td>
				<td id="keterangan[0]"></td>
				<td align="right" id="qty[0]"></td>
				<td align="right" id="price[0]"></td>
				<td align="right" id="jumlah[0]"></td>
			</tr>
			<?php
				$sql="SELECT withppn,withservice,subtotal1,ppn,subtotal2,service,disc,grandtotal,paid FROM trx_additional WHERE kode='".$_GET["kode"]."'";
				$hsltemp=mysql_query($sql,$db);
				list($_withppn,$_withservice,$_subtotal1,$_ppn,$_subtotal2,$_service,$_disc,$_grandtotal,$_paid)=mysql_fetch_array($hsltemp);
				$_disc=$_subtotal1*$_disc/100;
				$_subtotal3=$_subtotal2+$_ppn;
			?>
			<tr id="rowdetail_footer">
				<td valign="top" colspan="5" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr><td align="right"><i>Sub Total 1</i></td></tr>
						<tr><td align="right"><i>Disc</i></td></tr>
						<tr><td align="right"><i>Sub Total 2</i></td></tr>
						<tr><td align="right"><i>Tax 10 %</i></td></tr>
						<tr><td align="right"><i>Sub Total 3</i></td></tr>
						<tr><td align="right"><i>Service 11 %</i></td></tr>
						<tr><td align="right"><i>Grand Total</i></td></tr>
					</table>
				</td>
				<td valign="top" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr><td align="right"><?php echo number_format($_subtotal1);?></td></tr>
						<tr><td align="right"><?php echo number_format($_disc);?></td></tr>
						<tr><td align="right"><?php echo number_format($_subtotal2);?></td></tr>
						<tr><td align="right"><?php echo number_format($_ppn);?></td></tr>
						<tr><td align="right"><?php echo number_format($_subtotal3);?></td></tr>
						<tr><td align="right"><?php echo number_format($_service);?></td></tr>
						<tr><td align="right"><b><?php echo number_format($_grandtotal);?></b></td></tr>
					</table>
				</td>					
			</tr>
		</table>
	</form>
	<?php $null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
	<table width="100%">
		<tr>
			<td>Customer,</td>
		</tr>
		<tr style="vertical-align:bottom;height:80px">
			<td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td>(<?php echo $null; ?><?php echo $null; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="buttonrowdiv">
				<?php if(!$_paid){ ?>
					<input type="button" value="Pay" id="paidbutton" onclick="divpay.style.visibility='visible';paycash.focus();">
					<?php if($_disc<=0){ ?>
						<!--input type="button" value="Pay with Voucher" id="paidvoucherbutton" onclick="if(confirm('Pay with Voucher?')){window.location='<?php echo $__phpself;?>?paid=1&kode=<?php echo $_GET["kode"]; ?>&paidvoucher=1';}"-->
					<?php } ?>
				<?php }else{ ?>
					PAID!
				<?php } ?>
				
				<input type="button" value="Kembali" id="kembalibutton" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<!--input type="button" value="Print" id="printbutton" onclick="try{buttonrowdiv.style.visibility='hidden';}catch(err){} window.print();kembalibutton.click();"-->
				<input type="button" value="Print" id="printbutton" onclick="document.getElementById('printarea').className = 'print_mode';try{buttonrowdiv.style.visibility='hidden';}catch(err){} window.print(); try{buttonrowdiv.style.visibility='visible';}catch(err){} document.getElementById('printarea').className = '';">
				</div>
			</td>
		</tr>
	</table>
	</div>
<?php
		$kode=$_GET["kode"];
		$sql="SHOW COLUMNS FROM $tablename";
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
			if($varname=="room"){
				$sql="SELECT nama FROM mst_room WHERE kode='$value'";$hsltemp=mysql_query($sql,$db);list($value)=mysql_fetch_array($hsltemp);
			}			
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").innerHTML="<?php echo $value; ?>";</script><?php
			if(($varname=="withppn" ||  $varname=="withservice")){
				if($value=="0"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>").checked=false;</script><?php
				}
				if($value=="1"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>").checked=true;</script><?php
				}
			}
		}
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
		//LOAD DETAIL
		$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($jumlahdetail)=mysql_fetch_array($hsltemp);
		if($jumlahdetail<8){$jumlahdetail=8;}
		for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
		
		$sql="SHOW COLUMNS FROM $tabledetailname";
		$hsltemp=mysql_query($sql,$db);
		$selectdetail="";
		while(list($fieldname)=mysql_fetch_array($hsltemp)){
			if($fieldname!=$kodename){
				$selectdetail.="`$fieldname`,";
			}
		}
		$selectdetail=substr($selectdetail,0,strlen($selectdetail)-1);
		$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
		$hsldet=mysql_query($sql,$db);
		$no=-1;
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$kode_add="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="qty"){$qty=$valuedetail;}
				if($vardetailname=="price"){$price=$valuedetail;$valuedetail=number_format($valuedetail);}
				if($vardetailname=="kode_add"){$kode_add=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
			}
			$sql="SELECT description FROM mst_additional WHERE kode='$kode_add'";
			$hsltemp=mysql_query($sql,$db);
			list($namaadditional)=mysql_fetch_array($hsltemp);
			?><script language="javascript">document.getElementById("namaadditional[<?php echo $no; ?>]").innerHTML="<?php echo $namaadditional; ?>";</script><?php
			$jumlah=number_format($qty*$price);
			?><script language="javascript">document.getElementById("jumlah[<?php echo $no; ?>]").innerHTML="<?php echo $jumlah; ?>";</script><?php
		}
	include_once "footer.php";
?>
<script language="javascript">
	paycash.value="<?php echo number_format($_grandtotal);?>";
	paycash.focus();
</script>