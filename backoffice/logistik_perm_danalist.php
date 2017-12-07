<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_perm_danainfo.php" ?>
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
$logistik_perm_dana_list = new clogistik_perm_dana_list();
$Page =& $logistik_perm_dana_list;

// Page init processing
$logistik_perm_dana_list->Page_Init();

// Page main processing
$logistik_perm_dana_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_perm_dana->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_perm_dana_list = new ew_Page("logistik_perm_dana_list");

// page properties
logistik_perm_dana_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_perm_dana_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_perm_dana_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_receivedate"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal Terima");

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
logistik_perm_dana_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_perm_dana_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_perm_dana_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($logistik_perm_dana->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_perm_dana->Export == "" && $logistik_perm_dana->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_perm_dana_list->LoadRecordset();
	$logistik_perm_dana_list->lTotalRecs = ($bSelectLimit) ? $logistik_perm_dana->SelectRecordCount() : $rs->RecordCount();
	$logistik_perm_dana_list->lStartRec = 1;
	if ($logistik_perm_dana_list->lDisplayRecs <= 0) // Display all records
		$logistik_perm_dana_list->lDisplayRecs = $logistik_perm_dana_list->lTotalRecs;
	if (!($logistik_perm_dana->ExportAll && $logistik_perm_dana->Export <> ""))
		$logistik_perm_dana_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_perm_dana_list->LoadRecordset($logistik_perm_dana_list->lStartRec-1, $logistik_perm_dana_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Permohonan Dana</b></h3>
<?php if ($logistik_perm_dana->Export == "" && $logistik_perm_dana->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($logistik_perm_dana->Export == "" && $logistik_perm_dana->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_perm_dana_list);" style="text-decoration: none;"><img id="logistik_perm_dana_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_perm_dana_list_SearchPanel">
<form name="flogistik_perm_danalistsrch" id="flogistik_perm_danalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_perm_dana_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_perm_dana">
<?php
if ($gsSearchError == "")
	$logistik_perm_dana_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_perm_dana->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_perm_dana_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Permohonan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodepermohonan" id="z_kodepermohonan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodepermohonan" id="x_kodepermohonan" size="30" maxlength="30" value="<?php echo $logistik_perm_dana->kodepermohonan->EditValue ?>"<?php echo $logistik_perm_dana->kodepermohonan->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_perm_dana->tanggal->EditValue ?>"<?php echo $logistik_perm_dana->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Catatan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_notes" id="z_notes" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_notes" id="x_notes" size="30" maxlength="100" value="<?php echo $logistik_perm_dana->notes->EditValue ?>"<?php echo $logistik_perm_dana->notes->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">PPn</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_withtax" id="z_withtax" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_withtax" name="x_withtax"<?php echo $logistik_perm_dana->withtax->EditAttributes() ?>>
<?php
if (is_array($logistik_perm_dana->withtax->EditValue)) {
	$arwrk = $logistik_perm_dana->withtax->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_perm_dana->withtax->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Dana Diterima</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_receive" id="z_receive" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_receive" name="x_receive"<?php echo $logistik_perm_dana->receive->EditAttributes() ?>>
<?php
if (is_array($logistik_perm_dana->receive->EditValue)) {
	$arwrk = $logistik_perm_dana->receive->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_perm_dana->receive->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Penerima Dana</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_receiveby" id="z_receiveby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_receiveby" name="x_receiveby"<?php echo $logistik_perm_dana->receiveby->EditAttributes() ?>>
<?php
if (is_array($logistik_perm_dana->receiveby->EditValue)) {
	$arwrk = $logistik_perm_dana->receiveby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_perm_dana->receiveby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Tanggal Terima</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_receivedate" id="z_receivedate" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_receivedate" id="x_receivedate" value="<?php echo $logistik_perm_dana->receivedate->EditValue ?>"<?php echo $logistik_perm_dana->receivedate->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_receivedate" name="cal_x_receivedate" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_receivedate", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_receivedate" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Dibuat Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $logistik_perm_dana->createby->EditAttributes() ?>>
<?php
if (is_array($logistik_perm_dana->createby->EditValue)) {
	$arwrk = $logistik_perm_dana->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_perm_dana->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Manager</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_dirut" id="z_dirut" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_dirut" name="x_dirut"<?php echo $logistik_perm_dana->dirut->EditAttributes() ?>>
<?php
if (is_array($logistik_perm_dana->dirut->EditValue)) {
	$arwrk = $logistik_perm_dana->dirut->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_perm_dana->dirut->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($logistik_perm_dana->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_perm_dana_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($logistik_perm_dana->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($logistik_perm_dana->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($logistik_perm_dana->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_perm_dana_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_perm_dana->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_perm_dana->CurrentAction <> "gridadd" && $logistik_perm_dana->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_perm_dana_list->Pager)) $logistik_perm_dana_list->Pager = new cPrevNextPager($logistik_perm_dana_list->lStartRec, $logistik_perm_dana_list->lDisplayRecs, $logistik_perm_dana_list->lTotalRecs) ?>
<?php if ($logistik_perm_dana_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_perm_dana_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_perm_dana_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_perm_dana_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_perm_dana_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_perm_dana_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_perm_dana_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_perm_dana_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_perm_dana_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_perm_dana_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_perm_dana_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_perm_dana_list->Pager->FromIndex ?> to <?php echo $logistik_perm_dana_list->Pager->ToIndex ?> of <?php echo $logistik_perm_dana_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_perm_dana_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_perm_dana_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_perm_dana">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_perm_dana_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_perm_dana_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_perm_dana_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($logistik_perm_dana_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($logistik_perm_dana_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_perm_dana_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_perm_dana->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_perm_danalist" id="flogistik_perm_danalist" class="ewForm" action="" method="post">
<?php if ($logistik_perm_dana_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_perm_dana_list->lOptionCnt = 0;
	$logistik_perm_dana_list->lOptionCnt += count($logistik_perm_dana_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_perm_dana->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_perm_dana->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_perm_dana_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_perm_dana->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_perm_dana->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->kodepermohonan->Visible) { // kodepermohonan ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->kodepermohonan) == "") { ?>
		<td style="white-space: nowrap;">Kode Permohonan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->kodepermohonan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Permohonan</td><td style="width: 10px;"><?php if ($logistik_perm_dana->kodepermohonan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->kodepermohonan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_perm_dana->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->notes->Visible) { // notes ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->notes) == "") { ?>
		<td style="white-space: nowrap;">Catatan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->notes) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Catatan</td><td style="width: 10px;"><?php if ($logistik_perm_dana->notes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->notes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->withtax->Visible) { // withtax ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->withtax) == "") { ?>
		<td style="white-space: nowrap;">PPn</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->withtax) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>PPn</td><td style="width: 10px;"><?php if ($logistik_perm_dana->withtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->withtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->receive->Visible) { // receive ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->receive) == "") { ?>
		<td style="white-space: nowrap;">Dana Diterima</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->receive) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dana Diterima</td><td style="width: 10px;"><?php if ($logistik_perm_dana->receive->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->receive->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->receiveby->Visible) { // receiveby ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->receiveby) == "") { ?>
		<td style="white-space: nowrap;">Penerima Dana</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->receiveby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Penerima Dana</td><td style="width: 10px;"><?php if ($logistik_perm_dana->receiveby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->receiveby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->receivedate->Visible) { // receivedate ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->receivedate) == "") { ?>
		<td style="white-space: nowrap;">Tanggal Terima</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->receivedate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal Terima</td><td style="width: 10px;"><?php if ($logistik_perm_dana->receivedate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->receivedate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->createby->Visible) { // createby ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($logistik_perm_dana->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_perm_dana->dirut->Visible) { // dirut ?>
	<?php if ($logistik_perm_dana->SortUrl($logistik_perm_dana->dirut) == "") { ?>
		<td style="white-space: nowrap;">Manager</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_perm_dana->SortUrl($logistik_perm_dana->dirut) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Manager</td><td style="width: 10px;"><?php if ($logistik_perm_dana->dirut->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_perm_dana->dirut->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_perm_dana->ExportAll && $logistik_perm_dana->Export <> "") {
	$logistik_perm_dana_list->lStopRec = $logistik_perm_dana_list->lTotalRecs;
} else {
	$logistik_perm_dana_list->lStopRec = $logistik_perm_dana_list->lStartRec + $logistik_perm_dana_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_perm_dana_list->lRecCount = $logistik_perm_dana_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_perm_dana->SelectLimit && $logistik_perm_dana_list->lStartRec > 1)
		$rs->Move($logistik_perm_dana_list->lStartRec - 1);
}
$logistik_perm_dana_list->lRowCnt = 0;
while (($logistik_perm_dana->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_perm_dana_list->lRecCount < $logistik_perm_dana_list->lStopRec) {
	$logistik_perm_dana_list->lRecCount++;
	if (intval($logistik_perm_dana_list->lRecCount) >= intval($logistik_perm_dana_list->lStartRec)) {
		$logistik_perm_dana_list->lRowCnt++;

	// Init row class and style
	$logistik_perm_dana->CssClass = "";
	$logistik_perm_dana->CssStyle = "";
	$logistik_perm_dana->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_perm_dana->CurrentAction == "gridadd") {
		$logistik_perm_dana_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_perm_dana_list->LoadRowValues($rs); // Load row values
	}
	$logistik_perm_dana->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_perm_dana_list->RenderRow();
?>
	<tr<?php echo $logistik_perm_dana->RowAttributes() ?>>
<?php if ($logistik_perm_dana->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_perm_dana_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_perm_dana->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_perm_dana->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->actionlink->ViewAttributes() ?>><?php echo $logistik_perm_dana->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->kodepermohonan->Visible) { // kodepermohonan ?>
		<td<?php echo $logistik_perm_dana->kodepermohonan->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->kodepermohonan->ViewAttributes() ?>><?php echo $logistik_perm_dana->kodepermohonan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_perm_dana->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->tanggal->ViewAttributes() ?>><?php echo $logistik_perm_dana->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->notes->Visible) { // notes ?>
		<td<?php echo $logistik_perm_dana->notes->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->notes->ViewAttributes() ?>><?php echo $logistik_perm_dana->notes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->withtax->Visible) { // withtax ?>
		<td<?php echo $logistik_perm_dana->withtax->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->withtax->ViewAttributes() ?>><?php echo $logistik_perm_dana->withtax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->receive->Visible) { // receive ?>
		<td<?php echo $logistik_perm_dana->receive->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->receive->ViewAttributes() ?>><?php echo $logistik_perm_dana->receive->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->receiveby->Visible) { // receiveby ?>
		<td<?php echo $logistik_perm_dana->receiveby->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->receiveby->ViewAttributes() ?>><?php echo $logistik_perm_dana->receiveby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->receivedate->Visible) { // receivedate ?>
		<td<?php echo $logistik_perm_dana->receivedate->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->receivedate->ViewAttributes() ?>><?php echo $logistik_perm_dana->receivedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->createby->Visible) { // createby ?>
		<td<?php echo $logistik_perm_dana->createby->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->createby->ViewAttributes() ?>><?php echo $logistik_perm_dana->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_perm_dana->dirut->Visible) { // dirut ?>
		<td<?php echo $logistik_perm_dana->dirut->CellAttributes() ?>>
<div<?php echo $logistik_perm_dana->dirut->ViewAttributes() ?>><?php echo $logistik_perm_dana->dirut->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_perm_dana->CurrentAction <> "gridadd")
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
<?php if ($logistik_perm_dana->Export == "" && $logistik_perm_dana->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(logistik_perm_dana_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($logistik_perm_dana->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_perm_dana_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_perm_dana_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_perm_dana';

	// Page Object Name
	var $PageObjName = 'logistik_perm_dana_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_perm_dana;
		if ($logistik_perm_dana->UseTokenInUrl) $PageUrl .= "t=" . $logistik_perm_dana->TableVar . "&"; // add page token
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
		global $objForm, $logistik_perm_dana;
		if ($logistik_perm_dana->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_perm_dana->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_perm_dana->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_perm_dana_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_perm_dana"] = new clogistik_perm_dana();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_perm_dana', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_perm_dana;
	$logistik_perm_dana->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_perm_dana->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_perm_dana->TableVar; // Get export file, used in header
	if ($logistik_perm_dana->Export == "print" || $logistik_perm_dana->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_perm_dana->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $logistik_perm_dana;
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
		if ($logistik_perm_dana->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_perm_dana->getRecordsPerPage(); // Restore from Session
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
		$logistik_perm_dana->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_perm_dana->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
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
		$logistik_perm_dana->setSessionWhere($sFilter);
		$logistik_perm_dana->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_perm_dana->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_perm_dana;
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
			$logistik_perm_dana->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_perm_dana;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->actionlink, FALSE); // Field actionlink
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kodepermohonan, FALSE); // Field kodepermohonan
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->mrno, FALSE); // Field mrno
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->qrno, FALSE); // Field qrno
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->pono, FALSE); // Field pono
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->posting, FALSE); // Field posting
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->withtax, FALSE); // Field withtax
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->receive, FALSE); // Field receive
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->receiveby, FALSE); // Field receiveby
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->receivedate, FALSE); // Field receivedate
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->lavelansir, FALSE); // Field lavelansir
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->admlogistik, FALSE); // Field admlogistik
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->admlogistikdate, FALSE); // Field admlogistikdate
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kalogistik, FALSE); // Field kalogistik
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kalogistikdate, FALSE); // Field kalogistikdate
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kadivumum, FALSE); // Field kadivumum
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->kadivumumdate, FALSE); // Field kadivumumdate
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->dirut, FALSE); // Field dirut
		$this->BuildSearchSql($sWhere, $logistik_perm_dana->dirutdate, FALSE); // Field dirutdate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_perm_dana->actionlink); // Field actionlink
			$this->SetSearchParm($logistik_perm_dana->kodepermohonan); // Field kodepermohonan
			$this->SetSearchParm($logistik_perm_dana->idseqno); // Field idseqno
			$this->SetSearchParm($logistik_perm_dana->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($logistik_perm_dana->mrno); // Field mrno
			$this->SetSearchParm($logistik_perm_dana->qrno); // Field qrno
			$this->SetSearchParm($logistik_perm_dana->pono); // Field pono
			$this->SetSearchParm($logistik_perm_dana->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_perm_dana->posting); // Field posting
			$this->SetSearchParm($logistik_perm_dana->notes); // Field notes
			$this->SetSearchParm($logistik_perm_dana->withtax); // Field withtax
			$this->SetSearchParm($logistik_perm_dana->receive); // Field receive
			$this->SetSearchParm($logistik_perm_dana->receiveby); // Field receiveby
			$this->SetSearchParm($logistik_perm_dana->receivedate); // Field receivedate
			$this->SetSearchParm($logistik_perm_dana->lavelansir); // Field lavelansir
			$this->SetSearchParm($logistik_perm_dana->createby); // Field createby
			$this->SetSearchParm($logistik_perm_dana->createdate); // Field createdate
			$this->SetSearchParm($logistik_perm_dana->admlogistik); // Field admlogistik
			$this->SetSearchParm($logistik_perm_dana->admlogistikdate); // Field admlogistikdate
			$this->SetSearchParm($logistik_perm_dana->kalogistik); // Field kalogistik
			$this->SetSearchParm($logistik_perm_dana->kalogistikdate); // Field kalogistikdate
			$this->SetSearchParm($logistik_perm_dana->kadivumum); // Field kadivumum
			$this->SetSearchParm($logistik_perm_dana->kadivumumdate); // Field kadivumumdate
			$this->SetSearchParm($logistik_perm_dana->dirut); // Field dirut
			$this->SetSearchParm($logistik_perm_dana->dirutdate); // Field dirutdate
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
		global $logistik_perm_dana;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_perm_dana->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_perm_dana->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_perm_dana->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_perm_dana->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_perm_dana->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_perm_dana;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $logistik_perm_dana->kadivumum->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $logistik_perm_dana->dirut->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $logistik_perm_dana;
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
			$logistik_perm_dana->setBasicSearchKeyword($sSearchKeyword);
			$logistik_perm_dana->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $logistik_perm_dana;
		$this->sSrchWhere = "";
		$logistik_perm_dana->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $logistik_perm_dana;
		$logistik_perm_dana->setBasicSearchKeyword("");
		$logistik_perm_dana->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_perm_dana;
		$logistik_perm_dana->setAdvancedSearch("x_actionlink", "");
		$logistik_perm_dana->setAdvancedSearch("x_kodepermohonan", "");
		$logistik_perm_dana->setAdvancedSearch("x_idseqno", "");
		$logistik_perm_dana->setAdvancedSearch("x_kode_pekerjaan", "");
		$logistik_perm_dana->setAdvancedSearch("x_mrno", "");
		$logistik_perm_dana->setAdvancedSearch("x_qrno", "");
		$logistik_perm_dana->setAdvancedSearch("x_pono", "");
		$logistik_perm_dana->setAdvancedSearch("x_tanggal", "");
		$logistik_perm_dana->setAdvancedSearch("x_posting", "");
		$logistik_perm_dana->setAdvancedSearch("x_notes", "");
		$logistik_perm_dana->setAdvancedSearch("x_withtax", "");
		$logistik_perm_dana->setAdvancedSearch("x_receive", "");
		$logistik_perm_dana->setAdvancedSearch("x_receiveby", "");
		$logistik_perm_dana->setAdvancedSearch("x_receivedate", "");
		$logistik_perm_dana->setAdvancedSearch("x_lavelansir", "");
		$logistik_perm_dana->setAdvancedSearch("x_createby", "");
		$logistik_perm_dana->setAdvancedSearch("x_createdate", "");
		$logistik_perm_dana->setAdvancedSearch("x_admlogistik", "");
		$logistik_perm_dana->setAdvancedSearch("x_admlogistikdate", "");
		$logistik_perm_dana->setAdvancedSearch("x_kalogistik", "");
		$logistik_perm_dana->setAdvancedSearch("x_kalogistikdate", "");
		$logistik_perm_dana->setAdvancedSearch("x_kadivumum", "");
		$logistik_perm_dana->setAdvancedSearch("x_kadivumumdate", "");
		$logistik_perm_dana->setAdvancedSearch("x_dirut", "");
		$logistik_perm_dana->setAdvancedSearch("x_dirutdate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_perm_dana;
		$this->sSrchWhere = $logistik_perm_dana->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_perm_dana;
		 $logistik_perm_dana->actionlink->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_actionlink");
		 $logistik_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kodepermohonan");
		 $logistik_perm_dana->idseqno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_idseqno");
		 $logistik_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kode_pekerjaan");
		 $logistik_perm_dana->mrno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_mrno");
		 $logistik_perm_dana->qrno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_qrno");
		 $logistik_perm_dana->pono->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_pono");
		 $logistik_perm_dana->tanggal->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_tanggal");
		 $logistik_perm_dana->posting->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_posting");
		 $logistik_perm_dana->notes->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_notes");
		 $logistik_perm_dana->withtax->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_withtax");
		 $logistik_perm_dana->receive->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receive");
		 $logistik_perm_dana->receiveby->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receiveby");
		 $logistik_perm_dana->receivedate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receivedate");
		 $logistik_perm_dana->lavelansir->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_lavelansir");
		 $logistik_perm_dana->createby->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_createby");
		 $logistik_perm_dana->createdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_createdate");
		 $logistik_perm_dana->admlogistik->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_admlogistik");
		 $logistik_perm_dana->admlogistikdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_admlogistikdate");
		 $logistik_perm_dana->kalogistik->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kalogistik");
		 $logistik_perm_dana->kalogistikdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kalogistikdate");
		 $logistik_perm_dana->kadivumum->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kadivumum");
		 $logistik_perm_dana->kadivumumdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kadivumumdate");
		 $logistik_perm_dana->dirut->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_dirut");
		 $logistik_perm_dana->dirutdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_dirutdate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_perm_dana;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_perm_dana->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_perm_dana->CurrentOrderType = @$_GET["ordertype"];
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->actionlink); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->kodepermohonan); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->tanggal); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->notes); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->withtax); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->receive); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->receiveby); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->receivedate); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->createby); // Field 
			$logistik_perm_dana->UpdateSort($logistik_perm_dana->dirut); // Field 
			$logistik_perm_dana->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_perm_dana;
		$sOrderBy = $logistik_perm_dana->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_perm_dana->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_perm_dana->SqlOrderBy();
				$logistik_perm_dana->setSessionOrderBy($sOrderBy);
				$logistik_perm_dana->tanggal->setSort("DESC");
				$logistik_perm_dana->kodepermohonan->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_perm_dana;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_perm_dana->setSessionOrderBy($sOrderBy);
				$logistik_perm_dana->actionlink->setSort("");
				$logistik_perm_dana->kodepermohonan->setSort("");
				$logistik_perm_dana->tanggal->setSort("");
				$logistik_perm_dana->notes->setSort("");
				$logistik_perm_dana->withtax->setSort("");
				$logistik_perm_dana->receive->setSort("");
				$logistik_perm_dana->receiveby->setSort("");
				$logistik_perm_dana->receivedate->setSort("");
				$logistik_perm_dana->createby->setSort("");
				$logistik_perm_dana->dirut->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_perm_dana;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_perm_dana->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_perm_dana;

		// Load search values
		// actionlink

		$logistik_perm_dana->actionlink->AdvancedSearch->SearchValue = @$_GET["x_actionlink"];
		$logistik_perm_dana->actionlink->AdvancedSearch->SearchOperator = @$_GET["z_actionlink"];

		// kodepermohonan
		$logistik_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = @$_GET["x_kodepermohonan"];
		$logistik_perm_dana->kodepermohonan->AdvancedSearch->SearchOperator = @$_GET["z_kodepermohonan"];

		// idseqno
		$logistik_perm_dana->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$logistik_perm_dana->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// kode_pekerjaan
		$logistik_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$logistik_perm_dana->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// mrno
		$logistik_perm_dana->mrno->AdvancedSearch->SearchValue = @$_GET["x_mrno"];
		$logistik_perm_dana->mrno->AdvancedSearch->SearchOperator = @$_GET["z_mrno"];

		// qrno
		$logistik_perm_dana->qrno->AdvancedSearch->SearchValue = @$_GET["x_qrno"];
		$logistik_perm_dana->qrno->AdvancedSearch->SearchOperator = @$_GET["z_qrno"];

		// pono
		$logistik_perm_dana->pono->AdvancedSearch->SearchValue = @$_GET["x_pono"];
		$logistik_perm_dana->pono->AdvancedSearch->SearchOperator = @$_GET["z_pono"];

		// tanggal
		$logistik_perm_dana->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_perm_dana->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// posting
		$logistik_perm_dana->posting->AdvancedSearch->SearchValue = @$_GET["x_posting"];
		$logistik_perm_dana->posting->AdvancedSearch->SearchOperator = @$_GET["z_posting"];

		// notes
		$logistik_perm_dana->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$logistik_perm_dana->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// withtax
		$logistik_perm_dana->withtax->AdvancedSearch->SearchValue = @$_GET["x_withtax"];
		$logistik_perm_dana->withtax->AdvancedSearch->SearchOperator = @$_GET["z_withtax"];

		// receive
		$logistik_perm_dana->receive->AdvancedSearch->SearchValue = @$_GET["x_receive"];
		$logistik_perm_dana->receive->AdvancedSearch->SearchOperator = @$_GET["z_receive"];

		// receiveby
		$logistik_perm_dana->receiveby->AdvancedSearch->SearchValue = @$_GET["x_receiveby"];
		$logistik_perm_dana->receiveby->AdvancedSearch->SearchOperator = @$_GET["z_receiveby"];

		// receivedate
		$logistik_perm_dana->receivedate->AdvancedSearch->SearchValue = @$_GET["x_receivedate"];
		$logistik_perm_dana->receivedate->AdvancedSearch->SearchOperator = @$_GET["z_receivedate"];

		// lavelansir
		$logistik_perm_dana->lavelansir->AdvancedSearch->SearchValue = @$_GET["x_lavelansir"];
		$logistik_perm_dana->lavelansir->AdvancedSearch->SearchOperator = @$_GET["z_lavelansir"];

		// createby
		$logistik_perm_dana->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$logistik_perm_dana->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$logistik_perm_dana->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$logistik_perm_dana->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// admlogistik
		$logistik_perm_dana->admlogistik->AdvancedSearch->SearchValue = @$_GET["x_admlogistik"];
		$logistik_perm_dana->admlogistik->AdvancedSearch->SearchOperator = @$_GET["z_admlogistik"];

		// admlogistikdate
		$logistik_perm_dana->admlogistikdate->AdvancedSearch->SearchValue = @$_GET["x_admlogistikdate"];
		$logistik_perm_dana->admlogistikdate->AdvancedSearch->SearchOperator = @$_GET["z_admlogistikdate"];

		// kalogistik
		$logistik_perm_dana->kalogistik->AdvancedSearch->SearchValue = @$_GET["x_kalogistik"];
		$logistik_perm_dana->kalogistik->AdvancedSearch->SearchOperator = @$_GET["z_kalogistik"];

		// kalogistikdate
		$logistik_perm_dana->kalogistikdate->AdvancedSearch->SearchValue = @$_GET["x_kalogistikdate"];
		$logistik_perm_dana->kalogistikdate->AdvancedSearch->SearchOperator = @$_GET["z_kalogistikdate"];

		// kadivumum
		$logistik_perm_dana->kadivumum->AdvancedSearch->SearchValue = @$_GET["x_kadivumum"];
		$logistik_perm_dana->kadivumum->AdvancedSearch->SearchOperator = @$_GET["z_kadivumum"];

		// kadivumumdate
		$logistik_perm_dana->kadivumumdate->AdvancedSearch->SearchValue = @$_GET["x_kadivumumdate"];
		$logistik_perm_dana->kadivumumdate->AdvancedSearch->SearchOperator = @$_GET["z_kadivumumdate"];

		// dirut
		$logistik_perm_dana->dirut->AdvancedSearch->SearchValue = @$_GET["x_dirut"];
		$logistik_perm_dana->dirut->AdvancedSearch->SearchOperator = @$_GET["z_dirut"];

		// dirutdate
		$logistik_perm_dana->dirutdate->AdvancedSearch->SearchValue = @$_GET["x_dirutdate"];
		$logistik_perm_dana->dirutdate->AdvancedSearch->SearchOperator = @$_GET["z_dirutdate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_perm_dana;

		// Call Recordset Selecting event
		$logistik_perm_dana->Recordset_Selecting($logistik_perm_dana->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_perm_dana->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_perm_dana->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_perm_dana;
		$sFilter = $logistik_perm_dana->KeyFilter();

		// Call Row Selecting event
		$logistik_perm_dana->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_perm_dana->CurrentFilter = $sFilter;
		$sSql = $logistik_perm_dana->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_perm_dana->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_perm_dana;
		$logistik_perm_dana->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_perm_dana->kodepermohonan->setDbValue($rs->fields('kodepermohonan'));
		$logistik_perm_dana->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_perm_dana->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$logistik_perm_dana->mrno->setDbValue($rs->fields('mrno'));
		$logistik_perm_dana->qrno->setDbValue($rs->fields('qrno'));
		$logistik_perm_dana->pono->setDbValue($rs->fields('pono'));
		$logistik_perm_dana->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_perm_dana->posting->setDbValue($rs->fields('posting'));
		$logistik_perm_dana->notes->setDbValue($rs->fields('notes'));
		$logistik_perm_dana->withtax->setDbValue($rs->fields('withtax'));
		$logistik_perm_dana->receive->setDbValue($rs->fields('receive'));
		$logistik_perm_dana->receiveby->setDbValue($rs->fields('receiveby'));
		$logistik_perm_dana->receivedate->setDbValue($rs->fields('receivedate'));
		$logistik_perm_dana->lavelansir->setDbValue($rs->fields('lavelansir'));
		$logistik_perm_dana->createby->setDbValue($rs->fields('createby'));
		$logistik_perm_dana->createdate->setDbValue($rs->fields('createdate'));
		$logistik_perm_dana->admlogistik->setDbValue($rs->fields('admlogistik'));
		$logistik_perm_dana->admlogistikdate->setDbValue($rs->fields('admlogistikdate'));
		$logistik_perm_dana->kalogistik->setDbValue($rs->fields('kalogistik'));
		$logistik_perm_dana->kalogistikdate->setDbValue($rs->fields('kalogistikdate'));
		$logistik_perm_dana->kadivumum->setDbValue($rs->fields('kadivumum'));
		$logistik_perm_dana->kadivumumdate->setDbValue($rs->fields('kadivumumdate'));
		$logistik_perm_dana->dirut->setDbValue($rs->fields('dirut'));
		$logistik_perm_dana->dirutdate->setDbValue($rs->fields('dirutdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_perm_dana;

		// Call Row_Rendering event
		$logistik_perm_dana->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_perm_dana->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->actionlink->CellCssClass = "";

		// kodepermohonan
		$logistik_perm_dana->kodepermohonan->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->kodepermohonan->CellCssClass = "";

		// tanggal
		$logistik_perm_dana->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->tanggal->CellCssClass = "";

		// notes
		$logistik_perm_dana->notes->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->notes->CellCssClass = "";

		// withtax
		$logistik_perm_dana->withtax->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->withtax->CellCssClass = "";

		// receive
		$logistik_perm_dana->receive->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->receive->CellCssClass = "";

		// receiveby
		$logistik_perm_dana->receiveby->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->receiveby->CellCssClass = "";

		// receivedate
		$logistik_perm_dana->receivedate->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->receivedate->CellCssClass = "";

		// createby
		$logistik_perm_dana->createby->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->createby->CellCssClass = "";

		// dirut
		$logistik_perm_dana->dirut->CellCssStyle = "white-space: nowrap;";
		$logistik_perm_dana->dirut->CellCssClass = "";
		if ($logistik_perm_dana->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_perm_dana->actionlink->ViewValue = $logistik_perm_dana->actionlink->CurrentValue;
			$logistik_perm_dana->actionlink->CssStyle = "";
			$logistik_perm_dana->actionlink->CssClass = "";
			$logistik_perm_dana->actionlink->ViewCustomAttributes = "";

			// kodepermohonan
			$logistik_perm_dana->kodepermohonan->ViewValue = $logistik_perm_dana->kodepermohonan->CurrentValue;
			$logistik_perm_dana->kodepermohonan->CssStyle = "";
			$logistik_perm_dana->kodepermohonan->CssClass = "";
			$logistik_perm_dana->kodepermohonan->ViewCustomAttributes = "";

			// tanggal
			$logistik_perm_dana->tanggal->ViewValue = $logistik_perm_dana->tanggal->CurrentValue;
			$logistik_perm_dana->tanggal->ViewValue = ew_FormatDateTime($logistik_perm_dana->tanggal->ViewValue, 7);
			$logistik_perm_dana->tanggal->CssStyle = "";
			$logistik_perm_dana->tanggal->CssClass = "";
			$logistik_perm_dana->tanggal->ViewCustomAttributes = "";

			// notes
			$logistik_perm_dana->notes->ViewValue = $logistik_perm_dana->notes->CurrentValue;
			$logistik_perm_dana->notes->CssStyle = "";
			$logistik_perm_dana->notes->CssClass = "";
			$logistik_perm_dana->notes->ViewCustomAttributes = "";

			// withtax
			if (strval($logistik_perm_dana->withtax->CurrentValue) <> "") {
				switch ($logistik_perm_dana->withtax->CurrentValue) {
					case "0":
						$logistik_perm_dana->withtax->ViewValue = "Tidak";
						break;
					case "1":
						$logistik_perm_dana->withtax->ViewValue = "Ya";
						break;
					default:
						$logistik_perm_dana->withtax->ViewValue = $logistik_perm_dana->withtax->CurrentValue;
				}
			} else {
				$logistik_perm_dana->withtax->ViewValue = NULL;
			}
			$logistik_perm_dana->withtax->CssStyle = "";
			$logistik_perm_dana->withtax->CssClass = "";
			$logistik_perm_dana->withtax->ViewCustomAttributes = "";

			// receive
			if (strval($logistik_perm_dana->receive->CurrentValue) <> "") {
				switch ($logistik_perm_dana->receive->CurrentValue) {
					case "0":
						$logistik_perm_dana->receive->ViewValue = "Belum";
						break;
					case "1":
						$logistik_perm_dana->receive->ViewValue = "Sudah";
						break;
					default:
						$logistik_perm_dana->receive->ViewValue = $logistik_perm_dana->receive->CurrentValue;
				}
			} else {
				$logistik_perm_dana->receive->ViewValue = NULL;
			}
			$logistik_perm_dana->receive->CssStyle = "";
			$logistik_perm_dana->receive->CssClass = "";
			$logistik_perm_dana->receive->ViewCustomAttributes = "";

			// receiveby
			if (strval($logistik_perm_dana->receiveby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `username` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_perm_dana->receiveby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_perm_dana->receiveby->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$logistik_perm_dana->receiveby->ViewValue = $logistik_perm_dana->receiveby->CurrentValue;
				}
			} else {
				$logistik_perm_dana->receiveby->ViewValue = NULL;
			}
			$logistik_perm_dana->receiveby->CssStyle = "";
			$logistik_perm_dana->receiveby->CssClass = "";
			$logistik_perm_dana->receiveby->ViewCustomAttributes = "";

			// receivedate
			$logistik_perm_dana->receivedate->ViewValue = $logistik_perm_dana->receivedate->CurrentValue;
			$logistik_perm_dana->receivedate->ViewValue = ew_FormatDateTime($logistik_perm_dana->receivedate->ViewValue, 7);
			$logistik_perm_dana->receivedate->CssStyle = "";
			$logistik_perm_dana->receivedate->CssClass = "";
			$logistik_perm_dana->receivedate->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_perm_dana->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `username` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_perm_dana->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_perm_dana->createby->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$logistik_perm_dana->createby->ViewValue = $logistik_perm_dana->createby->CurrentValue;
				}
			} else {
				$logistik_perm_dana->createby->ViewValue = NULL;
			}
			$logistik_perm_dana->createby->CssStyle = "";
			$logistik_perm_dana->createby->CssClass = "";
			$logistik_perm_dana->createby->ViewCustomAttributes = "";

			// dirut
			if (strval($logistik_perm_dana->dirut->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `username` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_perm_dana->dirut->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_perm_dana->dirut->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$logistik_perm_dana->dirut->ViewValue = $logistik_perm_dana->dirut->CurrentValue;
				}
			} else {
				$logistik_perm_dana->dirut->ViewValue = NULL;
			}
			$logistik_perm_dana->dirut->CssStyle = "";
			$logistik_perm_dana->dirut->CssClass = "";
			$logistik_perm_dana->dirut->ViewCustomAttributes = "";

			// actionlink
			$logistik_perm_dana->actionlink->HrefValue = "";

			// kodepermohonan
			$logistik_perm_dana->kodepermohonan->HrefValue = "";

			// tanggal
			$logistik_perm_dana->tanggal->HrefValue = "";

			// notes
			$logistik_perm_dana->notes->HrefValue = "";

			// withtax
			$logistik_perm_dana->withtax->HrefValue = "";

			// receive
			$logistik_perm_dana->receive->HrefValue = "";

			// receiveby
			$logistik_perm_dana->receiveby->HrefValue = "";

			// receivedate
			$logistik_perm_dana->receivedate->HrefValue = "";

			// createby
			$logistik_perm_dana->createby->HrefValue = "";

			// dirut
			$logistik_perm_dana->dirut->HrefValue = "";
		} elseif ($logistik_perm_dana->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_perm_dana->actionlink->EditCustomAttributes = "";
			$logistik_perm_dana->actionlink->EditValue = ew_HtmlEncode($logistik_perm_dana->actionlink->AdvancedSearch->SearchValue);

			// kodepermohonan
			$logistik_perm_dana->kodepermohonan->EditCustomAttributes = "";
			$logistik_perm_dana->kodepermohonan->EditValue = ew_HtmlEncode($logistik_perm_dana->kodepermohonan->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_perm_dana->tanggal->EditCustomAttributes = "";
			$logistik_perm_dana->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_perm_dana->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// notes
			$logistik_perm_dana->notes->EditCustomAttributes = "";
			$logistik_perm_dana->notes->EditValue = ew_HtmlEncode($logistik_perm_dana->notes->AdvancedSearch->SearchValue);

			// withtax
			$logistik_perm_dana->withtax->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Tidak");
			$arwrk[] = array("1", "Ya");
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_perm_dana->withtax->EditValue = $arwrk;

			// receive
			$logistik_perm_dana->receive->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sudah");
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_perm_dana->receive->EditValue = $arwrk;

			// receiveby
			$logistik_perm_dana->receiveby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_perm_dana->receiveby->EditValue = $arwrk;

			// receivedate
			$logistik_perm_dana->receivedate->EditCustomAttributes = "";
			$logistik_perm_dana->receivedate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_perm_dana->receivedate->AdvancedSearch->SearchValue, 7), 7));

			// createby
			$logistik_perm_dana->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_perm_dana->createby->EditValue = $arwrk;

			// dirut
			$logistik_perm_dana->dirut->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_perm_dana->dirut->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_perm_dana->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_perm_dana;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_perm_dana->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($logistik_perm_dana->receivedate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal Terima";
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
		global $logistik_perm_dana;
		$logistik_perm_dana->actionlink->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_actionlink");
		$logistik_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kodepermohonan");
		$logistik_perm_dana->idseqno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_idseqno");
		$logistik_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_perm_dana->mrno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_mrno");
		$logistik_perm_dana->qrno->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_qrno");
		$logistik_perm_dana->pono->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_pono");
		$logistik_perm_dana->tanggal->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_tanggal");
		$logistik_perm_dana->posting->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_posting");
		$logistik_perm_dana->notes->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_notes");
		$logistik_perm_dana->withtax->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_withtax");
		$logistik_perm_dana->receive->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receive");
		$logistik_perm_dana->receiveby->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receiveby");
		$logistik_perm_dana->receivedate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_receivedate");
		$logistik_perm_dana->lavelansir->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_lavelansir");
		$logistik_perm_dana->createby->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_createby");
		$logistik_perm_dana->createdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_createdate");
		$logistik_perm_dana->admlogistik->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_admlogistik");
		$logistik_perm_dana->admlogistikdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_admlogistikdate");
		$logistik_perm_dana->kalogistik->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kalogistik");
		$logistik_perm_dana->kalogistikdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kalogistikdate");
		$logistik_perm_dana->kadivumum->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kadivumum");
		$logistik_perm_dana->kadivumumdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_kadivumumdate");
		$logistik_perm_dana->dirut->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_dirut");
		$logistik_perm_dana->dirutdate->AdvancedSearch->SearchValue = $logistik_perm_dana->getAdvancedSearch("x_dirutdate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_perm_dana;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_perm_dana->ExportAll) {
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
		if ($logistik_perm_dana->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_perm_dana->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_perm_dana->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodepermohonan', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'notes', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'withtax', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'receive', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'receiveby', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'receivedate', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'createby', $logistik_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'dirut', $logistik_perm_dana->Export);
				echo ew_ExportLine($sExportStr, $logistik_perm_dana->Export);
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
				$logistik_perm_dana->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_perm_dana->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodepermohonan', $logistik_perm_dana->kodepermohonan->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_perm_dana->tanggal->CurrentValue);
					$XmlDoc->AddField('notes', $logistik_perm_dana->notes->CurrentValue);
					$XmlDoc->AddField('withtax', $logistik_perm_dana->withtax->CurrentValue);
					$XmlDoc->AddField('receive', $logistik_perm_dana->receive->CurrentValue);
					$XmlDoc->AddField('receiveby', $logistik_perm_dana->receiveby->CurrentValue);
					$XmlDoc->AddField('receivedate', $logistik_perm_dana->receivedate->CurrentValue);
					$XmlDoc->AddField('createby', $logistik_perm_dana->createby->CurrentValue);
					$XmlDoc->AddField('dirut', $logistik_perm_dana->dirut->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_perm_dana->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodepermohonan', $logistik_perm_dana->kodepermohonan->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('tanggal', $logistik_perm_dana->tanggal->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('notes', $logistik_perm_dana->notes->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('withtax', $logistik_perm_dana->withtax->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('receive', $logistik_perm_dana->receive->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('receiveby', $logistik_perm_dana->receiveby->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('receivedate', $logistik_perm_dana->receivedate->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('createby', $logistik_perm_dana->createby->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportField('dirut', $logistik_perm_dana->dirut->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->kodepermohonan->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->tanggal->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->notes->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->withtax->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->receive->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->receiveby->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->receivedate->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->createby->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_perm_dana->dirut->ExportValue($logistik_perm_dana->Export, $logistik_perm_dana->ExportOriginalValue), $logistik_perm_dana->Export);
						echo ew_ExportLine($sExportStr, $logistik_perm_dana->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_perm_dana->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_perm_dana->Export);
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
