<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_bookinginfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$trx_booking_view = new ctrx_booking_view();
$Page =& $trx_booking_view;

// Page init processing
$trx_booking_view->Page_Init();

// Page main processing
$trx_booking_view->Page_Main();
?>
<?php include "header.php" ?>
<?php include "func.openwin.php" ?>
<?php include "func_jurnal.php" ?>
<?php 
	$updateconfirmasi=$_GET["updateconfirmasi"];
	$updatecheckin=$_GET["updatecheckin"];
	$value=$_GET["value"];
	$kode=$_GET["kode"];
	$tanggal=$_GET["tanggal"]." ".date("H:i:s");
	$sql="SELECT room,rate1,rate2 FROM trx_booking WHERE kode='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($room,$rate1,$rate2)=mysql_fetch_array($hsltemp);
	if($updateconfirmasi){
		if($value==1){
			$sql="SELECT title,nama,room,arrival,departure,dp,dptype,dpbank,dp2,dptype2,dpbank2,dp3,dptype3,dpbank3,dp4,dptype4,dpbank4,dp5,dptype5,dpbank5 FROM trx_booking WHERE kode='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($title,$nama,$room,$arrival,$departure,$dp,$dptype,$dpbank,$dp2,$dptype2,$dpbank2,$dp3,$dptype3,$dpbank3,$dp4,$dptype4,$dpbank4,$dp5,$dptype5,$dpbank5)=mysql_fetch_array($hsltemp);
			$sql="SELECT nama FROM mst_room WHERE kode='$room'";
			$hsltemp=mysql_query($sql,$db);
			list($room)=mysql_fetch_array($hsltemp);
			$custtitle=$title;
			$custnama=$nama;	
			$namacust=$custtitle." ".$custnama;
			$totalnoncash=0;
			$totalcash=0;
			$arrnoncash=array();
			if($dptype!="01"){$totalnoncash+=$dp;$arrnoncash[$dpbank]+=$dp;}else{$totalcash+=$dp;}
			if($dptype2!="01"){$totalnoncash+=$dp2;$arrnoncash[$dpbank2]+=$dp2;}else{$totalcash+=$dp;}
			if($dptype3!="01"){$totalnoncash+=$dp3;$arrnoncash[$dpbank3]+=$dp3;}else{$totalcash+=$dp;}
			if($dptype4!="01"){$totalnoncash+=$dp4;$arrnoncash[$dpbank4]+=$dp4;}else{$totalcash+=$dp;}
			if($dptype5!="01"){$totalnoncash+=$dp5;$arrnoncash[$dpbank5]+=$dp5;}else{$totalcash+=$dp;}
			if($totalcash>0){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
				$hsltemp=mysql_query($sql,$db);
				list($coa)=mysql_fetch_array($hsltemp);
				$keterangan="DP Booking Room Kas[$room ($arrival/$departure)] an. $namacust";
				add_mutasi_uang($tanggal,"kas",$coa,"",basename($__phpself),$kode,"","",$keterangan,$totalcash,0);
			}			
			foreach($arrnoncash as $coabank => $__debitbank){
				if($__debitbank!=0){
					$keterangan="DP Booking Room Bank[$room ($arrival/$departure)] an. $namacust";
					add_mutasi_uang($tanggal,"Bank",$coabank,"",basename($__phpself),$kode,"","",$keterangan,$__debitbank,0);
				}
			}			
			$sql="UPDATE mst_room SET available='1' WHERE kode='$room'";
		}else{
			$sql="DELETE FROM trx_mutasi_uang WHERE kode_trx='$kode' AND modul='".basename($__phpself)."'";
			mysql_query($sql,$db);			
			$sql="UPDATE mst_room SET available='0' WHERE kode='$room'";
		}
		mysql_query($sql,$db);
		$sql="UPDATE trx_booking SET confirmasi='$value',confirmby='".$_SESSION["username"]."',confirmdate='$tanggal' WHERE kode='$kode'";		
		mysql_query($sql,$db);
		if($value!="1"){
			$sql="UPDATE trx_booking SET checkin='0' WHERE kode='$kode'";		
			mysql_query($sql,$db);
		}
	}
	if($updatecheckin){
		$sql="UPDATE trx_booking SET checkin='$value',checkinby='".$_SESSION["username"]."',checkindate='$tanggal' WHERE kode='$kode'";		
		mysql_query($sql,$db);
	}
?>
<?php if ($trx_booking->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_booking_view = new ew_Page("trx_booking_view");

// page properties
trx_booking_view.PageID = "view"; // page ID
var EW_PAGE_ID = trx_booking_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
trx_booking_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_booking_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_booking_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->
	function updateconfirmasi(kode,val){
		divconfirmasi.style.visibility="visible";
		hidkode.value=kode;
		hidval.value=val
	}
	function updatecheckin(kode,val){
		divcheckin.style.visibility="visible";
		hidkode.value=kode;
		hidval.value=val
	}
</script>
<?php } ?>
<p><span class="phpmaker"><h3><b>Booking Room</b></h3>
<br><br>
<?php if ($trx_booking->Export == "") { ?>
[<a href="trx_bookinglist.php">Back to List</a>]&nbsp;&nbsp;&nbsp;
<input type="button" value="Guest Form" onclick="window.location='trx_guestform.php?kode=<?php echo $_GET["kode"]; ?>';">
<?php } ?>
</span></p>
<?php $trx_booking_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="divcheckin" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
	<input type="hidden" id="hidkode">
	<input type="hidden" id="hidval">
	<table border="0" bgcolor="c5f05e">
		<tr>
			<td nowrap>Tanggal</td>
			<td>:</td>
			<td>
				<input id="tanggal1" type="text" name="tanggal1" value="<?php echo date("Y-m-d"); ?>" size="12">
				<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal1')">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="button" value="OK" id="confirmasi" onclick="window.location='<?php $_SERVER["PHP_SELF"];?>?updatecheckin=1&kode='+hidkode.value+'&tanggal='+tanggal1.value+'&value='+hidval.value;">
			</td>
		</tr>
	</table>
