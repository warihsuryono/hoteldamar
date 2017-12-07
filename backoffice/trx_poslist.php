<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_posinfo.php" ?>
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
$trx_pos_list = new ctrx_pos_list();
$Page =& $trx_pos_list;

// Page init processing
$trx_pos_list->Page_Init();

// Page main processing
$trx_pos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trx_pos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_pos_list = new ew_Page("trx_pos_list");

// page properties
trx_pos_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_pos_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_pos_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_total_amount"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Total Amount");

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
trx_pos_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_pos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_pos_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($trx_pos->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_pos->Export == "" && $trx_pos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_pos_list->LoadRecordset();
	$trx_pos_list->lTotalRecs = ($bSelectLimit) ? $trx_pos->SelectRecordCount() : $rs->RecordCount();
	$trx_pos_list->lStartRec = 1;
	if ($trx_pos_list->lDisplayRecs <= 0) // Display all records
		$trx_pos_list->lDisplayRecs = $trx_pos_list->lTotalRecs;
	if (!($trx_pos->ExportAll && $trx_pos->Export <> ""))
		$trx_pos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_pos_list->LoadRecordset($trx_pos_list->lStartRec-1, $trx_pos_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Toko</b></h3>
<?php if ($trx_pos->Export == "" && $trx_pos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_pos_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_pos->Export == "" && $trx_pos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_pos_list);" style="text-decoration: none;"><img id="trx_pos_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_pos_list_SearchPanel">
<form name="ftrx_poslistsrch" id="ftrx_poslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_pos_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_pos">
<?php
if ($gsSearchError == "")
	$trx_pos_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_pos->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_pos_list->RenderRow();

?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="10" maxlength="10" value="<?php echo $trx_pos->kode->EditValue ?>"<?php echo $trx_pos->kode->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_pos->tanggal->EditValue ?>"<?php echo $trx_pos->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Kode Booking</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodebooking" id="z_kodebooking" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodebooking" id="x_kodebooking" size="20" maxlength="20" value="<?php echo $trx_pos->kodebooking->EditValue ?>"<?php echo $trx_pos->kodebooking->EditAttributes() ?>>
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
<select id="x_room" name="x_room"<?php echo $trx_pos->room->EditAttributes() ?>>
<?php
if (is_array($trx_pos->room->EditValue)) {
	$arwrk = $trx_pos->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_pos->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_nama" id="x_nama" size="50" maxlength="50" value="<?php echo $trx_pos->nama->EditValue ?>"<?php echo $trx_pos->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Total Amount</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_total_amount" id="z_total_amount" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_total_amount" id="x_total_amount" size="30" value="<?php echo $trx_pos->total_amount->EditValue ?>"<?php echo $trx_pos->total_amount->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Card No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_cardno" id="z_cardno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_cardno" id="x_cardno" size="30" maxlength="50" value="<?php echo $trx_pos->cardno->EditValue ?>"<?php echo $trx_pos->cardno->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Paid</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_paid" id="z_paid" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_paid" name="x_paid"<?php echo $trx_pos->paid->EditAttributes() ?>>
<?php
if (is_array($trx_pos->paid->EditValue)) {
	$arwrk = $trx_pos->paid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_pos->paid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Create By</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_updateby" id="z_updateby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_updateby" name="x_updateby"<?php echo $trx_pos->updateby->EditAttributes() ?>>
<?php
if (is_array($trx_pos->updateby->EditValue)) {
	$arwrk = $trx_pos->updateby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_pos->updateby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($trx_pos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $trx_pos_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $trx_pos_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($trx_pos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($trx_pos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($trx_pos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_pos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_pos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_pos->CurrentAction <> "gridadd" && $trx_pos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_pos_list->Pager)) $trx_pos_list->Pager = new cPrevNextPager($trx_pos_list->lStartRec, $trx_pos_list->lDisplayRecs, $trx_pos_list->lTotalRecs) ?>
<?php if ($trx_pos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_pos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_pos_list->PageUrl() ?>start=<?php echo $trx_pos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_pos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_pos_list->PageUrl() ?>start=<?php echo $trx_pos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_pos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_pos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_pos_list->PageUrl() ?>start=<?php echo $trx_pos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_pos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_pos_list->PageUrl() ?>start=<?php echo $trx_pos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_pos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_pos_list->Pager->FromIndex ?> to <?php echo $trx_pos_list->Pager->ToIndex ?> of <?php echo $trx_pos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_pos_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_pos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_pos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_pos_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_pos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_pos_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_pos_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_pos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_pos_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $trx_pos->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_poslist" id="ftrx_poslist" class="ewForm" action="" method="post">
<?php if ($trx_pos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_pos_list->lOptionCnt = 0;
	$trx_pos_list->lOptionCnt++; // view
	$trx_pos_list->lOptionCnt++; // edit
	$trx_pos_list->lOptionCnt += count($trx_pos_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_pos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_pos->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_pos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_pos->kode->Visible) { // kode ?>
	<?php if ($trx_pos->SortUrl($trx_pos->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_pos->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_pos->SortUrl($trx_pos->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_pos->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->kodebooking->Visible) { // kodebooking ?>
	<?php if ($trx_pos->SortUrl($trx_pos->kodebooking) == "") { ?>
		<td style="white-space: nowrap;">Kode Booking</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->kodebooking) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Booking</td><td style="width: 10px;"><?php if ($trx_pos->kodebooking->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->kodebooking->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->room->Visible) { // room ?>
	<?php if ($trx_pos->SortUrl($trx_pos->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($trx_pos->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->nama->Visible) { // nama ?>
	<?php if ($trx_pos->SortUrl($trx_pos->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($trx_pos->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->total_amount->Visible) { // total_amount ?>
	<?php if ($trx_pos->SortUrl($trx_pos->total_amount) == "") { ?>
		<td style="white-space: nowrap;">Total Amount</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->total_amount) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Total Amount</td><td style="width: 10px;"><?php if ($trx_pos->total_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->total_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->jenis_bayar->Visible) { // jenis_bayar ?>
	<?php if ($trx_pos->SortUrl($trx_pos->jenis_bayar) == "") { ?>
		<td style="white-space: nowrap;">Jenis Bayar</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->jenis_bayar) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Jenis Bayar</td><td style="width: 10px;"><?php if ($trx_pos->jenis_bayar->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->jenis_bayar->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->cardno->Visible) { // cardno ?>
	<?php if ($trx_pos->SortUrl($trx_pos->cardno) == "") { ?>
		<td style="white-space: nowrap;">Card No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->cardno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Card No</td><td style="width: 10px;"><?php if ($trx_pos->cardno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->cardno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->paid->Visible) { // paid ?>
	<?php if ($trx_pos->SortUrl($trx_pos->paid) == "") { ?>
		<td style="white-space: nowrap;">Paid</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->paid) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Paid</td><td style="width: 10px;"><?php if ($trx_pos->paid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->paid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_pos->updateby->Visible) { // updateby ?>
	<?php if ($trx_pos->SortUrl($trx_pos->updateby) == "") { ?>
		<td style="white-space: nowrap;">Create By</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_pos->SortUrl($trx_pos->updateby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create By</td><td style="width: 10px;"><?php if ($trx_pos->updateby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_pos->updateby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_pos->ExportAll && $trx_pos->Export <> "") {
	$trx_pos_list->lStopRec = $trx_pos_list->lTotalRecs;
} else {
	$trx_pos_list->lStopRec = $trx_pos_list->lStartRec + $trx_pos_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_pos_list->lRecCount = $trx_pos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_pos->SelectLimit && $trx_pos_list->lStartRec > 1)
		$rs->Move($trx_pos_list->lStartRec - 1);
}
$trx_pos_list->lRowCnt = 0;
while (($trx_pos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_pos_list->lRecCount < $trx_pos_list->lStopRec) {
	$trx_pos_list->lRecCount++;
	if (intval($trx_pos_list->lRecCount) >= intval($trx_pos_list->lStartRec)) {
		$trx_pos_list->lRowCnt++;

	// Init row class and style
	$trx_pos->CssClass = "";
	$trx_pos->CssStyle = "";
	$trx_pos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_pos->CurrentAction == "gridadd") {
		$trx_pos_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_pos_list->LoadRowValues($rs); // Load row values
	}
	$trx_pos->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_pos_list->RenderRow();
	if($trx_pos->paid->ListViewValue()=="Belum"){$bgcolorpaid="red";}else{$bgcolorpaid="";}
?>
	<tr<?php echo $trx_pos->RowAttributes() ?>>
<?php if ($trx_pos->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a onclick="window.open('pos_faktur.php?kode=<?php echo $trx_pos->kode->ListViewValue();?>','pos_faktur.php?kode=<?php echo $trx_pos->kode->ListViewValue();?>','width=350,height=500,menubar=yes,scrollbars=yes');"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="trx_posadd.php?kode=<?php echo $trx_pos->kode->ListViewValue();?>&editing=1"><img src="images/inlineedit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($trx_pos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_pos->kode->Visible) { // kode ?>
		<td<?php echo $trx_pos->kode->CellAttributes() ?>>
<div<?php echo $trx_pos->kode->ViewAttributes() ?>><?php echo $trx_pos->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_pos->tanggal->CellAttributes() ?>>
<div<?php echo $trx_pos->tanggal->ViewAttributes() ?>><?php echo $trx_pos->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->kodebooking->Visible) { // kodebooking ?>
		<td<?php echo $trx_pos->kodebooking->CellAttributes() ?>>
<div<?php echo $trx_pos->kodebooking->ViewAttributes() ?>><?php echo $trx_pos->kodebooking->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->room->Visible) { // room ?>
		<td<?php echo $trx_pos->room->CellAttributes() ?>>
<div<?php echo $trx_pos->room->ViewAttributes() ?>><?php echo $trx_pos->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->nama->Visible) { // nama ?>
		<td<?php echo $trx_pos->nama->CellAttributes() ?>>
<div<?php echo $trx_pos->nama->ViewAttributes() ?>><?php echo $trx_pos->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->total_amount->Visible) { // total_amount ?>
		<td<?php echo $trx_pos->total_amount->CellAttributes() ?>>
<div<?php echo $trx_pos->total_amount->ViewAttributes() ?>><?php echo $trx_pos->total_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->jenis_bayar->Visible) { // jenis_bayar ?>
		<td<?php echo $trx_pos->jenis_bayar->CellAttributes() ?>>
<div<?php echo $trx_pos->jenis_bayar->ViewAttributes() ?>><?php echo $trx_pos->jenis_bayar->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->cardno->Visible) { // cardno ?>
		<td<?php echo $trx_pos->cardno->CellAttributes() ?>>
<div<?php echo $trx_pos->cardno->ViewAttributes() ?>><?php echo $trx_pos->cardno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->paid->Visible) { // paid ?>
		<td bgcolor="<?php echo $bgcolorpaid; ?>" <?php echo $trx_pos->paid->CellAttributes() ?>>
<div<?php echo $trx_pos->paid->ViewAttributes() ?>><?php echo $trx_pos->paid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_pos->updateby->Visible) { // updateby ?>
		<td<?php echo $trx_pos->updateby->CellAttributes() ?>>
<div<?php echo $trx_pos->updateby->ViewAttributes() ?>><?php echo $trx_pos->updateby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_pos->CurrentAction <> "gridadd")
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
<?php if ($trx_pos->Export == "" && $trx_pos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_pos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($trx_pos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$trx_pos_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_pos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_pos';

	// Page Object Name
	var $PageObjName = 'trx_pos_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_pos;
		if ($trx_pos->UseTokenInUrl) $PageUrl .= "t=" . $trx_pos->TableVar . "&"; // add page token
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
		global $objForm, $trx_pos;
		if ($trx_pos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_pos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_pos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_pos_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_pos"] = new ctrx_pos();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_pos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_pos;
	$trx_pos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_pos->Export; // Get export parameter, used in header
	$gsExportFile = $trx_pos->TableVar; // Get export file, used in header
	if ($trx_pos->Export == "print" || $trx_pos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
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
		global $objForm, $gsSearchError, $Security, $trx_pos;
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

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($trx_pos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_pos->getRecordsPerPage(); // Restore from Session
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
		$trx_pos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_pos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_pos->setStartRecordNumber($this->lStartRec);
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
		$trx_pos->setSessionWhere($sFilter);
		$trx_pos->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_pos;
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
			$trx_pos->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_pos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_pos;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_pos->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_pos->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_pos->kodebooking, FALSE); // Field kodebooking
		$this->BuildSearchSql($sWhere, $trx_pos->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $trx_pos->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $trx_pos->total_amount, FALSE); // Field total_amount
		$this->BuildSearchSql($sWhere, $trx_pos->jenis_bayar, FALSE); // Field jenis_bayar
		$this->BuildSearchSql($sWhere, $trx_pos->cardno, FALSE); // Field cardno
		$this->BuildSearchSql($sWhere, $trx_pos->paid, FALSE); // Field paid
		$this->BuildSearchSql($sWhere, $trx_pos->returno, FALSE); // Field returno
		$this->BuildSearchSql($sWhere, $trx_pos->outlet, FALSE); // Field outlet
		$this->BuildSearchSql($sWhere, $trx_pos->kodetrx, FALSE); // Field kodetrx
		$this->BuildSearchSql($sWhere, $trx_pos->disc_member, FALSE); // Field disc_member
		$this->BuildSearchSql($sWhere, $trx_pos->disc_special, FALSE); // Field disc_special
		$this->BuildSearchSql($sWhere, $trx_pos->totaldisc, FALSE); // Field totaldisc
		$this->BuildSearchSql($sWhere, $trx_pos->pembayaran, FALSE); // Field pembayaran
		$this->BuildSearchSql($sWhere, $trx_pos->updateby, FALSE); // Field updateby
		$this->BuildSearchSql($sWhere, $trx_pos->updatedate, FALSE); // Field updatedate
		$this->BuildSearchSql($sWhere, $trx_pos->idseqno, FALSE); // Field idseqno

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_pos->kode); // Field kode
			$this->SetSearchParm($trx_pos->tanggal); // Field tanggal
			$this->SetSearchParm($trx_pos->kodebooking); // Field kodebooking
			$this->SetSearchParm($trx_pos->room); // Field room
			$this->SetSearchParm($trx_pos->nama); // Field nama
			$this->SetSearchParm($trx_pos->total_amount); // Field total_amount
			$this->SetSearchParm($trx_pos->jenis_bayar); // Field jenis_bayar
			$this->SetSearchParm($trx_pos->cardno); // Field cardno
			$this->SetSearchParm($trx_pos->paid); // Field paid
			$this->SetSearchParm($trx_pos->returno); // Field returno
			$this->SetSearchParm($trx_pos->outlet); // Field outlet
			$this->SetSearchParm($trx_pos->kodetrx); // Field kodetrx
			$this->SetSearchParm($trx_pos->disc_member); // Field disc_member
			$this->SetSearchParm($trx_pos->disc_special); // Field disc_special
			$this->SetSearchParm($trx_pos->totaldisc); // Field totaldisc
			$this->SetSearchParm($trx_pos->pembayaran); // Field pembayaran
			$this->SetSearchParm($trx_pos->updateby); // Field updateby
			$this->SetSearchParm($trx_pos->updatedate); // Field updatedate
			$this->SetSearchParm($trx_pos->idseqno); // Field idseqno
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
		global $trx_pos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_pos->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_pos->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_pos->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_pos->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_pos->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $trx_pos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $trx_pos->jenis_bayar->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $trx_pos;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$trx_pos->setBasicSearchKeyword($sSearchKeyword);
			$trx_pos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $trx_pos;
		$this->sSrchWhere = "";
		$trx_pos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $trx_pos;
		$trx_pos->setBasicSearchKeyword("");
		$trx_pos->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_pos;
		$trx_pos->setAdvancedSearch("x_kode", "");
		$trx_pos->setAdvancedSearch("x_tanggal", "");
		$trx_pos->setAdvancedSearch("x_kodebooking", "");
		$trx_pos->setAdvancedSearch("x_room", "");
		$trx_pos->setAdvancedSearch("x_nama", "");
		$trx_pos->setAdvancedSearch("x_total_amount", "");
		$trx_pos->setAdvancedSearch("x_jenis_bayar", "");
		$trx_pos->setAdvancedSearch("x_cardno", "");
		$trx_pos->setAdvancedSearch("x_paid", "");
		$trx_pos->setAdvancedSearch("x_returno", "");
		$trx_pos->setAdvancedSearch("x_outlet", "");
		$trx_pos->setAdvancedSearch("x_kodetrx", "");
		$trx_pos->setAdvancedSearch("x_disc_member", "");
		$trx_pos->setAdvancedSearch("x_disc_special", "");
		$trx_pos->setAdvancedSearch("x_totaldisc", "");
		$trx_pos->setAdvancedSearch("x_pembayaran", "");
		$trx_pos->setAdvancedSearch("x_updateby", "");
		$trx_pos->setAdvancedSearch("x_updatedate", "");
		$trx_pos->setAdvancedSearch("x_idseqno", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_pos;
		$this->sSrchWhere = $trx_pos->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_pos;
		 $trx_pos->kode->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kode");
		 $trx_pos->tanggal->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_tanggal");
		 $trx_pos->kodebooking->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kodebooking");
		 $trx_pos->room->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_room");
		 $trx_pos->nama->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_nama");
		 $trx_pos->total_amount->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_total_amount");
		 $trx_pos->jenis_bayar->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_jenis_bayar");
		 $trx_pos->cardno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_cardno");
		 $trx_pos->paid->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_paid");
		 $trx_pos->returno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_returno");
		 $trx_pos->outlet->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_outlet");
		 $trx_pos->kodetrx->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kodetrx");
		 $trx_pos->disc_member->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_disc_member");
		 $trx_pos->disc_special->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_disc_special");
		 $trx_pos->totaldisc->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_totaldisc");
		 $trx_pos->pembayaran->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_pembayaran");
		 $trx_pos->updateby->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_updateby");
		 $trx_pos->updatedate->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_updatedate");
		 $trx_pos->idseqno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_idseqno");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_pos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_pos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_pos->CurrentOrderType = @$_GET["ordertype"];
			$trx_pos->UpdateSort($trx_pos->kode); // Field 
			$trx_pos->UpdateSort($trx_pos->tanggal); // Field 
			$trx_pos->UpdateSort($trx_pos->kodebooking); // Field 
			$trx_pos->UpdateSort($trx_pos->room); // Field 
			$trx_pos->UpdateSort($trx_pos->nama); // Field 
			$trx_pos->UpdateSort($trx_pos->total_amount); // Field 
			$trx_pos->UpdateSort($trx_pos->jenis_bayar); // Field 
			$trx_pos->UpdateSort($trx_pos->cardno); // Field 
			$trx_pos->UpdateSort($trx_pos->paid); // Field 
			$trx_pos->UpdateSort($trx_pos->updateby); // Field 
			$trx_pos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_pos;
		$sOrderBy = $trx_pos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_pos->SqlOrderBy() <> "") {
				$sOrderBy = $trx_pos->SqlOrderBy();
				$trx_pos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_pos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_pos->setSessionOrderBy($sOrderBy);
				$trx_pos->kode->setSort("");
				$trx_pos->tanggal->setSort("");
				$trx_pos->kodebooking->setSort("");
				$trx_pos->room->setSort("");
				$trx_pos->nama->setSort("");
				$trx_pos->total_amount->setSort("");
				$trx_pos->jenis_bayar->setSort("");
				$trx_pos->cardno->setSort("");
				$trx_pos->paid->setSort("");
				$trx_pos->updateby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_pos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_pos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_pos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_pos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_pos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_pos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_pos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_pos->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_pos;

		// Load search values
		// kode

		$trx_pos->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_pos->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// tanggal
		$trx_pos->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_pos->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// kodebooking
		$trx_pos->kodebooking->AdvancedSearch->SearchValue = @$_GET["x_kodebooking"];
		$trx_pos->kodebooking->AdvancedSearch->SearchOperator = @$_GET["z_kodebooking"];

		// room
		$trx_pos->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$trx_pos->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// nama
		$trx_pos->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$trx_pos->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// total_amount
		$trx_pos->total_amount->AdvancedSearch->SearchValue = @$_GET["x_total_amount"];
		$trx_pos->total_amount->AdvancedSearch->SearchOperator = @$_GET["z_total_amount"];

		// jenis_bayar
		$trx_pos->jenis_bayar->AdvancedSearch->SearchValue = @$_GET["x_jenis_bayar"];
		$trx_pos->jenis_bayar->AdvancedSearch->SearchOperator = @$_GET["z_jenis_bayar"];

		// cardno
		$trx_pos->cardno->AdvancedSearch->SearchValue = @$_GET["x_cardno"];
		$trx_pos->cardno->AdvancedSearch->SearchOperator = @$_GET["z_cardno"];

		// paid
		$trx_pos->paid->AdvancedSearch->SearchValue = @$_GET["x_paid"];
		$trx_pos->paid->AdvancedSearch->SearchOperator = @$_GET["z_paid"];

		// returno
		$trx_pos->returno->AdvancedSearch->SearchValue = @$_GET["x_returno"];
		$trx_pos->returno->AdvancedSearch->SearchOperator = @$_GET["z_returno"];

		// outlet
		$trx_pos->outlet->AdvancedSearch->SearchValue = @$_GET["x_outlet"];
		$trx_pos->outlet->AdvancedSearch->SearchOperator = @$_GET["z_outlet"];

		// kodetrx
		$trx_pos->kodetrx->AdvancedSearch->SearchValue = @$_GET["x_kodetrx"];
		$trx_pos->kodetrx->AdvancedSearch->SearchOperator = @$_GET["z_kodetrx"];

		// disc_member
		$trx_pos->disc_member->AdvancedSearch->SearchValue = @$_GET["x_disc_member"];
		$trx_pos->disc_member->AdvancedSearch->SearchOperator = @$_GET["z_disc_member"];

		// disc_special
		$trx_pos->disc_special->AdvancedSearch->SearchValue = @$_GET["x_disc_special"];
		$trx_pos->disc_special->AdvancedSearch->SearchOperator = @$_GET["z_disc_special"];

		// totaldisc
		$trx_pos->totaldisc->AdvancedSearch->SearchValue = @$_GET["x_totaldisc"];
		$trx_pos->totaldisc->AdvancedSearch->SearchOperator = @$_GET["z_totaldisc"];

		// pembayaran
		$trx_pos->pembayaran->AdvancedSearch->SearchValue = @$_GET["x_pembayaran"];
		$trx_pos->pembayaran->AdvancedSearch->SearchOperator = @$_GET["z_pembayaran"];

		// updateby
		$trx_pos->updateby->AdvancedSearch->SearchValue = @$_GET["x_updateby"];
		$trx_pos->updateby->AdvancedSearch->SearchOperator = @$_GET["z_updateby"];

		// updatedate
		$trx_pos->updatedate->AdvancedSearch->SearchValue = @$_GET["x_updatedate"];
		$trx_pos->updatedate->AdvancedSearch->SearchOperator = @$_GET["z_updatedate"];

		// idseqno
		$trx_pos->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$trx_pos->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_pos;

		// Call Recordset Selecting event
		$trx_pos->Recordset_Selecting($trx_pos->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_pos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_pos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_pos;
		$sFilter = $trx_pos->KeyFilter();

		// Call Row Selecting event
		$trx_pos->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_pos->CurrentFilter = $sFilter;
		$sSql = $trx_pos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_pos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_pos;
		$trx_pos->kode->setDbValue($rs->fields('kode'));
		$trx_pos->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_pos->kodebooking->setDbValue($rs->fields('kodebooking'));
		$trx_pos->room->setDbValue($rs->fields('room'));
		$trx_pos->nama->setDbValue($rs->fields('nama'));
		$trx_pos->total_amount->setDbValue($rs->fields('total_amount'));
		$trx_pos->jenis_bayar->setDbValue($rs->fields('jenis_bayar'));
		$trx_pos->cardno->setDbValue($rs->fields('cardno'));
		$trx_pos->paid->setDbValue($rs->fields('paid'));
		$trx_pos->returno->setDbValue($rs->fields('returno'));
		$trx_pos->outlet->setDbValue($rs->fields('outlet'));
		$trx_pos->kodetrx->setDbValue($rs->fields('kodetrx'));
		$trx_pos->disc_member->setDbValue($rs->fields('disc_member'));
		$trx_pos->disc_special->setDbValue($rs->fields('disc_special'));
		$trx_pos->totaldisc->setDbValue($rs->fields('totaldisc'));
		$trx_pos->pembayaran->setDbValue($rs->fields('pembayaran'));
		$trx_pos->updateby->setDbValue($rs->fields('updateby'));
		$trx_pos->updatedate->setDbValue($rs->fields('updatedate'));
		$trx_pos->idseqno->setDbValue($rs->fields('idseqno'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_pos;

		// Call Row_Rendering event
		$trx_pos->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_pos->kode->CellCssStyle = "white-space: nowrap;";
		$trx_pos->kode->CellCssClass = "";

		// tanggal
		$trx_pos->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_pos->tanggal->CellCssClass = "";

		// kodebooking
		$trx_pos->kodebooking->CellCssStyle = "white-space: nowrap;";
		$trx_pos->kodebooking->CellCssClass = "";

		// room
		$trx_pos->room->CellCssStyle = "white-space: nowrap;";
		$trx_pos->room->CellCssClass = "";

		// nama
		$trx_pos->nama->CellCssStyle = "white-space: nowrap;";
		$trx_pos->nama->CellCssClass = "";

		// total_amount
		$trx_pos->total_amount->CellCssStyle = "white-space: nowrap;";
		$trx_pos->total_amount->CellCssClass = "";

		// jenis_bayar
		$trx_pos->jenis_bayar->CellCssStyle = "white-space: nowrap;";
		$trx_pos->jenis_bayar->CellCssClass = "";

		// cardno
		$trx_pos->cardno->CellCssStyle = "white-space: nowrap;";
		$trx_pos->cardno->CellCssClass = "";

		// paid
		$trx_pos->paid->CellCssStyle = "white-space: nowrap;";
		$trx_pos->paid->CellCssClass = "";

		// updateby
		$trx_pos->updateby->CellCssStyle = "white-space: nowrap;";
		$trx_pos->updateby->CellCssClass = "";
		if ($trx_pos->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_pos->kode->ViewValue = $trx_pos->kode->CurrentValue;
			$trx_pos->kode->CssStyle = "";
			$trx_pos->kode->CssClass = "";
			$trx_pos->kode->ViewCustomAttributes = "";

			// tanggal
			$trx_pos->tanggal->ViewValue = $trx_pos->tanggal->CurrentValue;
			$trx_pos->tanggal->ViewValue = ew_FormatDateTime($trx_pos->tanggal->ViewValue, 7);
			$trx_pos->tanggal->CssStyle = "";
			$trx_pos->tanggal->CssClass = "";
			$trx_pos->tanggal->ViewCustomAttributes = "";

			// kodebooking
			$trx_pos->kodebooking->ViewValue = $trx_pos->kodebooking->CurrentValue;
			$trx_pos->kodebooking->CssStyle = "";
			$trx_pos->kodebooking->CssClass = "";
			$trx_pos->kodebooking->ViewCustomAttributes = "";

			// room
			if (strval($trx_pos->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($trx_pos->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_pos->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_pos->room->ViewValue = $trx_pos->room->CurrentValue;
				}
			} else {
				$trx_pos->room->ViewValue = NULL;
			}
			$trx_pos->room->CssStyle = "";
			$trx_pos->room->CssClass = "";
			$trx_pos->room->ViewCustomAttributes = "";

			// nama
			$trx_pos->nama->ViewValue = $trx_pos->nama->CurrentValue;
			$trx_pos->nama->CssStyle = "";
			$trx_pos->nama->CssClass = "";
			$trx_pos->nama->ViewCustomAttributes = "";

			// total_amount
			$trx_pos->total_amount->ViewValue = $trx_pos->total_amount->CurrentValue;
			$trx_pos->total_amount->ViewValue = ew_FormatNumber($trx_pos->total_amount->ViewValue, 0, -2, -2, -2);
			$trx_pos->total_amount->CssStyle = "text-align:right;";
			$trx_pos->total_amount->CssClass = "";
			$trx_pos->total_amount->ViewCustomAttributes = "";

			// jenis_bayar
			if (strval($trx_pos->jenis_bayar->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_pay_type` WHERE `kode` = '" . ew_AdjustSql($trx_pos->jenis_bayar->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_pos->jenis_bayar->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_pos->jenis_bayar->ViewValue = $trx_pos->jenis_bayar->CurrentValue;
				}
			} else {
				$trx_pos->jenis_bayar->ViewValue = NULL;
			}
			$trx_pos->jenis_bayar->CssStyle = "";
			$trx_pos->jenis_bayar->CssClass = "";
			$trx_pos->jenis_bayar->ViewCustomAttributes = "";

			// cardno
			$trx_pos->cardno->ViewValue = $trx_pos->cardno->CurrentValue;
			$trx_pos->cardno->CssStyle = "";
			$trx_pos->cardno->CssClass = "";
			$trx_pos->cardno->ViewCustomAttributes = "";

			// paid
			if (strval($trx_pos->paid->CurrentValue) <> "") {
				switch ($trx_pos->paid->CurrentValue) {
					case "0":
						$trx_pos->paid->ViewValue = "Belum";
						break;
					case "1":
						$trx_pos->paid->ViewValue = "Sudah";
						break;
					case "2":
						$trx_pos->paid->ViewValue = "With Room";
						break;
					default:
						$trx_pos->paid->ViewValue = $trx_pos->paid->CurrentValue;
				}
			} else {
				$trx_pos->paid->ViewValue = NULL;
			}
			$trx_pos->paid->CssStyle = "";
			$trx_pos->paid->CssClass = "";
			$trx_pos->paid->ViewCustomAttributes = "";

			// updateby
			if (strval($trx_pos->updateby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($trx_pos->updateby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_pos->updateby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_pos->updateby->ViewValue = $trx_pos->updateby->CurrentValue;
				}
			} else {
				$trx_pos->updateby->ViewValue = NULL;
			}
			$trx_pos->updateby->CssStyle = "";
			$trx_pos->updateby->CssClass = "";
			$trx_pos->updateby->ViewCustomAttributes = "";

			// kode
			$trx_pos->kode->HrefValue = "";

			// tanggal
			$trx_pos->tanggal->HrefValue = "";

			// kodebooking
			$trx_pos->kodebooking->HrefValue = "";

			// room
			$trx_pos->room->HrefValue = "";

			// nama
			$trx_pos->nama->HrefValue = "";

			// total_amount
			$trx_pos->total_amount->HrefValue = "";

			// jenis_bayar
			$trx_pos->jenis_bayar->HrefValue = "";

			// cardno
			$trx_pos->cardno->HrefValue = "";

			// paid
			$trx_pos->paid->HrefValue = "";

			// updateby
			$trx_pos->updateby->HrefValue = "";
		} elseif ($trx_pos->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_pos->kode->EditCustomAttributes = "";
			$trx_pos->kode->EditValue = ew_HtmlEncode($trx_pos->kode->AdvancedSearch->SearchValue);

			// tanggal
			$trx_pos->tanggal->EditCustomAttributes = "";
			$trx_pos->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_pos->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// kodebooking
			$trx_pos->kodebooking->EditCustomAttributes = "";
			$trx_pos->kodebooking->EditValue = ew_HtmlEncode($trx_pos->kodebooking->AdvancedSearch->SearchValue);

			// room
			$trx_pos->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_pos->room->EditValue = $arwrk;

			// nama
			$trx_pos->nama->EditCustomAttributes = "";
			$trx_pos->nama->EditValue = ew_HtmlEncode($trx_pos->nama->AdvancedSearch->SearchValue);

			// total_amount
			$trx_pos->total_amount->EditCustomAttributes = "";
			$trx_pos->total_amount->EditValue = ew_HtmlEncode($trx_pos->total_amount->AdvancedSearch->SearchValue);

			// jenis_bayar
			$trx_pos->jenis_bayar->EditCustomAttributes = "";

			// cardno
			$trx_pos->cardno->EditCustomAttributes = "";
			$trx_pos->cardno->EditValue = ew_HtmlEncode($trx_pos->cardno->AdvancedSearch->SearchValue);

			// paid
			$trx_pos->paid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sudah");
			$arwrk[] = array("2", "With Room");
			array_unshift($arwrk, array("", "Please Select"));
			$trx_pos->paid->EditValue = $arwrk;

			// updateby
			$trx_pos->updateby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_pos->updateby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$trx_pos->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_pos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_pos->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckNumber($trx_pos->total_amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Total Amount";
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
		global $trx_pos;
		$trx_pos->kode->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kode");
		$trx_pos->tanggal->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_tanggal");
		$trx_pos->kodebooking->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kodebooking");
		$trx_pos->room->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_room");
		$trx_pos->nama->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_nama");
		$trx_pos->total_amount->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_total_amount");
		$trx_pos->jenis_bayar->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_jenis_bayar");
		$trx_pos->cardno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_cardno");
		$trx_pos->paid->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_paid");
		$trx_pos->returno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_returno");
		$trx_pos->outlet->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_outlet");
		$trx_pos->kodetrx->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_kodetrx");
		$trx_pos->disc_member->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_disc_member");
		$trx_pos->disc_special->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_disc_special");
		$trx_pos->totaldisc->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_totaldisc");
		$trx_pos->pembayaran->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_pembayaran");
		$trx_pos->updateby->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_updateby");
		$trx_pos->updatedate->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_updatedate");
		$trx_pos->idseqno->AdvancedSearch->SearchValue = $trx_pos->getAdvancedSearch("x_idseqno");
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
