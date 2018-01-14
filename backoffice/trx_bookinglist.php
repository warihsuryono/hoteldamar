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
$trx_booking_list = new ctrx_booking_list();
$Page =& $trx_booking_list;

// Page init processing
$trx_booking_list->Page_Init();

// Page main processing
$trx_booking_list->Page_Main();
?>
<?php include "header.php" ?>
<?php
    if($_GET["deleting"] == 1){
        $arrival = substr($_GET["arrival"],6,4)."-".substr($_GET["arrival"],3,2)."-".substr($_GET["arrival"],0,2);
        $departure = substr($_GET["departure"],6,4)."-".substr($_GET["departure"],3,2)."-".substr($_GET["departure"],0,2);
        $sql = "DELETE FROM trx_booking WHERE kode = '".$_GET["kode"]."' AND nama = '".$_GET["nama"]."' AND arrival='".$arrival."' AND departure = '".$departure."'";
        mysql_query($sql,$db);
    }
?>
<?php if ($trx_booking->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_booking_list = new ew_Page("trx_booking_list");

// page properties
trx_booking_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_booking_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_booking_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_arrival"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Arrival");
	elm = fobj.elements["x" + infix + "_departure"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Departure");
	elm = fobj.elements["x" + infix + "_disc"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Disc (%)");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
trx_booking_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_booking_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_booking_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($trx_booking->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_booking->Export == "" && $trx_booking->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_booking_list->LoadRecordset();
	$trx_booking_list->lTotalRecs = ($bSelectLimit) ? $trx_booking->SelectRecordCount() : $rs->RecordCount();
	$trx_booking_list->lStartRec = 1;
	if ($trx_booking_list->lDisplayRecs <= 0) // Display all records
		$trx_booking_list->lDisplayRecs = $trx_booking_list->lTotalRecs;
	if (!($trx_booking->ExportAll && $trx_booking->Export <> ""))
		$trx_booking_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_booking_list->LoadRecordset($trx_booking_list->lStartRec-1, $trx_booking_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Reservation</b></h3>
<?php if ($trx_booking->Export == "" && $trx_booking->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_booking_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $trx_booking_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_booking->Export == "" && $trx_booking->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_booking_list);" style="text-decoration: none;"><img id="trx_booking_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_booking_list_SearchPanel">
<form name="ftrx_bookinglistsrch" id="ftrx_bookinglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_booking_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_booking">
<?php
if ($gsSearchError == "")
	$trx_booking_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_booking->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_booking_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="20" maxlength="20" value="<?php echo $trx_booking->kode->EditValue ?>"<?php echo $trx_booking->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Group</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_grup" id="z_grup" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_grup" id="x_grup" size="30" maxlength="100" value="<?php echo $trx_booking->grup->EditValue ?>"<?php echo $trx_booking->grup->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Tanggal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal" id="z_tanggal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_booking->tanggal->EditValue ?>"<?php echo $trx_booking->tanggal->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Title</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_title" id="z_title" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_title" name="x_title"<?php echo $trx_booking->title->EditAttributes() ?>>
<?php
if (is_array($trx_booking->title->EditValue)) {
	$arwrk = $trx_booking->title->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_booking->title->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Nama</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_nama" id="z_nama" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $trx_booking->nama->EditValue ?>"<?php echo $trx_booking->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Company</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_company" id="z_company" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_company" id="x_company" size="30" maxlength="100" value="<?php echo $trx_booking->company->EditValue ?>"<?php echo $trx_booking->company->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Room</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_room" id="z_room" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_room" name="x_room"<?php echo $trx_booking->room->EditAttributes() ?>>
<?php
if (is_array($trx_booking->room->EditValue)) {
	$arwrk = $trx_booking->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_booking->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Arrival</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_arrival" id="z_arrival" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_arrival" id="x_arrival" value="<?php echo $trx_booking->arrival->EditValue ?>"<?php echo $trx_booking->arrival->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_arrival" name="cal_x_arrival" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_arrival", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_arrival" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Departure</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_departure" id="z_departure" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_departure" id="x_departure" value="<?php echo $trx_booking->departure->EditValue ?>"<?php echo $trx_booking->departure->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_departure" name="cal_x_departure" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_departure", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_departure" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Discname</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_discname" id="z_discname" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_discname" name="x_discname"<?php echo $trx_booking->discname->EditAttributes() ?>>
<?php
if (is_array($trx_booking->discname->EditValue)) {
	$arwrk = $trx_booking->discname->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_booking->discname->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Disc (%)</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_disc" id="z_disc" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_disc" id="x_disc" size="3" value="<?php echo $trx_booking->disc->EditValue ?>"<?php echo $trx_booking->disc->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Confirmasi</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_confirmasi" id="z_confirmasi" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_confirmasi" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_confirmasi" id="x_confirmasi" value="{value}"<?php echo $trx_booking->confirmasi->EditAttributes() ?>></div>
<div id="dsl_x_confirmasi" repeatcolumn="5">
<?php
$arwrk = $trx_booking->confirmasi->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_booking->confirmasi->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_confirmasi" id="x_confirmasi" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $trx_booking->confirmasi->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Check In</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_checkin" id="z_checkin" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_checkin" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_checkin" id="x_checkin" value="{value}"<?php echo $trx_booking->checkin->EditAttributes() ?>></div>
<div id="dsl_x_checkin" repeatcolumn="5">
<?php
$arwrk = $trx_booking->checkin->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_booking->checkin->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_checkin" id="x_checkin" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $trx_booking->checkin->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $trx_booking_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $trx_booking_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_booking_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_booking->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_booking->CurrentAction <> "gridadd" && $trx_booking->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_booking_list->Pager)) $trx_booking_list->Pager = new cPrevNextPager($trx_booking_list->lStartRec, $trx_booking_list->lDisplayRecs, $trx_booking_list->lTotalRecs) ?>
<?php if ($trx_booking_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_booking_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_booking_list->PageUrl() ?>start=<?php echo $trx_booking_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_booking_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_booking_list->PageUrl() ?>start=<?php echo $trx_booking_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_booking_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_booking_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_booking_list->PageUrl() ?>start=<?php echo $trx_booking_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_booking_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_booking_list->PageUrl() ?>start=<?php echo $trx_booking_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_booking_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_booking_list->Pager->FromIndex ?> to <?php echo $trx_booking_list->Pager->ToIndex ?> of <?php echo $trx_booking_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_booking_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_booking_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_booking">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_booking_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_booking_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_booking_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_booking_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_booking_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_booking_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<input type="button" name="AddBook" value="Reservation" onclick="window.location='trx_bookingadd.php';">
<!--input type="button" name="AddGroup" value="Group Reservation" onclick="window.location='trx_bookingaddgroup.php';"-->
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_bookinglist" id="ftrx_bookinglist" class="ewForm" action="" method="post">
<?php if ($trx_booking_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_booking_list->lOptionCnt = 0;
	$trx_booking_list->lOptionCnt++; // view
	$trx_booking_list->lOptionCnt++; // edit
	$trx_booking_list->lOptionCnt += count($trx_booking_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_booking->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_booking->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_booking_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_booking->kode->Visible) { // kode ?>
	<?php if ($trx_booking->SortUrl($trx_booking->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_booking->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->grup->Visible) { // grup ?>
	<?php if ($trx_booking->SortUrl($trx_booking->grup) == "") { ?>
		<td style="white-space: nowrap;">Group</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->grup) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Group</td><td style="width: 10px;"><?php if ($trx_booking->grup->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->grup->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_booking->SortUrl($trx_booking->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_booking->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->title->Visible) { // title ?>
	<?php if ($trx_booking->SortUrl($trx_booking->title) == "") { ?>
		<td style="white-space: nowrap;">Title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->title) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Title</td><td style="width: 10px;"><?php if ($trx_booking->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->nama->Visible) { // nama ?>
	<?php if ($trx_booking->SortUrl($trx_booking->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($trx_booking->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->company->Visible) { // company ?>
	<?php if ($trx_booking->SortUrl($trx_booking->company) == "") { ?>
		<td style="white-space: nowrap;">Company</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->company) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Company</td><td style="width: 10px;"><?php if ($trx_booking->company->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->company->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->room->Visible) { // room ?>
	<?php if ($trx_booking->SortUrl($trx_booking->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($trx_booking->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->person->Visible) { // person ?>
	<?php if ($trx_booking->SortUrl($trx_booking->person) == "") { ?>
		<td style="white-space: nowrap;">Person</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->person) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Person</td><td style="width: 10px;"><?php if ($trx_booking->person->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->person->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->arrival->Visible) { // arrival ?>
	<?php if ($trx_booking->SortUrl($trx_booking->arrival) == "") { ?>
		<td style="white-space: nowrap;">Arrival</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->arrival) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Arrival</td><td style="width: 10px;"><?php if ($trx_booking->arrival->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->arrival->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->departure->Visible) { // departure ?>
	<?php if ($trx_booking->SortUrl($trx_booking->departure) == "") { ?>
		<td style="white-space: nowrap;">Departure</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->departure) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Departure</td><td style="width: 10px;"><?php if ($trx_booking->departure->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->departure->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->discname->Visible) { // discname ?>
	<?php if ($trx_booking->SortUrl($trx_booking->discname) == "") { ?>
		<td style="white-space: nowrap;">Discname</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->discname) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Discname</td><td style="width: 10px;"><?php if ($trx_booking->discname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->discname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->disc->Visible) { // disc ?>
	<?php if ($trx_booking->SortUrl($trx_booking->disc) == "") { ?>
		<td style="white-space: nowrap;">Disc (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->disc) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Disc (%)</td><td style="width: 10px;"><?php if ($trx_booking->disc->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->disc->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->confirmasi->Visible) { // confirmasi ?>
	<?php if ($trx_booking->SortUrl($trx_booking->confirmasi) == "") { ?>
		<td style="white-space: nowrap;">Confirmasi</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->confirmasi) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Confirmasi</td><td style="width: 10px;"><?php if ($trx_booking->confirmasi->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->confirmasi->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_booking->checkin->Visible) { // checkin ?>
	<?php if ($trx_booking->SortUrl($trx_booking->checkin) == "") { ?>
		<td style="white-space: nowrap;">Check In</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_booking->SortUrl($trx_booking->checkin) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Check In</td><td style="width: 10px;"><?php if ($trx_booking->checkin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_booking->checkin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_booking->ExportAll && $trx_booking->Export <> "") {
	$trx_booking_list->lStopRec = $trx_booking_list->lTotalRecs;
} else {
	$trx_booking_list->lStopRec = $trx_booking_list->lStartRec + $trx_booking_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_booking_list->lRecCount = $trx_booking_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_booking->SelectLimit && $trx_booking_list->lStartRec > 1)
		$rs->Move($trx_booking_list->lStartRec - 1);
}
$trx_booking_list->lRowCnt = 0;
while (($trx_booking->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_booking_list->lRecCount < $trx_booking_list->lStopRec) {
	$trx_booking_list->lRecCount++;
	if (intval($trx_booking_list->lRecCount) >= intval($trx_booking_list->lStartRec)) {
		$trx_booking_list->lRowCnt++;

	// Init row class and style
	$trx_booking->CssClass = "";
	$trx_booking->CssStyle = "";
	$trx_booking->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_booking->CurrentAction == "gridadd") {
		$trx_booking_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_booking_list->LoadRowValues($rs); // Load row values
	}
	$trx_booking->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_booking_list->RenderRow();
?>
	<tr<?php echo $trx_booking->RowAttributes() ?>>
<?php if ($trx_booking->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php if($trx_booking->grup->ListViewValue()!="0"){ ?>
<a href="trx_bookingview.php?kode=<?php echo $trx_booking->grup->ListViewValue() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
<?php }else{ ?>
<a href="<?php echo $trx_booking->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
<?php } ?>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php if($trx_booking->grup->ListViewValue()!="0"){ ?>
<a href="trx_bookingadd.php?kode=<?php echo $trx_booking->grup->ListViewValue() ?>&editing=1"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0"></a>
<?php }else{ ?>
<a href="trx_bookingadd.php?kode=<?php echo $trx_booking->kode->ListViewValue() ?>&editing=1"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0"></a>
<?php } ?>
<?php if($__username == "superuser"){ ?>
<a href="trx_bookinglist.php?kode=<?php echo $trx_booking->kode->ListViewValue() ?>&deleting=1&nama=<?php echo $trx_booking->nama->ListViewValue() ?>&arrival=<?php echo $trx_booking->arrival->ListViewValue() ?>&departure=<?php echo $trx_booking->departure->ListViewValue() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
<?php } ?>
</span></td>
<?php

// Custom list options
foreach ($trx_booking_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_booking->kode->Visible) { // kode ?>
		<td<?php echo $trx_booking->kode->CellAttributes() ?>>
<div<?php echo $trx_booking->kode->ViewAttributes() ?>><?php echo $trx_booking->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->grup->Visible) { // grup ?>
		<td<?php echo $trx_booking->grup->CellAttributes() ?>>
<div<?php echo $trx_booking->grup->ViewAttributes() ?>><?php echo $trx_booking->grup->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_booking->tanggal->CellAttributes() ?>>
<div<?php echo $trx_booking->tanggal->ViewAttributes() ?>><?php echo $trx_booking->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->title->Visible) { // title ?>
		<td<?php echo $trx_booking->title->CellAttributes() ?>>
<div<?php echo $trx_booking->title->ViewAttributes() ?>><?php echo $trx_booking->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->nama->Visible) { // nama ?>
		<td<?php echo $trx_booking->nama->CellAttributes() ?>>
<div<?php echo $trx_booking->nama->ViewAttributes() ?>><?php echo $trx_booking->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->company->Visible) { // company ?>
		<td<?php echo $trx_booking->company->CellAttributes() ?>>
<div<?php echo $trx_booking->company->ViewAttributes() ?>><?php echo $trx_booking->company->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->room->Visible) { // room ?>
		<td<?php echo $trx_booking->room->CellAttributes() ?>>
<div<?php echo $trx_booking->room->ViewAttributes() ?>><?php echo $trx_booking->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->person->Visible) { // person ?>
		<td<?php echo $trx_booking->person->CellAttributes() ?>>
<div<?php echo $trx_booking->person->ViewAttributes() ?>><?php echo $trx_booking->person->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->arrival->Visible) { // arrival ?>
		<td<?php echo $trx_booking->arrival->CellAttributes() ?>>
<div<?php echo $trx_booking->arrival->ViewAttributes() ?>><?php echo $trx_booking->arrival->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->departure->Visible) { // departure ?>
		<td<?php echo $trx_booking->departure->CellAttributes() ?>>
<div<?php echo $trx_booking->departure->ViewAttributes() ?>><?php echo $trx_booking->departure->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->discname->Visible) { // discname ?>
		<td<?php echo $trx_booking->discname->CellAttributes() ?>>
<div<?php echo $trx_booking->discname->ViewAttributes() ?>><?php echo $trx_booking->discname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->disc->Visible) { // disc ?>
		<td<?php echo $trx_booking->disc->CellAttributes() ?>>
<div<?php echo $trx_booking->disc->ViewAttributes() ?>><?php echo $trx_booking->disc->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->confirmasi->Visible) { // confirmasi ?>
		<td<?php echo $trx_booking->confirmasi->CellAttributes() ?>>
<div<?php echo $trx_booking->confirmasi->ViewAttributes() ?>><?php echo $trx_booking->confirmasi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_booking->checkin->Visible) { // checkin ?>
		<td<?php echo $trx_booking->checkin->CellAttributes() ?>>
<div<?php echo $trx_booking->checkin->ViewAttributes() ?>><?php echo $trx_booking->checkin->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_booking->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($trx_booking->Export == "" && $trx_booking->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_booking_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
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
$trx_booking_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_booking_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_booking';

	// Page Object Name
	var $PageObjName = 'trx_booking_list';

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
	function ctrx_booking_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_booking"] = new ctrx_booking();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_booking', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_booking;
	$trx_booking->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_booking->Export; // Get export parameter, used in header
	$gsExportFile = $trx_booking->TableVar; // Get export file, used in header
	if ($trx_booking->Export == "print" || $trx_booking->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($trx_booking->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}

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
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $trx_booking;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($trx_booking->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_booking->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$trx_booking->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_booking->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_booking->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$trx_booking->setSessionWhere($sFilter);
		$trx_booking->CurrentFilter = "";

		// Export data only
		if (in_array($trx_booking->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_booking;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$trx_booking->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_booking->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_booking;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_booking->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_booking->grup, FALSE); // Field grup
		$this->BuildSearchSql($sWhere, $trx_booking->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $trx_booking->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_booking->title, FALSE); // Field title
		$this->BuildSearchSql($sWhere, $trx_booking->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $trx_booking->idtype, FALSE); // Field idtype
		$this->BuildSearchSql($sWhere, $trx_booking->idno, FALSE); // Field idno
		$this->BuildSearchSql($sWhere, $trx_booking->alamat, FALSE); // Field alamat
		$this->BuildSearchSql($sWhere, $trx_booking->phone, FALSE); // Field phone
		$this->BuildSearchSql($sWhere, $trx_booking->zemail, FALSE); // Field email
		$this->BuildSearchSql($sWhere, $trx_booking->company, FALSE); // Field company
		$this->BuildSearchSql($sWhere, $trx_booking->departement, FALSE); // Field departement
		$this->BuildSearchSql($sWhere, $trx_booking->dp, FALSE); // Field dp
		$this->BuildSearchSql($sWhere, $trx_booking->dptype, FALSE); // Field dptype
		$this->BuildSearchSql($sWhere, $trx_booking->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $trx_booking->person, FALSE); // Field person
		$this->BuildSearchSql($sWhere, $trx_booking->arrival, FALSE); // Field arrival
		$this->BuildSearchSql($sWhere, $trx_booking->departure, FALSE); // Field departure
		$this->BuildSearchSql($sWhere, $trx_booking->rate, FALSE); // Field rate
		$this->BuildSearchSql($sWhere, $trx_booking->extraperson, FALSE); // Field extraperson
		$this->BuildSearchSql($sWhere, $trx_booking->chargeextraperson, FALSE); // Field chargeextraperson
		$this->BuildSearchSql($sWhere, $trx_booking->discname, FALSE); // Field discname
		$this->BuildSearchSql($sWhere, $trx_booking->disc, FALSE); // Field disc
		$this->BuildSearchSql($sWhere, $trx_booking->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $trx_booking->confirmasi, FALSE); // Field confirmasi
		$this->BuildSearchSql($sWhere, $trx_booking->checkin, FALSE); // Field checkin
		$this->BuildSearchSql($sWhere, $trx_booking->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $trx_booking->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $trx_booking->confirmby, FALSE); // Field confirmby
		$this->BuildSearchSql($sWhere, $trx_booking->confirmdate, FALSE); // Field confirmdate
		$this->BuildSearchSql($sWhere, $trx_booking->checkinby, FALSE); // Field checkinby
		$this->BuildSearchSql($sWhere, $trx_booking->checkindate, FALSE); // Field checkindate
		$this->BuildSearchSql($sWhere, $trx_booking->rate1, FALSE); // Field rate1
		$this->BuildSearchSql($sWhere, $trx_booking->rate2, FALSE); // Field rate2

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_booking->kode); // Field kode
			$this->SetSearchParm($trx_booking->grup); // Field grup
			$this->SetSearchParm($trx_booking->idseqno); // Field idseqno
			$this->SetSearchParm($trx_booking->tanggal); // Field tanggal
			$this->SetSearchParm($trx_booking->title); // Field title
			$this->SetSearchParm($trx_booking->nama); // Field nama
			$this->SetSearchParm($trx_booking->idtype); // Field idtype
			$this->SetSearchParm($trx_booking->idno); // Field idno
			$this->SetSearchParm($trx_booking->alamat); // Field alamat
			$this->SetSearchParm($trx_booking->phone); // Field phone
			$this->SetSearchParm($trx_booking->zemail); // Field email
			$this->SetSearchParm($trx_booking->company); // Field company
			$this->SetSearchParm($trx_booking->departement); // Field departement
			$this->SetSearchParm($trx_booking->dp); // Field dp
			$this->SetSearchParm($trx_booking->dptype); // Field dptype
			$this->SetSearchParm($trx_booking->room); // Field room
			$this->SetSearchParm($trx_booking->person); // Field person
			$this->SetSearchParm($trx_booking->arrival); // Field arrival
			$this->SetSearchParm($trx_booking->departure); // Field departure
			$this->SetSearchParm($trx_booking->rate); // Field rate
			$this->SetSearchParm($trx_booking->extraperson); // Field extraperson
			$this->SetSearchParm($trx_booking->chargeextraperson); // Field chargeextraperson
			$this->SetSearchParm($trx_booking->discname); // Field discname
			$this->SetSearchParm($trx_booking->disc); // Field disc
			$this->SetSearchParm($trx_booking->notes); // Field notes
			$this->SetSearchParm($trx_booking->confirmasi); // Field confirmasi
			$this->SetSearchParm($trx_booking->checkin); // Field checkin
			$this->SetSearchParm($trx_booking->createby); // Field createby
			$this->SetSearchParm($trx_booking->createdate); // Field createdate
			$this->SetSearchParm($trx_booking->confirmby); // Field confirmby
			$this->SetSearchParm($trx_booking->confirmdate); // Field confirmdate
			$this->SetSearchParm($trx_booking->checkinby); // Field checkinby
			$this->SetSearchParm($trx_booking->checkindate); // Field checkindate
			$this->SetSearchParm($trx_booking->rate1); // Field rate1
			$this->SetSearchParm($trx_booking->rate2); // Field rate2
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $trx_booking;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_booking->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_booking->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_booking->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_booking->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_booking->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $trx_booking;
		$this->sSrchWhere = "";
		$trx_booking->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_booking;
		$trx_booking->setAdvancedSearch("x_kode", "");
		$trx_booking->setAdvancedSearch("x_grup", "");
		$trx_booking->setAdvancedSearch("x_idseqno", "");
		$trx_booking->setAdvancedSearch("x_tanggal", "");
		$trx_booking->setAdvancedSearch("x_title", "");
		$trx_booking->setAdvancedSearch("x_nama", "");
		$trx_booking->setAdvancedSearch("x_idtype", "");
		$trx_booking->setAdvancedSearch("x_idno", "");
		$trx_booking->setAdvancedSearch("x_alamat", "");
		$trx_booking->setAdvancedSearch("x_phone", "");
		$trx_booking->setAdvancedSearch("x_zemail", "");
		$trx_booking->setAdvancedSearch("x_company", "");
		$trx_booking->setAdvancedSearch("x_departement", "");
		$trx_booking->setAdvancedSearch("x_dp", "");
		$trx_booking->setAdvancedSearch("x_dptype", "");
		$trx_booking->setAdvancedSearch("x_room", "");
		$trx_booking->setAdvancedSearch("x_person", "");
		$trx_booking->setAdvancedSearch("x_arrival", "");
		$trx_booking->setAdvancedSearch("x_departure", "");
		$trx_booking->setAdvancedSearch("x_rate", "");
		$trx_booking->setAdvancedSearch("x_extraperson", "");
		$trx_booking->setAdvancedSearch("x_chargeextraperson", "");
		$trx_booking->setAdvancedSearch("x_discname", "");
		$trx_booking->setAdvancedSearch("x_disc", "");
		$trx_booking->setAdvancedSearch("x_notes", "");
		$trx_booking->setAdvancedSearch("x_confirmasi", "");
		$trx_booking->setAdvancedSearch("x_checkin", "");
		$trx_booking->setAdvancedSearch("x_createby", "");
		$trx_booking->setAdvancedSearch("x_createdate", "");
		$trx_booking->setAdvancedSearch("x_confirmby", "");
		$trx_booking->setAdvancedSearch("x_confirmdate", "");
		$trx_booking->setAdvancedSearch("x_checkinby", "");
		$trx_booking->setAdvancedSearch("x_checkindate", "");
		$trx_booking->setAdvancedSearch("x_rate1", "");
		$trx_booking->setAdvancedSearch("x_rate2", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_booking;
		$this->sSrchWhere = $trx_booking->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_booking;
		 $trx_booking->kode->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_kode");
		 $trx_booking->grup->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_grup");
		 $trx_booking->idseqno->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idseqno");
		 $trx_booking->tanggal->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_tanggal");
		 $trx_booking->title->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_title");
		 $trx_booking->nama->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_nama");
		 $trx_booking->idtype->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idtype");
		 $trx_booking->idno->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idno");
		 $trx_booking->alamat->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_alamat");
		 $trx_booking->phone->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_phone");
		 $trx_booking->zemail->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_zemail");
		 $trx_booking->company->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_company");
		 $trx_booking->departement->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_departement");
		 $trx_booking->dp->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_dp");
		 $trx_booking->dptype->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_dptype");
		 $trx_booking->room->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_room");
		 $trx_booking->person->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_person");
		 $trx_booking->arrival->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_arrival");
		 $trx_booking->departure->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_departure");
		 $trx_booking->rate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate");
		 $trx_booking->extraperson->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_extraperson");
		 $trx_booking->chargeextraperson->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_chargeextraperson");
		 $trx_booking->discname->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_discname");
		 $trx_booking->disc->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_disc");
		 $trx_booking->notes->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_notes");
		 $trx_booking->confirmasi->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmasi");
		 $trx_booking->checkin->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkin");
		 $trx_booking->createby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_createby");
		 $trx_booking->createdate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_createdate");
		 $trx_booking->confirmby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmby");
		 $trx_booking->confirmdate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmdate");
		 $trx_booking->checkinby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkinby");
		 $trx_booking->checkindate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkindate");
		 $trx_booking->rate1->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate1");
		 $trx_booking->rate2->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate2");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_booking;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_booking->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_booking->CurrentOrderType = @$_GET["ordertype"];
			$trx_booking->UpdateSort($trx_booking->kode); // Field 
			$trx_booking->UpdateSort($trx_booking->grup); // Field 
			$trx_booking->UpdateSort($trx_booking->tanggal); // Field 
			$trx_booking->UpdateSort($trx_booking->title); // Field 
			$trx_booking->UpdateSort($trx_booking->nama); // Field 
			$trx_booking->UpdateSort($trx_booking->company); // Field 
			$trx_booking->UpdateSort($trx_booking->room); // Field 
			$trx_booking->UpdateSort($trx_booking->person); // Field 
			$trx_booking->UpdateSort($trx_booking->arrival); // Field 
			$trx_booking->UpdateSort($trx_booking->departure); // Field 
			$trx_booking->UpdateSort($trx_booking->discname); // Field 
			$trx_booking->UpdateSort($trx_booking->disc); // Field 
			$trx_booking->UpdateSort($trx_booking->confirmasi); // Field 
			$trx_booking->UpdateSort($trx_booking->checkin); // Field 
			$trx_booking->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_booking;
		$sOrderBy = $trx_booking->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_booking->SqlOrderBy() <> "") {
				$sOrderBy = $trx_booking->SqlOrderBy();
				$trx_booking->setSessionOrderBy($sOrderBy);
				$trx_booking->tanggal->setSort("DESC");
				$trx_booking->kode->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_booking;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_booking->setSessionOrderBy($sOrderBy);
				$trx_booking->kode->setSort("");
				$trx_booking->grup->setSort("");
				$trx_booking->tanggal->setSort("");
				$trx_booking->title->setSort("");
				$trx_booking->nama->setSort("");
				$trx_booking->company->setSort("");
				$trx_booking->room->setSort("");
				$trx_booking->person->setSort("");
				$trx_booking->arrival->setSort("");
				$trx_booking->departure->setSort("");
				$trx_booking->discname->setSort("");
				$trx_booking->disc->setSort("");
				$trx_booking->confirmasi->setSort("");
				$trx_booking->checkin->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_booking->setStartRecordNumber($this->lStartRec);
		}
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

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_booking;

		// Load search values
		// kode

		$trx_booking->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_booking->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// grup
		$trx_booking->grup->AdvancedSearch->SearchValue = @$_GET["x_grup"];
		$trx_booking->grup->AdvancedSearch->SearchOperator = @$_GET["z_grup"];

		// idseqno
		$trx_booking->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$trx_booking->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// tanggal
		$trx_booking->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_booking->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// title
		$trx_booking->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$trx_booking->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];

		// nama
		$trx_booking->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$trx_booking->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// idtype
		$trx_booking->idtype->AdvancedSearch->SearchValue = @$_GET["x_idtype"];
		$trx_booking->idtype->AdvancedSearch->SearchOperator = @$_GET["z_idtype"];

		// idno
		$trx_booking->idno->AdvancedSearch->SearchValue = @$_GET["x_idno"];
		$trx_booking->idno->AdvancedSearch->SearchOperator = @$_GET["z_idno"];

		// alamat
		$trx_booking->alamat->AdvancedSearch->SearchValue = @$_GET["x_alamat"];
		$trx_booking->alamat->AdvancedSearch->SearchOperator = @$_GET["z_alamat"];

		// phone
		$trx_booking->phone->AdvancedSearch->SearchValue = @$_GET["x_phone"];
		$trx_booking->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// email
		$trx_booking->zemail->AdvancedSearch->SearchValue = @$_GET["x_zemail"];
		$trx_booking->zemail->AdvancedSearch->SearchOperator = @$_GET["z_zemail"];

		// company
		$trx_booking->company->AdvancedSearch->SearchValue = @$_GET["x_company"];
		$trx_booking->company->AdvancedSearch->SearchOperator = @$_GET["z_company"];

		// departement
		$trx_booking->departement->AdvancedSearch->SearchValue = @$_GET["x_departement"];
		$trx_booking->departement->AdvancedSearch->SearchOperator = @$_GET["z_departement"];

		// dp
		$trx_booking->dp->AdvancedSearch->SearchValue = @$_GET["x_dp"];
		$trx_booking->dp->AdvancedSearch->SearchOperator = @$_GET["z_dp"];

		// dptype
		$trx_booking->dptype->AdvancedSearch->SearchValue = @$_GET["x_dptype"];
		$trx_booking->dptype->AdvancedSearch->SearchOperator = @$_GET["z_dptype"];

		// room
		$trx_booking->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$trx_booking->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// person
		$trx_booking->person->AdvancedSearch->SearchValue = @$_GET["x_person"];
		$trx_booking->person->AdvancedSearch->SearchOperator = @$_GET["z_person"];

		// arrival
		$trx_booking->arrival->AdvancedSearch->SearchValue = @$_GET["x_arrival"];
		$trx_booking->arrival->AdvancedSearch->SearchOperator = @$_GET["z_arrival"];

		// departure
		$trx_booking->departure->AdvancedSearch->SearchValue = @$_GET["x_departure"];
		$trx_booking->departure->AdvancedSearch->SearchOperator = @$_GET["z_departure"];

		// rate
		$trx_booking->rate->AdvancedSearch->SearchValue = @$_GET["x_rate"];
		$trx_booking->rate->AdvancedSearch->SearchOperator = @$_GET["z_rate"];

		// extraperson
		$trx_booking->extraperson->AdvancedSearch->SearchValue = @$_GET["x_extraperson"];
		$trx_booking->extraperson->AdvancedSearch->SearchOperator = @$_GET["z_extraperson"];

		// chargeextraperson
		$trx_booking->chargeextraperson->AdvancedSearch->SearchValue = @$_GET["x_chargeextraperson"];
		$trx_booking->chargeextraperson->AdvancedSearch->SearchOperator = @$_GET["z_chargeextraperson"];

		// discname
		$trx_booking->discname->AdvancedSearch->SearchValue = @$_GET["x_discname"];
		$trx_booking->discname->AdvancedSearch->SearchOperator = @$_GET["z_discname"];

		// disc
		$trx_booking->disc->AdvancedSearch->SearchValue = @$_GET["x_disc"];
		$trx_booking->disc->AdvancedSearch->SearchOperator = @$_GET["z_disc"];

		// notes
		$trx_booking->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$trx_booking->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// confirmasi
		$trx_booking->confirmasi->AdvancedSearch->SearchValue = @$_GET["x_confirmasi"];
		$trx_booking->confirmasi->AdvancedSearch->SearchOperator = @$_GET["z_confirmasi"];

		// checkin
		$trx_booking->checkin->AdvancedSearch->SearchValue = @$_GET["x_checkin"];
		$trx_booking->checkin->AdvancedSearch->SearchOperator = @$_GET["z_checkin"];

		// createby
		$trx_booking->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$trx_booking->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$trx_booking->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$trx_booking->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// confirmby
		$trx_booking->confirmby->AdvancedSearch->SearchValue = @$_GET["x_confirmby"];
		$trx_booking->confirmby->AdvancedSearch->SearchOperator = @$_GET["z_confirmby"];

		// confirmdate
		$trx_booking->confirmdate->AdvancedSearch->SearchValue = @$_GET["x_confirmdate"];
		$trx_booking->confirmdate->AdvancedSearch->SearchOperator = @$_GET["z_confirmdate"];

		// checkinby
		$trx_booking->checkinby->AdvancedSearch->SearchValue = @$_GET["x_checkinby"];
		$trx_booking->checkinby->AdvancedSearch->SearchOperator = @$_GET["z_checkinby"];

		// checkindate
		$trx_booking->checkindate->AdvancedSearch->SearchValue = @$_GET["x_checkindate"];
		$trx_booking->checkindate->AdvancedSearch->SearchOperator = @$_GET["z_checkindate"];

		// rate1
		$trx_booking->rate1->AdvancedSearch->SearchValue = @$_GET["x_rate1"];
		$trx_booking->rate1->AdvancedSearch->SearchOperator = @$_GET["z_rate1"];

		// rate2
		$trx_booking->rate2->AdvancedSearch->SearchValue = @$_GET["x_rate2"];
		$trx_booking->rate2->AdvancedSearch->SearchOperator = @$_GET["z_rate2"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_booking;

		// Call Recordset Selecting event
		$trx_booking->Recordset_Selecting($trx_booking->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_booking->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_booking->Recordset_Selected($rs);
		return $rs;
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
		$trx_booking->grup->setDbValue($rs->fields('grup'));
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
		$trx_booking->checkinby->setDbValue($rs->fields('checkinby'));
		$trx_booking->checkindate->setDbValue($rs->fields('checkindate'));
		$trx_booking->rate1->setDbValue($rs->fields('rate1'));
		$trx_booking->rate2->setDbValue($rs->fields('rate2'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_booking;

		// Call Row_Rendering event
		$trx_booking->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_booking->kode->CellCssStyle = "white-space: nowrap;";
		$trx_booking->kode->CellCssClass = "";

		// grup
		$trx_booking->grup->CellCssStyle = "white-space: nowrap;";
		$trx_booking->grup->CellCssClass = "";

		// tanggal
		$trx_booking->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_booking->tanggal->CellCssClass = "";

		// title
		$trx_booking->title->CellCssStyle = "white-space: nowrap;";
		$trx_booking->title->CellCssClass = "";

		// nama
		$trx_booking->nama->CellCssStyle = "white-space: nowrap;";
		$trx_booking->nama->CellCssClass = "";

		// company
		$trx_booking->company->CellCssStyle = "white-space: nowrap;";
		$trx_booking->company->CellCssClass = "";

		// room
		$trx_booking->room->CellCssStyle = "white-space: nowrap;";
		$trx_booking->room->CellCssClass = "";

		// person
		$trx_booking->person->CellCssStyle = "white-space: nowrap;";
		$trx_booking->person->CellCssClass = "";

		// arrival
		$trx_booking->arrival->CellCssStyle = "white-space: nowrap;";
		$trx_booking->arrival->CellCssClass = "";

		// departure
		$trx_booking->departure->CellCssStyle = "white-space: nowrap;";
		$trx_booking->departure->CellCssClass = "";

		// discname
		$trx_booking->discname->CellCssStyle = "white-space: nowrap;";
		$trx_booking->discname->CellCssClass = "";

		// disc
		$trx_booking->disc->CellCssStyle = "white-space: nowrap;";
		$trx_booking->disc->CellCssClass = "";

		// confirmasi
		$trx_booking->confirmasi->CellCssStyle = "white-space: nowrap;";
		$trx_booking->confirmasi->CellCssClass = "";

		// checkin
		$trx_booking->checkin->CellCssStyle = "white-space: nowrap;";
		$trx_booking->checkin->CellCssClass = "";
		if ($trx_booking->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_booking->kode->ViewValue = $trx_booking->kode->CurrentValue;
			$trx_booking->kode->CssStyle = "";
			$trx_booking->kode->CssClass = "";
			$trx_booking->kode->ViewCustomAttributes = "";

			// grup
			$trx_booking->grup->ViewValue = $trx_booking->grup->CurrentValue;
			$trx_booking->grup->CssStyle = "";
			$trx_booking->grup->CssClass = "";
			$trx_booking->grup->ViewCustomAttributes = "";

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

			// company
			$trx_booking->company->ViewValue = $trx_booking->company->CurrentValue;
			$trx_booking->company->CssStyle = "";
			$trx_booking->company->CssClass = "";
			$trx_booking->company->ViewCustomAttributes = "";

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

			// discname
			if (strval($trx_booking->discname->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `disc` FROM `mst_discount` WHERE `name` = '" . ew_AdjustSql($trx_booking->discname->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_booking->discname->ViewValue = $rswrk->fields('name');
					$trx_booking->discname->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('disc');
					$rswrk->Close();
				} else {
					$trx_booking->discname->ViewValue = $trx_booking->discname->CurrentValue;
				}
			} else {
				$trx_booking->discname->ViewValue = NULL;
			}
			$trx_booking->discname->CssStyle = "";
			$trx_booking->discname->CssClass = "";
			$trx_booking->discname->ViewCustomAttributes = "";

			// disc
			$trx_booking->disc->ViewValue = $trx_booking->disc->CurrentValue;
			$trx_booking->disc->CssStyle = "";
			$trx_booking->disc->CssClass = "";
			$trx_booking->disc->ViewCustomAttributes = "";

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

			// kode
			$trx_booking->kode->HrefValue = "";

			// grup
			$trx_booking->grup->HrefValue = "";

			// tanggal
			$trx_booking->tanggal->HrefValue = "";

			// title
			$trx_booking->title->HrefValue = "";

			// nama
			$trx_booking->nama->HrefValue = "";

			// company
			$trx_booking->company->HrefValue = "";

			// room
			$trx_booking->room->HrefValue = "";

			// person
			$trx_booking->person->HrefValue = "";

			// arrival
			$trx_booking->arrival->HrefValue = "";

			// departure
			$trx_booking->departure->HrefValue = "";

			// discname
			$trx_booking->discname->HrefValue = "";

			// disc
			$trx_booking->disc->HrefValue = "";

			// confirmasi
			$trx_booking->confirmasi->HrefValue = "";

			// checkin
			$trx_booking->checkin->HrefValue = "";
		} elseif ($trx_booking->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_booking->kode->EditCustomAttributes = "";
			$trx_booking->kode->EditValue = ew_HtmlEncode($trx_booking->kode->AdvancedSearch->SearchValue);

			// grup
			$trx_booking->grup->EditCustomAttributes = "";
			$trx_booking->grup->EditValue = ew_HtmlEncode($trx_booking->grup->AdvancedSearch->SearchValue);

			// tanggal
			$trx_booking->tanggal->EditCustomAttributes = "";
			$trx_booking->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_booking->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// title
			$trx_booking->title->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_name_title`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_booking->title->EditValue = $arwrk;

			// nama
			$trx_booking->nama->EditCustomAttributes = "";
			$trx_booking->nama->EditValue = ew_HtmlEncode($trx_booking->nama->AdvancedSearch->SearchValue);

			// company
			$trx_booking->company->EditCustomAttributes = "";
			$trx_booking->company->EditValue = ew_HtmlEncode($trx_booking->company->AdvancedSearch->SearchValue);

			// room
			$trx_booking->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_booking->room->EditValue = $arwrk;

			// person
			$trx_booking->person->EditCustomAttributes = "";
			$trx_booking->person->EditValue = ew_HtmlEncode($trx_booking->person->AdvancedSearch->SearchValue);

			// arrival
			$trx_booking->arrival->EditCustomAttributes = "";
			$trx_booking->arrival->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_booking->arrival->AdvancedSearch->SearchValue, 7), 7));

			// departure
			$trx_booking->departure->EditCustomAttributes = "";
			$trx_booking->departure->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_booking->departure->AdvancedSearch->SearchValue, 7), 7));

			// discname
			$trx_booking->discname->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `name`, `name`, `disc`, '' AS SelectFilterFld FROM `mst_discount`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$trx_booking->discname->EditValue = $arwrk;

			// disc
			$trx_booking->disc->EditCustomAttributes = "";
			$trx_booking->disc->EditValue = ew_HtmlEncode($trx_booking->disc->AdvancedSearch->SearchValue);

			// confirmasi
			$trx_booking->confirmasi->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Ya");
			$arwrk[] = array("2", "Batal");
			$trx_booking->confirmasi->EditValue = $arwrk;

			// checkin
			$trx_booking->checkin->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$trx_booking->checkin->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$trx_booking->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_booking;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_booking->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($trx_booking->arrival->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Arrival";
		}
		if (!ew_CheckEuroDate($trx_booking->departure->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Departure";
		}
		if (!ew_CheckNumber($trx_booking->disc->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Disc (%)";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $trx_booking;
		$trx_booking->kode->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_kode");
		$trx_booking->grup->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_grup");
		$trx_booking->idseqno->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idseqno");
		$trx_booking->tanggal->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_tanggal");
		$trx_booking->title->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_title");
		$trx_booking->nama->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_nama");
		$trx_booking->idtype->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idtype");
		$trx_booking->idno->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_idno");
		$trx_booking->alamat->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_alamat");
		$trx_booking->phone->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_phone");
		$trx_booking->zemail->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_zemail");
		$trx_booking->company->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_company");
		$trx_booking->departement->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_departement");
		$trx_booking->dp->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_dp");
		$trx_booking->dptype->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_dptype");
		$trx_booking->room->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_room");
		$trx_booking->person->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_person");
		$trx_booking->arrival->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_arrival");
		$trx_booking->departure->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_departure");
		$trx_booking->rate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate");
		$trx_booking->extraperson->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_extraperson");
		$trx_booking->chargeextraperson->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_chargeextraperson");
		$trx_booking->discname->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_discname");
		$trx_booking->disc->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_disc");
		$trx_booking->notes->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_notes");
		$trx_booking->confirmasi->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmasi");
		$trx_booking->checkin->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkin");
		$trx_booking->createby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_createby");
		$trx_booking->createdate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_createdate");
		$trx_booking->confirmby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmby");
		$trx_booking->confirmdate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_confirmdate");
		$trx_booking->checkinby->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkinby");
		$trx_booking->checkindate->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_checkindate");
		$trx_booking->rate1->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate1");
		$trx_booking->rate2->AdvancedSearch->SearchValue = $trx_booking->getAdvancedSearch("x_rate2");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $trx_booking;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($trx_booking->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($trx_booking->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($trx_booking->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $trx_booking->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'grup', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'title', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'nama', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'company', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'room', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'person', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'arrival', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'departure', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'discname', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'disc', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'confirmasi', $trx_booking->Export);
				ew_ExportAddValue($sExportStr, 'checkin', $trx_booking->Export);
				echo ew_ExportLine($sExportStr, $trx_booking->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$trx_booking->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($trx_booking->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $trx_booking->kode->CurrentValue);
					$XmlDoc->AddField('grup', $trx_booking->grup->CurrentValue);
					$XmlDoc->AddField('tanggal', $trx_booking->tanggal->CurrentValue);
					$XmlDoc->AddField('title', $trx_booking->title->CurrentValue);
					$XmlDoc->AddField('nama', $trx_booking->nama->CurrentValue);
					$XmlDoc->AddField('company', $trx_booking->company->CurrentValue);
					$XmlDoc->AddField('room', $trx_booking->room->CurrentValue);
					$XmlDoc->AddField('person', $trx_booking->person->CurrentValue);
					$XmlDoc->AddField('arrival', $trx_booking->arrival->CurrentValue);
					$XmlDoc->AddField('departure', $trx_booking->departure->CurrentValue);
					$XmlDoc->AddField('discname', $trx_booking->discname->CurrentValue);
					$XmlDoc->AddField('disc', $trx_booking->disc->CurrentValue);
					$XmlDoc->AddField('confirmasi', $trx_booking->confirmasi->CurrentValue);
					$XmlDoc->AddField('checkin', $trx_booking->checkin->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $trx_booking->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $trx_booking->kode->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('grup', $trx_booking->grup->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('tanggal', $trx_booking->tanggal->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('title', $trx_booking->title->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('nama', $trx_booking->nama->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('company', $trx_booking->company->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('room', $trx_booking->room->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('person', $trx_booking->person->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('arrival', $trx_booking->arrival->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('departure', $trx_booking->departure->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('discname', $trx_booking->discname->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('disc', $trx_booking->disc->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('confirmasi', $trx_booking->confirmasi->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportField('checkin', $trx_booking->checkin->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $trx_booking->kode->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->grup->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->tanggal->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->title->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->nama->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->company->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->room->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->person->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->arrival->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->departure->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->discname->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->disc->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->confirmasi->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						ew_ExportAddValue($sExportStr, $trx_booking->checkin->ExportValue($trx_booking->Export, $trx_booking->ExportOriginalValue), $trx_booking->Export);
						echo ew_ExportLine($sExportStr, $trx_booking->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($trx_booking->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($trx_booking->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'trx_booking';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
