<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_stock_controlinfo.php" ?>
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
$logistik_stock_control_list = new clogistik_stock_control_list();
$Page =& $logistik_stock_control_list;

// Page init processing
$logistik_stock_control_list->Page_Init();

// Page main processing
$logistik_stock_control_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_stock_control->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_stock_control_list = new ew_Page("logistik_stock_control_list");

// page properties
logistik_stock_control_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_stock_control_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_stock_control_list.ValidateSearch = function(fobj) {
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
logistik_stock_control_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_stock_control_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_stock_control_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_stock_control_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_stock_control_list.ShowHighlightText = "Show highlight"; 
logistik_stock_control_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_stock_control->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_stock_control->Export == "" && $logistik_stock_control->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_stock_control_list->LoadRecordset();
	$logistik_stock_control_list->lTotalRecs = ($bSelectLimit) ? $logistik_stock_control->SelectRecordCount() : $rs->RecordCount();
	$logistik_stock_control_list->lStartRec = 1;
	if ($logistik_stock_control_list->lDisplayRecs <= 0) // Display all records
		$logistik_stock_control_list->lDisplayRecs = $logistik_stock_control_list->lTotalRecs;
	if (!($logistik_stock_control->ExportAll && $logistik_stock_control->Export <> ""))
		$logistik_stock_control_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_stock_control_list->LoadRecordset($logistik_stock_control_list->lStartRec-1, $logistik_stock_control_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Stock Control</b></h3>
<?php if ($logistik_stock_control->Export == "" && $logistik_stock_control->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_stock_control_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_stock_control->Export == "" && $logistik_stock_control->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_stock_control_list);" style="text-decoration: none;"><img id="logistik_stock_control_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_stock_control_list_SearchPanel">
<form name="flogistik_stock_controllistsrch" id="flogistik_stock_controllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_stock_control_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_stock_control">
<?php
if ($gsSearchError == "")
	$logistik_stock_control_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_stock_control->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_stock_control_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Control</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodecek" id="z_kodecek" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodecek" id="x_kodecek" size="30" maxlength="30" value="<?php echo $logistik_stock_control->kodecek->EditValue ?>"<?php echo $logistik_stock_control->kodecek->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_stock_control->tanggal->EditValue ?>"<?php echo $logistik_stock_control->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Gudang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_gudang" id="z_gudang" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_gudang" name="x_gudang"<?php echo $logistik_stock_control->gudang->EditAttributes() ?>>
<?php
if (is_array($logistik_stock_control->gudang->EditValue)) {
	$arwrk = $logistik_stock_control->gudang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stock_control->gudang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Dikontrol Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_cekby" id="z_cekby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_cekby" name="x_cekby"<?php echo $logistik_stock_control->cekby->EditAttributes() ?>>
<?php
if (is_array($logistik_stock_control->cekby->EditValue)) {
	$arwrk = $logistik_stock_control->cekby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stock_control->cekby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Security</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_securityby" id="z_securityby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_securityby" name="x_securityby"<?php echo $logistik_stock_control->securityby->EditAttributes() ?>>
<?php
if (is_array($logistik_stock_control->securityby->EditValue)) {
	$arwrk = $logistik_stock_control->securityby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stock_control->securityby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Dirut</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_dirutby" id="z_dirutby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_dirutby" name="x_dirutby"<?php echo $logistik_stock_control->dirutby->EditAttributes() ?>>
<?php
if (is_array($logistik_stock_control->dirutby->EditValue)) {
	$arwrk = $logistik_stock_control->dirutby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stock_control->dirutby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_stock_control_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_stock_control_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_stock_control_list->sSrchWhere <> "" && $logistik_stock_control_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_stock_control_list, this, '<?php echo $logistik_stock_control->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_stock_control_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_stock_control->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_stock_control->CurrentAction <> "gridadd" && $logistik_stock_control->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_stock_control_list->Pager)) $logistik_stock_control_list->Pager = new cPrevNextPager($logistik_stock_control_list->lStartRec, $logistik_stock_control_list->lDisplayRecs, $logistik_stock_control_list->lTotalRecs) ?>
<?php if ($logistik_stock_control_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_stock_control_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stock_control_list->PageUrl() ?>start=<?php echo $logistik_stock_control_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_stock_control_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stock_control_list->PageUrl() ?>start=<?php echo $logistik_stock_control_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_stock_control_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_stock_control_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stock_control_list->PageUrl() ?>start=<?php echo $logistik_stock_control_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_stock_control_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stock_control_list->PageUrl() ?>start=<?php echo $logistik_stock_control_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_stock_control_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_stock_control_list->Pager->FromIndex ?> to <?php echo $logistik_stock_control_list->Pager->ToIndex ?> of <?php echo $logistik_stock_control_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_stock_control_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_stock_control_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_stock_control">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_stock_control_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_stock_control_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_stock_control_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_stock_control_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_stock_control_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_stock_control_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_stock_control->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_stock_controllist" id="flogistik_stock_controllist" class="ewForm" action="" method="post">
<?php if ($logistik_stock_control_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_stock_control_list->lOptionCnt = 0;
	$logistik_stock_control_list->lOptionCnt += count($logistik_stock_control_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_stock_control->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_stock_control->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_stock_control_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_stock_control->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_stock_control->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stock_control->kodecek->Visible) { // kodecek ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->kodecek) == "") { ?>
		<td style="white-space: nowrap;">Kode Control</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->kodecek) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Control</td><td style="width: 10px;"><?php if ($logistik_stock_control->kodecek->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->kodecek->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stock_control->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_stock_control->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($logistik_stock_control->gudang->Visible) { // gudang ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->gudang) == "") { ?>
		<td style="white-space: nowrap;">Gudang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->gudang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Gudang</td><td style="width: 10px;"><?php if ($logistik_stock_control->gudang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->gudang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_stock_control->cekby->Visible) { // cekby ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->cekby) == "") { ?>
		<td style="white-space: nowrap;">Dikontrol Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->cekby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dikontrol Oleh</td><td style="width: 10px;"><?php if ($logistik_stock_control->cekby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->cekby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stock_control->securityby->Visible) { // securityby ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->securityby) == "") { ?>
		<td style="white-space: nowrap;">Security</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->securityby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Security</td><td style="width: 10px;"><?php if ($logistik_stock_control->securityby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->securityby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stock_control->dirutby->Visible) { // dirutby ?>
	<?php if ($logistik_stock_control->SortUrl($logistik_stock_control->dirutby) == "") { ?>
		<td style="white-space: nowrap;">Dirut</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stock_control->SortUrl($logistik_stock_control->dirutby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dirut</td><td style="width: 10px;"><?php if ($logistik_stock_control->dirutby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stock_control->dirutby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_stock_control->ExportAll && $logistik_stock_control->Export <> "") {
	$logistik_stock_control_list->lStopRec = $logistik_stock_control_list->lTotalRecs;
} else {
	$logistik_stock_control_list->lStopRec = $logistik_stock_control_list->lStartRec + $logistik_stock_control_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_stock_control_list->lRecCount = $logistik_stock_control_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_stock_control->SelectLimit && $logistik_stock_control_list->lStartRec > 1)
		$rs->Move($logistik_stock_control_list->lStartRec - 1);
}
$logistik_stock_control_list->lRowCnt = 0;
while (($logistik_stock_control->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_stock_control_list->lRecCount < $logistik_stock_control_list->lStopRec) {
	$logistik_stock_control_list->lRecCount++;
	if (intval($logistik_stock_control_list->lRecCount) >= intval($logistik_stock_control_list->lStartRec)) {
		$logistik_stock_control_list->lRowCnt++;

	// Init row class and style
	$logistik_stock_control->CssClass = "";
	$logistik_stock_control->CssStyle = "";
	$logistik_stock_control->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_stock_control->CurrentAction == "gridadd") {
		$logistik_stock_control_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_stock_control_list->LoadRowValues($rs); // Load row values
	}
	$logistik_stock_control->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_stock_control_list->RenderRow();
?>
	<tr<?php echo $logistik_stock_control->RowAttributes() ?>>
<?php if ($logistik_stock_control->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_stock_control_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_stock_control->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_stock_control->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->actionlink->ViewAttributes() ?>><?php echo $logistik_stock_control->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stock_control->kodecek->Visible) { // kodecek ?>
		<td<?php echo $logistik_stock_control->kodecek->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->kodecek->ViewAttributes() ?>><?php echo $logistik_stock_control->kodecek->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stock_control->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_stock_control->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->tanggal->ViewAttributes() ?>><?php echo $logistik_stock_control->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_stock_control->gudang->Visible) { // gudang ?>
		<td<?php echo $logistik_stock_control->gudang->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->gudang->ViewAttributes() ?>><?php echo $logistik_stock_control->gudang->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_stock_control->cekby->Visible) { // cekby ?>
		<td<?php echo $logistik_stock_control->cekby->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->cekby->ViewAttributes() ?>><?php echo $logistik_stock_control->cekby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stock_control->securityby->Visible) { // securityby ?>
		<td<?php echo $logistik_stock_control->securityby->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->securityby->ViewAttributes() ?>><?php echo $logistik_stock_control->securityby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stock_control->dirutby->Visible) { // dirutby ?>
		<td<?php echo $logistik_stock_control->dirutby->CellAttributes() ?>>
<div<?php echo $logistik_stock_control->dirutby->ViewAttributes() ?>><?php echo $logistik_stock_control->dirutby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_stock_control->CurrentAction <> "gridadd")
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
<?php if ($logistik_stock_control->Export == "" && $logistik_stock_control->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_stock_control_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_stock_control->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_stock_control_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_stock_control_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_stock_control';

	// Page Object Name
	var $PageObjName = 'logistik_stock_control_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_stock_control;
		if ($logistik_stock_control->UseTokenInUrl) $PageUrl .= "t=" . $logistik_stock_control->TableVar . "&"; // add page token
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
		global $objForm, $logistik_stock_control;
		if ($logistik_stock_control->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_stock_control->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_stock_control->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_stock_control_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_stock_control"] = new clogistik_stock_control();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_stock_control', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_stock_control;
	$logistik_stock_control->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_stock_control->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_stock_control->TableVar; // Get export file, used in header
	if ($logistik_stock_control->Export == "print" || $logistik_stock_control->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_stock_control->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_stock_control->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_stock_control->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_stock_control->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_stock_control;
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
		if ($logistik_stock_control->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_stock_control->getRecordsPerPage(); // Restore from Session
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
		$logistik_stock_control->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_stock_control->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
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
		$logistik_stock_control->setSessionWhere($sFilter);
		$logistik_stock_control->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_stock_control->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_stock_control;
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
			$logistik_stock_control->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_stock_control;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_stock_control->kodecek, FALSE); // Field kodecek
		$this->BuildSearchSql($sWhere, $logistik_stock_control->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_stock_control->gudang, FALSE); // Field gudang
		$this->BuildSearchSql($sWhere, $logistik_stock_control->cekby, FALSE); // Field cekby
		$this->BuildSearchSql($sWhere, $logistik_stock_control->securityby, FALSE); // Field securityby
		$this->BuildSearchSql($sWhere, $logistik_stock_control->dirutby, FALSE); // Field dirutby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_stock_control->kodecek); // Field kodecek
			$this->SetSearchParm($logistik_stock_control->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_stock_control->gudang); // Field gudang
			$this->SetSearchParm($logistik_stock_control->cekby); // Field cekby
			$this->SetSearchParm($logistik_stock_control->securityby); // Field securityby
			$this->SetSearchParm($logistik_stock_control->dirutby); // Field dirutby
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
		global $logistik_stock_control;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_stock_control->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_stock_control->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_stock_control->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_stock_control->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_stock_control->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_stock_control;
		$this->sSrchWhere = "";
		$logistik_stock_control->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_stock_control;
		$logistik_stock_control->setAdvancedSearch("x_kodecek", "");
		$logistik_stock_control->setAdvancedSearch("x_tanggal", "");
		$logistik_stock_control->setAdvancedSearch("x_gudang", "");
		$logistik_stock_control->setAdvancedSearch("x_cekby", "");
		$logistik_stock_control->setAdvancedSearch("x_securityby", "");
		$logistik_stock_control->setAdvancedSearch("x_dirutby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_stock_control;
		$this->sSrchWhere = $logistik_stock_control->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_stock_control;
		 $logistik_stock_control->kodecek->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_kodecek");
		 $logistik_stock_control->tanggal->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_tanggal");
		 $logistik_stock_control->gudang->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_gudang");
		 $logistik_stock_control->cekby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_cekby");
		 $logistik_stock_control->securityby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_securityby");
		 $logistik_stock_control->dirutby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_dirutby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_stock_control;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_stock_control->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_stock_control->CurrentOrderType = @$_GET["ordertype"];
			$logistik_stock_control->UpdateSort($logistik_stock_control->actionlink); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->kodecek); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->tanggal); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->gudang); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->cekby); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->securityby); // Field 
			$logistik_stock_control->UpdateSort($logistik_stock_control->dirutby); // Field 
			$logistik_stock_control->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_stock_control;
		$sOrderBy = $logistik_stock_control->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_stock_control->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_stock_control->SqlOrderBy();
				$logistik_stock_control->setSessionOrderBy($sOrderBy);
				$logistik_stock_control->kodecek->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_stock_control;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_stock_control->setSessionOrderBy($sOrderBy);
				$logistik_stock_control->actionlink->setSort("");
				$logistik_stock_control->kodecek->setSort("");
				$logistik_stock_control->tanggal->setSort("");
				$logistik_stock_control->gudang->setSort("");
				$logistik_stock_control->cekby->setSort("");
				$logistik_stock_control->securityby->setSort("");
				$logistik_stock_control->dirutby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_stock_control;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_stock_control->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_stock_control->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_stock_control->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_stock_control->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_stock_control;

		// Load search values
		// kodecek

		$logistik_stock_control->kodecek->AdvancedSearch->SearchValue = @$_GET["x_kodecek"];
		$logistik_stock_control->kodecek->AdvancedSearch->SearchOperator = @$_GET["z_kodecek"];

		// tanggal
		$logistik_stock_control->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_stock_control->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// gudang
		$logistik_stock_control->gudang->AdvancedSearch->SearchValue = @$_GET["x_gudang"];
		$logistik_stock_control->gudang->AdvancedSearch->SearchOperator = @$_GET["z_gudang"];

		// cekby
		$logistik_stock_control->cekby->AdvancedSearch->SearchValue = @$_GET["x_cekby"];
		$logistik_stock_control->cekby->AdvancedSearch->SearchOperator = @$_GET["z_cekby"];

		// securityby
		$logistik_stock_control->securityby->AdvancedSearch->SearchValue = @$_GET["x_securityby"];
		$logistik_stock_control->securityby->AdvancedSearch->SearchOperator = @$_GET["z_securityby"];

		// dirutby
		$logistik_stock_control->dirutby->AdvancedSearch->SearchValue = @$_GET["x_dirutby"];
		$logistik_stock_control->dirutby->AdvancedSearch->SearchOperator = @$_GET["z_dirutby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_stock_control;

		// Call Recordset Selecting event
		$logistik_stock_control->Recordset_Selecting($logistik_stock_control->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_stock_control->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_stock_control->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_stock_control;
		$sFilter = $logistik_stock_control->KeyFilter();

		// Call Row Selecting event
		$logistik_stock_control->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_stock_control->CurrentFilter = $sFilter;
		$sSql = $logistik_stock_control->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_stock_control->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_stock_control;
		$logistik_stock_control->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_stock_control->kodecek->setDbValue($rs->fields('kodecek'));
		$logistik_stock_control->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_stock_control->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_stock_control->gudang->setDbValue($rs->fields('gudang'));
		$logistik_stock_control->notes->setDbValue($rs->fields('notes'));
		$logistik_stock_control->cekby->setDbValue($rs->fields('cekby'));
		$logistik_stock_control->cekdate->setDbValue($rs->fields('cekdate'));
		$logistik_stock_control->securityby->setDbValue($rs->fields('securityby'));
		$logistik_stock_control->securitydate->setDbValue($rs->fields('securitydate'));
		$logistik_stock_control->dirutby->setDbValue($rs->fields('dirutby'));
		$logistik_stock_control->dirutdate->setDbValue($rs->fields('dirutdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_stock_control;

		// Call Row_Rendering event
		$logistik_stock_control->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_stock_control->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->actionlink->CellCssClass = "";

		// kodecek
		$logistik_stock_control->kodecek->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->kodecek->CellCssClass = "";

		// tanggal
		$logistik_stock_control->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->tanggal->CellCssClass = "";

		// gudang
		$logistik_stock_control->gudang->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->gudang->CellCssClass = "";

		// cekby
		$logistik_stock_control->cekby->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->cekby->CellCssClass = "";

		// securityby
		$logistik_stock_control->securityby->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->securityby->CellCssClass = "";

		// dirutby
		$logistik_stock_control->dirutby->CellCssStyle = "white-space: nowrap;";
		$logistik_stock_control->dirutby->CellCssClass = "";
		if ($logistik_stock_control->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_stock_control->actionlink->ViewValue = $logistik_stock_control->actionlink->CurrentValue;
			$logistik_stock_control->actionlink->CssStyle = "";
			$logistik_stock_control->actionlink->CssClass = "";
			$logistik_stock_control->actionlink->ViewCustomAttributes = "";

			// kodecek
			$logistik_stock_control->kodecek->ViewValue = $logistik_stock_control->kodecek->CurrentValue;
			$logistik_stock_control->kodecek->CssStyle = "";
			$logistik_stock_control->kodecek->CssClass = "";
			$logistik_stock_control->kodecek->ViewCustomAttributes = "";

			// tanggal
			$logistik_stock_control->tanggal->ViewValue = $logistik_stock_control->tanggal->CurrentValue;
			$logistik_stock_control->tanggal->ViewValue = ew_FormatDateTime($logistik_stock_control->tanggal->ViewValue, 7);
			$logistik_stock_control->tanggal->CssStyle = "";
			$logistik_stock_control->tanggal->CssClass = "";
			$logistik_stock_control->tanggal->ViewCustomAttributes = "";

			// gudang
			if (strval($logistik_stock_control->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_stock_control->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->gudang->ViewValue = $rswrk->fields('nama');
					$logistik_stock_control->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_stock_control->gudang->ViewValue = $logistik_stock_control->gudang->CurrentValue;
				}
			} else {
				$logistik_stock_control->gudang->ViewValue = NULL;
			}
			$logistik_stock_control->gudang->CssStyle = "";
			$logistik_stock_control->gudang->CssClass = "";
			$logistik_stock_control->gudang->ViewCustomAttributes = "";

			// cekby
			if (strval($logistik_stock_control->cekby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->cekby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->cekby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->cekby->ViewValue = $logistik_stock_control->cekby->CurrentValue;
				}
			} else {
				$logistik_stock_control->cekby->ViewValue = NULL;
			}
			$logistik_stock_control->cekby->CssStyle = "";
			$logistik_stock_control->cekby->CssClass = "";
			$logistik_stock_control->cekby->ViewCustomAttributes = "";

			// securityby
			if (strval($logistik_stock_control->securityby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->securityby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->securityby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->securityby->ViewValue = $logistik_stock_control->securityby->CurrentValue;
				}
			} else {
				$logistik_stock_control->securityby->ViewValue = NULL;
			}
			$logistik_stock_control->securityby->CssStyle = "";
			$logistik_stock_control->securityby->CssClass = "";
			$logistik_stock_control->securityby->ViewCustomAttributes = "";

			// dirutby
			if (strval($logistik_stock_control->dirutby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->dirutby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->dirutby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->dirutby->ViewValue = $logistik_stock_control->dirutby->CurrentValue;
				}
			} else {
				$logistik_stock_control->dirutby->ViewValue = NULL;
			}
			$logistik_stock_control->dirutby->CssStyle = "";
			$logistik_stock_control->dirutby->CssClass = "";
			$logistik_stock_control->dirutby->ViewCustomAttributes = "";

			// actionlink
			$logistik_stock_control->actionlink->HrefValue = "";

			// kodecek
			$logistik_stock_control->kodecek->HrefValue = "";

			// tanggal
			$logistik_stock_control->tanggal->HrefValue = "";

			// gudang
			$logistik_stock_control->gudang->HrefValue = "";

			// cekby
			$logistik_stock_control->cekby->HrefValue = "";

			// securityby
			$logistik_stock_control->securityby->HrefValue = "";

			// dirutby
			$logistik_stock_control->dirutby->HrefValue = "";
		} elseif ($logistik_stock_control->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_stock_control->actionlink->EditCustomAttributes = "";
			$logistik_stock_control->actionlink->EditValue = ew_HtmlEncode($logistik_stock_control->actionlink->AdvancedSearch->SearchValue);

			// kodecek
			$logistik_stock_control->kodecek->EditCustomAttributes = "";
			$logistik_stock_control->kodecek->EditValue = ew_HtmlEncode($logistik_stock_control->kodecek->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_stock_control->tanggal->EditCustomAttributes = "";
			$logistik_stock_control->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_stock_control->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// gudang
			$logistik_stock_control->gudang->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_stock_control->gudang->EditValue = $arwrk;

			// cekby
			$logistik_stock_control->cekby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_stock_control->cekby->EditValue = $arwrk;

			// securityby
			$logistik_stock_control->securityby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_stock_control->securityby->EditValue = $arwrk;

			// dirutby
			$logistik_stock_control->dirutby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_stock_control->dirutby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_stock_control->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_stock_control;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_stock_control->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_stock_control;
		$logistik_stock_control->kodecek->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_kodecek");
		$logistik_stock_control->tanggal->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_tanggal");
		$logistik_stock_control->gudang->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_gudang");
		$logistik_stock_control->cekby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_cekby");
		$logistik_stock_control->securityby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_securityby");
		$logistik_stock_control->dirutby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_dirutby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_stock_control;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_stock_control->ExportAll) {
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
		if ($logistik_stock_control->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_stock_control->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_stock_control->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodecek', $logistik_stock_control->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_stock_control->Export);
				ew_ExportAddValue($sExportStr, 'gudang', $logistik_stock_control->Export);
				ew_ExportAddValue($sExportStr, 'cekby', $logistik_stock_control->Export);
				ew_ExportAddValue($sExportStr, 'securityby', $logistik_stock_control->Export);
				ew_ExportAddValue($sExportStr, 'dirutby', $logistik_stock_control->Export);
				echo ew_ExportLine($sExportStr, $logistik_stock_control->Export);
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
				$logistik_stock_control->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_stock_control->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodecek', $logistik_stock_control->kodecek->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_stock_control->tanggal->CurrentValue);
					$XmlDoc->AddField('gudang', $logistik_stock_control->gudang->CurrentValue);
					$XmlDoc->AddField('cekby', $logistik_stock_control->cekby->CurrentValue);
					$XmlDoc->AddField('securityby', $logistik_stock_control->securityby->CurrentValue);
					$XmlDoc->AddField('dirutby', $logistik_stock_control->dirutby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_stock_control->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodecek', $logistik_stock_control->kodecek->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportField('tanggal', $logistik_stock_control->tanggal->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportField('gudang', $logistik_stock_control->gudang->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportField('cekby', $logistik_stock_control->cekby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportField('securityby', $logistik_stock_control->securityby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportField('dirutby', $logistik_stock_control->dirutby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_stock_control->kodecek->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						ew_ExportAddValue($sExportStr, $logistik_stock_control->tanggal->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						ew_ExportAddValue($sExportStr, $logistik_stock_control->gudang->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						ew_ExportAddValue($sExportStr, $logistik_stock_control->cekby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						ew_ExportAddValue($sExportStr, $logistik_stock_control->securityby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						ew_ExportAddValue($sExportStr, $logistik_stock_control->dirutby->ExportValue($logistik_stock_control->Export, $logistik_stock_control->ExportOriginalValue), $logistik_stock_control->Export);
						echo ew_ExportLine($sExportStr, $logistik_stock_control->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_stock_control->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_stock_control->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_stock_control';

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