</div>
<div id="divconfirmasi" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
	<input type="hidden" id="hidkode">
	<input type="hidden" id="hidval">
	<table border="0" bgcolor="c5f05e">
		<tr>
			<td nowrap>Tanggal</td>
			<td>:</td>
			<td>
				<input id="tanggal2" type="text" name="tanggal2" value="<?php echo date("Y-m-d"); ?>" size="12">
				<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal2')">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="button" value="OK" id="confirmasi" onclick="window.location='<?php $_SERVER["PHP_SELF"];?>?updateconfirmasi=1&kode='+hidkode.value+'&tanggal='+tanggal2.value+'&value='+hidval.value;">
			</td>
		</tr>
	</table>
</div>
<div class="ewGridMiddlePanel">
<table>
	<tr>
		<td valign="top">
<table cellspacing="0" class="ewTable">
<?php if ($trx_booking->kode->Visible) { // kode ?>
	<tr<?php echo $trx_booking->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode</td>
		<td<?php echo $trx_booking->kode->CellAttributes() ?>>
<div<?php echo $trx_booking->kode->ViewAttributes() ?>><?php echo $trx_booking->kode->ViewValue ?></div></td>
	</tr>
<?php } ?>
 
<?php 
	$sql="SELECT confirmasi,checkin FROM trx_booking WHERE kode='".$trx_booking->kode->ViewValue."'";
	$hsltemp=mysql_query($sql,$db);
	list($_confirmasi,$_checkin)=mysql_fetch_array($hsltemp);
