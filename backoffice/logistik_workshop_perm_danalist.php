<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_workshop_perm_danainfo.php" ?>
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
$logistik_workshop_perm_dana_list = new clogistik_workshop_perm_dana_list();
$Page =& $logistik_workshop_perm_dana_list;

// Page init processing
$logistik_workshop_perm_dana_list->Page_Init();

// Page main processing
$logistik_workshop_perm_dana_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_workshop_perm_dana_list = new ew_Page("logistik_workshop_perm_dana_list");

// page properties
logistik_workshop_perm_dana_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_workshop_perm_dana_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_workshop_perm_dana_list.ValidateSearch = function(fobj) {
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
logistik_workshop_perm_dana_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_workshop_perm_dana_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_workshop_perm_dana_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_workshop_perm_dana_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_workshop_perm_dana_list.ShowHighlightText = "Show highlight"; 
logistik_workshop_perm_dana_list.HideHighlightText = "Hide highlight";

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
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_workshop_perm_dana->Export == "" && $logistik_workshop_perm_dana->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_workshop_perm_dana_list->LoadRecordset();
	$logistik_workshop_perm_dana_list->lTotalRecs = ($bSelectLimit) ? $logistik_workshop_perm_dana->SelectRecordCount() : $rs->RecordCount();
	$logistik_workshop_perm_dana_list->lStartRec = 1;
	if ($logistik_workshop_perm_dana_list->lDisplayRecs <= 0) // Display all records
		$logistik_workshop_perm_dana_list->lDisplayRecs = $logistik_workshop_perm_dana_list->lTotalRecs;
	if (!($logistik_workshop_perm_dana->ExportAll && $logistik_workshop_perm_dana->Export <> ""))
		$logistik_workshop_perm_dana_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_workshop_perm_dana_list->LoadRecordset($logistik_workshop_perm_dana_list->lStartRec-1, $logistik_workshop_perm_dana_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Permohonan Dana (Workshop)</b></h3>
<?php if ($logistik_workshop_perm_dana->Export == "" && $logistik_workshop_perm_dana->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_workshop_perm_dana->Export == "" && $logistik_workshop_perm_dana->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_workshop_perm_dana_list);" style="text-decoration: none;"><img id="logistik_workshop_perm_dana_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_workshop_perm_dana_list_SearchPanel">
<form name="flogistik_workshop_perm_danalistsrch" id="flogistik_workshop_perm_danalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_workshop_perm_dana_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_workshop_perm_dana">
<?php
if ($gsSearchError == "")
	$logistik_workshop_perm_dana_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_workshop_perm_dana->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_workshop_perm_dana_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Permohonan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodepermohonan" id="z_kodepermohonan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodepermohonan" id="x_kodepermohonan" size="30" maxlength="30" value="<?php echo $logistik_workshop_perm_dana->kodepermohonan->EditValue ?>"<?php echo $logistik_workshop_perm_dana->kodepermohonan->EditAttributes() ?>>
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
<input type="text" name="x_kode_pekerjaan" id="x_kode_pekerjaan" size="30" maxlength="30" value="<?php echo $logistik_workshop_perm_dana->kode_pekerjaan->EditValue ?>"<?php echo $logistik_workshop_perm_dana->kode_pekerjaan->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr-->
	<tr>
		<td><span class="phpmaker">Barang</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_partunit" id="z_partunit" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_partunit" name="x_partunit"<?php echo $logistik_workshop_perm_dana->partunit->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->partunit->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->partunit->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">QR No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_qrno" id="z_qrno" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_qrno" id="x_qrno" size="30" maxlength="30" value="<?php echo $logistik_workshop_perm_dana->qrno->EditValue ?>"<?php echo $logistik_workshop_perm_dana->qrno->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $logistik_workshop_perm_dana->tanggal->EditValue ?>"<?php echo $logistik_workshop_perm_dana->tanggal->EditAttributes() ?>>
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
		<td><span class="phpmaker"></span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_posting" id="z_posting" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_posting" id="x_posting" size="30" maxlength="50" value="<?php echo $logistik_workshop_perm_dana->posting->EditValue ?>"<?php echo $logistik_workshop_perm_dana->posting->EditAttributes() ?>>
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
<select id="x_createby" name="x_createby"<?php echo $logistik_workshop_perm_dana->createby->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->createby->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Adm.Logistik</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_admlogistik" id="z_admlogistik" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_admlogistik" name="x_admlogistik"<?php echo $logistik_workshop_perm_dana->admlogistik->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->admlogistik->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->admlogistik->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Ka.Logistik</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kalogistik" id="z_kalogistik" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_kalogistik" name="x_kalogistik"<?php echo $logistik_workshop_perm_dana->kalogistik->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->kalogistik->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->kalogistik->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Ka.Div.Umum</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kadivumum" id="z_kadivumum" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_kadivumum" name="x_kadivumum"<?php echo $logistik_workshop_perm_dana->kadivumum->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->kadivumum->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->kadivumum->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_dirut" id="z_dirut" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_dirut" name="x_dirut"<?php echo $logistik_workshop_perm_dana->dirut->EditAttributes() ?>>
<?php
if (is_array($logistik_workshop_perm_dana->dirut->EditValue)) {
	$arwrk = $logistik_workshop_perm_dana->dirut->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_workshop_perm_dana_list->sSrchWhere <> "" && $logistik_workshop_perm_dana_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_workshop_perm_dana_list, this, '<?php echo $logistik_workshop_perm_dana->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_workshop_perm_dana_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_workshop_perm_dana->CurrentAction <> "gridadd" && $logistik_workshop_perm_dana->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_workshop_perm_dana_list->Pager)) $logistik_workshop_perm_dana_list->Pager = new cPrevNextPager($logistik_workshop_perm_dana_list->lStartRec, $logistik_workshop_perm_dana_list->lDisplayRecs, $logistik_workshop_perm_dana_list->lTotalRecs) ?>
<?php if ($logistik_workshop_perm_dana_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_workshop_perm_dana_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_workshop_perm_dana_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_workshop_perm_dana_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_workshop_perm_dana_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_workshop_perm_dana_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_workshop_perm_dana_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_workshop_perm_dana_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_workshop_perm_dana_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_workshop_perm_dana_list->PageUrl() ?>start=<?php echo $logistik_workshop_perm_dana_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_workshop_perm_dana_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_workshop_perm_dana_list->Pager->FromIndex ?> to <?php echo $logistik_workshop_perm_dana_list->Pager->ToIndex ?> of <?php echo $logistik_workshop_perm_dana_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_workshop_perm_dana_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_workshop_perm_dana_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_workshop_perm_dana">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_workshop_perm_dana_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $logistik_workshop_perm_dana->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flogistik_workshop_perm_danalist" id="flogistik_workshop_perm_danalist" class="ewForm" action="" method="post">
<?php if ($logistik_workshop_perm_dana_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_workshop_perm_dana_list->lOptionCnt = 0;
	$logistik_workshop_perm_dana_list->lOptionCnt += count($logistik_workshop_perm_dana_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_workshop_perm_dana->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_workshop_perm_dana_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_workshop_perm_dana->actionlink->Visible) { // actionlink ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->kodepermohonan->Visible) { // kodepermohonan ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kodepermohonan) == "") { ?>
		<td style="white-space: nowrap;">Kode Permohonan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kodepermohonan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Permohonan</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->kodepermohonan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->kodepermohonan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($logistik_workshop_perm_dana->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kode_pekerjaan) == "") { ?>
		<td style="white-space: nowrap;">Kode Pekerjaan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kode_pekerjaan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Pekerjaan</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->kode_pekerjaan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->kode_pekerjaan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_workshop_perm_dana->partunit->Visible) { // partunit ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->partunit) == "") { ?>
		<td style="white-space: nowrap;">Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->partunit) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Barang</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->partunit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->partunit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->qrno->Visible) { // qrno ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->qrno) == "") { ?>
		<td style="white-space: nowrap;">QR No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->qrno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>QR No</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->qrno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->qrno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->tanggal->Visible) { // tanggal ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->posting->Visible) { // posting ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->posting) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->posting) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->posting->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->posting->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->createby->Visible) { // createby ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->admlogistik->Visible) { // admlogistik ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->admlogistik) == "") { ?>
		<td style="white-space: nowrap;">Adm.Logistik</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->admlogistik) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Adm.Logistik</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->admlogistik->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->admlogistik->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->kalogistik->Visible) { // kalogistik ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kalogistik) == "") { ?>
		<td style="white-space: nowrap;">Ka.Logistik</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kalogistik) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Ka.Logistik</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->kalogistik->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->kalogistik->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->kadivumum->Visible) { // kadivumum ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kadivumum) == "") { ?>
		<td style="white-space: nowrap;">Ka.Div.Umum</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->kadivumum) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Ka.Div.Umum</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->kadivumum->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->kadivumum->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_workshop_perm_dana->dirut->Visible) { // dirut ?>
	<?php if ($logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->dirut) == "") { ?>
		<td style="white-space: nowrap;">Dirut</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_workshop_perm_dana->SortUrl($logistik_workshop_perm_dana->dirut) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dirut</td><td style="width: 10px;"><?php if ($logistik_workshop_perm_dana->dirut->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_workshop_perm_dana->dirut->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_workshop_perm_dana->ExportAll && $logistik_workshop_perm_dana->Export <> "") {
	$logistik_workshop_perm_dana_list->lStopRec = $logistik_workshop_perm_dana_list->lTotalRecs;
} else {
	$logistik_workshop_perm_dana_list->lStopRec = $logistik_workshop_perm_dana_list->lStartRec + $logistik_workshop_perm_dana_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_workshop_perm_dana_list->lRecCount = $logistik_workshop_perm_dana_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_workshop_perm_dana->SelectLimit && $logistik_workshop_perm_dana_list->lStartRec > 1)
		$rs->Move($logistik_workshop_perm_dana_list->lStartRec - 1);
}
$logistik_workshop_perm_dana_list->lRowCnt = 0;
while (($logistik_workshop_perm_dana->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_workshop_perm_dana_list->lRecCount < $logistik_workshop_perm_dana_list->lStopRec) {
	$logistik_workshop_perm_dana_list->lRecCount++;
	if (intval($logistik_workshop_perm_dana_list->lRecCount) >= intval($logistik_workshop_perm_dana_list->lStartRec)) {
		$logistik_workshop_perm_dana_list->lRowCnt++;

	// Init row class and style
	$logistik_workshop_perm_dana->CssClass = "";
	$logistik_workshop_perm_dana->CssStyle = "";
	$logistik_workshop_perm_dana->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_workshop_perm_dana->CurrentAction == "gridadd") {
		$logistik_workshop_perm_dana_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_workshop_perm_dana_list->LoadRowValues($rs); // Load row values
	}
	$logistik_workshop_perm_dana->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_workshop_perm_dana_list->RenderRow();
?>
	<tr<?php echo $logistik_workshop_perm_dana->RowAttributes() ?>>
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_workshop_perm_dana_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_workshop_perm_dana->actionlink->Visible) { // actionlink ?>
		<td<?php echo $logistik_workshop_perm_dana->actionlink->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->actionlink->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->kodepermohonan->Visible) { // kodepermohonan ?>
		<td<?php echo $logistik_workshop_perm_dana->kodepermohonan->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->kodepermohonan->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->kodepermohonan->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($logistik_workshop_perm_dana->kode_pekerjaan->Visible) { // kode_pekerjaan ?>
		<td<?php echo $logistik_workshop_perm_dana->kode_pekerjaan->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->kode_pekerjaan->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->kode_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	<?php if ($logistik_workshop_perm_dana->partunit->Visible) { // partunit ?>
		<td<?php echo $logistik_workshop_perm_dana->partunit->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->partunit->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->partunit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->qrno->Visible) { // qrno ?>
		<td<?php echo $logistik_workshop_perm_dana->qrno->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->qrno->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->qrno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->tanggal->Visible) { // tanggal ?>
		<td<?php echo $logistik_workshop_perm_dana->tanggal->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->tanggal->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->posting->Visible) { // posting ?>
		<td<?php echo $logistik_workshop_perm_dana->posting->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->posting->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->posting->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->createby->Visible) { // createby ?>
		<td<?php echo $logistik_workshop_perm_dana->createby->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->createby->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->admlogistik->Visible) { // admlogistik ?>
		<td<?php echo $logistik_workshop_perm_dana->admlogistik->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->admlogistik->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->admlogistik->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->kalogistik->Visible) { // kalogistik ?>
		<td<?php echo $logistik_workshop_perm_dana->kalogistik->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->kalogistik->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->kalogistik->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->kadivumum->Visible) { // kadivumum ?>
		<td<?php echo $logistik_workshop_perm_dana->kadivumum->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->kadivumum->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->kadivumum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_workshop_perm_dana->dirut->Visible) { // dirut ?>
		<td<?php echo $logistik_workshop_perm_dana->dirut->CellAttributes() ?>>
<div<?php echo $logistik_workshop_perm_dana->dirut->ViewAttributes() ?>><?php echo $logistik_workshop_perm_dana->dirut->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_workshop_perm_dana->CurrentAction <> "gridadd")
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
<?php if ($logistik_workshop_perm_dana->Export == "" && $logistik_workshop_perm_dana->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_workshop_perm_dana_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_workshop_perm_dana->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_workshop_perm_dana_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_workshop_perm_dana_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_workshop_perm_dana';

	// Page Object Name
	var $PageObjName = 'logistik_workshop_perm_dana_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_workshop_perm_dana;
		if ($logistik_workshop_perm_dana->UseTokenInUrl) $PageUrl .= "t=" . $logistik_workshop_perm_dana->TableVar . "&"; // add page token
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
		global $objForm, $logistik_workshop_perm_dana;
		if ($logistik_workshop_perm_dana->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_workshop_perm_dana->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_workshop_perm_dana->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_workshop_perm_dana_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_workshop_perm_dana"] = new clogistik_workshop_perm_dana();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_workshop_perm_dana', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_workshop_perm_dana;
	$logistik_workshop_perm_dana->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_workshop_perm_dana->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_workshop_perm_dana->TableVar; // Get export file, used in header
	if ($logistik_workshop_perm_dana->Export == "print" || $logistik_workshop_perm_dana->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_workshop_perm_dana->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_workshop_perm_dana->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_workshop_perm_dana->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_workshop_perm_dana->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_workshop_perm_dana;
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
		if ($logistik_workshop_perm_dana->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_workshop_perm_dana->getRecordsPerPage(); // Restore from Session
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
		$logistik_workshop_perm_dana->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_workshop_perm_dana->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
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
		$logistik_workshop_perm_dana->setSessionWhere($sFilter);
		$logistik_workshop_perm_dana->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_workshop_perm_dana->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_workshop_perm_dana;
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
			$logistik_workshop_perm_dana->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_workshop_perm_dana;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->kodepermohonan, FALSE); // Field kodepermohonan
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->kode_pekerjaan, FALSE); // Field kode_pekerjaan
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->partunit, FALSE); // Field partunit
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->qrno, FALSE); // Field qrno
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->posting, FALSE); // Field posting
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->admlogistik, FALSE); // Field admlogistik
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->kalogistik, FALSE); // Field kalogistik
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->kadivumum, FALSE); // Field kadivumum
		$this->BuildSearchSql($sWhere, $logistik_workshop_perm_dana->dirut, FALSE); // Field dirut

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_workshop_perm_dana->kodepermohonan); // Field kodepermohonan
			$this->SetSearchParm($logistik_workshop_perm_dana->kode_pekerjaan); // Field kode_pekerjaan
			$this->SetSearchParm($logistik_workshop_perm_dana->partunit); // Field partunit
			$this->SetSearchParm($logistik_workshop_perm_dana->qrno); // Field qrno
			$this->SetSearchParm($logistik_workshop_perm_dana->tanggal); // Field tanggal
			$this->SetSearchParm($logistik_workshop_perm_dana->posting); // Field posting
			$this->SetSearchParm($logistik_workshop_perm_dana->createby); // Field createby
			$this->SetSearchParm($logistik_workshop_perm_dana->admlogistik); // Field admlogistik
			$this->SetSearchParm($logistik_workshop_perm_dana->kalogistik); // Field kalogistik
			$this->SetSearchParm($logistik_workshop_perm_dana->kadivumum); // Field kadivumum
			$this->SetSearchParm($logistik_workshop_perm_dana->dirut); // Field dirut
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
		global $logistik_workshop_perm_dana;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_workshop_perm_dana->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_workshop_perm_dana->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_workshop_perm_dana->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_workshop_perm_dana->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_workshop_perm_dana->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_workshop_perm_dana;
		$this->sSrchWhere = "";
		$logistik_workshop_perm_dana->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_workshop_perm_dana;
		$logistik_workshop_perm_dana->setAdvancedSearch("x_kodepermohonan", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_kode_pekerjaan", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_partunit", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_qrno", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_tanggal", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_posting", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_createby", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_admlogistik", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_kalogistik", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_kadivumum", "");
		$logistik_workshop_perm_dana->setAdvancedSearch("x_dirut", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_workshop_perm_dana;
		$this->sSrchWhere = $logistik_workshop_perm_dana->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_workshop_perm_dana;
		 $logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kodepermohonan");
		 $logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kode_pekerjaan");
		 $logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_partunit");
		 $logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_qrno");
		 $logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_tanggal");
		 $logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_posting");
		 $logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_createby");
		 $logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_admlogistik");
		 $logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kalogistik");
		 $logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kadivumum");
		 $logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_dirut");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_workshop_perm_dana;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_workshop_perm_dana->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_workshop_perm_dana->CurrentOrderType = @$_GET["ordertype"];
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->actionlink); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->kodepermohonan); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->kode_pekerjaan); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->partunit); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->qrno); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->tanggal); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->posting); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->createby); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->admlogistik); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->kalogistik); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->kadivumum); // Field 
			$logistik_workshop_perm_dana->UpdateSort($logistik_workshop_perm_dana->dirut); // Field 
			$logistik_workshop_perm_dana->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_workshop_perm_dana;
		$sOrderBy = $logistik_workshop_perm_dana->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_workshop_perm_dana->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_workshop_perm_dana->SqlOrderBy();
				$logistik_workshop_perm_dana->setSessionOrderBy($sOrderBy);
				$logistik_workshop_perm_dana->kodepermohonan->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_workshop_perm_dana;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_workshop_perm_dana->setSessionOrderBy($sOrderBy);
				$logistik_workshop_perm_dana->actionlink->setSort("");
				$logistik_workshop_perm_dana->kodepermohonan->setSort("");
				$logistik_workshop_perm_dana->kode_pekerjaan->setSort("");
				$logistik_workshop_perm_dana->partunit->setSort("");
				$logistik_workshop_perm_dana->qrno->setSort("");
				$logistik_workshop_perm_dana->tanggal->setSort("");
				$logistik_workshop_perm_dana->posting->setSort("");
				$logistik_workshop_perm_dana->createby->setSort("");
				$logistik_workshop_perm_dana->admlogistik->setSort("");
				$logistik_workshop_perm_dana->kalogistik->setSort("");
				$logistik_workshop_perm_dana->kadivumum->setSort("");
				$logistik_workshop_perm_dana->dirut->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_workshop_perm_dana;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_workshop_perm_dana->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_workshop_perm_dana->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_workshop_perm_dana;

		// Load search values
		// kodepermohonan

		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = @$_GET["x_kodepermohonan"];
		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchOperator = @$_GET["z_kodepermohonan"];

		// kode_pekerjaan
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = @$_GET["x_kode_pekerjaan"];
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_kode_pekerjaan"];

		// partunit
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue = @$_GET["x_partunit"];
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchOperator = @$_GET["z_partunit"];

		// qrno
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue = @$_GET["x_qrno"];
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchOperator = @$_GET["z_qrno"];

		// tanggal
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// posting
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue = @$_GET["x_posting"];
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchOperator = @$_GET["z_posting"];

		// createby
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// admlogistik
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue = @$_GET["x_admlogistik"];
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchOperator = @$_GET["z_admlogistik"];

		// kalogistik
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue = @$_GET["x_kalogistik"];
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchOperator = @$_GET["z_kalogistik"];

		// kadivumum
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue = @$_GET["x_kadivumum"];
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchOperator = @$_GET["z_kadivumum"];

		// dirut
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue = @$_GET["x_dirut"];
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchOperator = @$_GET["z_dirut"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_workshop_perm_dana;

		// Call Recordset Selecting event
		$logistik_workshop_perm_dana->Recordset_Selecting($logistik_workshop_perm_dana->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_workshop_perm_dana->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_workshop_perm_dana->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_workshop_perm_dana;
		$sFilter = $logistik_workshop_perm_dana->KeyFilter();

		// Call Row Selecting event
		$logistik_workshop_perm_dana->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_workshop_perm_dana->CurrentFilter = $sFilter;
		$sSql = $logistik_workshop_perm_dana->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_workshop_perm_dana->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_workshop_perm_dana;
		$logistik_workshop_perm_dana->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_workshop_perm_dana->kodepermohonan->setDbValue($rs->fields('kodepermohonan'));
		$logistik_workshop_perm_dana->idseqno->setDbValue($rs->fields('idseqno'));
		$logistik_workshop_perm_dana->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$logistik_workshop_perm_dana->partunit->setDbValue($rs->fields('partunit'));
		$logistik_workshop_perm_dana->kodeworkshop->setDbValue($rs->fields('kodeworkshop'));
		$logistik_workshop_perm_dana->qrno->setDbValue($rs->fields('qrno'));
		$logistik_workshop_perm_dana->pono->setDbValue($rs->fields('pono'));
		$logistik_workshop_perm_dana->tanggal->setDbValue($rs->fields('tanggal'));
		$logistik_workshop_perm_dana->posting->setDbValue($rs->fields('posting'));
		$logistik_workshop_perm_dana->lavelansir->setDbValue($rs->fields('lavelansir'));
		$logistik_workshop_perm_dana->createby->setDbValue($rs->fields('createby'));
		$logistik_workshop_perm_dana->createdate->setDbValue($rs->fields('createdate'));
		$logistik_workshop_perm_dana->admlogistik->setDbValue($rs->fields('admlogistik'));
		$logistik_workshop_perm_dana->admlogistikdate->setDbValue($rs->fields('admlogistikdate'));
		$logistik_workshop_perm_dana->kalogistik->setDbValue($rs->fields('kalogistik'));
		$logistik_workshop_perm_dana->kalogistikdate->setDbValue($rs->fields('kalogistikdate'));
		$logistik_workshop_perm_dana->kadivumum->setDbValue($rs->fields('kadivumum'));
		$logistik_workshop_perm_dana->kadivumumdate->setDbValue($rs->fields('kadivumumdate'));
		$logistik_workshop_perm_dana->dirut->setDbValue($rs->fields('dirut'));
		$logistik_workshop_perm_dana->dirutdate->setDbValue($rs->fields('dirutdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_workshop_perm_dana;

		// Call Row_Rendering event
		$logistik_workshop_perm_dana->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_workshop_perm_dana->actionlink->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->actionlink->CellCssClass = "";

		// kodepermohonan
		$logistik_workshop_perm_dana->kodepermohonan->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->kodepermohonan->CellCssClass = "";

		// kode_pekerjaan
		$logistik_workshop_perm_dana->kode_pekerjaan->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->kode_pekerjaan->CellCssClass = "";

		// partunit
		$logistik_workshop_perm_dana->partunit->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->partunit->CellCssClass = "";

		// qrno
		$logistik_workshop_perm_dana->qrno->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->qrno->CellCssClass = "";

		// tanggal
		$logistik_workshop_perm_dana->tanggal->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->tanggal->CellCssClass = "";

		// posting
		$logistik_workshop_perm_dana->posting->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->posting->CellCssClass = "";

		// createby
		$logistik_workshop_perm_dana->createby->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->createby->CellCssClass = "";

		// admlogistik
		$logistik_workshop_perm_dana->admlogistik->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->admlogistik->CellCssClass = "";

		// kalogistik
		$logistik_workshop_perm_dana->kalogistik->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->kalogistik->CellCssClass = "";

		// kadivumum
		$logistik_workshop_perm_dana->kadivumum->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->kadivumum->CellCssClass = "";

		// dirut
		$logistik_workshop_perm_dana->dirut->CellCssStyle = "white-space: nowrap;";
		$logistik_workshop_perm_dana->dirut->CellCssClass = "";
		if ($logistik_workshop_perm_dana->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_workshop_perm_dana->actionlink->ViewValue = $logistik_workshop_perm_dana->actionlink->CurrentValue;
			$logistik_workshop_perm_dana->actionlink->CssStyle = "";
			$logistik_workshop_perm_dana->actionlink->CssClass = "";
			$logistik_workshop_perm_dana->actionlink->ViewCustomAttributes = "";

			// kodepermohonan
			$logistik_workshop_perm_dana->kodepermohonan->ViewValue = $logistik_workshop_perm_dana->kodepermohonan->CurrentValue;
			$logistik_workshop_perm_dana->kodepermohonan->CssStyle = "";
			$logistik_workshop_perm_dana->kodepermohonan->CssClass = "";
			$logistik_workshop_perm_dana->kodepermohonan->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_workshop_perm_dana->kode_pekerjaan->ViewValue = $logistik_workshop_perm_dana->kode_pekerjaan->CurrentValue;
			$logistik_workshop_perm_dana->kode_pekerjaan->CssStyle = "";
			$logistik_workshop_perm_dana->kode_pekerjaan->CssClass = "";
			$logistik_workshop_perm_dana->kode_pekerjaan->ViewCustomAttributes = "";

			// partunit
			if (strval($logistik_workshop_perm_dana->partunit->CurrentValue) <> "") {
				switch ($logistik_workshop_perm_dana->partunit->CurrentValue) {
					case "part":
						$logistik_workshop_perm_dana->partunit->ViewValue = "Part";
						break;
					case "unit":
						$logistik_workshop_perm_dana->partunit->ViewValue = "Unit";
						break;
					default:
						$logistik_workshop_perm_dana->partunit->ViewValue = $logistik_workshop_perm_dana->partunit->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->partunit->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->partunit->CssStyle = "";
			$logistik_workshop_perm_dana->partunit->CssClass = "";
			$logistik_workshop_perm_dana->partunit->ViewCustomAttributes = "";

			// qrno
			$logistik_workshop_perm_dana->qrno->ViewValue = $logistik_workshop_perm_dana->qrno->CurrentValue;
			$logistik_workshop_perm_dana->qrno->CssStyle = "";
			$logistik_workshop_perm_dana->qrno->CssClass = "";
			$logistik_workshop_perm_dana->qrno->ViewCustomAttributes = "";

			// tanggal
			$logistik_workshop_perm_dana->tanggal->ViewValue = $logistik_workshop_perm_dana->tanggal->CurrentValue;
			$logistik_workshop_perm_dana->tanggal->ViewValue = ew_FormatDateTime($logistik_workshop_perm_dana->tanggal->ViewValue, 7);
			$logistik_workshop_perm_dana->tanggal->CssStyle = "";
			$logistik_workshop_perm_dana->tanggal->CssClass = "";
			$logistik_workshop_perm_dana->tanggal->ViewCustomAttributes = "";

			// posting
			$logistik_workshop_perm_dana->posting->ViewValue = $logistik_workshop_perm_dana->posting->CurrentValue;
			$logistik_workshop_perm_dana->posting->CssStyle = "";
			$logistik_workshop_perm_dana->posting->CssClass = "";
			$logistik_workshop_perm_dana->posting->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_workshop_perm_dana->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->createby->ViewValue = $logistik_workshop_perm_dana->createby->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->createby->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->createby->CssStyle = "";
			$logistik_workshop_perm_dana->createby->CssClass = "";
			$logistik_workshop_perm_dana->createby->ViewCustomAttributes = "";

			// admlogistik
			if (strval($logistik_workshop_perm_dana->admlogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->admlogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->admlogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->admlogistik->ViewValue = $logistik_workshop_perm_dana->admlogistik->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->admlogistik->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->admlogistik->CssStyle = "";
			$logistik_workshop_perm_dana->admlogistik->CssClass = "";
			$logistik_workshop_perm_dana->admlogistik->ViewCustomAttributes = "";

			// kalogistik
			if (strval($logistik_workshop_perm_dana->kalogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->kalogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->kalogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->kalogistik->ViewValue = $logistik_workshop_perm_dana->kalogistik->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->kalogistik->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->kalogistik->CssStyle = "";
			$logistik_workshop_perm_dana->kalogistik->CssClass = "";
			$logistik_workshop_perm_dana->kalogistik->ViewCustomAttributes = "";

			// kadivumum
			if (strval($logistik_workshop_perm_dana->kadivumum->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->kadivumum->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->kadivumum->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->kadivumum->ViewValue = $logistik_workshop_perm_dana->kadivumum->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->kadivumum->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->kadivumum->CssStyle = "";
			$logistik_workshop_perm_dana->kadivumum->CssClass = "";
			$logistik_workshop_perm_dana->kadivumum->ViewCustomAttributes = "";

			// dirut
			if (strval($logistik_workshop_perm_dana->dirut->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->dirut->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->dirut->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->dirut->ViewValue = $logistik_workshop_perm_dana->dirut->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->dirut->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->dirut->CssStyle = "";
			$logistik_workshop_perm_dana->dirut->CssClass = "";
			$logistik_workshop_perm_dana->dirut->ViewCustomAttributes = "";

			// actionlink
			$logistik_workshop_perm_dana->actionlink->HrefValue = "";

			// kodepermohonan
			$logistik_workshop_perm_dana->kodepermohonan->HrefValue = "";

			// kode_pekerjaan
			$logistik_workshop_perm_dana->kode_pekerjaan->HrefValue = "";

			// partunit
			$logistik_workshop_perm_dana->partunit->HrefValue = "";

			// qrno
			$logistik_workshop_perm_dana->qrno->HrefValue = "";

			// tanggal
			$logistik_workshop_perm_dana->tanggal->HrefValue = "";

			// posting
			$logistik_workshop_perm_dana->posting->HrefValue = "";

			// createby
			$logistik_workshop_perm_dana->createby->HrefValue = "";

			// admlogistik
			$logistik_workshop_perm_dana->admlogistik->HrefValue = "";

			// kalogistik
			$logistik_workshop_perm_dana->kalogistik->HrefValue = "";

			// kadivumum
			$logistik_workshop_perm_dana->kadivumum->HrefValue = "";

			// dirut
			$logistik_workshop_perm_dana->dirut->HrefValue = "";
		} elseif ($logistik_workshop_perm_dana->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_workshop_perm_dana->actionlink->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->actionlink->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->actionlink->AdvancedSearch->SearchValue);

			// kodepermohonan
			$logistik_workshop_perm_dana->kodepermohonan->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->kodepermohonan->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue);

			// kode_pekerjaan
			$logistik_workshop_perm_dana->kode_pekerjaan->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->kode_pekerjaan->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue);

			// partunit
			$logistik_workshop_perm_dana->partunit->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("part", "Part");
			$arwrk[] = array("unit", "Unit");
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->partunit->EditValue = $arwrk;

			// qrno
			$logistik_workshop_perm_dana->qrno->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->qrno->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue);

			// tanggal
			$logistik_workshop_perm_dana->tanggal->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// posting
			$logistik_workshop_perm_dana->posting->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->posting->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue);

			// createby
			$logistik_workshop_perm_dana->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->createby->EditValue = $arwrk;

			// admlogistik
			$logistik_workshop_perm_dana->admlogistik->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->admlogistik->EditValue = $arwrk;

			// kalogistik
			$logistik_workshop_perm_dana->kalogistik->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->kalogistik->EditValue = $arwrk;

			// kadivumum
			$logistik_workshop_perm_dana->kadivumum->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->kadivumum->EditValue = $arwrk;

			// dirut
			$logistik_workshop_perm_dana->dirut->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_workshop_perm_dana->dirut->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_workshop_perm_dana->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_workshop_perm_dana;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_workshop_perm_dana;
		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kodepermohonan");
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_partunit");
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_qrno");
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_tanggal");
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_posting");
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_createby");
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_admlogistik");
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kalogistik");
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kadivumum");
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_dirut");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_workshop_perm_dana;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_workshop_perm_dana->ExportAll) {
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
		if ($logistik_workshop_perm_dana->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_workshop_perm_dana->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_workshop_perm_dana->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodepermohonan', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'kode_pekerjaan', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'partunit', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'qrno', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'posting', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'createby', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'admlogistik', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'kalogistik', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'kadivumum', $logistik_workshop_perm_dana->Export);
				ew_ExportAddValue($sExportStr, 'dirut', $logistik_workshop_perm_dana->Export);
				echo ew_ExportLine($sExportStr, $logistik_workshop_perm_dana->Export);
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
				$logistik_workshop_perm_dana->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_workshop_perm_dana->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodepermohonan', $logistik_workshop_perm_dana->kodepermohonan->CurrentValue);
					$XmlDoc->AddField('kode_pekerjaan', $logistik_workshop_perm_dana->kode_pekerjaan->CurrentValue);
					$XmlDoc->AddField('partunit', $logistik_workshop_perm_dana->partunit->CurrentValue);
					$XmlDoc->AddField('qrno', $logistik_workshop_perm_dana->qrno->CurrentValue);
					$XmlDoc->AddField('tanggal', $logistik_workshop_perm_dana->tanggal->CurrentValue);
					$XmlDoc->AddField('posting', $logistik_workshop_perm_dana->posting->CurrentValue);
					$XmlDoc->AddField('createby', $logistik_workshop_perm_dana->createby->CurrentValue);
					$XmlDoc->AddField('admlogistik', $logistik_workshop_perm_dana->admlogistik->CurrentValue);
					$XmlDoc->AddField('kalogistik', $logistik_workshop_perm_dana->kalogistik->CurrentValue);
					$XmlDoc->AddField('kadivumum', $logistik_workshop_perm_dana->kadivumum->CurrentValue);
					$XmlDoc->AddField('dirut', $logistik_workshop_perm_dana->dirut->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_workshop_perm_dana->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodepermohonan', $logistik_workshop_perm_dana->kodepermohonan->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('kode_pekerjaan', $logistik_workshop_perm_dana->kode_pekerjaan->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('partunit', $logistik_workshop_perm_dana->partunit->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('qrno', $logistik_workshop_perm_dana->qrno->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('tanggal', $logistik_workshop_perm_dana->tanggal->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('posting', $logistik_workshop_perm_dana->posting->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('createby', $logistik_workshop_perm_dana->createby->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('admlogistik', $logistik_workshop_perm_dana->admlogistik->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('kalogistik', $logistik_workshop_perm_dana->kalogistik->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('kadivumum', $logistik_workshop_perm_dana->kadivumum->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportField('dirut', $logistik_workshop_perm_dana->dirut->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->kodepermohonan->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->kode_pekerjaan->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->partunit->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->qrno->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->tanggal->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->posting->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->createby->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->admlogistik->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->kalogistik->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->kadivumum->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						ew_ExportAddValue($sExportStr, $logistik_workshop_perm_dana->dirut->ExportValue($logistik_workshop_perm_dana->Export, $logistik_workshop_perm_dana->ExportOriginalValue), $logistik_workshop_perm_dana->Export);
						echo ew_ExportLine($sExportStr, $logistik_workshop_perm_dana->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_workshop_perm_dana->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_workshop_perm_dana->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_workshop_perm_dana';

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
