<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_qrinfo.php" ?>
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
$logistik_qr_list = new clogistik_qr_list();
$Page =& $logistik_qr_list;

// Page init processing
$logistik_qr_list->Page_Init();

// Page main processing
$logistik_qr_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_qr->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_qr_list = new ew_Page("logistik_qr_list");

// page properties
logistik_qr_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_qr_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_qr_list.ValidateSearch = function(fobj) {
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
logistik_qr_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_qr_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_qr_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_qr_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_qr_list.ShowHighlightText = "Show highlight"; 
logistik_qr_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_qr->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_qr->Export == "" && $logistik_qr->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_qr_list->LoadRecordset();
	$logistik_qr_list->lTotalRecs = ($bSelectLimit) ? $logistik_qr->SelectRecordCount() : $rs->RecordCount();
	$logistik_qr_list->lStartRec = 1;
	if ($logistik_qr_list->lDisplayRecs <= 0) // Display all records
		$logistik_qr_list->lDisplayRecs = $logistik_qr_list->lTotalRecs;
	if (!($logistik_qr->ExportAll && $logistik_qr->Export <> ""))
		$logistik_qr_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_qr_list->LoadRecordset($logistik_qr_list->lStartRec-1, $logistik_qr_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Permintaan Quotation</b></h3>
<?php if ($logistik_qr->Export == "" && $logistik_qr->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_qr_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_qr->Export == "" && $logistik_qr->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_qr_list);" style="text-decoration: none;"><img id="logistik_qr_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_qr_list_SearchPanel">
<form name="flogistik_qrlistsrch" id="flogistik_qrlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_qr_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_qr">
<?php
if ($gsSearchError == "")
	$logistik_qr_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_qr->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_qr_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">QR No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_qrno" id="z_qrno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_qrno" id="x_qrno" size="30" maxlength="30" value="<?php echo $logistik_qr->qrno->EditValue ?>"<?php echo $logistik_qr->qrno->EditAttributes() ?>>
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
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $logistik_qr->kode_pekerjaan->EditValue ?>"<?php echo $logistik_qr->kode_pekerjaan->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_qr->tanggal->EditValue ?>"<?php echo $logistik_qr->tanggal->EditAttributes() ?>>
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
<input type="text" name="x_periode" id="x_periode" value="<?php echo $logistik_qr->periode->EditValue ?>"<?php echo $logistik_qr->periode->EditAttributes() ?>>
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
<select id="x_gudang" name="x_gudang"<?php echo $logistik_qr->gudang->EditAttributes() ?>>
<?php
if (is_array($logistik_qr->gudang->EditValue)) {
	$arwrk = $logistik_qr->gudang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_qr->gudang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<select id="x_createby" name="x_createby"<?php echo $logistik_qr->createby->EditAttributes() ?>>
<?php
if (is_array($logistik_qr->createby->EditValue)) {
	$arwrk = $logistik_qr->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_qr->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_qr_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_qr_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_qr_list->sSrchWhere <> "" && $logistik_qr_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_qr_list, this, '<?php echo $logistik_qr->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_qr_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_qr->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_qr->CurrentAction <> "gridadd" && $logistik_qr->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_qr_list->Pager)) $logistik_qr_list->Pager = new cPrevNextPager($logistik_qr_list->lStartRec, $logistik_qr_list->lDisplayRecs, $logistik_qr_list->lTotalRecs) ?>
<?php if ($logistik_qr_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_qr_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_qr_list->PageUrl() ?>start=<?php echo $logistik_qr_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_qr_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_qr_list->PageUrl() ?>start=<?php echo $logistik_qr_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_qr_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_qr_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_qr_list->PageUrl() ?>start=<?php echo $logistik_qr_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_qr_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_qr_list->PageUrl() ?>start=<?php echo $logistik_qr_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_qr_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_qr_list->Pager->FromIndex ?> to <?php echo $logistik_qr_list->Pager->ToIndex ?> of <?php echo $logistik_qr_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_qr_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_qr_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_qr">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_qr_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_qr_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_qr_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_qr_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_qr_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_qr_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_qr->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_qrlist" id="flogistik_qrlist" class="ewForm" action="" method="post">
<?php if ($logistik_qr_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_qr_list->lOptionCnt = 0;
	$logistik_qr_list->lOptionCnt += count($logistik_qr_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_qr->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_qr->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_qr_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_qr->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_qr->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_qr->qrno->Visible) { // qrno ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->qrno) == "") { ?>
		<td style="white-space: nowrap;">QR No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->qrno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>QR No</td><td style="width: 10px;"><?php if ($logistik_qr->qrno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->qrno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($logistik_qr->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->kode_pekerjaan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($logistik_qr->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_qr->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_qr->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_qr->periode->Visible) { // periode ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->periode) == "") { ?>
		<td style="white-space: nowrap;">Periode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->periode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Periode</td><td style="width: 10px;"><?php if ($logistik_qr->periode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->periode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<!--
<?php if ($logistik_qr->gudang->Visible) { // gudang ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->gudang) == "") { ?>
		<td style="white-space: nowrap;">Gudang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->gudang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Gudang</td><td style="width: 10px;"><?php if ($logistik_qr->gudang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->gudang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_qr->createby->Visible) { // createby ?>
	<?php if ($logistik_qr->SortUrl($logistik_qr->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_qr->SortUrl($logistik_qr->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($logistik_qr->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_qr->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_qr->ExportAll && $logistik_qr->Export <> "") {
	$logistik_qr_list->lStopRec = $logistik_qr_list->lTotalRecs;
} else {
	$logistik_qr_list->lStopRec = $logistik_qr_list->lStartRec + $logistik_qr_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_qr_list->lRecCount = $logistik_qr_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_qr->SelectLimit && $logistik_qr_list->lStartRec > 1)
		$rs->Move($logistik_qr_list->lStartRec - 1);
}
$logistik_qr_list->lRowCnt = 0;
while (($logistik_qr->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_qr_list->lRecCount < $logistik_qr_list->lStopRec) {
	$logistik_qr_list->lRecCount++;
	if (intval($logistik_qr_list->lRecCount) >= intval($logistik_qr_list->lStartRec)) {
		$logistik_qr_list->lRowCnt++;

	// Init row class and style
	$logistik_qr->CssClass = "";
	$logistik_qr->CssStyle = "";
	$logistik_qr->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_qr->CurrentAction == "gridadd") {
		$logistik_qr_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_qr_list->LoadRowValues($rs); // Load row values
	}
	$logistik_qr->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_qr_list->RenderRow();
?>
	<tr<?php echo $logistik_qr->RowAttributes() ?>>
<?php if ($logistik_qr->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_qr_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_qr->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_qr->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_qr->actionlink->ViewAttributes() ?>><?php echo $logistik_qr->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_qr->qrno->Visible) { // qrno ?>
		<td<?php echo $logistik_qr->qrno->CellAttributes() ?>>
<div<?php echo $logistik_qr->qrno->ViewAttributes() ?>><?php echo $logistik_qr->qrno->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_qr->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $logistik_qr->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $logistik_qr->kode_pekerjaan->ViewAttributes() ?>><?php echo $logistik_qr->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_qr->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_qr->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_qr->tanggal->ViewAttributes() ?>><?php echo $logistik_qr->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_qr->periode->Visible) { // periode ?>
		<td<?php echo $logistik_qr->periode->CellAttributes() ?>>
<div<?php echo $logistik_qr->periode->ViewAttributes() ?>><?php echo $logistik_qr->periode->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_qr->gudang->Visible) { // gudang ?>
		<td<?php echo $logistik_qr->gudang->CellAttributes() ?>>
<div<?php echo $logistik_qr->gudang->ViewAttributes() ?>><?php echo $logistik_qr->gudang->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_qr->createby->Visible) { // createby ?>
		<td<?php echo $logistik_qr->createby->CellAttributes() ?>>
<div<?php echo $logistik_qr->createby->ViewAttributes() ?>><?php echo $logistik_qr->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_qr->CurrentAction <> "gridadd")
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
<?php if ($logistik_qr->Export == "" && $logistik_qr->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_qr_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_qr->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_qr_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_qr_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_qr';

	// Page Object Name
	var $PageObjName = 'logistik_qr_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_qr;
		if ($logistik_qr->UseTokenInUrl) $PageUrl .= "t=" . $logistik_qr->TableVar . "&"; // add page token
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
		global $objForm, $logistik_qr;
		if ($logistik_qr->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_qr->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_qr->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_qr_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_qr"] = new clogistik_qr();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_qr', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_qr;
	$logistik_qr->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_qr->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_qr->TableVar; // Get export file, used in header
	if ($logistik_qr->Export == "print" || $logistik_qr->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_qr->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_qr->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_qr->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_qr->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_qr;
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
		if ($logistik_qr->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_qr->getRecordsPerPage(); // Restore from Session
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
		$logistik_qr->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_qr->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_qr->setStartRecordNumber($this->lStartRec);
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
		$logistik_qr->setSessionWhere($sFilter);
		$logistik_qr->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_qr->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_qr;
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
			$logistik_qr->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_qr->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_qr;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_qr->qrno, FALSE); // Field qrno
		$this->BuildSearchSql($sWhere, $logistik_qr->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $logistik_qr->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_qr->periode, FALSE); // Field periode
		$this->BuildSearchSql($sWhere, $logistik_qr->gudang, FALSE); // Field gudang
		$this->BuildSearchSql($sWhere, $logistik_qr->createby, FALSE); // Field createby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_qr->qrno); // Field qrno
			$this->SetSearchParm($logistik_qr->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($logistik_qr->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_qr->periode); // Field periode
			$this->SetSearchParm($logistik_qr->gudang); // Field gudang
			$this->SetSearchParm($logistik_qr->createby); // Field createby
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
		global $logistik_qr;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_qr->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_qr->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_qr->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_qr->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_qr->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_qr;
		$this->sSrchWhere = "";
		$logistik_qr->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_qr;
		$logistik_qr->setAdvancedSearch("x_qrno", "");
		$logistik_qr->setAdvancedSearch("x_kode_pekerjaan", "");
		$logistik_qr->setAdvancedSearch("x_tanggal", "");
		$logistik_qr->setAdvancedSearch("x_periode", "");
		$logistik_qr->setAdvancedSearch("x_gudang", "");
		$logistik_qr->setAdvancedSearch("x_createby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_qr;
		$this->sSrchWhere = $logistik_qr->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_qr;
		 $logistik_qr->qrno->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_qrno");
		 $logistik_qr->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_kode_pekerjaan");
		 $logistik_qr->tanggal->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_tanggal");
		 $logistik_qr->periode->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_periode");
		 $logistik_qr->gudang->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_gudang");
		 $logistik_qr->createby->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_createby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_qr;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_qr->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_qr->CurrentOrderType = @$_GET["ordertype"];
			$logistik_qr->UpdateSort($logistik_qr->actionlink); // Field 
			$logistik_qr->UpdateSort($logistik_qr->qrno); // Field 
			$logistik_qr->UpdateSort($logistik_qr->kode_pekerjaan); // Field 
			$logistik_qr->UpdateSort($logistik_qr->tanggal); // Field 
			$logistik_qr->UpdateSort($logistik_qr->periode); // Field 
			$logistik_qr->UpdateSort($logistik_qr->gudang); // Field 
			$logistik_qr->UpdateSort($logistik_qr->createby); // Field 
			$logistik_qr->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_qr;
		$sOrderBy = $logistik_qr->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_qr->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_qr->SqlOrderBy();
				$logistik_qr->setSessionOrderBy($sOrderBy);
				$logistik_qr->qrno->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_qr;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_qr->setSessionOrderBy($sOrderBy);
				$logistik_qr->actionlink->setSort("");
				$logistik_qr->qrno->setSort("");
				$logistik_qr->kode_pekerjaan->setSort("");
				$logistik_qr->tanggal->setSort("");
				$logistik_qr->periode->setSort("");
				$logistik_qr->gudang->setSort("");
				$logistik_qr->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_qr->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_qr;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_qr->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_qr->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_qr->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_qr->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_qr->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_qr->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_qr;

		// Load search values
		// qrno

		$logistik_qr->qrno->AdvancedSearch->SearchValue = @$_GET["x_qrno"];
		$logistik_qr->qrno->AdvancedSearch->SearchOperator = @$_GET["z_qrno"];

		// kode_pekerjaan
		$logistik_qr->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$logistik_qr->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// tanggal
		$logistik_qr->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_qr->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// periode
		$logistik_qr->periode->AdvancedSearch->SearchValue = @$_GET["x_periode"];
		$logistik_qr->periode->AdvancedSearch->SearchOperator = @$_GET["z_periode"];

		// gudang
		$logistik_qr->gudang->AdvancedSearch->SearchValue = @$_GET["x_gudang"];
		$logistik_qr->gudang->AdvancedSearch->SearchOperator = @$_GET["z_gudang"];

		// createby
		$logistik_qr->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$logistik_qr->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_qr;

		// Call Recordset Selecting event
		$logistik_qr->Recordset_Selecting($logistik_qr->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_qr->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_qr->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_qr;
		$sFilter = $logistik_qr->KeyFilter();

		// Call Row Selecting event
		$logistik_qr->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_qr->CurrentFilter = $sFilter;
		$sSql = $logistik_qr->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_qr->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_qr;
		$logistik_qr->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_qr->qrno->setDbValue($rs->fields('qrno'));
		$logistik_qr->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_qr->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$logistik_qr->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_qr->periode->setDbValue($rs->fields('periode'));
		$logistik_qr->gudang->setDbValue($rs->fields('gudang'));
		$logistik_qr->notes->setDbValue($rs->fields('notes'));
		$logistik_qr->createby->setDbValue($rs->fields('createby'));
		$logistik_qr->createdate->setDbValue($rs->fields('createdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_qr;

		// Call Row_Rendering event
		$logistik_qr->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_qr->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->actionlink->CellCssClass = "";

		// qrno
		$logistik_qr->qrno->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->qrno->CellCssClass = "";

		// kode_pekerjaan
		$logistik_qr->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->kode_pekerjaan->CellCssClass = "";

		// tanggal
		$logistik_qr->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->tanggal->CellCssClass = "";

		// periode
		$logistik_qr->periode->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->periode->CellCssClass = "";

		// gudang
		$logistik_qr->gudang->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->gudang->CellCssClass = "";

		// createby
		$logistik_qr->createby->CellCssStyle = "white-space: nowrap;";
		$logistik_qr->createby->CellCssClass = "";
		if ($logistik_qr->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_qr->actionlink->ViewValue = $logistik_qr->actionlink->CurrentValue;
			$logistik_qr->actionlink->CssStyle = "";
			$logistik_qr->actionlink->CssClass = "";
			$logistik_qr->actionlink->ViewCustomAttributes = "";

			// qrno
			$logistik_qr->qrno->ViewValue = $logistik_qr->qrno->CurrentValue;
			$logistik_qr->qrno->CssStyle = "";
			$logistik_qr->qrno->CssClass = "";
			$logistik_qr->qrno->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_qr->kode_pekerjaan->ViewValue = $logistik_qr->kode_pekerjaan->CurrentValue;
			$logistik_qr->kode_pekerjaan->CssStyle = "";
			$logistik_qr->kode_pekerjaan->CssClass = "";
			$logistik_qr->kode_pekerjaan->ViewCustomAttributes = "";

			// tanggal
			$logistik_qr->tanggal->ViewValue = $logistik_qr->tanggal->CurrentValue;
			$logistik_qr->tanggal->ViewValue = ew_FormatDateTime($logistik_qr->tanggal->ViewValue, 7);
			$logistik_qr->tanggal->CssStyle = "";
			$logistik_qr->tanggal->CssClass = "";
			$logistik_qr->tanggal->ViewCustomAttributes = "";

			// periode
			$logistik_qr->periode->ViewValue = $logistik_qr->periode->CurrentValue;
			$logistik_qr->periode->ViewValue = ew_FormatDateTime($logistik_qr->periode->ViewValue, 7);
			$logistik_qr->periode->CssStyle = "";
			$logistik_qr->periode->CssClass = "";
			$logistik_qr->periode->ViewCustomAttributes = "";

			// gudang
			if (strval($logistik_qr->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_qr->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_qr->gudang->ViewValue = $rswrk->fields('nama');
					$logistik_qr->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_qr->gudang->ViewValue = $logistik_qr->gudang->CurrentValue;
				}
			} else {
				$logistik_qr->gudang->ViewValue = NULL;
			}
			$logistik_qr->gudang->CssStyle = "";
			$logistik_qr->gudang->CssClass = "";
			$logistik_qr->gudang->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_qr->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_qr->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_qr->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_qr->createby->ViewValue = $logistik_qr->createby->CurrentValue;
				}
			} else {
				$logistik_qr->createby->ViewValue = NULL;
			}
			$logistik_qr->createby->CssStyle = "";
			$logistik_qr->createby->CssClass = "";
			$logistik_qr->createby->ViewCustomAttributes = "";

			// actionlink
			$logistik_qr->actionlink->HrefValue = "";

			// qrno
			$logistik_qr->qrno->HrefValue = "";

			// kode_pekerjaan
			$logistik_qr->kode_pekerjaan->HrefValue = "";

			// tanggal
			$logistik_qr->tanggal->HrefValue = "";

			// periode
			$logistik_qr->periode->HrefValue = "";

			// gudang
			$logistik_qr->gudang->HrefValue = "";

			// createby
			$logistik_qr->createby->HrefValue = "";
		} elseif ($logistik_qr->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_qr->actionlink->EditCustomAttributes = "";
			$logistik_qr->actionlink->EditValue = ew_HtmlEncode($logistik_qr->actionlink->AdvancedSearch->SearchValue);

			// qrno
			$logistik_qr->qrno->EditCustomAttributes = "";
			$logistik_qr->qrno->EditValue = ew_HtmlEncode($logistik_qr->qrno->AdvancedSearch->SearchValue);

			// kode_pekerjaan
			$logistik_qr->kode_pekerjaan->EditCustomAttributes = "";
			$logistik_qr->kode_pekerjaan->EditValue = ew_HtmlEncode($logistik_qr->kode_pekerjaan->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_qr->tanggal->EditCustomAttributes = "";
			$logistik_qr->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_qr->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// periode
			$logistik_qr->periode->EditCustomAttributes = "";
			$logistik_qr->periode->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_qr->periode->AdvancedSearch->SearchValue, 7), 7));

			// gudang
			$logistik_qr->gudang->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_qr->gudang->EditValue = $arwrk;

			// createby
			$logistik_qr->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_qr->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_qr->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_qr;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_qr->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($logistik_qr->periode->AdvancedSearch->SearchValue)) {
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
		global $logistik_qr;
		$logistik_qr->qrno->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_qrno");
		$logistik_qr->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_qr->tanggal->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_tanggal");
		$logistik_qr->periode->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_periode");
		$logistik_qr->gudang->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_gudang");
		$logistik_qr->createby->AdvancedSearch->SearchValue = $logistik_qr->getAdvancedSearch("x_createby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_qr;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_qr->ExportAll) {
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
		if ($logistik_qr->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_qr->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_qr->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'qrno', $logistik_qr->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $logistik_qr->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_qr->Export);
				ew_ExportAddValue($sExportStr, 'periode', $logistik_qr->Export);
				ew_ExportAddValue($sExportStr, 'gudang', $logistik_qr->Export);
				ew_ExportAddValue($sExportStr, 'createby', $logistik_qr->Export);
				echo ew_ExportLine($sExportStr, $logistik_qr->Export);
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
				$logistik_qr->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_qr->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('qrno', $logistik_qr->qrno->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $logistik_qr->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_qr->tanggal->CurrentValue);
					$XmlDoc->AddField('periode', $logistik_qr->periode->CurrentValue);
					$XmlDoc->AddField('gudang', $logistik_qr->gudang->CurrentValue);
					$XmlDoc->AddField('createby', $logistik_qr->createby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_qr->Export <> "csv") { // Vertical format
						echo ew_ExportField('qrno', $logistik_qr->qrno->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportField('kode_pekerjaan', $logistik_qr->kode_pekerjaan->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportField('tanggal', $logistik_qr->tanggal->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportField('periode', $logistik_qr->periode->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportField('gudang', $logistik_qr->gudang->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportField('createby', $logistik_qr->createby->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_qr->qrno->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						ew_ExportAddValue($sExportStr, $logistik_qr->kode_pekerjaan->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						ew_ExportAddValue($sExportStr, $logistik_qr->tanggal->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						ew_ExportAddValue($sExportStr, $logistik_qr->periode->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						ew_ExportAddValue($sExportStr, $logistik_qr->gudang->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						ew_ExportAddValue($sExportStr, $logistik_qr->createby->ExportValue($logistik_qr->Export, $logistik_qr->ExportOriginalValue), $logistik_qr->Export);
						echo ew_ExportLine($sExportStr, $logistik_qr->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_qr->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_qr->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_qr';

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