?>
<?php if ($trx_booking->confirmasi->Visible) { // confirmasi ?>
	<tr<?php echo $trx_booking->confirmasi->RowAttributes ?>>
		<td class="ewTableHeader">Confirmasi</td>
		<td<?php echo $trx_booking->confirmasi->CellAttributes() ?>>
			<!--select name="confirmasi" id="confirmasi" onchange="window.location='<?php $_SERVER["PHP_SELF"];?>?updateconfirmasi=1&kode=<?php echo $trx_booking->kode->ViewValue;?>&value='+this.value;"-->
			<select name="confirmasi" id="confirmasi" onchange="updateconfirmasi('<?php echo $trx_booking->kode->ViewValue;?>',this.value);">
				<option value="0" <?php if($_confirmasi==0) {echo "selected"; } ?>>Belum</option>
				<option value="1" <?php if($_confirmasi==1) {echo "selected"; } ?>>Ya</option>
				<option value="2" <?php if($_confirmasi==2) {echo "selected"; } ?>>Batal</option>
			</select>
		</td>
	</tr>
<?php } ?>
<?php if ($trx_booking->checkin->Visible) { // checkin ?>
	<tr<?php echo $trx_booking->checkin->RowAttributes ?>>
		<td class="ewTableHeader">Check In</td>
		<td<?php echo $trx_booking->checkin->CellAttributes() ?>>
			<?php if($_confirmasi!=1) { ?>
			<div<?php echo $trx_booking->checkin->ViewAttributes() ?>><?php echo $trx_booking->checkin->ViewValue ?></div>
			<?php } else { ?>
			<!--select name="checkin" id="checkin" onchange="window.location='<?php $_SERVER["PHP_SELF"];?>?updatecheckin=1&kode=<?php echo $trx_booking->kode->ViewValue;?>&value='+this.value;"-->
			<select name="checkin" id="checkin" onchange="updatecheckin('<?php echo $trx_booking->kode->ViewValue;?>',this.value);">
				<option value="0" <?php if($_checkin==0) {echo "selected"; } ?>>No</option>
				<option value="1" <?php if($_checkin==1) {echo "selected"; } ?>>Yes</option>
			</select>
			<?php } ?>
		</td>
	</tr>
<?php } ?>
<!--
<?php if ($trx_booking->idseqno->Visible) { // idseqno ?>
	<tr<?php echo $trx_booking->idseqno->RowAttributes ?>>
		<td class="ewTableHeader">Seqno</td>
		<td<?php echo $trx_booking->idseqno->CellAttributes() ?>>
<div<?php echo $trx_booking->idseqno->ViewAttributes() ?>><?php echo $trx_booking->idseqno->ViewValue ?></div></td>
	</tr>
<?php } ?>
-->
<?php if ($trx_booking->tanggal->Visible) { // tanggal ?>
	<tr<?php echo $trx_booking->tanggal->RowAttributes ?>>
		<td class="ewTableHeader">Tanggal</td>
		<td<?php echo $trx_booking->tanggal->CellAttributes() ?>>
<div<?php echo $trx_booking->tanggal->ViewAttributes() ?>><?php echo $trx_booking->tanggal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->title->Visible) { // title ?>
	<tr<?php echo $trx_booking->title->RowAttributes ?>>
		<td class="ewTableHeader">Title</td>
		<td<?php echo $trx_booking->title->CellAttributes() ?>>
<div<?php echo $trx_booking->title->ViewAttributes() ?>><?php echo $trx_booking->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->nama->Visible) { // nama ?>
	<tr<?php echo $trx_booking->nama->RowAttributes ?>>
		<td class="ewTableHeader">Nama</td>
		<td<?php echo $trx_booking->nama->CellAttributes() ?>>
<div<?php echo $trx_booking->nama->ViewAttributes() ?>><?php echo $trx_booking->nama->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->idtype->Visible) { // idtype ?>
	<tr<?php echo $trx_booking->idtype->RowAttributes ?>>
		<td class="ewTableHeader">Tipe Id</td>
		<td<?php echo $trx_booking->idtype->CellAttributes() ?>>
<div<?php echo $trx_booking->idtype->ViewAttributes() ?>><?php echo $trx_booking->idtype->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->idno->Visible) { // idno ?>
	<tr<?php echo $trx_booking->idno->RowAttributes ?>>
		<td class="ewTableHeader">Id No</td>
		<td<?php echo $trx_booking->idno->CellAttributes() ?>>
<div<?php echo $trx_booking->idno->ViewAttributes() ?>><?php echo $trx_booking->idno->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->alamat->Visible) { // alamat ?>
	<tr<?php echo $trx_booking->alamat->RowAttributes ?>>
		<td class="ewTableHeader">Alamat</td>
		<td<?php echo $trx_booking->alamat->CellAttributes() ?>>
<div<?php echo $trx_booking->alamat->ViewAttributes() ?>><?php echo $trx_booking->alamat->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->phone->Visible) { // phone ?>
	<tr<?php echo $trx_booking->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone</td>
		<td<?php echo $trx_booking->phone->CellAttributes() ?>>
<div<?php echo $trx_booking->phone->ViewAttributes() ?>><?php echo $trx_booking->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->zemail->Visible) { // email ?>
	<tr<?php echo $trx_booking->zemail->RowAttributes ?>>
		<td class="ewTableHeader">Email</td>
		<td<?php echo $trx_booking->zemail->CellAttributes() ?>>
<div<?php echo $trx_booking->zemail->ViewAttributes() ?>><?php echo $trx_booking->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->company->Visible) { // company ?>
	<tr<?php echo $trx_booking->company->RowAttributes ?>>
		<td class="ewTableHeader">Company</td>
		<td<?php echo $trx_booking->company->CellAttributes() ?>>
<div<?php echo $trx_booking->company->ViewAttributes() ?>><?php echo $trx_booking->company->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->departement->Visible) { // departement ?>
	<tr<?php echo $trx_booking->departement->RowAttributes ?>>
		<td class="ewTableHeader">Departement</td>
		<td<?php echo $trx_booking->departement->CellAttributes() ?>>
<div<?php echo $trx_booking->departement->ViewAttributes() ?>><?php echo $trx_booking->departement->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->grup->Visible) { // grup ?>
	<tr<?php echo $trx_booking->grup->RowAttributes ?>>
		<td class="ewTableHeader">Group</td>
		<td<?php echo $trx_booking->grup->CellAttributes() ?>>
<div<?php echo $trx_booking->grup->ViewAttributes() ?>><?php echo $trx_booking->grup->ViewValue ?></div></td>
	</tr>
<?php } ?>

<?php
	$sql="SELECT dp,dptype,dp2,dptype2,dp3,dptype3,dp4,dptype4,dp5,dptype5 FROM trx_booking WHERE kode='".$trx_booking->kode->ViewValue."'";
	$hsltemp=mysql_query($sql,$db);
	list($dp,$dptype,$dp2,$dptype2,$dp3,$dptype3,$dp4,$dptype4,$dp5,$dptype5)=mysql_fetch_array($hsltemp);
	$arrdp[1]=$dp;$arrdptype[1]=$dptype;
	$arrdp[2]=$dp2;$arrdptype[2]=$dptype2;
	$arrdp[3]=$dp3;$arrdptype[3]=$dptype3;
	$arrdp[4]=$dp4;$arrdptype[4]=$dptype4;
	$arrdp[5]=$dp5;$arrdptype[5]=$dptype5;
	foreach($arrdp as $xyz => $dp){
		$dptype=$arrdptype[$xyz];
		$sql="SELECT description FROM mst_pay_type WHERE kode='$dptype'";
		$hsltemp=mysql_query($sql,$db);
		list($dptype)=mysql_fetch_array($hsltemp);
	?>
		<?php if ($trx_booking->dp->Visible) { // dp ?>
			<tr<?php echo $trx_booking->dp->RowAttributes ?>>
				<td class="ewTableHeader">Dp <?php echo $xyz; ?></td>
				<td<?php echo $trx_booking->dp->CellAttributes() ?>>
		<div<?php echo $trx_booking->dp->ViewAttributes() ?>><?php echo $dp; ?> [<?php echo $dptype; ?>]</div></td>
			</tr>
		<?php } ?>
	<?php
	}
