<?php
	include_once "header.php";
	if($_POST["pay"]){
		$pono=$_POST["pono"];
		$invoiceno=$_POST["invoiceno"];
		$nominal=$_POST["nominal"];
		$ppn=$_POST["ppn"];
		$paymenttype=$_POST["paymenttype"];
		$coabank=$_POST["coabank"];
		$norek=$_POST["norek"];
		$tanggal=date("Y-m-d");
		$kodejurnal="JURNAL/".date("Ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		$notes="Pembayaran Invoice $invoiceno";
		$sql="SELECT vendorid FROM logistik_po WHERE pono='$pono'";
		$hsltemp=mysql_query($sql,$db);
		list($vendorid)=mysql_fetch_array($hsltemp);
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,posting,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','invoice','$vendorid','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);
		$total=$nominal+$ppn;
		$seqno=0;
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
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa1'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Pembayaran Invoice $invoiceno";
		$debit=0;
		$kreditkasbank=$nominal;
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa1','$koder','$keterangan','$debit','$kreditkasbank')";
		mysql_query($sql,$db);
		
		//PPN
		if($ppn!=0){
			$seqno++;
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";//pajak keluaran dg kas
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			
			if($paymenttype=="01" || !$paymenttype){//cash
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coatax)=mysql_fetch_array($hsltemp);
			}else{
				if(!$coabank){
					$sql="SELECT coa FROM acc_setting_coa WHERE id='2'";
					$hsltemp=mysql_query($sql,$db);
					list($coabank)=mysql_fetch_array($hsltemp);
				}
				$coatax=$coabank;
			}
			
			
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$kredit=$ppn;
			$keterangan="Pajak Keluaran Invoice $invoiceno";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
			$seqno++;
			$debit=$kredit;
			$kredit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='13'";//Hutang pajak 
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$keterangan="Hutang Pajak Invoice $invoiceno";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
		}
		//HUTANG DAGANG
		$seqno++;
		$debit=$nominal;
		$kredit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='12'";//hutang dagang
		$hsltemp=mysql_query($sql,$db);
		list($coahutang)=mysql_fetch_array($hsltemp);
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coahutang'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Hutang Dagang Invoice $invoiceno";
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coahutang','$koder','$keterangan','$debit','$kredit')";
		mysql_query($sql,$db);	
		?><script language="javascript"> window.location="acc_jurnallist.php"; </script><?php
	}
?>
<form method="POST" action="<?php echo $__phpself; ?>">
<fieldset>
	<legend><b>Pembayaran Invoice</b></legend>
	<table border="0" bgcolor="c5f05e">
		<tr>
			<td nowrap><b>PO No</b></td>
			<td>:</b></td>
			<td>
				<select name="pono" id="pono">
					<option value="">-pilih po-</option>
					<?php
						$sql="SELECT pono FROM logistik_receive_material WHERE pono<>'' ORDER BY pono DESC LIMIT 100";
						$hsltemp=mysql_query($sql,$db);
						while(list($_pono)=mysql_fetch_array($hsltemp)){
					?>
						<option value="<?php echo $_pono; ?>" <?php if($pono==$_pono){echo "selected"; } ?>><?php echo $_pono; ?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td nowrap><b>Invoice No</b></td>
			<td>:</b></td>
			<td><input type="text" name="invoiceno" id="invoiceno"></td>
		</tr>
		<tr>
			<td nowrap><b>Nominal (Tanpa PPn)</b></td>
			<td>:</b></td>
			<td><input type="text" name="nominal" id="nominal"></td>
		</tr>
		<tr>
			<td nowrap><b>Nominal PPn</b></td>
			<td>:</b></td>
			<td nowrap><input type="text" name="ppn" id="ppn" value="0"><br> *kosongkan atau isi '0' bila tanpa PPn</td>
		</tr>
		<tr>
			<td nowrap><b>Metode Bayar</b></td>
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
						$sql="SELECT coa,description FROM acc_mst_coa WHERE description LIKE '%bank%' ORDER BY description";
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
			<td nowrap><b>No Card / No Rek</b></td>
			<td>:</b></td>
			<td><input type="text" name="norek" id="norek"></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" value="OK" name="pay"></td>
		</tr>
	</table>
</fieldset>
</form>
<?php
	include_once "footer.php";
?>