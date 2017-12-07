<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_transfer_materialinfo.php" ?>
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
$logistik_transfer_material_list = new clogistik_transfer_material_list();
$Page =& $logistik_transfer_material_list;

// Page init processing
$logistik_transfer_material_list->Page_Init();

// Page main processing
$logistik_transfer_material_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_transfer_material->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_transfer_material_list = new ew_Page("logistik_transfer_material_list");

// page properties
logistik_transfer_material_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_transfer_material_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_transfer_material_list.ValidateSearch = function(fobj) {
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
logistik_transfer_material_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_transfer_material_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_transfer_material_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_transfer_material_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_transfer_material_list.ShowHighlightText = "Show highlight"; 
logistik_transfer_material_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_transfer_material->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_transfer_material->Export == "" && $logistik_transfer_material->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_transfer_material_list->LoadRecordset();
	$logistik_transfer_material_list->lTotalRecs = ($bSelectLimit) ? $logistik_transfer_material->SelectRecordCount() : $rs->RecordCount();
	$logistik_transfer_material_list->lStartRec = 1;
	if ($logistik_transfer_material_list->lDisplayRecs <= 0) // Display all records
		$logistik_transfer_material_list->lDisplayRecs = $logistik_transfer_material_list->lTotalRecs;
	if (!($logistik_transfer_material->ExportAll && $logistik_transfer_material->Export <> ""))
		$logistik_transfer_material_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_transfer_material_list->LoadRecordset($logistik_transfer_material_list->lStartRec-1, $logistik_transfer_material_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Pengeluaran Barang</b></h3>
<?php if ($logistik_transfer_material->Export == "" && $logistik_transfer_material->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_transfer_material->Export == "" && $logistik_transfer_material->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_transfer_material_list);" style="text-decoration: none;"><img id="logistik_transfer_material_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_transfer_material_list_SearchPanel">
<form name="flogistik_transfer_materiallistsrch" id="flogistik_transfer_materiallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_transfer_material_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_transfer_material">
<?php
if ($gsSearchError == "")
	$logistik_transfer_material_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_transfer_material->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_transfer_material_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Pengeluaran</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_transkode" id="z_transkode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_transkode" id="x_transkode" size="30" maxlength="30" value="<?php echo $logistik_transfer_material->transkode->EditValue ?>"<?php echo $logistik_transfer_material->transkode->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_transfer_material->tanggal->EditValue ?>"<?php echo $logistik_transfer_material->tanggal->EditAttributes() ?>>
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
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $logistik_transfer_material->kode_pekerjaan->EditValue ?>"<?php echo $logistik_transfer_material->kode_pekerjaan->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr-->
	<tr>
		<td><span class="phpmaker">PO No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_pono" id="z_pono" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_pono" id="x_pono" size="30" maxlength="30" value="<?php echo $logistik_transfer_material->pono->EditValue ?>"<?php echo $logistik_transfer_material->pono->EditAttributes() ?>>
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
<select id="x_gudang" name="x_gudang"<?php echo $logistik_transfer_material->gudang->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->gudang->EditValue)) {
	$arwrk = $logistik_transfer_material->gudang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->gudang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<!--tr>
		<td><span class="phpmaker">Peruntukan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_peruntukan" id="z_peruntukan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_peruntukan" name="x_peruntukan"<?php echo $logistik_transfer_material->peruntukan->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->peruntukan->EditValue)) {
	$arwrk = $logistik_transfer_material->peruntukan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->peruntukan->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	</tr-->
	<tr>
		<td><span class="phpmaker">Diambil Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_ambilby" id="z_ambilby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_ambilby" name="x_ambilby"<?php echo $logistik_transfer_material->ambilby->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->ambilby->EditValue)) {
	$arwrk = $logistik_transfer_material->ambilby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->ambilby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Diberikan Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_beriby" id="z_beriby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_beriby" name="x_beriby"<?php echo $logistik_transfer_material->beriby->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->beriby->EditValue)) {
	$arwrk = $logistik_transfer_material->beriby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->beriby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Diketahui Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_tahuby" id="z_tahuby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_tahuby" name="x_tahuby"<?php echo $logistik_transfer_material->tahuby->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->tahuby->EditValue)) {
	$arwrk = $logistik_transfer_material->tahuby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->tahuby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Disetujui Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_setujuby" id="z_setujuby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_setujuby" name="x_setujuby"<?php echo $logistik_transfer_material->setujuby->EditAttributes() ?>>
<?php
if (is_array($logistik_transfer_material->setujuby->EditValue)) {
	$arwrk = $logistik_transfer_material->setujuby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_transfer_material->setujuby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_transfer_material_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_transfer_material_list->sSrchWhere <> "" && $logistik_transfer_material_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_transfer_material_list, this, '<?php echo $logistik_transfer_material->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_transfer_material_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_transfer_material->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_transfer_material->CurrentAction <> "gridadd" && $logistik_transfer_material->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_transfer_material_list->Pager)) $logistik_transfer_material_list->Pager = new cPrevNextPager($logistik_transfer_material_list->lStartRec, $logistik_transfer_material_list->lDisplayRecs, $logistik_transfer_material_list->lTotalRecs) ?>
<?php if ($logistik_transfer_material_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_transfer_material_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>start=<?php echo $logistik_transfer_material_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_transfer_material_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>start=<?php echo $logistik_transfer_material_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_transfer_material_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_transfer_material_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>start=<?php echo $logistik_transfer_material_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_transfer_material_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_transfer_material_list->PageUrl() ?>start=<?php echo $logistik_transfer_material_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_transfer_material_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_transfer_material_list->Pager->FromIndex ?> to <?php echo $logistik_transfer_material_list->Pager->ToIndex ?> of <?php echo $logistik_transfer_material_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_transfer_material_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_transfer_material_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_transfer_material">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_transfer_material_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_transfer_material_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_transfer_material_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_transfer_material_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_transfer_material_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_transfer_material_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_transfer_material->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_transfer_materiallist" id="flogistik_transfer_materiallist" class="ewForm" action="" method="post">
<?php if ($logistik_transfer_material_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_transfer_material_list->lOptionCnt = 0;
	$logistik_transfer_material_list->lOptionCnt += count($logistik_transfer_material_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_transfer_material->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_transfer_material->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_transfer_material_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_transfer_material->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_transfer_material->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_transfer_material->transkode->Visible) { // transkode ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->transkode) == "") { ?>
		<td style="white-space: nowrap;">Kode Pengeluaran</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->transkode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pengeluaran</td><td style="width: 10px;"><?php if ($logistik_transfer_material->transkode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->transkode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_transfer_material->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_transfer_material->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<!--
<?php if ($logistik_transfer_material->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->kode_pekerjaan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($logistik_transfer_material->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_transfer_material->pono->Visible) { // pono ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->pono) == "") { ?>
		<td style="white-space: nowrap;">PO No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->pono) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>PO No</td><td style="width: 10px;"><?php if ($logistik_transfer_material->pono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->pono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<!--
<?php if ($logistik_transfer_material->gudang->Visible) { // gudang ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->gudang) == "") { ?>
		<td style="white-space: nowrap;">Gudang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->gudang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Gudang</td><td style="width: 10px;"><?php if ($logistik_transfer_material->gudang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->gudang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
-->
<!--		
<?php if ($logistik_transfer_material->peruntukan->Visible) { // peruntukan ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->peruntukan) == "") { ?>
		<td style="white-space: nowrap;">Peruntukan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->peruntukan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Peruntukan</td><td style="width: 10px;"><?php if ($logistik_transfer_material->peruntukan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->peruntukan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>	
-->	
<?php if ($logistik_transfer_material->ambilby->Visible) { // ambilby ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->ambilby) == "") { ?>
		<td style="white-space: nowrap;">Diambil Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->ambilby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Diambil Oleh</td><td style="width: 10px;"><?php if ($logistik_transfer_material->ambilby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->ambilby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_transfer_material->beriby->Visible) { // beriby ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->beriby) == "") { ?>
		<td style="white-space: nowrap;">Diberikan Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->beriby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Diberikan Oleh</td><td style="width: 10px;"><?php if ($logistik_transfer_material->beriby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->beriby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_transfer_material->tahuby->Visible) { // tahuby ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->tahuby) == "") { ?>
		<td style="white-space: nowrap;">Diketahui Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->tahuby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Diketahui Oleh</td><td style="width: 10px;"><?php if ($logistik_transfer_material->tahuby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->tahuby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_transfer_material->setujuby->Visible) { // setujuby ?>
	<?php if ($logistik_transfer_material->SortUrl($logistik_transfer_material->setujuby) == "") { ?>
		<td style="white-space: nowrap;">Disetujui Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_transfer_material->SortUrl($logistik_transfer_material->setujuby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Disetujui Oleh</td><td style="width: 10px;"><?php if ($logistik_transfer_material->setujuby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_transfer_material->setujuby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_transfer_material->ExportAll && $logistik_transfer_material->Export <> "") {
	$logistik_transfer_material_list->lStopRec = $logistik_transfer_material_list->lTotalRecs;
} else {
	$logistik_transfer_material_list->lStopRec = $logistik_transfer_material_list->lStartRec + $logistik_transfer_material_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_transfer_material_list->lRecCount = $logistik_transfer_material_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_transfer_material->SelectLimit && $logistik_transfer_material_list->lStartRec > 1)
		$rs->Move($logistik_transfer_material_list->lStartRec - 1);
}
$logistik_transfer_material_list->lRowCnt = 0;
while (($logistik_transfer_material->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_transfer_material_list->lRecCount < $logistik_transfer_material_list->lStopRec) {
	$logistik_transfer_material_list->lRecCount++;
	if (intval($logistik_transfer_material_list->lRecCount) >= intval($logistik_transfer_material_list->lStartRec)) {
		$logistik_transfer_material_list->lRowCnt++;

	// Init row class and style
	$logistik_transfer_material->CssClass = "";
	$logistik_transfer_material->CssStyle = "";
	$logistik_transfer_material->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_transfer_material->CurrentAction == "gridadd") {
		$logistik_transfer_material_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_transfer_material_list->LoadRowValues($rs); // Load row values
	}
	$logistik_transfer_material->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_transfer_material_list->RenderRow();
?>
	<tr<?php echo $logistik_transfer_material->RowAttributes() ?>>
<?php if ($logistik_transfer_material->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_transfer_material_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_transfer_material->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_transfer_material->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->actionlink->ViewAttributes() ?>><?php echo $logistik_transfer_material->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_transfer_material->transkode->Visible) { // transkode ?>
		<td<?php echo $logistik_transfer_material->transkode->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->transkode->ViewAttributes() ?>><?php echo $logistik_transfer_material->transkode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_transfer_material->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_transfer_material->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->tanggal->ViewAttributes() ?>><?php echo $logistik_transfer_material->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_transfer_material->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $logistik_transfer_material->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->kode_pekerjaan->ViewAttributes() ?>><?php echo $logistik_transfer_material->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_transfer_material->pono->Visible) { // pono ?>
		<td<?php echo $logistik_transfer_material->pono->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->pono->ViewAttributes() ?>><?php echo $logistik_transfer_material->pono->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_transfer_material->gudang->Visible) { // gudang ?>
		<td<?php echo $logistik_transfer_material->gudang->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->gudang->ViewAttributes() ?>><?php echo $logistik_transfer_material->gudang->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
<!--
	<?php if ($logistik_transfer_material->peruntukan->Visible) { // peruntukan ?>
		<td<?php echo $logistik_transfer_material->peruntukan->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->peruntukan->ViewAttributes() ?>><?php echo $logistik_transfer_material->peruntukan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_transfer_material->ambilby->Visible) { // ambilby ?>
		<td<?php echo $logistik_transfer_material->ambilby->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->ambilby->ViewAttributes() ?>><?php echo $logistik_transfer_material->ambilby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_transfer_material->beriby->Visible) { // beriby ?>
		<td<?php echo $logistik_transfer_material->beriby->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->beriby->ViewAttributes() ?>><?php echo $logistik_transfer_material->beriby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_transfer_material->tahuby->Visible) { // tahuby ?>
		<td<?php echo $logistik_transfer_material->tahuby->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->tahuby->ViewAttributes() ?>><?php echo $logistik_transfer_material->tahuby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_transfer_material->setujuby->Visible) { // setujuby ?>
		<td<?php echo $logistik_transfer_material->setujuby->CellAttributes() ?>>
<div<?php echo $logistik_transfer_material->setujuby->ViewAttributes() ?>><?php echo $logistik_transfer_material->setujuby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_transfer_material->CurrentAction <> "gridadd")
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
<?php if ($logistik_transfer_material->Export == "" && $logistik_transfer_material->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_transfer_material_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_transfer_material->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_transfer_material_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_transfer_material_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_transfer_material';

	// Page Object Name
	var $PageObjName = 'logistik_transfer_material_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_transfer_material;
		if ($logistik_transfer_material->UseTokenInUrl) $PageUrl .= "t=" . $logistik_transfer_material->TableVar . "&"; // add page token
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
		global $objForm, $logistik_transfer_material;
		if ($logistik_transfer_material->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_transfer_material->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_transfer_material->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_transfer_material_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_transfer_material"] = new clogistik_transfer_material();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_transfer_material', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_transfer_material;
	$logistik_transfer_material->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_transfer_material->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_transfer_material->TableVar; // Get export file, used in header
	if ($logistik_transfer_material->Export == "print" || $logistik_transfer_material->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_transfer_material->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_transfer_material->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_transfer_material->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_transfer_material->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_transfer_material;
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
		if ($logistik_transfer_material->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_transfer_material->getRecordsPerPage(); // Restore from Session
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
		$logistik_transfer_material->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_transfer_material->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
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
		$logistik_transfer_material->setSessionWhere($sFilter);
		$logistik_transfer_material->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_transfer_material->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_transfer_material;
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
			$logistik_transfer_material->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_transfer_material;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->transkode, FALSE); // Field transkode
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->pono, FALSE); // Field pono
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->gudang, FALSE); // Field gudang
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->peruntukan, FALSE); // Field peruntukan
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->ambilby, FALSE); // Field ambilby
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->beriby, FALSE); // Field beriby
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->tahuby, FALSE); // Field tahuby
		$this->BuildSearchSql($sWhere, $logistik_transfer_material->setujuby, FALSE); // Field setujuby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_transfer_material->transkode); // Field transkode
			$this->SetSearchParm($logistik_transfer_material->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_transfer_material->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($logistik_transfer_material->pono); // Field pono
			$this->SetSearchParm($logistik_transfer_material->gudang); // Field gudang
			$this->SetSearchParm($logistik_transfer_material->peruntukan); // Field peruntukan
			$this->SetSearchParm($logistik_transfer_material->ambilby); // Field ambilby
			$this->SetSearchParm($logistik_transfer_material->beriby); // Field beriby
			$this->SetSearchParm($logistik_transfer_material->tahuby); // Field tahuby
			$this->SetSearchParm($logistik_transfer_material->setujuby); // Field setujuby
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
		global $logistik_transfer_material;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_transfer_material->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_transfer_material->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_transfer_material->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_transfer_material->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_transfer_material->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_transfer_material;
		$this->sSrchWhere = "";
		$logistik_transfer_material->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_transfer_material;
		$logistik_transfer_material->setAdvancedSearch("x_transkode", "");
		$logistik_transfer_material->setAdvancedSearch("x_tanggal", "");
		$logistik_transfer_material->setAdvancedSearch("x_kode_pekerjaan", "");
		$logistik_transfer_material->setAdvancedSearch("x_pono", "");
		$logistik_transfer_material->setAdvancedSearch("x_gudang", "");
		$logistik_transfer_material->setAdvancedSearch("x_peruntukan", "");
		$logistik_transfer_material->setAdvancedSearch("x_ambilby", "");
		$logistik_transfer_material->setAdvancedSearch("x_beriby", "");
		$logistik_transfer_material->setAdvancedSearch("x_tahuby", "");
		$logistik_transfer_material->setAdvancedSearch("x_setujuby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_transfer_material;
		$this->sSrchWhere = $logistik_transfer_material->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_transfer_material;
		 $logistik_transfer_material->transkode->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_transkode");
		 $logistik_transfer_material->tanggal->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tanggal");
		 $logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_kode_pekerjaan");
		 $logistik_transfer_material->pono->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_pono");
		 $logistik_transfer_material->gudang->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_gudang");
		 $logistik_transfer_material->peruntukan->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_peruntukan");
		 $logistik_transfer_material->ambilby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_ambilby");
		 $logistik_transfer_material->beriby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_beriby");
		 $logistik_transfer_material->tahuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tahuby");
		 $logistik_transfer_material->setujuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_setujuby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_transfer_material;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_transfer_material->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_transfer_material->CurrentOrderType = @$_GET["ordertype"];
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->actionlink); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->transkode); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->tanggal); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->kode_pekerjaan); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->pono); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->gudang); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->peruntukan); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->ambilby); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->beriby); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->tahuby); // Field 
			$logistik_transfer_material->UpdateSort($logistik_transfer_material->setujuby); // Field 
			$logistik_transfer_material->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_transfer_material;
		$sOrderBy = $logistik_transfer_material->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_transfer_material->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_transfer_material->SqlOrderBy();
				$logistik_transfer_material->setSessionOrderBy($sOrderBy);
				$logistik_transfer_material->transkode->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_transfer_material;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_transfer_material->setSessionOrderBy($sOrderBy);
				$logistik_transfer_material->actionlink->setSort("");
				$logistik_transfer_material->transkode->setSort("");
				$logistik_transfer_material->tanggal->setSort("");
				$logistik_transfer_material->kode_pekerjaan->setSort("");
				$logistik_transfer_material->pono->setSort("");
				$logistik_transfer_material->gudang->setSort("");
				$logistik_transfer_material->peruntukan->setSort("");
				$logistik_transfer_material->ambilby->setSort("");
				$logistik_transfer_material->beriby->setSort("");
				$logistik_transfer_material->tahuby->setSort("");
				$logistik_transfer_material->setujuby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_transfer_material;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_transfer_material->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_transfer_material->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_transfer_material;

		// Load search values
		// transkode

		$logistik_transfer_material->transkode->AdvancedSearch->SearchValue = @$_GET["x_transkode"];
		$logistik_transfer_material->transkode->AdvancedSearch->SearchOperator = @$_GET["z_transkode"];

		// tanggal
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// kode_pekerjaan
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// pono
		$logistik_transfer_material->pono->AdvancedSearch->SearchValue = @$_GET["x_pono"];
		$logistik_transfer_material->pono->AdvancedSearch->SearchOperator = @$_GET["z_pono"];

		// gudang
		$logistik_transfer_material->gudang->AdvancedSearch->SearchValue = @$_GET["x_gudang"];
		$logistik_transfer_material->gudang->AdvancedSearch->SearchOperator = @$_GET["z_gudang"];

		// peruntukan
		$logistik_transfer_material->peruntukan->AdvancedSearch->SearchValue = @$_GET["x_peruntukan"];
		$logistik_transfer_material->peruntukan->AdvancedSearch->SearchOperator = @$_GET["z_peruntukan"];

		// ambilby
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchValue = @$_GET["x_ambilby"];
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchOperator = @$_GET["z_ambilby"];

		// beriby
		$logistik_transfer_material->beriby->AdvancedSearch->SearchValue = @$_GET["x_beriby"];
		$logistik_transfer_material->beriby->AdvancedSearch->SearchOperator = @$_GET["z_beriby"];

		// tahuby
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchValue = @$_GET["x_tahuby"];
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchOperator = @$_GET["z_tahuby"];

		// setujuby
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchValue = @$_GET["x_setujuby"];
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchOperator = @$_GET["z_setujuby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_transfer_material;

		// Call Recordset Selecting event
		$logistik_transfer_material->Recordset_Selecting($logistik_transfer_material->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_transfer_material->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_transfer_material->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_transfer_material;
		$sFilter = $logistik_transfer_material->KeyFilter();

		// Call Row Selecting event
		$logistik_transfer_material->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_transfer_material->CurrentFilter = $sFilter;
		$sSql = $logistik_transfer_material->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_transfer_material->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_transfer_material;
		$logistik_transfer_material->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_transfer_material->transkode->setDbValue($rs->fields('transkode'));
		$logistik_transfer_material->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_transfer_material->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_transfer_material->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$logistik_transfer_material->pono->setDbValue($rs->fields('pono'));
		$logistik_transfer_material->gudang->setDbValue($rs->fields('gudang'));
		$logistik_transfer_material->peruntukan->setDbValue($rs->fields('peruntukan'));
		$logistik_transfer_material->notes->setDbValue($rs->fields('notes'));
		$logistik_transfer_material->ambilby->setDbValue($rs->fields('ambilby'));
		$logistik_transfer_material->ambildate->setDbValue($rs->fields('ambildate'));
		$logistik_transfer_material->beriby->setDbValue($rs->fields('beriby'));
		$logistik_transfer_material->beridate->setDbValue($rs->fields('beridate'));
		$logistik_transfer_material->tahuby->setDbValue($rs->fields('tahuby'));
		$logistik_transfer_material->tahudate->setDbValue($rs->fields('tahudate'));
		$logistik_transfer_material->setujuby->setDbValue($rs->fields('setujuby'));
		$logistik_transfer_material->setujudate->setDbValue($rs->fields('setujudate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_transfer_material;

		// Call Row_Rendering event
		$logistik_transfer_material->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_transfer_material->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->actionlink->CellCssClass = "";

		// transkode
		$logistik_transfer_material->transkode->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->transkode->CellCssClass = "";

		// tanggal
		$logistik_transfer_material->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->tanggal->CellCssClass = "";

		// kode_pekerjaan
		$logistik_transfer_material->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->kode_pekerjaan->CellCssClass = "";

		// pono
		$logistik_transfer_material->pono->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->pono->CellCssClass = "";

		// gudang
		$logistik_transfer_material->gudang->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->gudang->CellCssClass = "";

		// peruntukan
		$logistik_transfer_material->peruntukan->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->peruntukan->CellCssClass = "";

		// ambilby
		$logistik_transfer_material->ambilby->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->ambilby->CellCssClass = "";

		// beriby
		$logistik_transfer_material->beriby->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->beriby->CellCssClass = "";

		// tahuby
		$logistik_transfer_material->tahuby->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->tahuby->CellCssClass = "";

		// setujuby
		$logistik_transfer_material->setujuby->CellCssStyle = "white-space: nowrap;";
		$logistik_transfer_material->setujuby->CellCssClass = "";
		if ($logistik_transfer_material->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_transfer_material->actionlink->ViewValue = $logistik_transfer_material->actionlink->CurrentValue;
			$logistik_transfer_material->actionlink->CssStyle = "";
			$logistik_transfer_material->actionlink->CssClass = "";
			$logistik_transfer_material->actionlink->ViewCustomAttributes = "";

			// transkode
			$logistik_transfer_material->transkode->ViewValue = $logistik_transfer_material->transkode->CurrentValue;
			$logistik_transfer_material->transkode->CssStyle = "";
			$logistik_transfer_material->transkode->CssClass = "";
			$logistik_transfer_material->transkode->ViewCustomAttributes = "";

			// tanggal
			$logistik_transfer_material->tanggal->ViewValue = $logistik_transfer_material->tanggal->CurrentValue;
			$logistik_transfer_material->tanggal->ViewValue = ew_FormatDateTime($logistik_transfer_material->tanggal->ViewValue, 7);
			$logistik_transfer_material->tanggal->CssStyle = "";
			$logistik_transfer_material->tanggal->CssClass = "";
			$logistik_transfer_material->tanggal->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_transfer_material->kode_pekerjaan->ViewValue = $logistik_transfer_material->kode_pekerjaan->CurrentValue;
			$logistik_transfer_material->kode_pekerjaan->CssStyle = "";
			$logistik_transfer_material->kode_pekerjaan->CssClass = "";
			$logistik_transfer_material->kode_pekerjaan->ViewCustomAttributes = "";

			// pono
			$logistik_transfer_material->pono->ViewValue = $logistik_transfer_material->pono->CurrentValue;
			$logistik_transfer_material->pono->CssStyle = "";
			$logistik_transfer_material->pono->CssClass = "";
			$logistik_transfer_material->pono->ViewCustomAttributes = "";

			// gudang
			if (strval($logistik_transfer_material->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_transfer_material->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->gudang->ViewValue = $rswrk->fields('nama');
					$logistik_transfer_material->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->gudang->ViewValue = $logistik_transfer_material->gudang->CurrentValue;
				}
			} else {
				$logistik_transfer_material->gudang->ViewValue = NULL;
			}
			$logistik_transfer_material->gudang->CssStyle = "";
			$logistik_transfer_material->gudang->CssClass = "";
			$logistik_transfer_material->gudang->ViewCustomAttributes = "";

			// peruntukan
			if (strval($logistik_transfer_material->peruntukan->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `peruntukan` FROM `mst_peruntukan` WHERE `peruntukan` = '" . ew_AdjustSql($logistik_transfer_material->peruntukan->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `peruntukan` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->peruntukan->ViewValue = $rswrk->fields('peruntukan');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->peruntukan->ViewValue = $logistik_transfer_material->peruntukan->CurrentValue;
				}
			} else {
				$logistik_transfer_material->peruntukan->ViewValue = NULL;
			}
			$logistik_transfer_material->peruntukan->CssStyle = "";
			$logistik_transfer_material->peruntukan->CssClass = "";
			$logistik_transfer_material->peruntukan->ViewCustomAttributes = "";

			// ambilby
			if (strval($logistik_transfer_material->ambilby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->ambilby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->ambilby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->ambilby->ViewValue = $logistik_transfer_material->ambilby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->ambilby->ViewValue = NULL;
			}
			$logistik_transfer_material->ambilby->CssStyle = "";
			$logistik_transfer_material->ambilby->CssClass = "";
			$logistik_transfer_material->ambilby->ViewCustomAttributes = "";

			// beriby
			if (strval($logistik_transfer_material->beriby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->beriby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->beriby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->beriby->ViewValue = $logistik_transfer_material->beriby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->beriby->ViewValue = NULL;
			}
			$logistik_transfer_material->beriby->CssStyle = "";
			$logistik_transfer_material->beriby->CssClass = "";
			$logistik_transfer_material->beriby->ViewCustomAttributes = "";

			// tahuby
			if (strval($logistik_transfer_material->tahuby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->tahuby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->tahuby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->tahuby->ViewValue = $logistik_transfer_material->tahuby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->tahuby->ViewValue = NULL;
			}
			$logistik_transfer_material->tahuby->CssStyle = "";
			$logistik_transfer_material->tahuby->CssClass = "";
			$logistik_transfer_material->tahuby->ViewCustomAttributes = "";

			// setujuby
			if (strval($logistik_transfer_material->setujuby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->setujuby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->setujuby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->setujuby->ViewValue = $logistik_transfer_material->setujuby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->setujuby->ViewValue = NULL;
			}
			$logistik_transfer_material->setujuby->CssStyle = "";
			$logistik_transfer_material->setujuby->CssClass = "";
			$logistik_transfer_material->setujuby->ViewCustomAttributes = "";

			// actionlink
			$logistik_transfer_material->actionlink->HrefValue = "";

			// transkode
			$logistik_transfer_material->transkode->HrefValue = "";

			// tanggal
			$logistik_transfer_material->tanggal->HrefValue = "";

			// kode_pekerjaan
			$logistik_transfer_material->kode_pekerjaan->HrefValue = "";

			// pono
			$logistik_transfer_material->pono->HrefValue = "";

			// gudang
			$logistik_transfer_material->gudang->HrefValue = "";

			// peruntukan
			$logistik_transfer_material->peruntukan->HrefValue = "";

			// ambilby
			$logistik_transfer_material->ambilby->HrefValue = "";

			// beriby
			$logistik_transfer_material->beriby->HrefValue = "";

			// tahuby
			$logistik_transfer_material->tahuby->HrefValue = "";

			// setujuby
			$logistik_transfer_material->setujuby->HrefValue = "";
		} elseif ($logistik_transfer_material->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_transfer_material->actionlink->EditCustomAttributes = "";
			$logistik_transfer_material->actionlink->EditValue = ew_HtmlEncode($logistik_transfer_material->actionlink->AdvancedSearch->SearchValue);

			// transkode
			$logistik_transfer_material->transkode->EditCustomAttributes = "";
			$logistik_transfer_material->transkode->EditValue = ew_HtmlEncode($logistik_transfer_material->transkode->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_transfer_material->tanggal->EditCustomAttributes = "";
			$logistik_transfer_material->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_transfer_material->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// kode_pekerjaan
			$logistik_transfer_material->kode_pekerjaan->EditCustomAttributes = "";
			$logistik_transfer_material->kode_pekerjaan->EditValue = ew_HtmlEncode($logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue);

			// pono
			$logistik_transfer_material->pono->EditCustomAttributes = "";
			$logistik_transfer_material->pono->EditValue = ew_HtmlEncode($logistik_transfer_material->pono->AdvancedSearch->SearchValue);

			// gudang
			$logistik_transfer_material->gudang->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_transfer_material->gudang->EditValue = $arwrk;

			// peruntukan
			$logistik_transfer_material->peruntukan->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `peruntukan`, `peruntukan`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_peruntukan`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `peruntukan` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_transfer_material->peruntukan->EditValue = $arwrk;

			// ambilby
			$logistik_transfer_material->ambilby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_transfer_material->ambilby->EditValue = $arwrk;

			// beriby
			$logistik_transfer_material->beriby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_transfer_material->beriby->EditValue = $arwrk;

			// tahuby
			$logistik_transfer_material->tahuby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_transfer_material->tahuby->EditValue = $arwrk;

			// setujuby
			$logistik_transfer_material->setujuby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_transfer_material->setujuby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_transfer_material->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_transfer_material;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_transfer_material->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_transfer_material;
		$logistik_transfer_material->transkode->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_transkode");
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tanggal");
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_transfer_material->pono->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_pono");
		$logistik_transfer_material->gudang->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_gudang");
		$logistik_transfer_material->peruntukan->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_peruntukan");
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_ambilby");
		$logistik_transfer_material->beriby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_beriby");
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tahuby");
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_setujuby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_transfer_material;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_transfer_material->ExportAll) {
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
		if ($logistik_transfer_material->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_transfer_material->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_transfer_material->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'transkode', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'pono', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'gudang', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'peruntukan', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'ambilby', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'beriby', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'tahuby', $logistik_transfer_material->Export);
				ew_ExportAddValue($sExportStr, 'setujuby', $logistik_transfer_material->Export);
				echo ew_ExportLine($sExportStr, $logistik_transfer_material->Export);
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
				$logistik_transfer_material->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_transfer_material->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('transkode', $logistik_transfer_material->transkode->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_transfer_material->tanggal->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $logistik_transfer_material->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('pono', $logistik_transfer_material->pono->CurrentValue);
					$XmlDoc->AddField('gudang', $logistik_transfer_material->gudang->CurrentValue);
					$XmlDoc->AddField('peruntukan', $logistik_transfer_material->peruntukan->CurrentValue);
					$XmlDoc->AddField('ambilby', $logistik_transfer_material->ambilby->CurrentValue);
					$XmlDoc->AddField('beriby', $logistik_transfer_material->beriby->CurrentValue);
					$XmlDoc->AddField('tahuby', $logistik_transfer_material->tahuby->CurrentValue);
					$XmlDoc->AddField('setujuby', $logistik_transfer_material->setujuby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_transfer_material->Export <> "csv") { // Vertical format
						echo ew_ExportField('transkode', $logistik_transfer_material->transkode->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('tanggal', $logistik_transfer_material->tanggal->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('kode_pekerjaan', $logistik_transfer_material->kode_pekerjaan->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('pono', $logistik_transfer_material->pono->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('gudang', $logistik_transfer_material->gudang->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('peruntukan', $logistik_transfer_material->peruntukan->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('ambilby', $logistik_transfer_material->ambilby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('beriby', $logistik_transfer_material->beriby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('tahuby', $logistik_transfer_material->tahuby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportField('setujuby', $logistik_transfer_material->setujuby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->transkode->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->tanggal->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->kode_pekerjaan->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->pono->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->gudang->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->peruntukan->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->ambilby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->beriby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->tahuby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						ew_ExportAddValue($sExportStr, $logistik_transfer_material->setujuby->ExportValue($logistik_transfer_material->Export, $logistik_transfer_material->ExportOriginalValue), $logistik_transfer_material->Export);
						echo ew_ExportLine($sExportStr, $logistik_transfer_material->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_transfer_material->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_transfer_material->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_transfer_material';

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
