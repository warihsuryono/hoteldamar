<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_workshop_qr_vendorinfo.php" ?>
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
$logistik_workshop_qr_vendor_list = new clogistik_workshop_qr_vendor_list();
$Page =& $logistik_workshop_qr_vendor_list;

// Page init processing
$logistik_workshop_qr_vendor_list->Page_Init();

// Page main processing
$logistik_workshop_qr_vendor_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_workshop_qr_vendor_list = new ew_Page("logistik_workshop_qr_vendor_list");

// page properties
logistik_workshop_qr_vendor_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_workshop_qr_vendor_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_workshop_qr_vendor_list.ValidateSearch = function(fobj) {
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
logistik_workshop_qr_vendor_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_workshop_qr_vendor_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_workshop_qr_vendor_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_workshop_qr_vendor_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_workshop_qr_vendor_list.ShowHighlightText = "Show highlight"; 
logistik_workshop_qr_vendor_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_workshop_qr_vendor->Export == "" && $logistik_workshop_qr_vendor->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_workshop_qr_vendor_list->LoadRecordset();
	$logistik_workshop_qr_vendor_list->lTotalRecs = ($bSelectLimit) ? $logistik_workshop_qr_vendor->SelectRecordCount() : $rs->RecordCount();
	$logistik_workshop_qr_vendor_list->lStartRec = 1;
	if ($logistik_workshop_qr_vendor_list->lDisplayRecs <= 0) // Display all records
		$logistik_workshop_qr_vendor_list->lDisplayRecs = $logistik_workshop_qr_vendor_list->lTotalRecs;
	if (!($logistik_workshop_qr_vendor->ExportAll && $logistik_workshop_qr_vendor->Export <> ""))
		$logistik_workshop_qr_vendor_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_workshop_qr_vendor_list->LoadRecordset($logistik_workshop_qr_vendor_list->lStartRec-1, $logistik_workshop_qr_vendor_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Daftar Quotation Dari Supplier  (Workshop)</b></h3>
<?php if ($logistik_workshop_qr_vendor->Export == "" && $logistik_workshop_qr_vendor->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_workshop_qr_vendor->Export == "" && $logistik_workshop_qr_vendor->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_workshop_qr_vendor_list);" style="text-decoration: none;"><img id="logistik_workshop_qr_vendor_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_workshop_qr_vendor_list_SearchPanel">
<form name="flogistik_workshop_qr_vendorlistsrch" id="flogistik_workshop_qr_vendorlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_workshop_qr_vendor_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_workshop_qr_vendor">
<?php
if ($gsSearchError == "")
	$logistik_workshop_qr_vendor_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_workshop_qr_vendor->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_workshop_qr_vendor_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">QR No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_qrno" id="z_qrno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_qrno" id="x_qrno" size="30" maxlength="30" value="<?php echo $logistik_workshop_qr_vendor->qrno->EditValue ?>"<?php echo $logistik_workshop_qr_vendor->qrno->EditAttributes() ?>>
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
<select id="x_vendorid" name="x_vendorid"<?php echo $logistik_workshop_qr_vendor->vendorid->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_qr_vendor->vendorid->EditValue)) {
	$arwrk = $logistik_workshop_qr_vendor->vendorid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_qr_vendor->vendorid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Tanggal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal" id="z_tanggal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_workshop_qr_vendor->tanggal->EditValue ?>"<?php echo $logistik_workshop_qr_vendor->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">Workshop</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodeworkshop" id="z_kodeworkshop" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_kodeworkshop" name="x_kodeworkshop"<?php echo $logistik_workshop_qr_vendor->kodeworkshop->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_qr_vendor->kodeworkshop->EditValue)) {
	$arwrk = $logistik_workshop_qr_vendor->kodeworkshop->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_qr_vendor->kodeworkshop->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Diterima Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_receiveby" id="z_receiveby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_receiveby" name="x_receiveby"<?php echo $logistik_workshop_qr_vendor->receiveby->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_qr_vendor->receiveby->EditValue)) {
	$arwrk = $logistik_workshop_qr_vendor->receiveby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_qr_vendor->receiveby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_workshop_qr_vendor_list->sSrchWhere <> "" && $logistik_workshop_qr_vendor_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_workshop_qr_vendor_list, this, '<?php echo $logistik_workshop_qr_vendor->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_workshop_qr_vendor_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_workshop_qr_vendor->CurrentAction <> "gridadd" && $logistik_workshop_qr_vendor->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_workshop_qr_vendor_list->Pager)) $logistik_workshop_qr_vendor_list->Pager = new cPrevNextPager($logistik_workshop_qr_vendor_list->lStartRec, $logistik_workshop_qr_vendor_list->lDisplayRecs, $logistik_workshop_qr_vendor_list->lTotalRecs) ?>
<?php if ($logistik_workshop_qr_vendor_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_workshop_qr_vendor_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>start=<?php echo $logistik_workshop_qr_vendor_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_workshop_qr_vendor_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>start=<?php echo $logistik_workshop_qr_vendor_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_workshop_qr_vendor_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_workshop_qr_vendor_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>start=<?php echo $logistik_workshop_qr_vendor_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_workshop_qr_vendor_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_qr_vendor_list->PageUrl() ?>start=<?php echo $logistik_workshop_qr_vendor_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_workshop_qr_vendor_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_workshop_qr_vendor_list->Pager->FromIndex ?> to <?php echo $logistik_workshop_qr_vendor_list->Pager->ToIndex ?> of <?php echo $logistik_workshop_qr_vendor_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_workshop_qr_vendor_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_workshop_qr_vendor_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_workshop_qr_vendor">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_workshop_qr_vendor_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_workshop_qr_vendor->AddUrl() ?>?qrno=<?php echo $_GET["qrno"]; ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_workshop_qr_vendorlist" id="flogistik_workshop_qr_vendorlist" class="ewForm" action="" method="post">
<?php if ($logistik_workshop_qr_vendor_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_workshop_qr_vendor_list->lOptionCnt = 0;
	$logistik_workshop_qr_vendor_list->lOptionCnt += count($logistik_workshop_qr_vendor_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_workshop_qr_vendor->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_workshop_qr_vendor_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_workshop_qr_vendor->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_qr_vendor->qrno->Visible) { // qrno ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->qrno) == "") { ?>
		<td style="white-space: nowrap;">QR No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->qrno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>QR No</td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->qrno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->qrno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_qr_vendor->vendorid->Visible) { // vendorid ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->vendorid) == "") { ?>
		<td style="white-space: nowrap;">Supplier</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->vendorid) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Supplier</td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->vendorid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->vendorid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_qr_vendor->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_qr_vendor->kodeworkshop->Visible) { // kodeworkshop ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->kodeworkshop) == "") { ?>
		<td style="white-space: nowrap;">Workshop</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->kodeworkshop) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Workshop</td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->kodeworkshop->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->kodeworkshop->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_qr_vendor->receiveby->Visible) { // receiveby ?>
	<?php if ($logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->receiveby) == "") { ?>
		<td style="white-space: nowrap;">Diterima Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_qr_vendor->SortUrl($logistik_workshop_qr_vendor->receiveby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Diterima Oleh</td><td style="width: 10px;"><?php if ($logistik_workshop_qr_vendor->receiveby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_qr_vendor->receiveby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_workshop_qr_vendor->ExportAll && $logistik_workshop_qr_vendor->Export <> "") {
	$logistik_workshop_qr_vendor_list->lStopRec = $logistik_workshop_qr_vendor_list->lTotalRecs;
} else {
	$logistik_workshop_qr_vendor_list->lStopRec = $logistik_workshop_qr_vendor_list->lStartRec + $logistik_workshop_qr_vendor_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_workshop_qr_vendor_list->lRecCount = $logistik_workshop_qr_vendor_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_workshop_qr_vendor->SelectLimit && $logistik_workshop_qr_vendor_list->lStartRec > 1)
		$rs->Move($logistik_workshop_qr_vendor_list->lStartRec - 1);
}
$logistik_workshop_qr_vendor_list->lRowCnt = 0;
while (($logistik_workshop_qr_vendor->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_workshop_qr_vendor_list->lRecCount < $logistik_workshop_qr_vendor_list->lStopRec) {
	$logistik_workshop_qr_vendor_list->lRecCount++;
	if (intval($logistik_workshop_qr_vendor_list->lRecCount) >= intval($logistik_workshop_qr_vendor_list->lStartRec)) {
		$logistik_workshop_qr_vendor_list->lRowCnt++;

	// Init row class and style
	$logistik_workshop_qr_vendor->CssClass = "";
	$logistik_workshop_qr_vendor->CssStyle = "";
	$logistik_workshop_qr_vendor->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_workshop_qr_vendor->CurrentAction == "gridadd") {
		$logistik_workshop_qr_vendor_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_workshop_qr_vendor_list->LoadRowValues($rs); // Load row values
	}
	$logistik_workshop_qr_vendor->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_workshop_qr_vendor_list->RenderRow();
?>
	<tr<?php echo $logistik_workshop_qr_vendor->RowAttributes() ?>>
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_workshop_qr_vendor_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_workshop_qr_vendor->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->actionlink->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->qrno->Visible) { // qrno ?>
		<td<?php echo $logistik_workshop_qr_vendor->qrno->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->qrno->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->qrno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->vendorid->Visible) { // vendorid ?>
		<td<?php echo $logistik_workshop_qr_vendor->vendorid->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->vendorid->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->vendorid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_workshop_qr_vendor->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->tanggal->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->kodeworkshop->Visible) { // kodeworkshop ?>
		<td<?php echo $logistik_workshop_qr_vendor->kodeworkshop->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->kodeworkshop->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->kodeworkshop->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_qr_vendor->receiveby->Visible) { // receiveby ?>
		<td<?php echo $logistik_workshop_qr_vendor->receiveby->CellAttributes() ?>>
<div<?php echo $logistik_workshop_qr_vendor->receiveby->ViewAttributes() ?>><?php echo $logistik_workshop_qr_vendor->receiveby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_workshop_qr_vendor->CurrentAction <> "gridadd")
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
<?php if ($logistik_workshop_qr_vendor->Export == "" && $logistik_workshop_qr_vendor->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_workshop_qr_vendor_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_workshop_qr_vendor->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_workshop_qr_vendor_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_workshop_qr_vendor_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_workshop_qr_vendor';

	// Page Object Name
	var $PageObjName = 'logistik_workshop_qr_vendor_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_workshop_qr_vendor;
		if ($logistik_workshop_qr_vendor->UseTokenInUrl) $PageUrl .= "t=" . $logistik_workshop_qr_vendor->TableVar . "&"; // add page token
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
		global $objForm, $logistik_workshop_qr_vendor;
		if ($logistik_workshop_qr_vendor->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_workshop_qr_vendor->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_workshop_qr_vendor->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_workshop_qr_vendor_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_workshop_qr_vendor"] = new clogistik_workshop_qr_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_workshop_qr_vendor', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_workshop_qr_vendor;
	$logistik_workshop_qr_vendor->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_workshop_qr_vendor->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_workshop_qr_vendor->TableVar; // Get export file, used in header
	if ($logistik_workshop_qr_vendor->Export == "print" || $logistik_workshop_qr_vendor->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_workshop_qr_vendor->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_workshop_qr_vendor->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_workshop_qr_vendor->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_workshop_qr_vendor->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_workshop_qr_vendor;
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
		if ($logistik_workshop_qr_vendor->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_workshop_qr_vendor->getRecordsPerPage(); // Restore from Session
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
		$logistik_workshop_qr_vendor->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_workshop_qr_vendor->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "`qrno` LIKE '$_GET[qrno]%'";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$logistik_workshop_qr_vendor->setSessionWhere($sFilter);
		$logistik_workshop_qr_vendor->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_workshop_qr_vendor->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_workshop_qr_vendor;
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
			$logistik_workshop_qr_vendor->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_workshop_qr_vendor;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->actionlink, FALSE); // Field actionlink
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->qrno, FALSE); // Field qrno
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->vendorid, FALSE); // Field vendorid
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->kodeworkshop, FALSE); // Field kodeworkshop
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $logistik_workshop_qr_vendor->receiveby, FALSE); // Field receiveby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_workshop_qr_vendor->actionlink); // Field actionlink
			$this->SetSearchParm($logistik_workshop_qr_vendor->qrno); // Field qrno
			$this->SetSearchParm($logistik_workshop_qr_vendor->vendorid); // Field vendorid
			$this->SetSearchParm($logistik_workshop_qr_vendor->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_workshop_qr_vendor->kodeworkshop); // Field kodeworkshop
			$this->SetSearchParm($logistik_workshop_qr_vendor->notes); // Field notes
			$this->SetSearchParm($logistik_workshop_qr_vendor->receiveby); // Field receiveby
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
		global $logistik_workshop_qr_vendor;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_workshop_qr_vendor->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_workshop_qr_vendor->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_workshop_qr_vendor->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_workshop_qr_vendor->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_workshop_qr_vendor;
		$this->sSrchWhere = "";
		$logistik_workshop_qr_vendor->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_workshop_qr_vendor;
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_actionlink", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_qrno", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_vendorid", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_tanggal", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_kodeworkshop", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_notes", "");
		$logistik_workshop_qr_vendor->setAdvancedSearch("x_receiveby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_workshop_qr_vendor;
		$this->sSrchWhere = $logistik_workshop_qr_vendor->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_workshop_qr_vendor;
		 $logistik_workshop_qr_vendor->actionlink->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_actionlink");
		 $logistik_workshop_qr_vendor->qrno->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_qrno");
		 $logistik_workshop_qr_vendor->vendorid->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_vendorid");
		 $logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_tanggal");
		 $logistik_workshop_qr_vendor->kodeworkshop->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_kodeworkshop");
		 $logistik_workshop_qr_vendor->notes->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_notes");
		 $logistik_workshop_qr_vendor->receiveby->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_receiveby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_workshop_qr_vendor;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_workshop_qr_vendor->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_workshop_qr_vendor->CurrentOrderType = @$_GET["ordertype"];
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->actionlink); // Field 
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->qrno); // Field 
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->vendorid); // Field 
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->tanggal); // Field 
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->kodeworkshop); // Field 
			$logistik_workshop_qr_vendor->UpdateSort($logistik_workshop_qr_vendor->receiveby); // Field 
			$logistik_workshop_qr_vendor->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_workshop_qr_vendor;
		$sOrderBy = $logistik_workshop_qr_vendor->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_workshop_qr_vendor->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_workshop_qr_vendor->SqlOrderBy();
				$logistik_workshop_qr_vendor->setSessionOrderBy($sOrderBy);
				$logistik_workshop_qr_vendor->qrno->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_workshop_qr_vendor;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_workshop_qr_vendor->setSessionOrderBy($sOrderBy);
				$logistik_workshop_qr_vendor->actionlink->setSort("");
				$logistik_workshop_qr_vendor->qrno->setSort("");
				$logistik_workshop_qr_vendor->vendorid->setSort("");
				$logistik_workshop_qr_vendor->tanggal->setSort("");
				$logistik_workshop_qr_vendor->kodeworkshop->setSort("");
				$logistik_workshop_qr_vendor->receiveby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_workshop_qr_vendor;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_workshop_qr_vendor->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_workshop_qr_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_workshop_qr_vendor;

		// Load search values
		// actionlink

		$logistik_workshop_qr_vendor->actionlink->AdvancedSearch->SearchValue = @$_GET["x_actionlink"];
		$logistik_workshop_qr_vendor->actionlink->AdvancedSearch->SearchOperator = @$_GET["z_actionlink"];

		// qrno
		$logistik_workshop_qr_vendor->qrno->AdvancedSearch->SearchValue = @$_GET["x_qrno"];
		$logistik_workshop_qr_vendor->qrno->AdvancedSearch->SearchOperator = @$_GET["z_qrno"];

		// vendorid
		$logistik_workshop_qr_vendor->vendorid->AdvancedSearch->SearchValue = @$_GET["x_vendorid"];
		$logistik_workshop_qr_vendor->vendorid->AdvancedSearch->SearchOperator = @$_GET["z_vendorid"];

		// tanggal
		$logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// kodeworkshop
		$logistik_workshop_qr_vendor->kodeworkshop->AdvancedSearch->SearchValue = @$_GET["x_kodeworkshop"];
		$logistik_workshop_qr_vendor->kodeworkshop->AdvancedSearch->SearchOperator = @$_GET["z_kodeworkshop"];

		// notes
		$logistik_workshop_qr_vendor->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$logistik_workshop_qr_vendor->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// receiveby
		$logistik_workshop_qr_vendor->receiveby->AdvancedSearch->SearchValue = @$_GET["x_receiveby"];
		$logistik_workshop_qr_vendor->receiveby->AdvancedSearch->SearchOperator = @$_GET["z_receiveby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_workshop_qr_vendor;

		// Call Recordset Selecting event
		$logistik_workshop_qr_vendor->Recordset_Selecting($logistik_workshop_qr_vendor->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_workshop_qr_vendor->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_workshop_qr_vendor->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_workshop_qr_vendor;
		$sFilter = $logistik_workshop_qr_vendor->KeyFilter();

		// Call Row Selecting event
		$logistik_workshop_qr_vendor->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_workshop_qr_vendor->CurrentFilter = $sFilter;
		$sSql = $logistik_workshop_qr_vendor->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_workshop_qr_vendor->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_workshop_qr_vendor;
		$logistik_workshop_qr_vendor->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_workshop_qr_vendor->qrno->setDbValue($rs->fields('qrno'));
		$logistik_workshop_qr_vendor->vendorid->setDbValue($rs->fields('vendorid'));
		$logistik_workshop_qr_vendor->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_workshop_qr_vendor->seqno->setDbValue($rs->fields('seqno'));
		$logistik_workshop_qr_vendor->kodeworkshop->setDbValue($rs->fields('kodeworkshop'));
		$logistik_workshop_qr_vendor->notes->setDbValue($rs->fields('notes'));
		$logistik_workshop_qr_vendor->receiveby->setDbValue($rs->fields('receiveby'));
		$logistik_workshop_qr_vendor->receivedate->setDbValue($rs->fields('receivedate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_workshop_qr_vendor;

		// Call Row_Rendering event
		$logistik_workshop_qr_vendor->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_workshop_qr_vendor->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->actionlink->CellCssClass = "";

		// qrno
		$logistik_workshop_qr_vendor->qrno->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->qrno->CellCssClass = "";

		// vendorid
		$logistik_workshop_qr_vendor->vendorid->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->vendorid->CellCssClass = "";

		// tanggal
		$logistik_workshop_qr_vendor->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->tanggal->CellCssClass = "";

		// kodeworkshop
		$logistik_workshop_qr_vendor->kodeworkshop->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->kodeworkshop->CellCssClass = "";

		// receiveby
		$logistik_workshop_qr_vendor->receiveby->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_qr_vendor->receiveby->CellCssClass = "";
		if ($logistik_workshop_qr_vendor->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_workshop_qr_vendor->actionlink->ViewValue = $logistik_workshop_qr_vendor->actionlink->CurrentValue;
			$logistik_workshop_qr_vendor->actionlink->CssStyle = "";
			$logistik_workshop_qr_vendor->actionlink->CssClass = "";
			$logistik_workshop_qr_vendor->actionlink->ViewCustomAttributes = "";

			// qrno
			$logistik_workshop_qr_vendor->qrno->ViewValue = $logistik_workshop_qr_vendor->qrno->CurrentValue;
			$logistik_workshop_qr_vendor->qrno->CssStyle = "";
			$logistik_workshop_qr_vendor->qrno->CssClass = "";
			$logistik_workshop_qr_vendor->qrno->ViewCustomAttributes = "";

			// vendorid
			if (strval($logistik_workshop_qr_vendor->vendorid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_vendor` WHERE `kode` = '" . ew_AdjustSql($logistik_workshop_qr_vendor->vendorid->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_qr_vendor->vendorid->ViewValue = $rswrk->fields('nama');
					$logistik_workshop_qr_vendor->vendorid->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_workshop_qr_vendor->vendorid->ViewValue = $logistik_workshop_qr_vendor->vendorid->CurrentValue;
				}
			} else {
				$logistik_workshop_qr_vendor->vendorid->ViewValue = NULL;
			}
			$logistik_workshop_qr_vendor->vendorid->CssStyle = "";
			$logistik_workshop_qr_vendor->vendorid->CssClass = "";
			$logistik_workshop_qr_vendor->vendorid->ViewCustomAttributes = "";

			// tanggal
			$logistik_workshop_qr_vendor->tanggal->ViewValue = $logistik_workshop_qr_vendor->tanggal->CurrentValue;
			$logistik_workshop_qr_vendor->tanggal->ViewValue = ew_FormatDateTime($logistik_workshop_qr_vendor->tanggal->ViewValue, 7);
			$logistik_workshop_qr_vendor->tanggal->CssStyle = "";
			$logistik_workshop_qr_vendor->tanggal->CssClass = "";
			$logistik_workshop_qr_vendor->tanggal->ViewCustomAttributes = "";

			// kodeworkshop
			if (strval($logistik_workshop_qr_vendor->kodeworkshop->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_workshop_qr_vendor->kodeworkshop->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_qr_vendor->kodeworkshop->ViewValue = $rswrk->fields('nama');
					$logistik_workshop_qr_vendor->kodeworkshop->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_workshop_qr_vendor->kodeworkshop->ViewValue = $logistik_workshop_qr_vendor->kodeworkshop->CurrentValue;
				}
			} else {
				$logistik_workshop_qr_vendor->kodeworkshop->ViewValue = NULL;
			}
			$logistik_workshop_qr_vendor->kodeworkshop->CssStyle = "";
			$logistik_workshop_qr_vendor->kodeworkshop->CssClass = "";
			$logistik_workshop_qr_vendor->kodeworkshop->ViewCustomAttributes = "";

			// receiveby
			if (strval($logistik_workshop_qr_vendor->receiveby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_qr_vendor->receiveby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_qr_vendor->receiveby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_qr_vendor->receiveby->ViewValue = $logistik_workshop_qr_vendor->receiveby->CurrentValue;
				}
			} else {
				$logistik_workshop_qr_vendor->receiveby->ViewValue = NULL;
			}
			$logistik_workshop_qr_vendor->receiveby->CssStyle = "";
			$logistik_workshop_qr_vendor->receiveby->CssClass = "";
			$logistik_workshop_qr_vendor->receiveby->ViewCustomAttributes = "";

			// actionlink
			$logistik_workshop_qr_vendor->actionlink->HrefValue = "";

			// qrno
			$logistik_workshop_qr_vendor->qrno->HrefValue = "";

			// vendorid
			$logistik_workshop_qr_vendor->vendorid->HrefValue = "";

			// tanggal
			$logistik_workshop_qr_vendor->tanggal->HrefValue = "";

			// kodeworkshop
			$logistik_workshop_qr_vendor->kodeworkshop->HrefValue = "";

			// receiveby
			$logistik_workshop_qr_vendor->receiveby->HrefValue = "";
		} elseif ($logistik_workshop_qr_vendor->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_workshop_qr_vendor->actionlink->EditCustomAttributes = "";
			$logistik_workshop_qr_vendor->actionlink->EditValue = ew_HtmlEncode($logistik_workshop_qr_vendor->actionlink->AdvancedSearch->SearchValue);

			// qrno
			$logistik_workshop_qr_vendor->qrno->EditCustomAttributes = "";
			$logistik_workshop_qr_vendor->qrno->EditValue = ew_HtmlEncode($logistik_workshop_qr_vendor->qrno->AdvancedSearch->SearchValue);

			// vendorid
			$logistik_workshop_qr_vendor->vendorid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_vendor`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_workshop_qr_vendor->vendorid->EditValue = $arwrk;

			// tanggal
			$logistik_workshop_qr_vendor->tanggal->EditCustomAttributes = "";
			$logistik_workshop_qr_vendor->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// kodeworkshop
			$logistik_workshop_qr_vendor->kodeworkshop->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_workshop_qr_vendor->kodeworkshop->EditValue = $arwrk;

			// receiveby
			$logistik_workshop_qr_vendor->receiveby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_qr_vendor->receiveby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_workshop_qr_vendor->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_workshop_qr_vendor;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_workshop_qr_vendor;
		$logistik_workshop_qr_vendor->actionlink->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_actionlink");
		$logistik_workshop_qr_vendor->qrno->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_qrno");
		$logistik_workshop_qr_vendor->vendorid->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_vendorid");
		$logistik_workshop_qr_vendor->tanggal->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_tanggal");
		$logistik_workshop_qr_vendor->kodeworkshop->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_kodeworkshop");
		$logistik_workshop_qr_vendor->notes->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_notes");
		$logistik_workshop_qr_vendor->receiveby->AdvancedSearch->SearchValue = $logistik_workshop_qr_vendor->getAdvancedSearch("x_receiveby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_workshop_qr_vendor;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_workshop_qr_vendor->ExportAll) {
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
		if ($logistik_workshop_qr_vendor->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_workshop_qr_vendor->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_workshop_qr_vendor->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'qrno', $logistik_workshop_qr_vendor->Export);
				ew_ExportAddValue($sExportStr, 'vendorid', $logistik_workshop_qr_vendor->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_workshop_qr_vendor->Export);
				ew_ExportAddValue($sExportStr, 'kodeworkshop', $logistik_workshop_qr_vendor->Export);
				ew_ExportAddValue($sExportStr, 'receiveby', $logistik_workshop_qr_vendor->Export);
				echo ew_ExportLine($sExportStr, $logistik_workshop_qr_vendor->Export);
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
				$logistik_workshop_qr_vendor->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_workshop_qr_vendor->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('qrno', $logistik_workshop_qr_vendor->qrno->CurrentValue);
					$XmlDoc->AddField('vendorid', $logistik_workshop_qr_vendor->vendorid->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_workshop_qr_vendor->tanggal->CurrentValue);
					$XmlDoc->AddField('kodeworkshop', $logistik_workshop_qr_vendor->kodeworkshop->CurrentValue);
					$XmlDoc->AddField('receiveby', $logistik_workshop_qr_vendor->receiveby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_workshop_qr_vendor->Export <> "csv") { // Vertical format
						echo ew_ExportField('qrno', $logistik_workshop_qr_vendor->qrno->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						echo ew_ExportField('vendorid', $logistik_workshop_qr_vendor->vendorid->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						echo ew_ExportField('tanggal', $logistik_workshop_qr_vendor->tanggal->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						echo ew_ExportField('kodeworkshop', $logistik_workshop_qr_vendor->kodeworkshop->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						echo ew_ExportField('receiveby', $logistik_workshop_qr_vendor->receiveby->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_workshop_qr_vendor->qrno->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_qr_vendor->vendorid->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_qr_vendor->tanggal->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_qr_vendor->kodeworkshop->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_qr_vendor->receiveby->ExportValue($logistik_workshop_qr_vendor->Export, $logistik_workshop_qr_vendor->ExportOriginalValue), $logistik_workshop_qr_vendor->Export);
						echo ew_ExportLine($sExportStr, $logistik_workshop_qr_vendor->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_workshop_qr_vendor->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_workshop_qr_vendor->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_workshop_qr_vendor';

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
