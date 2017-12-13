<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_additionalinfo.php" ?>
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
$mst_additional_list = new cmst_additional_list();
$Page =& $mst_additional_list;

// Page init processing
$mst_additional_list->Page_Init();

// Page main processing
$mst_additional_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_additional->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_additional_list = new ew_Page("mst_additional_list");

// page properties
mst_additional_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_additional_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_additional_list.ValidateForm = function(fobj) {
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

// extend page with validate function for search
mst_additional_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";

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
mst_additional_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_additional_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_additional_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_additional->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_additional->Export == "" && $mst_additional->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_additional_list->LoadRecordset();
	$mst_additional_list->lTotalRecs = ($bSelectLimit) ? $mst_additional->SelectRecordCount() : $rs->RecordCount();
	$mst_additional_list->lStartRec = 1;
	if ($mst_additional_list->lDisplayRecs <= 0) // Display all records
		$mst_additional_list->lDisplayRecs = $mst_additional_list->lTotalRecs;
	if (!($mst_additional->ExportAll && $mst_additional->Export <> ""))
		$mst_additional_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_additional_list->LoadRecordset($mst_additional_list->lStartRec-1, $mst_additional_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Miscellaneous</b></h3>
<?php if ($mst_additional->Export == "" && $mst_additional->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_additional_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_additional_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_additional->Export == "" && $mst_additional->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_additional_list);" style="text-decoration: none;"><img id="mst_additional_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_additional_list_SearchPanel">
<form name="fmst_additionallistsrch" id="fmst_additionallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_additional_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_additional">
<?php
if ($gsSearchError == "")
	$mst_additional_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_additional->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_additional_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="5" maxlength="5" value="<?php echo $mst_additional->kode->EditValue ?>"<?php echo $mst_additional->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Description</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_description" id="z_description" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_description" id="x_description" size="100" maxlength="255" value="<?php echo $mst_additional->description->EditValue ?>"<?php echo $mst_additional->description->EditAttributes() ?>>
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
			<!--a href="<?php echo $mst_additional_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_additional_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_additional_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_additional->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_additional->CurrentAction <> "gridadd" && $mst_additional->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_additional_list->Pager)) $mst_additional_list->Pager = new cPrevNextPager($mst_additional_list->lStartRec, $mst_additional_list->lDisplayRecs, $mst_additional_list->lTotalRecs) ?>
<?php if ($mst_additional_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_additional_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_additional_list->PageUrl() ?>start=<?php echo $mst_additional_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_additional_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_additional_list->PageUrl() ?>start=<?php echo $mst_additional_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_additional_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_additional_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_additional_list->PageUrl() ?>start=<?php echo $mst_additional_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_additional_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_additional_list->PageUrl() ?>start=<?php echo $mst_additional_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_additional_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_additional_list->Pager->FromIndex ?> to <?php echo $mst_additional_list->Pager->ToIndex ?> of <?php echo $mst_additional_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_additional_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_additional_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_additional">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_additional_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_additional_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_additional_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_additional_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_additional_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_additional_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_additional_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_additionallist" id="fmst_additionallist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_additional">
<?php if ($mst_additional_list->lTotalRecs > 0 || $mst_additional->CurrentAction == "add" || $mst_additional->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_additional_list->lOptionCnt = 0;
	$mst_additional_list->lOptionCnt++; // edit
	$mst_additional_list->lOptionCnt++; // Delete
	$mst_additional_list->lOptionCnt += count($mst_additional_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_additional->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_additional->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($mst_additional_list->lOptionCnt == 0 && $mst_additional->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_additional_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_additional->kode->Visible) { // kode ?>
	<?php if ($mst_additional->SortUrl($mst_additional->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_additional->SortUrl($mst_additional->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_additional->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_additional->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_additional->description->Visible) { // description ?>
	<?php if ($mst_additional->SortUrl($mst_additional->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_additional->SortUrl($mst_additional->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_additional->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_additional->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_additional->price->Visible) { // price ?>
	<?php if ($mst_additional->SortUrl($mst_additional->price) == "") { ?>
		<td style="white-space: nowrap;">Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_additional->SortUrl($mst_additional->price) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Price</td><td style="width: 10px;"><?php if ($mst_additional->price->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_additional->price->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($mst_additional->CurrentAction == "add" || $mst_additional->CurrentAction == "copy") {
		$mst_additional_list->lRowIndex = 1;
		if ($mst_additional->CurrentAction == "add")
			$mst_additional_list->LoadDefaultValues();
		if ($mst_additional->EventCancelled) // Insert failed
			$mst_additional_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$mst_additional->CssClass = "ewTableEditRow";
		$mst_additional->CssStyle = "";
		$mst_additional->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$mst_additional->RowType = EW_ROWTYPE_ADD;

		// Render row
		$mst_additional_list->RenderRow();
?>
	<tr<?php echo $mst_additional->RowAttributes() ?>>
<td colspan="<?php echo $mst_additional_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_additional_list.ValidateForm(document.fmst_additionallist)) document.fmst_additionallist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_additional_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($mst_additional->kode->Visible) { // kode ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_additional_list->lRowIndex ?>_kode" id="x<?php echo $mst_additional_list->lRowIndex ?>_kode" size="5" maxlength="5" value="<?php echo $mst_additional->kode->EditValue ?>"<?php echo $mst_additional->kode->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_additional->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_additional_list->lRowIndex ?>_description" id="x<?php echo $mst_additional_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_additional->description->EditValue ?>"<?php echo $mst_additional->description->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_additional->price->Visible) { // price ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_additional_list->lRowIndex ?>_price" id="x<?php echo $mst_additional_list->lRowIndex ?>_price" size="30" value="<?php echo $mst_additional->price->EditValue ?>"<?php echo $mst_additional->price->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($mst_additional->ExportAll && $mst_additional->Export <> "") {
	$mst_additional_list->lStopRec = $mst_additional_list->lTotalRecs;
} else {
	$mst_additional_list->lStopRec = $mst_additional_list->lStartRec + $mst_additional_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_additional_list->lRecCount = $mst_additional_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_additional->SelectLimit && $mst_additional_list->lStartRec > 1)
		$rs->Move($mst_additional_list->lStartRec - 1);
}
$mst_additional_list->lRowCnt = 0;
$mst_additional_list->lEditRowCnt = 0;
if ($mst_additional->CurrentAction == "edit")
	$mst_additional_list->lRowIndex = 1;
while (($mst_additional->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_additional_list->lRecCount < $mst_additional_list->lStopRec) {
	$mst_additional_list->lRecCount++;
	if (intval($mst_additional_list->lRecCount) >= intval($mst_additional_list->lStartRec)) {
		$mst_additional_list->lRowCnt++;

	// Init row class and style
	$mst_additional->CssClass = "";
	$mst_additional->CssStyle = "";
	$mst_additional->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_additional->CurrentAction == "gridadd") {
		$mst_additional_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_additional_list->LoadRowValues($rs); // Load row values
	}
	$mst_additional->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_additional->CurrentAction == "edit") {
		if ($mst_additional_list->CheckInlineEditKey() && $mst_additional_list->lEditRowCnt == 0) // Inline edit
			$mst_additional->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_additional->RowType == EW_ROWTYPE_EDIT && $mst_additional->EventCancelled) { // Update failed
		if ($mst_additional->CurrentAction == "edit")
			$mst_additional_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_additional->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_additional_list->lEditRowCnt++;
		$mst_additional->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_additional->RowType == EW_ROWTYPE_ADD || $mst_additional->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_additional->CssClass = "ewTableEditRow";

	// Render row
	$mst_additional_list->RenderRow();
?>
	<tr<?php echo $mst_additional->RowAttributes() ?>>
<?php if ($mst_additional->RowType == EW_ROWTYPE_ADD || $mst_additional->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_additional->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_additional_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_additional_list.ValidateForm(document.fmst_additionallist)) document.fmst_additionallist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_additional_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_additional->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_additional->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($mst_additional_list->lOptionCnt == 0 && $mst_additional->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_additional->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_additional_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_additional->kode->Visible) { // kode ?>
		<td<?php echo $mst_additional->kode->CellAttributes() ?>>
<?php if ($mst_additional->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_additional->kode->ViewAttributes() ?>><?php echo $mst_additional->kode->EditValue ?></div><input type="hidden" name="x<?php echo $mst_additional_list->lRowIndex ?>_kode" id="x<?php echo $mst_additional_list->lRowIndex ?>_kode" value="<?php echo ew_HtmlEncode($mst_additional->kode->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_additional->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_additional->kode->ViewAttributes() ?>><?php echo $mst_additional->kode->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_additional->description->Visible) { // description ?>
		<td<?php echo $mst_additional->description->CellAttributes() ?>>
<?php if ($mst_additional->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_additional_list->lRowIndex ?>_description" id="x<?php echo $mst_additional_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_additional->description->EditValue ?>"<?php echo $mst_additional->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_additional->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_additional->description->ViewAttributes() ?>><?php echo $mst_additional->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_additional->price->Visible) { // price ?>
		<td<?php echo $mst_additional->price->CellAttributes() ?>>
<?php if ($mst_additional->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_additional_list->lRowIndex ?>_price" id="x<?php echo $mst_additional_list->lRowIndex ?>_price" size="30" value="<?php echo $mst_additional->price->EditValue ?>"<?php echo $mst_additional->price->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_additional->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_additional->price->ViewAttributes() ?>><?php echo $mst_additional->price->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_additional->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_additional->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_additional->CurrentAction == "add" || $mst_additional->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_additional_list->lRowIndex ?>">
<?php } ?>
<?php if ($mst_additional->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_additional_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_additional->Export == "" && $mst_additional->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_additional_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_additional->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_additional_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_additional_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_additional';

	// Page Object Name
	var $PageObjName = 'mst_additional_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_additional;
		if ($mst_additional->UseTokenInUrl) $PageUrl .= "t=" . $mst_additional->TableVar . "&"; // add page token
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
		global $objForm, $mst_additional;
		if ($mst_additional->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_additional->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_additional->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_additional_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_additional"] = new cmst_additional();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_additional', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_additional;
	$mst_additional->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_additional->Export; // Get export parameter, used in header
	$gsExportFile = $mst_additional->TableVar; // Get export file, used in header
	if ($mst_additional->Export == "print" || $mst_additional->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_additional->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_additional;
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
				$mst_additional->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_additional->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_additional->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($mst_additional->CurrentAction == "add" || $mst_additional->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_additional->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_additional->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($mst_additional->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

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
		if ($mst_additional->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_additional->getRecordsPerPage(); // Restore from Session
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
		$mst_additional->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_additional->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_additional->setStartRecordNumber($this->lStartRec);
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
		$mst_additional->setSessionWhere($sFilter);
		$mst_additional->CurrentFilter = "";

		// Export data only
		if (in_array($mst_additional->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_additional;
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
			$mst_additional->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_additional;
		$mst_additional->setKey("kode", ""); // Clear inline edit key
		$mst_additional->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_additional;
		$bInlineEdit = TRUE;
		if (@$_GET["kode"] <> "") {
			$mst_additional->kode->setQueryStringValue($_GET["kode"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_additional->setKey("kode", $mst_additional->kode->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_additional;
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
				$mst_additional->SendEmail = TRUE; // Send email on update success
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
			$mst_additional->EventCancelled = TRUE; // Cancel event
			$mst_additional->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_additional;

		//CheckInlineEditKey = True
		if (strval($mst_additional->getKey("kode")) <> strval($mst_additional->kode->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $mst_additional;
		$mst_additional->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $mst_additional;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$mst_additional->EventCancelled = TRUE; // Set event cancelled
			$mst_additional->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$mst_additional->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$mst_additional->EventCancelled = TRUE; // Set event cancelled
			$mst_additional->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_additional;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_additional->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $mst_additional->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $mst_additional->price, FALSE); // Field price

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_additional->kode); // Field kode
			$this->SetSearchParm($mst_additional->description); // Field description
			$this->SetSearchParm($mst_additional->price); // Field price
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
		global $mst_additional;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_additional->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_additional->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_additional->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_additional->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_additional->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_additional;
		$this->sSrchWhere = "";
		$mst_additional->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_additional;
		$mst_additional->setAdvancedSearch("x_kode", "");
		$mst_additional->setAdvancedSearch("x_description", "");
		$mst_additional->setAdvancedSearch("x_price", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_additional;
		$this->sSrchWhere = $mst_additional->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_additional;
		 $mst_additional->kode->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_kode");
		 $mst_additional->description->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_description");
		 $mst_additional->price->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_price");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_additional;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_additional->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_additional->CurrentOrderType = @$_GET["ordertype"];
			$mst_additional->UpdateSort($mst_additional->kode); // Field 
			$mst_additional->UpdateSort($mst_additional->description); // Field 
			$mst_additional->UpdateSort($mst_additional->price); // Field 
			$mst_additional->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_additional;
		$sOrderBy = $mst_additional->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_additional->SqlOrderBy() <> "") {
				$sOrderBy = $mst_additional->SqlOrderBy();
				$mst_additional->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_additional;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_additional->setSessionOrderBy($sOrderBy);
				$mst_additional->kode->setSort("");
				$mst_additional->description->setSort("");
				$mst_additional->price->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_additional;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_additional->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_additional->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_additional->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_additional->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_additional->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_additional;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_additional;

		// Load search values
		// kode

		$mst_additional->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$mst_additional->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// description
		$mst_additional->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$mst_additional->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// price
		$mst_additional->price->AdvancedSearch->SearchValue = @$_GET["x_price"];
		$mst_additional->price->AdvancedSearch->SearchOperator = @$_GET["z_price"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_additional;
		$mst_additional->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_additional->description->setFormValue($objForm->GetValue("x_description"));
		$mst_additional->price->setFormValue($objForm->GetValue("x_price"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_additional;
		$mst_additional->kode->CurrentValue = $mst_additional->kode->FormValue;
		$mst_additional->description->CurrentValue = $mst_additional->description->FormValue;
		$mst_additional->price->CurrentValue = $mst_additional->price->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_additional;

		// Call Recordset Selecting event
		$mst_additional->Recordset_Selecting($mst_additional->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_additional->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_additional->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_additional;
		$sFilter = $mst_additional->KeyFilter();

		// Call Row Selecting event
		$mst_additional->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_additional->CurrentFilter = $sFilter;
		$sSql = $mst_additional->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_additional->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_additional;
		$mst_additional->kode->setDbValue($rs->fields('kode'));
		$mst_additional->description->setDbValue($rs->fields('description'));
		$mst_additional->price->setDbValue($rs->fields('price'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_additional;

		// Call Row_Rendering event
		$mst_additional->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_additional->kode->CellCssStyle = "white-space: nowrap;";
		$mst_additional->kode->CellCssClass = "";

		// description
		$mst_additional->description->CellCssStyle = "white-space: nowrap;";
		$mst_additional->description->CellCssClass = "";

		// price
		$mst_additional->price->CellCssStyle = "white-space: nowrap;";
		$mst_additional->price->CellCssClass = "";
		if ($mst_additional->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_additional->kode->ViewValue = $mst_additional->kode->CurrentValue;
			$mst_additional->kode->CssStyle = "";
			$mst_additional->kode->CssClass = "";
			$mst_additional->kode->ViewCustomAttributes = "";

			// description
			$mst_additional->description->ViewValue = $mst_additional->description->CurrentValue;
			$mst_additional->description->CssStyle = "";
			$mst_additional->description->CssClass = "";
			$mst_additional->description->ViewCustomAttributes = "";

			// price
			$mst_additional->price->ViewValue = $mst_additional->price->CurrentValue;
			$mst_additional->price->ViewValue = ew_FormatNumber($mst_additional->price->ViewValue, 0, -2, -2, -2);
			$mst_additional->price->CssStyle = "text-align:right;";
			$mst_additional->price->CssClass = "";
			$mst_additional->price->ViewCustomAttributes = "";

			// kode
			$mst_additional->kode->HrefValue = "";

			// description
			$mst_additional->description->HrefValue = "";

			// price
			$mst_additional->price->HrefValue = "";
		} elseif ($mst_additional->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			$mst_additional->kode->EditCustomAttributes = "";
			$mst_additional->kode->EditValue = ew_HtmlEncode($mst_additional->kode->CurrentValue);

			// description
			$mst_additional->description->EditCustomAttributes = "";
			$mst_additional->description->EditValue = ew_HtmlEncode($mst_additional->description->CurrentValue);

			// price
			$mst_additional->price->EditCustomAttributes = "";
			$mst_additional->price->EditValue = ew_HtmlEncode($mst_additional->price->CurrentValue);
		} elseif ($mst_additional->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_additional->kode->EditCustomAttributes = "";
			$mst_additional->kode->EditValue = $mst_additional->kode->CurrentValue;
			$mst_additional->kode->CssStyle = "";
			$mst_additional->kode->CssClass = "";
			$mst_additional->kode->ViewCustomAttributes = "";

			// description
			$mst_additional->description->EditCustomAttributes = "";
			$mst_additional->description->EditValue = ew_HtmlEncode($mst_additional->description->CurrentValue);

			// price
			$mst_additional->price->EditCustomAttributes = "";
			$mst_additional->price->EditValue = ew_HtmlEncode($mst_additional->price->CurrentValue);

			// Edit refer script
			// kode

			$mst_additional->kode->HrefValue = "";

			// description
			$mst_additional->description->HrefValue = "";

			// price
			$mst_additional->price->HrefValue = "";
		} elseif ($mst_additional->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$mst_additional->kode->EditCustomAttributes = "";
			$mst_additional->kode->EditValue = ew_HtmlEncode($mst_additional->kode->AdvancedSearch->SearchValue);

			// description
			$mst_additional->description->EditCustomAttributes = "";
			$mst_additional->description->EditValue = ew_HtmlEncode($mst_additional->description->AdvancedSearch->SearchValue);

			// price
			$mst_additional->price->EditCustomAttributes = "";
			$mst_additional->price->EditValue = ew_HtmlEncode($mst_additional->price->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$mst_additional->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_additional;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_additional;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_additional->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if ($mst_additional->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
		}
		if ($mst_additional->price->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Price";
		}
		if (!ew_CheckNumber($mst_additional->price->FormValue)) {
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
		global $conn, $Security, $mst_additional;
		$sFilter = $mst_additional->KeyFilter();
		$mst_additional->CurrentFilter = $sFilter;
		$sSql = $mst_additional->SQL();
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

			$mst_additional->description->SetDbValueDef($mst_additional->description->CurrentValue, "");
			$rsnew['description'] =& $mst_additional->description->DbValue;

			// Field price
			$mst_additional->price->SetDbValueDef($mst_additional->price->CurrentValue, 0);
			$rsnew['price'] =& $mst_additional->price->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_additional->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_additional->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_additional->CancelMessage <> "") {
					$this->setMessage($mst_additional->CancelMessage);
					$mst_additional->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_additional->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_additional;

		// Check if key value entered
		if ($mst_additional->kode->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $mst_additional->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $mst_additional->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field kode
		$mst_additional->kode->SetDbValueDef($mst_additional->kode->CurrentValue, "");
		$rsnew['kode'] =& $mst_additional->kode->DbValue;

		// Field description
		$mst_additional->description->SetDbValueDef($mst_additional->description->CurrentValue, "");
		$rsnew['description'] =& $mst_additional->description->DbValue;

		// Field price
		$mst_additional->price->SetDbValueDef($mst_additional->price->CurrentValue, 0);
		$rsnew['price'] =& $mst_additional->price->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_additional->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_additional->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_additional->CancelMessage <> "") {
				$this->setMessage($mst_additional->CancelMessage);
				$mst_additional->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$mst_additional->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $mst_additional;
		$mst_additional->kode->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_kode");
		$mst_additional->description->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_description");
		$mst_additional->price->AdvancedSearch->SearchValue = $mst_additional->getAdvancedSearch("x_price");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_additional;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_additional->ExportAll) {
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
		if ($mst_additional->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_additional->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_additional->Export == "csv") {
				$sExportStr = "";
				echo ew_ExportLine($sExportStr, $mst_additional->Export);
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
				$mst_additional->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_additional->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_additional->Export <> "csv") { // Vertical format
					}	else { // Horizontal format
						$sExportStr = "";
						echo ew_ExportLine($sExportStr, $mst_additional->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_additional->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_additional->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_additional';

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
		global $mst_additional;
		$table = 'mst_additional';

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
			if ($mst_additional->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$newvalue = ($mst_additional->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
				ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $mst_additional;
		$table = 'mst_additional';

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
			if ($mst_additional->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_additional->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_additional->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
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
