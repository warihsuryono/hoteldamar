<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_mrinfo.php" ?>
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
$logistik_mr_list = new clogistik_mr_list();
$Page =& $logistik_mr_list;

// Page init processing
$logistik_mr_list->Page_Init();

// Page main processing
$logistik_mr_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_mr->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_mr_list = new ew_Page("logistik_mr_list");

// page properties
logistik_mr_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_mr_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_mr_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_periode"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Periode");

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
logistik_mr_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_mr_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_mr_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_mr_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_mr_list.ShowHighlightText = "Show highlight"; 
logistik_mr_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_mr->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_mr->Export == "" && $logistik_mr->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_mr_list->LoadRecordset();
	$logistik_mr_list->lTotalRecs = ($bSelectLimit) ? $logistik_mr->SelectRecordCount() : $rs->RecordCount();
	$logistik_mr_list->lStartRec = 1;
	if ($logistik_mr_list->lDisplayRecs <= 0) // Display all records
		$logistik_mr_list->lDisplayRecs = $logistik_mr_list->lTotalRecs;
	if (!($logistik_mr->ExportAll && $logistik_mr->Export <> ""))
		$logistik_mr_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_mr_list->LoadRecordset($logistik_mr_list->lStartRec-1, $logistik_mr_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Permintaan Barang</b></h3>
<?php if ($logistik_mr->Export == "" && $logistik_mr->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_mr_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_mr->Export == "" && $logistik_mr->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_mr_list);" style="text-decoration: none;"><img id="logistik_mr_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_mr_list_SearchPanel">
<form name="flogistik_mrlistsrch" id="flogistik_mrlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_mr_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_mr">
<?php
if ($gsSearchError == "")
	$logistik_mr_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_mr->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_mr_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">MR No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_mrno" id="z_mrno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_mrno" id="x_mrno" size="30" maxlength="30" value="<?php echo $logistik_mr->mrno->EditValue ?>"<?php echo $logistik_mr->mrno->EditAttributes() ?>>
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
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $logistik_mr->kode_pekerjaan->EditValue ?>"<?php echo $logistik_mr->kode_pekerjaan->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr-->
	<tr>
		<td><span class="phpmaker">Tanggal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal" id="z_tanggal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_mr->tanggal->EditValue ?>"<?php echo $logistik_mr->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Periode</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_periode" id="z_periode" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_periode" id="x_periode" value="<?php echo $logistik_mr->periode->EditValue ?>"<?php echo $logistik_mr->periode->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_periode" name="cal_x_periode" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_periode", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_periode" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<!--tr>
		<td><span class="phpmaker">Gudang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_gudang" id="z_gudang" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_gudang" name="x_gudang"<?php echo $logistik_mr->gudang->EditAttributes() ?>>
<?php
if (is_array($logistik_mr->gudang->EditValue)) {
	$arwrk = $logistik_mr->gudang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_mr->gudang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	</tr-->
	<tr>
		<td><span class="phpmaker">Dibuat Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $logistik_mr->createby->EditAttributes() ?>>
<?php
if (is_array($logistik_mr->createby->EditValue)) {
	$arwrk = $logistik_mr->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_mr->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kadivkonstruksi" id="z_kadivkonstruksi" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_kadivkonstruksi" name="x_kadivkonstruksi"<?php echo $logistik_mr->kadivkonstruksi->EditAttributes() ?>>
<?php
if (is_array($logistik_mr->kadivkonstruksi->EditValue)) {
	$arwrk = $logistik_mr->kadivkonstruksi->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_mr_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_mr_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_mr_list->sSrchWhere <> "" && $logistik_mr_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_mr_list, this, '<?php echo $logistik_mr->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_mr_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_mr->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_mr->CurrentAction <> "gridadd" && $logistik_mr->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_mr_list->Pager)) $logistik_mr_list->Pager = new cPrevNextPager($logistik_mr_list->lStartRec, $logistik_mr_list->lDisplayRecs, $logistik_mr_list->lTotalRecs) ?>
<?php if ($logistik_mr_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_mr_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_mr_list->PageUrl() ?>start=<?php echo $logistik_mr_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_mr_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_mr_list->PageUrl() ?>start=<?php echo $logistik_mr_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_mr_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_mr_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_mr_list->PageUrl() ?>start=<?php echo $logistik_mr_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_mr_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_mr_list->PageUrl() ?>start=<?php echo $logistik_mr_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_mr_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_mr_list->Pager->FromIndex ?> to <?php echo $logistik_mr_list->Pager->ToIndex ?> of <?php echo $logistik_mr_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_mr_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_mr_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_mr">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_mr_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_mr_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_mr_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_mr_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_mr_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_mr_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_mr->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_mrlist" id="flogistik_mrlist" class="ewForm" action="" method="post">
<?php if ($logistik_mr_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_mr_list->lOptionCnt = 0;
	$logistik_mr_list->lOptionCnt += count($logistik_mr_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_mr->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_mr->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_mr_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_mr->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_mr->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_mr->mrno->Visible) { // mrno ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->mrno) == "") { ?>
		<td style="white-space: nowrap;">MR No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->mrno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>MR No</td><td style="width: 10px;"><?php if ($logistik_mr->mrno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->mrno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($logistik_mr->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->kode_pekerjaan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($logistik_mr->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_mr->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_mr->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_mr->periode->Visible) { // periode ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->periode) == "") { ?>
		<td style="white-space: nowrap;">Periode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->periode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Periode</td><td style="width: 10px;"><?php if ($logistik_mr->periode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->periode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($logistik_mr->gudang->Visible) { // gudang ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->gudang) == "") { ?>
		<td style="white-space: nowrap;">Gudang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->gudang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Gudang</td><td style="width: 10px;"><?php if ($logistik_mr->gudang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->gudang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_mr->createby->Visible) { // createby ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($logistik_mr->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_mr->kadivkonstruksi->Visible) { // kadivkonstruksi ?>
	<?php if ($logistik_mr->SortUrl($logistik_mr->kadivkonstruksi) == "") { ?>
		<td style="white-space: nowrap;">Manager</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_mr->SortUrl($logistik_mr->kadivkonstruksi) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Manager</td><td style="width: 10px;"><?php if ($logistik_mr->kadivkonstruksi->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_mr->kadivkonstruksi->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>	
	</tr>
</thead>
<?php
if ($logistik_mr->ExportAll && $logistik_mr->Export <> "") {
	$logistik_mr_list->lStopRec = $logistik_mr_list->lTotalRecs;
} else {
	$logistik_mr_list->lStopRec = $logistik_mr_list->lStartRec + $logistik_mr_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_mr_list->lRecCount = $logistik_mr_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_mr->SelectLimit && $logistik_mr_list->lStartRec > 1)
		$rs->Move($logistik_mr_list->lStartRec - 1);
}
$logistik_mr_list->lRowCnt = 0;
while (($logistik_mr->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_mr_list->lRecCount < $logistik_mr_list->lStopRec) {
	$logistik_mr_list->lRecCount++;
	if (intval($logistik_mr_list->lRecCount) >= intval($logistik_mr_list->lStartRec)) {
		$logistik_mr_list->lRowCnt++;

	// Init row class and style
	$logistik_mr->CssClass = "";
	$logistik_mr->CssStyle = "";
	$logistik_mr->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_mr->CurrentAction == "gridadd") {
		$logistik_mr_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_mr_list->LoadRowValues($rs); // Load row values
	}
	$logistik_mr->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_mr_list->RenderRow();
?>
	<tr<?php echo $logistik_mr->RowAttributes() ?>>
<?php if ($logistik_mr->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_mr_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_mr->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_mr->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_mr->actionlink->ViewAttributes() ?>><?php echo $logistik_mr->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_mr->mrno->Visible) { // mrno ?>
		<td<?php echo $logistik_mr->mrno->CellAttributes() ?>>
<div<?php echo $logistik_mr->mrno->ViewAttributes() ?>><?php echo $logistik_mr->mrno->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_mr->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $logistik_mr->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $logistik_mr->kode_pekerjaan->ViewAttributes() ?>><?php echo $logistik_mr->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_mr->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_mr->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_mr->tanggal->ViewAttributes() ?>><?php echo $logistik_mr->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_mr->periode->Visible) { // periode ?>
		<td<?php echo $logistik_mr->periode->CellAttributes() ?>>
<div<?php echo $logistik_mr->periode->ViewAttributes() ?>><?php echo $logistik_mr->periode->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_mr->gudang->Visible) { // gudang ?>
		<td<?php echo $logistik_mr->gudang->CellAttributes() ?>>
<div<?php echo $logistik_mr->gudang->ViewAttributes() ?>><?php echo $logistik_mr->gudang->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_mr->createby->Visible) { // createby ?>
		<td<?php echo $logistik_mr->createby->CellAttributes() ?>>
<div<?php echo $logistik_mr->createby->ViewAttributes() ?>><?php echo $logistik_mr->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_mr->kadivkonstruksi->Visible) { // kadivkonstruksi ?>
		<td<?php echo $logistik_mr->kadivkonstruksi->CellAttributes() ?>>
<div<?php echo $logistik_mr->kadivkonstruksi->ViewAttributes() ?>><?php echo $logistik_mr->kadivkonstruksi->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_mr->CurrentAction <> "gridadd")
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
<?php if ($logistik_mr->Export == "" && $logistik_mr->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_mr_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_mr->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_mr_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_mr_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_mr';

	// Page Object Name
	var $PageObjName = 'logistik_mr_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_mr;
		if ($logistik_mr->UseTokenInUrl) $PageUrl .= "t=" . $logistik_mr->TableVar . "&"; // add page token
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
		global $objForm, $logistik_mr;
		if ($logistik_mr->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_mr->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_mr->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_mr_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_mr"] = new clogistik_mr();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_mr', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_mr;
	$logistik_mr->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_mr->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_mr->TableVar; // Get export file, used in header
	if ($logistik_mr->Export == "print" || $logistik_mr->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_mr->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_mr->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_mr->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_mr->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_mr;
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
		if ($logistik_mr->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_mr->getRecordsPerPage(); // Restore from Session
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
		$logistik_mr->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_mr->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_mr->setStartRecordNumber($this->lStartRec);
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
		$logistik_mr->setSessionWhere($sFilter);
		$logistik_mr->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_mr->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_mr;
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
			$logistik_mr->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_mr->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_mr;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_mr->mrno, FALSE); // Field mrno
		$this->BuildSearchSql($sWhere, $logistik_mr->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $logistik_mr->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_mr->periode, FALSE); // Field periode
		$this->BuildSearchSql($sWhere, $logistik_mr->gudang, FALSE); // Field gudang
		$this->BuildSearchSql($sWhere, $logistik_mr->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $logistik_mr->kadivkonstruksi, FALSE); // Field kadivkonstruksi
		$this->BuildSearchSql($sWhere, $logistik_mr->qqc, FALSE); // Field qqc
		$this->BuildSearchSql($sWhere, $logistik_mr->kalogistik, FALSE); // Field kalogistik
		$this->BuildSearchSql($sWhere, $logistik_mr->sitemgr, FALSE); // Field sitemgr
		$this->BuildSearchSql($sWhere, $logistik_mr->sitelogistik, FALSE); // Field sitelogistik

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_mr->mrno); // Field mrno
			$this->SetSearchParm($logistik_mr->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($logistik_mr->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_mr->periode); // Field periode
			$this->SetSearchParm($logistik_mr->gudang); // Field gudang
			$this->SetSearchParm($logistik_mr->createby); // Field createby
			$this->SetSearchParm($logistik_mr->kadivkonstruksi); // Field kadivkonstruksi
			$this->SetSearchParm($logistik_mr->qqc); // Field qqc
			$this->SetSearchParm($logistik_mr->kalogistik); // Field kalogistik
			$this->SetSearchParm($logistik_mr->sitemgr); // Field sitemgr
			$this->SetSearchParm($logistik_mr->sitelogistik); // Field sitelogistik
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
		global $logistik_mr;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_mr->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_mr->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_mr->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_mr->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_mr->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_mr;
		$this->sSrchWhere = "";
		$logistik_mr->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_mr;
		$logistik_mr->setAdvancedSearch("x_mrno", "");
		$logistik_mr->setAdvancedSearch("x_kode_pekerjaan", "");
		$logistik_mr->setAdvancedSearch("x_tanggal", "");
		$logistik_mr->setAdvancedSearch("x_periode", "");
		$logistik_mr->setAdvancedSearch("x_gudang", "");
		$logistik_mr->setAdvancedSearch("x_createby", "");
		$logistik_mr->setAdvancedSearch("x_kadivkonstruksi", "");
		$logistik_mr->setAdvancedSearch("x_qqc", "");
		$logistik_mr->setAdvancedSearch("x_kalogistik", "");
		$logistik_mr->setAdvancedSearch("x_sitemgr", "");
		$logistik_mr->setAdvancedSearch("x_sitelogistik", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_mr;
		$this->sSrchWhere = $logistik_mr->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_mr;
		 $logistik_mr->mrno->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_mrno");
		 $logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kode_pekerjaan");
		 $logistik_mr->tanggal->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_tanggal");
		 $logistik_mr->periode->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_periode");
		 $logistik_mr->gudang->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_gudang");
		 $logistik_mr->createby->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_createby");
		 $logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kadivkonstruksi");
		 $logistik_mr->qqc->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_qqc");
		 $logistik_mr->kalogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kalogistik");
		 $logistik_mr->sitemgr->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitemgr");
		 $logistik_mr->sitelogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitelogistik");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_mr;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_mr->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_mr->CurrentOrderType = @$_GET["ordertype"];
			$logistik_mr->UpdateSort($logistik_mr->actionlink); // Field 
			$logistik_mr->UpdateSort($logistik_mr->mrno); // Field 
			$logistik_mr->UpdateSort($logistik_mr->kode_pekerjaan); // Field 
			$logistik_mr->UpdateSort($logistik_mr->tanggal); // Field 
			$logistik_mr->UpdateSort($logistik_mr->periode); // Field 
			$logistik_mr->UpdateSort($logistik_mr->gudang); // Field 
			$logistik_mr->UpdateSort($logistik_mr->createby); // Field 
			$logistik_mr->UpdateSort($logistik_mr->kadivkonstruksi); // Field 
			$logistik_mr->UpdateSort($logistik_mr->qqc); // Field 
			$logistik_mr->UpdateSort($logistik_mr->kalogistik); // Field 
			$logistik_mr->UpdateSort($logistik_mr->sitemgr); // Field 
			$logistik_mr->UpdateSort($logistik_mr->sitelogistik); // Field 
			$logistik_mr->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_mr;
		$sOrderBy = $logistik_mr->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_mr->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_mr->SqlOrderBy();
				$logistik_mr->setSessionOrderBy($sOrderBy);
				$logistik_mr->mrno->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_mr;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_mr->setSessionOrderBy($sOrderBy);
				$logistik_mr->actionlink->setSort("");
				$logistik_mr->mrno->setSort("");
				$logistik_mr->kode_pekerjaan->setSort("");
				$logistik_mr->tanggal->setSort("");
				$logistik_mr->periode->setSort("");
				$logistik_mr->gudang->setSort("");
				$logistik_mr->createby->setSort("");
				$logistik_mr->kadivkonstruksi->setSort("");
				$logistik_mr->qqc->setSort("");
				$logistik_mr->kalogistik->setSort("");
				$logistik_mr->sitemgr->setSort("");
				$logistik_mr->sitelogistik->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_mr->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_mr;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_mr->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_mr->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_mr->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_mr->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_mr->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_mr->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_mr;

		// Load search values
		// mrno

		$logistik_mr->mrno->AdvancedSearch->SearchValue = @$_GET["x_mrno"];
		$logistik_mr->mrno->AdvancedSearch->SearchOperator = @$_GET["z_mrno"];

		// kode_pekerjaan
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// tanggal
		$logistik_mr->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_mr->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// periode
		$logistik_mr->periode->AdvancedSearch->SearchValue = @$_GET["x_periode"];
		$logistik_mr->periode->AdvancedSearch->SearchOperator = @$_GET["z_periode"];

		// gudang
		$logistik_mr->gudang->AdvancedSearch->SearchValue = @$_GET["x_gudang"];
		$logistik_mr->gudang->AdvancedSearch->SearchOperator = @$_GET["z_gudang"];

		// createby
		$logistik_mr->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$logistik_mr->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// kadivkonstruksi
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue = @$_GET["x_kadivkonstruksi"];
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchOperator = @$_GET["z_kadivkonstruksi"];

		// qqc
		$logistik_mr->qqc->AdvancedSearch->SearchValue = @$_GET["x_qqc"];
		$logistik_mr->qqc->AdvancedSearch->SearchOperator = @$_GET["z_qqc"];

		// kalogistik
		$logistik_mr->kalogistik->AdvancedSearch->SearchValue = @$_GET["x_kalogistik"];
		$logistik_mr->kalogistik->AdvancedSearch->SearchOperator = @$_GET["z_kalogistik"];

		// sitemgr
		$logistik_mr->sitemgr->AdvancedSearch->SearchValue = @$_GET["x_sitemgr"];
		$logistik_mr->sitemgr->AdvancedSearch->SearchOperator = @$_GET["z_sitemgr"];

		// sitelogistik
		$logistik_mr->sitelogistik->AdvancedSearch->SearchValue = @$_GET["x_sitelogistik"];
		$logistik_mr->sitelogistik->AdvancedSearch->SearchOperator = @$_GET["z_sitelogistik"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_mr;

		// Call Recordset Selecting event
		$logistik_mr->Recordset_Selecting($logistik_mr->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_mr->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_mr->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_mr;
		$sFilter = $logistik_mr->KeyFilter();

		// Call Row Selecting event
		$logistik_mr->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_mr->CurrentFilter = $sFilter;
		$sSql = $logistik_mr->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_mr->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_mr;
		$logistik_mr->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_mr->mrno->setDbValue($rs->fields('mrno'));
		$logistik_mr->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_mr->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$logistik_mr->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_mr->periode->setDbValue($rs->fields('periode'));
		$logistik_mr->peruntukan->setDbValue($rs->fields('peruntukan'));
		$logistik_mr->gudang->setDbValue($rs->fields('gudang'));
		$logistik_mr->notes->setDbValue($rs->fields('notes'));
		$logistik_mr->createby->setDbValue($rs->fields('createby'));
		$logistik_mr->createdate->setDbValue($rs->fields('createdate'));
		$logistik_mr->kadivkonstruksi->setDbValue($rs->fields('kadivkonstruksi'));
		$logistik_mr->kadivkonstruksidate->setDbValue($rs->fields('kadivkonstruksidate'));
		$logistik_mr->qqc->setDbValue($rs->fields('qqc'));
		$logistik_mr->qqcdate->setDbValue($rs->fields('qqcdate'));
		$logistik_mr->kalogistik->setDbValue($rs->fields('kalogistik'));
		$logistik_mr->kalogistikdate->setDbValue($rs->fields('kalogistikdate'));
		$logistik_mr->sitemgr->setDbValue($rs->fields('sitemgr'));
		$logistik_mr->sitemgrdate->setDbValue($rs->fields('sitemgrdate'));
		$logistik_mr->sitelogistik->setDbValue($rs->fields('sitelogistik'));
		$logistik_mr->sitelogistikdate->setDbValue($rs->fields('sitelogistikdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_mr;

		// Call Row_Rendering event
		$logistik_mr->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_mr->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->actionlink->CellCssClass = "";

		// mrno
		$logistik_mr->mrno->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->mrno->CellCssClass = "";

		// kode_pekerjaan
		$logistik_mr->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->kode_pekerjaan->CellCssClass = "";

		// tanggal
		$logistik_mr->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->tanggal->CellCssClass = "";

		// periode
		$logistik_mr->periode->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->periode->CellCssClass = "";

		// gudang
		$logistik_mr->gudang->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->gudang->CellCssClass = "";

		// createby
		$logistik_mr->createby->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->createby->CellCssClass = "";

		// kadivkonstruksi
		$logistik_mr->kadivkonstruksi->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->kadivkonstruksi->CellCssClass = "";

		// qqc
		$logistik_mr->qqc->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->qqc->CellCssClass = "";

		// kalogistik
		$logistik_mr->kalogistik->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->kalogistik->CellCssClass = "";

		// sitemgr
		$logistik_mr->sitemgr->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->sitemgr->CellCssClass = "";

		// sitelogistik
		$logistik_mr->sitelogistik->CellCssStyle = "white-space: nowrap;";
		$logistik_mr->sitelogistik->CellCssClass = "";
		if ($logistik_mr->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_mr->actionlink->ViewValue = $logistik_mr->actionlink->CurrentValue;
			$logistik_mr->actionlink->CssStyle = "";
			$logistik_mr->actionlink->CssClass = "";
			$logistik_mr->actionlink->ViewCustomAttributes = "";

			// mrno
			$logistik_mr->mrno->ViewValue = $logistik_mr->mrno->CurrentValue;
			$logistik_mr->mrno->CssStyle = "";
			$logistik_mr->mrno->CssClass = "";
			$logistik_mr->mrno->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_mr->kode_pekerjaan->ViewValue = $logistik_mr->kode_pekerjaan->CurrentValue;
			$logistik_mr->kode_pekerjaan->CssStyle = "";
			$logistik_mr->kode_pekerjaan->CssClass = "";
			$logistik_mr->kode_pekerjaan->ViewCustomAttributes = "";

			// tanggal
			$logistik_mr->tanggal->ViewValue = $logistik_mr->tanggal->CurrentValue;
			$logistik_mr->tanggal->ViewValue = ew_FormatDateTime($logistik_mr->tanggal->ViewValue, 7);
			$logistik_mr->tanggal->CssStyle = "";
			$logistik_mr->tanggal->CssClass = "";
			$logistik_mr->tanggal->ViewCustomAttributes = "";

			// periode
			$logistik_mr->periode->ViewValue = $logistik_mr->periode->CurrentValue;
			$logistik_mr->periode->ViewValue = ew_FormatDateTime($logistik_mr->periode->ViewValue, 7);
			$logistik_mr->periode->CssStyle = "";
			$logistik_mr->periode->CssClass = "";
			$logistik_mr->periode->ViewCustomAttributes = "";

			// gudang
			if (strval($logistik_mr->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_mr->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->gudang->ViewValue = $rswrk->fields('nama');
					$logistik_mr->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_mr->gudang->ViewValue = $logistik_mr->gudang->CurrentValue;
				}
			} else {
				$logistik_mr->gudang->ViewValue = NULL;
			}
			$logistik_mr->gudang->CssStyle = "";
			$logistik_mr->gudang->CssClass = "";
			$logistik_mr->gudang->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_mr->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->createby->ViewValue = $logistik_mr->createby->CurrentValue;
				}
			} else {
				$logistik_mr->createby->ViewValue = NULL;
			}
			$logistik_mr->createby->CssStyle = "";
			$logistik_mr->createby->CssClass = "";
			$logistik_mr->createby->ViewCustomAttributes = "";

			// kadivkonstruksi
			if (strval($logistik_mr->kadivkonstruksi->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->kadivkonstruksi->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->kadivkonstruksi->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->kadivkonstruksi->ViewValue = $logistik_mr->kadivkonstruksi->CurrentValue;
				}
			} else {
				$logistik_mr->kadivkonstruksi->ViewValue = NULL;
			}
			$logistik_mr->kadivkonstruksi->CssStyle = "";
			$logistik_mr->kadivkonstruksi->CssClass = "";
			$logistik_mr->kadivkonstruksi->ViewCustomAttributes = "";

			// qqc
			if (strval($logistik_mr->qqc->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->qqc->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->qqc->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->qqc->ViewValue = $logistik_mr->qqc->CurrentValue;
				}
			} else {
				$logistik_mr->qqc->ViewValue = NULL;
			}
			$logistik_mr->qqc->CssStyle = "";
			$logistik_mr->qqc->CssClass = "";
			$logistik_mr->qqc->ViewCustomAttributes = "";

			// kalogistik
			if (strval($logistik_mr->kalogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->kalogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->kalogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->kalogistik->ViewValue = $logistik_mr->kalogistik->CurrentValue;
				}
			} else {
				$logistik_mr->kalogistik->ViewValue = NULL;
			}
			$logistik_mr->kalogistik->CssStyle = "";
			$logistik_mr->kalogistik->CssClass = "";
			$logistik_mr->kalogistik->ViewCustomAttributes = "";

			// sitemgr
			if (strval($logistik_mr->sitemgr->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->sitemgr->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->sitemgr->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->sitemgr->ViewValue = $logistik_mr->sitemgr->CurrentValue;
				}
			} else {
				$logistik_mr->sitemgr->ViewValue = NULL;
			}
			$logistik_mr->sitemgr->CssStyle = "";
			$logistik_mr->sitemgr->CssClass = "";
			$logistik_mr->sitemgr->ViewCustomAttributes = "";

			// sitelogistik
			if (strval($logistik_mr->sitelogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->sitelogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->sitelogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->sitelogistik->ViewValue = $logistik_mr->sitelogistik->CurrentValue;
				}
			} else {
				$logistik_mr->sitelogistik->ViewValue = NULL;
			}
			$logistik_mr->sitelogistik->CssStyle = "";
			$logistik_mr->sitelogistik->CssClass = "";
			$logistik_mr->sitelogistik->ViewCustomAttributes = "";

			// actionlink
			$logistik_mr->actionlink->HrefValue = "";

			// mrno
			$logistik_mr->mrno->HrefValue = "";

			// kode_pekerjaan
			$logistik_mr->kode_pekerjaan->HrefValue = "";

			// tanggal
			$logistik_mr->tanggal->HrefValue = "";

			// periode
			$logistik_mr->periode->HrefValue = "";

			// gudang
			$logistik_mr->gudang->HrefValue = "";

			// createby
			$logistik_mr->createby->HrefValue = "";

			// kadivkonstruksi
			$logistik_mr->kadivkonstruksi->HrefValue = "";

			// qqc
			$logistik_mr->qqc->HrefValue = "";

			// kalogistik
			$logistik_mr->kalogistik->HrefValue = "";

			// sitemgr
			$logistik_mr->sitemgr->HrefValue = "";

			// sitelogistik
			$logistik_mr->sitelogistik->HrefValue = "";
		} elseif ($logistik_mr->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_mr->actionlink->EditCustomAttributes = "";
			$logistik_mr->actionlink->EditValue = ew_HtmlEncode($logistik_mr->actionlink->AdvancedSearch->SearchValue);

			// mrno
			$logistik_mr->mrno->EditCustomAttributes = "";
			$logistik_mr->mrno->EditValue = ew_HtmlEncode($logistik_mr->mrno->AdvancedSearch->SearchValue);

			// kode_pekerjaan
			$logistik_mr->kode_pekerjaan->EditCustomAttributes = "";
			$logistik_mr->kode_pekerjaan->EditValue = ew_HtmlEncode($logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_mr->tanggal->EditCustomAttributes = "";
			$logistik_mr->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_mr->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// periode
			$logistik_mr->periode->EditCustomAttributes = "";
			$logistik_mr->periode->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_mr->periode->AdvancedSearch->SearchValue, 7), 7));

			// gudang
			$logistik_mr->gudang->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_mr->gudang->EditValue = $arwrk;

			// createby
			$logistik_mr->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->createby->EditValue = $arwrk;

			// kadivkonstruksi
			$logistik_mr->kadivkonstruksi->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->kadivkonstruksi->EditValue = $arwrk;

			// qqc
			$logistik_mr->qqc->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->qqc->EditValue = $arwrk;

			// kalogistik
			$logistik_mr->kalogistik->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->kalogistik->EditValue = $arwrk;

			// sitemgr
			$logistik_mr->sitemgr->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->sitemgr->EditValue = $arwrk;

			// sitelogistik
			$logistik_mr->sitelogistik->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_mr->sitelogistik->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_mr->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_mr;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_mr->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($logistik_mr->periode->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Periode";
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
		global $logistik_mr;
		$logistik_mr->mrno->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_mrno");
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_mr->tanggal->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_tanggal");
		$logistik_mr->periode->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_periode");
		$logistik_mr->gudang->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_gudang");
		$logistik_mr->createby->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_createby");
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kadivkonstruksi");
		$logistik_mr->qqc->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_qqc");
		$logistik_mr->kalogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kalogistik");
		$logistik_mr->sitemgr->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitemgr");
		$logistik_mr->sitelogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitelogistik");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_mr;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_mr->ExportAll) {
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
		if ($logistik_mr->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_mr->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_mr->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'mrno', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'periode', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'gudang', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'createby', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'kadivkonstruksi', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'qqc', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'kalogistik', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'sitemgr', $logistik_mr->Export);
				ew_ExportAddValue($sExportStr, 'sitelogistik', $logistik_mr->Export);
				echo ew_ExportLine($sExportStr, $logistik_mr->Export);
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
				$logistik_mr->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_mr->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('mrno', $logistik_mr->mrno->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $logistik_mr->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_mr->tanggal->CurrentValue);
					$XmlDoc->AddField('periode', $logistik_mr->periode->CurrentValue);
					$XmlDoc->AddField('gudang', $logistik_mr->gudang->CurrentValue);
					$XmlDoc->AddField('createby', $logistik_mr->createby->CurrentValue);
					$XmlDoc->AddField('kadivkonstruksi', $logistik_mr->kadivkonstruksi->CurrentValue);
					$XmlDoc->AddField('qqc', $logistik_mr->qqc->CurrentValue);
					$XmlDoc->AddField('kalogistik', $logistik_mr->kalogistik->CurrentValue);
					$XmlDoc->AddField('sitemgr', $logistik_mr->sitemgr->CurrentValue);
					$XmlDoc->AddField('sitelogistik', $logistik_mr->sitelogistik->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_mr->Export <> "csv") { // Vertical format
						echo ew_ExportField('mrno', $logistik_mr->mrno->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('kode_pekerjaan', $logistik_mr->kode_pekerjaan->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('tanggal', $logistik_mr->tanggal->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('periode', $logistik_mr->periode->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('gudang', $logistik_mr->gudang->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('createby', $logistik_mr->createby->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('kadivkonstruksi', $logistik_mr->kadivkonstruksi->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('qqc', $logistik_mr->qqc->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('kalogistik', $logistik_mr->kalogistik->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('sitemgr', $logistik_mr->sitemgr->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportField('sitelogistik', $logistik_mr->sitelogistik->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_mr->mrno->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->kode_pekerjaan->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->tanggal->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->periode->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->gudang->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->createby->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->kadivkonstruksi->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->qqc->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->kalogistik->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->sitemgr->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						ew_ExportAddValue($sExportStr, $logistik_mr->sitelogistik->ExportValue($logistik_mr->Export, $logistik_mr->ExportOriginalValue), $logistik_mr->Export);
						echo ew_ExportLine($sExportStr, $logistik_mr->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_mr->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_mr->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_mr';

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
