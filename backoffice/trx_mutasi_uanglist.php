<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_mutasi_uanginfo.php" ?>
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
$trx_mutasi_uang_list = new ctrx_mutasi_uang_list();
$Page =& $trx_mutasi_uang_list;

// Page init processing
$trx_mutasi_uang_list->Page_Init();

// Page main processing
$trx_mutasi_uang_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trx_mutasi_uang->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_mutasi_uang_list = new ew_Page("trx_mutasi_uang_list");

// page properties
trx_mutasi_uang_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_mutasi_uang_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_mutasi_uang_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_debit"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Debit");
	elm = fobj.elements["x" + infix + "_kredit"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Kredit");

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
trx_mutasi_uang_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_mutasi_uang_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_mutasi_uang_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($trx_mutasi_uang->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_mutasi_uang->Export == "" && $trx_mutasi_uang->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_mutasi_uang_list->LoadRecordset();
	$trx_mutasi_uang_list->lTotalRecs = ($bSelectLimit) ? $trx_mutasi_uang->SelectRecordCount() : $rs->RecordCount();
	$trx_mutasi_uang_list->lStartRec = 1;
	if ($trx_mutasi_uang_list->lDisplayRecs <= 0) // Display all records
		$trx_mutasi_uang_list->lDisplayRecs = $trx_mutasi_uang_list->lTotalRecs;
	if (!($trx_mutasi_uang->ExportAll && $trx_mutasi_uang->Export <> ""))
		$trx_mutasi_uang_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_mutasi_uang_list->LoadRecordset($trx_mutasi_uang_list->lStartRec-1, $trx_mutasi_uang_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Mutasi Keuangan</b></h3>
<?php if ($trx_mutasi_uang->Export == "" && $trx_mutasi_uang->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_mutasi_uang->Export == "" && $trx_mutasi_uang->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_mutasi_uang_list);" style="text-decoration: none;"><img id="trx_mutasi_uang_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_mutasi_uang_list_SearchPanel">
<form name="ftrx_mutasi_uanglistsrch" id="ftrx_mutasi_uanglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_mutasi_uang_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_mutasi_uang">
<?php
if ($gsSearchError == "")
	$trx_mutasi_uang_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_mutasi_uang->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_mutasi_uang_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="30" maxlength="30" value="<?php echo $trx_mutasi_uang->kode->EditValue ?>"<?php echo $trx_mutasi_uang->kode->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_mutasi_uang->tanggal->EditValue ?>"<?php echo $trx_mutasi_uang->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Mode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_mode" id="z_mode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_mode" name="x_mode"<?php echo $trx_mutasi_uang->mode->EditAttributes() ?>>
<?php
if (is_array($trx_mutasi_uang->mode->EditValue)) {
	$arwrk = $trx_mutasi_uang->mode->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_mutasi_uang->mode->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Bank</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_coabank" id="z_coabank" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_coabank" name="x_coabank"<?php echo $trx_mutasi_uang->coabank->EditAttributes() ?>>
<?php
if (is_array($trx_mutasi_uang->coabank->EditValue)) {
	$arwrk = $trx_mutasi_uang->coabank->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_mutasi_uang->coabank->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Keterangan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_notes" id="z_notes" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_notes" id="x_notes" size="100" maxlength="255" value="<?php echo $trx_mutasi_uang->notes->EditValue ?>"<?php echo $trx_mutasi_uang->notes->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Debit</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_debit" id="z_debit" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_debit" id="x_debit" size="30" value="<?php echo $trx_mutasi_uang->debit->EditValue ?>"<?php echo $trx_mutasi_uang->debit->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Kredit</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_kredit" id="z_kredit" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kredit" id="x_kredit" size="30" value="<?php echo $trx_mutasi_uang->kredit->EditValue ?>"<?php echo $trx_mutasi_uang->kredit->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Create By</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $trx_mutasi_uang->createby->EditAttributes() ?>>
<?php
if (is_array($trx_mutasi_uang->createby->EditValue)) {
	$arwrk = $trx_mutasi_uang->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_mutasi_uang->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $trx_mutasi_uang_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_mutasi_uang_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_mutasi_uang->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_mutasi_uang->CurrentAction <> "gridadd" && $trx_mutasi_uang->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_mutasi_uang_list->Pager)) $trx_mutasi_uang_list->Pager = new cPrevNextPager($trx_mutasi_uang_list->lStartRec, $trx_mutasi_uang_list->lDisplayRecs, $trx_mutasi_uang_list->lTotalRecs) ?>
<?php if ($trx_mutasi_uang_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_mutasi_uang_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>start=<?php echo $trx_mutasi_uang_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_mutasi_uang_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>start=<?php echo $trx_mutasi_uang_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_mutasi_uang_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_mutasi_uang_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>start=<?php echo $trx_mutasi_uang_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_mutasi_uang_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_mutasi_uang_list->PageUrl() ?>start=<?php echo $trx_mutasi_uang_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_mutasi_uang_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_mutasi_uang_list->Pager->FromIndex ?> to <?php echo $trx_mutasi_uang_list->Pager->ToIndex ?> of <?php echo $trx_mutasi_uang_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_mutasi_uang_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_mutasi_uang_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_mutasi_uang">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_mutasi_uang_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $trx_mutasi_uang->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_mutasi_uanglist" id="ftrx_mutasi_uanglist" class="ewForm" action="" method="post">
<?php if ($trx_mutasi_uang_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_mutasi_uang_list->lOptionCnt = 0;
	$trx_mutasi_uang_list->lOptionCnt++; // edit
	$trx_mutasi_uang_list->lOptionCnt++; // Delete
	$trx_mutasi_uang_list->lOptionCnt += count($trx_mutasi_uang_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_mutasi_uang->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_mutasi_uang->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_mutasi_uang_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_mutasi_uang->kode->Visible) { // kode ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->mode->Visible) { // mode ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->mode) == "") { ?>
		<td style="white-space: nowrap;">Mode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->mode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Mode</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->mode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->mode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->coabank->Visible) { // coabank ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->coabank) == "") { ?>
		<td style="white-space: nowrap;">Bank</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->coabank) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Bank</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->coabank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->coabank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->notes->Visible) { // notes ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->notes) == "") { ?>
		<td style="white-space: nowrap;">Keterangan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->notes) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Keterangan</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->notes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->notes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->debit->Visible) { // debit ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->debit) == "") { ?>
		<td style="white-space: nowrap;">Debit</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->debit) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Debit</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->debit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->debit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->kredit->Visible) { // kredit ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->kredit) == "") { ?>
		<td style="white-space: nowrap;">Kredit</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->kredit) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kredit</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->kredit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->kredit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_mutasi_uang->createby->Visible) { // createby ?>
	<?php if ($trx_mutasi_uang->SortUrl($trx_mutasi_uang->createby) == "") { ?>
		<td style="white-space: nowrap;">Create By</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_mutasi_uang->SortUrl($trx_mutasi_uang->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create By</td><td style="width: 10px;"><?php if ($trx_mutasi_uang->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_mutasi_uang->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_mutasi_uang->ExportAll && $trx_mutasi_uang->Export <> "") {
	$trx_mutasi_uang_list->lStopRec = $trx_mutasi_uang_list->lTotalRecs;
} else {
	$trx_mutasi_uang_list->lStopRec = $trx_mutasi_uang_list->lStartRec + $trx_mutasi_uang_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_mutasi_uang_list->lRecCount = $trx_mutasi_uang_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_mutasi_uang->SelectLimit && $trx_mutasi_uang_list->lStartRec > 1)
		$rs->Move($trx_mutasi_uang_list->lStartRec - 1);
}
$trx_mutasi_uang_list->lRowCnt = 0;
while (($trx_mutasi_uang->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_mutasi_uang_list->lRecCount < $trx_mutasi_uang_list->lStopRec) {
	$trx_mutasi_uang_list->lRecCount++;
	if (intval($trx_mutasi_uang_list->lRecCount) >= intval($trx_mutasi_uang_list->lStartRec)) {
		$trx_mutasi_uang_list->lRowCnt++;

	// Init row class and style
	$trx_mutasi_uang->CssClass = "";
	$trx_mutasi_uang->CssStyle = "";
	$trx_mutasi_uang->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_mutasi_uang->CurrentAction == "gridadd") {
		$trx_mutasi_uang_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_mutasi_uang_list->LoadRowValues($rs); // Load row values
	}
	$trx_mutasi_uang->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_mutasi_uang_list->RenderRow();
?>
	<tr<?php echo $trx_mutasi_uang->RowAttributes() ?>>
<?php if ($trx_mutasi_uang->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $trx_mutasi_uang->EditUrl() ?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $trx_mutasi_uang->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($trx_mutasi_uang_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_mutasi_uang->kode->Visible) { // kode ?>
		<td<?php echo $trx_mutasi_uang->kode->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->kode->ViewAttributes() ?>><?php echo $trx_mutasi_uang->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_mutasi_uang->tanggal->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->tanggal->ViewAttributes() ?>><?php echo $trx_mutasi_uang->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->mode->Visible) { // mode ?>
		<td<?php echo $trx_mutasi_uang->mode->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->mode->ViewAttributes() ?>><?php echo $trx_mutasi_uang->mode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->coabank->Visible) { // coabank ?>
		<td<?php echo $trx_mutasi_uang->coabank->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->coabank->ViewAttributes() ?>><?php echo $trx_mutasi_uang->coabank->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->notes->Visible) { // notes ?>
		<td<?php echo $trx_mutasi_uang->notes->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->notes->ViewAttributes() ?>><?php echo $trx_mutasi_uang->notes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->debit->Visible) { // debit ?>
		<td<?php echo $trx_mutasi_uang->debit->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->debit->ViewAttributes() ?>><?php echo $trx_mutasi_uang->debit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->kredit->Visible) { // kredit ?>
		<td<?php echo $trx_mutasi_uang->kredit->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->kredit->ViewAttributes() ?>><?php echo $trx_mutasi_uang->kredit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_mutasi_uang->createby->Visible) { // createby ?>
		<td<?php echo $trx_mutasi_uang->createby->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->createby->ViewAttributes() ?>><?php echo $trx_mutasi_uang->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_mutasi_uang->CurrentAction <> "gridadd")
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
<?php if ($trx_mutasi_uang->Export == "" && $trx_mutasi_uang->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_mutasi_uang_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($trx_mutasi_uang->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$trx_mutasi_uang_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_mutasi_uang_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_mutasi_uang';

	// Page Object Name
	var $PageObjName = 'trx_mutasi_uang_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) $PageUrl .= "t=" . $trx_mutasi_uang->TableVar . "&"; // add page token
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
		global $objForm, $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_mutasi_uang->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_mutasi_uang->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_mutasi_uang_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_mutasi_uang"] = new ctrx_mutasi_uang();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_mutasi_uang', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_mutasi_uang;
	$trx_mutasi_uang->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_mutasi_uang->Export; // Get export parameter, used in header
	$gsExportFile = $trx_mutasi_uang->TableVar; // Get export file, used in header
	if ($trx_mutasi_uang->Export == "print" || $trx_mutasi_uang->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $trx_mutasi_uang;
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
		if ($trx_mutasi_uang->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_mutasi_uang->getRecordsPerPage(); // Restore from Session
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
		$trx_mutasi_uang->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_mutasi_uang->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
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
		$trx_mutasi_uang->setSessionWhere($sFilter);
		$trx_mutasi_uang->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_mutasi_uang;
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
			$trx_mutasi_uang->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_mutasi_uang;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->mode, FALSE); // Field mode
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->coabank, FALSE); // Field coabank
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->cardno, FALSE); // Field cardno
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->modul, FALSE); // Field modul
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->kode_trx, FALSE); // Field kode_trx
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->kodejurnal, FALSE); // Field kodejurnal
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->coa, FALSE); // Field coa
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->debit, FALSE); // Field debit
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->kredit, FALSE); // Field kredit
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $trx_mutasi_uang->xtimestamp, FALSE); // Field xtimestamp

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_mutasi_uang->kode); // Field kode
			$this->SetSearchParm($trx_mutasi_uang->idseqno); // Field idseqno
			$this->SetSearchParm($trx_mutasi_uang->tanggal); // Field tanggal
			$this->SetSearchParm($trx_mutasi_uang->mode); // Field mode
			$this->SetSearchParm($trx_mutasi_uang->coabank); // Field coabank
			$this->SetSearchParm($trx_mutasi_uang->cardno); // Field cardno
			$this->SetSearchParm($trx_mutasi_uang->modul); // Field modul
			$this->SetSearchParm($trx_mutasi_uang->kode_trx); // Field kode_trx
			$this->SetSearchParm($trx_mutasi_uang->kodejurnal); // Field kodejurnal
			$this->SetSearchParm($trx_mutasi_uang->coa); // Field coa
			$this->SetSearchParm($trx_mutasi_uang->notes); // Field notes
			$this->SetSearchParm($trx_mutasi_uang->debit); // Field debit
			$this->SetSearchParm($trx_mutasi_uang->kredit); // Field kredit
			$this->SetSearchParm($trx_mutasi_uang->createby); // Field createby
			$this->SetSearchParm($trx_mutasi_uang->createdate); // Field createdate
			$this->SetSearchParm($trx_mutasi_uang->xtimestamp); // Field xtimestamp
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
		global $trx_mutasi_uang;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_mutasi_uang->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_mutasi_uang->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_mutasi_uang->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_mutasi_uang->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_mutasi_uang->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $trx_mutasi_uang;
		$this->sSrchWhere = "";
		$trx_mutasi_uang->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_mutasi_uang;
		$trx_mutasi_uang->setAdvancedSearch("x_kode", "");
		$trx_mutasi_uang->setAdvancedSearch("x_idseqno", "");
		$trx_mutasi_uang->setAdvancedSearch("x_tanggal", "");
		$trx_mutasi_uang->setAdvancedSearch("x_mode", "");
		$trx_mutasi_uang->setAdvancedSearch("x_coabank", "");
		$trx_mutasi_uang->setAdvancedSearch("x_cardno", "");
		$trx_mutasi_uang->setAdvancedSearch("x_modul", "");
		$trx_mutasi_uang->setAdvancedSearch("x_kode_trx", "");
		$trx_mutasi_uang->setAdvancedSearch("x_kodejurnal", "");
		$trx_mutasi_uang->setAdvancedSearch("x_coa", "");
		$trx_mutasi_uang->setAdvancedSearch("x_notes", "");
		$trx_mutasi_uang->setAdvancedSearch("x_debit", "");
		$trx_mutasi_uang->setAdvancedSearch("x_kredit", "");
		$trx_mutasi_uang->setAdvancedSearch("x_createby", "");
		$trx_mutasi_uang->setAdvancedSearch("x_createdate", "");
		$trx_mutasi_uang->setAdvancedSearch("x_xtimestamp", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_mutasi_uang;
		$this->sSrchWhere = $trx_mutasi_uang->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_mutasi_uang;
		 $trx_mutasi_uang->kode->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kode");
		 $trx_mutasi_uang->idseqno->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_idseqno");
		 $trx_mutasi_uang->tanggal->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_tanggal");
		 $trx_mutasi_uang->mode->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_mode");
		 $trx_mutasi_uang->coabank->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_coabank");
		 $trx_mutasi_uang->cardno->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_cardno");
		 $trx_mutasi_uang->modul->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_modul");
		 $trx_mutasi_uang->kode_trx->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kode_trx");
		 $trx_mutasi_uang->kodejurnal->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kodejurnal");
		 $trx_mutasi_uang->coa->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_coa");
		 $trx_mutasi_uang->notes->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_notes");
		 $trx_mutasi_uang->debit->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_debit");
		 $trx_mutasi_uang->kredit->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kredit");
		 $trx_mutasi_uang->createby->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_createby");
		 $trx_mutasi_uang->createdate->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_createdate");
		 $trx_mutasi_uang->xtimestamp->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_xtimestamp");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_mutasi_uang;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_mutasi_uang->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_mutasi_uang->CurrentOrderType = @$_GET["ordertype"];
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->kode); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->tanggal); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->mode); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->coabank); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->notes); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->debit); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->kredit); // Field 
			$trx_mutasi_uang->UpdateSort($trx_mutasi_uang->createby); // Field 
			$trx_mutasi_uang->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_mutasi_uang;
		$sOrderBy = $trx_mutasi_uang->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_mutasi_uang->SqlOrderBy() <> "") {
				$sOrderBy = $trx_mutasi_uang->SqlOrderBy();
				$trx_mutasi_uang->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_mutasi_uang;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_mutasi_uang->setSessionOrderBy($sOrderBy);
				$trx_mutasi_uang->kode->setSort("");
				$trx_mutasi_uang->tanggal->setSort("");
				$trx_mutasi_uang->mode->setSort("");
				$trx_mutasi_uang->coabank->setSort("");
				$trx_mutasi_uang->notes->setSort("");
				$trx_mutasi_uang->debit->setSort("");
				$trx_mutasi_uang->kredit->setSort("");
				$trx_mutasi_uang->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_mutasi_uang;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_mutasi_uang->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_mutasi_uang->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_mutasi_uang;

		// Load search values
		// kode

		$trx_mutasi_uang->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_mutasi_uang->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// idseqno
		$trx_mutasi_uang->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$trx_mutasi_uang->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// tanggal
		$trx_mutasi_uang->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_mutasi_uang->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// mode
		$trx_mutasi_uang->mode->AdvancedSearch->SearchValue = @$_GET["x_mode"];
		$trx_mutasi_uang->mode->AdvancedSearch->SearchOperator = @$_GET["z_mode"];

		// coabank
		$trx_mutasi_uang->coabank->AdvancedSearch->SearchValue = @$_GET["x_coabank"];
		$trx_mutasi_uang->coabank->AdvancedSearch->SearchOperator = @$_GET["z_coabank"];

		// cardno
		$trx_mutasi_uang->cardno->AdvancedSearch->SearchValue = @$_GET["x_cardno"];
		$trx_mutasi_uang->cardno->AdvancedSearch->SearchOperator = @$_GET["z_cardno"];

		// modul
		$trx_mutasi_uang->modul->AdvancedSearch->SearchValue = @$_GET["x_modul"];
		$trx_mutasi_uang->modul->AdvancedSearch->SearchOperator = @$_GET["z_modul"];

		// kode_trx
		$trx_mutasi_uang->kode_trx->AdvancedSearch->SearchValue = @$_GET["x_kode_trx"];
		$trx_mutasi_uang->kode_trx->AdvancedSearch->SearchOperator = @$_GET["z_kode_trx"];

		// kodejurnal
		$trx_mutasi_uang->kodejurnal->AdvancedSearch->SearchValue = @$_GET["x_kodejurnal"];
		$trx_mutasi_uang->kodejurnal->AdvancedSearch->SearchOperator = @$_GET["z_kodejurnal"];

		// coa
		$trx_mutasi_uang->coa->AdvancedSearch->SearchValue = @$_GET["x_coa"];
		$trx_mutasi_uang->coa->AdvancedSearch->SearchOperator = @$_GET["z_coa"];

		// notes
		$trx_mutasi_uang->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$trx_mutasi_uang->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// debit
		$trx_mutasi_uang->debit->AdvancedSearch->SearchValue = @$_GET["x_debit"];
		$trx_mutasi_uang->debit->AdvancedSearch->SearchOperator = @$_GET["z_debit"];

		// kredit
		$trx_mutasi_uang->kredit->AdvancedSearch->SearchValue = @$_GET["x_kredit"];
		$trx_mutasi_uang->kredit->AdvancedSearch->SearchOperator = @$_GET["z_kredit"];

		// createby
		$trx_mutasi_uang->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$trx_mutasi_uang->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$trx_mutasi_uang->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$trx_mutasi_uang->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// xtimestamp
		$trx_mutasi_uang->xtimestamp->AdvancedSearch->SearchValue = @$_GET["x_xtimestamp"];
		$trx_mutasi_uang->xtimestamp->AdvancedSearch->SearchOperator = @$_GET["z_xtimestamp"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_mutasi_uang;

		// Call Recordset Selecting event
		$trx_mutasi_uang->Recordset_Selecting($trx_mutasi_uang->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_mutasi_uang->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_mutasi_uang->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_mutasi_uang;
		$sFilter = $trx_mutasi_uang->KeyFilter();

		// Call Row Selecting event
		$trx_mutasi_uang->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_mutasi_uang->CurrentFilter = $sFilter;
		$sSql = $trx_mutasi_uang->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_mutasi_uang->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_mutasi_uang;
		$trx_mutasi_uang->kode->setDbValue($rs->fields('kode'));
		$trx_mutasi_uang->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_mutasi_uang->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_mutasi_uang->mode->setDbValue($rs->fields('mode'));
		$trx_mutasi_uang->coabank->setDbValue($rs->fields('coabank'));
		$trx_mutasi_uang->cardno->setDbValue($rs->fields('cardno'));
		$trx_mutasi_uang->modul->setDbValue($rs->fields('modul'));
		$trx_mutasi_uang->kode_trx->setDbValue($rs->fields('kode_trx'));
		$trx_mutasi_uang->kodejurnal->setDbValue($rs->fields('kodejurnal'));
		$trx_mutasi_uang->coa->setDbValue($rs->fields('coa'));
		$trx_mutasi_uang->notes->setDbValue($rs->fields('notes'));
		$trx_mutasi_uang->debit->setDbValue($rs->fields('debit'));
		$trx_mutasi_uang->kredit->setDbValue($rs->fields('kredit'));
		$trx_mutasi_uang->createby->setDbValue($rs->fields('createby'));
		$trx_mutasi_uang->createdate->setDbValue($rs->fields('createdate'));
		$trx_mutasi_uang->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_mutasi_uang;

		// Call Row_Rendering event
		$trx_mutasi_uang->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_mutasi_uang->kode->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->kode->CellCssClass = "";

		// tanggal
		$trx_mutasi_uang->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->tanggal->CellCssClass = "";

		// mode
		$trx_mutasi_uang->mode->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->mode->CellCssClass = "";

		// coabank
		$trx_mutasi_uang->coabank->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->coabank->CellCssClass = "";

		// notes
		$trx_mutasi_uang->notes->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->notes->CellCssClass = "";

		// debit
		$trx_mutasi_uang->debit->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->debit->CellCssClass = "";

		// kredit
		$trx_mutasi_uang->kredit->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->kredit->CellCssClass = "";

		// createby
		$trx_mutasi_uang->createby->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->createby->CellCssClass = "";
		if ($trx_mutasi_uang->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_mutasi_uang->kode->ViewValue = $trx_mutasi_uang->kode->CurrentValue;
			$trx_mutasi_uang->kode->CssStyle = "";
			$trx_mutasi_uang->kode->CssClass = "";
			$trx_mutasi_uang->kode->ViewCustomAttributes = "";

			// tanggal
			$trx_mutasi_uang->tanggal->ViewValue = $trx_mutasi_uang->tanggal->CurrentValue;
			$trx_mutasi_uang->tanggal->ViewValue = ew_FormatDateTime($trx_mutasi_uang->tanggal->ViewValue, 7);
			$trx_mutasi_uang->tanggal->CssStyle = "";
			$trx_mutasi_uang->tanggal->CssClass = "";
			$trx_mutasi_uang->tanggal->ViewCustomAttributes = "";

			// mode
			if (strval($trx_mutasi_uang->mode->CurrentValue) <> "") {
				switch ($trx_mutasi_uang->mode->CurrentValue) {
					case "kas":
						$trx_mutasi_uang->mode->ViewValue = "Kas";
						break;
					case "edc":
						$trx_mutasi_uang->mode->ViewValue = "EDC";
						break;
					case "bank":
						$trx_mutasi_uang->mode->ViewValue = "Bank";
						break;
					default:
						$trx_mutasi_uang->mode->ViewValue = $trx_mutasi_uang->mode->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->mode->ViewValue = NULL;
			}
			$trx_mutasi_uang->mode->CssStyle = "";
			$trx_mutasi_uang->mode->CssClass = "";
			$trx_mutasi_uang->mode->ViewCustomAttributes = "";

			// coabank
			if (strval($trx_mutasi_uang->coabank->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($trx_mutasi_uang->coabank->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description` LIKE '%bank%'" . ")";
				$sSqlWrk .= " ORDER BY `description` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->coabank->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->coabank->ViewValue = $trx_mutasi_uang->coabank->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->coabank->ViewValue = NULL;
			}
			$trx_mutasi_uang->coabank->CssStyle = "";
			$trx_mutasi_uang->coabank->CssClass = "";
			$trx_mutasi_uang->coabank->ViewCustomAttributes = "";

			// notes
			$trx_mutasi_uang->notes->ViewValue = $trx_mutasi_uang->notes->CurrentValue;
			$trx_mutasi_uang->notes->CssStyle = "";
			$trx_mutasi_uang->notes->CssClass = "";
			$trx_mutasi_uang->notes->ViewCustomAttributes = "";

			// debit
			$trx_mutasi_uang->debit->ViewValue = $trx_mutasi_uang->debit->CurrentValue;
			$trx_mutasi_uang->debit->ViewValue = ew_FormatNumber($trx_mutasi_uang->debit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->debit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->debit->CssClass = "";
			$trx_mutasi_uang->debit->ViewCustomAttributes = "";

			// kredit
			$trx_mutasi_uang->kredit->ViewValue = $trx_mutasi_uang->kredit->CurrentValue;
			$trx_mutasi_uang->kredit->ViewValue = ew_FormatNumber($trx_mutasi_uang->kredit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->kredit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->kredit->CssClass = "";
			$trx_mutasi_uang->kredit->ViewCustomAttributes = "";

			// createby
			if (strval($trx_mutasi_uang->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($trx_mutasi_uang->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->createby->ViewValue = $trx_mutasi_uang->createby->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->createby->ViewValue = NULL;
			}
			$trx_mutasi_uang->createby->CssStyle = "";
			$trx_mutasi_uang->createby->CssClass = "";
			$trx_mutasi_uang->createby->ViewCustomAttributes = "";

			// kode
			$trx_mutasi_uang->kode->HrefValue = "";

			// tanggal
			$trx_mutasi_uang->tanggal->HrefValue = "";

			// mode
			$trx_mutasi_uang->mode->HrefValue = "";

			// coabank
			$trx_mutasi_uang->coabank->HrefValue = "";

			// notes
			$trx_mutasi_uang->notes->HrefValue = "";

			// debit
			$trx_mutasi_uang->debit->HrefValue = "";

			// kredit
			$trx_mutasi_uang->kredit->HrefValue = "";

			// createby
			$trx_mutasi_uang->createby->HrefValue = "";
		} elseif ($trx_mutasi_uang->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_mutasi_uang->kode->EditCustomAttributes = "";
			$trx_mutasi_uang->kode->EditValue = ew_HtmlEncode($trx_mutasi_uang->kode->AdvancedSearch->SearchValue);

			// tanggal
			$trx_mutasi_uang->tanggal->EditCustomAttributes = "";
			$trx_mutasi_uang->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_mutasi_uang->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// mode
			$trx_mutasi_uang->mode->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("kas", "Kas");
			$arwrk[] = array("edc", "EDC");
			$arwrk[] = array("bank", "Bank");
			array_unshift($arwrk, array("", "Please Select"));
			$trx_mutasi_uang->mode->EditValue = $arwrk;

			// coabank
			$trx_mutasi_uang->coabank->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk = "($sWhereWrk) AND ";
			$sWhereWrk .= "(" . "`description` LIKE '%bank%'" . ")";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `description` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_mutasi_uang->coabank->EditValue = $arwrk;

			// notes
			$trx_mutasi_uang->notes->EditCustomAttributes = "";
			$trx_mutasi_uang->notes->EditValue = ew_HtmlEncode($trx_mutasi_uang->notes->AdvancedSearch->SearchValue);

			// debit
			$trx_mutasi_uang->debit->EditCustomAttributes = "";
			$trx_mutasi_uang->debit->EditValue = ew_HtmlEncode($trx_mutasi_uang->debit->AdvancedSearch->SearchValue);

			// kredit
			$trx_mutasi_uang->kredit->EditCustomAttributes = "";
			$trx_mutasi_uang->kredit->EditValue = ew_HtmlEncode($trx_mutasi_uang->kredit->AdvancedSearch->SearchValue);

			// createby
			$trx_mutasi_uang->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_mutasi_uang->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$trx_mutasi_uang->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_mutasi_uang;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_mutasi_uang->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckNumber($trx_mutasi_uang->debit->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Debit";
		}
		if (!ew_CheckNumber($trx_mutasi_uang->kredit->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Kredit";
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
		global $trx_mutasi_uang;
		$trx_mutasi_uang->kode->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kode");
		$trx_mutasi_uang->idseqno->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_idseqno");
		$trx_mutasi_uang->tanggal->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_tanggal");
		$trx_mutasi_uang->mode->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_mode");
		$trx_mutasi_uang->coabank->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_coabank");
		$trx_mutasi_uang->cardno->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_cardno");
		$trx_mutasi_uang->modul->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_modul");
		$trx_mutasi_uang->kode_trx->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kode_trx");
		$trx_mutasi_uang->kodejurnal->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kodejurnal");
		$trx_mutasi_uang->coa->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_coa");
		$trx_mutasi_uang->notes->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_notes");
		$trx_mutasi_uang->debit->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_debit");
		$trx_mutasi_uang->kredit->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_kredit");
		$trx_mutasi_uang->createby->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_createby");
		$trx_mutasi_uang->createdate->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_createdate");
		$trx_mutasi_uang->xtimestamp->AdvancedSearch->SearchValue = $trx_mutasi_uang->getAdvancedSearch("x_xtimestamp");
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
