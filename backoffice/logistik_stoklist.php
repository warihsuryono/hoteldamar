<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_stokinfo.php" ?>
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
$logistik_stok_list = new clogistik_stok_list();
$Page =& $logistik_stok_list;

// Page init processing
$logistik_stok_list->Page_Init();

// Page main processing
$logistik_stok_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logistik_stok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_stok_list = new ew_Page("logistik_stok_list");

// page properties
logistik_stok_list.PageID = "list"; // page ID
var EW_PAGE_ID = logistik_stok_list.PageID; // for backward compatibility

// extend page with validate function for search
logistik_stok_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_seqno"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - Seqno");
	elm = fobj.elements["x" + infix + "_stock"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Stok");

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
logistik_stok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_stok_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_stok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_stok_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_stok_list.ShowHighlightText = "Show highlight"; 
logistik_stok_list.HideHighlightText = "Hide highlight";

//-->
</script>
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
<?php if ($logistik_stok->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($logistik_stok->Export == "" && $logistik_stok->SelectLimit);
	if (!$bSelectLimit)
		$rs = $logistik_stok_list->LoadRecordset();
	$logistik_stok_list->lTotalRecs = ($bSelectLimit) ? $logistik_stok->SelectRecordCount() : $rs->RecordCount();
	$logistik_stok_list->lStartRec = 1;
	if ($logistik_stok_list->lDisplayRecs <= 0) // Display all records
		$logistik_stok_list->lDisplayRecs = $logistik_stok_list->lTotalRecs;
	if (!($logistik_stok->ExportAll && $logistik_stok->Export <> ""))
		$logistik_stok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logistik_stok_list->LoadRecordset($logistik_stok_list->lStartRec-1, $logistik_stok_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Stock Logistik</b></h3>
<?php if ($logistik_stok->Export == "" && $logistik_stok->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $logistik_stok_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($logistik_stok->Export == "" && $logistik_stok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logistik_stok_list);" style="text-decoration: none;"><img id="logistik_stok_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="logistik_stok_list_SearchPanel">
<form name="flogistik_stoklistsrch" id="flogistik_stoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return logistik_stok_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="logistik_stok">
<?php
if ($gsSearchError == "")
	$logistik_stok_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$logistik_stok->RowType = EW_ROWTYPE_SEARCH;

// Render row
$logistik_stok_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Seqno</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_seqno" id="z_seqno" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_seqno" id="x_seqno" size="30" value="<?php echo $logistik_stok->seqno->EditValue ?>"<?php echo $logistik_stok->seqno->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<!--tr>
		<td><span class="phpmaker">Cabang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_branchid" id="z_branchid" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_branchid" name="x_branchid"<?php echo $logistik_stok->branchid->EditAttributes() ?>>
<?php
if (is_array($logistik_stok->branchid->EditValue)) {
	$arwrk = $logistik_stok->branchid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stok->branchid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Barang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodebarang" id="z_kodebarang" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="as_x_kodebarang" style="z-index: 8950">
	<input type="text" name="sv_x_kodebarang" id="sv_x_kodebarang" value="<?php echo $logistik_stok->kodebarang->EditValue ?>" size="30"<?php echo $logistik_stok->kodebarang->EditAttributes() ?>>&nbsp;<span id="em_x_kodebarang" class="ewMessage" style="display: none"><img src="images/alert-small.gif" alt="Value does not exist" width="16" height="16" border="0"></span>
	<div id="sc_x_kodebarang"></div>
</div>
<input type="hidden" name="x_kodebarang" id="x_kodebarang" value="<?php echo $logistik_stok->kodebarang->AdvancedSearch->SearchValue ?>">
<?php
	$sSqlWrk = "SELECT `kode`, `nama` FROM `mst_material_part` WHERE (`nama` LIKE '{query_value}%')";
	$sSqlWrk .= " ORDER BY `nama`";
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_kodebarang" id="s_x_kodebarang" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_kodebarang = new ew_AutoSuggest("sv_x_kodebarang", "sc_x_kodebarang", "s_x_kodebarang", "em_x_kodebarang", "x_kodebarang", "", false);
oas_x_kodebarang.formatResult = function(ar) {	
	var df1 = ar[1];
	var df2 = ar[0];
	if (df2 != "")
		df1 += EW_FIELD_SEP + df2;
	return df1;
};
oas_x_kodebarang.ac.typeAhead = false;

//-->
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Stok</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_stock" id="z_stock" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_stock" id="x_stock" size="30" value="<?php echo $logistik_stok->stock->EditValue ?>"<?php echo $logistik_stok->stock->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Diupdate Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $logistik_stok->createby->EditAttributes() ?>>
<?php
if (is_array($logistik_stok->createby->EditValue)) {
	$arwrk = $logistik_stok->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($logistik_stok->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $logistik_stok_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $logistik_stok_list->PageUrl() ?>cmd=reset';">
			<?php if ($logistik_stok_list->sSrchWhere <> "" && $logistik_stok_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logistik_stok_list, this, '<?php echo $logistik_stok->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $logistik_stok_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($logistik_stok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($logistik_stok->CurrentAction <> "gridadd" && $logistik_stok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logistik_stok_list->Pager)) $logistik_stok_list->Pager = new cPrevNextPager($logistik_stok_list->lStartRec, $logistik_stok_list->lDisplayRecs, $logistik_stok_list->lTotalRecs) ?>
<?php if ($logistik_stok_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($logistik_stok_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stok_list->PageUrl() ?>start=<?php echo $logistik_stok_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logistik_stok_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stok_list->PageUrl() ?>start=<?php echo $logistik_stok_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logistik_stok_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logistik_stok_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stok_list->PageUrl() ?>start=<?php echo $logistik_stok_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logistik_stok_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logistik_stok_list->PageUrl() ?>start=<?php echo $logistik_stok_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $logistik_stok_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $logistik_stok_list->Pager->FromIndex ?> to <?php echo $logistik_stok_list->Pager->ToIndex ?> of <?php echo $logistik_stok_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logistik_stok_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($logistik_stok_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="logistik_stok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($logistik_stok_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($logistik_stok_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($logistik_stok_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($logistik_stok_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($logistik_stok_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($logistik_stok_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="flogistik_stoklist" id="flogistik_stoklist" class="ewForm" action="" method="post">
<?php if ($logistik_stok_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$logistik_stok_list->lOptionCnt = 0;
	$logistik_stok_list->lOptionCnt += count($logistik_stok_list->ListOptions->Items); // Custom list options
?>
<?php echo $logistik_stok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($logistik_stok->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_stok_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($logistik_stok->seqno->Visible) { // seqno ?>
	<?php if ($logistik_stok->SortUrl($logistik_stok->seqno) == "") { ?>
		<td style="white-space: nowrap;">Seqno</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stok->SortUrl($logistik_stok->seqno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Seqno</td><td style="width: 10px;"><?php if ($logistik_stok->seqno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stok->seqno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>	
<!--	
<?php if ($logistik_stok->branchid->Visible) { // branchid ?>
	<?php if ($logistik_stok->SortUrl($logistik_stok->branchid) == "") { ?>
		<td style="white-space: nowrap;">Cabang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stok->SortUrl($logistik_stok->branchid) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Cabang</td><td style="width: 10px;"><?php if ($logistik_stok->branchid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stok->branchid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
<?php if ($logistik_stok->kodebarang->Visible) { // kodebarang ?>
	<?php if ($logistik_stok->SortUrl($logistik_stok->kodebarang) == "") { ?>
		<td style="white-space: nowrap;">Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stok->SortUrl($logistik_stok->kodebarang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Barang</td><td style="width: 10px;"><?php if ($logistik_stok->kodebarang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stok->kodebarang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stok->stock->Visible) { // stock ?>
	<?php if ($logistik_stok->SortUrl($logistik_stok->stock) == "") { ?>
		<td style="white-space: nowrap;">Stok</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stok->SortUrl($logistik_stok->stock) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Stok</td><td style="width: 10px;"><?php if ($logistik_stok->stock->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stok->stock->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($logistik_stok->createby->Visible) { // createby ?>
	<?php if ($logistik_stok->SortUrl($logistik_stok->createby) == "") { ?>
		<td style="white-space: nowrap;">Diupdate Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logistik_stok->SortUrl($logistik_stok->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Diupdate Oleh</td><td style="width: 10px;"><?php if ($logistik_stok->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logistik_stok->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($logistik_stok->ExportAll && $logistik_stok->Export <> "") {
	$logistik_stok_list->lStopRec = $logistik_stok_list->lTotalRecs;
} else {
	$logistik_stok_list->lStopRec = $logistik_stok_list->lStartRec + $logistik_stok_list->lDisplayRecs - 1; // Set the last record to display
}
$logistik_stok_list->lRecCount = $logistik_stok_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$logistik_stok->SelectLimit && $logistik_stok_list->lStartRec > 1)
		$rs->Move($logistik_stok_list->lStartRec - 1);
}
$logistik_stok_list->lRowCnt = 0;
while (($logistik_stok->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logistik_stok_list->lRecCount < $logistik_stok_list->lStopRec) {
	$logistik_stok_list->lRecCount++;
	if (intval($logistik_stok_list->lRecCount) >= intval($logistik_stok_list->lStartRec)) {
		$logistik_stok_list->lRowCnt++;

	// Init row class and style
	$logistik_stok->CssClass = "";
	$logistik_stok->CssStyle = "";
	$logistik_stok->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($logistik_stok->CurrentAction == "gridadd") {
		$logistik_stok_list->LoadDefaultValues(); // Load default values
	} else {
		$logistik_stok_list->LoadRowValues($rs); // Load row values
	}
	$logistik_stok->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logistik_stok_list->RenderRow();
?>
	<tr<?php echo $logistik_stok->RowAttributes() ?>>
<?php if ($logistik_stok->Export == "") { ?>
<?php

// Custom list options
foreach ($logistik_stok_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($logistik_stok->seqno->Visible) { // seqno ?>
		<td<?php echo $logistik_stok->seqno->CellAttributes() ?>>
<div<?php echo $logistik_stok->seqno->ViewAttributes() ?>><?php echo $logistik_stok->seqno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<!--
	<?php if ($logistik_stok->branchid->Visible) { // branchid ?>
		<td<?php echo $logistik_stok->branchid->CellAttributes() ?>>
<div<?php echo $logistik_stok->branchid->ViewAttributes() ?>><?php echo $logistik_stok->branchid->ListViewValue() ?></div>
</td>
	<?php } ?>
	-->
	<?php if ($logistik_stok->kodebarang->Visible) { // kodebarang ?>
		<td<?php echo $logistik_stok->kodebarang->CellAttributes() ?>>
<div<?php echo $logistik_stok->kodebarang->ViewAttributes() ?>><?php echo $logistik_stok->kodebarang->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stok->stock->Visible) { // stock ?>
		<td<?php echo $logistik_stok->stock->CellAttributes() ?>>
<div<?php echo $logistik_stok->stock->ViewAttributes() ?>><?php echo $logistik_stok->stock->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logistik_stok->createby->Visible) { // createby ?>
		<td<?php echo $logistik_stok->createby->CellAttributes() ?>>
<div<?php echo $logistik_stok->createby->ViewAttributes() ?>><?php echo $logistik_stok->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($logistik_stok->CurrentAction <> "gridadd")
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
<?php if ($logistik_stok->Export == "" && $logistik_stok->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(logistik_stok_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($logistik_stok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logistik_stok_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_stok_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'logistik_stok';

	// Page Object Name
	var $PageObjName = 'logistik_stok_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_stok;
		if ($logistik_stok->UseTokenInUrl) $PageUrl .= "t=" . $logistik_stok->TableVar . "&"; // add page token
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
		global $objForm, $logistik_stok;
		if ($logistik_stok->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_stok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_stok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_stok_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_stok"] = new clogistik_stok();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_stok', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_stok;
	$logistik_stok->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $logistik_stok->Export; // Get export parameter, used in header
	$gsExportFile = $logistik_stok->TableVar; // Get export file, used in header
	if ($logistik_stok->Export == "print" || $logistik_stok->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($logistik_stok->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($logistik_stok->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($logistik_stok->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($logistik_stok->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $logistik_stok;
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
		if ($logistik_stok->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logistik_stok->getRecordsPerPage(); // Restore from Session
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
		$logistik_stok->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logistik_stok->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$logistik_stok->setStartRecordNumber($this->lStartRec);
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
		$logistik_stok->setSessionWhere($sFilter);
		$logistik_stok->CurrentFilter = "";

		// Export data only
		if (in_array($logistik_stok->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $logistik_stok;
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
			$logistik_stok->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$logistik_stok->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $logistik_stok;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logistik_stok->seqno, FALSE); // Field seqno
		$this->BuildSearchSql($sWhere, $logistik_stok->branchid, FALSE); // Field branchid
		$this->BuildSearchSql($sWhere, $logistik_stok->kodebarang, FALSE); // Field kodebarang
		$this->BuildSearchSql($sWhere, $logistik_stok->stock, FALSE); // Field stock
		$this->BuildSearchSql($sWhere, $logistik_stok->createby, FALSE); // Field createby

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logistik_stok->seqno); // Field seqno
			$this->SetSearchParm($logistik_stok->branchid); // Field branchid
			$this->SetSearchParm($logistik_stok->kodebarang); // Field kodebarang
			$this->SetSearchParm($logistik_stok->stock); // Field stock
			$this->SetSearchParm($logistik_stok->createby); // Field createby
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
		global $logistik_stok;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logistik_stok->setAdvancedSearch("x_$FldParm", $FldVal);
		$logistik_stok->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logistik_stok->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logistik_stok->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logistik_stok->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $logistik_stok;
		$this->sSrchWhere = "";
		$logistik_stok->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $logistik_stok;
		$logistik_stok->setAdvancedSearch("x_seqno", "");
		$logistik_stok->setAdvancedSearch("x_branchid", "");
		$logistik_stok->setAdvancedSearch("x_kodebarang", "");
		$logistik_stok->setAdvancedSearch("x_stock", "");
		$logistik_stok->setAdvancedSearch("x_createby", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $logistik_stok;
		$this->sSrchWhere = $logistik_stok->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $logistik_stok;
		 $logistik_stok->seqno->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_seqno");
		 $logistik_stok->branchid->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_branchid");
		 $logistik_stok->kodebarang->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_kodebarang");
		 $logistik_stok->stock->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_stock");
		 $logistik_stok->createby->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_createby");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $logistik_stok;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$logistik_stok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logistik_stok->CurrentOrderType = @$_GET["ordertype"];
			$logistik_stok->UpdateSort($logistik_stok->seqno); // Field 
			$logistik_stok->UpdateSort($logistik_stok->branchid); // Field 
			$logistik_stok->UpdateSort($logistik_stok->kodebarang); // Field 
			$logistik_stok->UpdateSort($logistik_stok->stock); // Field 
			$logistik_stok->UpdateSort($logistik_stok->createby); // Field 
			$logistik_stok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $logistik_stok;
		$sOrderBy = $logistik_stok->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($logistik_stok->SqlOrderBy() <> "") {
				$sOrderBy = $logistik_stok->SqlOrderBy();
				$logistik_stok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $logistik_stok;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logistik_stok->setSessionOrderBy($sOrderBy);
				$logistik_stok->seqno->setSort("");
				$logistik_stok->branchid->setSort("");
				$logistik_stok->kodebarang->setSort("");
				$logistik_stok->stock->setSort("");
				$logistik_stok->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logistik_stok->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $logistik_stok;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logistik_stok->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logistik_stok->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logistik_stok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logistik_stok->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logistik_stok->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logistik_stok->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logistik_stok;

		// Load search values
		// seqno

		$logistik_stok->seqno->AdvancedSearch->SearchValue = @$_GET["x_seqno"];
		$logistik_stok->seqno->AdvancedSearch->SearchOperator = @$_GET["z_seqno"];

		// branchid
		$logistik_stok->branchid->AdvancedSearch->SearchValue = @$_GET["x_branchid"];
		$logistik_stok->branchid->AdvancedSearch->SearchOperator = @$_GET["z_branchid"];

		// kodebarang
		$logistik_stok->kodebarang->AdvancedSearch->SearchValue = @$_GET["x_kodebarang"];
		$logistik_stok->kodebarang->AdvancedSearch->SearchOperator = @$_GET["z_kodebarang"];

		// stock
		$logistik_stok->stock->AdvancedSearch->SearchValue = @$_GET["x_stock"];
		$logistik_stok->stock->AdvancedSearch->SearchOperator = @$_GET["z_stock"];

		// createby
		$logistik_stok->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$logistik_stok->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logistik_stok;

		// Call Recordset Selecting event
		$logistik_stok->Recordset_Selecting($logistik_stok->CurrentFilter);

		// Load list page SQL
		$sSql = $logistik_stok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$logistik_stok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logistik_stok;
		$sFilter = $logistik_stok->KeyFilter();

		// Call Row Selecting event
		$logistik_stok->Row_Selecting($sFilter);

		// Load sql based on filter
		$logistik_stok->CurrentFilter = $sFilter;
		$sSql = $logistik_stok->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$logistik_stok->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $logistik_stok;
		$logistik_stok->actionlink->setDbValue($rs->fields('actionlink'));
		$logistik_stok->seqno->setDbValue($rs->fields('seqno'));
		$logistik_stok->branchtype->setDbValue($rs->fields('branchtype'));
		$logistik_stok->branchid->setDbValue($rs->fields('branchid'));
		$logistik_stok->kodebarang->setDbValue($rs->fields('kodebarang'));
		$logistik_stok->stock->setDbValue($rs->fields('stock'));
		$logistik_stok->createby->setDbValue($rs->fields('createby'));
		$logistik_stok->createdate->setDbValue($rs->fields('createdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_stok;

		// Call Row_Rendering event
		$logistik_stok->Row_Rendering();

		// Common render codes for all row types
		// seqno

		$logistik_stok->seqno->CellCssStyle = "white-space: nowrap;";
		$logistik_stok->seqno->CellCssClass = "";

		// branchid
		$logistik_stok->branchid->CellCssStyle = "white-space: nowrap;";
		$logistik_stok->branchid->CellCssClass = "";

		// kodebarang
		$logistik_stok->kodebarang->CellCssStyle = "white-space: nowrap;";
		$logistik_stok->kodebarang->CellCssClass = "";

		// stock
		$logistik_stok->stock->CellCssStyle = "white-space: nowrap;";
		$logistik_stok->stock->CellCssClass = "";

		// createby
		$logistik_stok->createby->CellCssStyle = "white-space: nowrap;";
		$logistik_stok->createby->CellCssClass = "";
		if ($logistik_stok->RowType == EW_ROWTYPE_VIEW) { // View row

			// seqno
			$logistik_stok->seqno->ViewValue = $logistik_stok->seqno->CurrentValue;
			$logistik_stok->seqno->CssStyle = "";
			$logistik_stok->seqno->CssClass = "";
			$logistik_stok->seqno->ViewCustomAttributes = "";

			// branchid
			if (strval($logistik_stok->branchid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_stok->branchid->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->branchid->ViewValue = $rswrk->fields('nama');
					$logistik_stok->branchid->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_stok->branchid->ViewValue = $logistik_stok->branchid->CurrentValue;
				}
			} else {
				$logistik_stok->branchid->ViewValue = NULL;
			}
			$logistik_stok->branchid->CssStyle = "";
			$logistik_stok->branchid->CssClass = "";
			$logistik_stok->branchid->ViewCustomAttributes = "";

			// kodebarang
			$logistik_stok->kodebarang->ViewValue = $logistik_stok->kodebarang->CurrentValue;
			if (strval($logistik_stok->kodebarang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `kode` FROM `mst_material_part` WHERE `kode` = '" . ew_AdjustSql($logistik_stok->kodebarang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->kodebarang->ViewValue = $rswrk->fields('nama');
					$logistik_stok->kodebarang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('kode');
					$rswrk->Close();
				} else {
					$logistik_stok->kodebarang->ViewValue = $logistik_stok->kodebarang->CurrentValue;
				}
			} else {
				$logistik_stok->kodebarang->ViewValue = NULL;
			}
			$logistik_stok->kodebarang->CssStyle = "";
			$logistik_stok->kodebarang->CssClass = "";
			$logistik_stok->kodebarang->ViewCustomAttributes = "";

			// stock
			$logistik_stok->stock->ViewValue = $logistik_stok->stock->CurrentValue;
			$logistik_stok->stock->CssStyle = "";
			$logistik_stok->stock->CssClass = "";
			$logistik_stok->stock->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_stok->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stok->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stok->createby->ViewValue = $logistik_stok->createby->CurrentValue;
				}
			} else {
				$logistik_stok->createby->ViewValue = NULL;
			}
			$logistik_stok->createby->CssStyle = "";
			$logistik_stok->createby->CssClass = "";
			$logistik_stok->createby->ViewCustomAttributes = "";

			// seqno
			$logistik_stok->seqno->HrefValue = "";

			// branchid
			$logistik_stok->branchid->HrefValue = "";

			// kodebarang
			$logistik_stok->kodebarang->HrefValue = "";

			// stock
			$logistik_stok->stock->HrefValue = "";

			// createby
			$logistik_stok->createby->HrefValue = "";
		} elseif ($logistik_stok->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// seqno
			$logistik_stok->seqno->EditCustomAttributes = "";
			$logistik_stok->seqno->EditValue = ew_HtmlEncode($logistik_stok->seqno->AdvancedSearch->SearchValue);

			// branchid
			$logistik_stok->branchid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, `alamat`, '' AS SelectFilterFld FROM `mst_gudang`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$logistik_stok->branchid->EditValue = $arwrk;

			// kodebarang
			$logistik_stok->kodebarang->EditCustomAttributes = "";
			$logistik_stok->kodebarang->EditValue = ew_HtmlEncode($logistik_stok->kodebarang->AdvancedSearch->SearchValue);
			if (strval($logistik_stok->kodebarang->AdvancedSearch->SearchValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `kode` FROM `mst_material_part` WHERE `kode` = '" . ew_AdjustSql($logistik_stok->kodebarang->AdvancedSearch->SearchValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->kodebarang->EditValue = $rswrk->fields('nama');
					$logistik_stok->kodebarang->EditValue .= ew_ValueSeparator(0) . $rswrk->fields('kode');
					$rswrk->Close();
				} else {
					$logistik_stok->kodebarang->EditValue = $logistik_stok->kodebarang->AdvancedSearch->SearchValue;
				}
			} else {
				$logistik_stok->kodebarang->EditValue = NULL;
			}

			// stock
			$logistik_stok->stock->EditCustomAttributes = "";
			$logistik_stok->stock->EditValue = ew_HtmlEncode($logistik_stok->stock->AdvancedSearch->SearchValue);

			// createby
			$logistik_stok->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$logistik_stok->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$logistik_stok->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_stok;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($logistik_stok->seqno->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - Seqno";
		}
		if (!ew_CheckNumber($logistik_stok->stock->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Stok";
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
		global $logistik_stok;
		$logistik_stok->seqno->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_seqno");
		$logistik_stok->branchid->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_branchid");
		$logistik_stok->kodebarang->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_kodebarang");
		$logistik_stok->stock->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_stock");
		$logistik_stok->createby->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_createby");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $logistik_stok;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($logistik_stok->ExportAll) {
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
		if ($logistik_stok->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($logistik_stok->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $logistik_stok->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'seqno', $logistik_stok->Export);
				ew_ExportAddValue($sExportStr, 'branchid', $logistik_stok->Export);
				ew_ExportAddValue($sExportStr, 'kodebarang', $logistik_stok->Export);
				ew_ExportAddValue($sExportStr, 'stock', $logistik_stok->Export);
				ew_ExportAddValue($sExportStr, 'createby', $logistik_stok->Export);
				echo ew_ExportLine($sExportStr, $logistik_stok->Export);
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
				$logistik_stok->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logistik_stok->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('seqno', $logistik_stok->seqno->CurrentValue);
					$XmlDoc->AddField('branchid', $logistik_stok->branchid->CurrentValue);
					$XmlDoc->AddField('kodebarang', $logistik_stok->kodebarang->CurrentValue);
					$XmlDoc->AddField('stock', $logistik_stok->stock->CurrentValue);
					$XmlDoc->AddField('createby', $logistik_stok->createby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $logistik_stok->Export <> "csv") { // Vertical format
						echo ew_ExportField('seqno', $logistik_stok->seqno->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						echo ew_ExportField('branchid', $logistik_stok->branchid->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						echo ew_ExportField('kodebarang', $logistik_stok->kodebarang->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						echo ew_ExportField('stock', $logistik_stok->stock->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						echo ew_ExportField('createby', $logistik_stok->createby->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $logistik_stok->seqno->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						ew_ExportAddValue($sExportStr, $logistik_stok->branchid->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						ew_ExportAddValue($sExportStr, $logistik_stok->kodebarang->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						ew_ExportAddValue($sExportStr, $logistik_stok->stock->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						ew_ExportAddValue($sExportStr, $logistik_stok->createby->ExportValue($logistik_stok->Export, $logistik_stok->ExportOriginalValue), $logistik_stok->Export);
						echo ew_ExportLine($sExportStr, $logistik_stok->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($logistik_stok->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($logistik_stok->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'logistik_stok';

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