?>
<!--
<?php if ($trx_booking->dp->Visible) { // dp ?>
	<tr<?php echo $trx_booking->dp->RowAttributes ?>>
		<td class="ewTableHeader">Dp</td>
		<td<?php echo $trx_booking->dp->CellAttributes() ?>>
<div<?php echo $trx_booking->dp->ViewAttributes() ?>><?php echo $trx_booking->dp->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->dptype->Visible) { // dptype ?>
	<tr<?php echo $trx_booking->dptype->RowAttributes ?>>
		<td class="ewTableHeader">Dptype</td>
		<td<?php echo $trx_booking->dptype->CellAttributes() ?>>
<div<?php echo $trx_booking->dptype->ViewAttributes() ?>><?php echo $trx_booking->dptype->ViewValue ?></div></td>
	</tr>
<?php } ?>
-->



<?php if ($trx_booking->room->Visible) { // room ?>
	<tr<?php echo $trx_booking->room->RowAttributes ?>>
		<td class="ewTableHeader">Room</td>
		<td<?php echo $trx_booking->room->CellAttributes() ?>>
<div<?php echo $trx_booking->room->ViewAttributes() ?>><?php echo $trx_booking->room->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->person->Visible) { // person ?>
	<tr<?php echo $trx_booking->person->RowAttributes ?>>
		<td class="ewTableHeader">Person</td>
		<td<?php echo $trx_booking->person->CellAttributes() ?>>
<div<?php echo $trx_booking->person->ViewAttributes() ?>><?php echo $trx_booking->person->ViewValue ?></div></td>
	</tr>
<?php } ?>
	</table>
</td>
<td valign="top">
	<table cellspacing="0" class="ewTable">
<?php if ($trx_booking->arrival->Visible) { // arrival ?>
	<tr<?php echo $trx_booking->arrival->RowAttributes ?>>
		<td class="ewTableHeader">Arrival</td>
		<td<?php echo $trx_booking->arrival->CellAttributes() ?>>
<div<?php echo $trx_booking->arrival->ViewAttributes() ?>><?php echo $trx_booking->arrival->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->departure->Visible) { // departure ?>
	<tr<?php echo $trx_booking->departure->RowAttributes ?>>
		<td class="ewTableHeader">Departure</td>
		<td<?php echo $trx_booking->departure->CellAttributes() ?>>
<div<?php echo $trx_booking->departure->ViewAttributes() ?>><?php echo $trx_booking->departure->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->rate->Visible) { // rate1 ?>
	<tr<?php echo $trx_booking->rate->RowAttributes ?>>
		<td class="ewTableHeader">Rate Week Days</td>
		<td<?php echo $trx_booking->rate->CellAttributes() ?>>
<div<?php echo $trx_booking->rate->ViewAttributes() ?>><?php echo number_format($rate1); ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->rate->Visible) { // rate2 ?>
	<tr<?php echo $trx_booking->rate->RowAttributes ?>>
		<td class="ewTableHeader">Rate Week End</td>
		<td<?php echo $trx_booking->rate->CellAttributes() ?>>
<div<?php echo $trx_booking->rate->ViewAttributes() ?>><?php echo number_format($rate2) ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->extraperson->Visible) { // extraperson ?>
	<tr<?php echo $trx_booking->extraperson->RowAttributes ?>>
		<td class="ewTableHeader">Extraperson</td>
		<td<?php echo $trx_booking->extraperson->CellAttributes() ?>>
<div<?php echo $trx_booking->extraperson->ViewAttributes() ?>><?php echo $trx_booking->extraperson->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->chargeextraperson->Visible) { // chargeextraperson ?>
	<tr<?php echo $trx_booking->chargeextraperson->RowAttributes ?>>
		<td class="ewTableHeader">Chargeextraperson</td>
		<td<?php echo $trx_booking->chargeextraperson->CellAttributes() ?>>
<div<?php echo $trx_booking->chargeextraperson->ViewAttributes() ?>><?php echo $trx_booking->chargeextraperson->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->discname->Visible) { // discname ?>
	<tr<?php echo $trx_booking->discname->RowAttributes ?>>
		<td class="ewTableHeader">Disc Name</td>
		<td<?php echo $trx_booking->discname->CellAttributes() ?>>
<div<?php echo $trx_booking->discname->ViewAttributes() ?>><?php echo $trx_booking->discname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->disc->Visible) { // disc ?>
	<tr<?php echo $trx_booking->disc->RowAttributes ?>>
		<td class="ewTableHeader">Disc (%)</td>
		<td<?php echo $trx_booking->disc->CellAttributes() ?>>
<div<?php echo $trx_booking->disc->ViewAttributes() ?>><?php echo $trx_booking->disc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->notes->Visible) { // notes ?>
	<tr<?php echo $trx_booking->notes->RowAttributes ?>>
		<td class="ewTableHeader">Notes</td>
		<td<?php echo $trx_booking->notes->CellAttributes() ?>>
<div<?php echo $trx_booking->notes->ViewAttributes() ?>><?php echo $trx_booking->notes->ViewValue ?></div></td>
	</tr>
<?php } ?>

