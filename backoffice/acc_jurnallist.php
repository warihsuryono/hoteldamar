<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_jurnalinfo.php" ?>
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
$acc_jurnal_list = new cacc_jurnal_list();
$Page =& $acc_jurnal_list;

// Page init processing
$acc_jurnal_list->Page_Init();

// Page main processing
$acc_jurnal_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($acc_jurnal->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var acc_jurnal_list = new ew_Page("acc_jurnal_list");

// page properties
acc_jurnal_list.PageID = "list"; // page ID
var EW_PAGE_ID = acc_jurnal_list.PageID; // for backward compatibility

// extend page with validate function for search
acc_jurnal_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_createdate"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal Buat");

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
acc_jurnal_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_jurnal_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_jurnal_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($acc_jurnal->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($acc_jurnal->Export == "" && $acc_jurnal->SelectLimit);
	if (!$bSelectLimit)
		$rs = $acc_jurnal_list->LoadRecordset();
	$acc_jurnal_list->lTotalRecs = ($bSelectLimit) ? $acc_jurnal->SelectRecordCount() : $rs->RecordCount();
	$acc_jurnal_list->lStartRec = 1;
	if ($acc_jurnal_list->lDisplayRecs <= 0) // Display all records
		$acc_jurnal_list->lDisplayRecs = $acc_jurnal_list->lTotalRecs;
	if (!($acc_jurnal->ExportAll && $acc_jurnal->Export <> ""))
		$acc_jurnal_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $acc_jurnal_list->LoadRecordset($acc_jurnal_list->lStartRec-1, $acc_jurnal_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Jurnal</b></h3>
<?php if ($acc_jurnal->Export == "" && $acc_jurnal->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $acc_jurnal_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_jurnal_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($acc_jurnal->Export == "" && $acc_jurnal->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(acc_jurnal_list);" style="text-decoration: none;"><img id="acc_jurnal_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="acc_jurnal_list_SearchPanel">
<form name="facc_jurnallistsrch" id="facc_jurnallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return acc_jurnal_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="acc_jurnal">
<?php
if ($gsSearchError == "")
	$acc_jurnal_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$acc_jurnal->RowType = EW_ROWTYPE_SEARCH;

// Render row
$acc_jurnal_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Jurnal</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodejurnal" id="z_kodejurnal" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodejurnal" id="x_kodejurnal" size="30" maxlength="30" value="<?php echo $acc_jurnal->kodejurnal->EditValue ?>"<?php echo $acc_jurnal->kodejurnal->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $acc_jurnal->tanggal->EditValue ?>"<?php echo $acc_jurnal->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker">No Cek/BG</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_nocek" id="z_nocek" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_nocek" id="x_nocek" size="30" maxlength="30" value="<?php echo $acc_jurnal->nocek->EditValue ?>"<?php echo $acc_jurnal->nocek->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Supplier</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_vendor" id="z_vendor" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_vendor" name="x_vendor"<?php echo $acc_jurnal->vendor->EditAttributes() ?>>
<?php
if (is_array($acc_jurnal->vendor->EditValue)) {
	$arwrk = $acc_jurnal->vendor->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_jurnal->vendor->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Catatan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_notes" id="z_notes" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_notes" id="x_notes" size="30" maxlength="255" value="<?php echo $acc_jurnal->notes->EditValue ?>"<?php echo $acc_jurnal->notes->EditAttributes() ?>>
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
<select id="x_createby" name="x_createby"<?php echo $acc_jurnal->createby->EditAttributes() ?>>
<?php
if (is_array($acc_jurnal->createby->EditValue)) {
	$arwrk = $acc_jurnal->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_jurnal->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Tanggal Buat</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_createdate" id="z_createdate" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_createdate" id="x_createdate" value="<?php echo $acc_jurnal->createdate->EditValue ?>"<?php echo $acc_jurnal->createdate->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_createdate" name="cal_x_createdate" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_createdate", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_createdate" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Bag.Keuangan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_dirutby" id="z_dirutby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_dirutby" name="x_dirutby"<?php echo $acc_jurnal->dirutby->EditAttributes() ?>>
<?php
if (is_array($acc_jurnal->dirutby->EditValue)) {
	$arwrk = $acc_jurnal->dirutby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_jurnal->dirutby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $acc_jurnal_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $acc_jurnal_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $acc_jurnal_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($acc_jurnal->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($acc_jurnal->CurrentAction <> "gridadd" && $acc_jurnal->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($acc_jurnal_list->Pager)) $acc_jurnal_list->Pager = new cPrevNextPager($acc_jurnal_list->lStartRec, $acc_jurnal_list->lDisplayRecs, $acc_jurnal_list->lTotalRecs) ?>
<?php if ($acc_jurnal_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($acc_jurnal_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $acc_jurnal_list->PageUrl() ?>start=<?php echo $acc_jurnal_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($acc_jurnal_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $acc_jurnal_list->PageUrl() ?>start=<?php echo $acc_jurnal_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $acc_jurnal_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($acc_jurnal_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $acc_jurnal_list->PageUrl() ?>start=<?php echo $acc_jurnal_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($acc_jurnal_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $acc_jurnal_list->PageUrl() ?>start=<?php echo $acc_jurnal_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $acc_jurnal_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $acc_jurnal_list->Pager->FromIndex ?> to <?php echo $acc_jurnal_list->Pager->ToIndex ?> of <?php echo $acc_jurnal_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($acc_jurnal_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($acc_jurnal_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="acc_jurnal">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($acc_jurnal_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($acc_jurnal_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($acc_jurnal_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($acc_jurnal_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($acc_jurnal_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($acc_jurnal_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $acc_jurnal->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
<input type="button" name="cashpurchase" value="Pembiayaan Dengan Kas" onclick="window.location='acc_jurnaladd_kas.php';">
<input type="button" name="bankpurchase" value="Pembiayaan Dengan Bank" onclick="window.location='acc_jurnaladd_bank.php';">
<input type="button" name="bankpurchase" value="Pembayaran Invoice" onclick="window.location='acc_jurnaladd_invoice.php';">
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="facc_jurnallist" id="facc_jurnallist" class="ewForm" action="" method="post">
<?php if ($acc_jurnal_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$acc_jurnal_list->lOptionCnt = 0;
	$acc_jurnal_list->lOptionCnt += count($acc_jurnal_list->ListOptions->Items); // Custom list options
?>
<?php echo $acc_jurnal->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($acc_jurnal->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_jurnal_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($acc_jurnal->actionlink->Visible) { // actionlink ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($acc_jurnal->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->kodejurnal->Visible) { // kodejurnal ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->kodejurnal) == "") { ?>
		<td style="white-space: nowrap;">Kode Jurnal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->kodejurnal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Jurnal</td><td style="width: 10px;"><?php if ($acc_jurnal->kodejurnal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->kodejurnal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->tanggal->Visible) { // tanggal ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($acc_jurnal->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->nocek->Visible) { // nocek ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->nocek) == "") { ?>
		<td style="white-space: nowrap;">No Cek/BG</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->nocek) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>No Cek/BG</td><td style="width: 10px;"><?php if ($acc_jurnal->nocek->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->nocek->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->vendor->Visible) { // vendor ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->vendor) == "") { ?>
		<td style="white-space: nowrap;">Supplier</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->vendor) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Supplier</td><td style="width: 10px;"><?php if ($acc_jurnal->vendor->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->vendor->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->notes->Visible) { // notes ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->notes) == "") { ?>
		<td style="white-space: nowrap;">Catatan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->notes) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Catatan</td><td style="width: 10px;"><?php if ($acc_jurnal->notes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->notes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->createby->Visible) { // createby ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($acc_jurnal->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->createdate->Visible) { // createdate ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->createdate) == "") { ?>
		<td style="white-space: nowrap;">Tanggal Buat</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->createdate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal Buat</td><td style="width: 10px;"><?php if ($acc_jurnal->createdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->createdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_jurnal->dirutby->Visible) { // dirutby ?>
	<?php if ($acc_jurnal->SortUrl($acc_jurnal->dirutby) == "") { ?>
		<td style="white-space: nowrap;">Bag.Keuangan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_jurnal->SortUrl($acc_jurnal->dirutby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Bag.Keuangan</td><td style="width: 10px;"><?php if ($acc_jurnal->dirutby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_jurnal->dirutby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($acc_jurnal->ExportAll && $acc_jurnal->Export <> "") {
	$acc_jurnal_list->lStopRec = $acc_jurnal_list->lTotalRecs;
} else {
	$acc_jurnal_list->lStopRec = $acc_jurnal_list->lStartRec + $acc_jurnal_list->lDisplayRecs - 1; // Set the last record to display
}
$acc_jurnal_list->lRecCount = $acc_jurnal_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$acc_jurnal->SelectLimit && $acc_jurnal_list->lStartRec > 1)
		$rs->Move($acc_jurnal_list->lStartRec - 1);
}
$acc_jurnal_list->lRowCnt = 0;
while (($acc_jurnal->CurrentAction == "gridadd" || !$rs->EOF) &&
	$acc_jurnal_list->lRecCount < $acc_jurnal_list->lStopRec) {
	$acc_jurnal_list->lRecCount++;
	if (intval($acc_jurnal_list->lRecCount) >= intval($acc_jurnal_list->lStartRec)) {
		$acc_jurnal_list->lRowCnt++;

	// Init row class and style
	$acc_jurnal->CssClass = "";
	$acc_jurnal->CssStyle = "";
	$acc_jurnal->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($acc_jurnal->CurrentAction == "gridadd") {
		$acc_jurnal_list->LoadDefaultValues(); // Load default values
	} else {
		$acc_jurnal_list->LoadRowValues($rs); // Load row values
	}
	$acc_jurnal->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$acc_jurnal_list->RenderRow();
?>
	<tr<?php echo $acc_jurnal->RowAttributes() ?>>
<?php if ($acc_jurnal->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_jurnal_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($acc_jurnal->actionlink->Visible) { // actionlink ?>
		<td<?php echo $acc_jurnal->actionlink->CellAttributes() ?>>
<div<?php echo $acc_jurnal->actionlink->ViewAttributes() ?>><?php echo $acc_jurnal->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->kodejurnal->Visible) { // kodejurnal ?>
		<td<?php echo $acc_jurnal->kodejurnal->CellAttributes() ?>>
<div<?php echo $acc_jurnal->kodejurnal->ViewAttributes() ?>><?php echo $acc_jurnal->kodejurnal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->tanggal->Visible) { // tanggal ?>
		<td<?php echo $acc_jurnal->tanggal->CellAttributes() ?>>
<div<?php echo $acc_jurnal->tanggal->ViewAttributes() ?>><?php echo $acc_jurnal->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->nocek->Visible) { // nocek ?>
		<td<?php echo $acc_jurnal->nocek->CellAttributes() ?>>
<div<?php echo $acc_jurnal->nocek->ViewAttributes() ?>><?php echo $acc_jurnal->nocek->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->vendor->Visible) { // vendor ?>
		<td<?php echo $acc_jurnal->vendor->CellAttributes() ?>>
<div<?php echo $acc_jurnal->vendor->ViewAttributes() ?>><?php echo $acc_jurnal->vendor->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->notes->Visible) { // notes ?>
		<td<?php echo $acc_jurnal->notes->CellAttributes() ?>>
<div<?php echo $acc_jurnal->notes->ViewAttributes() ?>><?php echo $acc_jurnal->notes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->createby->Visible) { // createby ?>
		<td<?php echo $acc_jurnal->createby->CellAttributes() ?>>
<div<?php echo $acc_jurnal->createby->ViewAttributes() ?>><?php echo $acc_jurnal->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->createdate->Visible) { // createdate ?>
		<td<?php echo $acc_jurnal->createdate->CellAttributes() ?>>
<div<?php echo $acc_jurnal->createdate->ViewAttributes() ?>><?php echo $acc_jurnal->createdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_jurnal->dirutby->Visible) { // dirutby ?>
		<td<?php echo $acc_jurnal->dirutby->CellAttributes() ?>>
<div<?php echo $acc_jurnal->dirutby->ViewAttributes() ?>><?php echo $acc_jurnal->dirutby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($acc_jurnal->CurrentAction <> "gridadd")
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
<?php if ($acc_jurnal->Export == "" && $acc_jurnal->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(acc_jurnal_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($acc_jurnal->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$acc_jurnal_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_jurnal_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'acc_jurnal';

	// Page Object Name
	var $PageObjName = 'acc_jurnal_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_jurnal;
		if ($acc_jurnal->UseTokenInUrl) $PageUrl .= "t=" . $acc_jurnal->TableVar . "&"; // add page token
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
		global $objForm, $acc_jurnal;
		if ($acc_jurnal->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_jurnal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_jurnal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_jurnal_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_jurnal"] = new cacc_jurnal();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_jurnal', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_jurnal;
	$acc_jurnal->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $acc_jurnal->Export; // Get export parameter, used in header
	$gsExportFile = $acc_jurnal->TableVar; // Get export file, used in header
	if ($acc_jurnal->Export == "print" || $acc_jurnal->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($acc_jurnal->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $acc_jurnal;
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
		if ($acc_jurnal->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $acc_jurnal->getRecordsPerPage(); // Restore from Session
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
		$acc_jurnal->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$acc_jurnal->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
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
		$acc_jurnal->setSessionWhere($sFilter);
		$acc_jurnal->CurrentFilter = "";

		// Export data only
		if (in_array($acc_jurnal->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $acc_jurnal;
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
			$acc_jurnal->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $acc_jurnal;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $acc_jurnal->actionlink, FALSE); // Field actionlink
		$this->BuildSearchSql($sWhere, $acc_jurnal->kodejurnal, FALSE); // Field kodejurnal
		$this->BuildSearchSql($sWhere, $acc_jurnal->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $acc_jurnal->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $acc_jurnal->nocek, FALSE); // Field nocek
		$this->BuildSearchSql($sWhere, $acc_jurnal->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $acc_jurnal->posting, FALSE); // Field posting
		$this->BuildSearchSql($sWhere, $acc_jurnal->vendor, FALSE); // Field vendor
		$this->BuildSearchSql($sWhere, $acc_jurnal->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $acc_jurnal->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $acc_jurnal->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $acc_jurnal->dirutby, FALSE); // Field dirutby
		$this->BuildSearchSql($sWhere, $acc_jurnal->dirutdate, FALSE); // Field dirutdate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($acc_jurnal->actionlink); // Field actionlink
			$this->SetSearchParm($acc_jurnal->kodejurnal); // Field kodejurnal
			$this->SetSearchParm($acc_jurnal->idseqno); // Field idseqno
			$this->SetSearchParm($acc_jurnal->tanggal); // Field tanggal
			$this->SetSearchParm($acc_jurnal->nocek); // Field nocek
			$this->SetSearchParm($acc_jurnal->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($acc_jurnal->posting); // Field posting
			$this->SetSearchParm($acc_jurnal->vendor); // Field vendor
			$this->SetSearchParm($acc_jurnal->notes); // Field notes
			$this->SetSearchParm($acc_jurnal->createby); // Field createby
			$this->SetSearchParm($acc_jurnal->createdate); // Field createdate
			$this->SetSearchParm($acc_jurnal->dirutby); // Field dirutby
			$this->SetSearchParm($acc_jurnal->dirutdate); // Field dirutdate
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
		global $acc_jurnal;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$acc_jurnal->setAdvancedSearch("x_$FldParm", $FldVal);
		$acc_jurnal->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$acc_jurnal->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$acc_jurnal->setAdvancedSearch("y_$FldParm", $FldVal2);
		$acc_jurnal->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $acc_jurnal;
		$this->sSrchWhere = "";
		$acc_jurnal->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $acc_jurnal;
		$acc_jurnal->setAdvancedSearch("x_actionlink", "");
		$acc_jurnal->setAdvancedSearch("x_kodejurnal", "");
		$acc_jurnal->setAdvancedSearch("x_idseqno", "");
		$acc_jurnal->setAdvancedSearch("x_tanggal", "");
		$acc_jurnal->setAdvancedSearch("x_nocek", "");
		$acc_jurnal->setAdvancedSearch("x_kode_pekerjaan", "");
		$acc_jurnal->setAdvancedSearch("x_posting", "");
		$acc_jurnal->setAdvancedSearch("x_vendor", "");
		$acc_jurnal->setAdvancedSearch("x_notes", "");
		$acc_jurnal->setAdvancedSearch("x_createby", "");
		$acc_jurnal->setAdvancedSearch("x_createdate", "");
		$acc_jurnal->setAdvancedSearch("x_dirutby", "");
		$acc_jurnal->setAdvancedSearch("x_dirutdate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $acc_jurnal;
		$this->sSrchWhere = $acc_jurnal->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $acc_jurnal;
		 $acc_jurnal->actionlink->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_actionlink");
		 $acc_jurnal->kodejurnal->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_kodejurnal");
		 $acc_jurnal->idseqno->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_idseqno");
		 $acc_jurnal->tanggal->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_tanggal");
		 $acc_jurnal->nocek->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_nocek");
		 $acc_jurnal->kode_pekerjaan->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_kode_pekerjaan");
		 $acc_jurnal->posting->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_posting");
		 $acc_jurnal->vendor->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_vendor");
		 $acc_jurnal->notes->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_notes");
		 $acc_jurnal->createby->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_createby");
		 $acc_jurnal->createdate->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_createdate");
		 $acc_jurnal->dirutby->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_dirutby");
		 $acc_jurnal->dirutdate->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_dirutdate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $acc_jurnal;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$acc_jurnal->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$acc_jurnal->CurrentOrderType = @$_GET["ordertype"];
			$acc_jurnal->UpdateSort($acc_jurnal->actionlink); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->kodejurnal); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->tanggal); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->nocek); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->vendor); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->notes); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->createby); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->createdate); // Field 
			$acc_jurnal->UpdateSort($acc_jurnal->dirutby); // Field 
			$acc_jurnal->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $acc_jurnal;
		$sOrderBy = $acc_jurnal->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($acc_jurnal->SqlOrderBy() <> "") {
				$sOrderBy = $acc_jurnal->SqlOrderBy();
				$acc_jurnal->setSessionOrderBy($sOrderBy);
				$acc_jurnal->tanggal->setSort("DESC");
				$acc_jurnal->kodejurnal->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $acc_jurnal;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$acc_jurnal->setSessionOrderBy($sOrderBy);
				$acc_jurnal->actionlink->setSort("");
				$acc_jurnal->kodejurnal->setSort("");
				$acc_jurnal->tanggal->setSort("");
				$acc_jurnal->nocek->setSort("");
				$acc_jurnal->vendor->setSort("");
				$acc_jurnal->notes->setSort("");
				$acc_jurnal->createby->setSort("");
				$acc_jurnal->createdate->setSort("");
				$acc_jurnal->dirutby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $acc_jurnal;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$acc_jurnal->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$acc_jurnal->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $acc_jurnal->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$acc_jurnal->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $acc_jurnal;

		// Load search values
		// actionlink

		$acc_jurnal->actionlink->AdvancedSearch->SearchValue = @$_GET["x_actionlink"];
		$acc_jurnal->actionlink->AdvancedSearch->SearchOperator = @$_GET["z_actionlink"];

		// kodejurnal
		$acc_jurnal->kodejurnal->AdvancedSearch->SearchValue = @$_GET["x_kodejurnal"];
		$acc_jurnal->kodejurnal->AdvancedSearch->SearchOperator = @$_GET["z_kodejurnal"];

		// idseqno
		$acc_jurnal->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$acc_jurnal->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// tanggal
		$acc_jurnal->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$acc_jurnal->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// nocek
		$acc_jurnal->nocek->AdvancedSearch->SearchValue = @$_GET["x_nocek"];
		$acc_jurnal->nocek->AdvancedSearch->SearchOperator = @$_GET["z_nocek"];

		// kode_pekerjaan
		$acc_jurnal->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$acc_jurnal->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// posting
		$acc_jurnal->posting->AdvancedSearch->SearchValue = @$_GET["x_posting"];
		$acc_jurnal->posting->AdvancedSearch->SearchOperator = @$_GET["z_posting"];

		// vendor
		$acc_jurnal->vendor->AdvancedSearch->SearchValue = @$_GET["x_vendor"];
		$acc_jurnal->vendor->AdvancedSearch->SearchOperator = @$_GET["z_vendor"];

		// notes
		$acc_jurnal->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$acc_jurnal->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// createby
		$acc_jurnal->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$acc_jurnal->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$acc_jurnal->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$acc_jurnal->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// dirutby
		$acc_jurnal->dirutby->AdvancedSearch->SearchValue = @$_GET["x_dirutby"];
		$acc_jurnal->dirutby->AdvancedSearch->SearchOperator = @$_GET["z_dirutby"];

		// dirutdate
		$acc_jurnal->dirutdate->AdvancedSearch->SearchValue = @$_GET["x_dirutdate"];
		$acc_jurnal->dirutdate->AdvancedSearch->SearchOperator = @$_GET["z_dirutdate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_jurnal;

		// Call Recordset Selecting event
		$acc_jurnal->Recordset_Selecting($acc_jurnal->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_jurnal->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_jurnal->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_jurnal;
		$sFilter = $acc_jurnal->KeyFilter();

		// Call Row Selecting event
		$acc_jurnal->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_jurnal->CurrentFilter = $sFilter;
		$sSql = $acc_jurnal->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_jurnal->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_jurnal;
		$acc_jurnal->actionlink->setDbValue($rs->fields('actionlink'));
		$acc_jurnal->kodejurnal->setDbValue($rs->fields('kodejurnal'));
		$acc_jurnal->idseqno->setDbValue($rs->fields('idseqno'));
		$acc_jurnal->tanggal->setDbValue($rs->fields('tanggal'));
		$acc_jurnal->nocek->setDbValue($rs->fields('nocek'));
		$acc_jurnal->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$acc_jurnal->posting->setDbValue($rs->fields('posting'));
		$acc_jurnal->vendor->setDbValue($rs->fields('vendor'));
		$acc_jurnal->notes->setDbValue($rs->fields('notes'));
		$acc_jurnal->createby->setDbValue($rs->fields('createby'));
		$acc_jurnal->createdate->setDbValue($rs->fields('createdate'));
		$acc_jurnal->dirutby->setDbValue($rs->fields('dirutby'));
		$acc_jurnal->dirutdate->setDbValue($rs->fields('dirutdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_jurnal;

		// Call Row_Rendering event
		$acc_jurnal->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$acc_jurnal->actionlink->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->actionlink->CellCssClass = "";

		// kodejurnal
		$acc_jurnal->kodejurnal->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->kodejurnal->CellCssClass = "";

		// tanggal
		$acc_jurnal->tanggal->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->tanggal->CellCssClass = "";

		// nocek
		$acc_jurnal->nocek->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->nocek->CellCssClass = "";

		// vendor
		$acc_jurnal->vendor->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->vendor->CellCssClass = "";

		// notes
		$acc_jurnal->notes->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->notes->CellCssClass = "";

		// createby
		$acc_jurnal->createby->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->createby->CellCssClass = "";

		// createdate
		$acc_jurnal->createdate->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->createdate->CellCssClass = "";

		// dirutby
		$acc_jurnal->dirutby->CellCssStyle = "white-space: nowrap;";
		$acc_jurnal->dirutby->CellCssClass = "";
		if ($acc_jurnal->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$acc_jurnal->actionlink->ViewValue = $acc_jurnal->actionlink->CurrentValue;
			$acc_jurnal->actionlink->CssStyle = "";
			$acc_jurnal->actionlink->CssClass = "";
			$acc_jurnal->actionlink->ViewCustomAttributes = "";

			// kodejurnal
			$acc_jurnal->kodejurnal->ViewValue = $acc_jurnal->kodejurnal->CurrentValue;
			$acc_jurnal->kodejurnal->CssStyle = "";
			$acc_jurnal->kodejurnal->CssClass = "";
			$acc_jurnal->kodejurnal->ViewCustomAttributes = "";

			// tanggal
			$acc_jurnal->tanggal->ViewValue = $acc_jurnal->tanggal->CurrentValue;
			$acc_jurnal->tanggal->ViewValue = ew_FormatDateTime($acc_jurnal->tanggal->ViewValue, 7);
			$acc_jurnal->tanggal->CssStyle = "";
			$acc_jurnal->tanggal->CssClass = "";
			$acc_jurnal->tanggal->ViewCustomAttributes = "";

			// nocek
			$acc_jurnal->nocek->ViewValue = $acc_jurnal->nocek->CurrentValue;
			$acc_jurnal->nocek->CssStyle = "";
			$acc_jurnal->nocek->CssClass = "";
			$acc_jurnal->nocek->ViewCustomAttributes = "";

			// vendor
			if (strval($acc_jurnal->vendor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_vendor` WHERE `kode` = '" . ew_AdjustSql($acc_jurnal->vendor->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_jurnal->vendor->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$acc_jurnal->vendor->ViewValue = $acc_jurnal->vendor->CurrentValue;
				}
			} else {
				$acc_jurnal->vendor->ViewValue = NULL;
			}
			$acc_jurnal->vendor->CssStyle = "";
			$acc_jurnal->vendor->CssClass = "";
			$acc_jurnal->vendor->ViewCustomAttributes = "";

			// notes
			$acc_jurnal->notes->ViewValue = $acc_jurnal->notes->CurrentValue;
			$acc_jurnal->notes->CssStyle = "";
			$acc_jurnal->notes->CssClass = "";
			$acc_jurnal->notes->ViewCustomAttributes = "";

			// createby
			if (strval($acc_jurnal->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `username` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($acc_jurnal->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_jurnal->createby->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$acc_jurnal->createby->ViewValue = $acc_jurnal->createby->CurrentValue;
				}
			} else {
				$acc_jurnal->createby->ViewValue = NULL;
			}
			$acc_jurnal->createby->CssStyle = "";
			$acc_jurnal->createby->CssClass = "";
			$acc_jurnal->createby->ViewCustomAttributes = "";

			// createdate
			$acc_jurnal->createdate->ViewValue = $acc_jurnal->createdate->CurrentValue;
			$acc_jurnal->createdate->ViewValue = ew_FormatDateTime($acc_jurnal->createdate->ViewValue, 7);
			$acc_jurnal->createdate->CssStyle = "";
			$acc_jurnal->createdate->CssClass = "";
			$acc_jurnal->createdate->ViewCustomAttributes = "";

			// dirutby
			if (strval($acc_jurnal->dirutby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `username` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($acc_jurnal->dirutby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_jurnal->dirutby->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$acc_jurnal->dirutby->ViewValue = $acc_jurnal->dirutby->CurrentValue;
				}
			} else {
				$acc_jurnal->dirutby->ViewValue = NULL;
			}
			$acc_jurnal->dirutby->CssStyle = "";
			$acc_jurnal->dirutby->CssClass = "";
			$acc_jurnal->dirutby->ViewCustomAttributes = "";

			// actionlink
			$acc_jurnal->actionlink->HrefValue = "";

			// kodejurnal
			$acc_jurnal->kodejurnal->HrefValue = "";

			// tanggal
			$acc_jurnal->tanggal->HrefValue = "";

			// nocek
			$acc_jurnal->nocek->HrefValue = "";

			// vendor
			$acc_jurnal->vendor->HrefValue = "";

			// notes
			$acc_jurnal->notes->HrefValue = "";

			// createby
			$acc_jurnal->createby->HrefValue = "";

			// createdate
			$acc_jurnal->createdate->HrefValue = "";

			// dirutby
			$acc_jurnal->dirutby->HrefValue = "";
		} elseif ($acc_jurnal->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$acc_jurnal->actionlink->EditCustomAttributes = "";
			$acc_jurnal->actionlink->EditValue = ew_HtmlEncode($acc_jurnal->actionlink->AdvancedSearch->SearchValue);

			// kodejurnal
			$acc_jurnal->kodejurnal->EditCustomAttributes = "";
			$acc_jurnal->kodejurnal->EditValue = ew_HtmlEncode($acc_jurnal->kodejurnal->AdvancedSearch->SearchValue);

			// tanggal
			$acc_jurnal->tanggal->EditCustomAttributes = "";
			$acc_jurnal->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($acc_jurnal->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// nocek
			$acc_jurnal->nocek->EditCustomAttributes = "";
			$acc_jurnal->nocek->EditValue = ew_HtmlEncode($acc_jurnal->nocek->AdvancedSearch->SearchValue);

			// vendor
			$acc_jurnal->vendor->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_vendor`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$acc_jurnal->vendor->EditValue = $arwrk;

			// notes
			$acc_jurnal->notes->EditCustomAttributes = "";
			$acc_jurnal->notes->EditValue = ew_HtmlEncode($acc_jurnal->notes->AdvancedSearch->SearchValue);

			// createby
			$acc_jurnal->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$acc_jurnal->createby->EditValue = $arwrk;

			// createdate
			$acc_jurnal->createdate->EditCustomAttributes = "";
			$acc_jurnal->createdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($acc_jurnal->createdate->AdvancedSearch->SearchValue, 7), 7));

			// dirutby
			$acc_jurnal->dirutby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$acc_jurnal->dirutby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$acc_jurnal->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $acc_jurnal;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($acc_jurnal->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($acc_jurnal->createdate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal Buat";
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
		global $acc_jurnal;
		$acc_jurnal->actionlink->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_actionlink");
		$acc_jurnal->kodejurnal->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_kodejurnal");
		$acc_jurnal->idseqno->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_idseqno");
		$acc_jurnal->tanggal->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_tanggal");
		$acc_jurnal->nocek->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_nocek");
		$acc_jurnal->kode_pekerjaan->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_kode_pekerjaan");
		$acc_jurnal->posting->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_posting");
		$acc_jurnal->vendor->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_vendor");
		$acc_jurnal->notes->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_notes");
		$acc_jurnal->createby->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_createby");
		$acc_jurnal->createdate->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_createdate");
		$acc_jurnal->dirutby->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_dirutby");
		$acc_jurnal->dirutdate->AdvancedSearch->SearchValue = $acc_jurnal->getAdvancedSearch("x_dirutdate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $acc_jurnal;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($acc_jurnal->ExportAll) {
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
		if ($acc_jurnal->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($acc_jurnal->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $acc_jurnal->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodejurnal', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'nocek', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'vendor', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'notes', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'createby', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'createdate', $acc_jurnal->Export);
				ew_ExportAddValue($sExportStr, 'dirutby', $acc_jurnal->Export);
				echo ew_ExportLine($sExportStr, $acc_jurnal->Export);
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
				$acc_jurnal->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($acc_jurnal->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodejurnal', $acc_jurnal->kodejurnal->CurrentValue);
					$XmlDoc->AddField('tanggal', $acc_jurnal->tanggal->CurrentValue);
					$XmlDoc->AddField('nocek', $acc_jurnal->nocek->CurrentValue);
					$XmlDoc->AddField('vendor', $acc_jurnal->vendor->CurrentValue);
					$XmlDoc->AddField('notes', $acc_jurnal->notes->CurrentValue);
					$XmlDoc->AddField('createby', $acc_jurnal->createby->CurrentValue);
					$XmlDoc->AddField('createdate', $acc_jurnal->createdate->CurrentValue);
					$XmlDoc->AddField('dirutby', $acc_jurnal->dirutby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $acc_jurnal->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodejurnal', $acc_jurnal->kodejurnal->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('tanggal', $acc_jurnal->tanggal->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('nocek', $acc_jurnal->nocek->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('vendor', $acc_jurnal->vendor->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('notes', $acc_jurnal->notes->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('createby', $acc_jurnal->createby->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('createdate', $acc_jurnal->createdate->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportField('dirutby', $acc_jurnal->dirutby->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $acc_jurnal->kodejurnal->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->tanggal->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->nocek->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->vendor->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->notes->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->createby->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->createdate->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						ew_ExportAddValue($sExportStr, $acc_jurnal->dirutby->ExportValue($acc_jurnal->Export, $acc_jurnal->ExportOriginalValue), $acc_jurnal->Export);
						echo ew_ExportLine($sExportStr, $acc_jurnal->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($acc_jurnal->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($acc_jurnal->Export);
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
