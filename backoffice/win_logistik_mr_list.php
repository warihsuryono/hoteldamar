<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "win_logistik_mr_info.php" ?>
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
$win_logistik_mr__list = new cwin_logistik_mr__list();
$Page =& $win_logistik_mr__list;

// Page init processing
$win_logistik_mr__list->Page_Init();

// Page main processing
$win_logistik_mr__list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($win_logistik_mr_->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var win_logistik_mr__list = new ew_Page("win_logistik_mr__list");

// page properties
win_logistik_mr__list.PageID = "list"; // page ID
var EW_PAGE_ID = win_logistik_mr__list.PageID; // for backward compatibility

// extend page with validate function for search
win_logistik_mr__list.ValidateSearch = function(fobj) {
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
win_logistik_mr__list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
win_logistik_mr__list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
win_logistik_mr__list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
win_logistik_mr__list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($win_logistik_mr_->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($win_logistik_mr_->Export == "" && $win_logistik_mr_->SelectLimit);
	if (!$bSelectLimit)
		$rs = $win_logistik_mr__list->LoadRecordset();
	$win_logistik_mr__list->lTotalRecs = ($bSelectLimit) ? $win_logistik_mr_->SelectRecordCount() : $rs->RecordCount();
	$win_logistik_mr__list->lStartRec = 1;
	if ($win_logistik_mr__list->lDisplayRecs <= 0) // Display all records
		$win_logistik_mr__list->lDisplayRecs = $win_logistik_mr__list->lTotalRecs;
	if (!($win_logistik_mr_->ExportAll && $win_logistik_mr_->Export <> ""))
		$win_logistik_mr__list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $win_logistik_mr__list->LoadRecordset($win_logistik_mr__list->lStartRec-1, $win_logistik_mr__list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Daftar Permintaan Barang</b></h3>
<?php if ($win_logistik_mr_->Export == "" && $win_logistik_mr_->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_logistik_mr__list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($win_logistik_mr_->Export == "" && $win_logistik_mr_->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(win_logistik_mr__list);" style="text-decoration: none;"><img id="win_logistik_mr__list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="win_logistik_mr__list_SearchPanel">
<form name="fwin_logistik_mr_listsrch" id="fwin_logistik_mr_listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return win_logistik_mr__list.ValidateSearch(this);">
<?php echo $__urlgetshidden;?>
<input type="hidden" id="t" name="t" value="win_logistik_mr_">
<?php
if ($gsSearchError == "")
	$win_logistik_mr__list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$win_logistik_mr_->RowType = EW_ROWTYPE_SEARCH;

// Render row
$win_logistik_mr__list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">MR No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_mrno" id="z_mrno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_mrno" id="x_mrno" size="30" maxlength="30" value="<?php echo $win_logistik_mr_->mrno->EditValue ?>"<?php echo $win_logistik_mr_->mrno->EditAttributes() ?>>
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
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $win_logistik_mr_->kode_pekerjaan->EditValue ?>"<?php echo $win_logistik_mr_->kode_pekerjaan->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $win_logistik_mr_->tanggal->EditValue ?>"<?php echo $win_logistik_mr_->tanggal->EditAttributes() ?>>
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
<input type="text" name="x_periode" id="x_periode" value="<?php echo $win_logistik_mr_->periode->EditValue ?>"<?php echo $win_logistik_mr_->periode->EditAttributes() ?>>
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
<select id="x_gudang" name="x_gudang"<?php echo $win_logistik_mr_->gudang->EditAttributes() ?>>
<?php
if (is_array($win_logistik_mr_->gudang->EditValue)) {
	$arwrk = $win_logistik_mr_->gudang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_logistik_mr_->gudang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<select id="x_createby" name="x_createby"<?php echo $win_logistik_mr_->createby->EditAttributes() ?>>
<?php
if (is_array($win_logistik_mr_->createby->EditValue)) {
	$arwrk = $win_logistik_mr_->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_logistik_mr_->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $win_logistik_mr__list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $win_logistik_mr__list->PageUrl() ?><?php echo $__urlgets; ?>&cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $win_logistik_mr__list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($win_logistik_mr_->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($win_logistik_mr_->CurrentAction <> "gridadd" && $win_logistik_mr_->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php echo $__urlgetshidden;?>
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($win_logistik_mr__list->Pager)) $win_logistik_mr__list->Pager = new cPrevNextPager($win_logistik_mr__list->lStartRec, $win_logistik_mr__list->lDisplayRecs, $win_logistik_mr__list->lTotalRecs) ?>
<?php if ($win_logistik_mr__list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($win_logistik_mr__list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_mr__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_mr__list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($win_logistik_mr__list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_mr__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_mr__list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $win_logistik_mr__list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($win_logistik_mr__list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_mr__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_mr__list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($win_logistik_mr__list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $win_logistik_mr__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_logistik_mr__list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $win_logistik_mr__list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $win_logistik_mr__list->Pager->FromIndex ?> to <?php echo $win_logistik_mr__list->Pager->ToIndex ?> of <?php echo $win_logistik_mr__list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($win_logistik_mr__list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($win_logistik_mr__list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="win_logistik_mr_">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($win_logistik_mr__list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($win_logistik_mr__list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($win_logistik_mr__list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($win_logistik_mr__list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($win_logistik_mr__list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($win_logistik_mr__list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="fwin_logistik_mr_list" id="fwin_logistik_mr_list" class="ewForm" action="" method="post">
<?php if ($win_logistik_mr__list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$win_logistik_mr__list->lOptionCnt = 0;
	$win_logistik_mr__list->lOptionCnt += count($win_logistik_mr__list->ListOptions->Items); // Custom list options
?>
<?php echo $win_logistik_mr_->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($win_logistik_mr_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_logistik_mr__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($win_logistik_mr_->mrno->Visible) { // mrno ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->mrno) == "") { ?>
		<td style="white-space: nowrap;">MR No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->mrno) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>MR No</td><td style="width: 10px;"><?php if ($win_logistik_mr_->mrno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->mrno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($win_logistik_mr_->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->kode_pekerjaan) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($win_logistik_mr_->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($win_logistik_mr_->tanggal->Visible) { // tanggal ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->tanggal) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($win_logistik_mr_->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_logistik_mr_->periode->Visible) { // periode ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->periode) == "") { ?>
		<td style="white-space: nowrap;">Periode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->periode) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Periode</td><td style="width: 10px;"><?php if ($win_logistik_mr_->periode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->periode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($win_logistik_mr_->gudang->Visible) { // gudang ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->gudang) == "") { ?>
		<td style="white-space: nowrap;">Gudang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->gudang) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Gudang</td><td style="width: 10px;"><?php if ($win_logistik_mr_->gudang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->gudang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($win_logistik_mr_->createby->Visible) { // createby ?>
	<?php if ($win_logistik_mr_->SortUrl($win_logistik_mr_->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_logistik_mr_->SortUrl($win_logistik_mr_->createby) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($win_logistik_mr_->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_logistik_mr_->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($win_logistik_mr_->ExportAll && $win_logistik_mr_->Export <> "") {
	$win_logistik_mr__list->lStopRec = $win_logistik_mr__list->lTotalRecs;
} else {
	$win_logistik_mr__list->lStopRec = $win_logistik_mr__list->lStartRec + $win_logistik_mr__list->lDisplayRecs - 1; // Set the last record to display
}
$win_logistik_mr__list->lRecCount = $win_logistik_mr__list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$win_logistik_mr_->SelectLimit && $win_logistik_mr__list->lStartRec > 1)
		$rs->Move($win_logistik_mr__list->lStartRec - 1);
}
$win_logistik_mr__list->lRowCnt = 0;
while (($win_logistik_mr_->CurrentAction == "gridadd" || !$rs->EOF) &&
	$win_logistik_mr__list->lRecCount < $win_logistik_mr__list->lStopRec) {
	$win_logistik_mr__list->lRecCount++;
	if (intval($win_logistik_mr__list->lRecCount) >= intval($win_logistik_mr__list->lStartRec)) {
		$win_logistik_mr__list->lRowCnt++;

	// Init row class and style
	$win_logistik_mr_->CssClass = "";
	$win_logistik_mr_->CssStyle = "";
	$win_logistik_mr_->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($win_logistik_mr_->CurrentAction == "gridadd") {
		$win_logistik_mr__list->LoadDefaultValues(); // Load default values
	} else {
		$win_logistik_mr__list->LoadRowValues($rs); // Load row values
	}
	$win_logistik_mr_->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$win_logistik_mr__list->RenderRow();
?>
	<tr<?php echo $win_logistik_mr_->RowAttributes() ?> ondblclick="showparent_loadmr('<?php echo sanitasi($_REQUEST["textid"]); ?>','<?php echo $win_logistik_mr_->mrno->ListViewValue(); ?>');">
<?php if ($win_logistik_mr_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_logistik_mr__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($win_logistik_mr_->mrno->Visible) { // mrno ?>
		<td<?php echo $win_logistik_mr_->mrno->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->mrno->ViewAttributes() ?>><?php echo $win_logistik_mr_->mrno->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($win_logistik_mr_->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $win_logistik_mr_->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->kode_pekerjaan->ViewAttributes() ?>><?php echo $win_logistik_mr_->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($win_logistik_mr_->tanggal->Visible) { // tanggal ?>
		<td<?php echo $win_logistik_mr_->tanggal->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->tanggal->ViewAttributes() ?>><?php echo $win_logistik_mr_->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_logistik_mr_->periode->Visible) { // periode ?>
		<td<?php echo $win_logistik_mr_->periode->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->periode->ViewAttributes() ?>><?php echo $win_logistik_mr_->periode->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($win_logistik_mr_->gudang->Visible) { // gudang ?>
		<td<?php echo $win_logistik_mr_->gudang->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->gudang->ViewAttributes() ?>><?php echo $win_logistik_mr_->gudang->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($win_logistik_mr_->createby->Visible) { // createby ?>
		<td<?php echo $win_logistik_mr_->createby->CellAttributes() ?>>
<div<?php echo $win_logistik_mr_->createby->ViewAttributes() ?>><?php echo $win_logistik_mr_->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($win_logistik_mr_->CurrentAction <> "gridadd")
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
<?php if ($win_logistik_mr_->Export == "" && $win_logistik_mr_->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(win_logistik_mr__list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($win_logistik_mr_->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$win_logistik_mr__list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cwin_logistik_mr__list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'win_logistik_mr_';

	// Page Object Name
	var $PageObjName = 'win_logistik_mr__list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $win_logistik_mr_;
		if ($win_logistik_mr_->UseTokenInUrl) $PageUrl .= "t=" . $win_logistik_mr_->TableVar . "&"; // add page token
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
		global $objForm, $win_logistik_mr_;
		if ($win_logistik_mr_->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($win_logistik_mr_->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($win_logistik_mr_->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cwin_logistik_mr__list() {
		global $conn;

		// Initialize table object
		$GLOBALS["win_logistik_mr_"] = new cwin_logistik_mr_();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'win_logistik_mr_', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $win_logistik_mr_;
	$win_logistik_mr_->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $win_logistik_mr_->Export; // Get export parameter, used in header
	$gsExportFile = $win_logistik_mr_->TableVar; // Get export file, used in header
	if ($win_logistik_mr_->Export == "print" || $win_logistik_mr_->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($win_logistik_mr_->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($win_logistik_mr_->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($win_logistik_mr_->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($win_logistik_mr_->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $win_logistik_mr_;
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
		if ($win_logistik_mr_->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $win_logistik_mr_->getRecordsPerPage(); // Restore from Session
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
		$win_logistik_mr_->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$win_logistik_mr_->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
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
		$win_logistik_mr_->setSessionWhere($sFilter);
		$win_logistik_mr_->CurrentFilter = "";

		// Export data only
		if (in_array($win_logistik_mr_->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $win_logistik_mr_;
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
			$win_logistik_mr_->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $win_logistik_mr_;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->mrno, FALSE); // Field mrno
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->periode, FALSE); // Field periode
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->gudang, FALSE); // Field gudang
		$this->BuildSearchSql($sWhere, $win_logistik_mr_->createby, FALSE); // Field createby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($win_logistik_mr_->mrno); // Field mrno
			$this->SetSearchParm($win_logistik_mr_->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($win_logistik_mr_->tanggal); // Field tanggal
			$this->SetSearchParm($win_logistik_mr_->periode); // Field periode
			$this->SetSearchParm($win_logistik_mr_->gudang); // Field gudang
			$this->SetSearchParm($win_logistik_mr_->createby); // Field createby
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
		global $win_logistik_mr_;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$win_logistik_mr_->setAdvancedSearch("x_$FldParm", $FldVal);
		$win_logistik_mr_->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$win_logistik_mr_->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$win_logistik_mr_->setAdvancedSearch("y_$FldParm", $FldVal2);
		$win_logistik_mr_->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $win_logistik_mr_;
		$this->sSrchWhere = "";
		$win_logistik_mr_->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $win_logistik_mr_;
		$win_logistik_mr_->setAdvancedSearch("x_mrno", "");
		$win_logistik_mr_->setAdvancedSearch("x_kode_pekerjaan", "");
		$win_logistik_mr_->setAdvancedSearch("x_tanggal", "");
		$win_logistik_mr_->setAdvancedSearch("x_periode", "");
		$win_logistik_mr_->setAdvancedSearch("x_gudang", "");
		$win_logistik_mr_->setAdvancedSearch("x_createby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $win_logistik_mr_;
		$this->sSrchWhere = $win_logistik_mr_->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $win_logistik_mr_;
		 $win_logistik_mr_->mrno->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_mrno");
		 $win_logistik_mr_->kode_pekerjaan->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_kode_pekerjaan");
		 $win_logistik_mr_->tanggal->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_tanggal");
		 $win_logistik_mr_->periode->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_periode");
		 $win_logistik_mr_->gudang->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_gudang");
		 $win_logistik_mr_->createby->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_createby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $win_logistik_mr_;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$win_logistik_mr_->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$win_logistik_mr_->CurrentOrderType = @$_GET["ordertype"];
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->mrno); // Field 
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->kode_pekerjaan); // Field 
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->tanggal); // Field 
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->periode); // Field 
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->gudang); // Field 
			$win_logistik_mr_->UpdateSort($win_logistik_mr_->createby); // Field 
			$win_logistik_mr_->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $win_logistik_mr_;
		$sOrderBy = $win_logistik_mr_->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($win_logistik_mr_->SqlOrderBy() <> "") {
				$sOrderBy = $win_logistik_mr_->SqlOrderBy();
				$win_logistik_mr_->setSessionOrderBy($sOrderBy);
				$win_logistik_mr_->mrno->setSort("DESC");
				$win_logistik_mr_->tanggal->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $win_logistik_mr_;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$win_logistik_mr_->setSessionOrderBy($sOrderBy);
				$win_logistik_mr_->mrno->setSort("");
				$win_logistik_mr_->kode_pekerjaan->setSort("");
				$win_logistik_mr_->tanggal->setSort("");
				$win_logistik_mr_->periode->setSort("");
				$win_logistik_mr_->gudang->setSort("");
				$win_logistik_mr_->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $win_logistik_mr_;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $win_logistik_mr_->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$win_logistik_mr_->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $win_logistik_mr_;

		// Load search values
		// mrno

		$win_logistik_mr_->mrno->AdvancedSearch->SearchValue = @$_GET["x_mrno"];
		$win_logistik_mr_->mrno->AdvancedSearch->SearchOperator = @$_GET["z_mrno"];

		// kode_pekerjaan
		$win_logistik_mr_->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$win_logistik_mr_->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// tanggal
		$win_logistik_mr_->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$win_logistik_mr_->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// periode
		$win_logistik_mr_->periode->AdvancedSearch->SearchValue = @$_GET["x_periode"];
		$win_logistik_mr_->periode->AdvancedSearch->SearchOperator = @$_GET["z_periode"];

		// gudang
		$win_logistik_mr_->gudang->AdvancedSearch->SearchValue = @$_GET["x_gudang"];
		$win_logistik_mr_->gudang->AdvancedSearch->SearchOperator = @$_GET["z_gudang"];

		// createby
		$win_logistik_mr_->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$win_logistik_mr_->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $win_logistik_mr_;

		// Call Recordset Selecting event
		$win_logistik_mr_->Recordset_Selecting($win_logistik_mr_->CurrentFilter);

		// Load list page SQL
		$sSql = $win_logistik_mr_->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$win_logistik_mr_->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $win_logistik_mr_;
		$sFilter = $win_logistik_mr_->KeyFilter();

		// Call Row Selecting event
		$win_logistik_mr_->Row_Selecting($sFilter);

		// Load sql based on filter
		$win_logistik_mr_->CurrentFilter = $sFilter;
		$sSql = $win_logistik_mr_->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$win_logistik_mr_->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $win_logistik_mr_;
		$win_logistik_mr_->mrno->setDbValue($rs->fields('mrno'));
		$win_logistik_mr_->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$win_logistik_mr_->tanggal->setDbValue($rs->fields('tanggal'));
		$win_logistik_mr_->periode->setDbValue($rs->fields('periode'));
		$win_logistik_mr_->peruntukan->setDbValue($rs->fields('peruntukan'));
		$win_logistik_mr_->gudang->setDbValue($rs->fields('gudang'));
		$win_logistik_mr_->createby->setDbValue($rs->fields('createby'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $win_logistik_mr_;

		// Call Row_Rendering event
		$win_logistik_mr_->Row_Rendering();

		// Common render codes for all row types
		// mrno

		$win_logistik_mr_->mrno->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->mrno->CellCssClass = "";

		// kode_pekerjaan
		$win_logistik_mr_->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->kode_pekerjaan->CellCssClass = "";

		// tanggal
		$win_logistik_mr_->tanggal->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->tanggal->CellCssClass = "";

		// periode
		$win_logistik_mr_->periode->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->periode->CellCssClass = "";

		// gudang
		$win_logistik_mr_->gudang->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->gudang->CellCssClass = "";

		// createby
		$win_logistik_mr_->createby->CellCssStyle = "white-space: nowrap;";
		$win_logistik_mr_->createby->CellCssClass = "";
		if ($win_logistik_mr_->RowType == EW_ROWTYPE_VIEW) { // View row

			// mrno
			$win_logistik_mr_->mrno->ViewValue = $win_logistik_mr_->mrno->CurrentValue;
			$win_logistik_mr_->mrno->CssStyle = "";
			$win_logistik_mr_->mrno->CssClass = "";
			$win_logistik_mr_->mrno->ViewCustomAttributes = "";

			// kode_pekerjaan
			$win_logistik_mr_->kode_pekerjaan->ViewValue = $win_logistik_mr_->kode_pekerjaan->CurrentValue;
			$win_logistik_mr_->kode_pekerjaan->CssStyle = "";
			$win_logistik_mr_->kode_pekerjaan->CssClass = "";
			$win_logistik_mr_->kode_pekerjaan->ViewCustomAttributes = "";

			// tanggal
			$win_logistik_mr_->tanggal->ViewValue = $win_logistik_mr_->tanggal->CurrentValue;
			$win_logistik_mr_->tanggal->ViewValue = ew_FormatDateTime($win_logistik_mr_->tanggal->ViewValue, 7);
			$win_logistik_mr_->tanggal->CssStyle = "";
			$win_logistik_mr_->tanggal->CssClass = "";
			$win_logistik_mr_->tanggal->ViewCustomAttributes = "";

			// periode
			$win_logistik_mr_->periode->ViewValue = $win_logistik_mr_->periode->CurrentValue;
			$win_logistik_mr_->periode->ViewValue = ew_FormatDateTime($win_logistik_mr_->periode->ViewValue, 7);
			$win_logistik_mr_->periode->CssStyle = "";
			$win_logistik_mr_->periode->CssClass = "";
			$win_logistik_mr_->periode->ViewCustomAttributes = "";

			// gudang
			if (strval($win_logistik_mr_->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($win_logistik_mr_->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$win_logistik_mr_->gudang->ViewValue = $rswrk->fields('nama');
					$win_logistik_mr_->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$win_logistik_mr_->gudang->ViewValue = $win_logistik_mr_->gudang->CurrentValue;
				}
			} else {
				$win_logistik_mr_->gudang->ViewValue = NULL;
			}
			$win_logistik_mr_->gudang->CssStyle = "";
			$win_logistik_mr_->gudang->CssClass = "";
			$win_logistik_mr_->gudang->ViewCustomAttributes = "";

			// createby
			if (strval($win_logistik_mr_->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($win_logistik_mr_->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$win_logistik_mr_->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$win_logistik_mr_->createby->ViewValue = $win_logistik_mr_->createby->CurrentValue;
				}
			} else {
				$win_logistik_mr_->createby->ViewValue = NULL;
			}
			$win_logistik_mr_->createby->CssStyle = "";
			$win_logistik_mr_->createby->CssClass = "";
			$win_logistik_mr_->createby->ViewCustomAttributes = "";

			// mrno
			$win_logistik_mr_->mrno->HrefValue = "";

			// kode_pekerjaan
			$win_logistik_mr_->kode_pekerjaan->HrefValue = "";

			// tanggal
			$win_logistik_mr_->tanggal->HrefValue = "";

			// periode
			$win_logistik_mr_->periode->HrefValue = "";

			// gudang
			$win_logistik_mr_->gudang->HrefValue = "";

			// createby
			$win_logistik_mr_->createby->HrefValue = "";
		} elseif ($win_logistik_mr_->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// mrno
			$win_logistik_mr_->mrno->EditCustomAttributes = "";
			$win_logistik_mr_->mrno->EditValue = ew_HtmlEncode($win_logistik_mr_->mrno->AdvancedSearch->SearchValue);

			// kode_pekerjaan
			$win_logistik_mr_->kode_pekerjaan->EditCustomAttributes = "";
			$win_logistik_mr_->kode_pekerjaan->EditValue = ew_HtmlEncode($win_logistik_mr_->kode_pekerjaan->AdvancedSearch->SearchValue);

			// tanggal
			$win_logistik_mr_->tanggal->EditCustomAttributes = "";
			$win_logistik_mr_->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($win_logistik_mr_->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// periode
			$win_logistik_mr_->periode->EditCustomAttributes = "";
			$win_logistik_mr_->periode->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($win_logistik_mr_->periode->AdvancedSearch->SearchValue, 7), 7));

			// gudang
			$win_logistik_mr_->gudang->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$win_logistik_mr_->gudang->EditValue = $arwrk;

			// createby
			$win_logistik_mr_->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$win_logistik_mr_->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$win_logistik_mr_->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $win_logistik_mr_;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($win_logistik_mr_->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($win_logistik_mr_->periode->AdvancedSearch->SearchValue)) {
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
		global $win_logistik_mr_;
		$win_logistik_mr_->mrno->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_mrno");
		$win_logistik_mr_->kode_pekerjaan->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_kode_pekerjaan");
		$win_logistik_mr_->tanggal->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_tanggal");
		$win_logistik_mr_->periode->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_periode");
		$win_logistik_mr_->gudang->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_gudang");
		$win_logistik_mr_->createby->AdvancedSearch->SearchValue = $win_logistik_mr_->getAdvancedSearch("x_createby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $win_logistik_mr_;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($win_logistik_mr_->ExportAll) {
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
		if ($win_logistik_mr_->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($win_logistik_mr_->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $win_logistik_mr_->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'mrno', $win_logistik_mr_->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $win_logistik_mr_->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $win_logistik_mr_->Export);
				ew_ExportAddValue($sExportStr, 'periode', $win_logistik_mr_->Export);
				ew_ExportAddValue($sExportStr, 'gudang', $win_logistik_mr_->Export);
				ew_ExportAddValue($sExportStr, 'createby', $win_logistik_mr_->Export);
				echo ew_ExportLine($sExportStr, $win_logistik_mr_->Export);
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
				$win_logistik_mr_->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($win_logistik_mr_->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('mrno', $win_logistik_mr_->mrno->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $win_logistik_mr_->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('tanggal', $win_logistik_mr_->tanggal->CurrentValue);
					$XmlDoc->AddField('periode', $win_logistik_mr_->periode->CurrentValue);
					$XmlDoc->AddField('gudang', $win_logistik_mr_->gudang->CurrentValue);
					$XmlDoc->AddField('createby', $win_logistik_mr_->createby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $win_logistik_mr_->Export <> "csv") { // Vertical format
						echo ew_ExportField('mrno', $win_logistik_mr_->mrno->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportField('kode_pekerjaan', $win_logistik_mr_->kode_pekerjaan->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportField('tanggal', $win_logistik_mr_->tanggal->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportField('periode', $win_logistik_mr_->periode->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportField('gudang', $win_logistik_mr_->gudang->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportField('createby', $win_logistik_mr_->createby->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->mrno->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->kode_pekerjaan->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->tanggal->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->periode->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->gudang->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						ew_ExportAddValue($sExportStr, $win_logistik_mr_->createby->ExportValue($win_logistik_mr_->Export, $win_logistik_mr_->ExportOriginalValue), $win_logistik_mr_->Export);
						echo ew_ExportLine($sExportStr, $win_logistik_mr_->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($win_logistik_mr_->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($win_logistik_mr_->Export);
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
