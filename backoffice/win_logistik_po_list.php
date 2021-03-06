<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "win_logistik_po_info.php" ?>
<?php include "userfn6.php" ?>
<?php include "func_showparent_win.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$win_logistik_po__list = new cwin_logistik_po__list();
$Page =& $win_logistik_po__list;

// Page init processing
$win_logistik_po__list->Page_Init();

// Page main processing
$win_logistik_po__list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($win_logistik_po_->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var win_logistik_po__list = new ew_Page("win_logistik_po__list");

// page properties
win_logistik_po__list.PageID = "list"; // page ID
var EW_PAGE_ID = win_logistik_po__list.PageID; // for backward compatibility

// extend page with validate function for search
win_logistik_po__list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");

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
win_logistik_po__list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
win_logistik_po__list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
win_logistik_po__list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
win_logistik_po__list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($win_logistik_po_->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($win_logistik_po_->Export == "" && $win_logistik_po_->SelectLimit);
	if (!$bSelectLimit)
		$rs = $win_logistik_po__list->LoadRecordset();
	$win_logistik_po__list->lTotalRecs = ($bSelectLimit) ? $win_logistik_po_->SelectRecordCount() : $rs->RecordCount();
	$win_logistik_po__list->lStartRec = 1;
	if ($win_logistik_po__list->lDisplayRecs <= 0) // Display all records
		$win_logistik_po__list->lDisplayRecs = $win_logistik_po__list->lTotalRecs;
	if (!($win_logistik_po_->ExportAll && $win_logistik_po_->Export <> ""))
		$win_logistik_po__list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $win_logistik_po__list->LoadRecordset($win_logistik_po__list->lStartRec-1, $win_logistik_po__list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">win logistik po
<?php if ($win_logistik_po_->Export == "" && $win_logistik_po_->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_po__list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($win_logistik_po_->Export == "" && $win_logistik_po_->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(win_logistik_po__list);" style="text-decoration: none;"><img id="win_logistik_po__list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="win_logistik_po__list_SearchPanel">
<form name="fwin_logistik_po_listsrch" id="fwin_logistik_po_listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return win_logistik_po__list.ValidateSearch(this);">
<?php echo $__urlgetshidden;?>
<input type="hidden" id="t" name="t" value="win_logistik_po_">
<?php
if ($gsSearchError == "")
	$win_logistik_po__list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$win_logistik_po_->RowType = EW_ROWTYPE_SEARCH;

// Render row
$win_logistik_po__list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">PO No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_pono" id="z_pono" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_pono" id="x_pono" size="30" maxlength="30" value="<?php echo $win_logistik_po_->pono->EditValue ?>"<?php echo $win_logistik_po_->pono->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $win_logistik_po_->tanggal->EditValue ?>"<?php echo $win_logistik_po_->tanggal->EditAttributes() ?>>
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
	<!--tr>
		<td><span class="phpmaker">Kode Pekerjaan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode_pekerjaan" id="z_kode_pekerjaan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $win_logistik_po_->kode_pekerjaan->EditValue ?>"<?php echo $win_logistik_po_->kode_pekerjaan->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr-->
	<tr>
		<td><span class="phpmaker">Permohonan Dana</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodepermohonan" id="z_kodepermohonan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodepermohonan" id="x_kodepermohonan" size="30" maxlength="30" value="<?php echo $win_logistik_po_->kodepermohonan->EditValue ?>"<?php echo $win_logistik_po_->kodepermohonan->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Supplier</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_vendorid" id="z_vendorid" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_vendorid" name="x_vendorid"<?php echo $win_logistik_po_->vendorid->EditAttributes() ?>>
<?php
if (is_array($win_logistik_po_->vendorid->EditValue)) {
	$arwrk = $win_logistik_po_->vendorid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_logistik_po_->vendorid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $win_logistik_po__list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $win_logistik_po__list->PageUrl() ?><?php echo $__urlgets; ?>&cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $win_logistik_po__list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($win_logistik_po_->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($win_logistik_po_->CurrentAction <> "gridadd" && $win_logistik_po_->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php echo $__urlgetshidden;?>
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($win_logistik_po__list->Pager)) $win_logistik_po__list->Pager = new cPrevNextPager($win_logistik_po__list->lStartRec, $win_logistik_po__list->lDisplayRecs, $win_logistik_po__list->lTotalRecs) ?>
<?php if ($win_logistik_po__list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($win_logistik_po__list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_po__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_po__list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($win_logistik_po__list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_po__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_po__list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $win_logistik_po__list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($win_logistik_po__list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_po__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_po__list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($win_logistik_po__list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_po__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_po__list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $win_logistik_po__list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $win_logistik_po__list->Pager->FromIndex ?> to <?php echo $win_logistik_po__list->Pager->ToIndex ?> of <?php echo $win_logistik_po__list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($win_logistik_po__list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($win_logistik_po__list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="win_logistik_po_">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($win_logistik_po__list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($win_logistik_po__list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($win_logistik_po__list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($win_logistik_po__list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($win_logistik_po__list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($win_logistik_po__list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="fwin_logistik_po_list" id="fwin_logistik_po_list" class="ewForm" action="" method="post">
<?php if ($win_logistik_po__list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$win_logistik_po__list->lOptionCnt = 0;
	$win_logistik_po__list->lOptionCnt += count($win_logistik_po__list->ListOptions->Items); // Custom list options
?>
<?php echo $win_logistik_po_->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($win_logistik_po_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_logistik_po__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($win_logistik_po_->pono->Visible) { // pono ?>
	<?php if ($win_logistik_po_->SortUrl($win_logistik_po_->pono) == "") { ?>
		<td style="white-space: nowrap;">PO No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_po_->SortUrl($win_logistik_po_->pono) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>PO No</td><td style="width: 10px;"><?php if ($win_logistik_po_->pono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_po_->pono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_logistik_po_->tanggal->Visible) { // tanggal ?>
	<?php if ($win_logistik_po_->SortUrl($win_logistik_po_->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_po_->SortUrl($win_logistik_po_->tanggal) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($win_logistik_po_->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_po_->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<!--
<?php if ($win_logistik_po_->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($win_logistik_po_->SortUrl($win_logistik_po_->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_po_->SortUrl($win_logistik_po_->kode_pekerjaan) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($win_logistik_po_->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_po_->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($win_logistik_po_->kodepermohonan->Visible) { // kodepermohonan ?>
	<?php if ($win_logistik_po_->SortUrl($win_logistik_po_->kodepermohonan) == "") { ?>
		<td style="white-space: nowrap;">Permohonan Dana</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_po_->SortUrl($win_logistik_po_->kodepermohonan) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Permohonan Dana</td><td style="width: 10px;"><?php if ($win_logistik_po_->kodepermohonan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_po_->kodepermohonan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_logistik_po_->vendorid->Visible) { // vendorid ?>
	<?php if ($win_logistik_po_->SortUrl($win_logistik_po_->vendorid) == "") { ?>
		<td style="white-space: nowrap;">Supplier</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_po_->SortUrl($win_logistik_po_->vendorid) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Supplier</td><td style="width: 10px;"><?php if ($win_logistik_po_->vendorid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_po_->vendorid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($win_logistik_po_->ExportAll && $win_logistik_po_->Export <> "") {
	$win_logistik_po__list->lStopRec = $win_logistik_po__list->lTotalRecs;
} else {
	$win_logistik_po__list->lStopRec = $win_logistik_po__list->lStartRec + $win_logistik_po__list->lDisplayRecs - 1; // Set the last record to display
}
$win_logistik_po__list->lRecCount = $win_logistik_po__list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$win_logistik_po_->SelectLimit && $win_logistik_po__list->lStartRec > 1)
		$rs->Move($win_logistik_po__list->lStartRec - 1);
}
$win_logistik_po__list->lRowCnt = 0;
while (($win_logistik_po_->CurrentAction == "gridadd" || !$rs->EOF) &&
	$win_logistik_po__list->lRecCount < $win_logistik_po__list->lStopRec) {
	$win_logistik_po__list->lRecCount++;
	if (intval($win_logistik_po__list->lRecCount) >= intval($win_logistik_po__list->lStartRec)) {
		$win_logistik_po__list->lRowCnt++;

	// Init row class and style
	$win_logistik_po_->CssClass = "";
	$win_logistik_po_->CssStyle = "";
	$win_logistik_po_->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($win_logistik_po_->CurrentAction == "gridadd") {
		$win_logistik_po__list->LoadDefaultValues(); // Load default values
	} else {
		$win_logistik_po__list->LoadRowValues($rs); // Load row values
	}
	$win_logistik_po_->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$win_logistik_po__list->RenderRow();
?>
	<tr<?php echo $win_logistik_po_->RowAttributes() ?> ondblclick="showparent_loadpo('<?php echo sanitasi($_REQUEST["textid"]); ?>','<?php echo $win_logistik_po_->pono->ListViewValue(); ?>');">
<?php if ($win_logistik_po_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_logistik_po__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($win_logistik_po_->pono->Visible) { // pono ?>
		<td<?php echo $win_logistik_po_->pono->CellAttributes() ?>>
<div<?php echo $win_logistik_po_->pono->ViewAttributes() ?>><?php echo $win_logistik_po_->pono->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_logistik_po_->tanggal->Visible) { // tanggal ?>
		<td<?php echo $win_logistik_po_->tanggal->CellAttributes() ?>>
<div<?php echo $win_logistik_po_->tanggal->ViewAttributes() ?>><?php echo $win_logistik_po_->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($win_logistik_po_->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $win_logistik_po_->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $win_logistik_po_->kode_pekerjaan->ViewAttributes() ?>><?php echo $win_logistik_po_->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($win_logistik_po_->kodepermohonan->Visible) { // kodepermohonan ?>
		<td<?php echo $win_logistik_po_->kodepermohonan->CellAttributes() ?>>
<div<?php echo $win_logistik_po_->kodepermohonan->ViewAttributes() ?>><?php echo $win_logistik_po_->kodepermohonan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_logistik_po_->vendorid->Visible) { // vendorid ?>
		<td<?php echo $win_logistik_po_->vendorid->CellAttributes() ?>>
<div<?php echo $win_logistik_po_->vendorid->ViewAttributes() ?>><?php echo $win_logistik_po_->vendorid->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($win_logistik_po_->CurrentAction <> "gridadd")
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
<?php if ($win_logistik_po_->Export == "" && $win_logistik_po_->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(win_logistik_po__list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($win_logistik_po_->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$win_logistik_po__list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cwin_logistik_po__list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'win_logistik_po_';

	// Page Object Name
	var $PageObjName = 'win_logistik_po__list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $win_logistik_po_;
		if ($win_logistik_po_->UseTokenInUrl) $PageUrl .= "t=" . $win_logistik_po_->TableVar . "&"; // add page token
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
		global $objForm, $win_logistik_po_;
		if ($win_logistik_po_->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($win_logistik_po_->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($win_logistik_po_->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cwin_logistik_po__list() {
		global $conn;

		// Initialize table object
		$GLOBALS["win_logistik_po_"] = new cwin_logistik_po_();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'win_logistik_po_', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $win_logistik_po_;
	$win_logistik_po_->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $win_logistik_po_->Export; // Get export parameter, used in header
	$gsExportFile = $win_logistik_po_->TableVar; // Get export file, used in header
	if ($win_logistik_po_->Export == "print" || $win_logistik_po_->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($win_logistik_po_->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($win_logistik_po_->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($win_logistik_po_->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($win_logistik_po_->Export == "csv") {
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
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
		global $objForm, $gsSearchError, $Security, $win_logistik_po_;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause
		$this->sDeleteConfirmMsg = "Do you want to delete the selected records?"; // Delete confirm message

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
		if ($win_logistik_po_->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $win_logistik_po_->getRecordsPerPage(); // Restore from Session
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
		$win_logistik_po_->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$win_logistik_po_->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
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
		$win_logistik_po_->setSessionWhere($sFilter);
		$win_logistik_po_->CurrentFilter = "";

		// Export data only
		if (in_array($win_logistik_po_->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $win_logistik_po_;
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
			$win_logistik_po_->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $win_logistik_po_;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $win_logistik_po_->pono, FALSE); // Field pono
		$this->BuildSearchSql($sWhere, $win_logistik_po_->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $win_logistik_po_->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $win_logistik_po_->kodepermohonan, FALSE); // Field kodepermohonan
		$this->BuildSearchSql($sWhere, $win_logistik_po_->vendorid, FALSE); // Field vendorid

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($win_logistik_po_->pono); // Field pono
			$this->SetSearchParm($win_logistik_po_->tanggal); // Field tanggal
			$this->SetSearchParm($win_logistik_po_->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($win_logistik_po_->kodepermohonan); // Field kodepermohonan
			$this->SetSearchParm($win_logistik_po_->vendorid); // Field vendorid
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
		global $win_logistik_po_;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$win_logistik_po_->setAdvancedSearch("x_$FldParm", $FldVal);
		$win_logistik_po_->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$win_logistik_po_->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$win_logistik_po_->setAdvancedSearch("y_$FldParm", $FldVal2);
		$win_logistik_po_->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $win_logistik_po_;
		$this->sSrchWhere = "";
		$win_logistik_po_->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $win_logistik_po_;
		$win_logistik_po_->setAdvancedSearch("x_pono", "");
		$win_logistik_po_->setAdvancedSearch("x_tanggal", "");
		$win_logistik_po_->setAdvancedSearch("x_kode_pekerjaan", "");
		$win_logistik_po_->setAdvancedSearch("x_kodepermohonan", "");
		$win_logistik_po_->setAdvancedSearch("x_vendorid", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $win_logistik_po_;
		$this->sSrchWhere = $win_logistik_po_->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $win_logistik_po_;
		 $win_logistik_po_->pono->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_pono");
		 $win_logistik_po_->tanggal->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_tanggal");
		 $win_logistik_po_->kode_pekerjaan->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_kode_pekerjaan");
		 $win_logistik_po_->kodepermohonan->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_kodepermohonan");
		 $win_logistik_po_->vendorid->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_vendorid");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $win_logistik_po_;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$win_logistik_po_->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$win_logistik_po_->CurrentOrderType = @$_GET["ordertype"];
			$win_logistik_po_->UpdateSort($win_logistik_po_->pono); // Field 
			$win_logistik_po_->UpdateSort($win_logistik_po_->tanggal); // Field 
			$win_logistik_po_->UpdateSort($win_logistik_po_->kode_pekerjaan); // Field 
			$win_logistik_po_->UpdateSort($win_logistik_po_->kodepermohonan); // Field 
			$win_logistik_po_->UpdateSort($win_logistik_po_->vendorid); // Field 
			$win_logistik_po_->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $win_logistik_po_;
		$sOrderBy = $win_logistik_po_->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($win_logistik_po_->SqlOrderBy() <> "") {
				$sOrderBy = $win_logistik_po_->SqlOrderBy();
				$win_logistik_po_->setSessionOrderBy($sOrderBy);
				$win_logistik_po_->pono->setSort("DESC");
				$win_logistik_po_->tanggal->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $win_logistik_po_;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$win_logistik_po_->setSessionOrderBy($sOrderBy);
				$win_logistik_po_->pono->setSort("");
				$win_logistik_po_->tanggal->setSort("");
				$win_logistik_po_->kode_pekerjaan->setSort("");
				$win_logistik_po_->kodepermohonan->setSort("");
				$win_logistik_po_->vendorid->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $win_logistik_po_;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$win_logistik_po_->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$win_logistik_po_->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $win_logistik_po_->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$win_logistik_po_->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $win_logistik_po_;

		// Load search values
		// pono

		$win_logistik_po_->pono->AdvancedSearch->SearchValue = @$_GET["x_pono"];
		$win_logistik_po_->pono->AdvancedSearch->SearchOperator = @$_GET["z_pono"];

		// tanggal
		$win_logistik_po_->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$win_logistik_po_->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// kode_pekerjaan
		$win_logistik_po_->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$win_logistik_po_->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// kodepermohonan
		$win_logistik_po_->kodepermohonan->AdvancedSearch->SearchValue = @$_GET["x_kodepermohonan"];
		$win_logistik_po_->kodepermohonan->AdvancedSearch->SearchOperator = @$_GET["z_kodepermohonan"];

		// vendorid
		$win_logistik_po_->vendorid->AdvancedSearch->SearchValue = @$_GET["x_vendorid"];
		$win_logistik_po_->vendorid->AdvancedSearch->SearchOperator = @$_GET["z_vendorid"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $win_logistik_po_;

		// Call Recordset Selecting event
		$win_logistik_po_->Recordset_Selecting($win_logistik_po_->CurrentFilter);

		// Load list page SQL
		$sSql = $win_logistik_po_->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$win_logistik_po_->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $win_logistik_po_;
		$sFilter = $win_logistik_po_->KeyFilter();

		// Call Row Selecting event
		$win_logistik_po_->Row_Selecting($sFilter);

		// Load sql based on filter
		$win_logistik_po_->CurrentFilter = $sFilter;
		$sSql = $win_logistik_po_->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$win_logistik_po_->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $win_logistik_po_;
		$win_logistik_po_->pono->setDbValue($rs->fields('pono'));
		$win_logistik_po_->tanggal->setDbValue($rs->fields('tanggal'));
		$win_logistik_po_->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$win_logistik_po_->kodepermohonan->setDbValue($rs->fields('kodepermohonan'));
		$win_logistik_po_->vendorid->setDbValue($rs->fields('vendorid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $win_logistik_po_;

		// Call Row_Rendering event
		$win_logistik_po_->Row_Rendering();

		// Common render codes for all row types
		// pono

		$win_logistik_po_->pono->CellCssStyle = "white-space: nowrap;";
		$win_logistik_po_->pono->CellCssClass = "";

		// tanggal
		$win_logistik_po_->tanggal->CellCssStyle = "white-space: nowrap;";
		$win_logistik_po_->tanggal->CellCssClass = "";

		// kode_pekerjaan
		$win_logistik_po_->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$win_logistik_po_->kode_pekerjaan->CellCssClass = "";

		// kodepermohonan
		$win_logistik_po_->kodepermohonan->CellCssStyle = "white-space: nowrap;";
		$win_logistik_po_->kodepermohonan->CellCssClass = "";

		// vendorid
		$win_logistik_po_->vendorid->CellCssStyle = "white-space: nowrap;";
		$win_logistik_po_->vendorid->CellCssClass = "";
		if ($win_logistik_po_->RowType == EW_ROWTYPE_VIEW) { // View row

			// pono
			$win_logistik_po_->pono->ViewValue = $win_logistik_po_->pono->CurrentValue;
			$win_logistik_po_->pono->CssStyle = "";
			$win_logistik_po_->pono->CssClass = "";
			$win_logistik_po_->pono->ViewCustomAttributes = "";

			// tanggal
			$win_logistik_po_->tanggal->ViewValue = $win_logistik_po_->tanggal->CurrentValue;
			$win_logistik_po_->tanggal->ViewValue = ew_FormatDateTime($win_logistik_po_->tanggal->ViewValue, 7);
			$win_logistik_po_->tanggal->CssStyle = "";
			$win_logistik_po_->tanggal->CssClass = "";
			$win_logistik_po_->tanggal->ViewCustomAttributes = "";

			// kode_pekerjaan
			$win_logistik_po_->kode_pekerjaan->ViewValue = $win_logistik_po_->kode_pekerjaan->CurrentValue;
			$win_logistik_po_->kode_pekerjaan->CssStyle = "";
			$win_logistik_po_->kode_pekerjaan->CssClass = "";
			$win_logistik_po_->kode_pekerjaan->ViewCustomAttributes = "";

			// kodepermohonan
			$win_logistik_po_->kodepermohonan->ViewValue = $win_logistik_po_->kodepermohonan->CurrentValue;
			$win_logistik_po_->kodepermohonan->CssStyle = "";
			$win_logistik_po_->kodepermohonan->CssClass = "";
			$win_logistik_po_->kodepermohonan->ViewCustomAttributes = "";

			// vendorid
			if (strval($win_logistik_po_->vendorid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_vendor` WHERE `kode` = '" . ew_AdjustSql($win_logistik_po_->vendorid->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$win_logistik_po_->vendorid->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$win_logistik_po_->vendorid->ViewValue = $win_logistik_po_->vendorid->CurrentValue;
				}
			} else {
				$win_logistik_po_->vendorid->ViewValue = NULL;
			}
			$win_logistik_po_->vendorid->CssStyle = "";
			$win_logistik_po_->vendorid->CssClass = "";
			$win_logistik_po_->vendorid->ViewCustomAttributes = "";

			// pono
			$win_logistik_po_->pono->HrefValue = "";

			// tanggal
			$win_logistik_po_->tanggal->HrefValue = "";

			// kode_pekerjaan
			$win_logistik_po_->kode_pekerjaan->HrefValue = "";

			// kodepermohonan
			$win_logistik_po_->kodepermohonan->HrefValue = "";

			// vendorid
			$win_logistik_po_->vendorid->HrefValue = "";
		} elseif ($win_logistik_po_->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// pono
			$win_logistik_po_->pono->EditCustomAttributes = "";
			$win_logistik_po_->pono->EditValue = ew_HtmlEncode($win_logistik_po_->pono->AdvancedSearch->SearchValue);

			// tanggal
			$win_logistik_po_->tanggal->EditCustomAttributes = "";
			$win_logistik_po_->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($win_logistik_po_->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// kode_pekerjaan
			$win_logistik_po_->kode_pekerjaan->EditCustomAttributes = "";
			$win_logistik_po_->kode_pekerjaan->EditValue = ew_HtmlEncode($win_logistik_po_->kode_pekerjaan->AdvancedSearch->SearchValue);

			// kodepermohonan
			$win_logistik_po_->kodepermohonan->EditCustomAttributes = "";
			$win_logistik_po_->kodepermohonan->EditValue = ew_HtmlEncode($win_logistik_po_->kodepermohonan->AdvancedSearch->SearchValue);

			// vendorid
			$win_logistik_po_->vendorid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_vendor`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$win_logistik_po_->vendorid->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$win_logistik_po_->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $win_logistik_po_;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($win_logistik_po_->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
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
		global $win_logistik_po_;
		$win_logistik_po_->pono->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_pono");
		$win_logistik_po_->tanggal->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_tanggal");
		$win_logistik_po_->kode_pekerjaan->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_kode_pekerjaan");
		$win_logistik_po_->kodepermohonan->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_kodepermohonan");
		$win_logistik_po_->vendorid->AdvancedSearch->SearchValue = $win_logistik_po_->getAdvancedSearch("x_vendorid");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $win_logistik_po_;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($win_logistik_po_->ExportAll) {
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
		if ($win_logistik_po_->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($win_logistik_po_->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $win_logistik_po_->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'pono', $win_logistik_po_->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $win_logistik_po_->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $win_logistik_po_->Export);
				ew_ExportAddValue($sExportStr, 'kodepermohonan', $win_logistik_po_->Export);
				ew_ExportAddValue($sExportStr, 'vendorid', $win_logistik_po_->Export);
				echo ew_ExportLine($sExportStr, $win_logistik_po_->Export);
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
				$win_logistik_po_->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($win_logistik_po_->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('pono', $win_logistik_po_->pono->CurrentValue);
					$XmlDoc->AddField('tanggal', $win_logistik_po_->tanggal->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $win_logistik_po_->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('kodepermohonan', $win_logistik_po_->kodepermohonan->CurrentValue);
					$XmlDoc->AddField('vendorid', $win_logistik_po_->vendorid->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $win_logistik_po_->Export <> "csv") { // Vertical format
						echo ew_ExportField('pono', $win_logistik_po_->pono->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						echo ew_ExportField('tanggal', $win_logistik_po_->tanggal->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						echo ew_ExportField('kode_pekerjaan', $win_logistik_po_->kode_pekerjaan->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						echo ew_ExportField('kodepermohonan', $win_logistik_po_->kodepermohonan->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						echo ew_ExportField('vendorid', $win_logistik_po_->vendorid->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $win_logistik_po_->pono->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_po_->tanggal->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_po_->kode_pekerjaan->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_po_->kodepermohonan->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_po_->vendorid->ExportValue($win_logistik_po_->Export, $win_logistik_po_->ExportOriginalValue), $win_logistik_po_->Export);
						echo ew_ExportLine($sExportStr, $win_logistik_po_->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($win_logistik_po_->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($win_logistik_po_->Export);
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
