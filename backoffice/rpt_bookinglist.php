<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "rpt_bookinginfo.php" ?>
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
$rpt_booking_list = new crpt_booking_list();
$Page =& $rpt_booking_list;

// Page init processing
$rpt_booking_list->Page_Init();

// Page main processing
$rpt_booking_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($rpt_booking->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rpt_booking_list = new ew_Page("rpt_booking_list");

// page properties
rpt_booking_list.PageID = "list"; // page ID
var EW_PAGE_ID = rpt_booking_list.PageID; // for backward compatibility

// extend page with validate function for search
rpt_booking_list.ValidateSearch = function(fobj) {
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
	elm = fobj.elements["x" + infix + "_confirmdate"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Confirmdate");
	elm = fobj.elements["x" + infix + "_checkindate"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Checkindate");

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
rpt_booking_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rpt_booking_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rpt_booking_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($rpt_booking->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($rpt_booking->Export == "" && $rpt_booking->SelectLimit);
	if (!$bSelectLimit)
		$rs = $rpt_booking_list->LoadRecordset();
	$rpt_booking_list->lTotalRecs = ($bSelectLimit) ? $rpt_booking->SelectRecordCount() : $rs->RecordCount();
	$rpt_booking_list->lStartRec = 1;
	if ($rpt_booking_list->lDisplayRecs <= 0) // Display all records
		$rpt_booking_list->lDisplayRecs = $rpt_booking_list->lTotalRecs;
	if (!($rpt_booking->ExportAll && $rpt_booking->Export <> ""))
		$rpt_booking_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $rpt_booking_list->LoadRecordset($rpt_booking_list->lStartRec-1, $rpt_booking_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Booking List</b></h3>
<?php if ($rpt_booking->Export == "" && $rpt_booking->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $rpt_booking_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $rpt_booking_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($rpt_booking->Export == "" && $rpt_booking->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(rpt_booking_list);" style="text-decoration: none;"><img id="rpt_booking_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="rpt_booking_list_SearchPanel">
<form name="frpt_bookinglistsrch" id="frpt_bookinglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return rpt_booking_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="rpt_booking">
<?php
if ($gsSearchError == "")
	$rpt_booking_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$rpt_booking->RowType = EW_ROWTYPE_SEARCH;

// Render row
$rpt_booking_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="30" maxlength="20" value="<?php echo $rpt_booking->kode->EditValue ?>"<?php echo $rpt_booking->kode->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $rpt_booking->tanggal->EditValue ?>"<?php echo $rpt_booking->tanggal->EditAttributes() ?>>
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
<select id="x_title" name="x_title"<?php echo $rpt_booking->title->EditAttributes() ?>>
<?php
if (is_array($rpt_booking->title->EditValue)) {
	$arwrk = $rpt_booking->title->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rpt_booking->title->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $rpt_booking->nama->EditValue ?>"<?php echo $rpt_booking->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Phone</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_phone" id="z_phone" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="20" value="<?php echo $rpt_booking->phone->EditValue ?>"<?php echo $rpt_booking->phone->EditAttributes() ?>>
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
<select id="x_room" name="x_room"<?php echo $rpt_booking->room->EditAttributes() ?>>
<?php
if (is_array($rpt_booking->room->EditValue)) {
	$arwrk = $rpt_booking->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rpt_booking->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_arrival" id="x_arrival" value="<?php echo $rpt_booking->arrival->EditValue ?>"<?php echo $rpt_booking->arrival->EditAttributes() ?>>
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
<input type="text" name="x_departure" id="x_departure" value="<?php echo $rpt_booking->departure->EditValue ?>"<?php echo $rpt_booking->departure->EditAttributes() ?>>
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
		<td><span class="phpmaker">Confirmasi</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_confirmasi" id="z_confirmasi" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_confirmasi" name="x_confirmasi"<?php echo $rpt_booking->confirmasi->EditAttributes() ?>>
<?php
if (is_array($rpt_booking->confirmasi->EditValue)) {
	$arwrk = $rpt_booking->confirmasi->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rpt_booking->confirmasi->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Checkin</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_checkin" id="z_checkin" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_checkin" name="x_checkin"<?php echo $rpt_booking->checkin->EditAttributes() ?>>
<?php
if (is_array($rpt_booking->checkin->EditValue)) {
	$arwrk = $rpt_booking->checkin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rpt_booking->checkin->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Confirmdate</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_confirmdate" id="z_confirmdate" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_confirmdate" id="x_confirmdate" value="<?php echo $rpt_booking->confirmdate->EditValue ?>"<?php echo $rpt_booking->confirmdate->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_confirmdate" name="cal_x_confirmdate" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_confirmdate", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_confirmdate" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Checkindate</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_checkindate" id="z_checkindate" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_checkindate" id="x_checkindate" value="<?php echo $rpt_booking->checkindate->EditValue ?>"<?php echo $rpt_booking->checkindate->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_checkindate" name="cal_x_checkindate" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_checkindate", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_checkindate" // ID of the button
});
</script>
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
			<!--a href="<?php echo $rpt_booking_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $rpt_booking_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $rpt_booking_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($rpt_booking->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($rpt_booking->CurrentAction <> "gridadd" && $rpt_booking->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($rpt_booking_list->Pager)) $rpt_booking_list->Pager = new cPrevNextPager($rpt_booking_list->lStartRec, $rpt_booking_list->lDisplayRecs, $rpt_booking_list->lTotalRecs) ?>
<?php if ($rpt_booking_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($rpt_booking_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $rpt_booking_list->PageUrl() ?>start=<?php echo $rpt_booking_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($rpt_booking_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $rpt_booking_list->PageUrl() ?>start=<?php echo $rpt_booking_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rpt_booking_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($rpt_booking_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $rpt_booking_list->PageUrl() ?>start=<?php echo $rpt_booking_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($rpt_booking_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $rpt_booking_list->PageUrl() ?>start=<?php echo $rpt_booking_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $rpt_booking_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $rpt_booking_list->Pager->FromIndex ?> to <?php echo $rpt_booking_list->Pager->ToIndex ?> of <?php echo $rpt_booking_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($rpt_booking_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($rpt_booking_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="rpt_booking">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($rpt_booking_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($rpt_booking_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($rpt_booking_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($rpt_booking_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($rpt_booking_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($rpt_booking_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="frpt_bookinglist" id="frpt_bookinglist" class="ewForm" action="" method="post">
<?php if ($rpt_booking_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$rpt_booking_list->lOptionCnt = 0;
	$rpt_booking_list->lOptionCnt += count($rpt_booking_list->ListOptions->Items); // Custom list options
?>
<?php echo $rpt_booking->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($rpt_booking->Export == "") { ?>
<?php

// Custom list options
foreach ($rpt_booking_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($rpt_booking->kode->Visible) { // kode ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($rpt_booking->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->tanggal->Visible) { // tanggal ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($rpt_booking->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->title->Visible) { // title ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->title) == "") { ?>
		<td style="white-space: nowrap;">Title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->title) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Title</td><td style="width: 10px;"><?php if ($rpt_booking->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->nama->Visible) { // nama ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($rpt_booking->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->phone->Visible) { // phone ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->phone) == "") { ?>
		<td style="white-space: nowrap;">Phone</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->phone) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Phone</td><td style="width: 10px;"><?php if ($rpt_booking->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->room->Visible) { // room ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($rpt_booking->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->arrival->Visible) { // arrival ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->arrival) == "") { ?>
		<td style="white-space: nowrap;">Arrival</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->arrival) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Arrival</td><td style="width: 10px;"><?php if ($rpt_booking->arrival->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->arrival->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->departure->Visible) { // departure ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->departure) == "") { ?>
		<td style="white-space: nowrap;">Departure</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->departure) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Departure</td><td style="width: 10px;"><?php if ($rpt_booking->departure->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->departure->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->notes->Visible) { // notes ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->notes) == "") { ?>
		<td style="white-space: nowrap;">Notes</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->notes) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Notes</td><td style="width: 10px;"><?php if ($rpt_booking->notes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->notes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->confirmasi->Visible) { // confirmasi ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->confirmasi) == "") { ?>
		<td style="white-space: nowrap;">Confirmasi</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->confirmasi) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Confirmasi</td><td style="width: 10px;"><?php if ($rpt_booking->confirmasi->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->confirmasi->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->checkin->Visible) { // checkin ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->checkin) == "") { ?>
		<td style="white-space: nowrap;">Checkin</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->checkin) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Checkin</td><td style="width: 10px;"><?php if ($rpt_booking->checkin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->checkin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->confirmdate->Visible) { // confirmdate ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->confirmdate) == "") { ?>
		<td style="white-space: nowrap;">Confirmdate</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->confirmdate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Confirmdate</td><td style="width: 10px;"><?php if ($rpt_booking->confirmdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->confirmdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($rpt_booking->checkindate->Visible) { // checkindate ?>
	<?php if ($rpt_booking->SortUrl($rpt_booking->checkindate) == "") { ?>
		<td style="white-space: nowrap;">Checkindate</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rpt_booking->SortUrl($rpt_booking->checkindate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Checkindate</td><td style="width: 10px;"><?php if ($rpt_booking->checkindate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rpt_booking->checkindate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($rpt_booking->ExportAll && $rpt_booking->Export <> "") {
	$rpt_booking_list->lStopRec = $rpt_booking_list->lTotalRecs;
} else {
	$rpt_booking_list->lStopRec = $rpt_booking_list->lStartRec + $rpt_booking_list->lDisplayRecs - 1; // Set the last record to display
}
$rpt_booking_list->lRecCount = $rpt_booking_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$rpt_booking->SelectLimit && $rpt_booking_list->lStartRec > 1)
		$rs->Move($rpt_booking_list->lStartRec - 1);
}
$rpt_booking_list->lRowCnt = 0;
while (($rpt_booking->CurrentAction == "gridadd" || !$rs->EOF) &&
	$rpt_booking_list->lRecCount < $rpt_booking_list->lStopRec) {
	$rpt_booking_list->lRecCount++;
	if (intval($rpt_booking_list->lRecCount) >= intval($rpt_booking_list->lStartRec)) {
		$rpt_booking_list->lRowCnt++;

	// Init row class and style
	$rpt_booking->CssClass = "";
	$rpt_booking->CssStyle = "";
	$rpt_booking->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($rpt_booking->CurrentAction == "gridadd") {
		$rpt_booking_list->LoadDefaultValues(); // Load default values
	} else {
		$rpt_booking_list->LoadRowValues($rs); // Load row values
	}
	$rpt_booking->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$rpt_booking_list->RenderRow();
?>
	<tr<?php echo $rpt_booking->RowAttributes() ?>>
<?php if ($rpt_booking->Export == "") { ?>
<?php

// Custom list options
foreach ($rpt_booking_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($rpt_booking->kode->Visible) { // kode ?>
		<td<?php echo $rpt_booking->kode->CellAttributes() ?>>
<div<?php echo $rpt_booking->kode->ViewAttributes() ?>><?php echo $rpt_booking->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->tanggal->Visible) { // tanggal ?>
		<td<?php echo $rpt_booking->tanggal->CellAttributes() ?>>
<div<?php echo $rpt_booking->tanggal->ViewAttributes() ?>><?php echo $rpt_booking->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->title->Visible) { // title ?>
		<td<?php echo $rpt_booking->title->CellAttributes() ?>>
<div<?php echo $rpt_booking->title->ViewAttributes() ?>><?php echo $rpt_booking->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->nama->Visible) { // nama ?>
		<td<?php echo $rpt_booking->nama->CellAttributes() ?>>
<div<?php echo $rpt_booking->nama->ViewAttributes() ?>><?php echo $rpt_booking->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->phone->Visible) { // phone ?>
		<td<?php echo $rpt_booking->phone->CellAttributes() ?>>
<div<?php echo $rpt_booking->phone->ViewAttributes() ?>><?php echo $rpt_booking->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->room->Visible) { // room ?>
		<td<?php echo $rpt_booking->room->CellAttributes() ?>>
<div<?php echo $rpt_booking->room->ViewAttributes() ?>><?php echo $rpt_booking->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->arrival->Visible) { // arrival ?>
		<td<?php echo $rpt_booking->arrival->CellAttributes() ?>>
<div<?php echo $rpt_booking->arrival->ViewAttributes() ?>><?php echo $rpt_booking->arrival->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->departure->Visible) { // departure ?>
		<td<?php echo $rpt_booking->departure->CellAttributes() ?>>
<div<?php echo $rpt_booking->departure->ViewAttributes() ?>><?php echo $rpt_booking->departure->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->notes->Visible) { // notes ?>
		<td<?php echo $rpt_booking->notes->CellAttributes() ?>>
<div<?php echo $rpt_booking->notes->ViewAttributes() ?>><?php echo $rpt_booking->notes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->confirmasi->Visible) { // confirmasi ?>
		<td<?php echo $rpt_booking->confirmasi->CellAttributes() ?>>
<div<?php echo $rpt_booking->confirmasi->ViewAttributes() ?>><?php echo $rpt_booking->confirmasi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->checkin->Visible) { // checkin ?>
		<td<?php echo $rpt_booking->checkin->CellAttributes() ?>>
<div<?php echo $rpt_booking->checkin->ViewAttributes() ?>><?php echo $rpt_booking->checkin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->confirmdate->Visible) { // confirmdate ?>
		<td<?php echo $rpt_booking->confirmdate->CellAttributes() ?>>
<div<?php echo $rpt_booking->confirmdate->ViewAttributes() ?>><?php echo $rpt_booking->confirmdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rpt_booking->checkindate->Visible) { // checkindate ?>
		<td<?php echo $rpt_booking->checkindate->CellAttributes() ?>>
<div<?php echo $rpt_booking->checkindate->ViewAttributes() ?>><?php echo $rpt_booking->checkindate->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($rpt_booking->CurrentAction <> "gridadd")
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
<?php if ($rpt_booking->Export == "" && $rpt_booking->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(rpt_booking_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($rpt_booking->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$rpt_booking_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class crpt_booking_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'rpt_booking';

	// Page Object Name
	var $PageObjName = 'rpt_booking_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rpt_booking;
		if ($rpt_booking->UseTokenInUrl) $PageUrl .= "t=" . $rpt_booking->TableVar . "&"; // add page token
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
		global $objForm, $rpt_booking;
		if ($rpt_booking->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($rpt_booking->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rpt_booking->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function crpt_booking_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["rpt_booking"] = new crpt_booking();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rpt_booking', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $rpt_booking;
	$rpt_booking->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $rpt_booking->Export; // Get export parameter, used in header
	$gsExportFile = $rpt_booking->TableVar; // Get export file, used in header
	if ($rpt_booking->Export == "print" || $rpt_booking->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($rpt_booking->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $rpt_booking;
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
		if ($rpt_booking->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $rpt_booking->getRecordsPerPage(); // Restore from Session
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
		$rpt_booking->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$rpt_booking->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$rpt_booking->setStartRecordNumber($this->lStartRec);
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
		$rpt_booking->setSessionWhere($sFilter);
		$rpt_booking->CurrentFilter = "";

		// Export data only
		if (in_array($rpt_booking->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $rpt_booking;
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
			$rpt_booking->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$rpt_booking->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $rpt_booking;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $rpt_booking->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $rpt_booking->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $rpt_booking->title, FALSE); // Field title
		$this->BuildSearchSql($sWhere, $rpt_booking->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $rpt_booking->phone, FALSE); // Field phone
		$this->BuildSearchSql($sWhere, $rpt_booking->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $rpt_booking->arrival, FALSE); // Field arrival
		$this->BuildSearchSql($sWhere, $rpt_booking->departure, FALSE); // Field departure
		$this->BuildSearchSql($sWhere, $rpt_booking->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $rpt_booking->confirmasi, FALSE); // Field confirmasi
		$this->BuildSearchSql($sWhere, $rpt_booking->checkin, FALSE); // Field checkin
		$this->BuildSearchSql($sWhere, $rpt_booking->confirmdate, FALSE); // Field confirmdate
		$this->BuildSearchSql($sWhere, $rpt_booking->checkindate, FALSE); // Field checkindate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($rpt_booking->kode); // Field kode
			$this->SetSearchParm($rpt_booking->tanggal); // Field tanggal
			$this->SetSearchParm($rpt_booking->title); // Field title
			$this->SetSearchParm($rpt_booking->nama); // Field nama
			$this->SetSearchParm($rpt_booking->phone); // Field phone
			$this->SetSearchParm($rpt_booking->room); // Field room
			$this->SetSearchParm($rpt_booking->arrival); // Field arrival
			$this->SetSearchParm($rpt_booking->departure); // Field departure
			$this->SetSearchParm($rpt_booking->notes); // Field notes
			$this->SetSearchParm($rpt_booking->confirmasi); // Field confirmasi
			$this->SetSearchParm($rpt_booking->checkin); // Field checkin
			$this->SetSearchParm($rpt_booking->confirmdate); // Field confirmdate
			$this->SetSearchParm($rpt_booking->checkindate); // Field checkindate
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
		global $rpt_booking;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$rpt_booking->setAdvancedSearch("x_$FldParm", $FldVal);
		$rpt_booking->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$rpt_booking->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$rpt_booking->setAdvancedSearch("y_$FldParm", $FldVal2);
		$rpt_booking->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $rpt_booking;
		$this->sSrchWhere = "";
		$rpt_booking->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $rpt_booking;
		$rpt_booking->setAdvancedSearch("x_kode", "");
		$rpt_booking->setAdvancedSearch("x_tanggal", "");
		$rpt_booking->setAdvancedSearch("x_title", "");
		$rpt_booking->setAdvancedSearch("x_nama", "");
		$rpt_booking->setAdvancedSearch("x_phone", "");
		$rpt_booking->setAdvancedSearch("x_room", "");
		$rpt_booking->setAdvancedSearch("x_arrival", "");
		$rpt_booking->setAdvancedSearch("x_departure", "");
		$rpt_booking->setAdvancedSearch("x_notes", "");
		$rpt_booking->setAdvancedSearch("x_confirmasi", "");
		$rpt_booking->setAdvancedSearch("x_checkin", "");
		$rpt_booking->setAdvancedSearch("x_confirmdate", "");
		$rpt_booking->setAdvancedSearch("x_checkindate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $rpt_booking;
		$this->sSrchWhere = $rpt_booking->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $rpt_booking;
		 $rpt_booking->kode->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_kode");
		 $rpt_booking->tanggal->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_tanggal");
		 $rpt_booking->title->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_title");
		 $rpt_booking->nama->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_nama");
		 $rpt_booking->phone->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_phone");
		 $rpt_booking->room->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_room");
		 $rpt_booking->arrival->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_arrival");
		 $rpt_booking->departure->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_departure");
		 $rpt_booking->notes->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_notes");
		 $rpt_booking->confirmasi->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_confirmasi");
		 $rpt_booking->checkin->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_checkin");
		 $rpt_booking->confirmdate->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_confirmdate");
		 $rpt_booking->checkindate->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_checkindate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $rpt_booking;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$rpt_booking->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$rpt_booking->CurrentOrderType = @$_GET["ordertype"];
			$rpt_booking->UpdateSort($rpt_booking->kode); // Field 
			$rpt_booking->UpdateSort($rpt_booking->tanggal); // Field 
			$rpt_booking->UpdateSort($rpt_booking->title); // Field 
			$rpt_booking->UpdateSort($rpt_booking->nama); // Field 
			$rpt_booking->UpdateSort($rpt_booking->phone); // Field 
			$rpt_booking->UpdateSort($rpt_booking->room); // Field 
			$rpt_booking->UpdateSort($rpt_booking->arrival); // Field 
			$rpt_booking->UpdateSort($rpt_booking->departure); // Field 
			$rpt_booking->UpdateSort($rpt_booking->notes); // Field 
			$rpt_booking->UpdateSort($rpt_booking->confirmasi); // Field 
			$rpt_booking->UpdateSort($rpt_booking->checkin); // Field 
			$rpt_booking->UpdateSort($rpt_booking->confirmdate); // Field 
			$rpt_booking->UpdateSort($rpt_booking->checkindate); // Field 
			$rpt_booking->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $rpt_booking;
		$sOrderBy = $rpt_booking->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($rpt_booking->SqlOrderBy() <> "") {
				$sOrderBy = $rpt_booking->SqlOrderBy();
				$rpt_booking->setSessionOrderBy($sOrderBy);
				$rpt_booking->arrival->setSort("ASC");
				$rpt_booking->kode->setSort("ASC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $rpt_booking;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$rpt_booking->setSessionOrderBy($sOrderBy);
				$rpt_booking->kode->setSort("");
				$rpt_booking->tanggal->setSort("");
				$rpt_booking->title->setSort("");
				$rpt_booking->nama->setSort("");
				$rpt_booking->phone->setSort("");
				$rpt_booking->room->setSort("");
				$rpt_booking->arrival->setSort("");
				$rpt_booking->departure->setSort("");
				$rpt_booking->notes->setSort("");
				$rpt_booking->confirmasi->setSort("");
				$rpt_booking->checkin->setSort("");
				$rpt_booking->confirmdate->setSort("");
				$rpt_booking->checkindate->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$rpt_booking->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $rpt_booking;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$rpt_booking->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$rpt_booking->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $rpt_booking->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$rpt_booking->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$rpt_booking->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$rpt_booking->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $rpt_booking;

		// Load search values
		// kode

		$rpt_booking->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$rpt_booking->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// tanggal
		$rpt_booking->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$rpt_booking->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// title
		$rpt_booking->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$rpt_booking->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];

		// nama
		$rpt_booking->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$rpt_booking->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// phone
		$rpt_booking->phone->AdvancedSearch->SearchValue = @$_GET["x_phone"];
		$rpt_booking->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// room
		$rpt_booking->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$rpt_booking->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// arrival
		$rpt_booking->arrival->AdvancedSearch->SearchValue = @$_GET["x_arrival"];
		$rpt_booking->arrival->AdvancedSearch->SearchOperator = @$_GET["z_arrival"];

		// departure
		$rpt_booking->departure->AdvancedSearch->SearchValue = @$_GET["x_departure"];
		$rpt_booking->departure->AdvancedSearch->SearchOperator = @$_GET["z_departure"];

		// notes
		$rpt_booking->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$rpt_booking->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// confirmasi
		$rpt_booking->confirmasi->AdvancedSearch->SearchValue = @$_GET["x_confirmasi"];
		$rpt_booking->confirmasi->AdvancedSearch->SearchOperator = @$_GET["z_confirmasi"];

		// checkin
		$rpt_booking->checkin->AdvancedSearch->SearchValue = @$_GET["x_checkin"];
		$rpt_booking->checkin->AdvancedSearch->SearchOperator = @$_GET["z_checkin"];

		// confirmdate
		$rpt_booking->confirmdate->AdvancedSearch->SearchValue = @$_GET["x_confirmdate"];
		$rpt_booking->confirmdate->AdvancedSearch->SearchOperator = @$_GET["z_confirmdate"];

		// checkindate
		$rpt_booking->checkindate->AdvancedSearch->SearchValue = @$_GET["x_checkindate"];
		$rpt_booking->checkindate->AdvancedSearch->SearchOperator = @$_GET["z_checkindate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rpt_booking;

		// Call Recordset Selecting event
		$rpt_booking->Recordset_Selecting($rpt_booking->CurrentFilter);

		// Load list page SQL
		$sSql = $rpt_booking->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$rpt_booking->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rpt_booking;
		$sFilter = $rpt_booking->KeyFilter();

		// Call Row Selecting event
		$rpt_booking->Row_Selecting($sFilter);

		// Load sql based on filter
		$rpt_booking->CurrentFilter = $sFilter;
		$sSql = $rpt_booking->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$rpt_booking->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $rpt_booking;
		$rpt_booking->kode->setDbValue($rs->fields('kode'));
		$rpt_booking->tanggal->setDbValue($rs->fields('tanggal'));
		$rpt_booking->title->setDbValue($rs->fields('title'));
		$rpt_booking->nama->setDbValue($rs->fields('nama'));
		$rpt_booking->phone->setDbValue($rs->fields('phone'));
		$rpt_booking->room->setDbValue($rs->fields('room'));
		$rpt_booking->arrival->setDbValue($rs->fields('arrival'));
		$rpt_booking->departure->setDbValue($rs->fields('departure'));
		$rpt_booking->notes->setDbValue($rs->fields('notes'));
		$rpt_booking->confirmasi->setDbValue($rs->fields('confirmasi'));
		$rpt_booking->checkin->setDbValue($rs->fields('checkin'));
		$rpt_booking->confirmdate->setDbValue($rs->fields('confirmdate'));
		$rpt_booking->checkindate->setDbValue($rs->fields('checkindate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $rpt_booking;

		// Call Row_Rendering event
		$rpt_booking->Row_Rendering();

		// Common render codes for all row types
		// kode

		$rpt_booking->kode->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->kode->CellCssClass = "";

		// tanggal
		$rpt_booking->tanggal->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->tanggal->CellCssClass = "";

		// title
		$rpt_booking->title->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->title->CellCssClass = "";

		// nama
		$rpt_booking->nama->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->nama->CellCssClass = "";

		// phone
		$rpt_booking->phone->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->phone->CellCssClass = "";

		// room
		$rpt_booking->room->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->room->CellCssClass = "";

		// arrival
		$rpt_booking->arrival->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->arrival->CellCssClass = "";

		// departure
		$rpt_booking->departure->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->departure->CellCssClass = "";

		// notes
		$rpt_booking->notes->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->notes->CellCssClass = "";

		// confirmasi
		$rpt_booking->confirmasi->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->confirmasi->CellCssClass = "";

		// checkin
		$rpt_booking->checkin->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->checkin->CellCssClass = "";

		// confirmdate
		$rpt_booking->confirmdate->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->confirmdate->CellCssClass = "";

		// checkindate
		$rpt_booking->checkindate->CellCssStyle = "white-space: nowrap;";
		$rpt_booking->checkindate->CellCssClass = "";
		if ($rpt_booking->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$rpt_booking->kode->ViewValue = $rpt_booking->kode->CurrentValue;
			$rpt_booking->kode->CssStyle = "";
			$rpt_booking->kode->CssClass = "";
			$rpt_booking->kode->ViewCustomAttributes = "";

			// tanggal
			$rpt_booking->tanggal->ViewValue = $rpt_booking->tanggal->CurrentValue;
			$rpt_booking->tanggal->ViewValue = ew_FormatDateTime($rpt_booking->tanggal->ViewValue, 7);
			$rpt_booking->tanggal->CssStyle = "";
			$rpt_booking->tanggal->CssClass = "";
			$rpt_booking->tanggal->ViewCustomAttributes = "";

			// title
			if (strval($rpt_booking->title->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_name_title` WHERE `kode` = '" . ew_AdjustSql($rpt_booking->title->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$rpt_booking->title->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$rpt_booking->title->ViewValue = $rpt_booking->title->CurrentValue;
				}
			} else {
				$rpt_booking->title->ViewValue = NULL;
			}
			$rpt_booking->title->CssStyle = "";
			$rpt_booking->title->CssClass = "";
			$rpt_booking->title->ViewCustomAttributes = "";

			// nama
			$rpt_booking->nama->ViewValue = $rpt_booking->nama->CurrentValue;
			$rpt_booking->nama->CssStyle = "";
			$rpt_booking->nama->CssClass = "";
			$rpt_booking->nama->ViewCustomAttributes = "";

			// phone
			$rpt_booking->phone->ViewValue = $rpt_booking->phone->CurrentValue;
			$rpt_booking->phone->CssStyle = "";
			$rpt_booking->phone->CssClass = "";
			$rpt_booking->phone->ViewCustomAttributes = "";

			// room
			if (strval($rpt_booking->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($rpt_booking->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$rpt_booking->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$rpt_booking->room->ViewValue = $rpt_booking->room->CurrentValue;
				}
			} else {
				$rpt_booking->room->ViewValue = NULL;
			}
			$rpt_booking->room->CssStyle = "";
			$rpt_booking->room->CssClass = "";
			$rpt_booking->room->ViewCustomAttributes = "";

			// arrival
			$rpt_booking->arrival->ViewValue = $rpt_booking->arrival->CurrentValue;
			$rpt_booking->arrival->ViewValue = ew_FormatDateTime($rpt_booking->arrival->ViewValue, 7);
			$rpt_booking->arrival->CssStyle = "";
			$rpt_booking->arrival->CssClass = "";
			$rpt_booking->arrival->ViewCustomAttributes = "";

			// departure
			$rpt_booking->departure->ViewValue = $rpt_booking->departure->CurrentValue;
			$rpt_booking->departure->ViewValue = ew_FormatDateTime($rpt_booking->departure->ViewValue, 7);
			$rpt_booking->departure->CssStyle = "";
			$rpt_booking->departure->CssClass = "";
			$rpt_booking->departure->ViewCustomAttributes = "";

			// notes
			$rpt_booking->notes->ViewValue = $rpt_booking->notes->CurrentValue;
			$rpt_booking->notes->CssStyle = "";
			$rpt_booking->notes->CssClass = "";
			$rpt_booking->notes->ViewCustomAttributes = "";

			// confirmasi
			if (strval($rpt_booking->confirmasi->CurrentValue) <> "") {
				switch ($rpt_booking->confirmasi->CurrentValue) {
					case "0":
						$rpt_booking->confirmasi->ViewValue = "Belum";
						break;
					case "1":
						$rpt_booking->confirmasi->ViewValue = "Ya";
						break;
					case "2":
						$rpt_booking->confirmasi->ViewValue = "Batal";
						break;
					default:
						$rpt_booking->confirmasi->ViewValue = $rpt_booking->confirmasi->CurrentValue;
				}
			} else {
				$rpt_booking->confirmasi->ViewValue = NULL;
			}
			$rpt_booking->confirmasi->CssStyle = "";
			$rpt_booking->confirmasi->CssClass = "";
			$rpt_booking->confirmasi->ViewCustomAttributes = "";

			// checkin
			if (strval($rpt_booking->checkin->CurrentValue) <> "") {
				switch ($rpt_booking->checkin->CurrentValue) {
					case "0":
						$rpt_booking->checkin->ViewValue = "No";
						break;
					case "1":
						$rpt_booking->checkin->ViewValue = "Yes";
						break;
					default:
						$rpt_booking->checkin->ViewValue = $rpt_booking->checkin->CurrentValue;
				}
			} else {
				$rpt_booking->checkin->ViewValue = NULL;
			}
			$rpt_booking->checkin->CssStyle = "";
			$rpt_booking->checkin->CssClass = "";
			$rpt_booking->checkin->ViewCustomAttributes = "";

			// confirmdate
			$rpt_booking->confirmdate->ViewValue = $rpt_booking->confirmdate->CurrentValue;
			$rpt_booking->confirmdate->ViewValue = ew_FormatDateTime($rpt_booking->confirmdate->ViewValue, 7);
			$rpt_booking->confirmdate->CssStyle = "";
			$rpt_booking->confirmdate->CssClass = "";
			$rpt_booking->confirmdate->ViewCustomAttributes = "";

			// checkindate
			$rpt_booking->checkindate->ViewValue = $rpt_booking->checkindate->CurrentValue;
			$rpt_booking->checkindate->ViewValue = ew_FormatDateTime($rpt_booking->checkindate->ViewValue, 7);
			$rpt_booking->checkindate->CssStyle = "";
			$rpt_booking->checkindate->CssClass = "";
			$rpt_booking->checkindate->ViewCustomAttributes = "";

			// kode
			$rpt_booking->kode->HrefValue = "";

			// tanggal
			$rpt_booking->tanggal->HrefValue = "";

			// title
			$rpt_booking->title->HrefValue = "";

			// nama
			$rpt_booking->nama->HrefValue = "";

			// phone
			$rpt_booking->phone->HrefValue = "";

			// room
			$rpt_booking->room->HrefValue = "";

			// arrival
			$rpt_booking->arrival->HrefValue = "";

			// departure
			$rpt_booking->departure->HrefValue = "";

			// notes
			$rpt_booking->notes->HrefValue = "";

			// confirmasi
			$rpt_booking->confirmasi->HrefValue = "";

			// checkin
			$rpt_booking->checkin->HrefValue = "";

			// confirmdate
			$rpt_booking->confirmdate->HrefValue = "";

			// checkindate
			$rpt_booking->checkindate->HrefValue = "";
		} elseif ($rpt_booking->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$rpt_booking->kode->EditCustomAttributes = "";
			$rpt_booking->kode->EditValue = ew_HtmlEncode($rpt_booking->kode->AdvancedSearch->SearchValue);

			// tanggal
			$rpt_booking->tanggal->EditCustomAttributes = "";
			$rpt_booking->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rpt_booking->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// title
			$rpt_booking->title->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_name_title`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$rpt_booking->title->EditValue = $arwrk;

			// nama
			$rpt_booking->nama->EditCustomAttributes = "";
			$rpt_booking->nama->EditValue = ew_HtmlEncode($rpt_booking->nama->AdvancedSearch->SearchValue);

			// phone
			$rpt_booking->phone->EditCustomAttributes = "";
			$rpt_booking->phone->EditValue = ew_HtmlEncode($rpt_booking->phone->AdvancedSearch->SearchValue);

			// room
			$rpt_booking->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$rpt_booking->room->EditValue = $arwrk;

			// arrival
			$rpt_booking->arrival->EditCustomAttributes = "";
			$rpt_booking->arrival->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rpt_booking->arrival->AdvancedSearch->SearchValue, 7), 7));

			// departure
			$rpt_booking->departure->EditCustomAttributes = "";
			$rpt_booking->departure->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rpt_booking->departure->AdvancedSearch->SearchValue, 7), 7));

			// notes
			$rpt_booking->notes->EditCustomAttributes = "";
			$rpt_booking->notes->EditValue = ew_HtmlEncode($rpt_booking->notes->AdvancedSearch->SearchValue);

			// confirmasi
			$rpt_booking->confirmasi->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Ya");
			$arwrk[] = array("2", "Batal");
			array_unshift($arwrk, array("", "Please Select"));
			$rpt_booking->confirmasi->EditValue = $arwrk;

			// checkin
			$rpt_booking->checkin->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			array_unshift($arwrk, array("", "Please Select"));
			$rpt_booking->checkin->EditValue = $arwrk;

			// confirmdate
			$rpt_booking->confirmdate->EditCustomAttributes = "";
			$rpt_booking->confirmdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rpt_booking->confirmdate->AdvancedSearch->SearchValue, 7), 7));

			// checkindate
			$rpt_booking->checkindate->EditCustomAttributes = "";
			$rpt_booking->checkindate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rpt_booking->checkindate->AdvancedSearch->SearchValue, 7), 7));
		}

		// Call Row Rendered event
		$rpt_booking->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $rpt_booking;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($rpt_booking->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($rpt_booking->arrival->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Arrival";
		}
		if (!ew_CheckEuroDate($rpt_booking->departure->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Departure";
		}
		if (!ew_CheckEuroDate($rpt_booking->confirmdate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Confirmdate";
		}
		if (!ew_CheckEuroDate($rpt_booking->checkindate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Checkindate";
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
		global $rpt_booking;
		$rpt_booking->kode->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_kode");
		$rpt_booking->tanggal->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_tanggal");
		$rpt_booking->title->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_title");
		$rpt_booking->nama->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_nama");
		$rpt_booking->phone->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_phone");
		$rpt_booking->room->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_room");
		$rpt_booking->arrival->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_arrival");
		$rpt_booking->departure->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_departure");
		$rpt_booking->notes->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_notes");
		$rpt_booking->confirmasi->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_confirmasi");
		$rpt_booking->checkin->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_checkin");
		$rpt_booking->confirmdate->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_confirmdate");
		$rpt_booking->checkindate->AdvancedSearch->SearchValue = $rpt_booking->getAdvancedSearch("x_checkindate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $rpt_booking;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($rpt_booking->ExportAll) {
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
		if ($rpt_booking->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($rpt_booking->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $rpt_booking->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'title', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'nama', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'phone', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'room', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'arrival', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'departure', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'notes', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'confirmasi', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'checkin', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'confirmdate', $rpt_booking->Export);
				ew_ExportAddValue($sExportStr, 'checkindate', $rpt_booking->Export);
				echo ew_ExportLine($sExportStr, $rpt_booking->Export);
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
				$rpt_booking->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($rpt_booking->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $rpt_booking->kode->CurrentValue);
					$XmlDoc->AddField('tanggal', $rpt_booking->tanggal->CurrentValue);
					$XmlDoc->AddField('title', $rpt_booking->title->CurrentValue);
					$XmlDoc->AddField('nama', $rpt_booking->nama->CurrentValue);
					$XmlDoc->AddField('phone', $rpt_booking->phone->CurrentValue);
					$XmlDoc->AddField('room', $rpt_booking->room->CurrentValue);
					$XmlDoc->AddField('arrival', $rpt_booking->arrival->CurrentValue);
					$XmlDoc->AddField('departure', $rpt_booking->departure->CurrentValue);
					$XmlDoc->AddField('notes', $rpt_booking->notes->CurrentValue);
					$XmlDoc->AddField('confirmasi', $rpt_booking->confirmasi->CurrentValue);
					$XmlDoc->AddField('checkin', $rpt_booking->checkin->CurrentValue);
					$XmlDoc->AddField('confirmdate', $rpt_booking->confirmdate->CurrentValue);
					$XmlDoc->AddField('checkindate', $rpt_booking->checkindate->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $rpt_booking->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $rpt_booking->kode->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('tanggal', $rpt_booking->tanggal->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('title', $rpt_booking->title->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('nama', $rpt_booking->nama->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('phone', $rpt_booking->phone->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('room', $rpt_booking->room->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('arrival', $rpt_booking->arrival->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('departure', $rpt_booking->departure->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('notes', $rpt_booking->notes->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('confirmasi', $rpt_booking->confirmasi->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('checkin', $rpt_booking->checkin->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('confirmdate', $rpt_booking->confirmdate->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportField('checkindate', $rpt_booking->checkindate->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $rpt_booking->kode->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->tanggal->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->title->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->nama->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->phone->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->room->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->arrival->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->departure->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->notes->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->confirmasi->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->checkin->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->confirmdate->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						ew_ExportAddValue($sExportStr, $rpt_booking->checkindate->ExportValue($rpt_booking->Export, $rpt_booking->ExportOriginalValue), $rpt_booking->Export);
						echo ew_ExportLine($sExportStr, $rpt_booking->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($rpt_booking->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($rpt_booking->Export);
		}
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
