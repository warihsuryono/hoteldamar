<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_discountinfo.php" ?>
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
$mst_discount_list = new cmst_discount_list();
$Page =& $mst_discount_list;

// Page init processing
$mst_discount_list->Page_Init();

// Page main processing
$mst_discount_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_discount->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_discount_list = new ew_Page("mst_discount_list");

// page properties
mst_discount_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_discount_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_discount_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_disc"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Disc (%)");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with validate function for search
mst_discount_list.ValidateSearch = function(fobj) {
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
mst_discount_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_discount_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_discount_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_discount->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_discount->Export == "" && $mst_discount->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_discount_list->LoadRecordset();
	$mst_discount_list->lTotalRecs = ($bSelectLimit) ? $mst_discount->SelectRecordCount() : $rs->RecordCount();
	$mst_discount_list->lStartRec = 1;
	if ($mst_discount_list->lDisplayRecs <= 0) // Display all records
		$mst_discount_list->lDisplayRecs = $mst_discount_list->lTotalRecs;
	if (!($mst_discount->ExportAll && $mst_discount->Export <> ""))
		$mst_discount_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_discount_list->LoadRecordset($mst_discount_list->lStartRec-1, $mst_discount_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">Mst Discount
<?php if ($mst_discount->Export == "" && $mst_discount->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_discount_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_discount_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_discount->Export == "" && $mst_discount->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_discount_list);" style="text-decoration: none;"><img id="mst_discount_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_discount_list_SearchPanel">
<form name="fmst_discountlistsrch" id="fmst_discountlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_discount_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_discount">
<?php
if ($gsSearchError == "")
	$mst_discount_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_discount->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_discount_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Name</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_name" id="x_name" size="30" maxlength="100" value="<?php echo $mst_discount->name->EditValue ?>"<?php echo $mst_discount->name->EditAttributes() ?>>
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
<input type="text" name="x_description" id="x_description" size="100" maxlength="255" value="<?php echo $mst_discount->description->EditValue ?>"<?php echo $mst_discount->description->EditAttributes() ?>>
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
			<!--a href="<?php echo $mst_discount_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_discount_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_discount_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_discount->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_discount->CurrentAction <> "gridadd" && $mst_discount->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_discount_list->Pager)) $mst_discount_list->Pager = new cPrevNextPager($mst_discount_list->lStartRec, $mst_discount_list->lDisplayRecs, $mst_discount_list->lTotalRecs) ?>
<?php if ($mst_discount_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_discount_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_discount_list->PageUrl() ?>start=<?php echo $mst_discount_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_discount_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_discount_list->PageUrl() ?>start=<?php echo $mst_discount_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_discount_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_discount_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_discount_list->PageUrl() ?>start=<?php echo $mst_discount_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_discount_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_discount_list->PageUrl() ?>start=<?php echo $mst_discount_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_discount_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_discount_list->Pager->FromIndex ?> to <?php echo $mst_discount_list->Pager->ToIndex ?> of <?php echo $mst_discount_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_discount_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_discount_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_discount">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_discount_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_discount_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_discount_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_discount_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_discount_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_discount_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_discount_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_discountlist" id="fmst_discountlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_discount">
<?php if ($mst_discount_list->lTotalRecs > 0 || $mst_discount->CurrentAction == "add" || $mst_discount->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_discount_list->lOptionCnt = 0;
	$mst_discount_list->lOptionCnt++; // edit
	$mst_discount_list->lOptionCnt++; // Delete
	$mst_discount_list->lOptionCnt += count($mst_discount_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_discount->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_discount->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($mst_discount_list->lOptionCnt == 0 && $mst_discount->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_discount_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_discount->id->Visible) { // id ?>
	<?php if ($mst_discount->SortUrl($mst_discount->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_discount->SortUrl($mst_discount->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($mst_discount->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_discount->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_discount->name->Visible) { // name ?>
	<?php if ($mst_discount->SortUrl($mst_discount->name) == "") { ?>
		<td style="white-space: nowrap;">Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_discount->SortUrl($mst_discount->name) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name</td><td style="width: 10px;"><?php if ($mst_discount->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_discount->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_discount->description->Visible) { // description ?>
	<?php if ($mst_discount->SortUrl($mst_discount->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_discount->SortUrl($mst_discount->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_discount->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_discount->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_discount->disc->Visible) { // disc ?>
	<?php if ($mst_discount->SortUrl($mst_discount->disc) == "") { ?>
		<td style="white-space: nowrap;">Disc (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_discount->SortUrl($mst_discount->disc) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Disc (%)</td><td style="width: 10px;"><?php if ($mst_discount->disc->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_discount->disc->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($mst_discount->CurrentAction == "add" || $mst_discount->CurrentAction == "copy") {
		$mst_discount_list->lRowIndex = 1;
		if ($mst_discount->CurrentAction == "add")
			$mst_discount_list->LoadDefaultValues();
		if ($mst_discount->EventCancelled) // Insert failed
			$mst_discount_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$mst_discount->CssClass = "ewTableEditRow";
		$mst_discount->CssStyle = "";
		$mst_discount->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$mst_discount->RowType = EW_ROWTYPE_ADD;

		// Render row
		$mst_discount_list->RenderRow();
?>
	<tr<?php echo $mst_discount->RowAttributes() ?>>
<td colspan="<?php echo $mst_discount_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_discount_list.ValidateForm(document.fmst_discountlist)) document.fmst_discountlist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_discount_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($mst_discount->id->Visible) { // id ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($mst_discount->name->Visible) { // name ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_name" id="x<?php echo $mst_discount_list->lRowIndex ?>_name" size="30" maxlength="100" value="<?php echo $mst_discount->name->EditValue ?>"<?php echo $mst_discount->name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_discount->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_description" id="x<?php echo $mst_discount_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_discount->description->EditValue ?>"<?php echo $mst_discount->description->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_discount->disc->Visible) { // disc ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_disc" id="x<?php echo $mst_discount_list->lRowIndex ?>_disc" size="3" value="<?php echo $mst_discount->disc->EditValue ?>"<?php echo $mst_discount->disc->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($mst_discount->ExportAll && $mst_discount->Export <> "") {
	$mst_discount_list->lStopRec = $mst_discount_list->lTotalRecs;
} else {
	$mst_discount_list->lStopRec = $mst_discount_list->lStartRec + $mst_discount_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_discount_list->lRecCount = $mst_discount_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_discount->SelectLimit && $mst_discount_list->lStartRec > 1)
		$rs->Move($mst_discount_list->lStartRec - 1);
}
$mst_discount_list->lRowCnt = 0;
$mst_discount_list->lEditRowCnt = 0;
if ($mst_discount->CurrentAction == "edit")
	$mst_discount_list->lRowIndex = 1;
while (($mst_discount->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_discount_list->lRecCount < $mst_discount_list->lStopRec) {
	$mst_discount_list->lRecCount++;
	if (intval($mst_discount_list->lRecCount) >= intval($mst_discount_list->lStartRec)) {
		$mst_discount_list->lRowCnt++;

	// Init row class and style
	$mst_discount->CssClass = "";
	$mst_discount->CssStyle = "";
	$mst_discount->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_discount->CurrentAction == "gridadd") {
		$mst_discount_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_discount_list->LoadRowValues($rs); // Load row values
	}
	$mst_discount->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_discount->CurrentAction == "edit") {
		if ($mst_discount_list->CheckInlineEditKey() && $mst_discount_list->lEditRowCnt == 0) // Inline edit
			$mst_discount->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_discount->RowType == EW_ROWTYPE_EDIT && $mst_discount->EventCancelled) { // Update failed
		if ($mst_discount->CurrentAction == "edit")
			$mst_discount_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_discount_list->lEditRowCnt++;
		$mst_discount->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_discount->RowType == EW_ROWTYPE_ADD || $mst_discount->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_discount->CssClass = "ewTableEditRow";

	// Render row
	$mst_discount_list->RenderRow();
?>
	<tr<?php echo $mst_discount->RowAttributes() ?>>
<?php if ($mst_discount->RowType == EW_ROWTYPE_ADD || $mst_discount->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_discount->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_discount_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_discount_list.ValidateForm(document.fmst_discountlist)) document.fmst_discountlist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_discount_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_discount->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_discount->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($mst_discount_list->lOptionCnt == 0 && $mst_discount->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_discount->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_discount_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_discount->id->Visible) { // id ?>
		<td<?php echo $mst_discount->id->CellAttributes() ?>>
<?php if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_discount->id->ViewAttributes() ?>><?php echo $mst_discount->id->EditValue ?></div><input type="hidden" name="x<?php echo $mst_discount_list->lRowIndex ?>_id" id="x<?php echo $mst_discount_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($mst_discount->id->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_discount->id->ViewAttributes() ?>><?php echo $mst_discount->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_discount->name->Visible) { // name ?>
		<td<?php echo $mst_discount->name->CellAttributes() ?>>
<?php if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_name" id="x<?php echo $mst_discount_list->lRowIndex ?>_name" size="30" maxlength="100" value="<?php echo $mst_discount->name->EditValue ?>"<?php echo $mst_discount->name->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_discount->name->ViewAttributes() ?>><?php echo $mst_discount->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_discount->description->Visible) { // description ?>
		<td<?php echo $mst_discount->description->CellAttributes() ?>>
<?php if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_description" id="x<?php echo $mst_discount_list->lRowIndex ?>_description" size="100" maxlength="255" value="<?php echo $mst_discount->description->EditValue ?>"<?php echo $mst_discount->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_discount->description->ViewAttributes() ?>><?php echo $mst_discount->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_discount->disc->Visible) { // disc ?>
		<td<?php echo $mst_discount->disc->CellAttributes() ?>>
<?php if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_discount_list->lRowIndex ?>_disc" id="x<?php echo $mst_discount_list->lRowIndex ?>_disc" size="3" value="<?php echo $mst_discount->disc->EditValue ?>"<?php echo $mst_discount->disc->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_discount->disc->ViewAttributes() ?>><?php echo $mst_discount->disc->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_discount->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_discount->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_discount->CurrentAction == "add" || $mst_discount->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_discount_list->lRowIndex ?>">
<?php } ?>
<?php if ($mst_discount->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_discount_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_discount->Export == "" && $mst_discount->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_discount_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_discount->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_discount_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_discount_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_discount';

	// Page Object Name
	var $PageObjName = 'mst_discount_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_discount;
		if ($mst_discount->UseTokenInUrl) $PageUrl .= "t=" . $mst_discount->TableVar . "&"; // add page token
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
		global $objForm, $mst_discount;
		if ($mst_discount->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_discount->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_discount->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_discount_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_discount"] = new cmst_discount();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_discount', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_discount;
	$mst_discount->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_discount->Export; // Get export parameter, used in header
	$gsExportFile = $mst_discount->TableVar; // Get export file, used in header
	if ($mst_discount->Export == "print" || $mst_discount->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_discount->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_discount;
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
				$mst_discount->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_discount->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_discount->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($mst_discount->CurrentAction == "add" || $mst_discount->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_discount->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_discount->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($mst_discount->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
		if ($mst_discount->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_discount->getRecordsPerPage(); // Restore from Session
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
		$mst_discount->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_discount->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_discount->setStartRecordNumber($this->lStartRec);
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
		$mst_discount->setSessionWhere($sFilter);
		$mst_discount->CurrentFilter = "";

		// Export data only
		if (in_array($mst_discount->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_discount;
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
			$mst_discount->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_discount->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_discount;
		$mst_discount->setKey("id", ""); // Clear inline edit key
		$mst_discount->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_discount;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$mst_discount->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_discount->setKey("id", $mst_discount->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_discount;
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
				$mst_discount->SendEmail = TRUE; // Send email on update success
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
			$mst_discount->EventCancelled = TRUE; // Cancel event
			$mst_discount->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_discount;

		//CheckInlineEditKey = True
		if (strval($mst_discount->getKey("id")) <> strval($mst_discount->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $mst_discount;
		$mst_discount->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $mst_discount;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$mst_discount->EventCancelled = TRUE; // Set event cancelled
			$mst_discount->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$mst_discount->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$mst_discount->EventCancelled = TRUE; // Set event cancelled
			$mst_discount->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_discount;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_discount->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $mst_discount->name, FALSE); // Field name
		$this->BuildSearchSql($sWhere, $mst_discount->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $mst_discount->disc, FALSE); // Field disc

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_discount->id); // Field id
			$this->SetSearchParm($mst_discount->name); // Field name
			$this->SetSearchParm($mst_discount->description); // Field description
			$this->SetSearchParm($mst_discount->disc); // Field disc
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
		global $mst_discount;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_discount->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_discount->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_discount->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_discount->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_discount->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_discount;
		$this->sSrchWhere = "";
		$mst_discount->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_discount;
		$mst_discount->setAdvancedSearch("x_id", "");
		$mst_discount->setAdvancedSearch("x_name", "");
		$mst_discount->setAdvancedSearch("x_description", "");
		$mst_discount->setAdvancedSearch("x_disc", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_discount;
		$this->sSrchWhere = $mst_discount->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_discount;
		 $mst_discount->id->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_id");
		 $mst_discount->name->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_name");
		 $mst_discount->description->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_description");
		 $mst_discount->disc->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_disc");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_discount;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_discount->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_discount->CurrentOrderType = @$_GET["ordertype"];
			$mst_discount->UpdateSort($mst_discount->id); // Field 
			$mst_discount->UpdateSort($mst_discount->name); // Field 
			$mst_discount->UpdateSort($mst_discount->description); // Field 
			$mst_discount->UpdateSort($mst_discount->disc); // Field 
			$mst_discount->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_discount;
		$sOrderBy = $mst_discount->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_discount->SqlOrderBy() <> "") {
				$sOrderBy = $mst_discount->SqlOrderBy();
				$mst_discount->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_discount;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_discount->setSessionOrderBy($sOrderBy);
				$mst_discount->id->setSort("");
				$mst_discount->name->setSort("");
				$mst_discount->description->setSort("");
				$mst_discount->disc->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_discount->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_discount;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_discount->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_discount->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_discount->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_discount->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_discount->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_discount->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_discount;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_discount;

		// Load search values
		// id

		$mst_discount->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$mst_discount->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$mst_discount->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		$mst_discount->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// description
		$mst_discount->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$mst_discount->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// disc
		$mst_discount->disc->AdvancedSearch->SearchValue = @$_GET["x_disc"];
		$mst_discount->disc->AdvancedSearch->SearchOperator = @$_GET["z_disc"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_discount;
		$mst_discount->id->setFormValue($objForm->GetValue("x_id"));
		$mst_discount->name->setFormValue($objForm->GetValue("x_name"));
		$mst_discount->description->setFormValue($objForm->GetValue("x_description"));
		$mst_discount->disc->setFormValue($objForm->GetValue("x_disc"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_discount;
		$mst_discount->id->CurrentValue = $mst_discount->id->FormValue;
		$mst_discount->name->CurrentValue = $mst_discount->name->FormValue;
		$mst_discount->description->CurrentValue = $mst_discount->description->FormValue;
		$mst_discount->disc->CurrentValue = $mst_discount->disc->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_discount;

		// Call Recordset Selecting event
		$mst_discount->Recordset_Selecting($mst_discount->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_discount->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_discount->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_discount;
		$sFilter = $mst_discount->KeyFilter();

		// Call Row Selecting event
		$mst_discount->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_discount->CurrentFilter = $sFilter;
		$sSql = $mst_discount->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_discount->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_discount;
		$mst_discount->id->setDbValue($rs->fields('id'));
		$mst_discount->name->setDbValue($rs->fields('name'));
		$mst_discount->description->setDbValue($rs->fields('description'));
		$mst_discount->disc->setDbValue($rs->fields('disc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_discount;

		// Call Row_Rendering event
		$mst_discount->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_discount->id->CellCssStyle = "white-space: nowrap;";
		$mst_discount->id->CellCssClass = "";

		// name
		$mst_discount->name->CellCssStyle = "white-space: nowrap;";
		$mst_discount->name->CellCssClass = "";

		// description
		$mst_discount->description->CellCssStyle = "white-space: nowrap;";
		$mst_discount->description->CellCssClass = "";

		// disc
		$mst_discount->disc->CellCssStyle = "white-space: nowrap;";
		$mst_discount->disc->CellCssClass = "";
		if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_discount->id->ViewValue = $mst_discount->id->CurrentValue;
			$mst_discount->id->CssStyle = "";
			$mst_discount->id->CssClass = "";
			$mst_discount->id->ViewCustomAttributes = "";

			// name
			$mst_discount->name->ViewValue = $mst_discount->name->CurrentValue;
			$mst_discount->name->CssStyle = "";
			$mst_discount->name->CssClass = "";
			$mst_discount->name->ViewCustomAttributes = "";

			// description
			$mst_discount->description->ViewValue = $mst_discount->description->CurrentValue;
			$mst_discount->description->CssStyle = "";
			$mst_discount->description->CssClass = "";
			$mst_discount->description->ViewCustomAttributes = "";

			// disc
			$mst_discount->disc->ViewValue = $mst_discount->disc->CurrentValue;
			$mst_discount->disc->CssStyle = "";
			$mst_discount->disc->CssClass = "";
			$mst_discount->disc->ViewCustomAttributes = "";

			// id
			$mst_discount->id->HrefValue = "";

			// name
			$mst_discount->name->HrefValue = "";

			// description
			$mst_discount->description->HrefValue = "";

			// disc
			$mst_discount->disc->HrefValue = "";
		} elseif ($mst_discount->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$mst_discount->name->EditCustomAttributes = "";
			$mst_discount->name->EditValue = ew_HtmlEncode($mst_discount->name->CurrentValue);

			// description
			$mst_discount->description->EditCustomAttributes = "";
			$mst_discount->description->EditValue = ew_HtmlEncode($mst_discount->description->CurrentValue);

			// disc
			$mst_discount->disc->EditCustomAttributes = "";
			$mst_discount->disc->EditValue = ew_HtmlEncode($mst_discount->disc->CurrentValue);
		} elseif ($mst_discount->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$mst_discount->id->EditCustomAttributes = "";
			$mst_discount->id->EditValue = $mst_discount->id->CurrentValue;
			$mst_discount->id->CssStyle = "";
			$mst_discount->id->CssClass = "";
			$mst_discount->id->ViewCustomAttributes = "";

			// name
			$mst_discount->name->EditCustomAttributes = "";
			$mst_discount->name->EditValue = ew_HtmlEncode($mst_discount->name->CurrentValue);

			// description
			$mst_discount->description->EditCustomAttributes = "";
			$mst_discount->description->EditValue = ew_HtmlEncode($mst_discount->description->CurrentValue);

			// disc
			$mst_discount->disc->EditCustomAttributes = "";
			$mst_discount->disc->EditValue = ew_HtmlEncode($mst_discount->disc->CurrentValue);

			// Edit refer script
			// id

			$mst_discount->id->HrefValue = "";

			// name
			$mst_discount->name->HrefValue = "";

			// description
			$mst_discount->description->HrefValue = "";

			// disc
			$mst_discount->disc->HrefValue = "";
		} elseif ($mst_discount->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$mst_discount->id->EditCustomAttributes = "";
			$mst_discount->id->EditValue = ew_HtmlEncode($mst_discount->id->AdvancedSearch->SearchValue);

			// name
			$mst_discount->name->EditCustomAttributes = "";
			$mst_discount->name->EditValue = ew_HtmlEncode($mst_discount->name->AdvancedSearch->SearchValue);

			// description
			$mst_discount->description->EditCustomAttributes = "";
			$mst_discount->description->EditValue = ew_HtmlEncode($mst_discount->description->AdvancedSearch->SearchValue);

			// disc
			$mst_discount->disc->EditCustomAttributes = "";
			$mst_discount->disc->EditValue = ew_HtmlEncode($mst_discount->disc->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$mst_discount->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_discount;

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
		global $gsFormError, $mst_discount;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($mst_discount->disc->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Disc (%)";
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
		global $conn, $Security, $mst_discount;
		$sFilter = $mst_discount->KeyFilter();
		$mst_discount->CurrentFilter = $sFilter;
		$sSql = $mst_discount->SQL();
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

			// Field id
			// Field name

			$mst_discount->name->SetDbValueDef($mst_discount->name->CurrentValue, NULL);
			$rsnew['name'] =& $mst_discount->name->DbValue;

			// Field description
			$mst_discount->description->SetDbValueDef($mst_discount->description->CurrentValue, NULL);
			$rsnew['description'] =& $mst_discount->description->DbValue;

			// Field disc
			$mst_discount->disc->SetDbValueDef($mst_discount->disc->CurrentValue, NULL);
			$rsnew['disc'] =& $mst_discount->disc->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_discount->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_discount->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_discount->CancelMessage <> "") {
					$this->setMessage($mst_discount->CancelMessage);
					$mst_discount->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_discount->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_discount;
		$rsnew = array();

		// Field id
		// Field name

		$mst_discount->name->SetDbValueDef($mst_discount->name->CurrentValue, NULL);
		$rsnew['name'] =& $mst_discount->name->DbValue;

		// Field description
		$mst_discount->description->SetDbValueDef($mst_discount->description->CurrentValue, NULL);
		$rsnew['description'] =& $mst_discount->description->DbValue;

		// Field disc
		$mst_discount->disc->SetDbValueDef($mst_discount->disc->CurrentValue, NULL);
		$rsnew['disc'] =& $mst_discount->disc->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_discount->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_discount->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_discount->CancelMessage <> "") {
				$this->setMessage($mst_discount->CancelMessage);
				$mst_discount->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$mst_discount->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $mst_discount->id->DbValue;

			// Call Row Inserted event
			$mst_discount->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $mst_discount;
		$mst_discount->id->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_id");
		$mst_discount->name->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_name");
		$mst_discount->description->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_description");
		$mst_discount->disc->AdvancedSearch->SearchValue = $mst_discount->getAdvancedSearch("x_disc");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_discount;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_discount->ExportAll) {
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
		if ($mst_discount->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_discount->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_discount->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $mst_discount->Export);
				ew_ExportAddValue($sExportStr, 'name', $mst_discount->Export);
				ew_ExportAddValue($sExportStr, 'description', $mst_discount->Export);
				ew_ExportAddValue($sExportStr, 'disc', $mst_discount->Export);
				echo ew_ExportLine($sExportStr, $mst_discount->Export);
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
				$mst_discount->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_discount->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $mst_discount->id->CurrentValue);
					$XmlDoc->AddField('name', $mst_discount->name->CurrentValue);
					$XmlDoc->AddField('description', $mst_discount->description->CurrentValue);
					$XmlDoc->AddField('disc', $mst_discount->disc->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_discount->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $mst_discount->id->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						echo ew_ExportField('name', $mst_discount->name->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						echo ew_ExportField('description', $mst_discount->description->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						echo ew_ExportField('disc', $mst_discount->disc->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_discount->id->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						ew_ExportAddValue($sExportStr, $mst_discount->name->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						ew_ExportAddValue($sExportStr, $mst_discount->description->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						ew_ExportAddValue($sExportStr, $mst_discount->disc->ExportValue($mst_discount->Export, $mst_discount->ExportOriginalValue), $mst_discount->Export);
						echo ew_ExportLine($sExportStr, $mst_discount->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_discount->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_discount->Export);
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
