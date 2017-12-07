<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "asset_categoryinfo.php" ?>
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
$asset_category_list = new casset_category_list();
$Page =& $asset_category_list;

// Page init processing
$asset_category_list->Page_Init();

// Page main processing
$asset_category_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($asset_category->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var asset_category_list = new ew_Page("asset_category_list");

// page properties
asset_category_list.PageID = "list"; // page ID
var EW_PAGE_ID = asset_category_list.PageID; // for backward compatibility

// extend page with ValidateForm function
asset_category_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_coa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Coa");
		elm = fobj.elements["x" + infix + "_category"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Category");
		elm = fobj.elements["x" + infix + "_penyusutan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Penyusutan (%)");
		elm = fobj.elements["x" + infix + "_penyusutan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Penyusutan (%)");
		elm = fobj.elements["x" + infix + "_coabiaya"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - COA Biaya Penyusutan");
		elm = fobj.elements["x" + infix + "_coaakum"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - COA Akum.Penyusutan");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
asset_category_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
asset_category_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
asset_category_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if ($asset_category->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($asset_category->Export == "" && $asset_category->SelectLimit);
	if (!$bSelectLimit)
		$rs = $asset_category_list->LoadRecordset();
	$asset_category_list->lTotalRecs = ($bSelectLimit) ? $asset_category->SelectRecordCount() : $rs->RecordCount();
	$asset_category_list->lStartRec = 1;
	if ($asset_category_list->lDisplayRecs <= 0) // Display all records
		$asset_category_list->lDisplayRecs = $asset_category_list->lTotalRecs;
	if (!($asset_category->ExportAll && $asset_category->Export <> ""))
		$asset_category_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $asset_category_list->LoadRecordset($asset_category_list->lStartRec-1, $asset_category_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Asset Category</b></h3>
<?php if ($asset_category->Export == "" && $asset_category->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $asset_category_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $asset_category_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($asset_category->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($asset_category->CurrentAction <> "gridadd" && $asset_category->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($asset_category_list->Pager)) $asset_category_list->Pager = new cPrevNextPager($asset_category_list->lStartRec, $asset_category_list->lDisplayRecs, $asset_category_list->lTotalRecs) ?>
<?php if ($asset_category_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($asset_category_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $asset_category_list->PageUrl() ?>start=<?php echo $asset_category_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($asset_category_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $asset_category_list->PageUrl() ?>start=<?php echo $asset_category_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $asset_category_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($asset_category_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $asset_category_list->PageUrl() ?>start=<?php echo $asset_category_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($asset_category_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $asset_category_list->PageUrl() ?>start=<?php echo $asset_category_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $asset_category_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $asset_category_list->Pager->FromIndex ?> to <?php echo $asset_category_list->Pager->ToIndex ?> of <?php echo $asset_category_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($asset_category_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($asset_category_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="asset_category">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($asset_category_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($asset_category_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($asset_category_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($asset_category_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($asset_category_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($asset_category_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $asset_category_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fasset_categorylist" id="fasset_categorylist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="asset_category">
<?php if ($asset_category_list->lTotalRecs > 0 || $asset_category->CurrentAction == "add" || $asset_category->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$asset_category_list->lOptionCnt = 0;
	$asset_category_list->lOptionCnt++; // edit
	$asset_category_list->lOptionCnt++; // Delete
	$asset_category_list->lOptionCnt++; // Detail
	$asset_category_list->lOptionCnt += count($asset_category_list->ListOptions->Items); // Custom list options
?>
<?php echo $asset_category->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($asset_category->kode->Visible) { // kode ?>
	<?php if ($asset_category->SortUrl($asset_category->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($asset_category->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->coa->Visible) { // coa ?>
	<?php if ($asset_category->SortUrl($asset_category->coa) == "") { ?>
		<td style="white-space: nowrap;">Coa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->coa) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Coa</td><td style="width: 10px;"><?php if ($asset_category->coa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->coa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->category->Visible) { // category ?>
	<?php if ($asset_category->SortUrl($asset_category->category) == "") { ?>
		<td style="white-space: nowrap;">Category</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->category) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Category</td><td style="width: 10px;"><?php if ($asset_category->category->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->category->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->penyusutan->Visible) { // penyusutan ?>
	<?php if ($asset_category->SortUrl($asset_category->penyusutan) == "") { ?>
		<td style="white-space: nowrap;">Penyusutan (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->penyusutan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Penyusutan (%)</td><td style="width: 10px;"><?php if ($asset_category->penyusutan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->penyusutan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->coabiaya->Visible) { // coabiaya ?>
	<?php if ($asset_category->SortUrl($asset_category->coabiaya) == "") { ?>
		<td style="white-space: nowrap;">COA Biaya Penyusutan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->coabiaya) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>COA Biaya Penyusutan</td><td style="width: 10px;"><?php if ($asset_category->coabiaya->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->coabiaya->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->coaakum->Visible) { // coaakum ?>
	<?php if ($asset_category->SortUrl($asset_category->coaakum) == "") { ?>
		<td style="white-space: nowrap;">COA Akum.Penyusutan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_category->SortUrl($asset_category->coaakum) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>COA Akum.Penyusutan</td><td style="width: 10px;"><?php if ($asset_category->coaakum->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_category->coaakum->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_category->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($asset_category_list->lOptionCnt == 0 && $asset_category->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($asset_category_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($asset_category->CurrentAction == "add" || $asset_category->CurrentAction == "copy") {
		$asset_category_list->lRowIndex = 1;
		if ($asset_category->CurrentAction == "add")
			$asset_category_list->LoadDefaultValues();
		if ($asset_category->EventCancelled) // Insert failed
			$asset_category_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$asset_category->CssClass = "ewTableEditRow";
		$asset_category->CssStyle = "";
		$asset_category->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$asset_category->RowType = EW_ROWTYPE_ADD;

		// Render row
		$asset_category_list->RenderRow();
?>
	<tr<?php echo $asset_category->RowAttributes() ?>>
	<?php if ($asset_category->kode->Visible) { // kode ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($asset_category->coa->Visible) { // coa ?>
		<td style="white-space: nowrap;">
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coa" name="x<?php echo $asset_category_list->lRowIndex ?>_coa"<?php echo $asset_category->coa->EditAttributes() ?>>
<?php
if (is_array($asset_category->coa->EditValue)) {
	$arwrk = $asset_category->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
	<?php if ($asset_category->category->Visible) { // category ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_category_list->lRowIndex ?>_category" id="x<?php echo $asset_category_list->lRowIndex ?>_category" size="30" maxlength="200" value="<?php echo $asset_category->category->EditValue ?>"<?php echo $asset_category->category->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($asset_category->penyusutan->Visible) { // penyusutan ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_category_list->lRowIndex ?>_penyusutan" id="x<?php echo $asset_category_list->lRowIndex ?>_penyusutan" size="3" value="<?php echo $asset_category->penyusutan->EditValue ?>"<?php echo $asset_category->penyusutan->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($asset_category->coabiaya->Visible) { // coabiaya ?>
		<td style="white-space: nowrap;">
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coabiaya" name="x<?php echo $asset_category_list->lRowIndex ?>_coabiaya"<?php echo $asset_category->coabiaya->EditAttributes() ?>>
<?php
if (is_array($asset_category->coabiaya->EditValue)) {
	$arwrk = $asset_category->coabiaya->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coabiaya->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
	<?php if ($asset_category->coaakum->Visible) { // coaakum ?>
		<td style="white-space: nowrap;">
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coaakum" name="x<?php echo $asset_category_list->lRowIndex ?>_coaakum"<?php echo $asset_category->coaakum->EditAttributes() ?>>
<?php
if (is_array($asset_category->coaakum->EditValue)) {
	$arwrk = $asset_category->coaakum->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coaakum->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
<td colspan="<?php echo $asset_category_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (asset_category_list.ValidateForm(document.fasset_categorylist)) document.fasset_categorylist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $asset_category_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($asset_category->ExportAll && $asset_category->Export <> "") {
	$asset_category_list->lStopRec = $asset_category_list->lTotalRecs;
} else {
	$asset_category_list->lStopRec = $asset_category_list->lStartRec + $asset_category_list->lDisplayRecs - 1; // Set the last record to display
}
$asset_category_list->lRecCount = $asset_category_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$asset_category->SelectLimit && $asset_category_list->lStartRec > 1)
		$rs->Move($asset_category_list->lStartRec - 1);
}
$asset_category_list->lRowCnt = 0;
$asset_category_list->lEditRowCnt = 0;
if ($asset_category->CurrentAction == "edit")
	$asset_category_list->lRowIndex = 1;
while (($asset_category->CurrentAction == "gridadd" || !$rs->EOF) &&
	$asset_category_list->lRecCount < $asset_category_list->lStopRec) {
	$asset_category_list->lRecCount++;
	if (intval($asset_category_list->lRecCount) >= intval($asset_category_list->lStartRec)) {
		$asset_category_list->lRowCnt++;

	// Init row class and style
	$asset_category->CssClass = "";
	$asset_category->CssStyle = "";
	$asset_category->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($asset_category->CurrentAction == "gridadd") {
		$asset_category_list->LoadDefaultValues(); // Load default values
	} else {
		$asset_category_list->LoadRowValues($rs); // Load row values
	}
	$asset_category->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($asset_category->CurrentAction == "edit") {
		if ($asset_category_list->CheckInlineEditKey() && $asset_category_list->lEditRowCnt == 0) // Inline edit
			$asset_category->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($asset_category->RowType == EW_ROWTYPE_EDIT && $asset_category->EventCancelled) { // Update failed
		if ($asset_category->CurrentAction == "edit")
			$asset_category_list->RestoreFormValues(); // Restore form values
	}
	if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$asset_category_list->lEditRowCnt++;
		$asset_category->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($asset_category->RowType == EW_ROWTYPE_ADD || $asset_category->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$asset_category->CssClass = "ewTableEditRow";

	// Render row
	$asset_category_list->RenderRow();
?>
	<tr<?php echo $asset_category->RowAttributes() ?>>
	<?php if ($asset_category->kode->Visible) { // kode ?>
		<td<?php echo $asset_category->kode->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $asset_category->kode->ViewAttributes() ?>><?php echo $asset_category->kode->EditValue ?></div><input type="hidden" name="x<?php echo $asset_category_list->lRowIndex ?>_kode" id="x<?php echo $asset_category_list->lRowIndex ?>_kode" value="<?php echo ew_HtmlEncode($asset_category->kode->CurrentValue) ?>">
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->kode->ViewAttributes() ?>><?php echo $asset_category->kode->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_category->coa->Visible) { // coa ?>
		<td<?php echo $asset_category->coa->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coa" name="x<?php echo $asset_category_list->lRowIndex ?>_coa"<?php echo $asset_category->coa->EditAttributes() ?>>
<?php
if (is_array($asset_category->coa->EditValue)) {
	$arwrk = $asset_category->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->coa->ViewAttributes() ?>><?php echo $asset_category->coa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_category->category->Visible) { // category ?>
		<td<?php echo $asset_category->category->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_category_list->lRowIndex ?>_category" id="x<?php echo $asset_category_list->lRowIndex ?>_category" size="30" maxlength="200" value="<?php echo $asset_category->category->EditValue ?>"<?php echo $asset_category->category->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->category->ViewAttributes() ?>><?php echo $asset_category->category->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_category->penyusutan->Visible) { // penyusutan ?>
		<td<?php echo $asset_category->penyusutan->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_category_list->lRowIndex ?>_penyusutan" id="x<?php echo $asset_category_list->lRowIndex ?>_penyusutan" size="3" value="<?php echo $asset_category->penyusutan->EditValue ?>"<?php echo $asset_category->penyusutan->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->penyusutan->ViewAttributes() ?>><?php echo $asset_category->penyusutan->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_category->coabiaya->Visible) { // coabiaya ?>
		<td<?php echo $asset_category->coabiaya->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coabiaya" name="x<?php echo $asset_category_list->lRowIndex ?>_coabiaya"<?php echo $asset_category->coabiaya->EditAttributes() ?>>
<?php
if (is_array($asset_category->coabiaya->EditValue)) {
	$arwrk = $asset_category->coabiaya->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coabiaya->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->coabiaya->ViewAttributes() ?>><?php echo $asset_category->coabiaya->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_category->coaakum->Visible) { // coaakum ?>
		<td<?php echo $asset_category->coaakum->CellAttributes() ?>>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $asset_category_list->lRowIndex ?>_coaakum" name="x<?php echo $asset_category_list->lRowIndex ?>_coaakum"<?php echo $asset_category->coaakum->EditAttributes() ?>>
<?php
if (is_array($asset_category->coaakum->EditValue)) {
	$arwrk = $asset_category->coaakum->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_category->coaakum->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_category->coaakum->ViewAttributes() ?>><?php echo $asset_category->coaakum->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($asset_category->RowType == EW_ROWTYPE_ADD || $asset_category->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($asset_category->CurrentAction == "edit") { ?>
<td colspan="<?php echo $asset_category_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (asset_category_list.ValidateForm(document.fasset_categorylist)) document.fasset_categorylist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $asset_category_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($asset_category->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $asset_category->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($asset_category_list->lOptionCnt == 0 && $asset_category->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $asset_category->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="asset_detaillist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=asset_category&kode=<?php echo urlencode(strval($asset_category->kode->CurrentValue)) ?>"><?php echo str_ireplace(array ('<b>','</b>','<h3>','</h3>'),"","<h3><b>Asset Detail</b></h3>..."); ?></a>
</span></td>
<?php

// Custom list options
foreach ($asset_category_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($asset_category->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($asset_category->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($asset_category->CurrentAction == "add" || $asset_category->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $asset_category_list->lRowIndex ?>">
<?php } ?>
<?php if ($asset_category->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $asset_category_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($asset_category->Export == "" && $asset_category->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(asset_category_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($asset_category->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$asset_category_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class casset_category_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'asset_category';

	// Page Object Name
	var $PageObjName = 'asset_category_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $asset_category;
		if ($asset_category->UseTokenInUrl) $PageUrl .= "t=" . $asset_category->TableVar . "&"; // add page token
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
		global $objForm, $asset_category;
		if ($asset_category->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($asset_category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($asset_category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function casset_category_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["asset_category"] = new casset_category();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'asset_category', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $asset_category;
	$asset_category->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $asset_category->Export; // Get export parameter, used in header
	$gsExportFile = $asset_category->TableVar; // Get export file, used in header
	if ($asset_category->Export == "print" || $asset_category->Export == "html") {

		// Printer friendly or Export to HTML, no action required
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
		global $objForm, $gsSearchError, $Security, $asset_category;
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

		// Create form object
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$asset_category->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($asset_category->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($asset_category->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($asset_category->CurrentAction == "add" || $asset_category->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$asset_category->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($asset_category->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($asset_category->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($asset_category->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $asset_category->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$asset_category->setSessionWhere($sFilter);
		$asset_category->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $asset_category;
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
			$asset_category->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$asset_category->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $asset_category;
		$asset_category->setKey("kode", ""); // Clear inline edit key
		$asset_category->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $asset_category;
		$bInlineEdit = TRUE;
		if (@$_GET["kode"] <> "") {
			$asset_category->kode->setQueryStringValue($_GET["kode"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$asset_category->setKey("kode", $asset_category->kode->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $asset_category;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate Form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$asset_category->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage("Update succeeded"); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$asset_category->EventCancelled = TRUE; // Cancel event
			$asset_category->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $asset_category;

		//CheckInlineEditKey = True
		if (strval($asset_category->getKey("kode")) <> strval($asset_category->kode->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $asset_category;
		$asset_category->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $asset_category;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$asset_category->EventCancelled = TRUE; // Set event cancelled
			$asset_category->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$asset_category->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$asset_category->EventCancelled = TRUE; // Set event cancelled
			$asset_category->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $asset_category;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$asset_category->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$asset_category->CurrentOrderType = @$_GET["ordertype"];
			$asset_category->UpdateSort($asset_category->kode); // Field 
			$asset_category->UpdateSort($asset_category->coa); // Field 
			$asset_category->UpdateSort($asset_category->category); // Field 
			$asset_category->UpdateSort($asset_category->penyusutan); // Field 
			$asset_category->UpdateSort($asset_category->coabiaya); // Field 
			$asset_category->UpdateSort($asset_category->coaakum); // Field 
			$asset_category->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $asset_category;
		$sOrderBy = $asset_category->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($asset_category->SqlOrderBy() <> "") {
				$sOrderBy = $asset_category->SqlOrderBy();
				$asset_category->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $asset_category;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$asset_category->setSessionOrderBy($sOrderBy);
				$asset_category->kode->setSort("");
				$asset_category->coa->setSort("");
				$asset_category->category->setSort("");
				$asset_category->penyusutan->setSort("");
				$asset_category->coabiaya->setSort("");
				$asset_category->coaakum->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$asset_category->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $asset_category;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$asset_category->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$asset_category->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $asset_category->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$asset_category->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$asset_category->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$asset_category->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $asset_category;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $asset_category;
		$asset_category->kode->setFormValue($objForm->GetValue("x_kode"));
		$asset_category->coa->setFormValue($objForm->GetValue("x_coa"));
		$asset_category->category->setFormValue($objForm->GetValue("x_category"));
		$asset_category->penyusutan->setFormValue($objForm->GetValue("x_penyusutan"));
		$asset_category->coabiaya->setFormValue($objForm->GetValue("x_coabiaya"));
		$asset_category->coaakum->setFormValue($objForm->GetValue("x_coaakum"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $asset_category;
		$asset_category->kode->CurrentValue = $asset_category->kode->FormValue;
		$asset_category->coa->CurrentValue = $asset_category->coa->FormValue;
		$asset_category->category->CurrentValue = $asset_category->category->FormValue;
		$asset_category->penyusutan->CurrentValue = $asset_category->penyusutan->FormValue;
		$asset_category->coabiaya->CurrentValue = $asset_category->coabiaya->FormValue;
		$asset_category->coaakum->CurrentValue = $asset_category->coaakum->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $asset_category;

		// Call Recordset Selecting event
		$asset_category->Recordset_Selecting($asset_category->CurrentFilter);

		// Load list page SQL
		$sSql = $asset_category->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$asset_category->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $asset_category;
		$sFilter = $asset_category->KeyFilter();

		// Call Row Selecting event
		$asset_category->Row_Selecting($sFilter);

		// Load sql based on filter
		$asset_category->CurrentFilter = $sFilter;
		$sSql = $asset_category->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$asset_category->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $asset_category;
		$asset_category->kode->setDbValue($rs->fields('kode'));
		$asset_category->coa->setDbValue($rs->fields('coa'));
		$asset_category->category->setDbValue($rs->fields('category'));
		$asset_category->penyusutan->setDbValue($rs->fields('penyusutan'));
		$asset_category->coabiaya->setDbValue($rs->fields('coabiaya'));
		$asset_category->coaakum->setDbValue($rs->fields('coaakum'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $asset_category;

		// Call Row_Rendering event
		$asset_category->Row_Rendering();

		// Common render codes for all row types
		// kode

		$asset_category->kode->CellCssStyle = "white-space: nowrap;";
		$asset_category->kode->CellCssClass = "";

		// coa
		$asset_category->coa->CellCssStyle = "white-space: nowrap;";
		$asset_category->coa->CellCssClass = "";

		// category
		$asset_category->category->CellCssStyle = "white-space: nowrap;";
		$asset_category->category->CellCssClass = "";

		// penyusutan
		$asset_category->penyusutan->CellCssStyle = "white-space: nowrap;";
		$asset_category->penyusutan->CellCssClass = "";

		// coabiaya
		$asset_category->coabiaya->CellCssStyle = "white-space: nowrap;";
		$asset_category->coabiaya->CellCssClass = "";

		// coaakum
		$asset_category->coaakum->CellCssStyle = "white-space: nowrap;";
		$asset_category->coaakum->CellCssClass = "";
		if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$asset_category->kode->ViewValue = $asset_category->kode->CurrentValue;
			$asset_category->kode->CssStyle = "";
			$asset_category->kode->CssClass = "";
			$asset_category->kode->ViewCustomAttributes = "";

			// coa
			if (strval($asset_category->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coa->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coa->ViewValue = $rswrk->fields('coa');
					$asset_category->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coa->ViewValue = $asset_category->coa->CurrentValue;
				}
			} else {
				$asset_category->coa->ViewValue = NULL;
			}
			$asset_category->coa->CssStyle = "";
			$asset_category->coa->CssClass = "";
			$asset_category->coa->ViewCustomAttributes = "";

			// category
			$asset_category->category->ViewValue = $asset_category->category->CurrentValue;
			$asset_category->category->CssStyle = "";
			$asset_category->category->CssClass = "";
			$asset_category->category->ViewCustomAttributes = "nowrap";

			// penyusutan
			$asset_category->penyusutan->ViewValue = $asset_category->penyusutan->CurrentValue;
			$asset_category->penyusutan->CssStyle = "text-align:right;";
			$asset_category->penyusutan->CssClass = "";
			$asset_category->penyusutan->ViewCustomAttributes = "";

			// coabiaya
			if (strval($asset_category->coabiaya->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coabiaya->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coabiaya->ViewValue = $rswrk->fields('coa');
					$asset_category->coabiaya->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coabiaya->ViewValue = $asset_category->coabiaya->CurrentValue;
				}
			} else {
				$asset_category->coabiaya->ViewValue = NULL;
			}
			$asset_category->coabiaya->CssStyle = "";
			$asset_category->coabiaya->CssClass = "";
			$asset_category->coabiaya->ViewCustomAttributes = "";

			// coaakum
			if (strval($asset_category->coaakum->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coaakum->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coaakum->ViewValue = $rswrk->fields('coa');
					$asset_category->coaakum->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coaakum->ViewValue = $asset_category->coaakum->CurrentValue;
				}
			} else {
				$asset_category->coaakum->ViewValue = NULL;
			}
			$asset_category->coaakum->CssStyle = "";
			$asset_category->coaakum->CssClass = "";
			$asset_category->coaakum->ViewCustomAttributes = "";

			// kode
			$asset_category->kode->HrefValue = "";

			// coa
			$asset_category->coa->HrefValue = "";

			// category
			$asset_category->category->HrefValue = "";

			// penyusutan
			$asset_category->penyusutan->HrefValue = "";

			// coabiaya
			$asset_category->coabiaya->HrefValue = "";

			// coaakum
			$asset_category->coaakum->HrefValue = "";
		} elseif ($asset_category->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			// coa

			$asset_category->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coa->EditValue = $arwrk;

			// category
			$asset_category->category->EditCustomAttributes = "nowrap";
			$asset_category->category->EditValue = ew_HtmlEncode($asset_category->category->CurrentValue);

			// penyusutan
			$asset_category->penyusutan->EditCustomAttributes = "";
			$asset_category->penyusutan->EditValue = ew_HtmlEncode($asset_category->penyusutan->CurrentValue);

			// coabiaya
			$asset_category->coabiaya->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coabiaya->EditValue = $arwrk;

			// coaakum
			$asset_category->coaakum->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coaakum->EditValue = $arwrk;
		} elseif ($asset_category->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$asset_category->kode->EditCustomAttributes = "";
			$asset_category->kode->EditValue = $asset_category->kode->CurrentValue;
			$asset_category->kode->CssStyle = "";
			$asset_category->kode->CssClass = "";
			$asset_category->kode->ViewCustomAttributes = "";

			// coa
			$asset_category->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coa->EditValue = $arwrk;

			// category
			$asset_category->category->EditCustomAttributes = "nowrap";
			$asset_category->category->EditValue = ew_HtmlEncode($asset_category->category->CurrentValue);

			// penyusutan
			$asset_category->penyusutan->EditCustomAttributes = "";
			$asset_category->penyusutan->EditValue = ew_HtmlEncode($asset_category->penyusutan->CurrentValue);

			// coabiaya
			$asset_category->coabiaya->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coabiaya->EditValue = $arwrk;

			// coaakum
			$asset_category->coaakum->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$asset_category->coaakum->EditValue = $arwrk;

			// Edit refer script
			// kode

			$asset_category->kode->HrefValue = "";

			// coa
			$asset_category->coa->HrefValue = "";

			// category
			$asset_category->category->HrefValue = "";

			// penyusutan
			$asset_category->penyusutan->HrefValue = "";

			// coabiaya
			$asset_category->coabiaya->HrefValue = "";

			// coaakum
			$asset_category->coaakum->HrefValue = "";
		}

		// Call Row Rendered event
		$asset_category->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $asset_category;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($asset_category->coa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Coa";
		}
		if ($asset_category->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Category";
		}
		if ($asset_category->penyusutan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Penyusutan (%)";
		}
		if (!ew_CheckNumber($asset_category->penyusutan->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Penyusutan (%)";
		}
		if ($asset_category->coabiaya->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - COA Biaya Penyusutan";
		}
		if ($asset_category->coaakum->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - COA Akum.Penyusutan";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $asset_category;
		$sFilter = $asset_category->KeyFilter();
		$asset_category->CurrentFilter = $sFilter;
		$sSql = $asset_category->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field kode
			// Field coa

			$asset_category->coa->SetDbValueDef($asset_category->coa->CurrentValue, "");
			$rsnew['coa'] =& $asset_category->coa->DbValue;

			// Field category
			$asset_category->category->SetDbValueDef($asset_category->category->CurrentValue, "");
			$rsnew['category'] =& $asset_category->category->DbValue;

			// Field penyusutan
			$asset_category->penyusutan->SetDbValueDef($asset_category->penyusutan->CurrentValue, 0);
			$rsnew['penyusutan'] =& $asset_category->penyusutan->DbValue;

			// Field coabiaya
			$asset_category->coabiaya->SetDbValueDef($asset_category->coabiaya->CurrentValue, "");
			$rsnew['coabiaya'] =& $asset_category->coabiaya->DbValue;

			// Field coaakum
			$asset_category->coaakum->SetDbValueDef($asset_category->coaakum->CurrentValue, "");
			$rsnew['coaakum'] =& $asset_category->coaakum->DbValue;

			// Call Row Updating event
			$bUpdateRow = $asset_category->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($asset_category->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($asset_category->CancelMessage <> "") {
					$this->setMessage($asset_category->CancelMessage);
					$asset_category->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$asset_category->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $asset_category;
		$rsnew = array();

		// Field kode
		// Field coa

		$asset_category->coa->SetDbValueDef($asset_category->coa->CurrentValue, "");
		$rsnew['coa'] =& $asset_category->coa->DbValue;

		// Field category
		$asset_category->category->SetDbValueDef($asset_category->category->CurrentValue, "");
		$rsnew['category'] =& $asset_category->category->DbValue;

		// Field penyusutan
		$asset_category->penyusutan->SetDbValueDef($asset_category->penyusutan->CurrentValue, 0);
		$rsnew['penyusutan'] =& $asset_category->penyusutan->DbValue;

		// Field coabiaya
		$asset_category->coabiaya->SetDbValueDef($asset_category->coabiaya->CurrentValue, "");
		$rsnew['coabiaya'] =& $asset_category->coabiaya->DbValue;

		// Field coaakum
		$asset_category->coaakum->SetDbValueDef($asset_category->coaakum->CurrentValue, "");
		$rsnew['coaakum'] =& $asset_category->coaakum->DbValue;

		// Call Row Inserting event
		$bInsertRow = $asset_category->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($asset_category->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($asset_category->CancelMessage <> "") {
				$this->setMessage($asset_category->CancelMessage);
				$asset_category->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$asset_category->kode->setDbValue($conn->Insert_ID());
			$rsnew['kode'] =& $asset_category->kode->DbValue;

			// Call Row Inserted event
			$asset_category->Row_Inserted($rsnew);
		}
		return $AddRow;
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
