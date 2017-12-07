<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_foodinfo.php" ?>
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
$mst_food_list = new cmst_food_list();
$Page =& $mst_food_list;

// Page init processing
$mst_food_list->Page_Init();

// Page main processing
$mst_food_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_food->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_food_list = new ew_Page("mst_food_list");

// page properties
mst_food_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_food_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_food_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_kode"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Kode");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");
		elm = fobj.elements["x" + infix + "_price"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Price");
		elm = fobj.elements["x" + infix + "_price"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Price");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_food_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_food_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_food_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_food->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_food->Export == "" && $mst_food->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_food_list->LoadRecordset();
	$mst_food_list->lTotalRecs = ($bSelectLimit) ? $mst_food->SelectRecordCount() : $rs->RecordCount();
	$mst_food_list->lStartRec = 1;
	if ($mst_food_list->lDisplayRecs <= 0) // Display all records
		$mst_food_list->lDisplayRecs = $mst_food_list->lTotalRecs;
	if (!($mst_food->ExportAll && $mst_food->Export <> ""))
		$mst_food_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_food_list->LoadRecordset($mst_food_list->lStartRec-1, $mst_food_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Food</b></h3>
<?php if ($mst_food->Export == "" && $mst_food->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_food_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_food_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_food->Export == "" && $mst_food->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_food_list);" style="text-decoration: none;"><img id="mst_food_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_food_list_SearchPanel">
<form name="fmst_foodlistsrch" id="fmst_foodlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="mst_food">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($mst_food->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!--a href="<?php echo $mst_food_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_food_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($mst_food->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($mst_food->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($mst_food->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_food_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_food->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_food->CurrentAction <> "gridadd" && $mst_food->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_food_list->Pager)) $mst_food_list->Pager = new cPrevNextPager($mst_food_list->lStartRec, $mst_food_list->lDisplayRecs, $mst_food_list->lTotalRecs) ?>
<?php if ($mst_food_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_food_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_food_list->PageUrl() ?>start=<?php echo $mst_food_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_food_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_food_list->PageUrl() ?>start=<?php echo $mst_food_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_food_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_food_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_food_list->PageUrl() ?>start=<?php echo $mst_food_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_food_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_food_list->PageUrl() ?>start=<?php echo $mst_food_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_food_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_food_list->Pager->FromIndex ?> to <?php echo $mst_food_list->Pager->ToIndex ?> of <?php echo $mst_food_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_food_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_food_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_food">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_food_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_food_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_food_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_food_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_food_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_food_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_food_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_foodlist" id="fmst_foodlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_food">
<?php if ($mst_food_list->lTotalRecs > 0 || $mst_food->CurrentAction == "add" || $mst_food->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_food_list->lOptionCnt = 0;
	$mst_food_list->lOptionCnt++; // edit
	$mst_food_list->lOptionCnt++; // Delete
	$mst_food_list->lOptionCnt += count($mst_food_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_food->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_food->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($mst_food_list->lOptionCnt == 0 && $mst_food->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_food_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_food->kode->Visible) { // kode ?>
	<?php if ($mst_food->SortUrl($mst_food->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_food->SortUrl($mst_food->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode&nbsp;(*)</td><td style="width: 10px;"><?php if ($mst_food->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_food->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_food->description->Visible) { // description ?>
	<?php if ($mst_food->SortUrl($mst_food->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_food->SortUrl($mst_food->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description&nbsp;(*)</td><td style="width: 10px;"><?php if ($mst_food->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_food->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_food->price->Visible) { // price ?>
	<?php if ($mst_food->SortUrl($mst_food->price) == "") { ?>
		<td style="white-space: nowrap;">Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_food->SortUrl($mst_food->price) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Price</td><td style="width: 10px;"><?php if ($mst_food->price->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_food->price->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($mst_food->CurrentAction == "add" || $mst_food->CurrentAction == "copy") {
		$mst_food_list->lRowIndex = 1;
		if ($mst_food->CurrentAction == "add")
			$mst_food_list->LoadDefaultValues();
		if ($mst_food->EventCancelled) // Insert failed
			$mst_food_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$mst_food->CssClass = "ewTableEditRow";
		$mst_food->CssStyle = "";
		$mst_food->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$mst_food->RowType = EW_ROWTYPE_ADD;

		// Render row
		$mst_food_list->RenderRow();
?>
	<tr<?php echo $mst_food->RowAttributes() ?>>
<td colspan="<?php echo $mst_food_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_food_list.ValidateForm(document.fmst_foodlist)) document.fmst_foodlist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_food_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($mst_food->kode->Visible) { // kode ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_food_list->lRowIndex ?>_kode" id="x<?php echo $mst_food_list->lRowIndex ?>_kode" size="5" maxlength="5" value="<?php echo $mst_food->kode->EditValue ?>"<?php echo $mst_food->kode->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_food->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_food_list->lRowIndex ?>_description" id="x<?php echo $mst_food_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_food->description->EditValue ?>"<?php echo $mst_food->description->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_food->price->Visible) { // price ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_food_list->lRowIndex ?>_price" id="x<?php echo $mst_food_list->lRowIndex ?>_price" size="30" value="<?php echo $mst_food->price->EditValue ?>"<?php echo $mst_food->price->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($mst_food->ExportAll && $mst_food->Export <> "") {
	$mst_food_list->lStopRec = $mst_food_list->lTotalRecs;
} else {
	$mst_food_list->lStopRec = $mst_food_list->lStartRec + $mst_food_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_food_list->lRecCount = $mst_food_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_food->SelectLimit && $mst_food_list->lStartRec > 1)
		$rs->Move($mst_food_list->lStartRec - 1);
}
$mst_food_list->lRowCnt = 0;
$mst_food_list->lEditRowCnt = 0;
if ($mst_food->CurrentAction == "edit")
	$mst_food_list->lRowIndex = 1;
while (($mst_food->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_food_list->lRecCount < $mst_food_list->lStopRec) {
	$mst_food_list->lRecCount++;
	if (intval($mst_food_list->lRecCount) >= intval($mst_food_list->lStartRec)) {
		$mst_food_list->lRowCnt++;

	// Init row class and style
	$mst_food->CssClass = "";
	$mst_food->CssStyle = "";
	$mst_food->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_food->CurrentAction == "gridadd") {
		$mst_food_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_food_list->LoadRowValues($rs); // Load row values
	}
	$mst_food->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_food->CurrentAction == "edit") {
		if ($mst_food_list->CheckInlineEditKey() && $mst_food_list->lEditRowCnt == 0) // Inline edit
			$mst_food->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_food->RowType == EW_ROWTYPE_EDIT && $mst_food->EventCancelled) { // Update failed
		if ($mst_food->CurrentAction == "edit")
			$mst_food_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_food->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_food_list->lEditRowCnt++;
		$mst_food->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_food->RowType == EW_ROWTYPE_ADD || $mst_food->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_food->CssClass = "ewTableEditRow";

	// Render row
	$mst_food_list->RenderRow();
?>
	<tr<?php echo $mst_food->RowAttributes() ?>>
<?php if ($mst_food->RowType == EW_ROWTYPE_ADD || $mst_food->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_food->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_food_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_food_list.ValidateForm(document.fmst_foodlist)) document.fmst_foodlist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_food_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_food->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_food->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($mst_food_list->lOptionCnt == 0 && $mst_food->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_food->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
| <a href="food_analisaadd.php?kodefood=<?php echo $mst_food->kode->ListViewValue() ?>">Analisa Harga</a>
</span></td>
<?php

// Custom list options
foreach ($mst_food_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_food->kode->Visible) { // kode ?>
		<td<?php echo $mst_food->kode->CellAttributes() ?>>
<?php if ($mst_food->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_food->kode->ViewAttributes() ?>><?php echo $mst_food->kode->EditValue ?></div><input type="hidden" name="x<?php echo $mst_food_list->lRowIndex ?>_kode" id="x<?php echo $mst_food_list->lRowIndex ?>_kode" value="<?php echo ew_HtmlEncode($mst_food->kode->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_food->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_food->kode->ViewAttributes() ?>><?php echo $mst_food->kode->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_food->description->Visible) { // description ?>
		<td<?php echo $mst_food->description->CellAttributes() ?>>
<?php if ($mst_food->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_food_list->lRowIndex ?>_description" id="x<?php echo $mst_food_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_food->description->EditValue ?>"<?php echo $mst_food->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_food->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_food->description->ViewAttributes() ?>><?php echo $mst_food->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_food->price->Visible) { // price ?>
		<td<?php echo $mst_food->price->CellAttributes() ?>>
<?php if ($mst_food->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_food_list->lRowIndex ?>_price" id="x<?php echo $mst_food_list->lRowIndex ?>_price" size="30" value="<?php echo $mst_food->price->EditValue ?>"<?php echo $mst_food->price->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_food->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_food->price->ViewAttributes() ?>><?php echo $mst_food->price->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_food->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_food->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_food->CurrentAction == "add" || $mst_food->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_food_list->lRowIndex ?>">
<?php } ?>
<?php if ($mst_food->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_food_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_food->Export == "" && $mst_food->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_food_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_food->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_food_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_food_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_food';

	// Page Object Name
	var $PageObjName = 'mst_food_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_food;
		if ($mst_food->UseTokenInUrl) $PageUrl .= "t=" . $mst_food->TableVar . "&"; // add page token
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
		global $objForm, $mst_food;
		if ($mst_food->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_food->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_food->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_food_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_food"] = new cmst_food();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_food', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_food;
	$mst_food->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_food->Export; // Get export parameter, used in header
	$gsExportFile = $mst_food->TableVar; // Get export file, used in header
	if ($mst_food->Export == "print" || $mst_food->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_food->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_food;
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
				$mst_food->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_food->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_food->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($mst_food->CurrentAction == "add" || $mst_food->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_food->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_food->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($mst_food->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($mst_food->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_food->getRecordsPerPage(); // Restore from Session
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
		$mst_food->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$mst_food->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_food->setStartRecordNumber($this->lStartRec);
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
		$mst_food->setSessionWhere($sFilter);
		$mst_food->CurrentFilter = "";

		// Export data only
		if (in_array($mst_food->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_food;
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
			$mst_food->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_food->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_food;
		$mst_food->setKey("kode", ""); // Clear inline edit key
		$mst_food->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_food;
		$bInlineEdit = TRUE;
		if (@$_GET["kode"] <> "") {
			$mst_food->kode->setQueryStringValue($_GET["kode"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_food->setKey("kode", $mst_food->kode->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_food;
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
				$mst_food->SendEmail = TRUE; // Send email on update success
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
			$mst_food->EventCancelled = TRUE; // Cancel event
			$mst_food->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_food;

		//CheckInlineEditKey = True
		if (strval($mst_food->getKey("kode")) <> strval($mst_food->kode->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $mst_food;
		$mst_food->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $mst_food;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$mst_food->EventCancelled = TRUE; // Set event cancelled
			$mst_food->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$mst_food->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$mst_food->EventCancelled = TRUE; // Set event cancelled
			$mst_food->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $mst_food;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $mst_food->kode->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $mst_food->description->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $mst_food;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$mst_food->setBasicSearchKeyword($sSearchKeyword);
			$mst_food->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $mst_food;
		$this->sSrchWhere = "";
		$mst_food->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $mst_food;
		$mst_food->setBasicSearchKeyword("");
		$mst_food->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_food;
		$this->sSrchWhere = $mst_food->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_food;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_food->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_food->CurrentOrderType = @$_GET["ordertype"];
			$mst_food->UpdateSort($mst_food->kode); // Field 
			$mst_food->UpdateSort($mst_food->description); // Field 
			$mst_food->UpdateSort($mst_food->price); // Field 
			$mst_food->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_food;
		$sOrderBy = $mst_food->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_food->SqlOrderBy() <> "") {
				$sOrderBy = $mst_food->SqlOrderBy();
				$mst_food->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_food;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_food->setSessionOrderBy($sOrderBy);
				$mst_food->kode->setSort("");
				$mst_food->description->setSort("");
				$mst_food->price->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_food->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_food;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_food->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_food->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_food->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_food->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_food->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_food->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_food;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_food;
		$mst_food->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_food->description->setFormValue($objForm->GetValue("x_description"));
		$mst_food->price->setFormValue($objForm->GetValue("x_price"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_food;
		$mst_food->kode->CurrentValue = $mst_food->kode->FormValue;
		$mst_food->description->CurrentValue = $mst_food->description->FormValue;
		$mst_food->price->CurrentValue = $mst_food->price->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_food;

		// Call Recordset Selecting event
		$mst_food->Recordset_Selecting($mst_food->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_food->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_food->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_food;
		$sFilter = $mst_food->KeyFilter();

		// Call Row Selecting event
		$mst_food->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_food->CurrentFilter = $sFilter;
		$sSql = $mst_food->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_food->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_food;
		$mst_food->kode->setDbValue($rs->fields('kode'));
		$mst_food->description->setDbValue($rs->fields('description'));
		$mst_food->price->setDbValue($rs->fields('price'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_food;

		// Call Row_Rendering event
		$mst_food->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_food->kode->CellCssStyle = "white-space: nowrap;";
		$mst_food->kode->CellCssClass = "";

		// description
		$mst_food->description->CellCssStyle = "white-space: nowrap;";
		$mst_food->description->CellCssClass = "";

		// price
		$mst_food->price->CellCssStyle = "white-space: nowrap;";
		$mst_food->price->CellCssClass = "";
		if ($mst_food->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_food->kode->ViewValue = $mst_food->kode->CurrentValue;
			$mst_food->kode->CssStyle = "";
			$mst_food->kode->CssClass = "";
			$mst_food->kode->ViewCustomAttributes = "";

			// description
			$mst_food->description->ViewValue = $mst_food->description->CurrentValue;
			$mst_food->description->CssStyle = "";
			$mst_food->description->CssClass = "";
			$mst_food->description->ViewCustomAttributes = "";

			// price
			$mst_food->price->ViewValue = $mst_food->price->CurrentValue;
			$mst_food->price->ViewValue = ew_FormatNumber($mst_food->price->ViewValue, 0, -2, -2, -2);
			$mst_food->price->CssStyle = "text-align:right;";
			$mst_food->price->CssClass = "";
			$mst_food->price->ViewCustomAttributes = "";

			// kode
			$mst_food->kode->HrefValue = "";

			// description
			$mst_food->description->HrefValue = "";

			// price
			$mst_food->price->HrefValue = "";
		} elseif ($mst_food->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			$mst_food->kode->EditCustomAttributes = "";
			$mst_food->kode->EditValue = ew_HtmlEncode($mst_food->kode->CurrentValue);

			// description
			$mst_food->description->EditCustomAttributes = "";
			$mst_food->description->EditValue = ew_HtmlEncode($mst_food->description->CurrentValue);

			// price
			$mst_food->price->EditCustomAttributes = "";
			$mst_food->price->EditValue = ew_HtmlEncode($mst_food->price->CurrentValue);
		} elseif ($mst_food->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_food->kode->EditCustomAttributes = "";
			$mst_food->kode->EditValue = $mst_food->kode->CurrentValue;
			$mst_food->kode->CssStyle = "";
			$mst_food->kode->CssClass = "";
			$mst_food->kode->ViewCustomAttributes = "";

			// description
			$mst_food->description->EditCustomAttributes = "";
			$mst_food->description->EditValue = ew_HtmlEncode($mst_food->description->CurrentValue);

			// price
			$mst_food->price->EditCustomAttributes = "";
			$mst_food->price->EditValue = ew_HtmlEncode($mst_food->price->CurrentValue);

			// Edit refer script
			// kode

			$mst_food->kode->HrefValue = "";

			// description
			$mst_food->description->HrefValue = "";

			// price
			$mst_food->price->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_food->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_food;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_food->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if ($mst_food->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
		}
		if ($mst_food->price->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Price";
		}
		if (!ew_CheckNumber($mst_food->price->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Price";
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
		global $conn, $Security, $mst_food;
		$sFilter = $mst_food->KeyFilter();
		$mst_food->CurrentFilter = $sFilter;
		$sSql = $mst_food->SQL();
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
			// Field description

			$mst_food->description->SetDbValueDef($mst_food->description->CurrentValue, "");
			$rsnew['description'] =& $mst_food->description->DbValue;

			// Field price
			$mst_food->price->SetDbValueDef($mst_food->price->CurrentValue, 0);
			$rsnew['price'] =& $mst_food->price->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_food->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_food->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_food->CancelMessage <> "") {
					$this->setMessage($mst_food->CancelMessage);
					$mst_food->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_food->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_food;

		// Check if key value entered
		if ($mst_food->kode->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $mst_food->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $mst_food->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field kode
		$mst_food->kode->SetDbValueDef($mst_food->kode->CurrentValue, "");
		$rsnew['kode'] =& $mst_food->kode->DbValue;

		// Field description
		$mst_food->description->SetDbValueDef($mst_food->description->CurrentValue, "");
		$rsnew['description'] =& $mst_food->description->DbValue;

		// Field price
		$mst_food->price->SetDbValueDef($mst_food->price->CurrentValue, 0);
		$rsnew['price'] =& $mst_food->price->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_food->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_food->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_food->CancelMessage <> "") {
				$this->setMessage($mst_food->CancelMessage);
				$mst_food->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$mst_food->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_food;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_food->ExportAll) {
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
		if ($mst_food->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_food->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_food->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $mst_food->Export);
				ew_ExportAddValue($sExportStr, 'description', $mst_food->Export);
				ew_ExportAddValue($sExportStr, 'price', $mst_food->Export);
				echo ew_ExportLine($sExportStr, $mst_food->Export);
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
				$mst_food->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_food->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $mst_food->kode->CurrentValue);
					$XmlDoc->AddField('description', $mst_food->description->CurrentValue);
					$XmlDoc->AddField('price', $mst_food->price->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_food->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $mst_food->kode->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
						echo ew_ExportField('description', $mst_food->description->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
						echo ew_ExportField('price', $mst_food->price->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_food->kode->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
						ew_ExportAddValue($sExportStr, $mst_food->description->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
						ew_ExportAddValue($sExportStr, $mst_food->price->ExportValue($mst_food->Export, $mst_food->ExportOriginalValue), $mst_food->Export);
						echo ew_ExportLine($sExportStr, $mst_food->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_food->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_food->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_food';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $mst_food;
		$table = 'mst_food';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "A";
		$oldvalue = "";
		foreach (array_keys($rs) as $fldname) {
			if ($mst_food->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$newvalue = ($mst_food->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
				ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $mst_food;
		$table = 'mst_food';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "U";
		foreach (array_keys($rsnew) as $fldname) {
			if ($mst_food->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_food->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_food->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