<?php if ($trx_booking->createby->Visible) { // createby ?>
	<tr<?php echo $trx_booking->createby->RowAttributes ?>>
		<td class="ewTableHeader">Createby</td>
		<td<?php echo $trx_booking->createby->CellAttributes() ?>>
<div<?php echo $trx_booking->createby->ViewAttributes() ?>><?php echo $trx_booking->createby->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->createdate->Visible) { // createdate ?>
	<tr<?php echo $trx_booking->createdate->RowAttributes ?>>
		<td class="ewTableHeader">Createdate</td>
		<td<?php echo $trx_booking->createdate->CellAttributes() ?>>
<div<?php echo $trx_booking->createdate->ViewAttributes() ?>><?php echo $trx_booking->createdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->confirmby->Visible) { // confirmby ?>
	<tr<?php echo $trx_booking->confirmby->RowAttributes ?>>
		<td class="ewTableHeader">Confirmby</td>
		<td<?php echo $trx_booking->confirmby->CellAttributes() ?>>
<div<?php echo $trx_booking->confirmby->ViewAttributes() ?>><?php echo $trx_booking->confirmby->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trx_booking->confirmdate->Visible) { // confirmdate ?>
	<tr<?php echo $trx_booking->confirmdate->RowAttributes ?>>
		<td class="ewTableHeader">Confirmdate</td>
		<td<?php echo $trx_booking->confirmdate->CellAttributes() ?>>
<div<?php echo $trx_booking->confirmdate->ViewAttributes() ?>><?php echo $trx_booking->confirmdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($trx_booking->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class ctrx_booking_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'trx_booking';

	// Page Object Name
	var $PageObjName = 'trx_booking_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_booking;
		if ($trx_booking->UseTokenInUrl) $PageUrl .= "t=" . $trx_booking->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $trx_booking;
		if ($trx_booking->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_booking->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_booking->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_booking_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_booking"] = new ctrx_booking();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_booking', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_booking;

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $trx_booking;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode"] <> "") {
				$trx_booking->kode->setQueryStringValue($_GET["kode"]);
			} else {
				$sReturnUrl = "trx_bookinglist.php"; // Return to list
			}

			// Get action
			$trx_booking->CurrentAction = "I"; // Display form
			switch ($trx_booking->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "trx_bookinglist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "trx_bookinglist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$trx_booking->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_booking;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_booking->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_booking->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_booking->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_booking->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_booking->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_booking->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_booking;
		$sFilter = $trx_booking->KeyFilter();

		// Call Row Selecting event
		$trx_booking->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_booking->CurrentFilter = $sFilter;
		$sSql = $trx_booking->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_booking->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_booking;
		$trx_booking->kode->setDbValue($rs->fields('kode'));
		$trx_booking->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_booking->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_booking->title->setDbValue($rs->fields('title'));
		$trx_booking->nama->setDbValue($rs->fields('nama'));
		$trx_booking->idtype->setDbValue($rs->fields('idtype'));
		$trx_booking->idno->setDbValue($rs->fields('idno'));
		$trx_booking->alamat->setDbValue($rs->fields('alamat'));
		$trx_booking->phone->setDbValue($rs->fields('phone'));
		$trx_booking->zemail->setDbValue($rs->fields('email'));
		$trx_booking->company->setDbValue($rs->fields('company'));
		$trx_booking->departement->setDbValue($rs->fields('departement'));
		$trx_booking->grup->setDbValue($rs->fields('grup'));
		$trx_booking->dp->setDbValue($rs->fields('dp'));
		$trx_booking->dptype->setDbValue($rs->fields('dptype'));
		$trx_booking->room->setDbValue($rs->fields('room'));
		$trx_booking->person->setDbValue($rs->fields('person'));
		$trx_booking->arrival->setDbValue($rs->fields('arrival'));
		$trx_booking->departure->setDbValue($rs->fields('departure'));
		$trx_booking->rate->setDbValue($rs->fields('rate'));
		$trx_booking->extraperson->setDbValue($rs->fields('extraperson'));
		$trx_booking->chargeextraperson->setDbValue($rs->fields('chargeextraperson'));
		$trx_booking->discname->setDbValue($rs->fields('discname'));
		$trx_booking->disc->setDbValue($rs->fields('disc'));
		$trx_booking->notes->setDbValue($rs->fields('notes'));
		$trx_booking->confirmasi->setDbValue($rs->fields('confirmasi'));
		$trx_booking->checkin->setDbValue($rs->fields('checkin'));
		$trx_booking->createby->setDbValue($rs->fields('createby'));
		$trx_booking->createdate->setDbValue($rs->fields('createdate'));
		$trx_booking->confirmby->setDbValue($rs->fields('confirmby'));
		$trx_booking->confirmdate->setDbValue($rs->fields('confirmdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_booking;

		// Call Row_Rendering event
		$trx_booking->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_booking->kode->CellCssStyle = "";
		$trx_booking->kode->CellCssClass = "";

		// idseqno
		$trx_booking->idseqno->CellCssStyle = "";
		$trx_booking->idseqno->CellCssClass = "";

		// tanggal
		$trx_booking->tanggal->CellCssStyle = "";
		$trx_booking->tanggal->CellCssClass = "";

		// title
		$trx_booking->title->CellCssStyle = "";
		$trx_booking->title->CellCssClass = "";

		// nama
		$trx_booking->nama->CellCssStyle = "";
		$trx_booking->nama->CellCssClass = "";

		// idtype
		$trx_booking->idtype->CellCssStyle = "";
		$trx_booking->idtype->CellCssClass = "";

		// idno
		$trx_booking->idno->CellCssStyle = "";
		$trx_booking->idno->CellCssClass = "";

		// alamat
		$trx_booking->alamat->CellCssStyle = "";
		$trx_booking->alamat->CellCssClass = "";

		// phone
		$trx_booking->phone->CellCssStyle = "";
		$trx_booking->phone->CellCssClass = "";

		// email
		$trx_booking->zemail->CellCssStyle = "";
		$trx_booking->zemail->CellCssClass = "";

		// company
		$trx_booking->company->CellCssStyle = "";
		$trx_booking->company->CellCssClass = "";

		// departement
		$trx_booking->departement->CellCssStyle = "";
		$trx_booking->departement->CellCssClass = "";

		// grup
		$trx_booking->grup->CellCssStyle = "";
		$trx_booking->grup->CellCssClass = "";

		// dp
		$trx_booking->dp->CellCssStyle = "";
		$trx_booking->dp->CellCssClass = "";

		// dptype
		$trx_booking->dptype->CellCssStyle = "";
		$trx_booking->dptype->CellCssClass = "";

		// room
		$trx_booking->room->CellCssStyle = "";
		$trx_booking->room->CellCssClass = "";

		// person
		$trx_booking->person->CellCssStyle = "";
		$trx_booking->person->CellCssClass = "";

		// arrival
		$trx_booking->arrival->CellCssStyle = "";
		$trx_booking->arrival->CellCssClass = "";

		// departure
		$trx_booking->departure->CellCssStyle = "";
		$trx_booking->departure->CellCssClass = "";

		// rate
		$trx_booking->rate->CellCssStyle = "";
		$trx_booking->rate->CellCssClass = "";

		// extraperson
		$trx_booking->extraperson->CellCssStyle = "";
		$trx_booking->extraperson->CellCssClass = "";

		// chargeextraperson
		$trx_booking->chargeextraperson->CellCssStyle = "";
		$trx_booking->chargeextraperson->CellCssClass = "";

		// discname
		$trx_booking->discname->CellCssStyle = "";
		$trx_booking->discname->CellCssClass = "";

		// disc
		$trx_booking->disc->CellCssStyle = "";
		$trx_booking->disc->CellCssClass = "";

		// notes
		$trx_booking->notes->CellCssStyle = "";
		$trx_booking->notes->CellCssClass = "";

		// confirmasi
		$trx_booking->confirmasi->CellCssStyle = "";
		$trx_booking->confirmasi->CellCssClass = "";

		// checkin
		$trx_booking->checkin->CellCssStyle = "";
		$trx_booking->checkin->CellCssClass = "";

		// createby
		$trx_booking->createby->CellCssStyle = "";
		$trx_booking->createby->CellCssClass = "";

		// createdate
		$trx_booking->createdate->CellCssStyle = "";
		$trx_booking->createdate->CellCssClass = "";

		// confirmby
		$trx_booking->confirmby->CellCssStyle = "";
		$trx_booking->confirmby->CellCssClass = "";

		// confirmdate
		$trx_booking->confirmdate->CellCssStyle = "";
		$trx_booking->confirmdate->CellCssClass = "";
		if ($trx_booking->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_booking->kode->ViewValue = $trx_booking->kode->CurrentValue;
			$trx_booking->kode->CssStyle = "";
			$trx_booking->kode->CssClass = "";
			$trx_booking->kode->ViewCustomAttributes = "";

			// idseqno
			$trx_booking->idseqno->ViewValue = $trx_booking->idseqno->CurrentValue;
			$trx_booking->idseqno->CssStyle = "";
			$trx_booking->idseqno->CssClass = "";
			$trx_booking->idseqno->ViewCustomAttributes = "";

			// tanggal
			$trx_booking->tanggal->ViewValue = $trx_booking->tanggal->CurrentValue;
			$trx_booking->tanggal->ViewValue = ew_FormatDateTime($trx_booking->tanggal->ViewValue, 7);
			$trx_booking->tanggal->CssStyle = "";
			$trx_booking->tanggal->CssClass = "";
			$trx_booking->tanggal->ViewCustomAttributes = "";

			// title
			if (strval($trx_booking->title->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_name_title` WHERE `kode` = '" . ew_AdjustSql($trx_booking->title->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_booking->title->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_booking->title->ViewValue = $trx_booking->title->CurrentValue;
				}
			} else {
				$trx_booking->title->ViewValue = NULL;
			}
			$trx_booking->title->CssStyle = "";
			$trx_booking->title->CssClass = "";
			$trx_booking->title->ViewCustomAttributes = "";

			// nama
			$trx_booking->nama->ViewValue = $trx_booking->nama->CurrentValue;
			$trx_booking->nama->CssStyle = "";
			$trx_booking->nama->CssClass = "";
			$trx_booking->nama->ViewCustomAttributes = "";

			// idtype
			if (strval($trx_booking->idtype->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_id_type` WHERE `kode` = '" . ew_AdjustSql($trx_booking->idtype->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_booking->idtype->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_booking->idtype->ViewValue = $trx_booking->idtype->CurrentValue;
				}
			} else {
				$trx_booking->idtype->ViewValue = NULL;
			}
			$trx_booking->idtype->CssStyle = "";
			$trx_booking->idtype->CssClass = "";
			$trx_booking->idtype->ViewCustomAttributes = "";

			// idno
			$trx_booking->idno->ViewValue = $trx_booking->idno->CurrentValue;
			$trx_booking->idno->CssStyle = "";
			$trx_booking->idno->CssClass = "";
			$trx_booking->idno->ViewCustomAttributes = "";

			// alamat
			$trx_booking->alamat->ViewValue = $trx_booking->alamat->CurrentValue;
			$trx_booking->alamat->CssStyle = "";
			$trx_booking->alamat->CssClass = "";
			$trx_booking->alamat->ViewCustomAttributes = "";

			// phone
			$trx_booking->phone->ViewValue = $trx_booking->phone->CurrentValue;
			$trx_booking->phone->CssStyle = "";
			$trx_booking->phone->CssClass = "";
			$trx_booking->phone->ViewCustomAttributes = "";

			// email
			$trx_booking->zemail->ViewValue = $trx_booking->zemail->CurrentValue;
			$trx_booking->zemail->CssStyle = "";
			$trx_booking->zemail->CssClass = "";
			$trx_booking->zemail->ViewCustomAttributes = "";

			// company
			$trx_booking->company->ViewValue = $trx_booking->company->CurrentValue;
			$trx_booking->company->CssStyle = "";
			$trx_booking->company->CssClass = "";
			$trx_booking->company->ViewCustomAttributes = "";

			// departement
			$trx_booking->departement->ViewValue = $trx_booking->departement->CurrentValue;
			$trx_booking->departement->CssStyle = "";
			$trx_booking->departement->CssClass = "";
			$trx_booking->departement->ViewCustomAttributes = "";

			// grup
			$trx_booking->grup->ViewValue = $trx_booking->grup->CurrentValue;
			$trx_booking->grup->CssStyle = "";
			$trx_booking->grup->CssClass = "";
			$trx_booking->grup->ViewCustomAttributes = "";

			// dp
			$trx_booking->dp->ViewValue = $trx_booking->dp->CurrentValue;
			$trx_booking->dp->CssStyle = "";
			$trx_booking->dp->CssClass = "";
			$trx_booking->dp->ViewCustomAttributes = "";

			// dptype
			$trx_booking->dptype->ViewValue = $trx_booking->dptype->CurrentValue;
			$trx_booking->dptype->CssStyle = "";
			$trx_booking->dptype->CssClass = "";
			$trx_booking->dptype->ViewCustomAttributes = "";

			// room
			if (strval($trx_booking->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($trx_booking->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_booking->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_booking->room->ViewValue = $trx_booking->room->CurrentValue;
				}
			} else {
				$trx_booking->room->ViewValue = NULL;
			}
			$trx_booking->room->CssStyle = "";
			$trx_booking->room->CssClass = "";
			$trx_booking->room->ViewCustomAttributes = "";

			// person
			$trx_booking->person->ViewValue = $trx_booking->person->CurrentValue;
			$trx_booking->person->CssStyle = "text-align:right;";
			$trx_booking->person->CssClass = "";
			$trx_booking->person->ViewCustomAttributes = "";

			// arrival
			$trx_booking->arrival->ViewValue = $trx_booking->arrival->CurrentValue;
			$trx_booking->arrival->ViewValue = ew_FormatDateTime($trx_booking->arrival->ViewValue, 7);
			$trx_booking->arrival->CssStyle = "";
			$trx_booking->arrival->CssClass = "";
			$trx_booking->arrival->ViewCustomAttributes = "";

			// departure
			$trx_booking->departure->ViewValue = $trx_booking->departure->CurrentValue;
			$trx_booking->departure->ViewValue = ew_FormatDateTime($trx_booking->departure->ViewValue, 7);
			$trx_booking->departure->CssStyle = "";
			$trx_booking->departure->CssClass = "";
			$trx_booking->departure->ViewCustomAttributes = "";

			// rate
			$trx_booking->rate->ViewValue = $trx_booking->rate->CurrentValue;
			$trx_booking->rate->ViewValue = ew_FormatNumber($trx_booking->rate->ViewValue, 0, -2, -2, -2);
			$trx_booking->rate->CssStyle = "text-align:right;";
			$trx_booking->rate->CssClass = "";
			$trx_booking->rate->ViewCustomAttributes = "";

			// extraperson
			$trx_booking->extraperson->ViewValue = $trx_booking->extraperson->CurrentValue;
			$trx_booking->extraperson->CssStyle = "text-align:right;";
			$trx_booking->extraperson->CssClass = "";
			$trx_booking->extraperson->ViewCustomAttributes = "";

			// chargeextraperson
			$trx_booking->chargeextraperson->ViewValue = $trx_booking->chargeextraperson->CurrentValue;
			$trx_booking->chargeextraperson->ViewValue = ew_FormatNumber($trx_booking->chargeextraperson->ViewValue, 0, -2, -2, -2);
			$trx_booking->chargeextraperson->CssStyle = "text-align:right;";
			$trx_booking->chargeextraperson->CssClass = "";
			$trx_booking->chargeextraperson->ViewCustomAttributes = "";

			// discname
			$trx_booking->discname->ViewValue = $trx_booking->discname->CurrentValue;
			$trx_booking->discname->CssStyle = "";
			$trx_booking->discname->CssClass = "";
			$trx_booking->discname->ViewCustomAttributes = "";

			// disc
			$trx_booking->disc->ViewValue = $trx_booking->disc->CurrentValue;
			$trx_booking->disc->CssStyle = "";
			$trx_booking->disc->CssClass = "";
			$trx_booking->disc->ViewCustomAttributes = "";

			// notes
			$trx_booking->notes->ViewValue = $trx_booking->notes->CurrentValue;
			$trx_booking->notes->CssStyle = "";
			$trx_booking->notes->CssClass = "";
			$trx_booking->notes->ViewCustomAttributes = "";

			// confirmasi
			if (strval($trx_booking->confirmasi->CurrentValue) <> "") {
				switch ($trx_booking->confirmasi->CurrentValue) {
					case "0":
						$trx_booking->confirmasi->ViewValue = "Belum";
						break;
					case "1":
						$trx_booking->confirmasi->ViewValue = "Ya";
						break;
					case "2":
						$trx_booking->confirmasi->ViewValue = "Batal";
						break;
					default:
						$trx_booking->confirmasi->ViewValue = $trx_booking->confirmasi->CurrentValue;
				}
			} else {
				$trx_booking->confirmasi->ViewValue = NULL;
			}
			$trx_booking->confirmasi->CssStyle = "";
			$trx_booking->confirmasi->CssClass = "";
			$trx_booking->confirmasi->ViewCustomAttributes = "";

			// checkin
			if (strval($trx_booking->checkin->CurrentValue) <> "") {
				switch ($trx_booking->checkin->CurrentValue) {
					case "0":
						$trx_booking->checkin->ViewValue = "No";
						break;
					case "1":
						$trx_booking->checkin->ViewValue = "Yes";
						break;
					default:
						$trx_booking->checkin->ViewValue = $trx_booking->checkin->CurrentValue;
				}
			} else {
				$trx_booking->checkin->ViewValue = NULL;
			}
			$trx_booking->checkin->CssStyle = "";
			$trx_booking->checkin->CssClass = "";
			$trx_booking->checkin->ViewCustomAttributes = "";

			// createby
			$trx_booking->createby->ViewValue = $trx_booking->createby->CurrentValue;
			$trx_booking->createby->CssStyle = "";
			$trx_booking->createby->CssClass = "";
			$trx_booking->createby->ViewCustomAttributes = "";

			// createdate
			$trx_booking->createdate->ViewValue = $trx_booking->createdate->CurrentValue;
			$trx_booking->createdate->ViewValue = ew_FormatDateTime($trx_booking->createdate->ViewValue, 7);
			$trx_booking->createdate->CssStyle = "";
			$trx_booking->createdate->CssClass = "";
			$trx_booking->createdate->ViewCustomAttributes = "";

			// confirmby
			$trx_booking->confirmby->ViewValue = $trx_booking->confirmby->CurrentValue;
			$trx_booking->confirmby->CssStyle = "";
			$trx_booking->confirmby->CssClass = "";
			$trx_booking->confirmby->ViewCustomAttributes = "";

			// confirmdate
			$trx_booking->confirmdate->ViewValue = $trx_booking->confirmdate->CurrentValue;
			$trx_booking->confirmdate->ViewValue = ew_FormatDateTime($trx_booking->confirmdate->ViewValue, 7);
			$trx_booking->confirmdate->CssStyle = "";
			$trx_booking->confirmdate->CssClass = "";
			$trx_booking->confirmdate->ViewCustomAttributes = "";

			// kode
			$trx_booking->kode->HrefValue = "";

			// idseqno
			$trx_booking->idseqno->HrefValue = "";

			// tanggal
			$trx_booking->tanggal->HrefValue = "";

			// title
			$trx_booking->title->HrefValue = "";

			// nama
			$trx_booking->nama->HrefValue = "";

			// idtype
			$trx_booking->idtype->HrefValue = "";

			// idno
			$trx_booking->idno->HrefValue = "";

			// alamat
			$trx_booking->alamat->HrefValue = "";

			// phone
			$trx_booking->phone->HrefValue = "";

			// email
			$trx_booking->zemail->HrefValue = "";

			// company
			$trx_booking->company->HrefValue = "";

			// departement
			$trx_booking->departement->HrefValue = "";

			// grup
			$trx_booking->grup->HrefValue = "";

			// dp
			$trx_booking->dp->HrefValue = "";

			// dptype
			$trx_booking->dptype->HrefValue = "";

			// room
			$trx_booking->room->HrefValue = "";

			// person
			$trx_booking->person->HrefValue = "";

			// arrival
			$trx_booking->arrival->HrefValue = "";

			// departure
			$trx_booking->departure->HrefValue = "";

			// rate
			$trx_booking->rate->HrefValue = "";

			// extraperson
			$trx_booking->extraperson->HrefValue = "";

			// chargeextraperson
			$trx_booking->chargeextraperson->HrefValue = "";

			// discname
			$trx_booking->discname->HrefValue = "";

			// disc
			$trx_booking->disc->HrefValue = "";

			// notes
			$trx_booking->notes->HrefValue = "";

			// confirmasi
			$trx_booking->confirmasi->HrefValue = "";

			// checkin
			$trx_booking->checkin->HrefValue = "";

			// createby
			$trx_booking->createby->HrefValue = "";

			// createdate
			$trx_booking->createdate->HrefValue = "";

			// confirmby
			$trx_booking->confirmby->HrefValue = "";

			// confirmdate
			$trx_booking->confirmdate->HrefValue = "";
		}

		// Call Row Rendered event
		$trx_booking->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
